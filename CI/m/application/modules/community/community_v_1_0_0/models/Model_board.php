<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-11-09
| Memo : 커뮤니티
|------------------------------------------------------------------------
*/

Class Model_board extends MY_Model{

	public function product_reg_check($data){

		$product_reg_in_yn = "Y";
		$result_code = 1000;
		// 중고거래 게시글은 하루 한사용자당 5개 까지 등록 가능
		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_product a
						WHERE
							a.del_yn = 'N'
							and a.member_idx = '$this->member_idx'
							AND DATE_FORMAT(a.ins_date, '%Y-%m-%d')=DATE_FORMAT(NOW(), '%Y-%m-%d')
		";

		$product_cnt =	$this->query_cnt($sql,array(),$data);
		if ($product_cnt>=5) {
			$product_reg_in_yn = "N";
			$result_code = -1;
		}

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_product a
						WHERE
							a.del_yn = 'N'
							and a.member_idx = '$this->member_idx'
							AND a.product_state IN (0,1)
		";

		$product_cnt =	$this->query_cnt($sql,array(),$data);
		if ($product_cnt>=60) {
			$product_reg_in_yn = "N";
			$result_code = -2;
		}

		return $result_code;
	}


	// 커뮤니티 목록
	public function board_list($data){
		$page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

		$sql = "SELECT
							a.board_idx,
							a.member_idx,
							FN_AES_DECRYPT(c.member_name) AS member_name,
							c.member_img,
							a.img_path,
							a.title,
							a.tags,
							a.contents,
							a.reply_cnt,
							a.recommend_cnt,
							a.scrap_cnt,
							a.view_cnt,
							a.report_cnt,
							a.best_yn,
							a.del_yn,
							a.display_yn,
							c.del_yn as member_del_yn,
							DATE_FORMAT(a.ins_date, '%Y-%m-%d %H:%i:%s') as ins_date,
							if(t.scrap_yn='Y', 'Y', 'N') as scrap_yn,
							if(s.recommend_yn='Y', 'Y', 'N') as recommend_yn,
							if(r.board_report_idx>0, 'Y', 'N') as report_yn,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_board_yn

						FROM
							tbl_board a
							JOIN tbl_member c ON c.member_idx = a.member_idx and c.del_yn!='Y'
							LEFT JOIN tbl_board_scrap t ON t.member_idx = '$this->member_idx' and t.board_idx = a.board_idx and t.del_yn = 'N'
							LEFT JOIN tbl_board_recommend s ON s.member_idx = '$this->member_idx' and s.board_idx = a.board_idx and s.del_yn = 'N'
							LEFT JOIN tbl_board_report r ON r.member_idx = '$this->member_idx' AND r.board_idx = a.board_idx and r.del_yn = 'N'

						WHERE
							a.del_yn = 'N'
							-- and a.display_yn='Y'
		";

		$sql .= "ORDER BY a.best_yn DESC, a.board_idx DESC limit ?, ? ";

		return	$this->query_result($sql,array(
																$page_no,
																$page_size),


																
																$data);
	}

	// 커뮤니티 목록수
	public function board_list_count($data){

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_board a
							JOIN tbl_member c ON c.member_idx = a.member_idx and c.del_yn!='Y'
							LEFT JOIN tbl_board_scrap t ON t.member_idx = '$this->member_idx' and t.board_idx = a.board_idx and t.del_yn = 'N'
							LEFT JOIN tbl_board_recommend s ON s.member_idx = '$this->member_idx' and s.board_idx = a.board_idx and s.del_yn = 'N'
							LEFT JOIN tbl_board_report r ON r.member_idx = '$this->member_idx' AND r.board_idx = a.board_idx and r.del_yn = 'N'
						WHERE
							a.del_yn = 'N'
							-- and a.display_yn='Y'
		";

		return	$this->query_cnt($sql,array(),$data);

	}

	// 상세
	public function board_detail($data){
		$board_idx = $data['board_idx'];

		$sql = "SELECT
							a.board_idx,
							a.member_idx,
							a.img_path,
							a.title,
							a.tags,
							a.contents,
							a.reply_cnt,
							a.recommend_cnt,
							a.scrap_cnt,
							a.view_cnt,
							a.report_cnt,
							a.best_yn,
							a.del_yn
						FROM
							tbl_board a
							LEFT JOIN tbl_member c ON c.member_idx = a.member_idx
						WHERE
							a.board_idx = ?
			";

			return $this->query_row($sql,
															array(
															$board_idx
															),
															$data
															);
	}

	public function board_del_check($data){

		$board_idx = $data['board_idx'];

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_board a
						WHERE
							a.del_yn = 'N'
							and a.board_idx='$board_idx'
		";

		return	$this->query_cnt($sql,array(),$data);

	}
	public function my_board_cnt(){

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_board a
						WHERE
							a.del_yn = 'N'
							and a.member_idx='$this->member_idx'
		";

		return	$this->query_cnt($sql,array());

	}

	// 커뮤니티 게시글 삭제
	public function board_del($data){
		$board_idx = $data['board_idx'];

		$this->db->trans_begin();


		// $sql = "SELECT
		// 					a.board_idx,
		// 					a.board_type
		// 				FROM
		// 					tbl_board a
		// 				WHERE
		// 					a.board_idx = ?
		// 	";
		//
		// $result = $this->query_row($sql,
		// 													array(
		// 													$board_idx
		// 													),
		// 													$data
		// 													);

		$sql = "UPDATE
							tbl_board
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							board_idx = ?
		";

		$this->query($sql,
								array(
								$board_idx
								),
								$data
								);


		// if ($result->board_type == '1') {
		// 	$sql = "UPDATE
		// 						tbl_member z,
		// 						(select count(*) as board_cnt from tbl_board a where member_idx=? and a.del_yn='N' ) as tb_a
		// 					SET
		// 						z.board_1_cnt = tb_a.board_cnt,
		// 						z.upd_date = NOW()
		// 					WHERE
		// 						z.member_idx = ?
		// 					";
		// }else {
		// 	$sql = "UPDATE
		// 						tbl_member z,
		// 						(select count(*) as board_cnt from tbl_board a where member_idx=? and a.del_yn='N' ) as tb_a
		// 					SET
		// 						z.board_3_cnt = tb_a.board_cnt,
		// 						z.upd_date = NOW()
		// 					WHERE
		// 						z.member_idx = ?
		// 					";
		// }
		//
		// $this->query($sql,
		// 						array(
		// 						$this->member_idx,
		// 						$this->member_idx
		// 						),
		// 						$data
		// 						);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// 게시글 등록
	public function	board_reg_in($data){

		$img_path = $data['img_path'];
		$tags = $data['tags'];
		$contents = $data['contents'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board
							(
								member_idx,
								img_path,
								tags,
								contents,
								del_yn,
								ins_date,
								upd_date
							) values (
								 ?,
								 ?,
								 ?,
								 ?,
								'N',
								NOW(),
								NOW()
							)
							";

			$this->query($sql,
									array(
										$this->member_idx,
										$img_path,
										$tags,
										$contents,
									),
									$data
									);

		$board_idx = $this->db->insert_id();
		//
		// if ($board_type == '1') {
		// 	$sql = "UPDATE
		// 						tbl_member z,
		// 						(select count(*) as board_cnt from tbl_board a where member_idx=? and a.del_yn='N' ) as tb_a
		// 					SET
		// 						z.board_1_cnt = tb_a.board_cnt,
		// 						z.upd_date = NOW()
		// 					WHERE
		// 						z.member_idx = ?
		// 					";
		// }else {
		// 	$sql = "UPDATE
		// 						tbl_member z,
		// 						(select count(*) as board_cnt from tbl_board a where member_idx=? and a.del_yn='N' ) as tb_a
		// 					SET
		// 						z.board_3_cnt = tb_a.board_cnt,
		// 						z.upd_date = NOW()
		// 					WHERE
		// 						z.member_idx = ?
		// 					";
		// }
		//
		// $this->query($sql,
		// 						array(
		// 							$this->member_idx,
		// 							$this->member_idx
		// 						),
		// 						$data
		// 						);


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return $board_idx;
		}
	}

	// 게시글 수정
	public function board_mod_up($data){
		$board_idx = $data['board_idx'];
		$img_path = $data['img_path'];
		$tags = $data['tags'];
		$contents = $data['contents'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board
						SET
							img_path = ?,
							tags = ?,
							contents = ?,
							upd_date = NOW()
						WHERE
							board_idx = ?
						";

		$this->query($sql,
								array(
								$img_path,
								$tags,
								$contents,
								$board_idx,
								),
								$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// 댓글 목록_본문 요약 보기
	public function board_summary_detail($data){
		$board_idx = $data['board_idx'];

		$sql = "SELECT
							a.board_idx,
							a.member_idx,
							a.reply_cnt,
							a.contents
						FROM
							tbl_board a
						WHERE
							board_idx = ?

			";

			return $this->query_row($sql,
															array(
															$board_idx
															),
															$data
															);
	}


	/*
	   --------------------------------------------------------
	  |  댓글 및 답글
	  |________________________________________________________
	*/

	// 3. 댓글 리스트
	public function board_comment_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$board_idx = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_reply_idx,
							a.parent_board_reply_idx,
							a.depth,
							a.reply_comment,
							a.display_yn,
							a.del_yn,
							date_format(a.ins_date, '%Y.%m.%d. %H:%i') AS ins_date,
							if(c.member_idx=b.member_idx, 'Y', 'N') as board_member_reply_yn,
							b.member_idx,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							a.relpy_member_idx,
							FN_AES_DECRYPT(d.member_name) AS reply_member_name,
							b.member_img,
							b.del_yn as member_del_yn,
							if(r.board_reply_report_idx>0, 'Y', 'N') as report_yn,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_board_yn
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
							JOIN tbl_board c ON c.board_idx = a.board_idx and c.del_yn='N'
							LEFT JOIN tbl_board_reply_report r ON r.member_idx = '$member_idx' AND r.board_reply_idx = a.board_reply_idx and r.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = a.relpy_member_idx

						WHERE
							 a.depth = 0
							AND a.board_idx = ?
		";

		$sql.=" ORDER BY a.board_reply_idx asc limit ?, ? ";

		$result_list = $this->query_result($sql,
															array(
															$board_idx,
															$page_no,
															$page_size
															),
															$data
															);

		$x = 0;
		$data_array = array();

		foreach ($result_list as $row) {

			$data['parent_board_reply_idx'] = $row->board_reply_idx;
			$data['member_idx'] = $member_idx;

			$data_array[$x]['board_reply_idx']	= $row->board_reply_idx;
			$data_array[$x]['parent_board_reply_idx']	= $row->board_reply_idx;
			$data_array[$x]['depth']	= $row->depth;
			$data_array[$x]['reply_comment']	= $row->reply_comment;
			$data_array[$x]['display_yn']	= $row->display_yn;
			$data_array[$x]['del_yn']	= $row->del_yn;
			$data_array[$x]['member_idx']	= $row->member_idx;
			$data_array[$x]['member_name']	= $row->member_name;
			$data_array[$x]['member_img']	= $row->member_img;
			$data_array[$x]['member_del_yn']	= $row->member_del_yn;
			$data_array[$x]['board_member_reply_yn']	= $row->board_member_reply_yn;
			$data_array[$x]['report_yn']	= $row->report_yn;
			$data_array[$x]['my_board_yn']	= $row->my_board_yn;
			$data_array[$x]['ins_date']	= $row->ins_date;
			$data_array[$x]['relpy_member_idx']	= $row->relpy_member_idx;
			$data_array[$x]['reply_member_name']	= $row->reply_member_name;
			$data_array[$x]['board_reply'] = $this->board_comment_reply_list($data);
			$data_array[$x]['board_reply_cnt'] = $this->board_comment_reply_list_count($data);
			$x++;
		}

		return $data_array;
	}


	// 3. 리스트  count
	public function board_comment_list_count($data){

		$board_idx = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
             	COUNT(*) AS cnt
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							 a.depth = 0
							AND a.board_idx = ?
		";


		return $this->query_cnt($sql,
															array(
															$board_idx,

															),
															$data
															);

	}

	public function board_comment_reply_list($data){

		$parent_board_reply_idx = $data['parent_board_reply_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_reply_idx,
							a.parent_board_reply_idx,
							a.depth,
							a.reply_comment,
							a.display_yn,
							a.del_yn,
							date_format(a.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							b.member_idx,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							a.relpy_member_idx,
							FN_AES_DECRYPT(d.member_name) AS reply_member_name,
							b.member_img,
							if(c.member_idx=b.member_idx, 'Y', 'N') as board_member_reply_yn,
							b.del_yn as member_del_yn,
							if(r.board_reply_report_idx>0, 'Y', 'N') as report_yn,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_board_yn
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
							JOIN tbl_board c ON c.board_idx = a.board_idx and c.del_yn='N'
							LEFT JOIN tbl_board_reply_report r ON r.member_idx = '$member_idx' AND r.board_reply_idx = a.board_reply_idx and r.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = a.relpy_member_idx

						WHERE
							 a.depth = 1
							AND a.parent_board_reply_idx = ?
		";

		$sql.=" ORDER BY a.board_reply_idx ASC LIMIT 1";

		return $this->query_row($sql,array(
																$parent_board_reply_idx),
																$data);

	}

	public function board_comment_reply_list_more($data){

		$parent_board_reply_idx = $data['board_reply_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_reply_idx,
							a.parent_board_reply_idx,
							a.depth,
							a.reply_comment,
							a.display_yn,
							a.del_yn,
							a.relpy_member_idx,
							date_format(a.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							b.member_idx,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							FN_AES_DECRYPT(d.member_name) AS reply_member_name,
							b.member_img,
							if(c.member_idx=b.member_idx, 'Y', 'N') as board_member_reply_yn,
							b.del_yn as member_del_yn,
							if(r.board_reply_report_idx>0, 'Y', 'N') as report_yn,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_board_yn
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
							JOIN tbl_board c ON c.board_idx = a.board_idx and c.del_yn='N'
							LEFT JOIN tbl_board_reply_report r ON r.member_idx = '$member_idx' AND r.board_reply_idx = a.board_reply_idx and r.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = a.relpy_member_idx

						WHERE
							 a.depth = 1
							AND a.parent_board_reply_idx = ?
		";

		$sql.=" ORDER BY a.board_reply_idx ASC";

		return $this->query_result($sql,array(
																$parent_board_reply_idx),
																$data);

	}


	// 3. 리스트  count
	public function board_comment_reply_list_count($data){

		$parent_board_reply_idx = $data['parent_board_reply_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
             	COUNT(*) AS cnt
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							 a.depth = 1
							AND a.parent_board_reply_idx = ?
		";


		return $this->query_cnt($sql,
															array(
															$parent_board_reply_idx,

															),
															$data
															);

	}

	// 댓글 상세
	public function board_reply_detail($data){

		$board_reply_idx = $data['board_reply_idx'];
		$member_idx = $this->member_idx;

		$sql = "SELECT
							a.board_reply_idx,
							a.parent_board_reply_idx,
							a.depth,
							a.reply_comment,
							a.display_yn,
							a.del_yn,
							date_format(a.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							b.member_idx,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							a.relpy_member_idx,
							FN_AES_DECRYPT(d.member_name) AS reply_member_name,
							b.member_img,
							if(c.member_idx=b.member_idx, 'Y', 'N') as board_member_reply_yn,
							b.del_yn as member_del_yn,
							if(r.board_reply_report_idx>0, 'Y', 'N') as report_yn,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_board_yn
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
							JOIN tbl_board c ON c.board_idx = a.board_idx and c.del_yn='N'
							LEFT JOIN tbl_board_reply_report r ON r.member_idx = '$member_idx' AND r.board_reply_idx = a.board_reply_idx and r.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = a.relpy_member_idx
						WHERE
							a.board_reply_idx = ?
		";

		return $this->query_row($sql,array(
																$board_reply_idx),
																$data);

	}


	// 5. 댓글 등록
	public function	board_comment_reg_in($data){
		$member_idx = $data['member_idx'];
		$board_idx = $data['board_idx'];
		$reply_comment = $data['reply_comment'];
		$parent_board_reply_idx = $data['parent_board_reply_idx'];
		$depth = $data['depth'];
		$relpy_member_idx = $data['relpy_member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board_reply
							(
								member_idx,
								board_idx,
								reply_comment,
								parent_board_reply_idx,
								depth,
								relpy_member_idx,
								del_yn,
								ins_date,
								upd_date
							) values (
								?, -- admin_idx
								?, -- board_idx
								?, -- reply_comment
								?, --
								?, -- depth
								?, -- depth
								'N',
								NOW(),
								NOW()
							)
			";

			$this->query($sql,
									array(
									$member_idx,
									$board_idx,
									$reply_comment,
									$parent_board_reply_idx,
									$depth,
									$relpy_member_idx,
									),
									$data
									);

			$board_reply_idx = $this->db->insert_id();

			$sql = "SELECT
	             count(*) as cnt
	           FROM  tbl_board_reply
	           WHERE
	             board_idx = ?
	             AND del_yn = 'N'
	    ";

	    $reply_cnt = $this->query_cnt($sql, array(
																		$board_idx),
																		$data);

			// if ($depth==0) {
			// 	$parent_idx = $board_reply_idx;
			// }else {
			// 	$parent_idx = $parent_board_reply_idx;
			// }
			//
			// $sql = "UPDATE
			// 					tbl_board_reply
			// 				SET
			// 					parent_board_reply_idx = $parent_idx,
			// 					upd_date = NOW()
			// 				WHERE
			// 					board_reply_idx = ?
			// 				";
			//
			// $this->query($sql,
			// 						array(
			// 						$board_reply_idx
			// 						),
			// 						$data
			// 						);

			$sql = "UPDATE
								tbl_board
							SET
								reply_cnt = $reply_cnt,
								upd_date = NOW()
							WHERE
								board_idx = ?
							";

			$this->query($sql,
									array(
									$board_idx
									),
									$data
									);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return $board_reply_idx;
		}
	}


	// 6. 댓글 삭제
	public function board_reply_del($data){
		$board_reply_idx = $data['board_reply_idx'];
		$board_idx = $data['board_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board_reply
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							board_reply_idx = ?
						";

		$this->query($sql,
								array(
								$board_reply_idx
								),
								$data
								);

		$sql = "SELECT
             count(*) as cnt
           FROM  tbl_board_reply
           WHERE
             board_idx = ?
             AND del_yn = 'N'
    ";

    $reply_cnt = $this->query_cnt($sql, array(
																	$board_idx),
																	$data);

		$sql = "UPDATE
							tbl_board
						SET
							reply_cnt = $reply_cnt,
							upd_date = NOW()
						WHERE
							board_idx in (select board_idx from tbl_board_reply where board_reply_idx='$board_reply_idx' )
		";

		$this->query($sql,
								array(
								),
								$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	/*
	   --------------------------------------------------------
	  |  피드 / 댓글 및 답글 신고
	  |________________________________________________________
	*/

	//게시물신고
	public function	board_report_reg_in($data){
		$member_idx     = $data['member_idx'];
		$board_idx     = $data['board_idx'];
		$report_contents = $data['report_contents'];
		$report_type = $data['report_type'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board_report
							(
								member_idx,
								board_idx,
								report_contents,
								report_type,
								del_yn,
								ins_date,
								upd_date
							) values (
								?, -- admin_idx
								?, -- board_idx
								?, -- reply_comment
								?, -- reply_comment
								'N',
								NOW(),
								NOW()
							)
							";

			$this->query($sql,
									array(
									$member_idx,
									$board_idx,
									$report_contents,
									$report_type,
									),
									$data
									);

		$sql = "SELECT
             count(*) as cnt
           FROM  tbl_board_report
           WHERE
             board_idx = ?
             AND del_yn = 'N'
    ";

    $report_cnt = $this->query_cnt($sql, array(
																		$board_idx),
																		$data);


		$sql = "UPDATE
							tbl_board
						SET
							report_cnt = $report_cnt,
							upd_date = NOW()
						WHERE
							board_idx = ?
						";

		$this->query($sql,
								array(
								$board_idx
								),
								$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}


	//대글신고
	public function	board_reply_report_reg_in($data){
		$member_idx     = $data['member_idx'];
		$board_reply_idx     = $data['board_reply_idx'];
		$report_contents = $data['report_contents'];
		$report_type = $data['report_type'];
		$report_position = $data['report_position'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board_reply_report
							(
								member_idx,
								board_reply_idx,
								report_contents,
								report_type,
								report_position,
								del_yn,
								ins_date,
								upd_date
							) values (
								?, -- admin_idx
								?, -- board_idx
								?, -- reply_comment
								?, -- reply_comment
								?, -- reply_comment
								'N',
								NOW(),
								NOW()
							)
							";

			$this->query($sql,
									array(
									$member_idx,
									$board_reply_idx,
									$report_contents,
									$report_type,
									$report_position,
									),
									$data
									);

		$sql = "UPDATE
							tbl_board_reply a,
							(SELECT
									count(*) as cnt
								FROM
									tbl_board_reply_report b
								WHERE
									b.board_reply_idx = '$board_reply_idx'
									AND b.del_yn = 'N'
							) as tb_b
						SET
							a.report_cnt = tb_b.cnt,
							a.upd_date = NOW()
						WHERE
							a.board_reply_idx = ?
						";

		$this->query($sql,
								array(
								$board_reply_idx
								),
								$data
								);


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	/*
	   --------------------------------------------------------
	  |  게시글 /  댓글 및 답글 좋아요
	  |________________________________________________________
	*/

	// 게시글 등록
	public function board_like_reg_in($data){

		$board_idx  = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_board_like
						(
						member_idx,
						board_idx,
						like_yn,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'Y',
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,board_idx=?,like_yn=if(like_yn='N','Y','N'),upd_date=NOW()
		";

		$this->query($sql,array(
									$member_idx,
									$board_idx,
									$member_idx,
									$board_idx,
								 ),$data
							 );

		$sql="UPDATE tbl_board as a,
					(
					 select
						 count(*) as cnt
					 from tbl_board_like
					 where del_yn='N'
					 and board_idx='$board_idx'
					 and like_yn='Y'
					) as b
					set
						like_cnt =b.cnt
					where a.board_idx='$board_idx'
		";
		$this->query($sql,array(

								 ),$data
							 );


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 게시글 등록
	public function board_scrap_reg_in($data){

		$board_idx  = $data['board_idx'];
		$member_idx = $this->member_idx;

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_board_scrap
						(
						member_idx,
						board_idx,
						scrap_yn,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'Y',
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,board_idx=?,scrap_yn=if(scrap_yn='N','Y','N'),upd_date=NOW()
		";

		$this->query($sql,array(
									$member_idx,
									$board_idx,
									$member_idx,
									$board_idx,
								 ),$data
							 );

		$sql = "SELECT
		        count(*) as cnt
		      FROM  tbl_board_scrap
		      WHERE
		        board_idx = ?
		        AND scrap_yn = 'Y'
		        AND del_yn = 'N'
		";

		$scrap_cnt = $this->query_cnt($sql, array(
																		$board_idx),
																		$data);

		$sql="UPDATE
						tbl_board
					set
						scrap_cnt=?
					where
						board_idx=?
		";
		$this->query($sql,array(
									$scrap_cnt,
									$board_idx,
								 ),$data
							 );


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return $scrap_cnt;
		}
	}

	public function board_scrap_cnt($data){

		$member_idx= $data['member_idx'];
		$board_idx = $data['board_idx'];

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_board_scrap a
						WHERE
							a.del_yn = 'N'
							AND a.scrap_yn='Y'
							and a.board_idx='$board_idx'
							and a.member_idx='$member_idx'
		";

		return	$this->query_cnt($sql,array(),$data);

	}

	// 게시글 등록
	public function board_recommend_reg_in($data){

		$board_idx  = $data['board_idx'];
		$member_idx = $this->member_idx;

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_board_recommend
						(
						member_idx,
						board_idx,
						recommend_yn,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'Y',
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,board_idx=?,recommend_yn=if(recommend_yn='N','Y','N'),upd_date=NOW()
		";

		$this->query($sql,array(
									$member_idx,
									$board_idx,
									$member_idx,
									$board_idx,
								 ),$data
							 );

		$sql = "SELECT
		        count(*) as cnt
		      FROM  tbl_board_recommend
		      WHERE
		        board_idx = ?
		        AND recommend_yn = 'Y'
		        AND del_yn = 'N'
		";

		$recommend_cnt = $this->query_cnt($sql, array(
																		$board_idx),
																		$data);

		$sql="UPDATE
						tbl_board
					set
						recommend_cnt=?
					where
						board_idx=?
		";
		$this->query($sql,array(
									$recommend_cnt,
									$board_idx,
								 ),$data
							 );


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return $recommend_cnt;
		}
	}

	public function board_recommend_cnt($data){

		$member_idx= $data['member_idx'];
		$board_idx = $data['board_idx'];

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_board_recommend a
						WHERE
							a.del_yn = 'N'
							AND a.recommend_yn='Y'
							and a.board_idx='$board_idx'
							and a.member_idx='$member_idx'
		";

		return	$this->query_cnt($sql,array(),$data);

	}


}	//클래스의 끝
?>

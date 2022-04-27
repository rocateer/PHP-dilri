<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-15
| Memo : 커뮤니티 관리
|------------------------------------------------------------------------
*/

Class Model_board extends MY_Model{

	// 커뮤니티 리스트
	public function board_list_excel($data){

		$member_name = $data['member_name'];
		$contents = $data['contents'];
		$title = $data['title'];
		$hash_tag = $data['hash_tag'];
		$best_yn = $data['best_yn'];
		$display_yn = $data['display_yn'];
		$orderby = $data['orderby'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							a.board_idx,
							b.member_name,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							a.contents,
							a.recommend_cnt,
							a.view_cnt,
							a.scrap_cnt,
						  a.report_cnt,
						  a.reply_cnt,
							a.display_yn,
							a.best_yn,
							a.ins_date,
							a.upd_date,
							a.del_yn
						FROM
							tbl_board a
							JOIN tbl_member b ON b.member_idx = a.member_idx AND b.del_yn = 'N'
						WHERE
							a.del_yn = 'N'
		";

		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		// if($contents != ""){
		// 	$sql .= " AND a.contents LIKE '%$contents%' ";
		// }
		if($contents != ""){
			$sql .= " AND (select count(*) from tbl_board_reply w where w.board_idx = a.board_idx AND w.del_yn = 'N' AND w.reply_comment LIKE '%$contents%' )>0 ";
		}
		if($title != ""){
			$sql .= " AND a.title LIKE '%$title%' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}
		if($best_yn != ""){
			$sql .= " AND a.best_yn = '$best_yn' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($hash_tag != ""){
			$sql .= " AND a.tags like '%$hash_tag%' ";
		}

		if($orderby != ""){
			if($orderby=="0"){
					$sql .= " ORDER BY a.board_idx DESC ";
			}
			if($orderby=="1"){
					$sql .= " ORDER BY a.recommend_cnt DESC ";
			}
			if($orderby=="2"){
					$sql .= " ORDER BY a.reply_cnt DESC ";
			}
		}else{
			$sql .= " ORDER BY a.board_idx DESC ";
		}

		return $this->query_result($sql,
															 array(),
															 $data
														 );
	}

	// 커뮤니티 리스트
	public function board_list($data){
		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$member_name = $data['member_name'];
		$contents = $data['contents'];
		$title = $data['title'];
		$hash_tag = $data['hash_tag'];
		$best_yn = $data['best_yn'];
		$display_yn = $data['display_yn'];
		$orderby = $data['orderby'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							a.board_idx,
							b.member_name,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							a.contents,
							a.recommend_cnt,
							a.view_cnt,
							a.scrap_cnt,
						  a.report_cnt,
						  a.reply_cnt,
							a.display_yn,
							a.best_yn,
							a.ins_date,
							a.upd_date,
							a.del_yn
						FROM
							tbl_board a
							JOIN tbl_member b ON b.member_idx = a.member_idx AND b.del_yn = 'N'
						WHERE
							a.del_yn = 'N'
		";

		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		// if($contents != ""){
		// 	$sql .= " AND a.contents LIKE '%$contents%' ";
		// }
		if($contents != ""){
			$sql .= " AND (select count(*) from tbl_board_reply w where w.board_idx = a.board_idx AND w.del_yn = 'N' AND w.reply_comment LIKE '%$contents%' )>0 ";
		}
		if($title != ""){
			$sql .= " AND a.title LIKE '%$title%' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}
		if($best_yn != ""){
			$sql .= " AND a.best_yn = '$best_yn' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($hash_tag != ""){
			$sql .= " AND a.tags like '%$hash_tag%' ";
		}

		if($orderby != ""){
			if($orderby=="0"){
					$sql .= " ORDER BY a.board_idx DESC LIMIT ?, ?";
			}
			if($orderby=="1"){
					$sql .= " ORDER BY a.recommend_cnt DESC LIMIT ?, ?";
			}
			if($orderby=="2"){
					$sql .= " ORDER BY a.reply_cnt DESC LIMIT ?, ?";
			}
		}else{
			$sql .= " ORDER BY a.board_idx DESC LIMIT ?, ?";
		}

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data
														 );
	}

	// 커뮤니티 리스트 총 카운트
	public function board_list_count($data){

		$member_name = $data['member_name'];
		$contents = $data['contents'];
		$title = $data['title'];
		$hash_tag = $data['hash_tag'];
		$best_yn = $data['best_yn'];
		$display_yn = $data['display_yn'];
		$orderby = $data['orderby'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board a
							JOIN tbl_member b ON b.member_idx = a.member_idx AND b.del_yn = 'N'
						WHERE
							a.del_yn = 'N'
		";

		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		// if($contents != ""){
		// 	$sql .= " AND a.contents LIKE '%$contents%' ";
		// }
		if($contents != ""){
			$sql .= " AND (select count(*) from tbl_board_reply w where w.board_idx = a.board_idx AND w.del_yn = 'N' AND w.reply_comment LIKE '%$contents%' )>0 ";
		}
		if($title != ""){
			$sql .= " AND a.title LIKE '%$title%' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}
		if($best_yn != ""){
			$sql .= " AND a.best_yn = '$best_yn' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($hash_tag != ""){
			$sql .= " AND a.tags like '%$hash_tag%' ";
		}

		return $this->query_cnt($sql,
													  array(
														),
														$data);
	}

	// 커뮤니티 상세
	public function board_detail($data){

		$board_idx = $data['board_idx'];

		$sql = "SELECT
							FN_AES_DECRYPT(b.member_name) AS member_name,
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
							a.recommend_cnt,
							a.best_yn,
							a.display_yn,
							a.ins_date,
							a.del_yn
						FROM
							tbl_board a
							JOIN tbl_member b ON b.member_idx = a.member_idx AND b.del_yn = 'N'
						WHERE
							a.del_yn = 'N'
							and board_idx=?
		";

   	return $this->query_row($sql,
														array(
													  $board_idx
													  ),
														$data
														);
	}

	// 댓글 답글 리스트
	public function reply_list($data){
		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$board_idx = $data['board_idx'];
	  $member_name = $data['member_name'];
		$orderby = $data['orderby'];

		$sql = "SELECT
							a.board_reply_idx,
							FN_AES_DECRYPT(b.member_name) as member_name,
							FN_AES_DECRYPT(d.member_name) as parent_member_name,
							a.img_path,
							a.report_cnt,
							a.reply_comment,
							a.parent_board_reply_idx,
							a.depth,
							a.ins_date,
							a.upd_date,
							a.del_yn,
							a.display_yn
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx AND b.del_yn = 'N'
							LEFT JOIN tbl_board_reply c ON c.board_reply_idx=a.parent_board_reply_idx  AND 	c.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = c.member_idx AND d.del_yn = 'N'
						WHERE a.del_yn = 'N'
							AND a.board_idx = $board_idx
		";
		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		if($orderby != ""){
			if($orderby=="0"){
					$sql .= " ORDER BY a.report_cnt DESC LIMIT ?, ?";
			}
			if($orderby=="1"){
					$sql .= " ORDER BY a.report_cnt asc LIMIT ?, ?";
			}
			if($orderby=="2"){
					$sql .= " ORDER BY a.board_reply_idx desc LIMIT ?, ?";
			}
			if($orderby=="3"){
					$sql .= " ORDER BY a.board_reply_idx asc LIMIT ?, ?";
			}
		}

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data
														 );
	}

	// 댓글 답글 리스트 count
	public function reply_list_count($data){

		$board_idx = $data['board_idx'];
		$member_name = $data['member_name'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx AND b.del_yn = 'N'
							LEFT JOIN tbl_board_reply c ON c.board_reply_idx=a.parent_board_reply_idx  AND 	c.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = c.member_idx AND d.del_yn = 'N'
						WHERE a.del_yn = 'N'
							AND a.board_idx = $board_idx
		";
		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}

		return $this->query_cnt($sql,
														array(
														),
														$data);
	}

	// 커뮤니티 리스트 총 카운트
	public function best_yn_cnt(){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board a
						WHERE
							a.del_yn = 'N'
							AND a.best_yn = 'Y'
		";

		return $this->query_cnt($sql,array());
	}

	// 노출여부 상태 변경
	public function best_yn_mod_up($data){

		$board_idx  = $data['board_idx'];
		$best_yn = $data['best_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board
						SET
							best_yn = ?,
							upd_date = NOW()
						WHERE
							board_idx = ?
						";

		$this->query($sql,
								 array(
								 $best_yn,
								 $board_idx
							   ),
								 $data
						   );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 노출여부 상태 변경
	public function display_yn_mod_up($data){

		$board_reply_idx  = $data['board_reply_idx'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board_reply
						SET
							display_yn = ?,
							upd_date = NOW()
						WHERE
							board_reply_idx = ?
						";

		$this->query($sql,
								 array(
								 $display_yn,
								 $board_reply_idx
							   ),
								 $data
						   );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	public function board_display_yn_mod_up($data){

		$board_idx  = $data['board_idx'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board
						SET
							display_yn = ?,
							upd_date = NOW()
						WHERE
							board_idx = ?
						";

		$this->query($sql,
								 array(
								 $display_yn,
								 $board_idx
							   ),
								 $data
						   );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

}	//클래스의 끝
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 송민지
| Create-Date : 2021-02-02
|------------------------------------------------------------------------

*/

Class Model_mypage extends MY_Model {

	// 알림 리스트 총 카운트
	public function new_alarm_count(){

		$sql = "SELECT
            	count(*) as cnt
            FROM
            	tbl_alarm
            WHERE
            	del_yn = 'N'
            	AND read_yn = 'N'
              AND member_idx = ?
    ";

		return $this->query_cnt($sql,array($this->member_idx));
	}

	// 회원 정보
	public function mypage_detail() {

		$sql = "SELECT
							member_idx,
							member_img,
							member_join_type,
							FN_AES_DECRYPT(member_name) AS member_name,
							FN_AES_DECRYPT(member_id) AS member_id,
							member_point,
							free_product_cnt,
							good_product_cnt,
							bad_product_cnt,
							del_yn
						FROM
							tbl_member a
						WHERE
							a.member_idx = '$this->member_idx'
						";


		return $this->query_row($sql,
														array(

														)
													);

	}

	public function mypage_detail2() {

		$sql = "SELECT
							IFNULL((SELECT
									COUNT(1) AS cnt
								FROM
									tbl_product AS a
									JOIN tbl_member AS b ON a.member_idx = b.member_idx
								WHERE
									a.del_yn = 'N'
									AND a.member_idx = '$this->member_idx' AND a.product_state IN (0,1)
							),0) as cnt_0,
							IFNULL((SELECT
									COUNT(1) AS cnt
								FROM
									tbl_product AS a
									JOIN tbl_member AS b ON a.member_idx = b.member_idx
								WHERE
									a.del_yn = 'N'
									AND a.member_idx = '$this->member_idx' AND a.product_state IN (2)
							),0) as cnt_1,
							IFNULL((SELECT
									COUNT(1) AS cnt
								FROM
									tbl_product AS a
									JOIN tbl_member AS b ON a.member_idx = b.member_idx
								WHERE
									a.del_yn = 'N'
									AND a.product_member_idx = '$this->member_idx' AND a.product_state IN (2) 
							),0) as cnt_2,
							IFNULL((SELECT
									count(*) as cnt
								FROM
									tbl_board a
									JOIN tbl_member c ON c.member_idx = a.member_idx
									LEFT JOIN tbl_board_scrap t ON t.member_idx = '$this->member_idx' and t.board_idx = a.board_idx and t.del_yn = 'N'
								WHERE
									a.del_yn = 'N'
									and a.member_idx = '$this->member_idx'
							),0) as cnt_3,
							IFNULL((SELECT
									COUNT(*) AS cnt
								FROM
									tbl_board_reply a
									JOIN tbl_member b ON b.member_idx = a.member_idx
									JOIN tbl_board c ON c.board_idx = a.board_idx and c.del_yn='N'
									LEFT JOIN tbl_board_reply_report r ON r.member_idx = '$this->member_idx' AND r.board_reply_idx = a.board_reply_idx and r.del_yn = 'N'
									LEFT JOIN tbl_member d ON d.member_idx = a.relpy_member_idx
								WHERE
									a.del_yn='N'
									AND a.member_idx = '$this->member_idx'
							),0) as cnt_4,
							IFNULL((SELECT
									count(*) as cnt
								FROM
									tbl_board_scrap z
									JOIN tbl_board a ON a.board_idx = z.board_idx and a.del_yn='N'
									JOIN tbl_member c ON c.member_idx = a.member_idx
									LEFT JOIN tbl_board_scrap t ON t.member_idx = '$this->member_idx' and t.board_idx = a.board_idx and t.del_yn = 'N'
									LEFT JOIN tbl_board_report r ON r.member_idx = '$this->member_idx' AND r.board_idx = a.board_idx and r.del_yn = 'N'

								WHERE
									z.del_yn = 'N'
									and z.member_idx = '$this->member_idx'
									AND z.scrap_yn = 'Y'
							),0) as cnt_5,
							IFNULL((SELECT
									COUNT(1) AS cnt
								FROM
									tbl_product_like z
									JOIN tbl_product AS a ON a.product_idx = z.product_idx
									JOIN tbl_member AS b ON a.member_idx = b.member_idx
								WHERE
									z.member_idx = '$this->member_idx'
									AND z.like_yn = 'Y'
									AND z.del_yn = 'N'
									AND a.display_yn = 'Y'
							),0) as cnt_6
						";


		return $this->query_row($sql,
														array(

														)
													);

	}

	// 포인트 상세
	public function point_detail(){
		$member_idx = $this->member_idx;

		$sql = "SELECT
							member_point
						FROM
							tbl_member
						WHERE
							member_idx = ?
		";

		return $this->query_row($sql,
															array
															(
															$member_idx
															)
														);

	}

	// 포인트 날짜 리스트
	public function point_date_list($data){
		$member_idx = $this->member_idx;

		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$sql = "SELECT
							DATE_FORMAT(ins_date,'%Y-%m-%d') as ins_date
						FROM
							tbl_member_point
						WHERE
							member_idx = ?
							AND del_yn = 'N'
						GROUP BY DATE_FORMAT(ins_date,'%Y-%m-%d')
						ORDER BY member_point_idx DESC LIMIT ?, ?
 					";

		return $this->query_result($sql,
															array(
															$member_idx,
															$page_no,
															$page_size
															),
															$data
															);

	}

	// 포인트 날짜 리스트 카운트
	public function point_date_list_count(){
		$member_idx = $this->member_idx;

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM (
							SELECT
								*
							FROM
								tbl_member_point
							WHERE
								member_idx = ?
								AND del_yn = 'N'
							GROUP BY DATE_FORMAT(ins_date,'%Y-%m-%d')
						)ta
					 ";

		return $this->query_cnt($sql,
														array
														(
														$member_idx
														)
													);
	}

	// 포인트 리스트
	public function point_list($data){
		$member_idx = $this->member_idx;

		$sql = "SELECT
							DATE_FORMAT(ins_date,'%Y-%m-%d') AS ins_date,
							memo,
							point_type,
							point
						FROM
							tbl_member_point
						WHERE
							member_idx = ?
							AND del_yn = 'N'
							AND DATE_FORMAT(ins_date,'%Y-%m-%d')
							IN (SELECT
										DATE_FORMAT(ins_date, '%Y-%m-%d')
									FROM
										tbl_member_point
									WHERE
										member_idx = ?)
						ORDER BY member_point_idx DESC
		      ";

		return $this->query_result($sql,
															array(
															$member_idx,
															$member_idx
															),
															$data
															);

	}

	// 포인트 리스트 카운트
	public function point_list_count(){
		$member_idx = $this->member_idx;

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_member_point
						WHERE
							member_idx = ?

		";

		return $this->query_cnt($sql,
														array
														(
														$member_idx
														)
													);
	}


	// 상품 리스트 가져오기
	public function product_list($data){
		$page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];
		$tab_type = $data['tab_type'];

		$sql = "SELECT
							a.product_idx,
							a.member_idx,
							ifnull(t.like_yn, 'N') as like_yn,

							a.img_path,
							a.product_state,
							a.product_price,
							a.free_product_yn,
							a.title,
							a.product_addr,
							a.product_lat,
							a.product_lng,
							a.chatting_cnt,
							a.like_cnt,
							a.list_up_cnt,
							a.upd_date,
							a.ins_date,
							a.list_up_date,
							ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 1) as distance,
							b.good_product_cnt,
							b.bad_product_cnt,
							a.seller_review_yn,
							a.buyer_review_yn,
							a.display_yn,
							b.del_yn
						FROM
							tbl_product AS a
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
							LEFT JOIN tbl_product_like t ON t.member_idx = '$this->member_idx' AND t.product_idx = a.product_idx and t.del_yn = 'N'

						WHERE
							a.del_yn = 'N'
		";

		if($tab_type =="0"){
			$sql .=" AND a.member_idx = '$this->member_idx' AND a.product_state IN (0,1) ";

			$sql .= "ORDER BY a.list_up_date DESC limit ?, ? ";

		}elseif ($tab_type =="1") {
			$sql .=" AND a.member_idx = '$this->member_idx' AND a.product_state IN (2) ";

			$sql .= "ORDER BY a.complete_date DESC limit ?, ? ";

		}elseif ($tab_type =="2") {
			$sql .=" AND a.product_member_idx = '$this->member_idx' AND a.product_state IN (2) ";

			$sql .= "ORDER BY a.complete_date DESC limit ?, ? ";
		}

		return	$this->query_result($sql,array(
																$page_no,
																$page_size),
																$data);
	}

	// 상품 리스트 카운트
	public function product_list_count($data){

		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];
		$tab_type = $data['tab_type'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_product AS a
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							a.del_yn = 'N'
		";

		if($tab_type =="0"){
			$sql .=" AND a.member_idx = '$this->member_idx' AND a.product_state IN (0,1) ";
		}elseif ($tab_type =="1") {
			$sql .=" AND a.member_idx = '$this->member_idx' AND a.product_state IN (2) ";
		}elseif ($tab_type =="2") {
			$sql .=" AND a.product_member_idx = '$this->member_idx' AND a.product_state IN (2) ";
		}

		return $this->query_cnt($sql, array());
	}

	// 판매내역_찜 내역 가져오기
	public function product_like_list($data){
		$page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];
		$tab_type = $data['tab_type'];

		$sql = "SELECT
							a.product_idx,
							ifnull(z.like_yn, 'N') as like_yn,

							a.member_idx,
							a.img_path,
							a.product_state,
							a.product_price,
							a.free_product_yn,
							a.title,
							a.product_addr,
							a.product_lat,
							a.product_lng,
							a.chatting_cnt,
							a.like_cnt,
							a.list_up_cnt,
							a.upd_date,
							a.ins_date,
							a.list_up_date,
							a.display_yn,
							ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 1) as distance,
							b.good_product_cnt,
							b.bad_product_cnt,
							b.del_yn
						FROM
							tbl_product_like z
							JOIN tbl_product AS a ON a.product_idx = z.product_idx
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							z.member_idx = '$this->member_idx'
							AND z.like_yn = 'Y'
							AND z.del_yn = 'N'
							AND a.display_yn = 'Y'
		";

		$sql .= "ORDER BY z.upd_date DESC limit ?, ? ";

		return	$this->query_result($sql,array(
																$page_no,
																$page_size),
																$data);
	}

	// 판매내역_찜 내역 카운트
	public function product_like_list_count($data){

		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];
		$tab_type = $data['tab_type'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_product_like z
							JOIN tbl_product AS a ON a.product_idx = z.product_idx
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							z.member_idx = '$this->member_idx'
							AND z.like_yn = 'Y'
							AND z.del_yn = 'N'
							AND a.display_yn = 'Y'
		";

		return $this->query_cnt($sql, array());
	}

	// 커뮤니티 목록
	public function my_baord_list($data){
		$page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];
		$tab_type = $data['tab_type'];

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
							c.del_yn as member_del_yn,
							a.display_yn,
							DATE_FORMAT(a.ins_date, '%Y-%m-%d %H:%i:%s') as ins_date,
							if(t.scrap_yn='Y', 'Y', 'N') as scrap_yn,
							if(r.board_report_idx>0, 'Y', 'N') as report_yn,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_board_yn

						FROM
							tbl_board a
							JOIN tbl_member c ON c.member_idx = a.member_idx
							LEFT JOIN tbl_board_scrap t ON t.member_idx = '$this->member_idx' AND t.board_idx = a.board_idx and t.del_yn = 'N'
							LEFT JOIN tbl_board_report r ON r.member_idx = '$this->member_idx' AND r.board_idx = a.board_idx and r.del_yn = 'N'

						WHERE
							a.del_yn = 'N'
							and a.member_idx = '$this->member_idx'
		";

		$sql .= "ORDER BY a.board_idx DESC limit ?, ? ";

		return	$this->query_result($sql,array(
																$page_no,
																$page_size),
																$data);
	}

	// 커뮤니티 목록수
	public function my_baord_list_count($data){
		$tab_type = $data['tab_type'];

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_board a
							JOIN tbl_member c ON c.member_idx = a.member_idx
							LEFT JOIN tbl_board_scrap t ON t.member_idx = '$this->member_idx' and t.board_idx = a.board_idx and t.del_yn = 'N'
						WHERE
							a.del_yn = 'N'
							and a.member_idx = '$this->member_idx'
		";

		return	$this->query_cnt($sql,array(),$data);

	}

	// 커뮤니티_내 댓글
	public function my_board_reply_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$tab_type = $data['tab_type'];

		$sql = "SELECT
							a.board_idx,
							a.board_reply_idx,
							a.parent_board_reply_idx,
							a.depth,
							a.reply_comment,
							a.display_yn,
							a.del_yn,
							c.img_path,
							date_format(a.ins_date, '%Y.%m.%d. %H:%i') AS ins_date,
							if(c.member_idx=b.member_idx, 'Y', 'N') as board_member_reply_yn,
							b.member_idx,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							r.relpy_member_idx,
							FN_AES_DECRYPT(d.member_name) AS reply_member_name,
							b.member_img,
							b.del_yn as member_del_yn,
							if(r.board_reply_report_idx>0, 'Y', 'N') as report_yn,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_board_yn
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
							JOIN tbl_board c ON c.board_idx = a.board_idx and c.del_yn='N'
							LEFT JOIN tbl_board_reply_report r ON r.member_idx = '$this->member_idx' AND r.board_reply_idx = a.board_reply_idx and r.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = a.relpy_member_idx

						WHERE
							a.del_yn='N'
							AND a.member_idx = '$this->member_idx'
		";

		$sql.=" ORDER BY a.board_reply_idx DESC limit ?, ? ";

		return $this->query_result($sql,
															array(
															$page_no,
															$page_size
															),
															$data
															);

	}


	// 커뮤니티_내 댓글  count
	public function my_board_reply_list_count($data){

		$tab_type = $data['tab_type'];


		$sql = "SELECT
             	COUNT(*) AS cnt
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
							JOIN tbl_board c ON c.board_idx = a.board_idx and c.del_yn='N'
							LEFT JOIN tbl_board_reply_report r ON r.member_idx = '$this->member_idx' AND r.board_reply_idx = a.board_reply_idx and r.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = a.relpy_member_idx
						WHERE
							a.del_yn='N'
							AND a.member_idx = '$this->member_idx'
		";


		return $this->query_cnt($sql,
															array(
															),
															$data
															);

	}

	// 커뮤니티 목록
	public function board_scrap_list($data){
		$page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];
		$tab_type = $data['tab_type'];

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
							c.del_yn as member_del_yn,
							a.display_yn,
							DATE_FORMAT(a.ins_date, '%Y-%m-%d %H:%i:%s') as ins_date,
							if(z.scrap_yn='Y', 'Y', 'N') as scrap_yn,
							if(r.board_report_idx>0, 'Y', 'N') as report_yn,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_board_yn

						FROM
							tbl_board_scrap z
							JOIN tbl_board a ON a.board_idx = z.board_idx and a.del_yn='N'
							JOIN tbl_member c ON c.member_idx = a.member_idx
							LEFT JOIN tbl_board_report r ON r.member_idx = '$this->member_idx' AND r.board_idx = a.board_idx and r.del_yn = 'N'

						WHERE
							z.del_yn = 'N'
							and z.member_idx = '$this->member_idx'
							AND z.scrap_yn = 'Y'
		";

		$sql .= "ORDER BY z.upd_date DESC limit ?, ? ";

		return	$this->query_result($sql,array(
																$page_no,
																$page_size),
																$data);
	}

	// 커뮤니티 목록수
	public function board_scrap_list_count($data){
		$tab_type = $data['tab_type'];

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_board_scrap z
							JOIN tbl_board a ON a.board_idx = z.board_idx and a.del_yn='N'
							JOIN tbl_member c ON c.member_idx = a.member_idx
							LEFT JOIN tbl_board_scrap t ON t.member_idx = '$this->member_idx' and t.board_idx = a.board_idx and t.del_yn = 'N'
							LEFT JOIN tbl_board_report r ON r.member_idx = '$this->member_idx' AND r.board_idx = a.board_idx and r.del_yn = 'N'

						WHERE
							z.del_yn = 'N'
							and z.member_idx = '$this->member_idx'
							AND z.scrap_yn = 'Y'
		";

		return	$this->query_cnt($sql,array(),$data);

	}

}
?>

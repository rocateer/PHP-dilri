<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-10-26
| Memo : 검색
|------------------------------------------------------------------------
*/

Class Model_search extends MY_Model{


	// 내 정보
	public function member_detail(){

		$member_idx = $this->member_idx;

		$sql = "SELECT
							a.member_idx,
							a.member_join_type,
							a.member_img,
							a.member_location_idx,
							FN_AES_DECRYPT(a.member_id) AS member_id,
							FN_AES_DECRYPT(a.member_name) AS member_name,
							FN_AES_DECRYPT(a.member_phone) AS member_phone,
							a.member_gender,
							b.member_addr,
							b.member_lat,
							b.member_lng,
							b.title,
							b.distance
						FROM
							tbl_member a
							LEFT JOIN tbl_member_location b ON b.member_location_idx = a.member_location_idx AND b.del_yn='N'
						WHERE
							a.member_idx = ?
						";

		return  $this->query_row($sql,
														array(
														$member_idx
														)
														);
	}

	// 카테고리
	public function category_management_list() {

		$sql = "SELECT
							category_management_idx,
							category_name,
							img_path,
							order_no
						FROM
							tbl_category_management
						where
							state = '1'
						order by order_no ASC
		";

		return $this->query_result($sql, array());
	}

	// 인기 검색어(관리자 추천 검색어)
	public function recommend_search_list($data) {
		$type = $data['type'];

		$sql = "SELECT
							recommend_search_idx,
							title,
							type,
							display_yn,
							order_no
						FROM
							tbl_recommend_search
						where
							type = '$type'
							AND display_yn = 'Y'
						order by recommend_search_idx
		";

		return $this->query_result($sql, array());
	}

	// 커뮤니티 목록
	public function board_list($data){
		$page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

		$search_text = $data['search_text'];

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
							JOIN tbl_member c ON c.member_idx = a.member_idx and c.del_yn='N'
							LEFT JOIN tbl_board_scrap t ON t.member_idx = '$this->member_idx' AND t.board_idx = a.board_idx and t.del_yn = 'N'
							LEFT JOIN tbl_board_report r ON r.member_idx = '$this->member_idx' AND r.board_idx = a.board_idx and r.del_yn = 'N'
							LEFT JOIN tbl_board_recommend s ON s.member_idx = '$this->member_idx' and s.board_idx = a.board_idx and s.del_yn = 'N'

						WHERE
							a.del_yn = 'N'
							and a.display_yn='Y'
		";

		if($search_text != ""){
      $sql .= " AND ( a.tags LIKE '%$search_text%' OR a.contents LIKE '%$search_text%' )";
    }

		$sql .= "ORDER BY a.best_yn DESC, a.board_idx DESC limit ?, ? ";

		return	$this->query_result($sql,array(
																$page_no,
																$page_size),
																$data);
	}

	// 커뮤니티 목록수
	public function board_list_count($data){

		$search_text = $data['search_text'];

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_board a
							JOIN tbl_member c ON c.member_idx = a.member_idx and c.del_yn='N'
							LEFT JOIN tbl_board_scrap t ON t.member_idx = '$this->member_idx' and t.scrap_yn = 'Y' and t.del_yn = 'N'
						WHERE
							a.del_yn = 'N'
							and a.display_yn='Y'
		";

		if($search_text != ""){
      $sql .= " AND ( a.tags LIKE '%$search_text%' OR a.contents LIKE '%$search_text%' )";
    }

		return	$this->query_cnt($sql,array(),$data);

	}


	// 상품 리스트 가져오기
	public function famous_product_list($data){

		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];

		$sql = "SELECT
							a.product_idx,
							ifnull(t.like_yn, 'N') as like_yn,

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
							tbl_product AS a
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
							LEFT JOIN tbl_product_like t ON t.member_idx = '$this->member_idx' AND t.product_idx = a.product_idx and t.del_yn = 'N'

						WHERE
							a.del_yn = 'N'
							AND a.famous_product_yn = 'Y'
							-- AND a.product_state IN (0,1)
							-- AND a.display_yn = 'Y'
						ORDER BY distance ASC, a.product_idx DESC
		";

		return $this->query_result($sql, array());
	}

	// 상품 리스트 가져오기
	public function product_list_get($data){

		$search_text = $data['search_text'];
		$category_management_idx = $data['category_management_idx'];
		$s_product_price = $data['s_product_price'];
		$e_product_price = $data['e_product_price'];
		$free_product_yn = $data['free_product_yn'];
		$limit_distance = $data['limit_distance'];
		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];

		$sql = "SELECT
							a.product_idx,
							ifnull(t.like_yn, 'N') as like_yn,

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
							tbl_product AS a
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
							LEFT JOIN tbl_product_like t ON t.member_idx = '$this->member_idx' AND t.product_idx = a.product_idx and t.del_yn = 'N'

						WHERE
							a.del_yn = 'N'
							-- AND a.display_yn = 'Y'
		";

		if($search_text != ""){
      $sql .= " AND (a.title LIKE '%$search_text%' OR a.contents LIKE '%$search_text%' OR a.tags LIKE '%$search_text%' )";
    }
		if($category_management_idx !=""){
			$sql .=" AND FIND_IN_SET(a.category_management_idx, '$category_management_idx') > 0  ";
		}
		if($s_product_price != ""){
			$sql .= " AND a.product_price >= '$s_product_price' ";
		}
		if($e_product_price != ""){
			$sql .= " AND a.product_price <= '$e_product_price' ";
		}
		if($free_product_yn != ""){
			$sql .= " AND a.free_product_yn = '$free_product_yn' ";
		}
		if($limit_distance != ""){
			$sql .= " AND ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 3) <= $limit_distance  ";
		}

		return $this->query_result($sql, array(),$data);
	}

	// 상품 리스트 카운트
	public function product_list_count($data){

		$search_text = $data['search_text'];
		$category_management_idx = $data['category_management_idx'];
		$s_product_price = $data['s_product_price'];
		$e_product_price = $data['e_product_price'];
		$free_product_yn = $data['free_product_yn'];
		$limit_distance = $data['limit_distance'];
		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_product AS a
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							a.del_yn = 'N'
							-- AND a.display_yn = 'Y'
		";

		if($search_text != ""){
      $sql .= " AND (a.title LIKE '%$search_text%' OR a.contents LIKE '%$search_text%' OR a.tags LIKE '%$search_text%' )";
    }
		if($category_management_idx !=""){
			$sql .=" AND FIND_IN_SET(a.category_management_idx, '$category_management_idx') > 0  ";
		}
		if($s_product_price != ""){
			$sql .= " AND a.product_price >= '$s_product_price' ";
		}
		if($e_product_price != ""){
			$sql .= " AND a.product_price <= '$e_product_price' ";
		}
		if($free_product_yn != ""){
			$sql .= " AND a.free_product_yn = '$free_product_yn' ";
		}
		if($limit_distance != ""){
			$sql .= " AND ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 3) <= $limit_distance  ";
		}

		return $this->query_cnt($sql, array(),$data);
	}


	// 최근 검색어
	public function recent_search_list() {

		$sql = "SELECT
							search_idx,
							title
						FROM
							tbl_search
						WHERE
							del_yn ='N'
							AND member_idx = ?
							AND search_type = '0'
						";

		$sql .= " ORDER BY upd_date DESC LIMIT 5 ";

		return $this->query_result($sql,array(
															 $this->member_idx
															 )
													 	 );
	}

	// 최근 검색어 등록
	public function search_reg_in($data){

		$title = $data['search_text'];
		$search_type = $data['search_type'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_search
						(
							member_idx,
							title,
							search_type,
							search_cnt,
							del_yn,
							ins_date,
							upd_date
						) VALUES (
							?,
							?,
							?,
							1,
							'N',
							NOW(),
							NOW()
						)
						ON DUPLICATE KEY UPDATE del_yn='N',search_cnt=search_cnt+1,upd_date=NOW()
						";

		$this->query($sql,array(
								 $this->member_idx,
								 $title,
								 $search_type
								 ),$data
							 );

		$search_idx = $this->db->insert_id();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return $search_idx;
		}

	}

	// 최근 검색어 삭제
	public function search_del($data){
		$search_idx = $data['search_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_search
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							search_idx IN ($search_idx)
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

	// 검색어 전체 삭제
	public function search_del_all(){

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_search
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							member_idx = '$this->member_idx'
		";

		$this->query($sql,
								array(
								)
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}




}	//클래스의 끝
?>

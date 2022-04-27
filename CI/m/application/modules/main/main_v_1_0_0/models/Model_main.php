<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	심정민
| Create-Date : 2021-10-25
| Memo : 메인
|------------------------------------------------------------------------
*/

class Model_main extends MY_Model{

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

	// 내 정보
	public function member_detail(){

		$member_idx = $this->member_idx;

		$sql = "SELECT
							a.member_idx,
							a.member_join_type,
							a.member_img,
							a.member_location_idx,
							a.category_management_idx,
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

	// 내가 저장한 위치 가져오기
	public function member_location_list() {

		$sql = "SELECT
							member_location_idx,
							member_addr,
							member_lat,
							member_lng,
							title,
							distance
						FROM
							tbl_member_location
						WHERE
							member_idx = '$this->member_idx'
							AND del_yn = 'N'
						ORDER BY title ASC
		";

		return $this->query_result($sql, array());
	}

	// 최근 검색어 삭제
	public function member_location_del($data){
		$member_location_idx = $data['member_location_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member_location
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							member_location_idx IN ($member_location_idx)
		";

		$this->query($sql,
								array(
								),
								$data
								);

		// 삭제 시 내 위치를 현재 위치로 변경
		$sql = "UPDATE
							tbl_member
						SET
							member_location_idx = '0',
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

		$this->query($sql,array(
									$this->member_idx
								 ),$data
							 );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// 최근 검색어 등록
	public function member_location_reg_in($data){

		$member_addr = $data['member_addr'];
		$member_lat = $data['member_lat'];
		$member_lng = $data['member_lng'];
		$title = $data['title'];
		$distance = $data['distance'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_member_location
						(
							member_idx,
							member_addr,
							member_lat,
							member_lng,
							title,
							distance,
							del_yn,
							ins_date,
							upd_date
						) VALUES (
							?,
							?,
							?,
							?,
							?,
							?,
							'N',
							NOW(),
							NOW()
						)
						";

		$this->query($sql,array(
								 $this->member_idx,
								 $member_addr,
								 $member_lat,
								 $member_lng,
								 $title,
								 $distance,
								 ),$data
							 );

		$member_location_idx = $this->db->insert_id();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return $member_location_idx;
		}

	}

	// 주소 지정
	public function my_location_mod_up($data){
		$member_location_idx = $data['member_location_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							member_location_idx = ?,
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

		$this->query($sql,array(
									$member_location_idx,
									$this->member_idx
								 ),$data
							 );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// 카테고리 저장
	public function category_management_idx_mod_up($data){
		$category_management_idx = $data['category_management_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							category_management_idx = ?,
							upd_date = NOW()
						WHERE
							member_idx = '$this->member_idx'
					";

		$this->query($sql,
									array(
									$category_management_idx
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

	// 공지사항 가져오기
	public function notice_get() {

		$sql = "SELECT
							notice_idx,
							title,
							notice_type
						FROM
							tbl_notice
						WHERE
							notice_state = 'Y'
							AND del_yn = 'N'

						ORDER BY
							ins_date DESC
						LIMIT 1
		";

		return $this->query_row($sql, array());
	}

	// 배너 가져오기
	public function banner_get() {

		$sql = "SELECT
							banner_idx,
							img_path,
							link_url
						FROM
							tbl_banner
						WHERE
							banner_type = 0
							AND `state` = 1
						ORDER BY
							RAND()
						LIMIT 1
		";

		return $this->query_row($sql, array());
	}

	// 상품 리스트 가져오기
	public function product_list_get($data){
		$page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];
		$distance = $data['distance'];
		$category_management_idx = $data['category_management_idx'];

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
							a.display_yn,
							a.list_up_date,
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
							AND a.display_yn = 'Y'
		";

		if($category_management_idx !=""){
			$sql .=" AND FIND_IN_SET(a.category_management_idx, '$category_management_idx') > 0  ";
		}
		if($distance !=""){
			$sql .=" AND ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 1) <= $distance  ";
		}

		$sql .= "ORDER BY a.list_up_date DESC limit ?, ? ";


		return	$this->query_result($sql,array(
																$page_no,
																$page_size),
																$data);
	}

	// 상품 리스트 카운트
	public function product_list_count($data){

		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];
		$distance = $data['distance'];
		$category_management_idx = $data['category_management_idx'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_product AS a JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							a.del_yn = 'N'
							AND a.display_yn = 'Y'
		";

		if($category_management_idx !=""){
			$sql .=" AND FIND_IN_SET(a.category_management_idx, '$category_management_idx') > 0  ";
		}
		if($distance !=""){
			$sql .=" AND ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 1) <= $distance  ";
		}

		return $this->query_cnt($sql, array());
	}

	// gcm_key,device_os 업데이트
	public function member_gcm_device_up($data) {
	 $member_idx=$data['member_idx'];
	 $gcm_key=$data['gcm_key'];
	 $device_os=$data['device_os'];

	 $this->db->trans_begin();

	 $sql="UPDATE
					 tbl_member
				 SET
					 gcm_key = ?,
					 device_os = ?,
					 upd_date = NOW()
				 WHERE
					 member_idx = ?
	 ";

	 $this->query($sql,
							 array(
							 $gcm_key,
							 $device_os,
							 $member_idx
							 ),
							 $data);

	 if($this->db->trans_status() === FALSE){
		 $this->db->trans_rollback();
		 return "0";
	 }else{
		 $this->db->trans_commit();
		 return "1";
	 }
	}

} // 클래스의 끝
?>

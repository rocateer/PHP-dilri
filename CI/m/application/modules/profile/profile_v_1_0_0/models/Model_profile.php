<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 송민지
| Create-Date : 2021-02-02
|------------------------------------------------------------------------

*/

Class Model_profile extends MY_Model {

	// 회원 정보
	public function profile_detail($data) {
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							member_idx,
							member_img,
							FN_AES_DECRYPT(member_name) AS member_name,
							FN_AES_DECRYPT(member_id) AS member_id,
							member_point,
							my_badge,
							my_badge_types,
							free_product_cnt,
							good_product_cnt,
							bad_product_cnt,
							free_product_cnt,
							free_product_cnt_0,
							free_product_cnt_1,
							free_product_cnt_2,
							free_product_cnt_3,
							free_product_cnt_4,
							free_product_cnt_5,
							free_product_cnt_6,
							free_product_cnt_7,
							free_product_cnt_8,
							good_product_cnt,
							good_product_cnt_0,
							good_product_cnt_1,
							good_product_cnt_2,
							good_product_cnt_3,
							good_product_cnt_4,
							bad_product_cnt,
							bad_product_cnt_0,
							bad_product_cnt_1,
							bad_product_cnt_2,
							bad_product_cnt_3,
							bad_product_cnt_4,
							bad_product_cnt_5,
							bad_product_cnt_6,
							bad_product_cnt_7,
							del_yn
						FROM
							tbl_member a
						WHERE
							a.member_idx = '$member_idx'
						";


		return $this->query_row($sql,
														array(
															
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
		$member_idx = $data['member_idx'];
		
		$sql = "SELECT
							a.product_idx,
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
							ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 1) as distance,
							b.good_product_cnt,
							b.bad_product_cnt,
							a.seller_review_yn,
							a.buyer_review_yn,
							b.del_yn									
						FROM
							tbl_product AS a 
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							a.del_yn = 'N'
							AND a.member_idx = '$member_idx'
		";
		
		$sql .= "ORDER BY a.product_idx DESC limit ?, ? ";
		
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
		$member_idx = $data['member_idx'];
		
		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_product AS a 
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							a.del_yn = 'N'
							AND a.member_idx = '$member_idx'
		";

		return $this->query_cnt($sql, array());
	}
	

}
?>

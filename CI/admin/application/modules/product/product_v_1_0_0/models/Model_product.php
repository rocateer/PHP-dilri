<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-15
| Memo : 커뮤니티 관리
|------------------------------------------------------------------------
*/

Class Model_product extends MY_Model{

	// 커뮤니티 리스트
	public function product_list($data){
		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$member_id = $data['member_id'];
		$member_name = $data['member_name'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$title = $data['title'];
		$category_name = $data['category_name'];
		$tags = $data['tags'];
		$product_state = $data['product_state'];
		$display_yn = $data['display_yn'];
		$free_product_yn = $data['free_product_yn'];
		$famous_product_yn = $data['famous_product_yn'];

		$sql = "SELECT
							a.product_idx,
							FN_AES_DECRYPT(b.member_id) AS member_id,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							FN_AES_DECRYPT(c.member_id) AS partner_member_id,
							FN_AES_DECRYPT(c.member_name) AS partner_member_name,
							d.category_name,
						  a.img_path,
						  a.title,
							a.tags,
							a.report_cnt,
							a.product_state,
							a.product_price,
							a.display_yn,
							a.free_product_yn,
							a.famous_product_yn,
							a.ins_date,
							a.upd_date,
							a.del_yn
						FROM
							tbl_product a
							JOIN tbl_member b ON b.member_idx = a.member_idx AND b.del_yn != 'Y'
							LEFT JOIN tbl_member AS c ON c.member_idx = a.product_member_idx
							JOIN tbl_category_management d ON d.category_management_idx = a.category_management_idx AND d.del_yn = 'N'
							
						WHERE
							a.del_yn = 'N'
		";

		if($member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}
		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($title != ""){
			$sql .= " AND a.title LIKE '%$title%' ";
		}
		if($category_name != ""){
			$sql .= " AND d.category_name LIKE '%$category_name%' ";
		}
		if($tags != ""){
			$sql .= " AND a.tags LIKE '%$tags%' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}
		if($product_state != ""){
			$sql .= " AND a.product_state = '$product_state' ";
		}
		if($free_product_yn != ""){
			$sql .= " AND a.free_product_yn = '$free_product_yn' ";
		}
		if($famous_product_yn != ""){
			$sql .= " AND a.famous_product_yn = '$famous_product_yn' ";
		}

		$sql .= " ORDER BY a.product_idx DESC LIMIT ?, ?";

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data
														 );
	}

	// 커뮤니티 리스트 총 카운트
	public function product_list_count($data){

		$member_id = $data['member_id'];
		$member_name = $data['member_name'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$title = $data['title'];
		$category_name = $data['category_name'];
		$tags = $data['tags'];
		$product_state = $data['product_state'];
		$display_yn = $data['display_yn'];
		$free_product_yn = $data['free_product_yn'];
		$famous_product_yn = $data['famous_product_yn'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_product a
							JOIN tbl_member b ON b.member_idx = a.member_idx AND b.del_yn != 'Y'
							LEFT JOIN tbl_member AS c ON c.member_idx = a.product_member_idx
							JOIN tbl_category_management d ON d.category_management_idx = a.category_management_idx AND d.del_yn = 'N'
							
						WHERE
							a.del_yn = 'N'
		";

		if($member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}
		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($title != ""){
			$sql .= " AND a.title LIKE '%$title%' ";
		}
		if($category_name != ""){
			$sql .= " AND d.category_name LIKE '%$category_name%' ";
		}
		if($tags != ""){
			$sql .= " AND a.tags LIKE '%$tags%' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}
		if($product_state != ""){
			$sql .= " AND a.product_state = '$product_state' ";
		}
		if($free_product_yn != ""){
			$sql .= " AND a.free_product_yn = '$free_product_yn' ";
		}
		if($famous_product_yn != ""){
			$sql .= " AND a.famous_product_yn = '$famous_product_yn' ";
		}
		
		return $this->query_cnt($sql,
													  array(
														), 
														$data);
	}
	
	// 엑셀다운론드
	public function product_list_excel($data){

		$member_id = $data['member_id'];
		$member_name = $data['member_name'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$title = $data['title'];
		$category_name = $data['category_name'];
		$tags = $data['tags'];
		$product_state = $data['product_state'];
		$display_yn = $data['display_yn'];
		$free_product_yn = $data['free_product_yn'];
		$famous_product_yn = $data['famous_product_yn'];

		$sql = "SELECT
							a.product_idx,
							FN_AES_DECRYPT(b.member_id) AS member_id,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							FN_AES_DECRYPT(c.member_name) AS partner_member_name,
							FN_AES_DECRYPT(c.member_id) AS partner_member_id,
							d.category_name,
						  a.title,
							a.tags,
							a.report_cnt,
							a.product_state,
							a.product_price,
							a.display_yn,
							a.free_product_yn,
							a.famous_product_yn,
							a.ins_date,
							a.upd_date,
							a.del_yn
						FROM
							tbl_product a
							JOIN tbl_member b ON b.member_idx = a.member_idx AND b.del_yn = 'N'
							LEFT JOIN tbl_member AS c ON c.member_idx = a.product_member_idx
							JOIN tbl_category_management d ON d.category_management_idx = a.category_management_idx AND d.del_yn = 'N'
							
						WHERE
							a.del_yn = 'N'
		";

		if($member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}
		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($title != ""){
			$sql .= " AND a.title LIKE '%$title%' ";
		}
		if($category_name != ""){
			$sql .= " AND d.category_name LIKE '%$category_name%' ";
		}
		if($tags != ""){
			$sql .= " AND a.tags LIKE '%$tags%' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}
		if($product_state != ""){
			$sql .= " AND a.product_state = '$product_state' ";
		}
		if($free_product_yn != ""){
			$sql .= " AND a.free_product_yn = '$free_product_yn' ";
		}
		if($famous_product_yn != ""){
			$sql .= " AND a.famous_product_yn = '$famous_product_yn' ";
		}

		$sql .= " ORDER BY a.product_idx DESC";

		return $this->query_result($sql,
															 array(),
															 $data
														 );
	}

	// 상세
	public function product_detail($data) {
		$product_idx = $data['product_idx'];
		
		$sql = "SELECT
							a.product_idx,
							a.member_idx,
							a.product_member_idx,
							a.img_path,
							a.product_state,
							a.product_price,
							a.free_product_yn,
							a.title,
							a.contents,
							a.product_addr,
							a.product_lat,
							a.product_lng,
							a.chatting_cnt,
							a.tags,
							(SELECT category_name FROM tbl_category_management WHERE category_management_idx = a.category_management_idx) AS category_name,
							a.like_cnt,
							a.list_up_cnt,
							a.view_cnt,
							a.report_cnt,
							a.chatting_cnt,
							a.display_yn,
							a.upd_date,
							a.ins_date,
							a.list_up_date,							
							FN_AES_DECRYPT(b.member_id) AS member_id,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							b.member_join_type,
							b.member_phone,
							b.member_img,
							b.good_product_cnt,
							b.bad_product_cnt,
							b.free_product_cnt,
							b.del_yn,
							FN_AES_DECRYPT(c.member_id) AS partner_member_id,
							FN_AES_DECRYPT(c.member_name) AS partner_member_name,
							c.member_img as partner_member_img,
							d.category_name
											
						FROM
							tbl_product AS a 
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
							LEFT JOIN tbl_member AS c ON c.member_idx = a.product_member_idx
							JOIN tbl_category_management d ON d.category_management_idx = a.category_management_idx AND d.del_yn = 'N'
							
						WHERE
							a.product_idx = ?
		";

		return $this->query_row($sql,
															array(
															$product_idx
															),
															$data
														);
	}

	// 커뮤니티 리스트 총 카운트
	public function famous_product_yn_cnt(){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_product a
						WHERE
							a.del_yn = 'N'
							AND a.famous_product_yn = 'Y'
		";
		
		return $this->query_cnt($sql,array());
	}

	// 노출여부 상태 변경
	public function famous_product_yn_mod_up($data){

		$product_idx  = $data['product_idx'];
		$famous_product_yn = $data['famous_product_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_product
						SET
							famous_product_yn = ?,
							upd_date = NOW()
						WHERE
							product_idx = ?
						";

		$this->query($sql,
								 array(
								 $famous_product_yn,
								 $product_idx
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

	public function product_display_yn_mod_up($data){

		$product_idx  = $data['product_idx'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_product
						SET
							display_yn = ?,
							upd_date = NOW()
						WHERE
							product_idx = ?
						";

		$this->query($sql,
								 array(
								 $display_yn,
								 $product_idx
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

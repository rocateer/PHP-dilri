<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 송민지
| Create-Date : 2021-02-02
|------------------------------------------------------------------------

*/

Class Model_eval extends MY_Model {

	// 상품 상세
	public function product_detail($data) {
		$product_idx = $data['product_idx'];

		$sql = "SELECT
							a.product_idx,
							a.member_idx,
							a.product_member_idx,
							a.reserve_member_idxs,
							IF(a.member_idx='$this->member_idx', 'seller', 'buyer') as viewer,
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
							a.upd_date,
							a.ins_date,
							a.list_up_date,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							b.member_join_type,
							b.member_phone,
							b.member_img,
							b.good_product_cnt,
							b.bad_product_cnt,
							b.free_product_cnt,
							b.del_yn,
							FN_AES_DECRYPT(c.member_name) AS partner_member_name,
							c.member_img as partner_member_img
						FROM
							tbl_product AS a
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
							LEFT JOIN tbl_member AS c ON c.member_idx = a.product_member_idx
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

	// 회원 정보
	public function mypage_detail() {

		$sql = "SELECT
							member_idx,
							member_img,
							FN_AES_DECRYPT(member_name) AS member_name,
							FN_AES_DECRYPT(member_id) AS member_id,
							member_point,
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
							a.member_idx = '$this->member_idx'
						";


		return $this->query_row($sql,
														array(

														)
													);

	}


	// 판매자 무료나눔 평가(평가대상 구매자)
	public function free_sell_reg_in($data){

		$product_idx = $data['product_idx'];
		$free_product_cnt_0 = $data['free_product_cnt_0'];
		$free_product_cnt_1 = $data['free_product_cnt_1'];
		$free_product_cnt_2 = $data['free_product_cnt_2'];
		$free_product_cnt_3 = $data['free_product_cnt_3'];

		$this->db->trans_begin();

		$sql = "SELECT
							member_idx,
							product_member_idx,
							del_yn
						FROM
							tbl_product
						WHERE
							product_idx = '$product_idx'
						";


		$check = $this->query_row($sql,
														array(

														)
													);

		// 평가 등록
		$sql = "INSERT INTO
							tbl_product_review
						(
							member_idx,
							partner_member_idx,
							product_idx,
							free_product_cnt_0,
							free_product_cnt_1,
							free_product_cnt_2,
							free_product_cnt_3,
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
							?,
							'N',
							NOW(),
							NOW()
						)
						";

		$this->query($sql,array(
								 $this->member_idx,
								 $check->product_member_idx,
								 $product_idx,
								 $free_product_cnt_0,
								 $free_product_cnt_1,
								 $free_product_cnt_2,
								 $free_product_cnt_3
								 ),$data
							 );

		$product_review_idx = $this->db->insert_id();

		// 평가 대상 업데이트
		$sql = "UPDATE
							tbl_member a,
							(SELECT
									sum(b.free_product_cnt_0) as total_free_product_cnt_0,
									sum(b.free_product_cnt_1) as total_free_product_cnt_1,
									sum(b.free_product_cnt_2) as total_free_product_cnt_2,
									sum(b.free_product_cnt_3) as total_free_product_cnt_3
								FROM
									tbl_product_review b
								WHERE
									b.del_yn = 'N'
									AND b.partner_member_idx = '$check->product_member_idx'
								GROUP BY b.partner_member_idx
							) as tb_b
						SET
							a.free_product_cnt_0=IFNULL(tb_b.total_free_product_cnt_0,0),
							a.free_product_cnt_1=IFNULL(tb_b.total_free_product_cnt_1,0),
							a.free_product_cnt_2=IFNULL(tb_b.total_free_product_cnt_2,0),
							a.free_product_cnt_3=IFNULL(tb_b.total_free_product_cnt_3,0),
							a.upd_date = NOW()
						WHERE
							a.member_idx = '$check->product_member_idx'
					";

		$this->query($sql,array(
								 ),$data
							 );

		// 리뷰 등록 여부 상태변경
		$sql = "UPDATE
 							tbl_product
 						SET
 							seller_review_yn = 'Y'
 						WHERE
 							product_idx = ?
 		";

 		$this->query($sql,
 								array(
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

	// 구매자 무료나눔 평가(평가대상 판매자)
	public function free_buy_reg_in($data){

		$product_idx = $data['product_idx'];
		$free_product_cnt_4 = $data['free_product_cnt_4'];
		$free_product_cnt_5 = $data['free_product_cnt_5'];
		$free_product_cnt_6 = $data['free_product_cnt_6'];
		$free_product_cnt_7 = $data['free_product_cnt_7'];
		$free_product_cnt_8 = $data['free_product_cnt_8'];

		$this->db->trans_begin();

		$sql = "SELECT
							member_idx,
							product_member_idx,
							del_yn
						FROM
							tbl_product
						WHERE
							product_idx = '$product_idx'
						";


		$check = $this->query_row($sql,
														array(

														)
													);

		// 평가 등록
		$sql = "INSERT INTO
							tbl_product_review
						(
							member_idx,
							partner_member_idx,
							product_idx,
							free_product_cnt_4,
							free_product_cnt_5,
							free_product_cnt_6,
							free_product_cnt_7,
							free_product_cnt_8,
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
							?,
							?,
							'N',
							NOW(),
							NOW()
						)
						";

		$this->query($sql,array(
								 $this->member_idx,
								 $check->member_idx,
								 $product_idx,
								 $free_product_cnt_4,
								 $free_product_cnt_5,
								 $free_product_cnt_6,
								 $free_product_cnt_7,
								 $free_product_cnt_8,
								 ),$data
							 );

		$product_review_idx = $this->db->insert_id();

		// 평가 대상 업데이트
		$sql = "UPDATE
							tbl_member a,
							(SELECT
									sum(b.free_product_cnt_4) as total_free_product_cnt_4,
									sum(b.free_product_cnt_5) as total_free_product_cnt_5,
									sum(b.free_product_cnt_6) as total_free_product_cnt_6,
									sum(b.free_product_cnt_7) as total_free_product_cnt_7,
									sum(b.free_product_cnt_8) as total_free_product_cnt_8
								FROM
									tbl_product_review b
								WHERE
									b.del_yn = 'N'
									AND b.partner_member_idx = '$check->member_idx'
								GROUP BY b.partner_member_idx
							) as tb_b
						SET
							a.free_product_cnt_4=IFNULL(tb_b.total_free_product_cnt_4,0),
							a.free_product_cnt_5=IFNULL(tb_b.total_free_product_cnt_5,0),
							a.free_product_cnt_6=IFNULL(tb_b.total_free_product_cnt_6,0),
							a.free_product_cnt_7=IFNULL(tb_b.total_free_product_cnt_7,0),
							a.free_product_cnt_8=IFNULL(tb_b.total_free_product_cnt_8,0),
							a.upd_date = NOW()
						WHERE
							a.member_idx = '$check->member_idx'
					";

		$this->query($sql,array(
								 ),$data
							 );

	  // 리뷰 등록 여부 상태변경
		$sql = "UPDATE
							tbl_product
						SET
							buyer_review_yn = 'Y'
						WHERE
							product_idx = ?
		";

		$this->query($sql,
								array(
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

	// 구매자 좋음 평가(평가대상 판매자)
	public function good_buy_reg_in($data){

		$product_idx = $data['product_idx'];
		$good_product_cnt_0 = $data['good_product_cnt_0'];
		$good_product_cnt_1 = $data['good_product_cnt_1'];
		$good_product_cnt_2 = $data['good_product_cnt_2'];
		$good_product_cnt_3 = $data['good_product_cnt_3'];
		$good_product_cnt_4 = $data['good_product_cnt_4'];

		$this->db->trans_begin();

		$sql = "SELECT
							member_idx,
							product_member_idx,
							del_yn
						FROM
							tbl_product
						WHERE
							product_idx = '$product_idx'
						";


		$check = $this->query_row($sql,
														array(

														)
													);

		// 평가 등록
		$sql = "INSERT INTO
							tbl_product_review
						(
							member_idx,
							partner_member_idx,
							product_idx,
							good_product_cnt_0,
							good_product_cnt_1,
							good_product_cnt_2,
							good_product_cnt_3,
							good_product_cnt_4,
							good_product_cnt,
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
							?,
							?,
							1,
							'N',
							NOW(),
							NOW()
						)
						";

		$this->query($sql,array(
								 $this->member_idx,
								 $check->member_idx,
								 $product_idx,
								 $good_product_cnt_0,
								 $good_product_cnt_1,
								 $good_product_cnt_2,
								 $good_product_cnt_3,
								 $good_product_cnt_4,
								 ),$data
							 );

		$product_review_idx = $this->db->insert_id();

		// 평가 대상 업데이트
		$sql = "UPDATE
							tbl_member a,
							(SELECT
									sum(b.good_product_cnt) as total_good_product_cnt,
									sum(b.good_product_cnt_0) as total_good_product_cnt_0,
									sum(b.good_product_cnt_1) as total_good_product_cnt_1,
									sum(b.good_product_cnt_2) as total_good_product_cnt_2,
									sum(b.good_product_cnt_3) as total_good_product_cnt_3,
									sum(b.good_product_cnt_4) as total_good_product_cnt_4
								FROM
									tbl_product_review b
								WHERE
									b.del_yn = 'N'
									AND b.partner_member_idx = '$check->member_idx'
								GROUP BY b.partner_member_idx
							) as tb_b
						SET
							a.good_product_cnt=IFNULL(tb_b.total_good_product_cnt,0),
							a.good_product_cnt_0=IFNULL(tb_b.total_good_product_cnt_0,0),
							a.good_product_cnt_1=IFNULL(tb_b.total_good_product_cnt_1,0),
							a.good_product_cnt_2=IFNULL(tb_b.total_good_product_cnt_2,0),
							a.good_product_cnt_3=IFNULL(tb_b.total_good_product_cnt_3,0),
							a.good_product_cnt_4=IFNULL(tb_b.total_good_product_cnt_4,0),
							a.upd_date = NOW()
						WHERE
							a.member_idx = '$check->member_idx'
					";

		$this->query($sql,array(
								 ),$data
							 );

		// 리뷰 등록 여부 상태변경
 		$sql = "UPDATE
 							tbl_product
 						SET
 							buyer_review_yn = 'Y'
 						WHERE
 							product_idx = ?
 		";

 		$this->query($sql,
 								array(
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

	// 구매자 나쁨 평가(평가대상 판매자)
	public function bad_buy_reg_in($data){

		$product_idx = $data['product_idx'];
		$bad_product_cnt_0 = $data['bad_product_cnt_0'];
		$bad_product_cnt_1 = $data['bad_product_cnt_1'];
		$bad_product_cnt_2 = $data['bad_product_cnt_2'];
		$bad_product_cnt_3 = $data['bad_product_cnt_3'];
		$bad_product_cnt_4 = $data['bad_product_cnt_4'];
		$bad_product_cnt_5 = $data['bad_product_cnt_5'];
		$bad_product_cnt_6 = $data['bad_product_cnt_6'];
		$bad_product_cnt_7 = $data['bad_product_cnt_7'];

		$this->db->trans_begin();

		$sql = "SELECT
							member_idx,
							product_member_idx,
							del_yn
						FROM
							tbl_product
						WHERE
							product_idx = '$product_idx'
						";


		$check = $this->query_row($sql,
														array(

														)
													);

		// 평가 등록
		$sql = "INSERT INTO
							tbl_product_review
						(
							member_idx,
							partner_member_idx,
							product_idx,
							bad_product_cnt_0,
							bad_product_cnt_1,
							bad_product_cnt_2,
							bad_product_cnt_3,
							bad_product_cnt_4,
							bad_product_cnt_5,
							bad_product_cnt_6,
							bad_product_cnt_7,
							bad_product_cnt,
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
							?,
							?,
							?,
							?,
							?,
							1,
							'N',
							NOW(),
							NOW()
						)
						";

		$this->query($sql,array(
								 $this->member_idx,
								 $check->member_idx,
								 $product_idx,
								 $bad_product_cnt_0,
								 $bad_product_cnt_1,
								 $bad_product_cnt_2,
								 $bad_product_cnt_3,
								 $bad_product_cnt_4,
								 $bad_product_cnt_5,
								 $bad_product_cnt_6,
								 $bad_product_cnt_7,
								 ),$data
							 );

		$product_review_idx = $this->db->insert_id();

		// 평가 대상 업데이트
		$sql = "UPDATE
							tbl_member a,
							(SELECT
									sum(b.bad_product_cnt) as total_bad_product_cnt,
									sum(b.bad_product_cnt_0) as total_bad_product_cnt_0,
									sum(b.bad_product_cnt_1) as total_bad_product_cnt_1,
									sum(b.bad_product_cnt_2) as total_bad_product_cnt_2,
									sum(b.bad_product_cnt_3) as total_bad_product_cnt_3,
									sum(b.bad_product_cnt_4) as total_bad_product_cnt_4,
									sum(b.bad_product_cnt_5) as total_bad_product_cnt_5,
									sum(b.bad_product_cnt_6) as total_bad_product_cnt_6,
									sum(b.bad_product_cnt_7) as total_bad_product_cnt_7
								FROM
									tbl_product_review b
								WHERE
									b.del_yn = 'N'
									AND b.partner_member_idx = '$check->member_idx'
								GROUP BY b.partner_member_idx
							) as tb_b
						SET
							a.bad_product_cnt=IFNULL(tb_b.total_bad_product_cnt,0),
							a.bad_product_cnt_0=IFNULL(tb_b.total_bad_product_cnt_0,0),
							a.bad_product_cnt_1=IFNULL(tb_b.total_bad_product_cnt_1,0),
							a.bad_product_cnt_2=IFNULL(tb_b.total_bad_product_cnt_2,0),
							a.bad_product_cnt_3=IFNULL(tb_b.total_bad_product_cnt_3,0),
							a.bad_product_cnt_4=IFNULL(tb_b.total_bad_product_cnt_4,0),
							a.bad_product_cnt_5=IFNULL(tb_b.total_bad_product_cnt_5,0),
							a.bad_product_cnt_6=IFNULL(tb_b.total_bad_product_cnt_6,0),
							a.bad_product_cnt_7=IFNULL(tb_b.total_bad_product_cnt_7,0),
							a.upd_date = NOW()
						WHERE
							a.member_idx = '$check->member_idx'
					";

		$this->query($sql,array(
								 ),$data
							 );

		// 리뷰 등록 여부 상태변경
 		$sql = "UPDATE
 							tbl_product
 						SET
 							buyer_review_yn = 'Y'
 						WHERE
 							product_idx = ?
 		";

 		$this->query($sql,
 								array(
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










}
?>

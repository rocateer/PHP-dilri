<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	심정민
| Create-Date : 2021-10-26
| Memo : 상품
|------------------------------------------------------------------------
*/

class Model_product extends MY_Model{

	public function forbidden_search_list(){

		$sql = "SELECT
							forbidden_search_idx,
							title
						FROM
							tbl_forbidden_search
						WHERE
							del_yn = 'N'
		";

		return $this->query_result($sql,array());
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

	// 주소 등록
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

	// 상품 좋아요
	public function product_reg_in($data){

	  $category_management_idx  = $data['category_management_idx'];
	  $title = $data['title'];
	  $free_product_yn  = $data['free_product_yn'];
	  $product_price = $data['product_price'];
	  $img_path  = $data['img_path'];
	  $contents = $data['contents'];
	  $tags  = $data['tags'];
	  $member_location_idx = $data['member_location_idx'];

	  $this->db->trans_begin();

	  $sql = "INSERT INTO
							tbl_product
	          (
		          member_idx,
		          category_management_idx,
		          title,
		          free_product_yn,
		          product_price,
		          img_path,
		          contents,
		          tags,
		          member_location_idx,
		          product_location_title,
		          product_addr,
		          product_lat,
		          product_lng,
							del_yn,
		          list_up_date,
		          ins_date,
		          upd_date
	          )
						select
		          '$this->member_idx',
		          ?,
		          ?,
		          ?,
		          ?,
		          ?,
		          ?,
		          ?,
		          ?,
		          b.title,
		          b.member_addr,
		          b.member_lat,
		          b.member_lng,
		          'N',
		          NOW(),
		          NOW(),
		          NOW()
	          FROM
							tbl_member_location b
						where
							b.member_location_idx=?
	  ";

	  $this->query($sql,array(
	                $category_management_idx,
	                $title,
	                $free_product_yn,
	                $product_price,
	                $img_path,
	                $contents,
	                $tags,
	                $member_location_idx,
	                $member_location_idx,
								),$data
							);

		$product_idx = $this->db->insert_id();

		$sql = "UPDATE
							 tbl_member
						 SET
						 	product_cnt = product_cnt+1
						 WHERE
							 member_idx = '$this->member_idx'
		 ";

		 $this->query($sql,
								 array(),
								 $data
							 );


	  if($this->db->trans_status() === FALSE){
	    $this->db->trans_rollback();
	    return "0";
	  }else{
	    $this->db->trans_commit();
	    return $product_idx;
	  }
	}




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
							IFNULL((select count(*) from tbl_product_report r where r.member_idx = '$this->member_idx' AND r.product_idx = a.product_idx and r.del_yn = 'N'), 0) as report_cnt,

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


	public function product_detail_distance($data) {
		$product_idx = $data['product_idx'];
		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];

		$sql = "SELECT
							a.product_idx,
							a.member_idx,
							ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 1) as distance
						FROM
							tbl_product AS a
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

	// 상품 리스트 가져오기
	public function product_list_get($data){
		$page_size = (int)$data['page_size'];
    $page_no   = (int)$data['page_no'];

		$current_lat = $data['current_lat'];
		$current_lng = $data['current_lng'];
		$distance = $data['distance'];
		$search_tag = $data['search_tag'];

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
							ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 1) as distance,
							b.good_product_cnt,
							b.bad_product_cnt,
							a.seller_review_yn,
							a.buyer_review_yn,
							b.del_yn
						FROM
							tbl_product AS a
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
							LEFT JOIN tbl_product_like t ON t.member_idx = '$this->member_idx' AND t.product_idx = a.product_idx and t.del_yn = 'N'

						WHERE
							a.del_yn = 'N'

		";

		if($search_tag !=""){
			$sql .=" AND FIND_IN_SET('$search_tag', a.tags) > 0  ";
		}
		if($distance !=""){
			$sql .=" AND ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 1) <= $distance  ";
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
		$distance = $data['distance'];
		$search_tag = $data['search_tag'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_product AS a JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							a.del_yn = 'N'

		";

		if($search_tag !=""){
			$sql .=" AND FIND_IN_SET('$search_tag', a.tags) > 0  ";
		}
		if($distance !=""){
			$sql .=" AND ROUND((6371*ACOS(COS(RADIANS($current_lat))*COS(RADIANS(a.product_lat))*COS(RADIANS(a.product_lng)-RADIANS($current_lng))+SIN(RADIANS($current_lat))*SIN(RADIANS(a.product_lat)))), 1) <= $distance  ";
		}

		return $this->query_cnt($sql, array());
	}

	public function product_reg_check(){

		$product_reg_check = '1';

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_product AS a
						WHERE
							a.del_yn = 'N'
							AND a.member_idx = '$this->member_idx'
							AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
		";

		$cnt = $this->query_cnt($sql, array());

		if ($cnt>=5) {
			$product_reg_check = '-1';
		}

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_product AS a
						WHERE
							a.del_yn = 'N'
							AND a.member_idx = '$this->member_idx'
							AND a.product_state IN (0,1)
		";

		$cnt = $this->query_cnt($sql, array());

		if ($cnt>=60) {
			$product_reg_check = '-2';
		}

		return $product_reg_check;
	}

	// 상품 좋아요
	public function product_like_reg_in($data){

	  $product_idx  = $data['product_idx'];
	  $member_idx = $data['member_idx'];

	  $this->db->trans_begin();

	  $sql = "INSERT INTO
							tbl_product_like
		          (
		          member_idx,
		          product_idx,
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
		          ON DUPLICATE KEY UPDATE member_idx=?,product_idx=?,like_yn=if(like_yn='Y','N','Y'),upd_date=NOW()
	  ";

	  $this->query($sql,array(
	                $member_idx,
	                $product_idx,
	                $member_idx,
	                $product_idx,
	               ),$data
	             );

   // 상품 좋아요 수 업데이트
	  $sql = "UPDATE
	            tbl_product
	          SET
	            like_cnt = (SELECT COUNT(1)
                         FROM tbl_product_like
                         WHERE product_idx = ? AND del_yn = 'N' AND like_yn = 'Y'),
	            upd_date = NOW()
	          WHERE
	            product_idx = ?
	          ";

		$this->query($sql,array(
	                $product_idx,
	                $product_idx
	               ),$data
	             );

	  if($this->db->trans_status() === FALSE){
	    $this->db->trans_rollback();
	    return "-1000";
	  }else{
	    $this->db->trans_commit();
	    return "1";
	  }
	}

	// 조회수 업데이트
	public function view_cnt_mod_up($data){

	  $product_idx  = $data['product_idx'];

	  $this->db->trans_begin();

	  $sql = "UPDATE
	            tbl_product
	          SET
							view_cnt = view_cnt+1,
	            upd_date = NOW()
	          WHERE
	            product_idx = ?
	          ";

		$this->query($sql,array(
	                $product_idx
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

	// 상품 좋아요 카운트
	public function product_like_cnt($data){
    $product_idx  = $data['product_idx'];

    $sql = "SELECT
              like_cnt
            FROM
              tbl_product
            WHERE
              product_idx = ?
    ";

    return $this->query_row($sql,
                            array(
                            $product_idx
                            ),
                            $data
                          );
  }

	// 좋아요 여부 확인
	public function like_yn_get($data){
		$product_idx = $data['product_idx'];
		$member_idx = $this->member_idx;

		$sql = "SELECT
		 					like_yn
						FROM
	  					tbl_product_like
						WHERE
		 					product_idx = ?
							AND member_idx = ?
		";

		return $this->query_row($sql,
														array(
														$product_idx,
														$member_idx
														),
														$data
													);
	}

	// 예약 취소 알림 등록 회원 목록
	public function reserve_member_idxs_get($data){
		$product_idx = $data['product_idx'];

		$sql = "SELECT
							reserve_member_idxs
						FROM
							tbl_product
						WHERE
							product_idx = ?
		";

		return $this->query_row($sql,
														array(
															$product_idx
														),
														$data
													);
	}


	/* ========================= 예약 관련 프로세스 =========================

	<판매자 프로세스>
		-판매중(예약안됨)
			-> 예약중으로 변경(예약구매자 선택)

		-예약중
			-> 예약완료로 변경
			-> 판매중(예약안함)으로 변경

		-예약완료

	<구매자 프로세스>
		-판매중(예약안됨)
			-> 채팅방으로 이동

		-예약중
			-> 예약 취소 알림 예약

		-예약완료

	========================= 예약 관련 프로세스 ========================= */


	public function chatting_room_list($data) {
		$product_idx = $data['product_idx'];

		$sql = "SELECT
						 a.chatting_room_idx,
						 a.member_idx,
						 a.partner_member_idx,
						 a.state,
						 a.last_chatting_date,
						 FN_AES_DECRYPT(c.member_name) AS partner_member_name,
						 c.member_img as partner_member_img
						FROM
							tbl_chatting_room as a
							left join tbl_member as c on c.member_idx=a.member_idx

						WHERE
							a.del_yn ='N'
							and a.product_idx=?
		";

			return $this->query_result($sql,
															array(
															$product_idx
															),
															$data);
	}


	//예약중으로 변경(예약구매자 선택)
	public function product_state_mod_up_1($data){
		$product_idx = $data['product_idx'];
		$product_member_idx = $data['product_member_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_product
						SET
							product_member_idx = ?,
							product_state = 1
						WHERE
							product_idx = ?
		";

		$this->query($sql,
								array(
									$product_member_idx,
									$product_idx
								),
								$data
							);

		if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
	}

	//예약완료로 변경 free_product_cnt
	public function product_state_mod_up_2($data){
		$product_idx = $data['product_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_product
						SET
							product_state = 2
						WHERE
							product_idx = ?
		";

		$this->query($sql,
								array(
									$product_idx
								),
								$data
							);


		$sql = "UPDATE
							tbl_member a
						SET
							a.free_product_cnt=IFNULL((SELECT count(*) as cnt FROM tbl_product b WHERE b.del_yn = 'N' AND b.member_idx = '$this->member_idx' AND b.free_product_yn ='Y' AND b.product_state = 2), 0),
							a.upd_date = NOW()
						WHERE
							a.member_idx = '$this->member_idx'
					";

		$this->query($sql,array(
								 ),$data
							 );

		if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
	}

	//예약 해제 하기
	public function product_state_mod_up_0($data){
		$product_idx = $data['product_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_product
						SET
							product_member_idx = NULL,
							product_state = 0
						WHERE
							product_idx = ?
		";

		$this->query($sql,
								array(
									$product_idx
								),
								$data
							);

		if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
	}

	// 예약 중 무료나눔 거래의 완료 여부 확인
	public function free_product_state_check(){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_product AS a
						WHERE
							a.del_yn = 'N'
							AND a.product_state = 1
							AND a.free_product_yn = 'Y'
							AND a.product_member_idx = '$this->member_idx'
		";

		return $this->query_cnt($sql, array());
	}

	// 완료된 무료나눔 거래의 평가 등록 확인
	public function free_product_review_check(){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_product AS a
						WHERE
							a.del_yn = 'N'
							AND a.product_state = 2
							AND a.free_product_yn = 'Y'
							AND a.product_member_idx = '$this->member_idx'
							AND a.buyer_review_yn = 'N'
		";

		return $this->query_cnt($sql, array());
	}

	//  방등록
	public function	chatting_room_reg_in($data){
		$product_idx     = $data['product_idx'];
		$partner_member_idx = $data['partner_member_idx'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_chatting_room
							(
  							product_idx,
  							member_idx,
								partner_member_idx,
								state,
								member_read_date,
								partner_member_read_date,
								del_yn,
								last_chatting_date,
								ins_date,
								upd_date
							)VALUES (
								?,
								?,
								?,
								'1',
								NOW(),
								NOW(),
								'N',
								NOW(),
								NOW(),
								NOW()
							)
							ON DUPLICATE KEY UPDATE product_idx=?,member_idx=?,partner_member_idx=?,del_yn='N',last_chatting_date=NOW(),upd_date=NOW()
  ";
   $this->query($sql,
							array(
								$product_idx,
								$member_idx,
								$partner_member_idx,
								$product_idx,
								$member_idx,
								$partner_member_idx,
							),
							$data
							);
     $chatting_room_idx = $this->db->insert_id();


		 $sql = "UPDATE
							tbl_product z,
							(select count(*) as cnt from tbl_chatting_room b where b.product_idx=? AND b.del_yn = 'N') as tbl_b
						SET
							chatting_cnt = tbl_b.cnt
						WHERE
							product_idx = ?
		";

		$this->query($sql,
								array(
									$product_idx,
									$product_idx,
								),
								$data
							);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return $chatting_room_idx;
		}
	}

	//채팅방 오픈 여부
	public function chatting_room_check($data) {
		$product_idx     = $data['product_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
						 a.chatting_room_idx,
						 a.state
						FROM tbl_chatting_room as a
						WHERE
							a.del_yn ='N'
							and a.product_idx=?
							and a.member_idx=?
		";

			return $this->query_row($sql,
															array(
															$product_idx,
															$member_idx,
															),
															$data);
	}

	// 예약된 글 취소 알림 등록
	public function reserve_reg_in($data){
		$reserve_member_idxs = $data['new_reserve_member_idxs'];
		$product_idx = $data['product_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_product
						SET
							reserve_member_idxs = ?
						WHERE
							product_idx = ?
		";

		$this->query($sql,
								array(
									$reserve_member_idxs,
									$product_idx
								),
								$data
							);

		if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
	}

	// 상품 신고
	public function product_report($data){
		$product_idx = $data['product_idx'];
		$member_idx = $data['member_idx'];
		$report_type = $data['report_type'];
		$report_contents = $data['report_contents'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_product_report
							(
								product_idx,
								member_idx,
								report_type,
								report_contents,
								ins_date,
								upd_date,
								del_yn
							)
						VALUES
							(
								?,
								?,
								?,
								?,
								NOW(),
								NOW(),
								'N'
							)

		";

		$this->query($sql,
								array(
								$product_idx,
								$member_idx,
								$report_type,
								$report_contents
								),
								$data
							);

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}
	}

	// 상품 삭제
	public function product_del($data){
		$product_idx = $data['product_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_product
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							product_idx = ?
		";

		$this->query($sql,
								array(
								$product_idx
								),
								$data
							);

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}
	}

	// 포인트 체크
	public function point_check($data){
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							member_point
						FROM
							tbl_member
						WHERE
							member_idx = ?
		";

		return $this->query_row($sql,
														array(
														$member_idx
														),
														$data
													);
	}

	public function list_up_info_get($data){
		$product_idx = $data['product_idx'];

		$sql = "SELECT
							a.free_list_up_date,
							a.list_up_date,
							a.ins_date,
							a.list_up_cnt,
							b.member_point
						FROM
							tbl_product AS a JOIN tbl_member AS b ON a.member_idx = b.member_idx
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

	// 무료 끌어올리기
	public function free_list_up($data){
		$product_idx = $data['product_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_product
						SET
							free_list_up_date = NOW(),
							list_up_date = NOW(),
							list_up_cnt = list_up_cnt+1,
							upd_date = NOW()
						WHERE
							product_idx = ?
		";

		$this->query($sql,
								array(
								$product_idx
								),
								$data
							);

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}
	}

	// 포인트 끌어올리기
	public function list_up($data){
		$product_idx = $data['product_idx'];

		$this->db->trans_begin();

		$sql_1 = "UPDATE
							tbl_product
						SET
							list_up_date = NOW(),
							list_up_cnt = list_up_cnt+1,
							upd_date = NOW()
						WHERE
							product_idx = ?
		";

		$this->query($sql_1,
								array(
								$product_idx
								),
								$data
							);

		$sql_2 = "UPDATE
							tbl_member
						SET
							member_point = member_point-1000,
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

		$this->query($sql_2,
								array(
								$this->member_idx
								),
								$data
							);


		$sql = "INSERT INTO
							tbl_member_point
						(
							member_idx,
							memo,
							point_type,
							point,
							type,
							del_yn,
							ins_date,
							upd_date
						) VALUES (
							'$this->member_idx',
							'포인트 사용 끌어올리기',
							'2',
							-1000,
							NULL,
							'N',
							NOW(),
							NOW()
						)
						";

		$this->query($sql,array(
							   ),$data
						   );

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}
	}

	// 예약 해제하기
	public function reserve_cancel($data){
		$product_idx = $data['product_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_product
						SET
							product_state = '0'
						WHERE
							product_idx = ?
		";

		$this->query($sql,
								array(
								$product_idx
								),
								$data
							);

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}
	}

	// 카테고리 목록 가져오기
	public function category_list_get(){
		$sql = "SELECT
							category_management_idx,
							category_name
						FROM
							tbl_category_management
						WHERE
							del_yn = 'N'
							";

		return $this->query_result($sql,
																array(

																)
															);
	}

	// 거래위치 목록 가져오기
	public function location_list_get(){
		$sql = "SELECT
							member_location_idx,
							member_addr,
							title
						FROM
							tbl_member_location
						WHERE
							member_idx = ?
						AND
							del_yn = 'N'
							";

		return $this->query_result($sql,
																array(
																	$this->member_idx
																)
															);
	}

	// 상품 수정 상세
	public function product_mod_detail($data){
		$product_idx = $data['product_idx'];

		$sql = "SELECT
							product_idx,
							category_management_idx,
							title,
							product_price,
							img_path,
							contents,
							free_product_yn,
							tags,
							member_location_idx,
							product_location_title,
							product_addr
						FROM
							tbl_product
						WHERE
							product_idx = ?
							";

		return $this->query_row($sql,
														array(
														$product_idx
														),
														$data
													);
	}

	// 상품 수정
	public function product_mod_up($data){
		$product_idx = $data['product_idx'];
		$category_management_idx  = $data['category_management_idx'];
	  $title = $data['title'];
	  $free_product_yn  = $data['free_product_yn'];
	  $product_price = $data['product_price'];
	  $img_path  = $data['img_path'];
	  $contents = $data['contents'];
	  $tags  = $data['tags'];
	  $member_location_idx = $data['member_location_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_product a,
							(SELECT
									b.title,
									b.member_addr,
									b.member_lat,
									b.member_lng
								FROM
									tbl_member_location b
								WHERE
									b.member_location_idx = '$member_location_idx'
							) as tb_b
						SET
							a.category_management_idx = ?,
							a.title = ?,
							a.product_price = ?,
							a.free_product_yn = ?,
							a.img_path = ?,
							a.contents = ?,
							a.tags = ?,
							a.member_location_idx = ?,
							a.product_location_title = tb_b.title,
							a.product_addr = tb_b.member_addr,
							a.product_lat = tb_b.member_lat,
							a.product_lng = tb_b.member_lng,
							a.upd_date = NOW()
						WHERE
							a.product_idx = ?
		";

		$this->query($sql,
								array(
									$category_management_idx,
									$title,
									$product_price,
									$free_product_yn,
									$img_path,
									$contents,
									$tags,
									$member_location_idx,
									$product_idx
								),
								$data
							);

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}
	}

	// 위치 삭제
	public function member_location_del($data){
		$member_location_idx = $data['member_location_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member_location
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							member_location_idx = ?
		";

		$this->query($sql,
								array(
									$member_location_idx
								),
								$data
							);

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}
	}

} // 클래스의 끝
?>

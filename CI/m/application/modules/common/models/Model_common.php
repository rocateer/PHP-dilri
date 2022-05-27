<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-02-29
| Memo : 공통 기능
|------------------------------------------------------------------------
*/

Class Model_common extends MY_Model {

	// 차단된 단어 체크
	public function forbidden_search_check($data){
		$tags=$data['tags'];

		$forbidden_tag = "";
		$tag_arr = explode(',', $tags);
		foreach ($tag_arr as $tag) {

			$sql = "SELECT
								count(*) as cnt
							FROM
								tbl_member a
							WHERE
								a.del_yn='N'
								AND FIND_IN_SET('$tag',a.title)>0
			";

			$cnt = $this->query_cnt($sql,
															array(
															),$data
															);
			if ($cnt>0) {
				$forbidden_tag = $tag;
				break;
			}
		}

		return $forbidden_tag;
	}


	// 포인트 지급
	public function member_point_mod_up($data){

		$member_idx = $data['member_idx'];
		$point = $data['point'];
		$memo_type = $data['memo_type'];
		$point_add_yn = 'N';

		// 1일 최대 획득 가능 포인트는 360 포인트
		$total_point = 0;
		$sql = "SELECT
							sum(a.point) as total_point
						FROM
							tbl_member_point a
						WHERE
							a.del_yn = 'N'
							AND a.point_type = '0'
							and a.member_idx='$member_idx'
							AND DATE_FORMAT(a.ins_date, '%Y-%m-%d')=DATE_FORMAT(NOW(), '%Y-%m-%d')
		";

		$result = $this->query_row($sql,array(),$data);
		if (!empty($result->total_point)) {
			$total_point = $result->total_point;
		}else {
			$total_point = 0;
		}

		// 포인트 지급 유형(0:관리자 지급 ,1:회원 가입 후, 2:프로필 사진 최초 등록, 3:커뮤니티 글쓰기 1회, 4:커뮤니티 스크랩 1회, 5:커뮤니티 추천 1회)
		// if ($memo_type=='1' && $total_point<360) {
		if ($memo_type=='1' ) {
			$memo = "회원 가입";
			$point_add_yn = 'Y';
		// }elseif ($memo_type=='2' && $total_point<360) {
		}elseif ($memo_type=='2' ) {
			$memo = "프로필 사진 최초 등록";
			$point_add_yn = 'Y';
		}elseif ($memo_type=='3' && $total_point<360) {
			$memo = "커뮤니티 글쓰기 1회";

			$sql = "SELECT
								count(*) as cnt
							FROM
								tbl_member_point a
							WHERE
								a.del_yn = 'N'
								AND a.point_type = '0'
								AND a.type = '$memo_type'
								and a.member_idx='$member_idx'
								AND DATE_FORMAT(a.ins_date, '%Y-%m-%d')=DATE_FORMAT(NOW(), '%Y-%m-%d')
			";

			$cnt = $this->query_cnt($sql,array(),$data);

			if ($cnt<2) {
				$point_add_yn = 'Y';
			}

		}elseif ($memo_type=='4' && $total_point<360) {
			$memo = "커뮤니티 스크랩 1회";

			$sql = "SELECT
								count(*) as cnt
							FROM
								tbl_member_point a
							WHERE
								a.del_yn = 'N'
								AND a.point_type = '0'
								AND a.type = '$memo_type'
								and a.member_idx='$member_idx'
								AND DATE_FORMAT(a.ins_date, '%Y-%m-%d')=DATE_FORMAT(NOW(), '%Y-%m-%d')
			";

			$cnt = $this->query_cnt($sql,array(),$data);

			if ($cnt<6) {
				$point_add_yn = 'Y';
			}

		}elseif ($memo_type=='5' && $total_point<360) {
			$memo = "커뮤니티 추천 1회";

			$sql = "SELECT
								count(*) as cnt
							FROM
								tbl_member_point a
							WHERE
								a.del_yn = 'N'
								AND a.point_type = '0'
								AND a.type = '$memo_type'
								and a.member_idx='$member_idx'
								AND DATE_FORMAT(a.ins_date, '%Y-%m-%d')=DATE_FORMAT(NOW(), '%Y-%m-%d')
			";

			$cnt = $this->query_cnt($sql,array(),$data);

			if ($cnt<6) {
				$point_add_yn = 'Y';
			}

		}

		if ($point_add_yn == 'Y') {
			$this->db->trans_begin();

			$sql = "INSERT INTO
								tbl_member_point
							(
								member_idx,
								memo,
								type,
								point_type,
								point,
								del_yn,
								ins_date,
								upd_date
							) VALUES (
								?,
								?,
								?,
								'0',
								?,
								'N',
								NOW(),
								NOW()
							)
							";

			$this->query($sql,array(
									$member_idx,
									$memo,
									$memo_type,
									$point,
								   ),$data
							   );

			$sql = "UPDATE
								 tbl_member
							 SET
								 member_point = (select sum(point) from tbl_member_point where member_idx = '$member_idx' AND del_yn = 'N'),
								 upd_date = NOW()
							 WHERE
								 member_idx = ?
						 ";
 
			 $this->query($sql,
										 array(
										 $member_idx
									 ),
									 $data
								 );

			//알림믕록
			$sql = "SELECT
							a.member_idx,
							0 as corp_idx,
							FN_AES_DECRYPT(a.member_name) AS member_name,
							a.all_alarm_yn as alarm_yn,
							a.device_os,
							a.gcm_key
						from tbl_member as a
						where 
							a.del_yn='N'
							and member_idx = '$member_idx'
			";

			$result_list=	$this->query_result($sql,array());

			foreach($result_list as $row){

			$data['member_idx'] = $row->member_idx;
			$data['gcm_key'] = $row->gcm_key;
			$data['device_os'] = $row->device_os;
			$data['title']=$title= '';
			if ($this->current_nation=='kr') {
				$data['msg']=$msg= '포인트가 지급되었습니다.';
			} else if ($this->current_nation=='bd') {
				$data['msg']=$msg= 'আপনি পয়েন্ট অর্জন করেছেন।';
			}else{
				$data['msg']=$msg= 'You have earned Point.';
			}
			
			// $data['msg']=$msg= '포인트가 지급되었습니다.';
			$data["index"] ="111";
			$data["alarm_yn"] =$row->alarm_yn;

			$sql = "INSERT INTO
							tbl_alarm
						(
							member_idx,
							`data`,
							title,
							msg,
							`index`,
							device_os,
							gcm_key,
							alarm_yn,
							send_yn,
							read_yn,
							del_yn,
							ins_date,
							upd_date
						)VALUES (
							?,
							?,
							?,
							?,
							?,
							?,
							?,
							?,
							'N',
							'N',
							'N',
							NOW(),
							NOW()
						)
			";

			$this->query($sql,
								array(
								$row->member_idx,
								json_encode($data),
								$title,
								$msg,
								'111',
								$row->device_os,
								$row->gcm_key,
								$row->alarm_yn,
								)
								);
			}

			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}else{
				$this->db->trans_commit();

				$data['badge_type'] = '5';
				$this->COM_badge_check($data);
			}

		}

		return;
	}

	// 뱃지 획득 체크
	public function COM_badge_check($data){
		$member_idx=$data['member_idx'];
		$badge_type=$data['badge_type'];

		$COM_profile_check = $this->COM_profile_check($data);
		$badge_arr = explode(',', $COM_profile_check->my_badge_types);
		$badge_yn = in_array($badge_type, $badge_arr)?'Y':'N'; // 현재 뱃지 보유 여부
		$badge_add_yn = 'N'; // 새로운 뱃지 추가 여부 디폴트

		// 득탬 성공 / 최초 중고거래 구매 완료가 1회 이상.
		if ($badge_type=='0' && $badge_yn=='N') {
			$badge_add_yn = 'Y';
		}

		// 거래하는 기쁨 / 최초 중고거래 판매 완료가 1회 이상
		if ($badge_type=='1' && $badge_yn=='N') {
			$badge_add_yn = 'Y';
		}

		// 나눔의 시작 / 나눔 횟수 완료가 1회 이상
		if ($badge_type=='2' && $badge_yn=='N') {
			$badge_add_yn = 'Y';
		}

		// 소식통 / 커뮤니티의 글 등록이 1회 이상
		if ($badge_type=='3' && $badge_yn=='N') {
			$badge_add_yn = 'Y';
		}

		// 당신의 센스 / 커뮤니티 게시글 좋아요 50개 이상
		if ($badge_type=='4' && $badge_yn=='N') {

			$sql = "SELECT
								count(*) as cnt
							FROM
								tbl_board_like a
							WHERE
								a.del_yn = 'N'
								AND a.like_yn = 'N'
								and a.member_idx='$member_idx'
			";

			$cnt = $this->query_cnt($sql,array(),$data);

			if ($cnt==50) {
				$badge_add_yn = 'Y';
			}
		}

		// 포인트 부자 / 누적 포인트 획득 1,000점 이상 달성.
		if ($badge_type=='5' && $badge_yn=='N') {

			$sql = "SELECT
								sum(a.point) as total_point
							FROM
								tbl_member_point a
							WHERE
								a.del_yn = 'N'
								and a.member_idx='$member_idx'
			";

			$result = $this->query_row($sql,array(),$data);

			if ($result->total_point>=1000) {
				$badge_add_yn = 'Y';
			}
		}

		// 리뷰어 / 거래 후 평가 작성이 1회 이상
		if ($badge_type=='6' && $badge_yn=='N') {
			$badge_add_yn = 'Y';
		}

		// 친절한 판매자 / 중고거래 판매 후  좋음 평가가 10회 이상
		if ($badge_type=='7' && $badge_yn=='N') {

			if ($COM_profile_check->good_product_cnt>=10) {
				$badge_add_yn = 'Y';
			}
		}

		// 신뢰의 시작 / 프로필 사진 최초 등록 후
		if ($badge_type=='8' && $badge_yn=='N') {
			$badge_add_yn = 'Y';

			// 포인트 업데이트
			$data['point'] = 1000;
			$data['memo_type'] = '2';

			$this->member_point_mod_up($data);

		}

		// 알려주는 구매자 / 중고거래 구매 후 평가 1회 이상
		if ($badge_type=='9' && $badge_yn=='N') {
			$badge_add_yn = 'Y';
		}

		// 뱃지 업데이트
		if ($badge_add_yn == 'Y') {

			$this->db->trans_begin();

			$sql = "UPDATE
								tbl_member
							SET
								my_badge_types = IF(my_badge_types iS NULL,'$badge_type' ,concat(my_badge_types, ',', '$badge_type')),
								upd_date = NOW()
							WHERE
								member_idx = ?
						";

			$this->query($sql,
										array(
										$member_idx
									),
									$data
								);

			//알림믕록
			$sql = "SELECT
							a.member_idx,
							0 as corp_idx,
							FN_AES_DECRYPT(a.member_name) AS member_name,
							a.all_alarm_yn as alarm_yn,
							a.device_os,
							a.gcm_key
						from tbl_member as a
						where 
							a.del_yn='N'
							and member_idx = '$member_idx'
			";

			$result_list=	$this->query_result($sql,array());

			foreach($result_list as $row){

			$data['member_idx'] = $row->member_idx;
			$data['gcm_key'] = $row->gcm_key;
			$data['device_os'] = $row->device_os;
			$data['title']=$title= '';
			if ($this->current_nation=='kr') {
				$data['msg']=$msg= '새로운 뱃지를 획득하였습니다.';
			} else if ($this->current_nation=='bd') {
				$data['msg']=$msg= 'আপনি নতুন ব্যাজ অর্জন করেছেন';
			}else{
				$data['msg']=$msg= 'You have earned new badge.';
			}
			$data["index"] ="110";
			$data["alarm_yn"] =$row->alarm_yn;

			$sql = "INSERT INTO
							tbl_alarm
						(
							member_idx,
							`data`,
							title,
							msg,
							`index`,
							device_os,
							gcm_key,
							alarm_yn,
							send_yn,
							read_yn,
							del_yn,
							ins_date,
							upd_date
						)VALUES (
							?,
							?,
							?,
							?,
							?,
							?,
							?,
							?,
							'N',
							'N',
							'N',
							NOW(),
							NOW()
						)
			";

			$this->query($sql,
								array(
								$row->member_idx,
								json_encode($data),
								$title,
								$msg,
								'110',
								$row->device_os,
								$row->gcm_key,
								$row->alarm_yn,
								)
								);
			}


			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return "0";
			}else{
				$this->db->trans_commit();
				return "1000";
			}
		}

	}


	public function member_detail(){

		$member_idx = $this->member_idx;

		$sql = "SELECT
							a.member_idx,
							a.current_lang,
							a.del_yn,
							a.my_badge,
							a.my_badge_types,
							a.member_join_type,
							a.member_img,
							a.member_location_idx,
							a.good_product_cnt,
							a.bad_product_cnt,
							a.uuid,
							a.gcm_key,
							a.device_os,
							FN_AES_DECRYPT(a.member_id) AS member_id,
							FN_AES_DECRYPT(a.member_name) AS member_name,
							FN_AES_DECRYPT(a.member_phone) AS member_phone,
							a.member_gender
						FROM
							tbl_member a
						WHERE
							a.member_idx = ?
						";

		return  $this->query_row($sql,
														array(
														$member_idx
														)
														);
	}

	public function COM_profile_check($data){

		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.member_idx,
							a.my_badge,
							a.my_badge_types,
							a.member_join_type,
							a.member_img,
							a.member_location_idx,
							a.good_product_cnt,
							a.bad_product_cnt,
							FN_AES_DECRYPT(a.member_id) AS member_id,
							FN_AES_DECRYPT(a.member_name) AS member_name,
							FN_AES_DECRYPT(a.member_phone) AS member_phone,
							FN_AES_DECRYPT(a.member_birth) AS member_birth,
							a.member_gender,
							a.del_yn
						FROM
							tbl_member a
						WHERE
							a.member_idx = ?
						";

		return  $this->query_row($sql,
														array(
														$member_idx
														)
														);
	}

	// 공지사항 리스트
	public function recent_notice_detail(){

		$sql = "SELECT
							notice_idx,
							title,
							del_yn,
							ins_date,
							upd_date
						FROM
							tbl_notice
						WHERE
							del_yn = 'N'
							AND notice_state = 'Y'
						";

		$sql .=" ORDER BY notice_idx DESC LIMIT 1 ";

		return $this->query_row($sql,array());
	}

	// 배너 목록
	public function rand_banner($data) {

		$banner_type=$data['banner_type'];

		$sql = "SELECT
							banner_idx,
							img_path,
							link_url
						FROM
							tbl_banner
						WHERE
							del_yn = 'N'
							AND state = '1'
							AND banner_type = '$banner_type'
		";

		$sql.=" ORDER BY RAND() DESC LIMIT 1 ";

	  return	$this->query_row($sql,array());
	}

//지역 시도 리스트
	public function city_list() {

		$sql = "
				SELECT
					city_cd,
					city_name,
					id_cd
				FROM
					tbl_city_cd
				ORDER BY order_no ASC
				  ";

		return $this->query_result($sql,array());

	}

//구군 리스트
	public function region_list($data) {

		$city_cd=$data['city_cd'];

		$sql = "
				SELECT
					region_cd,
					region_name,
					city_cd
				FROM
					tbl_region_cd
				WHERE
					city_cd =?
				ORDER BY order_no ASC
				  ";

		return $this->query_result($sql,array($city_cd));

	}

//메인 카테고리 리스트
	public function keyword_list() {

		$sql = "
				SELECT
					keyword_name,
					keyword_code,
					keyword_memo
				FROM
					tbl_keyword
				WHERE
					del_yn ='N' ";
	//	if($auto_yn == 'Y'){
	//		$sql .= " AND auto_yn = 'Y'";
	//	}
		$sql .= " GROUP BY keyword_code
				ORDER BY order_no ";

		return $this->query_result($sql,array());

	}

//해시태그 리스트
	public function keyword_sub_list($data) {
		//$auto_yn = $data['auto_yn'];

		$keyword_code=$data['keyword_code'];

		$sql = "
				SELECT
					keyword_idx,
					keyword_name_sub,
					keyword_code,
					keyword_code_sub,
					keyword_memo
				FROM
					tbl_keyword
				WHERE
					keyword_code =?	";
		//	if($auto_yn == 'Y'){
		//		$sql .= " AND auto_sub_yn = 'Y'";
	//		}
			$sql .= "	AND del_yn = 'N'
				ORDER BY keyword_code_sub ASC
				  ";

		return $this->query_result($sql,array($keyword_code));

	}


}
?>

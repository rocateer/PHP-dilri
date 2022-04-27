<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-22
| Memo : 회원 정보 수정
|------------------------------------------------------------------------
*/

Class Model_member_info extends MY_Model {

	// 회원 상세보기
	public function member_detail(){

		$member_idx = $this->member_idx;

		$sql = "SELECT
							a.member_idx,
							a.member_join_type,
							a.member_img,
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

	// 전화번호 중복 체크
	public function member_phone_check($data){

		$member_phone = $data['member_phone'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_phone = FN_AES_ENCRYPT(?)
							AND member_idx != '$this->member_idx'
		";

		return $this->query_cnt($sql,array(
														$member_phone),
														$data);
	}

	// 이름 + 전화번호 중복 체크
	public function member_info_check($data){

		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_name = FN_AES_ENCRYPT(?)
							AND member_phone = FN_AES_ENCRYPT(?)
							AND member_idx != '$this->member_idx'
		";

		return $this->query_cnt($sql,array($member_name, $member_phone), $data);
	}

	// 이름 중복 체크
	public function member_name_check($data){

		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_name = FN_AES_ENCRYPT(?)
							AND member_idx != '$this->member_idx'
		";

		return $this->query_cnt($sql,array($member_name), $data);
	}

	// 회원 정보 수정
	public function member_info_mod_up($data){

		$member_idx = $this->member_idx;
		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];
		$member_gender = $data['member_gender'];
		$member_img = $data['member_img'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							member_name = FN_AES_ENCRYPT(?),
							member_phone = FN_AES_ENCRYPT(?),
							member_gender = ?,
							member_img = ?,
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

		$this->query($sql,array(
									$member_name,
									$member_phone,
									$member_gender,
									$member_img,
									$member_idx
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


}	// 클래스의 끝
?>

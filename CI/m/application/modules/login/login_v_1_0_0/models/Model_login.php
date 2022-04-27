<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	심정민
| Create-Date : 2021-10-21
| Memo : 로그인
|------------------------------------------------------------------------
*/

class Model_login extends MY_Model{

	public function member_phone_check($data){

		$member_phone = $data['member_phone'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_phone = FN_AES_ENCRYPT(?)
							AND del_yn != 'Y'
							AND member_idx != '$this->member_idx' 
		";

		return $this->query_cnt($sql,array(
														$member_phone),
														$data);
	}

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

	public function login_action_member($data) {

	  $member_id=$data['member_id'];
		$member_pw=$data['member_pw'];

		$sql = "SELECT
							member_idx,
							FN_AES_DECRYPT(member_id) AS member_id,
							del_yn
						FROM
							tbl_member
						WHERE
							member_id = FN_AES_ENCRYPT(?)
							AND member_pw = SHA2(?,512)
		";

		return $this->query_row($sql, array($member_id, $member_pw));

	}

	public function login_check() {

		$sql = "SELECT
							gcm_key,
							device_os,
							del_yn
						FROM
							tbl_member
						WHERE
							member_idx = '$this->member_idx'
		";

		return $this->query_row($sql, array());

	}

	//
  public function join_check_member($data) {

    $member_id=$data['member_id'];
		$member_pw=$data['member_pw'];

    $sql = "SELECT
              COUNT(*) as cnt
            FROM
              tbl_member
            WHERE
              member_id = FN_AES_ENCRYPT(?)
							AND member_pw = SHA2(?,512)
    ";

    return $this->query_cnt($sql, array($member_id, $member_pw));
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
				 	 uuid = ?,
					 gcm_key = ?,
					 device_os = ?,
					 upd_date = NOW()
				 WHERE
					 member_idx = ?
	 ";

	 $this->query($sql,
							 array(
							 $this->uuid,
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


	// 회원 정보 수정
	public function member_info_mod_up($data){

		$member_idx = $this->member_idx;
		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];
		$member_gender = $data['member_gender'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							member_name = FN_AES_ENCRYPT(?),
							member_phone = FN_AES_ENCRYPT(?),
							member_gender = ?,
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

		$this->query($sql,array(
									$member_name,
									$member_phone,
									$member_gender,
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

} // 클래스의 끝
?>

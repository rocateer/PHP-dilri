<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	최재명
| Create-Date : 2020-11-25
| Memo : 네이티브 로그인
|------------------------------------------------------------------------
*/

class Model_native_login extends MY_Model{

  // 닉네임 중복 체크
  public function member_nickname_check($data){

    $member_nickname = $data['member_nickname'];

    $sql = "SELECT
              COUNT(*) AS cnt
            FROM
              tbl_member
            WHERE
              member_nickname = ?
    ";

    return $this->query_cnt($sql,array($member_nickname));
  }


  //SNS회원 로그인 체크
	public function sns_member_login_check($data) {

		$member_id=$data['member_id'];
		$member_join_type=$data['member_join_type'];

		$sql = "SELECT
              member_idx,
              member_join_type,
              FN_AES_DECRYPT(member_id) AS member_id,
              FN_AES_DECRYPT(member_name) AS member_name,
              del_yn
						FROM
              tbl_member
						WHERE
              FN_AES_DECRYPT(member_id) = ?
							AND member_join_type = ?
						";

		return $this->query_row($sql,
                            array(
                            $member_id,
                            $member_join_type
                            ),
                            $data);
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



  //SNS 회원가입
	public function sns_member_auto_reg_in($data) {

		$member_id=$data['member_id'];;
		$gcm_key=$data['gcm_key'];
		$device_os=$data['device_os'];
		$member_join_type=$data['member_join_type'];

		$this->db->trans_begin();

		$sql="INSERT INTO
						tbl_member
					(
						member_id,
						gcm_key,
						device_os,
            member_join_type,
						del_yn,
						ins_date,
						upd_date
					)VALUES(
						FN_AES_ENCRYPT(?),
						?,
						?,
						?,
						'N',
						NOW(),
						NOW()
					);
   			 ";

		$this->query($sql
                ,array(
                $member_id,
                $gcm_key,
                $device_os,
                $member_join_type
                ),
                $data);

    $member_idx = $this->db->insert_id();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return $member_idx;
		}
	}


  //SNS 회원가입
	public function sns_member_reg_in($data) {

		$member_id=$data['member_id'];;
		$gcm_key=$data['gcm_key'];
		$device_os=$data['device_os'];
		$member_join_type=$data['member_join_type'];
    $member_name = $data['member_name'];
    $member_phone = $data['member_phone'];

		$this->db->trans_begin();

		$sql="INSERT INTO
						tbl_member
					(
						member_id,
            member_phone,
            member_name,
						gcm_key,
						device_os,
            member_join_type,
						del_yn,
						ins_date,
						upd_date
					)VALUES(
						FN_AES_ENCRYPT(?),
						FN_AES_ENCRYPT(?),
						?,
						?,
						?,
						?,
						'N',
						NOW(),
						NOW()
					);
   			 ";

		$this->query($sql
                ,array(
                $member_id,
                $member_phone,
                $member_name,
                $gcm_key,
                $device_os,
                $member_join_type
                ),
                $data);

    $member_idx = $this->db->insert_id();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return $member_idx;
		}
	}

} // 클래스의 끝
?>

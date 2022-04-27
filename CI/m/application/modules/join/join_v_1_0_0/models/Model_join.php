<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	심정민
| Create-Date : 2021-09-03
| Memo : 회원가입
|------------------------------------------------------------------------
*/

Class Model_join extends MY_Model {

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
		";

		return $this->query_cnt($sql,array($member_name, $member_phone), $data);
	}

	public function member_name_check($data){

		$member_name = $data['member_name'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_name = FN_AES_ENCRYPT(?)
		";

		return $this->query_cnt($sql,array($member_name), $data);
	}

	//약관 리스트
	public function terms_list() {

		$sql = "SELECT
							terms_management_idx,
							title,
							type,
							member_type,
							contents,
							upd_date
						FROM
							tbl_terms_management
						WHERE
							member_type = '0'
          	";

  	return $this->query_result($sql,
                                array(
																)
                              );

	}

	//상세
  public function terms_detail($data){

    $type = $data['type'];

    $sql = "SELECT
              terms_management_idx,
              title,
              contents
            FROM
              tbl_terms_management
            WHERE member_type = '0'
						and type =?
    ";

    return $this->query_row($sql,
                            array(
                            $type
                            )
                            );
  }

	// 아이디 중복 체크
	public function member_id_check($data){

		$member_id = $data['member_id'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_id = FN_AES_ENCRYPT(?)
		";

		return $this->query_cnt($sql,array($member_id), $data);
	}

	public function member_phone_check($data){

		$member_phone = $data['member_phone'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_phone = FN_AES_ENCRYPT(?)
		";

		return $this->query_cnt($sql,array(
														$member_phone),
														$data);
	}


	// 회원 가입
	public function member_reg_in($data){

		$member_id = $data['member_id'];
		$member_pw = $data['member_pw'];
		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_member
							(
								member_id,
								member_pw,
								member_name,
								member_phone,
								del_yn,
								ins_date,
								upd_date
							) VALUES (
								FN_AES_ENCRYPT(?),
								SHA2(?, 512),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								'N',
                NOW(),
                NOW()
              )
    ";

		$this->query($sql,array(
                  $member_id,
                  $member_pw,
                  $member_name,
                  $member_phone,
							   ),$data
							 );


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
  		$member_idx = $this->db->insert_id();
			$this->db->trans_commit();
			return $member_idx;
		}
	}

}	// 클래스의 끝
?>

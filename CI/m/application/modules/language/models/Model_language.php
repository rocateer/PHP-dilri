<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-22
| Memo : 회원 정보 수정
|------------------------------------------------------------------------
*/

Class Model_language extends MY_Model {


	// 회원 정보 수정
	public function member_info_mod_up($data){

		$member_idx = $this->member_idx;
		$current_lang = $data['current_lang'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							current_lang = ?,
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

		$this->query($sql,array(
									$current_lang,
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

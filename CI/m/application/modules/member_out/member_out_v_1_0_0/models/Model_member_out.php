<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-25
| Memo : 회원탈퇴
|------------------------------------------------------------------------
*/

Class Model_member_out extends MY_Model{

	// 회원탈퇴시 데이타 삭제
	public function member_out_mod_up($data){

		$member_idx = $data['member_idx'];
		$member_leave_reason = $data['member_leave_reason'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							member_leave_reason = ?,
							member_leave_date = NOW(),
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							member_idx = ?
            ";

    $this->query($sql,
									array(
									$member_leave_reason,
									$member_idx
									),
									$data
								);
								
		// 게시글 삭제
		$sql = "UPDATE tbl_board SET del_yn='Y' WHERE member_idx ='$this->member_idx'";
		$this->query($sql,array(),$data);
		
		$sql = "UPDATE tbl_product SET del_yn='Y' WHERE member_idx ='$this->member_idx'";
		$this->query($sql,array(),$data);
		
		$sql = "UPDATE tbl_qa SET del_yn='Y' WHERE member_idx ='$this->member_idx'";
		$this->query($sql,array(),$data);

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

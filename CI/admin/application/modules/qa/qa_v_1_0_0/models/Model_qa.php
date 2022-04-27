<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-10-13
| Memo : qa 관리
|------------------------------------------------------------------------
*/

Class Model_qa extends MY_Model {

	// 총 카운트
	public function total_qa(){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_qa
						WHERE
							del_yn ='N'
					";

		return $this->query_cnt($sql,
														array(
														));
	}

	// qa 리스트 가져오기
	public function qa_list($data) {

		$member_name = $data['member_name'];
		$qa_type = $data['qa_type'];
		$member_id = $data['member_id'];
		$reply_yn = $data['reply_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$sql = "SELECT
							a.qa_idx,
							FN_AES_DECRYPT(b.member_id) AS member_id,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							a.qa_type,
							a.qa_title,
							a.ins_date,
							a.reply_yn,
							a.check_yn,
							a.del_yn
						FROM
							tbl_qa a
							JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							a.del_yn ='N'
						";

		if($qa_type != ""){
			$sql .= " AND a.qa_type IN ($qa_type) ";
		}
		
		if($member_name != ""){
  		$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		
		if($member_id != ""){
  		$sql .= " AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}

		if($reply_yn != ""){
  		$sql .= " AND a.reply_yn LIKE '%$reply_yn%' ";
		}

		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}

		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}

		$sql .= " ORDER BY a.ins_date DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data);
	}

	// qa 리스트 가져오기 총 카운트
	public function qa_list_count($data){

		$member_name = $data['member_name'];
		$member_id = $data['member_id'];
		$qa_type = $data['qa_type'];
		$reply_yn = $data['reply_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_qa a
							JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							a.del_yn ='N'
						";

		if($qa_type != ""){
			$sql .= " AND a.qa_type IN ($qa_type) ";
		}

		if($member_name != ""){
  		$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		
		if($member_id != ""){
  		$sql .= " AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}

		if($reply_yn != ""){
  		$sql .= " AND a.reply_yn LIKE '%$reply_yn%' ";
		}

		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}

		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}

		return	$this->query_cnt($sql,
														 array(
														 ),
														 $data);
	}

	// qa 상세
	public function qa_detail($data){

		$qa_idx = $data['qa_idx'];

		$sql = "SELECT
							a.qa_idx,
							a.member_idx,
							a.qa_title,
							a.qa_type,
							a.check_yn,
							a.ins_date,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							a.upd_date,
							a.qa_contents,
							FN_AES_DECRYPT(b.member_id) AS member_id,
							a.reply_contents
						FROM
							tbl_qa a
							JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							a.del_yn = 'N'
							AND a.qa_idx = ?
						";

		return $this->query_row($sql,
														array(
														$qa_idx
														),
														$data);
	}

	// qa 댓글 삭제
	public function qa_reply_del($data){

		$qa_idx = $data['qa_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_qa
						SET
							reply_contents = '',
							reply_yn = 'N',
							upd_date = NOW()
						WHERE
							qa_idx = ?
					";

		$this->query($sql,
								 array(
					 		 	 $qa_idx
								 ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// 관리자 확인
	public function check_reg_in($data){

		$qa_idx = $data['qa_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_qa
						SET
							check_yn = 'Y',
							upd_date = NOW()
						WHERE
							qa_idx = ?
					";

		$this->query($sql,
								 array(
					 		 	 $qa_idx
								 ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// qa 답변등록
	public function qa_reply_reg_in($data){

		$qa_idx = $data['qa_idx'];
		$reply_contents = $data['reply_contents'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_qa
						SET
							reply_contents = ?,
							reply_yn = 'Y',
							reply_date = NOW(),
							upd_date = NOW()
						WHERE
							qa_idx = ?
						";

		$this->query($sql,
								 array(
								 $reply_contents,
								 $qa_idx
								 ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// qa 삭제
	public function qa_del($data){

		$qa_idx = $data['qa_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_qa
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							qa_idx = ?
					";

		$this->query($sql,
								 array(
						 		 $qa_idx
								 ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}

	}

}	// 클래스의 끝
?>

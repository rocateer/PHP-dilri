<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-10-13
| Memo : FAQ 관리
|------------------------------------------------------------------------
*/

Class Model_faq extends MY_Model{

	// faq 리스트 가져오기
	public function faq_list_get($data){

		$title = $data['title'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$faq_type = $data['faq_type'];
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$sql = "SELECT
							faq_idx,
							title,
							faq_type,
							del_yn,
							ins_date
						FROM
							tbl_faq
						WHERE
							del_yn = 'N'
						";

		if($title != ""){
			$sql .= " AND title LIKE '%$title%' ";
		}
		if($faq_type != ""){
			$sql .= " AND faq_type IN ($faq_type) ";
		}
		if($s_date != ""){
			$sql .= " AND DATE(ins_date) >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE(ins_date) <= '$e_date' ";
		}

		$sql .=" ORDER BY ins_date DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															array(
															$page_no,
															$page_size
															),
															$data);
	}

	// faq 리스트 가져오기 총 카운트
	public function faq_list_count($data){

		$title = $data['title'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$faq_type = $data['faq_type'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_faq
						WHERE
							del_yn = 'N'
						";

		if($title != ""){
			$sql .= " AND title LIKE '%$title%' ";
		}
		if($faq_type != ""){
			$sql .= " AND faq_type IN ($faq_type) ";
		}
		if($s_date != ""){
			$sql .= " AND DATE(ins_date) >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE(ins_date) <= '$e_date' ";
		}

		return $this->query_cnt($sql,
														array(
														),
														$data);
	}

	// faq 상세
	public function faq_detail($data){

		$faq_idx=$data['faq_idx'];

		$sql = "SELECT
							faq_idx,
							title,
							contents,
							faq_type,
							state,
							ins_date,
							upd_date,
							del_yn
						FROM
							tbl_faq a
						WHERE
							faq_idx = ?
							AND del_yn = 'N'
						";

			return $this->query_row($sql,
															array(
													    $faq_idx
												    	),
															$data);
	}

	// faq 수정하기
	public function faq_mod_up($data){

		$faq_idx = $data['faq_idx'];
		$title = $data['title'];
		$contents = $data['contents'];
		$faq_type = $data['faq_type'];
		$state = $data['state'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_faq
						SET
							title = ?,
							contents = ?,
							faq_type = ?,
							state = ?,
							upd_date = NOW()
						WHERE
							faq_idx = ?
						";

		$this->query($sql,
								 array(
							   $title,
							   $contents,
								 $faq_type,
								 $state,
							   $faq_idx
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

	// faq 삭제
	public function faq_del($data){

		$faq_idx = $data['faq_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_faq
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							faq_idx IN ($faq_idx)
						";

		$this->query($sql,
								 array(
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

	// faq 등록
	public function faq_reg_in($data){

		$title = $data['title'];
		$contents = $data['contents'];
		$faq_type = $data['faq_type'];
		$state = $data['state'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_faq
						(
							title,
							contents,
							faq_type,
							state,
							del_yn,
							ins_date,
							upd_date
						)VALUES(
							?,
							?,
							?,
							?,
							'N',
							NOW(),
							NOW()
						)
					";

		$this->query($sql,
								array(
								$title,
								$contents,
								$faq_type,
								$state
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
	
	// 공지사항 상태 변경
	public function faq_state_mod_up($data){

		$faq_idx = $data['faq_idx'];
		$state = $data['state'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_faq
						SET
							state = ?,
							upd_date = NOW()
						WHERE
							faq_idx = ?
						";

		$this->query($sql,
								 array(
								 $state,
								 $faq_idx
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

}	//클래스의 끝
?>

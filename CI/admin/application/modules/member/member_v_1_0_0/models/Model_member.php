<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-15
| Memo :  회원 관리
|------------------------------------------------------------------------
*/

Class Model_member extends MY_Model{

	// 회원 리스트
	public function member_list($data){
		$member_id = $data['member_id'];
		$member_name = $data['member_name'];
		$del_yn = $data['del_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$s_member_point = $data['s_member_point'];
		$e_member_point = $data['e_member_point'];
		$s_product_cnt = $data['s_product_cnt'];
		$e_product_cnt = $data['e_product_cnt'];
		$s_free_product_cnt = $data['s_free_product_cnt'];
		$e_free_product_cnt = $data['e_free_product_cnt'];
		$s_good_product_cnt = $data['s_good_product_cnt'];
		$e_good_product_cnt = $data['e_good_product_cnt'];
		$s_bad_product_cnt = $data['s_bad_product_cnt'];
		$e_bad_product_cnt = $data['e_bad_product_cnt'];
		$orderby = $data['orderby'];
		$page_no = $data['page_no'];
		$page_size = $data['page_size'];

		$sql = "SELECT
							member_idx,
							FN_AES_DECRYPT(member_id) AS member_id,
							FN_AES_DECRYPT(member_name) AS member_name,
							FN_AES_DECRYPT(member_phone) AS member_phone,
							member_nickname,
							DATE_FORMAT(ins_date, '%Y-%m-%d') as ins_date,
							member_point,
							product_cnt,
							free_product_cnt,
							good_product_cnt,
							bad_product_cnt,
							member_leave_reason,
							DATE_FORMAT(member_leave_date, '%Y-%m-%d') as member_leave_date,
							del_yn
						FROM
							tbl_member
						WHERE 1=1
		";

		if($member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(member_id) LIKE '%$member_id%' ";
		}
		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(member_name) LIKE '%$member_name%' ";
		}
		if($del_yn != ""){
			$sql .= " AND del_yn = '$del_yn' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($s_member_point != ""){
			$sql .= " AND member_point >= '$s_member_point' ";
		}
		if($e_member_point != ""){
			$sql .= " AND member_point <= '$e_member_point' ";
		}
		if($s_product_cnt != ""){
			$sql .= " AND product_cnt >= '$s_product_cnt' ";
		}
		if($e_product_cnt != ""){
			$sql .= " AND product_cnt <= '$e_product_cnt' ";
		}
		if($s_free_product_cnt != ""){
			$sql .= " AND free_product_cnt >= '$s_free_product_cnt' ";
		}
		if($e_free_product_cnt != ""){
			$sql .= " AND free_product_cnt <= '$e_free_product_cnt' ";
		}
		if($s_good_product_cnt != ""){
			$sql .= " AND good_product_cnt >= '$s_good_product_cnt' ";
		}
		if($e_good_product_cnt != ""){
			$sql .= " AND good_product_cnt <= '$e_good_product_cnt' ";
		}
		if($s_bad_product_cnt != ""){
			$sql .= " AND bad_product_cnt >= '$s_bad_product_cnt' ";
		}
		if($e_bad_product_cnt != ""){
			$sql .= " AND bad_product_cnt <= '$e_bad_product_cnt' ";
		}
		if($orderby != ""){
			if($orderby == '0'){
				$sql .=" ORDER BY ins_date ASC LIMIT ?, ? ";
			}
			if($orderby == '1'){
				$sql .=" ORDER BY ins_date DESC LIMIT ?, ? ";
			}
			if($orderby == '2'){
				$sql .=" ORDER BY product_cnt ASC LIMIT ?, ? ";
			}
			if($orderby == '3'){
				$sql .=" ORDER BY product_cnt DESC LIMIT ?, ? ";
			}
			if($orderby == '4'){
				$sql .=" ORDER BY member_point ASC LIMIT ?, ? ";
			}
			if($orderby == '5'){
				$sql .=" ORDER BY member_point DESC LIMIT ?, ? ";
			}
			if($orderby == '6'){
				$sql .=" ORDER BY good_product_cnt ASC LIMIT ?, ? ";
			}
			if($orderby == '7'){
				$sql .=" ORDER BY good_product_cnt DESC LIMIT ?, ? ";
			}
			if($orderby == '8'){
				$sql .=" ORDER BY bad_product_cnt ASC LIMIT ?, ? ";
			}
			if($orderby == '9'){
				$sql .=" ORDER BY bad_product_cnt DESC LIMIT ?, ? ";
			}
			if($orderby == '10'){
				$sql .=" ORDER BY free_product_cnt ASC LIMIT ?, ? ";
			}
			if($orderby == '11'){
				$sql .=" ORDER BY free_product_cnt DESC LIMIT ?, ? ";
			}
		}else{
			$sql .=" ORDER BY ins_date DESC LIMIT ?, ? ";
		}

		return $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 회원 리스트
	public function member_list_count($data){
		$member_id = $data['member_id'];
		$member_name = $data['member_name'];
		$del_yn = $data['del_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$s_member_point = $data['s_member_point'];
		$e_member_point = $data['e_member_point'];
		$s_product_cnt = $data['s_product_cnt'];
		$e_product_cnt = $data['e_product_cnt'];
		$s_free_product_cnt = $data['s_free_product_cnt'];
		$e_free_product_cnt = $data['e_free_product_cnt'];
		$s_good_product_cnt = $data['s_good_product_cnt'];
		$e_good_product_cnt = $data['e_good_product_cnt'];
		$s_bad_product_cnt = $data['s_bad_product_cnt'];
		$e_bad_product_cnt = $data['e_bad_product_cnt'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_member
						WHERE
							1=1
		";

		if($member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(member_id) LIKE '%$member_id%' ";
		}
		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(member_name) LIKE '%$member_name%' ";
		}
		if($del_yn != ""){
			$sql .= " AND del_yn = '$del_yn' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($s_member_point != ""){
			$sql .= " AND member_point >= '$s_member_point' ";
		}
		if($e_member_point != ""){
			$sql .= " AND member_point <= '$e_member_point' ";
		}
		if($s_product_cnt != ""){
			$sql .= " AND product_cnt >= '$s_product_cnt' ";
		}
		if($e_product_cnt != ""){
			$sql .= " AND product_cnt <= '$e_product_cnt' ";
		}
		if($s_free_product_cnt != ""){
			$sql .= " AND free_product_cnt >= '$s_free_product_cnt' ";
		}
		if($e_free_product_cnt != ""){
			$sql .= " AND free_product_cnt <= '$e_free_product_cnt' ";
		}
		if($s_good_product_cnt != ""){
			$sql .= " AND good_product_cnt >= '$s_good_product_cnt' ";
		}
		if($e_good_product_cnt != ""){
			$sql .= " AND good_product_cnt <= '$e_good_product_cnt' ";
		}
		if($s_bad_product_cnt != ""){
			$sql .= " AND bad_product_cnt >= '$s_bad_product_cnt' ";
		}
		if($e_bad_product_cnt != ""){
			$sql .= " AND bad_product_cnt <= '$e_bad_product_cnt' ";
		}

		return $this->query_cnt($sql,
													  array(
														),$data);
	}

	// 회원 리스트 엑셀 다운로드
	public function member_list_excel($data){
		$member_id = $data['member_id'];
		$member_name = $data['member_name'];
		$del_yn = $data['del_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$s_member_point = $data['s_member_point'];
		$e_member_point = $data['e_member_point'];
		$s_product_cnt = $data['s_product_cnt'];
		$e_product_cnt = $data['e_product_cnt'];
		$s_free_product_cnt = $data['s_free_product_cnt'];
		$e_free_product_cnt = $data['e_free_product_cnt'];
		$s_good_product_cnt = $data['s_good_product_cnt'];
		$e_good_product_cnt = $data['e_good_product_cnt'];
		$s_bad_product_cnt = $data['s_bad_product_cnt'];
		$e_bad_product_cnt = $data['e_bad_product_cnt'];
		$orderby = $data['orderby'];

		$sql = "SELECT
							member_idx,
							FN_AES_DECRYPT(member_id) AS member_id,
							FN_AES_DECRYPT(member_name) AS member_name,
							FN_AES_DECRYPT(member_phone) AS member_phone,
							member_nickname,
							DATE_FORMAT(ins_date, '%Y-%m-%d') as ins_date,
							member_point,
							product_cnt,
							free_product_cnt,
							good_product_cnt,
							bad_product_cnt,
							member_leave_reason,
							DATE_FORMAT(member_leave_date, '%Y-%m-%d') as member_leave_date,
							del_yn
						FROM
							tbl_member
						WHERE
							1=1
		";

		if($member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(member_id) LIKE '%$member_id%' ";
		}
		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(member_name) LIKE '%$member_name%' ";
		}
		if($del_yn != ""){
			$sql .= " AND del_yn = '$del_yn' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($s_member_point != ""){
			$sql .= " AND member_point >= '$s_member_point' ";
		}
		if($e_member_point != ""){
			$sql .= " AND member_point <= '$e_member_point' ";
		}
		if($s_product_cnt != ""){
			$sql .= " AND product_cnt >= '$s_product_cnt' ";
		}
		if($e_product_cnt != ""){
			$sql .= " AND product_cnt <= '$e_product_cnt' ";
		}
		if($s_free_product_cnt != ""){
			$sql .= " AND free_product_cnt >= '$s_free_product_cnt' ";
		}
		if($e_free_product_cnt != ""){
			$sql .= " AND free_product_cnt <= '$e_free_product_cnt' ";
		}
		if($s_good_product_cnt != ""){
			$sql .= " AND good_product_cnt >= '$s_good_product_cnt' ";
		}
		if($e_good_product_cnt != ""){
			$sql .= " AND good_product_cnt <= '$e_good_product_cnt' ";
		}
		if($s_bad_product_cnt != ""){
			$sql .= " AND bad_product_cnt >= '$s_bad_product_cnt' ";
		}
		if($e_bad_product_cnt != ""){
			$sql .= " AND bad_product_cnt <= '$e_bad_product_cnt' ";
		}
		if($orderby != ""){
			if($orderby == '0'){
				$sql .=" ORDER BY ins_date ASC";
			}
			if($orderby == '1'){
				$sql .=" ORDER BY ins_date DESC";
			}
			if($orderby == '2'){
				$sql .=" ORDER BY product_cnt ASC";
			}
			if($orderby == '3'){
				$sql .=" ORDER BY product_cnt DESC";
			}
			if($orderby == '4'){
				$sql .=" ORDER BY member_point ASC";
			}
			if($orderby == '5'){
				$sql .=" ORDER BY member_point DESC";
			}
			if($orderby == '6'){
				$sql .=" ORDER BY good_product_cnt ASC";
			}
			if($orderby == '7'){
				$sql .=" ORDER BY good_product_cnt DESC";
			}
			if($orderby == '8'){
				$sql .=" ORDER BY bad_product_cnt ASC";
			}
			if($orderby == '9'){
				$sql .=" ORDER BY bad_product_cnt DESC";
			}
			if($orderby == '10'){
				$sql .=" ORDER BY free_product_cnt ASC";
			}
			if($orderby == '11'){
				$sql .=" ORDER BY free_product_cnt DESC";
			}
		}else{
			$sql .=" ORDER BY ins_date DESC";
		}

		return $this->query_result($sql,array(
															 ),$data
														 );
	}

	// 회원 상세
	public function member_detail($data){
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							member_idx,
							FN_AES_DECRYPT(member_id) AS member_id,
							FN_AES_DECRYPT(member_name) AS member_name,
							ins_date,
							del_yn,
							member_leave_date,
							member_leave_reason,
							member_point,
							product_cnt,
							free_product_cnt,
							good_product_cnt,
							bad_product_cnt,
							#신고평가
							good_product_cnt_0,
							good_product_cnt_1,
							good_product_cnt_2,
							good_product_cnt_3,
							good_product_cnt_4,
							bad_product_cnt_0,
							bad_product_cnt_1,
							bad_product_cnt_2,
							bad_product_cnt_3,
							bad_product_cnt_4,
							bad_product_cnt_5,
							bad_product_cnt_6,
							bad_product_cnt_7,
							free_product_cnt_0,
							free_product_cnt_1,
							free_product_cnt_2,
							free_product_cnt_3,
							free_product_cnt_4,
							free_product_cnt_5,
							free_product_cnt_6,
							free_product_cnt_7,
							free_product_cnt_8,
							memo
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

	// 메모 수정
	public function memo_mod_up($data){
		$member_idx = $data['member_idx'];
		$memo = $data['memo'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							memo = ?,
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

		$this->query($sql,
									array(
									$memo,
									$member_idx
									),
									$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return '0';
		}else{
			$this->db->trans_commit();
			return '1';
		}

	}

	// 회원 상태 변경
	public function member_state_mod_up($data){
		$member_idx = $data['member_idx'];
		$del_yn = $data['del_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							del_yn = ?,
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

		$this->query($sql,
								array(
								$del_yn,
								$member_idx
								),
								$data
							);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return '0';
		} else if($this->db->trans_status() == TRUE){
			$this->db->trans_commit();
			return '1';
		}

	}

}	//클래스의 끝
?>

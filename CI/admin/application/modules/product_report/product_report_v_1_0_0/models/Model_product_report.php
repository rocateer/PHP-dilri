<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-15
| Memo : 상품 신고 관리
|------------------------------------------------------------------------
*/

Class Model_product_report extends MY_Model{

	// 신고관리 리스트
	public function product_report_list($data){
		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$member_name = $data['member_name'];
		$member_id = $data['member_id'];
		$reported_member_name = $data['reported_member_name'];
		$reported_member_id = $data['reported_member_id'];
		$report_type = $data['report_type'];
		$display_yn = $data['display_yn'];

		$sql = "SELECT
							a.product_report_idx,
							b.member_idx as reported_member_idx,
							FN_AES_DECRYPT(c.member_name) as member_name,
							FN_AES_DECRYPT(c.member_id) as member_id,
							FN_AES_DECRYPT(d.member_name) as reported_member_name,
							FN_AES_DECRYPT(d.member_id) as reported_member_id,
							b.title,
							a.report_type,
							a.report_contents,
							a.product_idx,
							a.ins_date,
							b.display_yn,
							a.del_yn
						FROM
							tbl_product_report a
							JOIN tbl_product b ON b.product_idx = a.product_idx and b.del_yn='N'
							JOIN tbl_member c ON c.member_idx = a.member_idx
							JOIN tbl_member d ON d.member_idx = b.member_idx
						WHERE
							a.del_yn = 'N'
		";

		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(c.member_name) LIKE '%$member_name%' ";
		}
		if($member_id != ""){
			$sql .= " AND	FN_AES_DECRYPT(c.member_id) LIKE '%$member_id%' ";
		}
		if($reported_member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(d.member_name) LIKE '%$reported_member_name%' ";
		}
		if($reported_member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(d.member_id) LIKE '%$reported_member_id%' ";
		}
		if($report_type != ""){
			$sql .= " AND a.report_type IN ($report_type) ";
		}
		if($display_yn != ""){
			$sql .= " AND b.display_yn = '$display_yn' ";
		}

		$sql .=" ORDER BY product_report_idx DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data);
	}

	// 신고관리 리스트 총 카운트
	public function product_report_list_count($data){

		$member_name = $data['member_name'];
		$member_id = $data['member_id'];
		$reported_member_name = $data['reported_member_name'];
		$reported_member_id = $data['reported_member_id'];
		$report_type = $data['report_type'];
		$display_yn = $data['display_yn'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_product_report a
							JOIN tbl_product b ON b.product_idx = a.product_idx and b.del_yn='N'
							JOIN tbl_member c ON c.member_idx = a.member_idx
							JOIN tbl_member d ON d.member_idx = b.member_idx
						WHERE
							a.del_yn = 'N'
		";

		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(c.member_name) LIKE '%$member_name%' ";
		}
		if($member_id != ""){
			$sql .= " AND c.member_id LIKE '%$member_id%' ";
		}
		if($reported_member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(d.member_name) LIKE '%$reported_member_name%' ";
		}
		if($reported_member_id != ""){
			$sql .= " AND d.member_id LIKE '%$reported_member_id%' ";
		}
		if($report_type != ""){
			$sql .= " AND a.report_type IN ($report_type) ";
		}
		if($display_yn != ""){
			$sql .= " AND b.display_yn = '$display_yn' ";
		}

		return $this->query_cnt($sql,
														array(
														),
														$data);
	}

}	//클래스의 끝
?>

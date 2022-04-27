<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-20
| Memo : 포인트 관리
|------------------------------------------------------------------------
*/

Class Model_member_point extends MY_Model{

	// 포인트 관리 리스트
	public function member_point_list($data){

		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$member_id 	 = $data['member_id'];
		$member_name 	 = $data['member_name'];
		$s_date 	 = $data['s_date'];
		$e_date 	 = $data['e_date'];
		$point_type 	 = $data['point_type'];

		$sql = "SELECT
							FN_AES_DECRYPT(b.member_id) AS member_id,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							a.point_type,
							a.point,
							a.memo,
							a.ins_date
						FROM
							tbl_member_point AS a LEFT JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE 1=1
		";

		if($member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}
		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($point_type != ""){
			$sql .= " AND a.point_type = '$point_type' ";
		}

		$sql .=" ORDER BY a.ins_date DESC LIMIT ?, ? ";

		return $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 포인트 관리 리스트 카운트
	public function member_point_list_count($data){
		$member_id 	 = $data['member_id'];
		$member_name 	 = $data['member_name'];
		$s_date 	 = $data['s_date'];
		$e_date 	 = $data['e_date'];
		$point_type 	 = $data['point_type'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_member_point AS a LEFT JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE 1=1
		";

		if($member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}
		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($point_type != ""){
			$sql .= " AND a.point_type = '$point_type' ";
		}

		return $this->query_cnt($sql,array());
	}

  // 회원 리스트
	public function member_list(){

		$sql = "SELECT
							a.member_idx,
							FN_AES_DECRYPT(member_id) AS member_id,
							FN_AES_DECRYPT(member_name) AS member_name,
							member_join_type,
							member_point,
							a.ins_date
						FROM
							tbl_member AS a
						WHERE
							a.del_yn='N'
						ORDER BY
							a.member_name ASC
		";

		return $this->query_result($sql,array(
															 )
														 );
	}

	// 회원 리스트
	public function group_member_list($data){
		$member_id = $data['member_id'];
		$member_name = $data['member_name'];
		$del_yn = $data['del_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$s_member_point = $data['s_member_point'];
		$e_member_point = $data['e_member_point'];
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
		
		$sql .=" ORDER BY member_idx DESC LIMIT ?, ? ";


		return $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 회원 리스트
	public function group_member_list_count($data){
		$member_id = $data['member_id'];
		$member_name = $data['member_name'];
		$del_yn = $data['del_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$s_member_point = $data['s_member_point'];
		$e_member_point = $data['e_member_point'];

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

		return $this->query_cnt($sql,
													  array(
														),$data);
	}

  // 그룹 회원 리스트
	// public function group_member_list($data){
	// 	$member_idxs = $data['member_idxs'];

	// 	$sql = "SELECT
	// 						a.member_idx,
	// 						FN_AES_DECRYPT(member_id) AS member_id,
	// 						FN_AES_DECRYPT(member_name) AS member_name,
	// 						member_join_type,
	// 						member_point,
	// 						a.ins_date
	// 					FROM
	// 						tbl_member AS a
	// 					WHERE
	// 						a.del_yn='N'
	// 						AND a.member_idx IN ($member_idxs)
	// 					ORDER BY
	// 						a.member_name ASC
	// 	";

	// 	return $this->query_result($sql,array(
	// 														 )
	// 													 );
	// }

	// 포인트 지급/차감
	public function member_point_reg_in($data){

		$member_idx = $data['member_idx'];
		$memo = $data['memo'];
		$point_type = $data['point_type'];
		$point = $point_type==0?$data['point']:$data['point']*-1;

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_member_point
						(
							member_idx,
							memo,
							point_type,
							point,
							type,
							del_yn,
							ins_date,
							upd_date
						) VALUES (
							?,
							?,
							?,
							?,
							'0',
							'N',
							NOW(),
							NOW()
						)
						";

		$this->query($sql,array(
								$member_idx,
								$memo,
								$point_type,
								$point,
							   ),$data
						   );

		$member_point_idx = $this->db->insert_id();


		$sql = "UPDATE
								tbl_member a,
								(select
									IF(SUM(b.point)>=0,SUM(b.point), 0) AS total_point
									from
										tbl_member_point b
							 		WHERE
							 			b.del_yn = 'N'
										AND b.member_idx = '$member_idx'
								) as tb_b
							SET
								a.member_point = tb_b.total_point,
								a.upd_date = NOW()
							WHERE
								a.member_idx = '$member_idx'
						";

			$this->query($sql,
										array(

										),
									$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
	   	return $member_point_idx;
		}
	}

	// 포인트 지급/차감
	public function total_member_point_reg_in($data){

		$member_idx = $data['member_idx'];
		$memo = $data['memo'];
		$point_type = $data['point_type'];
		$point = $point_type==0?$data['point']:$data['point']*-1;

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_member_point
						(
							member_idx,
							memo,
							point_type,
							point,
							type,
							del_yn,
							ins_date,
							upd_date
						) select 
							z.member_idx,
							?,
							?,
							?,
							'0',
							'N',
							NOW(),
							NOW()
						from 
							tbl_member z
						where
							z.del_yn != 'Y'
						";

		$this->query($sql,array(
								$memo,
								$point_type,
								$point,
							   ),$data
						   );

		$sql = "UPDATE
							tbl_member a
						SET
							a.member_point = (SELECT
																	IF(SUM(b.point)>=0,SUM(b.point), 0)
																FROM
																	tbl_member_point b
																WHERE
																	b.del_yn = 'N'
																	AND b.member_idx = a.member_idx
							),
							a.upd_date = NOW()
						";

			$this->query($sql,
										array(

										),
									$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
	   	return '1';
		}
	}

	// 포인트 지급/차감
	public function group_member_point_reg_in($data){

		$member_idxs = $data['member_idxs'];
		$memo = $data['memo'];
		$point_type = $data['point_type'];
		$point = $point_type==0?$data['point']:$data['point']*-1;

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_member_point
						(
							member_idx,
							memo,
							point_type,
							point,
							type,
							del_yn,
							ins_date,
							upd_date
						) select 
							z.member_idx,
							?,
							?,
							?,
							'0',
							'N',
							NOW(),
							NOW()
						from 
							tbl_member z
						where
							z.del_yn != 'Y'
							AND z.member_idx IN ($member_idxs)
						";

		$this->query($sql,array(
								$memo,
								$point_type,
								$point,
							   ),$data
						   );

		$sql = "UPDATE
							tbl_member a
						SET
							a.member_point = (SELECT
																	IF(SUM(b.point)>=0,SUM(b.point), 0)
																FROM
																	tbl_member_point b
																WHERE
																	b.del_yn = 'N'
																	AND b.member_idx = a.member_idx
							),
							a.upd_date = NOW()
						WHERE
							member_idx IN ($member_idxs)
						";

			$this->query($sql,
										array(

										),
									$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
	   	return '1';
		}
	}



}	//클래스의 끝
?>

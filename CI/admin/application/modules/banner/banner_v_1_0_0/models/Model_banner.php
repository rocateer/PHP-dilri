<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-09-30
| Memo : 배너관리
|------------------------------------------------------------------------
*/

Class Model_banner extends MY_Model {

  // 배너 리스트
	public function banner_list($data) {
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$title = $data['title'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$state = $data['state'];

		$sql = "SELECT
							banner_idx,
							banner_type,
							title,
							contents,
							state,
							ins_date,
							hits_cnt
						FROM
							tbl_banner
						WHERE
							del_yn = 'N'
							";

		if($title !=""){
			$sql .= " AND title  LIKE '%$title%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($state != ""){
			$sql .= " AND state = '$state'";
		}

		$sql.=" ORDER BY ins_date DESC limit ?, ?";

	  return	$this->query_result($sql
																,array(
																$page_no,
																$page_size
																),
																$data);
	}

  // 배너 리스트 총 카운트
	public function banner_list_count($data) {
		$title = $data['title'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$state = $data['state'];

		$sql = "SELECT
					    count(*) as cnt
						FROM
							tbl_banner
						WHERE
							del_yn = 'N'
							";

		if($title !=""){
			$sql .= " AND title  LIKE '%$title%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($state != ""){
			$sql .= " AND state = '$state'";
		}

		return $this->query_cnt($sql,
														array(
														),
														$data);
	}

	// 배너 상세
	public function banner_detail($data){
	  $banner_idx = $data['banner_idx'];

	  $sql="SELECT
          	banner_idx,
						title,
						contents,
						banner_s_date,
						banner_e_date,
						img_path,
						img_width,
						img_height,
						link_url,
						state,
						hits_cnt,
						ins_date
          FROM
            tbl_banner
          WHERE
            banner_idx = ?
						AND del_yn = 'N'
        ";

    return	$this->query_row($sql,
														array(
														$banner_idx
														),
														$data
														);
	}

	// 배너 등록하기
	public function banner_reg_in($data){
		$title = $data['title'];
		$link_url = $data['link_url'];
		$img_path = $data['img_path'];
		$img_width = $data['img_width'];
		$img_height = $data['img_height'];
		$banner_type = $data['banner_type'];

		$sql = "INSERT INTO
							tbl_banner
							(
								title,
								link_url,
								img_path,
								img_width,
								img_height,
								banner_type,
								state,
								ins_date,
								upd_date
						)VALUES(
								?,
								?,
								?,
								?,
								?,
								?,
								1,
								NOW(),
								NOW()
							)
					";

		$this->query($sql,
								 array(
								 $title,
								 $link_url,
								 $img_path,
								 $img_width,
								 $img_height,
								 $banner_type
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

	// 배너 수정하기
	public function banner_mod_up($data){

		$banner_idx = $data['banner_idx'];
		$title = $data['title'];
		$contents = $data['contents'];
		$link_url = $data['link_url'];
		$img_path = $data['img_path'];
		$img_width = $data['img_width'];
		$img_height = $data['img_height'];
		$state = $data['state'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_banner
						SET
							title = ?,
							contents = ?,
							link_url = ?,
							img_path = ?,
							img_width = ?,
							img_height = ?,
							state = ?,
							upd_date = NOW()
						WHERE
							banner_idx = ?
					";

		$this->query($sql,
								 array(
								 $title,
								 $contents,
								 $link_url,
								 $img_path,
								 $img_width,
								 $img_height,
								 $state,
								 $banner_idx
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

	// 배너 상태 변경
	public function banner_state_mod_up($data){

		$banner_idx  = $data['banner_idx'];
		$state = $data['state'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_banner
						SET
							state = ?,
							upd_date = NOW()
						WHERE
							banner_idx = ?
						";

		$this->query($sql,
								 array(
								 $state,
								 $banner_idx
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

	// 배너 삭제
	public function banner_del($data){

		$banner_idx = $data['banner_idx'];

		$this->db->trans_begin();

		$sql = " 	UPDATE
								tbl_banner
							SET
								del_yn = 'Y',
								upd_date = NOW()
							WHERE
								banner_idx IN ($banner_idx)
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
			return "1";
		}
	}
}
?>

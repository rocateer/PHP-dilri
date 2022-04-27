<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-10-13
| Memo : 공지사항 관리
|------------------------------------------------------------------------
*/

Class Model_forbidden_search extends MY_Model{

	// 공지사항 리스트
	public function forbidden_search_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$sql = "SELECT
							forbidden_search_idx,
							title,
							del_yn,
							DATE_FORMAT(upd_date,'%Y-%m-%d') as  upd_date
						FROM
							tbl_forbidden_search
						WHERE
							del_yn = 'N'
		";

		$sql .=" ORDER BY forbidden_search_idx DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data);
	}

	// 공지사항 리스트 총 카운트
	public function forbidden_search_list_count($data){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_forbidden_search
						WHERE
							del_yn = 'N'
		";

		return $this->query_cnt($sql,
													  array(
														));
	}
	
	
	
  /*
  |------------------------------------------------------------------------
  | Memo : 엑셀 업로드
  |------------------------------------------------------------------------
  */
  public function temp_data_reg_in($data) {
		$data_arr=$data['data_detail'];
		$upload_data_type=$data['upload_data_type'];
		$keycode=$data['keycode'];
		
		// var_dump($data_arr);
		// exit;
		
		$this->db->trans_begin();

		for($i=1;$i<count($data_arr);$i++){

      $item_0  =$data_arr[$i][0];
			if (!empty($item_0)) {
				$sql = "INSERT INTO
								tbl_excel_upload
							(
              	item_0,
              	keycode
							) VALUES (
                ?,
                ?
							)
				";
				
				$this->query($sql,
											array(
												$item_0,
												$keycode,
											),
											$data
											);
			}
      
    }

		if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "0";
		}else{
  		$this->db->trans_commit();
  		return "1";
		}

	}


  //임시 등록 결과 리스트
  public function temp_data_list($data) {
    $keycode=$data['keycode'];

    $sql = "SELECT
              a.item_0,
              a.keycode
            FROM
              tbl_excel_upload as a
            WHERE
               a.keycode = ?
  ";

    return $this->query_result($sql, array($keycode),$data);
  }


  //실제등록
  public function real_data_reg_in($data) {
    $keycode=$data['keycode'];

		$this->db->trans_begin();
		
		$this->forbidden_search_del();

    $sql = "INSERT INTO
							tbl_forbidden_search
						(
            	title,
              del_yn,
							ins_date,
							upd_date
						)
            SELECT
              item_0,
              'N',
              now(),
              now()
            from tbl_excel_upload
            where keycode = ?
			";
			$this->query($sql,
										array(
                      $keycode,
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

	// 전체 삭제
	public function forbidden_search_del(){

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_forbidden_search
						SET
							del_yn = 'Y',
							upd_date = NOW()
						";

		$this->query($sql,array());

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		  return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}
	
	
	
	
	
	
	

	// 공지사항 등록
	public function forbidden_search_reg_in($data){

		$title = $data['title'];
		$contents = $data['contents'];
		$img_path = $data['img_path'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_forbidden_search
						(
							title,
							contents,
							img,
							del_yn,
							ins_date,
							upd_date
						)VALUES(
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
								 $img_path
							   ),
								 $data);

		$forbidden_search_idx = $this->db->insert_id();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
	   	return $forbidden_search_idx;
		}
	}

	// 공지사항 상세
	public function forbidden_search_detail($data){

		$forbidden_search_idx = $data['forbidden_search_idx'];

		$sql = "SELECT
	          	forbidden_search_idx,
							title,
							contents,
							img,
							DATE_FORMAT(ins_date,'%Y-%m-%d') AS ins_date,
							DATE_FORMAT(upd_date,'%Y-%m-%d') AS upd_date,
							forbidden_search_state,
							del_yn
	        	FROM
	          	tbl_forbidden_search
	        	WHERE
	           	forbidden_search_idx = ?
							AND del_yn = 'N'
					";

   		return $this->query_row($sql,
															array(
														  $forbidden_search_idx
														  ),
															$data);
	}

	// 공지사항 수정
	public function forbidden_search_mod_up($data){

		$forbidden_search_idx = $data['forbidden_search_idx'];
		$title = $data['title'];
		$contents = $data['contents'];
		$img_path = $data['img_path'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_forbidden_search
						SET
							title = ?,
							contents = ?,
							img = ?,
							upd_date = NOW()
						WHERE
							forbidden_search_idx = ?
						";

		$this->query($sql,
								 array(
							   $title,
							   $contents,
							   $img_path,
							   $forbidden_search_idx
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
	public function forbidden_search_state_mod_up($data){

		$forbidden_search_idx  = $data['forbidden_search_idx'];
		$forbidden_search_state = $data['forbidden_search_state'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_forbidden_search
						SET
							forbidden_search_state = ?,
							upd_date = NOW()
						WHERE
							forbidden_search_idx = ?
						";

		$this->query($sql,
								 array(
								 $forbidden_search_state,
								 $forbidden_search_idx
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

	// 공지사항 삭제
	

}	//클래스의 끝
?>

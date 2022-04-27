<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2020-04-02
| Memo : 엑셀 업로드
|------------------------------------------------------------------------
*/

Class Model_excel_upload extends MY_Model {


  /*
  |------------------------------------------------------------------------
  | Memo : 엑셀 업로드
  |------------------------------------------------------------------------
  */
  public function temp_data_reg_in($data) {
		$data_arr=$data['data_detail'];
		$upload_data_type=$data['upload_data_type'];
		$keycode=$data['keycode'];

		$this->db->trans_begin();

		for($i=1;$i<count($data_arr);$i++){

      $item_0  =$data_arr[$i][0];
      $item_1 =$data_arr[$i][1];
      $item_2 =$data_arr[$i][2];
      $item_3 =$data_arr[$i][3];
      $item_4  =$data_arr[$i][4];

      $sql = "INSERT INTO
								tbl_excel_upload
							(
              	item_0,
              	item_1,
              	item_2,
              	item_3,
              	item_4,
              	keycode
							) VALUES (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
							)
			";
			$this->query($sql,
										array(
                      $item_0,
                      $item_1,
                      $item_2,
                      $item_3,
                      $item_4,
                      $keycode,
										),
										$data
										);
    }

		if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "0";
		}else{
  		$this->db->trans_commit();
  		return "1";
		}

	}


  //바로등록
  public function immediately_reg_in($data) {
    $data_arr=$data['data_detail'];
    $upload_data_type=$data['upload_data_type'];
    $keycode=$data['keycode'];

    $this->db->trans_begin();

    for($i=1;$i<count($data_arr);$i++){

      $item_0  =$data_arr[$i][0];
      $item_1 =$data_arr[$i][1];
      $item_2 =$data_arr[$i][2];
      $item_3 =$data_arr[$i][3];
      $item_4  =$data_arr[$i][4];

      $sql = "INSERT INTO
                tbl_excel
              (
                tire_no,
                corp_code,
                tire_size,
                ipcode,
                dot,
                keycode,
                ins_date,
                upd_date
              ) VALUES (
                ?,
                ?,
                ?,
                ?,
                ?,
                ?,
                NOW(), -- ins_date
                NOW() -- upd_date
              )
      ";
      $this->query($sql,
                    array(
                      $item_0,
                      $item_1,
                      $item_2,
                      $item_3,
                      $keycode,
                    ),
                    $data
                    );
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
              a.item_1,
              a.item_2,
              a.item_3,
              a.item_4,
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

    $sql = "INSERT INTO
							tbl_book
						(
            	book_name,
            	category,
            	publisher,
            	author,
            	isbn,
              display_yn,
              del_yn,
							ins_date,
							upd_date
						)
            SELECT
              item_0,
              item_1,
              item_2,
              item_3,
              item_4,
              'Y',
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


}	// 클래스의 끝
?>

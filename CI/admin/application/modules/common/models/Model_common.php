<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
  .  ____  .    ________________________________________________________
  |/      \|   | Create-Date :  2017.08.05 | Author : 김옥훈
 [| ♥    ♥ |]  | Modify-Date :  2017.??.?? | Editor : 서욘두
  |___==___|  V  Class-Name  :  common
             / | Memo        :  공통 영역 관리
               |________________________________________________________
*/

Class Model_common extends MY_Model {

	// 지역 시도 리스트
	public function city_list() {

		$sql = "SELECT
							city_cd,
							city_name,
							id_cd

						FROM
							tbl_city_cd

						ORDER BY
							order_no ASC
				  ";

		return $this->query_result($sql,array());

	}

	// 구군 리스트
	public function region_list($data) {

		$city_cd = $data['city_cd'];

		$sql = "SELECT
							region_cd,
							region_name,
							city_cd

						FROM
							tbl_region_cd

						WHERE
							city_cd = ?

						ORDER BY
							order_no ASC
				  ";

		return $this->query_result($sql
																	,array(
																					$city_cd
																				)
																			);

	}

  // smtp 조회
  public function smtp_detail2(){

    $sql = "SELECT
              smtp_email_idx,
              smtp_host,
              smtp_user,
              smtp_pass,
              smtp_port,
              from_email,
              from_name
            FROM
              tbl_smtp_email
            WHERE
              del_yn = 'N'
              ORDER BY last_send_date ASC,smtp_email_idx ASC LIMIT 1
            ";

  return $this->query_row($sql,array(
                            )
                            );
  }

  //마지막 stmp 발송일 수정
  public function smtp_last_date_mod_up($data){

		$smtp_email_idx = $data['smtp_email_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_smtp_email
						SET
              send_cnt = CASE WHEN DATE_FORMAT(last_send_date,'%Y%m%d') <> DATE_FORMAT(NOW(),'%Y%m%d') THEN 1 ELSE send_cnt+1 END,
              last_send_date	= NOW(),
							upd_date = NOW()
						WHERE
							smtp_email_idx = ?
						";

		$this->query($sql,array(
									$smtp_email_idx
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

}
?>

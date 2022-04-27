<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-05-07
| Memo : 알람
|------------------------------------------------------------------------
*/

Class Model_alarm extends MY_Model {

  // 알림 리스트
  public function alarm_list($data){
    $page_size = (int)$data['page_size'];
    $page_no = (int)$data['page_no'];

    $member_idx = (int)$this->member_idx;

    $this->all_alarm_read_mod_up();

		$sql = "SELECT
              alarm_idx,
              member_idx,
              msg,
              data,
              read_yn,
              del_yn,
              DATE_FORMAT(ins_date,'%Y.%m.%d') as ins_date,
              DATE_FORMAT(ins_date,'%H:%i') as ins_date_hm,
              upd_date
            FROM
              tbl_alarm
            WHERE
              member_idx = ?
              AND del_yn = 'N'
	  ";

    $sql .= "	ORDER BY alarm_idx DESC  ";

		return $this->query_result($sql,
                              array(
                              $member_idx,
                              ),$data
                              );
  }

  // 알림 리스트 카운트
	public function alarm_list_count(){

    $member_idx = (int)$this->member_idx;

		$sql = "SELECT
            	count(*) as cnt
            FROM
            	tbl_alarm
            WHERE
            	del_yn = 'N'
              AND member_idx = ?
				  ";

		return $this->query_cnt($sql,array($member_idx));

	}

  // 알림읽음표시
  public function alarm_read_mod_up($data){

    $alarm_idx = (int)$data['alarm_idx'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_alarm
            SET
              read_yn = 'Y',
              upd_date =NOW()
            WHERE
              alarm_idx = ?
    ";

    $this->query($sql,
                array(
                $alarm_idx
                ),$data
                );

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "-1";
    }else{
      $this->db->trans_commit();
      return "1000";
    }
  }

  // 알림읽음표시
  public function all_alarm_read_mod_up(){

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_alarm
            SET
              read_yn = 'Y',
              upd_date =NOW()
            WHERE
              member_idx = ?
              AND read_yn = 'N'
    ";

    $this->query($sql,
                array(
                $this->member_idx
                )
                );

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "-1";
    }else{
      $this->db->trans_commit();
      return "1000";
    }
  }

  // 알림 삭제
	public function alarm_del($data){

	  $alarm_idx = (int)$data['alarm_idx'];

	  $this->db->trans_begin();

		$sql = "UPDATE
	          	tbl_alarm
	          SET
	          	del_yn = 'Y',
	          	upd_date =NOW()
	          WHERE
							alarm_idx = ?
	        	";

	  $this->query($sql,
                array(
                $alarm_idx
                ),$data
                );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

  // 전체삭제
	public function all_alarm_del(){

	  $this->db->trans_begin();

		$sql = "UPDATE
	          	tbl_alarm
	          SET
	          	del_yn = 'Y',
	          	upd_date =NOW()
	          WHERE
							member_idx = ?
	        	";

	  $this->query($sql,
                array(
                $this->member_idx
                )
                );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

  // 알림 리스트 총 카운트
	public function new_alarm_count($data){

    $member_idx = (int)$data['member_idx'];

		$sql = "SELECT
            	count(*) as cnt
            FROM
            	tbl_alarm
            WHERE
            	del_yn = 'N'
            	AND read_yn = 'N'
              AND member_idx = ?
    ";

		return $this->query_cnt($sql,array($member_idx));
	}

  // 알람 설정보기
  public function alarm_toggle_view($data){

    $member_idx = (int)$data['member_idx'];

      $sql = "SELECT
                all_alarm_yn
              FROM
                tbl_member
              WHERE
                member_idx = ?
              ";

    return $this->query_row($sql,
                            array(
                            $member_idx,
                            ),$data
                            );
	}

  // 알림 설정
  public function alarm_toggle($data){

    $member_idx = (int)$data['member_idx'];
    $all_alarm_yn = $data['all_alarm_yn'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_member
  					SET
              all_alarm_yn='$all_alarm_yn',
              upd_date = NOW()
  				  WHERE
  					  member_idx = ?
		";

    $this->query($sql,
                array(
                $member_idx
                ),$data
                );

    if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}

  }
  
  // 알람 방해 금지 설정 가져오기
  public function get_alarm_setting(){
    $sql = "SELECT
              no_alarm_yn,
              alram_s_date,
              alram_e_date
            FROM
              tbl_member
            WHERE
              member_idx = '$this->member_idx'
              ";
    
    return $this->query_row($sql,array());
  }
  
  // 알람 방해 금지 설정 변경
  public function alarm_setting_mod_up($data){
    $member_idx = $this->member_idx;
    $no_alarm_yn = $data['no_alarm_yn'];
    $alram_s_date = $data['alram_s_date'];
    $alram_e_date = $data['alram_e_date'];
    
    $this->db->trans_begin();
    
    $sql = "UPDATE
              tbl_member
            SET
              no_alarm_yn = ?,
              alram_s_date = ?,
              alram_e_date = ?
            WHERE
              member_idx = ?";
              
      $this->query($sql,
                    array(
                    $no_alarm_yn,
                    $alram_s_date,
                    $alram_e_date,
                    $member_idx
                    ),
                    $data
                  );
    
    if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
  }
  
	// 해시태그 등록
  public function hashtag_reg_in($data){
    $member_idx = $this->member_idx;
    $alarm_keyword = $data['alarm_keyword'];
    
    $this->db->trans_begin();
    
    $sql = "UPDATE
              tbl_member
            SET
              alarm_keyword = ?
            WHERE
              member_idx = ?";
              
      $this->query($sql,
                    array(
                    $alarm_keyword,
                    $member_idx
                    ),
                    $data
                  );
    
    if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
  }
  
  // 해시태그 삭제
  public function hashtag_del($data){
    $member_idx = $this->member_idx;
    $alarm_keyword = $data['alarm_keyword'];
    
    $this->db->trans_begin();
    
    $sql = "UPDATE
              tbl_member
            SET
              alarm_keyword = ?
            WHERE
              member_idx = ?
    ";
              
    $this->query($sql,
                  array(
                  $alarm_keyword,
                  $member_idx
                  ),
                  $data
                );
    
    if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
  }
  
  // 해시태그 가져오기
  public function hashtag_get(){
    $sql = "SELECT
              alarm_keyword
            FROM
              tbl_member
            WHERE
              member_idx = '$this->member_idx'
              ";
    
    return $this->query_row($sql,array());
  }

}
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-28
| Memo : 뱃지
|------------------------------------------------------------------------
*/

Class Model_badge extends MY_Model {

  // 뱃지 가져오기
  public function badge_get($data){
    $member_idx = $data['member_idx'];
    
    $sql = "SELECT
              member_idx,
              my_badge,
              my_badge_types
            FROM
              tbl_member
            WHERE
              member_idx = ?
              ";
    
    return $this->query_row($sql,
                            array(
                              $member_idx
                            )
                          );
  }
  
  // 대표 배지 설정
  public function my_badge_mod_up($data){
    $member_idx = $this->member_idx;
    $my_badge = $data['my_badge'];
    
    $this->db->trans_begin();
    
    $sql = "UPDATE
              tbl_member
            SET
              my_badge = ?,
              upd_date = NOW()
            WHERE
              member_idx = ?";
              
      $this->query($sql,
                    array(
                    $my_badge,
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
  
  

}
?>

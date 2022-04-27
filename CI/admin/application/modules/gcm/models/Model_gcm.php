<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2016-06-23
| Memo : GCM
|------------------------------------------------------------------------
*/

Class Model_gcm extends MY_Model {

  //회원정보 가져오기
  public function member_search($data){
    $index=$data['index'];
    $member_idx=$data['member_idx'];

    if($index =="101" ){
      $data_array = array();
      $keywords=$data['keywords'];

      $except_member_idx = $this->member_idx;
      $keyword_arr = explode(',', $keywords);
      foreach ($keyword_arr as $keyword) {

        $sql = "SELECT
                  a.member_idx,
                  a.current_lang,

                  '$keyword' as keyword,
                  0 as corp_idx,
                  FN_AES_DECRYPT(a.member_name) AS member_name,
                  a.all_alarm_yn as alarm_yn,
                  a.device_os,
                  a.gcm_key
                FROM
                  tbl_member a
                WHERE
                  a.del_yn='N'
                  AND FIND_IN_SET('$keyword',a.alarm_keyword)>0
                  AND member_idx NOT IN ($except_member_idx)
        ";

        $member_list = $this->query_result($sql,
                                          array(

                                          ),$data
                                          );

        // 반환 배열에 추가
        foreach ($member_list as $each) {
          array_push($data_array,  $each);
        }

        // 조회 제외 회원 업데이트
        if (!empty($member_list)) {
          $except_member_idx = $except_member_idx.','.$this->global_function->array_to_str_parm($member_list, 'member_idx');
        }
      }

      return $data_array;
    }


    if($index =="102" || $index =="103" || $index =="104"|| $index =="105" || $index =="106" || $index =="109"|| $index =="113" || $index =="114"){
      $sql = "SELECT
                a.member_idx,
                a.current_lang,

                0 as corp_idx,
                FN_AES_DECRYPT(a.member_name) AS member_name,
                a.all_alarm_yn as alarm_yn,
                a.device_os,
                a.gcm_key
              FROM
                tbl_member a
              WHERE
                a.member_idx  IN ($member_idx)
      ";
    }


    // 매주 일요일에 집계
    if($index =="107" || $index =="108" ){

      $free_product_yn = $index =="107"?'N':'Y';

      $sql = "SELECT
                a.member_idx,
                a.current_lang,
                
                0 as corp_idx,
                FN_AES_DECRYPT(a.member_name) AS member_name,
                a.all_alarm_yn as alarm_yn,
                a.device_os,
                a.gcm_key
              FROM
                tbl_member AS a
              WHERE
                a.del_yn='N'
                AND (
                  SELECT
                    count(*) as cnt
                  FROM
                    tbl_product z
                  WHERE
                    z.del_yn='N'
                    AND DATE_SUB(NOW(), INTERVAL 8 DAY) <= DATE_FORMAT(z.complete_date, '%Y-%m-%d')
                    AND DATE_SUB(NOW(), INTERVAL 1 DAY) >= DATE_FORMAT(z.complete_date, '%Y-%m-%d')
                    AND z.product_state = 2
                    AND z.free_product_yn = '$free_product_yn'
                )>0
      ";

    }

    return $this->query_result($sql,
                            array(

                            ),$data
                            );
  }



  //회원 gcm 입력
  public function member_gcm_in($data) {
    $member_idx=$data['member_idx'];
    $title=$data['title'];
    $msg=$data['msg'];
    $index=$data['index'];
    $device_os=$data['device_os'];
    $gcm_key=$data['gcm_key'];
    $alarm_yn=$data['alarm_yn'];

    $del_yn =($index>=900)? "Y":"N";

    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_alarm
            (
              member_idx,
              `data`,
              title,
              msg,
              `index`,
              device_os,
              gcm_key,
              alarm_yn,
              del_yn,
              send_yn,
              read_yn,
              ins_date,
              upd_date
            )VALUES (
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              'N',
              'N',
              NOW(),
              NOW()
            )
    ";
    $this->query($sql,
                array(
                $member_idx,
                json_encode($data),
                $title,
                $msg,
                $index,
                $device_os,
                $gcm_key,
                $alarm_yn,
                $del_yn,
                ),$data
                );

    $alarm_idx = $this->db-> insert_id() ;

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "0";
    }else{
      $this->db->trans_commit();
      return $alarm_idx;
    }
  }


}

?>

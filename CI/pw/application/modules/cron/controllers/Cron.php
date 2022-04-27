<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2018-02-17
| Memo : cron
|------------------------------------------------------------------------
*/
class Cron extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('cron/model_cron');

  }


  //매주 일요일
  /*
  0 0 * * 0 /usr/bin/curl --silent --compressed sususoft.pw.rocateerdev.co.kr/cron/review_complete_alarm
  */
  public function review_complete_alarm(){
    //알람 107 :: 새로운 평가가 완료 되었습니다.
    $index="107";
    $alarm_data = array();
    
    $this->_alarm_action(0,0,$index, $alarm_data);
    
    //알람 108 :: 새로운 나눔 평가가 완료 되었습니다.
    $index="108";
    $alarm_data = array();
    
    $this->_alarm_action(0,0,$index, $alarm_data);
  }

  //5초마다 실행
  /*
  * * * * * /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 5; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 10; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 15; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 20; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 25; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 30; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 35; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 40; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 45; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 50; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  * * * * * sleep 55; /usr/bin/curl --silent --compressed p.pw.rocateerdev.co.kr/cron/alarm_send
  */
  public function alarm_send(){
    $this->model_cron->alarm_send();
  }

  // 이메일 발송
  public function email_send(){
    $this->model_cron->email_send();
  }


}

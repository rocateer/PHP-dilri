<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-04-15
|------------------------------------------------------------------------
*/

class Alarm_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->alarm_list();
  }

//메인 화면
  public function alarm_list(){
		$this->_view2(mapping('alarm').'/view_alarm_list');
  }

//메인 화면
  public function keyword_set(){
		$this->_view2(mapping('alarm').'/view_keyword_set');
  }

//메인 화면
  public function alarm_setting(){
		$this->_view2(mapping('alarm').'/view_alarm_setting');
  }
}// 클래스의 끝
?>

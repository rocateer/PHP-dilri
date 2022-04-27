<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-02-22
|------------------------------------------------------------------------
*/

class Member_pw_change_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}
	//인덱스
	  public function index() {

	    $this->member_pw_change_detail();
	  }

	//메인 화면
	  public function member_pw_change_detail(){
			$this->_view2(mapping('member_pw_change').'/view_member_pw_change_detail');
	  }
}// 클래스의 끝
?>

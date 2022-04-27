<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-02-22
| Memo : Mypage
|------------------------------------------------------------------------
*/

class Member_info_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}
	//인덱스
	  public function index() {

	    $this->member_info_mod();
	  }

	//메인 화면
	  public function member_info_mod(){
			$this->_view2(mapping('member_info').'/view_member_info_mod');
	  }
}// 클래스의 끝
?>

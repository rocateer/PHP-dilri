<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2020-12-25
|------------------------------------------------------------------------
*/

class Member_out_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {
    $this->member_out_detail();
  }

//알림목록
  public function member_out_detail(){
		$this->_view2(mapping('member_out').'/view_member_out_detail');
  }

}// 클래스의 끝
?>

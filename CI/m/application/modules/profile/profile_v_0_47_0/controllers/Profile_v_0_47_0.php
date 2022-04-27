<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-01-15
|------------------------------------------------------------------------
*/

class Profile_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->profile_detail();
  }

//메인 화면
  public function profile_detail(){
		$this->_view2(mapping('profile').'/view_profile_detail');
  }

}// 클래스의 끝
?>

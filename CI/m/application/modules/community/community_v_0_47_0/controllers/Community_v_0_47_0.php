<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-01-15
|------------------------------------------------------------------------
*/

class Community_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->community_list();
  }

//메인 화면
  public function community_list(){
		$this->_view(mapping('community').'/view_community_list');
  }

//메인 화면
  public function community_reg(){
		$this->_view2(mapping('community').'/view_community_reg');
  }

//메인 화면
  public function community_mod(){
		$this->_view2(mapping('community').'/view_community_mod');
  }

//메인 화면
  public function community_detail(){
		$this->_view2(mapping('community').'/view_community_detail');
  }
}// 클래스의 끝
?>

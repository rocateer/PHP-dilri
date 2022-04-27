<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-04-15
|------------------------------------------------------------------------
*/

class Keyword_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->keyword_list();
  }

//메인 화면
  public function keyword_list(){
		$this->_view2(mapping('keyword').'/view_keyword_list');
  }

}// 클래스의 끝
?>

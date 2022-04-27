<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2020-09-25
|------------------------------------------------------------------------
*/

class Faq_v_0_47_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

  }

//인덱스
	public function index(){

		$this->faq_list();

	}

// faq_list
	public function faq_list(){

		$this->_view2(mapping('faq').'/view_faq_list');
	}

} // 클래스의 끝
?>

<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2020-09-25
|------------------------------------------------------------------------
*/

class Terms_v_0_47_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

  }

  //인덱스
  public function index() {
    $this->terms_detail();
  }

  //이용약관 동의
  public function terms_detail(){
		$this->_view2(mapping('terms').'/view_terms_detail');
  }

}// 클래스의 끝
?>

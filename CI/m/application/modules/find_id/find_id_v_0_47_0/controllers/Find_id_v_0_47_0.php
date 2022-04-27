<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-04-15
|------------------------------------------------------------------------
*/

class Find_id_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->find_id_detail();
  }

//메인 화면
  public function find_id_detail(){
		$this->_view2(mapping('find_id').'/view_find_id_detail');
  }
}// 클래스의 끝
?>

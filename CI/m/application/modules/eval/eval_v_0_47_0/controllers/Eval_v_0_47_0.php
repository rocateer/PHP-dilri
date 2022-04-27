<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-01-15
|------------------------------------------------------------------------
*/

class Eval_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->free_sell_reg();
  }

//메인 화면
  public function free_sell_reg(){
		$this->_view2(mapping('eval').'/view_free_sell_reg');
  }

//메인 화면
  public function free_buy_reg(){
		$this->_view2(mapping('eval').'/view_free_buy_reg');
  }

//메인 화면
  public function complete(){
		$this->_view2(mapping('eval').'/view_complete');
  }

//메인 화면
  public function history_list(){
		$this->_view2(mapping('eval').'/view_history_list');
  }

//메인 화면
  public function genelar_list(){
		$this->_view2(mapping('eval').'/view_genelar_list');
  }

//메인 화면
  public function nice_reg(){
		$this->_view2(mapping('eval').'/view_nice_reg');
  }

//메인 화면
  public function bad_reg(){
		$this->_view2(mapping('eval').'/view_bad_reg');
  }

}// 클래스의 끝
?>

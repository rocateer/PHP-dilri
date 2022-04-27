<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-01-15
|------------------------------------------------------------------------
*/

class Product_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->product_detail();
  }

//메인 화면
  public function product_detail(){
		$this->_view2(mapping('product').'/view_product_detail');
  }

//메인 화면
  public function product_reg(){
		$this->_view2(mapping('product').'/view_product_reg');
  }

//메인 화면
  public function reserve_reg(){
		$this->_view2(mapping('product').'/view_reserve_reg');
  }

//메인 화면
  public function complete_reg(){
		$this->_view2(mapping('product').'/view_complete_reg');
  }

//메인 화면
  public function product_mod(){
		$this->_view2(mapping('product').'/view_product_mod');
  }

}// 클래스의 끝
?>

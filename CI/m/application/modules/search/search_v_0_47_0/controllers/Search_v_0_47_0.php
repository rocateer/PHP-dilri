<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-01-15
|------------------------------------------------------------------------
*/

class Search_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->search_list();
  }

//메인 화면
  public function search_list(){
		$this->_view(mapping('search').'/view_search_list');
  }

//메인 화면
  public function search_comm_list(){
		$this->_view(mapping('search').'/view_search_comm_list');
  }

//7_4/카테고리 선택시_검색 결과
  public function category_result(){
		$this->_view2(mapping('search').'/view_category_result');
  }

//
  public function searching(){
		$this->_view2(mapping('search').'/view_searching');
  }

//
  public function search_result(){
		$this->_view(mapping('search').'/view_search_result');
  }
}// 클래스의 끝
?>

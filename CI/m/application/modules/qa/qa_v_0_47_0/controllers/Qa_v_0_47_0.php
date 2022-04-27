<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2020-07-10
|------------------------------------------------------------------------
*/

class Qa_v_0_47_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

  }

//인덱스
	public function index(){

		$this->qa_list();

	}

// qa
	public function qa_list(){

		$this->_view2(mapping('qa').'/view_qa_list');
	}

// qa
	public function qa_detail(){

		$this->_view2(mapping('qa').'/view_qa_detail');
	}

// qa
	public function qa_reg(){

		$this->_view2(mapping('qa').'/view_qa_reg');
	}

} // 클래스의 끝
?>

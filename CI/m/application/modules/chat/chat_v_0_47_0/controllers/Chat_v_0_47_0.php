<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-01-15
|------------------------------------------------------------------------
*/

class Chat_v_0_47_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->chat_list();
  }

//메인 화면
  public function chat_list(){
		$this->_view(mapping('chat').'/view_chat_list');
  }
}// 클래스의 끝
?>

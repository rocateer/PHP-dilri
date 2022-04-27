<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2019-01-14
| Memo : 처음시작
|------------------------------------------------------------------------
*/

class Go_url extends MY_Controller {
  function __construct(){
    parent::__construct();

  }

  public function index(){
    $index = $this->_input_check("index",array());
    $product_idx = $this->_input_check("product_idx",array());
    $chatting_room_idx = $this->_input_check("chatting_room_idx",array());
    $qa_idx = $this->_input_check("qa_idx",array());
    $board_idx = $this->_input_check("board_idx",array());
    $tab_type = $this->_input_check("tab_type",array());

    $go_url ="/";
    switch($index){

      case "101": $go_url="/".$this->nationcode.'/'.mapping('product')."/product_detail?product_idx=".$product_idx;break;
      case "102": $go_url="/".$this->nationcode.'/'.mapping('chatting')."/chat_list?chatting_open_yn=Y&chatting_room_idx=".$chatting_room_idx;break;
      case "103": $go_url="/".$this->nationcode.'/'.mapping('chatting')."/chat_list?chatting_open_yn=Y&chatting_room_idx=".$chatting_room_idx;break;
      case "104": $go_url="/".$this->nationcode.'/'.mapping('mypage')."/mypage_list?tab_type=".$tab_type;break;
      case "105": $go_url="/".$this->nationcode.'/'.mapping('mypage')."/mypage_list?tab_type=".$tab_type;break;
      case "106": $go_url="/".$this->nationcode.'/'.mapping('qa')."/qa_detail?qa_idx=".$qa_idx;break;
      case "107": $go_url="/".$this->nationcode.'/'.mapping('mypage')."/mypage_list?tab_type=".$tab_type;break;
      case "108": $go_url="/".$this->nationcode.'/'.mapping('mypage')."/mypage_list?tab_type=".$tab_type;break;
      case "109": $go_url="/".$this->nationcode.'/'.mapping('product')."/product_detail?product_idx=".$product_idx;break;
      case "110": $go_url="/".$this->nationcode.'/'.mapping('badge')."?access_type=0";break;
      case "111": $go_url="/".$this->nationcode.'/'.mapping('mypage')."/point_list";break;
      // case "112": $go_url="/".$this->nationcode.'/'.mapping('community')."/community_detail?board_idx=".$board_idx;break;
      case "112": $go_url="/".$this->nationcode.'/'.mapping('mypage')."/mypage_list?tab_type=4";break;

      case "113": $go_url="/".$this->nationcode.'/'.mapping('product')."/product_detail?product_idx=".$product_idx;break;
      // case "114": $go_url="/".$this->nationcode.'/'.mapping('community')."/community_detail?board_idx=".$board_idx;break;
      case "114": $go_url="/".$this->nationcode.'/'.mapping('mypage')."/mypage_list?tab_type=3";break;



    }

    // echo "go_url : ".$go_url." | index : ".$index;
    // exit;

    redirect($go_url);
  }



}// 클래스의 끝
?>

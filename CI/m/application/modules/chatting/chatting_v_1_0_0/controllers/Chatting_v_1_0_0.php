<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2018-11-05
| Memo : 자유 게시판 관리
|------------------------------------------------------------------------

_input_check 가이드
_________________________________________________________________________________
|  !!. 변수설명
| $key       : 파라미터로 받을 변수명
| $empty_msg : 유효성검사 실패 시 전송할 메세지,
|              ("empty_msg" => "유효성검사 메세지") 로 구분하며 list 타입임.
| $focus_id  : 유효성검사 실패 시 foucus 이동 ID,
|              ("focus_id" => "foucus 대상 ID")
| $ternary  : 삼항 연산자 받을 변수명
|              ("ternary" => "1")
| $esc       : 개행문자 제거 요청시 true, 아닐시 false
|              false를 요청하는 경우-> (ex. 장문의 글 작성 시 false)
|           	 값이 array 형태일 경우 false로 적용
| $regular_msg : 정규표현식 검사 실패 시 전송할 메세지,
|              ("regular_msg" => "정규표현식 메세지","type" => "number")
| $type    	: 유효성검사할 타입
|           	 number   : 숫자검사
|            	email    : 이메일 양식 검사
|            	password : 비밀번호 양식 검사
|            	tel1     : 전화번호 양식 검사 (- 미포함)
|            	tel2     : 전화번호 양식 검사 (- 포함)
|            	custom   : 커스텀 양식, $custom의 양식으로 검사함
|            	default  : default, 검사를 안합니다.
| $custom 	: 유효성검사 custom으로 진행 시 받을 값 (정규표현식)
|
|  !!!. 값이 array형태로 들어올 경우
| $this->input_chkecu("파라미터로 받을 변수명[]");
| 형태로 받는다.
|_________________________________________________________________________________
*/

class Chatting_v_1_0_0 extends MY_Controller{

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

		$this->load->model('chatting_v_1_0_0/model_chatting');
	}

	//인덱스
  public function index() {

    $this->chat_list();
  }

	public function chat_list(){

		$chatting_open_yn = $this->_input_check("chatting_open_yn",array());
		$chatting_room_idx = $this->_input_check("chatting_room_idx",array());

		if(!$this->session->userdata("member_idx") ){
			redirect("/".mapping('login')."?return_url=/".mapping('mypage'));
			exit;
		}

		$response = new stdClass();

		$response->agent = $this->_user_agent();
		$response->chatting_open_yn = $chatting_open_yn;
		$response->chatting_room_idx = $chatting_room_idx;

		$this->_view(mapping('chatting').'/view_chat_list',$response);
  }

	// 채팅방 목록
	public function chatting_room_list_get(){

		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_chatting->chatting_room_list($data);
		$result_list_count = $this->model_chatting->chatting_room_list_count($data);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);

		$this->_ajax_view(mapping('chatting').'/view_chatting_room_list_get', $response);
	}


	// 새로온 대화 내용 노출
	public function new_chatting_room_list(){

		$response = new stdClass;

		$result_list = $this->model_chatting->new_chatting_room_list();//model 1.  리스트

		$response->result_list = $result_list;
		$response->result_list_count = count($result_list);

		$this->_ajax_view(mapping('chatting').'/view_new_chatting_room_list_get', $response);

  }


	// 1-1.  리스트
	public function chatting_list(){
		header('Content-Type: application/json');

		$member_idx = $this->_input_check('user_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"user_idx"));
		$chatting_room_idx = $this->_input_check('chatting_room_idx',array("empty_msg"=>"채팅방키을 입력해주세요.","focus_id"=>"chatting_room_idx"));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size = 4;

		$data['member_idx'] = $member_idx;
		$data['chatting_room_idx'] = $chatting_room_idx;
		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

    // $check = $this->model_chatting->chatting_read_mod_up($data);//읽음
		$result = $this->model_chatting->chatting_room_detail($data);//model 1.  리스트
		$result_list = $this->model_chatting->chatting_list($data);//model 1.  리스트
		$result_list_count = $this->model_chatting->chatting_list_count($data);//model 1-1.  리스트 총 카운트

		$total_page = ceil($result_list_count/$page_size);

		$x =count($result_list);
		$response = new stdClass();

		if(count($result)<1){
			$response->code = "-1";
			$response->code_msg = lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
			echo json_encode($response);
			exit;
		}

		$state ="";
		$state_letter="";

		if($result->product_state==1  ){
			if($result->product_owner_idx==$member_idx  ||   $result->product_order_idx==$member_idx ){

			}else{
				$state="0";
				$state_letter=lang("lang_chatting_00509","판매예약중 상품 입니다.");
			}

		}

		// 예약 중 무료나눔 거래의 완료 여부 확인
		$check1 = $this->model_chatting->free_product_state_check($data);
		if($check1>0){

			$state = "4";
			$state_letter = lang("lang_product_00207","무료나눔이 예약은 1건만 가능 합니다.");
		}

		// 완료된 무료나눔 거래의 평가 등록 확인
		$check2 = $this->model_chatting->free_product_review_check($data);
		if($check2>0){

			$state = "4";
			$state_letter = lang("lang_product_00208","그 전에 나눔에서 피드백을 작성하지 않았어요!");
		}

		if($result->product_state==2){
			$state="1";
			$state_letter=lang("lang_chatting_00505","판매가 완료된 상품 입니다.");
		}
		$member_del_yn = ($result->member_idx ==$member_idx)? $result->partner_member_del_yn :$result->member_del_yn;

		if($member_del_yn=="P"){
			$state="2";
			$state_letter=lang("lang_chatting_00510","관리자에 의해 제재된 회원 입니다.");
		}
		$my_del_yn = ($result->member_idx ==$member_idx)? $result->member_del_yn:$result->partner_member_del_yn;
		if($my_del_yn=="P"){
			$state="2";
			$state_letter=lang("lang_chatting_00510","관리자에 의해 제재된 회원 입니다.");
		}
		if($member_del_yn=="Y"){
			$state="3";
			$state_letter=lang("lang_chatting_00507","사용자의 요청에 의해 삭제된 정보 입니다.");
		}
		if($result->display_yn=="N"){
			$state="4";
		  $state_letter=lang("lang_chatting_00506","관리자에 의해 제재 되어 사용 금지 상태 입니다.");
		}

		
		
	

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $result_list;
			$response->state = $state;
			$response->state_letter = $state_letter;
			$response->ins_date = $result->product_ins_date;
			$response->title = $result->title;
			$response->img_path = explode(',',$result->img_path)[0];

		}else{
			$response->code = "1000";
			$response->code_msg = lang("lang_common_00821","정상적으로 처리되었습니다.");
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $result_list;
			$response->state = $state;
			$response->state_letter = $state_letter;
			$response->ins_date = $result->product_ins_date;
			$response->title = $result->title;
			$response->img_path = explode(',',$result->img_path)[0];
    }
		echo json_encode($response);
		exit;
  }

  // 등록
	public function chatting_reg_in(){
		header('Content-Type: application/json');
    $response = new stdClass();

		$member_idx = $this->_input_check('user_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"user_idx"));
		$chatting_room_idx = $this->_input_check('chatting_room_idx',array("empty_msg"=>"채팅방키을 입력해주세요.","focus_id"=>"chatting_room_idx"));
		$img_path = $this->_input_check('img_path',array());
		$comment = $this->_input_check('comment',array());

		$data['member_idx'] = $member_idx;
    $data['chatting_room_idx'] = $chatting_room_idx;
    $data['img_path'] = $img_path;
    $data['comment'] = $comment;

    $check = $this->model_chatting->chatting_room_detail($data);//
		if(count($check) < 1){
			$response->code = "-1";
			$response->code_msg = "잘못된 경로 입니다.";
			echo json_encode($response);
			exit;
		}

		// 예약 중 무료나눔 거래의 완료 여부 확인
		$check1 = $this->model_chatting->free_product_state_check($data);
		if($check1>0){

			$response->code = "-1";
			$response->code_msg = lang("lang_product_00207","무료나눔이 예약은 1건만 가능 합니다.");

			echo json_encode($response);
			exit;
		}

		// 완료된 무료나눔 거래의 평가 등록 확인
		$check2 = $this->model_chatting->free_product_review_check($data);
		if($check2>0){

			$response->code = "-1";
			$response->code_msg = lang("lang_product_00208","그 전에 나눔에서 피드백을 작성하지 않았어요!");

			echo json_encode($response);
			exit;
		}

		if($img_path =="" && $comment ==""){
			$response->code = "-1";
			$response->code_msg = "이미지나 내용을 등록하셔야 합니다.";
			echo json_encode($response);
			exit;
		}


		$result = $this->model_chatting->chatting_reg_in($data);//

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{

			if($img_path !="" && $comment ==""){
					$comment ="사진을 보냈습니다";
			}


       $alarm_data['chatting_room_idx'] = $chatting_room_idx;

			 $partner_member_idx=($check->member_idx ==$member_idx)? $check->partner_member_idx :$check->member_idx ;
			 $index=($check->member_idx ==$member_idx)? "102" :"103" ;

 			 $this->_alarm_action($partner_member_idx,0,$index, $alarm_data);

			$response->code = "1000";
			$response->code_msg = lang("lang_common_00821","정상적으로 처리되었습니다.");
    }
		echo json_encode($response);
		exit;
	}

	// 등록
	public function chatting_del(){
		header('Content-Type: application/json');
		$response = new stdClass();

		$member_idx = $this->_input_check('user_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"user_idx"));
		$chatting_room_idx = $this->_input_check('chatting_room_idx',array("empty_msg"=>"채팅방키을 입력해주세요.","focus_id"=>"chatting_room_idx"));

		$data['member_idx'] = $member_idx;
		$data['chatting_room_idx'] = $chatting_room_idx;

		$result = $this->model_chatting->chatting_del($data);//

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg = lang("lang_common_00821","정상적으로 처리되었습니다.");
		}
		echo json_encode($response);
		exit;
	}


	// new 표시
	public function member_read_count() {
		header('Content-Type: application/json');
		$response = new stdClass;

		$member_idx = $this->_input_check("user_idx",array("empty_msg"=>"회원키가 누락되었습니다."));

		$data['member_idx'] = $member_idx;

		$check=$this->model_chatting->member_read_count($data);

		$response->code = "1000";
		$response->code_msg = lang("lang_common_00821","정상적으로 처리되었습니다.");
		$response->not_read_cnt = $check;
		$response->red_dot_yn = ($check>0)? "Y":"N";

		echo json_encode($response);
		exit;
	}


	//현재 채팅중인 회원리스트
public function chatting_member_list(){
	header('Content-Type: application/json');
	$member_idx = $this->_input_check('user_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"user_idx"));
	$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
	$page_size = PAGESIZE;

	$data['member_idx'] = $member_idx;
	$data['page_size'] = $page_size;
	$data['page_no'] = ($page_num-1)*$page_size;

	$result_list = $this->model_chatting->chatting_member_list($data);//model 1.  리스트
	$result_list_count = $this->model_chatting->chatting_member_list_count($data);//model 1-1.  리스트 총 카운트

	$total_page = ceil($result_list_count/$page_size);

	$response = new stdClass();

	$x=0;
	$data_array = array();
	foreach($result_list as $row){
		$data_array[$x]['chatting_room_idx'] = $row->chatting_room_idx;
		$data_array[$x]['partner_member_idx'] = $row->partner_member_idx;
		$data_array[$x]['last_chatting_date'] = $row->last_chatting_date;
		$data_array[$x]['title'] = $row->title;
		$data_array[$x]['display_yn'] = $row->display_yn;
		$data_array[$x]['product_state'] = $row->product_state;
		$data_array[$x]['last_chatting_comment'] = $row->last_chatting_comment;
		$data_array[$x]['member_img'] = $row->member_img;
		$data_array[$x]['member_nickname'] = $row->member_nickname;
		$new_icon_yn ="N";
		if($row->my_read_count>0){
			$new_icon_yn ="Y";
		}
		$data_array[$x]['new_icon_yn'] = $new_icon_yn;

	$x++;
	}

	if($x==0){
		$response->code = "2000";
		$response->code_msg = $this->global_msg->code_msg('2000');
		$response->list_cnt = $x;
		$response->page_num = (int)$page_num;
		$response->total_page =	$total_page;
		$response->data_array = $data_array;

	}else{
		$response->code = "1000";
		$response->code_msg = lang("lang_common_00821","정상적으로 처리되었습니다.");
		$response->list_cnt = $x;
		$response->page_num = (int)$page_num;
		$response->total_page =	$total_page;
		$response->data_array = $data_array;
	}
	echo json_encode($response);
	exit;

}



}	//클래스의 끝
?>

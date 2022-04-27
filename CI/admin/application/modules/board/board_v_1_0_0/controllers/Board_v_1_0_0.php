<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-15
| Memo : 커뮤니티 관리
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

class Board_v_1_0_0 extends MY_Controller{

	// 생성자 영역
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('board').'/model_board');
	}

	// Index
	public function index(){
		$this->board_list();
	}

	// 커뮤니티 리스트
	public function board_list(){
		$board_type = $this->_input_check("board_type",array());

		$data['board_type'] = $board_type;

		$response = new stdClass();

		$response->board_type = $board_type;

		$this->_view(mapping('board').'/view_board_list', $response);
	}

	// 커뮤니티 리스트 가져오기
	public function board_list_get(){

		$member_name = $this->_input_check("member_name",array());
		$contents = $this->_input_check("contents",array());
		$title = $this->_input_check("title",array());
		$display_yn = $this->_input_check("display_yn",array());
		$best_yn = $this->_input_check("best_yn",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$orderby = $this->_input_check("orderby",array());
		$hash_tag = $this->_input_check("hash_tag",array());
		$history_data = $this->_input_check("history_data",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['member_name'] = $member_name;
		$data['contents'] = $contents;
		$data['title'] = $title;
		$data['display_yn'] = $display_yn;
		$data['best_yn'] = $best_yn;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['hash_tag'] = $hash_tag;
		$data['orderby'] = $orderby;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		// var_dump($data);
		// exit;

		$result_list = $this->model_board->board_list($data);
		$result_list_count = $this->model_board->board_list_count($data);

		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->page_num = $page_num;
		$response->history_data = $history_data;

		$this->_list_view(mapping('board').'/view_board_list_get', $response);
	}
	public function board_list_excel(){

		$member_name = $this->_input_check("member_name",array());
		$contents = $this->_input_check("contents",array());
		$title = $this->_input_check("title",array());
		$display_yn = $this->_input_check("display_yn",array());
		$best_yn = $this->_input_check("best_yn",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$orderby = $this->_input_check("orderby",array());
		$hash_tag = $this->_input_check("hash_tag",array());
		$history_data = $this->_input_check("history_data",array());


		$data['member_name'] = $member_name;
		$data['contents'] = $contents;
		$data['title'] = $title;
		$data['display_yn'] = $display_yn;
		$data['best_yn'] = $best_yn;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['hash_tag'] = $hash_tag;
		$data['orderby'] = $orderby;


		// var_dump($data);
		// exit;

		$result_list = $this->model_board->board_list_excel($data);
		$no = COUNT($result_list);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->no = $no;

		$this->_list_view(mapping('board').'/view_board_list_excel', $response);
	}

	// 커뮤니티 상세
	public function board_detail(){
		$board_idx = $this->_input_check("board_idx",array("empty_msg"=>"공지사항 키가 누락되었습니다."));
		$history_data = $this->_input_check("history_data",array());

		$data['board_idx'] = $board_idx;

		$result = $this->model_board->board_detail($data);

		$response = new stdClass();

		$response->result = $result;
		$response->history_data = $history_data;

		$this->_view(mapping('board').'/view_board_detail',$response);
	}

	// 리스트 get
	public function reply_list_get(){
		$board_idx = $this->_input_check("board_idx",array());
		$member_name = $this->_input_check("member_name",array());
		$orderby = $this->_input_check("orderby",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['board_idx'] = $board_idx;
		$data['member_name'] = $member_name;
		$data['orderby'] = $orderby;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_board->reply_list($data);
		$result_list_count = $this->model_board->reply_list_count($data);

		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num, 'reply_list_get');

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->page_num = $page_num;

		$this->_list_view(mapping('board').'/view_reply_list_get', $response);
	}

	// 노출여부 상태 변경
	public function best_yn_mod_up(){
		$board_idx = $this->_input_check("board_idx",array());
		$best_yn = $this->_input_check("best_yn",array());

		$data['board_idx']  = $board_idx;
		$data['best_yn'] = $best_yn;

		$response = new stdClass();

		// 인기노출상품 10개 이내 여부 체크
		if ($best_yn=='Y') {
			$best_yn_cnt = $this->model_board->best_yn_cnt();
			if ($best_yn_cnt>=10) {
				$response->code = '-1';
				$response->code_msg = "BEST 커뮤니티글은 최대 10개까지 지정 가능 합니다. 지정된 항목을 해제 후 다시 지정하여 주세요.";

				echo json_encode($response);
				exit;
			}
		}

		$result = $this->model_board->best_yn_mod_up($data);


		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "상태변경 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code = 1;
			$response->code_msg 	= "상태변경 성공하였습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 노출여부 상태 변경
	public function display_yn_mod_up(){
		$board_reply_idx = $this->_input_check("board_reply_idx",array());
		$display_yn = $this->_input_check("display_yn",array());

		$data['board_reply_idx']  = $board_reply_idx;
		$data['display_yn'] = $display_yn;

		$result = $this->model_board->display_yn_mod_up($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "상태변경 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "상태변경 성공하였습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 커뮤니티 상태변경
	public function board_display_yn_mod_up(){
		$board_idx = $this->_input_check("board_idx",array());
		$display_yn = $this->_input_check("display_yn",array());

		$data['board_idx']  = $board_idx;
		$data['display_yn'] = $display_yn;

		$result = $this->model_board->board_display_yn_mod_up($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "상태변경 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "상태변경 성공하였습니다.";

			if ($display_yn  = 'Y') {
				$result = $this->model_board->board_detail($data);

				$index="114";
				$alarm_data['board_idx'] = $board_idx;

				$this->_alarm_action($result->member_idx,0,$index, $alarm_data);
			}

		}
		echo json_encode($response);
		exit;
	}

}

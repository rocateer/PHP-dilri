<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-11-15
| Memo : 마이페이지
|------------------------------------------------------------------------
input_check 가이드
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

class Mypage_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->session->userdata("member_idx") ){
			redirect("/".$this->nationcode.'/'.mapping('login')."?return_url=/".mapping('mypage'));
			exit;
		}

		$this->load->model(mapping('mypage').'/model_mypage');
	}

	//인덱스
  public function index() {

    $this->mypage_list();
  }

	//메인 화면
  public function mypage_list(){
		$tab_type = $this->_input_check("tab_type",array());

		$result = $this->model_mypage->mypage_detail(); // 회원 정보
		$result2 = $this->model_mypage->mypage_detail2(); // 회원 정보
		
		$response = new stdClass();
		
		$response->result2 = $result2;
		$response->tab_type = $tab_type;
		$response->result = $result;
		$response->agent = $this->_user_agent();

		$this->_view(mapping('mypage').'/view_mypage_list', $response);
  }

	// 포인트 상세
  public function point_list(){
		$result = $this->model_mypage->point_detail(); // 포인트 상세

		$response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('mypage').'/view_point_list', $response);
  }

	// 포인트 리스트
	public function point_list_get(){
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_mypage->point_date_list($data); // 포인트 날짜 리스트
		$result_list_count = $this->model_mypage->point_date_list_count(); // // 포인트 날짜 리스트 카운트
		$point_list = $this->model_mypage->point_list($data); // 포인트 리스트

		$response = new stdClass();

		$response->result_list = $result_list;
	//	$response->data_array = $data_array;
		$response->result_list_count = $result_list_count;
		$response->point_list = $point_list;
		$response->total_block = ceil($result_list_count/$page_size);

		$this->_ajax_view(mapping('mypage').'/view_point_list_get', $response);
	}


	// 포인트 리스트
	public function main_list_get(){
		$current_lat = $this->_input_check("current_lat",array("ternary"=>'37.5185682'));
		$current_lng = $this->_input_check("current_lng",array("ternary"=>'127.0230294'));
		$tab_type = $this->_input_check("tab_type",array());
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;
		$data['current_lat'] = $current_lat;
		$data['current_lng'] = $current_lng;
		$data['tab_type'] = $tab_type;

		if ($tab_type=='0' || $tab_type=='1' || $tab_type=='2') {
			$result_list = $this->model_mypage->product_list($data);
			$result_list_count = $this->model_mypage->product_list_count($data);

		} elseif ($tab_type=='3') {
			$result_list = $this->model_mypage->my_baord_list($data);
			$result_list_count = $this->model_mypage->my_baord_list_count($data);

		} elseif ($tab_type=='4') {
			$result_list = $this->model_mypage->my_board_reply_list($data);
			$result_list_count = $this->model_mypage->my_board_reply_list_count($data);

		} elseif ($tab_type=='5') {
			$result_list = $this->model_mypage->board_scrap_list($data);
			$result_list_count = $this->model_mypage->board_scrap_list_count($data);

		} elseif ($tab_type=='6') {
			$result_list = $this->model_mypage->product_like_list($data);
			$result_list_count = $this->model_mypage->product_like_list_count($data);
		}

		$response = new stdClass();

		$response->tab_type = $tab_type;
		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);

		if ($tab_type=='0' || $tab_type=='1' || $tab_type=='2' || $tab_type=='6') {
			$this->_ajax_view(mapping('mypage').'/view_main_list_get', $response);

		}elseif ($tab_type=='3' || $tab_type=='5') {
			$this->_ajax_view(mapping('mypage').'/view_community_list_get', $response);

		}elseif ($tab_type=='4') {
			$this->_ajax_view(mapping('mypage').'/view_board_reply_list_get', $response);
		}
	}
}// 클래스의 끝
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-11-15
| Memo : 프로필
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

class Profile_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('profile').'/model_profile');
	}

	//인덱스
  public function index() {

    $this->profile_detail();
  }

	//메인 화면
  public function profile_detail(){
		$member_idx = $this->_input_check("member_idx",array());
		
		$data['member_idx'] = $member_idx;
		
		$result = $this->model_profile->profile_detail($data); // 회원 정보
		
		$response = new stdClass();
		
		$response->result = $result;
		$response->member_idx = $member_idx;
		$response->agent = $this->_user_agent();
		
		$this->_view2(mapping('profile').'/view_profile_detail', $response);
  }
	
	
	// 포인트 리스트
	public function main_list_get(){
		$current_lat = $this->_input_check("current_lat",array("ternary"=>'37.5185682'));
		$current_lng = $this->_input_check("current_lng",array("ternary"=>'127.0230294'));
		$tab_type = $this->_input_check("tab_type",array());
		$member_idx = $this->_input_check("member_idx",array());
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;
		$data['current_lat'] = $current_lat;
		$data['current_lng'] = $current_lng;
		$data['tab_type'] = $tab_type;
		$data['member_idx'] = $member_idx;
		
		$result_list = $this->model_profile->product_list($data); 
		$result_list_count = $this->model_profile->product_list_count($data);
			
		$response = new stdClass();
		
		$response->tab_type = $tab_type;
		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);
		
		$this->_ajax_view(mapping('profile').'/view_main_list_get', $response);
	}

}// 클래스의 끝
?>

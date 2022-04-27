<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-10-14
| Memo : 추천 검색어 관리
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

class Recommend_search_v_1_0_0 extends MY_Controller{
	
	// 생성자
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('recommend').'/model_recommend_search');
	}

  // index
	public function index(){
		$this->recommend_search_mod();
	}
	
	// 추천 검색어 관리 리스트 
	public function recommend_search_mod(){
		$result_list = $this->model_recommend_search->recommend_search_list();
		$result_community_list = $this->model_recommend_search->recommend_community_list();
		
		$response = new stdClass();
		$response->result_list = $result_list;
		$response->result_community_list = $result_community_list;
		
		$this->_view(mapping('recommend').'/view_recommend_search_mod',$response);
	}

	// 추천 검색어 관리 저장
	public function recommend_search_mod_up(){
		$type = $this->_input_check('type',array());
		if($type==0){
			$title = $this->_input_check('title_0[]',array());
			$recommend_search_idx = $this->_input_check('recommend_search_idx_0[]',array());
			$display_yn = $this->_input_check('display_yn_0',array());
		}else{
			$title = $this->_input_check('title_1[]',array());
			$recommend_search_idx = $this->_input_check('recommend_search_idx_1[]',array());
			$display_yn = $this->_input_check('display_yn_1[]',array());
		}
		
		$display_yn = array_diff($display_yn, array('on'));
		$display_yn = array_values($display_yn);
		
		$data['type'] = $type;
		$data['title'] = $title;
		$data['display_yn'] = $display_yn;
		$data['recommend_search_idx'] = $recommend_search_idx;

		$result = $this->model_recommend_search->recommend_search_mod_up($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "정상적으로 처리되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

}	// 클래스의 끝

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-21
| Memo : 아이디 찾기
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

class Find_id_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('find_id').'/model_find_id');
	}

	//인덱스
  public function index() {

    $this->find_id_detail();
  }

	//메인 화면
  public function find_id_detail(){
		$this->_view2(mapping('find_id').'/view_find_id_detail');
  }

	// 아이디 찾기
	public function find_id_member(){
		$response = new StdClass();

		$member_name = $this->_input_check("member_name",array("empty_msg"=>lang("lang_find_id_00765","이름을 입력해주세요"),"focus_id"=>"member_name"));
		$member_phone = $this->_input_check("member_phone",array("empty_msg"=>lang("lang_find_id_00766","전화번호를 입력해주세요"),"focus_id"=>"member_phone"));

		$data['member_name'] = $member_name;
		$data['member_phone'] = str_replace("-", "", $member_phone);

		# model. 아이디 찾기
		$result = $this->model_find_id->find_id_member($data);

		if(empty($result)){
			$response->code = "0";
			$response->code_msg = lang("lang_find_id_00055","일치하는 회원정보가 없습니다.");

		}else{
			$response->code = "1000";
			$response->code_msg = lang("lang_find_id_00764","회원님의 정보를 찾았습니다.");
			$response->member_id = $result->member_id;
		}

		echo json_encode($response);
		exit;
	}
}// 클래스의 끝
?>

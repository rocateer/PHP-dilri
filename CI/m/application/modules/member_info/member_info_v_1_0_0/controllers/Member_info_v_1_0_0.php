<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-22
| Memo : 회원 정보 수정
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

class Member_info_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->session->userdata("member_idx")){
			redirect("/".mapping('login')."?return_url=/".mapping('member_info'));
			exit;
		}
		$this->load->model(mapping('member_info').'/model_member_info');
		$this->load->model('common/model_common');

	}
	//인덱스
  public function index() {
    $this->member_info_mod();
  }

	//메인 화면
  public function member_info_mod(){

		$member_detail = $this->model_member_info->member_detail(); // 회원 상세보기

		$response = new stdClass();

		$response->result = $member_detail;

		$response->agent = $this->_user_agent();

		$this->_view2(mapping('member_info').'/view_member_info_mod',$response);
  }

	public function member_info_mod_up(){
		$response = new stdClass();

		$member_name = $this->_input_check("member_name",array("empty_msg"=>lang("lang_member_info_00685","이름을 입력해 주세요."),"focus_id"=>"member_name"));
		$member_phone = $this->_input_check("member_phone",array("empty_msg"=>lang("lang_member_info_00810","전화번호를 입력해 주세요."),"focus_id"=>"member_phone"));
		$member_gender = $this->_input_check("member_gender",array("empty_msg"=>lang("lang_member_info_00811","성별 입력해 주세요."),"focus_id"=>"member_gender"));
		$member_img = $this->_input_check("member_img",array());

		$data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone;
		$data['member_gender'] = $member_gender;
		$data['member_img'] = $member_img;

		$member_phone_check = $this->model_member_info->member_phone_check($data); // 회원 아이디 중복체크

		if($member_phone_check > 0){
			$response->code = "-1";
			$response->code_msg = lang("lang_add_00826","이미 가입된 전화번호 입니다. 확인 후 다시 진행 해 주세요.");

			echo json_encode($response);
			exit;
		}

		$member_name_check = $this->model_member_info->member_name_check($data); // 회원 아이디 중복체크

		if($member_name_check > 0){
			$response->code = "-1";
			$response->code_msg = lang("lang_login_00114_0","이미 사용중인 이름입니다.");

			echo json_encode($response);
			exit;
		}

		// $member_info_check = $this->model_member_info->member_info_check($data); // 회원 아이디 중복체크

		// if($member_info_check > 0){
		// 	$response->code = "-1";
		// 	$response->code_msg = lang("lang_login_00114","이미 사용중인 이름과 전화번호 입니다.");

		// 	echo json_encode($response);
		// 	exit;
		// }

		$result = $this->model_member_info->member_info_mod_up($data);

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");

		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

			// 신뢰의 시작 :: 프로필 사진 최초 등록 후
			if (!empty($member_img)) {
				$data['badge_type'] = '8';
				$data['member_idx'] = $this->member_idx;
				$COM_badge_check = $this->model_common->COM_badge_check($data);
			}

		}

		echo json_encode($response);
		exit;
  }

	// 소셜 가입자 회원정보
	public function member_info_check(){
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['product_idx'] = $product_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_member_info->member_detail($data); // 회원 상세보기

		$res = 1;

		if(count($result) != 0){
			if($result->member_name == ""){
				$res = 0;
			}
			if($result->member_phone == ""){
				$res = 0;
			}
		}

		$response = new stdClass();

		if($res == 1){
			$response->code = '1';
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = '0';
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

		}

		echo json_encode($response);
		exit;
	}

}// 클래스의 끝
?>

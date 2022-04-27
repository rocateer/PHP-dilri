<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-21
| Memo : 로그인
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

class Login_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(mapping('login').'/model_login');
	}

//인덱스
  public function index() {

    $this->login_detail();
  }

//메인 화면
  public function login_detail(){
		$return_url= $this->_input_check("return_url",array());

		$response = new stdClass();
		$response->return_url = $return_url;
		$response->agent = $this->_user_agent();

		$this->_view3(mapping('login').'/view_login_detail',$response);
  }

	public function login_action_member(){
		$member_id = $this->_input_check("member_id",array("empty_msg"=>lang("lang_login_00038","아이디를 입력하세요"),"focus_id"=>"member_id"));
		$member_pw = $this->_input_check("member_pw",array("empty_msg"=>lang("lang_login_00040","비밀번호를 입력하세요"),"focus_id"=>"member_pw"));
    $gcm_key = $this->_input_check("gcm_key",array());
    $device_os = $this->_input_check("device_os",array());


		$data['member_id'] = $member_id;
		$data['member_pw'] = $member_pw;

		$response = new stdClass();

		$result = $this->model_login->login_action_member($data);

		if(!empty($result)){
			# 탈퇴한 회원 체크
			if($result->del_yn == "Y" ){
		  	$response->code = "0";
				$response->code_msg = lang("lang_login_00048","사용할 수 없는 ID 입니다. 관리자에 문의 바랍니다.");

				echo json_encode($response);
				exit;
			}

			$response->code = "1000";
			$response->code_msg = lang("lang_login_00763","로그인되었습니다.");
			$response->member_idx =  (String)$result->member_idx;
			$response->member_id =  $result->member_id;

			$member_data = array(
        "member_idx" => $result->member_idx,
				"member_id" => $result->member_id,
				"gcm_key" => $gcm_key,
				"device_os" => $device_os,
				"app_yn" => $this->app_yn,
				"uuid" => $this->uuid,

			);

			$this->session->set_userdata($member_data);

      //변경 gcm_key !=""
			// if($gcm_key !=""){
			// }
			$data['member_idx'] = $result->member_idx;
			$data['gcm_key']    = $gcm_key;
			$data['device_os']  = $device_os;

			$this->model_login->member_gcm_device_up($data);//gcm_key, device_os 업데이트

      set_cookie('member_idx', $result->member_idx, 3600*24*365);
      set_cookie('member_id', $result->member_id, 3600*24*365);
      set_cookie('gcm_key', $gcm_key, 3600*24*365);
      set_cookie('device_os', $device_os, 3600*24*365);
      set_cookie('app_yn', $this->app_yn, 3600*24*365);
      set_cookie('uuid', $this->uuid, 3600*24*365);

		}else{
			$response->code = "0";
			$response->code_msg = lang("lang_login_00049","회원정보가 일치 하지 않습니다. 다시 확인 하여 주세요.");
		}

		echo json_encode($response);
		exit;
  }


	public function add_info_reg(){

		$return_url= $this->_input_check("return_url",array());

		$response = new stdClass();
		$response->return_url = $return_url;
		$response->agent = $this->_user_agent();

		$this->_view2(mapping('login').'/view_add_info_reg', $response);
  }

	// 추가정보 입력 수정
	public function member_info_mod_up(){
		$response = new stdClass();

		$member_name = $this->_input_check("member_name",array("empty_msg"=>lang("lang_member_info_00685"),"이름을 입력해 주세요.","focus_id"=>"member_name"));
		$member_phone = $this->_input_check("member_phone",array("empty_msg"=>lang("lang_member_info_00810"),"전화번호를 입력해 주세요.","focus_id"=>"member_phone"));
		$member_gender = $this->_input_check("member_gender",array("empty_msg"=>lang("lang_member_info_00811"),"성별 입력해 주세요.","focus_id"=>"member_gender"));

		$data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone;
		$data['member_gender'] = $member_gender;

		// $member_phone_check = $this->model_login->member_phone_check($data);

		// if($member_phone_check > 0){
		// 	$response->code = "-1";
		// 	$response->code_msg = "같은 전화번호로 가입된 회원입니다. 다른 번호를 입력해 주세요.";

		// 	echo json_encode($response);
		// 	exit;
		// }

		$member_info_check = $this->model_login->member_info_check($data); // 회원 아이디 중복체크

		if($member_info_check > 0){
			$response->code = "-1";
			$response->code_msg = lang("lang_login_00114","이미 사용중인 이름과 전화번호 입니다.");

			echo json_encode($response);
			exit;
		}

		$result = $this->model_login->member_info_mod_up($data);

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","실패하였습니다. 다시 시도 해주시기 바랍니다.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","성공하였습니다.");
		}

		echo json_encode($response);
		exit;
  }


	// 추가정보 입력 수정
	public function double_login_check(){

		$response = new stdClass();

		// 미로그인 체크
		if(!$this->session->userdata("member_idx") ){
			$response->code = 0;
			$response->code_msg = lang("lang_add_00827","미로그인 상태입니다.");

			echo json_encode($response);
			exit;
		}


		// 다른 기기에서의 로그인 여부 확인
		$gcm_key = $this->_input_check("gcm_key",array());
    $device_os = $this->_input_check("device_os",array());

		$login_check = $this->model_login->login_check();

		if ($login_check->gcm_key != $gcm_key || $login_check->device_os != $device_os) {
			$response->code = 1;
			$response->code_msg = lang("lang_add_00828","다른 기기에서 로그인했습니다.");
		}else {
			$response->code = 0;
			$response->code_msg = lang("lang_add_00829","다른 기기에서 사용 중이 아닙니다.");

			echo json_encode($response);
			exit;
		}
  }


}// 클래스의 끝
?>

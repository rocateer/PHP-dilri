<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	최재명
| Create-Date : 2020-11-25
| Memo : 네이티브 로그인
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

class Native_login extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('native_login/model_native_login');
  }

	public function index(){

		$this->sns_member_login();
	}

  //SNS회원 로그인/가입
	public function sns_member_login(){
		header('Content-Type: application/json');
    $response = new stdClass;

    $member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요.","focus_id"=>"member_id"));
    $member_join_type = $this->_input_check("member_join_type",array("empty_msg"=>"회원형대를 입력해주세요.","focus_id"=>"member_join_type"));
    $gcm_key = $this->_input_check("gcm_key",array("empty_msg"=>"gcm_key를 입력해주세요.","focus_id"=>"gcm_key"));
    $device_os = $this->_input_check("device_os",array("empty_msg"=>"device_os를 입력해주세요.","focus_id"=>"device_os"));

		$data['member_id']=$member_id;
		$data['member_join_type']=$member_join_type;
		$data['gcm_key']=$gcm_key;
		$data['device_os']=$device_os;

		$sns_member_login_check=$this->model_native_login->sns_member_login_check($data);

		if (count($sns_member_login_check) == 0) {

      // $response->code = "-2";
      // $response->code_msg = "가입이 되지않았습니다.";
      //
      // $response->user_idx =  $result;
      // $response->user_id =  $member_id;
      // $response->user_name = "";
      // echo json_encode($response);
      // exit;
      $result = $this->model_native_login->sns_member_auto_reg_in($data);
      $response->code = "1000";
      $response->code_msg = "로그인되었습니다.";

      $response->new_yn = 'Y';
      $response->user_idx =  (string)$result;
      $response->user_id =  (string)$member_id;
      $response->user_name = "";

      echo json_encode($response);
      exit;
		}else{
      //탈퇴회원
      if($sns_member_login_check->del_yn == "Y"){
        $response->code = "0";
        $response->code_msg = "사용할 수 없는 ID 입니다. 관리자에 문의 바랍니다.";
        
        $response->new_yn = 'N';
        $response->user_idx =  "";
        $response->user_id =  "";
        $response->user_name = "";
        echo json_encode($response);
        exit;
      }
      $data['member_idx']=$sns_member_login_check->member_idx;
      $result = $this->model_native_login->member_gcm_device_up($data); // gcm_key,device_os 업데이트

      $response->code = "1000";
			$response->code_msg = "로그인되었습니다.";

      $response->new_yn = 'N';
			$response->user_idx =  (string)$sns_member_login_check->member_idx;
			$response->user_id =  (string)$sns_member_login_check->member_id;
			$response->user_name = $sns_member_login_check->member_name;

			echo json_encode($response);
			exit;

    }

	}

  public function set_member_cookie(){

    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원키가 누락됐습니다.","focus_id"=>"member_idx"));
    $member_id = $this->_input_check("member_id",array());
    $gcm_key = $this->_input_check("gcm_key",array());
    $device_os = $this->_input_check("device_os",array());

    // if($gcm_key !=""){
    // }
    $data['member_idx'] = $member_idx;
    $data['gcm_key']    = $gcm_key;
    $data['device_os']  = $device_os;

    $this->model_native_login->member_gcm_device_up($data);//gcm_key, device_os 업데이트

    $member_data = array(
      "member_idx" => $member_idx,
      "member_id" => $member_id,
      "gcm_key" => $gcm_key,
      "device_os" => $device_os,
      "app_yn" => 'Y',
			"uuid" => $this->uuid,

    );

    $this->session->set_userdata($member_data);

    set_cookie('member_idx', $member_idx, 3600*24*365);
    set_cookie('member_id', $member_id, 3600*24*365);
    set_cookie('gcm_key', $gcm_key, 3600*24*365);
    set_cookie('device_os', $device_os, 3600*24*365);
    set_cookie('app_yn', 'Y', 3600*24*365);
    set_cookie('uuid', $this->uuid, 3600*24*365);


		$response = new stdClass();

    $response->code = "1000";
    $response->code_msg = lang("lang_login_00763","로그인되었습니다.");
    
    echo json_encode($response);
    exit;
  }

  //SNS회원 가입
  public function sns_member_join(){
    $member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요.","focus_id"=>"member_id"));
    $member_join_type = $this->_input_check("member_join_type",array("empty_msg"=>"회원형태를 입력해주세요.","focus_id"=>"member_join_type"));
    $gcm_key = $this->_input_check("gcm_key",array("empty_msg"=>"gcm_key를 입력해주세요.","focus_id"=>"gcm_key"));
    $device_os = $this->_input_check("device_os",array("empty_msg"=>"device_os를 입력해주세요.","focus_id"=>"device_os"));

    $terms_list = $this->model_native_login->terms_list();

    $response = new stdClass();

    $response->terms_list = $terms_list;
    $response->member_id = $member_id;
    $response->$member_join_type = $member_join_type;
    $response->gcm_key = $gcm_key;
    $response->device_os = $device_os;

    $this->_view_sub('native_login/view_join_reg',$response);
	}


  //SNS회원 가입
  public function sns_member_reg_in(){
		header('Content-Type: application/json');
    $response = new stdClass;

    $member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요.","focus_id"=>"member_id"));
    $member_join_type = $this->_input_check("member_join_type",array("empty_msg"=>"회원형태를 입력해주세요.","focus_id"=>"member_join_type"));
    $gcm_key = $this->_input_check("gcm_key",array("empty_msg"=>"gcm_key를 입력해주세요.","focus_id"=>"gcm_key"));
    $device_os = $this->_input_check("device_os",array("empty_msg"=>"device_os를 입력해주세요.","focus_id"=>"device_os"));
    $member_phone = $this->_input_check("member_phone",array("empty_msg"=>"전화번호를을 입력해주세요.","focus_id"=>"member_phone"));
    $member_name = $this->_input_check("member_name",array("empty_msg"=>"닉네임은 입력해주세요.","regular_msg" => "닉네임는 한글,영어 조합으로 2자~10자내로 입력해주세요.","type" => "custom","custom" => "/^[a-zA-Z가-힣]{2,10}$/"));

		$data['member_id']=$member_id;
		$data['member_join_type']=$member_join_type;
		$data['gcm_key']=$gcm_key;
		$data['device_os']=$device_os;
    $data['member_name'] = $member_name;
    $data['member_phone'] = $member_phone;

		$sns_member_login_check=$this->model_native_login->sns_member_login_check($data);//SNS회원 가입 체크


		if (count($sns_member_login_check) > 0) {

      if($sns_member_login_check->del_yn == "Y"){
        $response->code = "-1";
        $response->code_msg = "사용할 수 없는 ID 입니다. 관리자에 문의 바랍니다.";

        echo json_encode($response);
        exit;
      }else {

        $response->code = "-2";
        $response->code_msg = "이미 가입 되어 있습니다.";
        $response->user_idx = $sns_member_login_check->member_idx;
        

        echo json_encode($response);
        exit;
      }

		}

    # model. 닉네임 중복 체크
    $member_id_check = $this->model_native_login->member_name_check($data);

    if($member_id_check > 0){
      $response->code = "-3";
      $response->code_msg = "이미 사용 중인 닉네임입니다.";

      echo json_encode($response);
      exit;
    }

		$result = $this->model_native_login->sns_member_reg_in($data); // gcm_key,device_os 업데이트

		if($result =='0'){
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = "회원가입에 실패 하였습니다.";

			echo json_encode($response);
			exit;
		}else{

			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = "회원가입에 성공하였습니다.";
			$response->user_idx = $result;

			echo json_encode($response);
			exit;
		}
	}

}	// 클래스의 끝
?>

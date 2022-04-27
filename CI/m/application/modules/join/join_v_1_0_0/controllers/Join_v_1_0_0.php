<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-21
| Memo : 회원가입
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

class Join_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('join').'/model_join');
		$this->load->model('common/model_common');

	}

//인덱스
  public function index() {
    $this->join_reg();
  }

//메인 화면
  public function join_reg(){
		$terms_list = $this->model_join->terms_list();

		$response = new stdClass();

		$response->terms_list = $terms_list;
		$response->agent = $this->_user_agent();

		$this->_view2(mapping('join').'/view_join_reg',$response);
  }

//메인 화면
  public function join_complete_detail(){
		$this->_view2(mapping('join').'/view_join_complete_detail');
  }

	public function terms_detail(){

    $type = $this->_input_check("type",array());

		$data['type'] = $type;

		$result=$this->model_join->terms_detail($data);//약관 상세 보기

		$response = new stdClass();

    if(empty($result)){
			$response->code = "0";
			$response->code_msg = "정보를 불러오지 못했습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "성공";
			$response->title = $result->title;
			$response->contents = $result->contents;
		}

		echo json_encode($response);
		exit;
  }

	public function join_reg_in(){

		$response = new stdClass();

		$member_id = $this->_input_check("member_id",array("empty_msg"=>lang("lang_join_00087","아이디를 입력해주세요."),"regular_msg" => lang("lang_join_00088","아이디는 이메일 형식으로 입력해 주세요."),"type" => "email", "focus_id"=>"member_id"));
		$member_pw = $this->_input_check("member_pw",array("empty_msg"=>lang("lang_join_00089","비밀번호를 입력해주세요."),"regular_msg" => lang("lang_join_00090","비밀번호는 영어,숫자 조합으로 8자~15자내로 입력해주세요."),"type" => "custom","custom" => "/^.*(?=^.{8,15}$)(?=.*\d)(?=.*[a-zA-Z])(?!.*[!~@#$%^&*()?+=\/]).*$/","focus_id"=>"member_pw"));
		$member_pw_confirm = $this->_input_check("member_pw_confirm",array("empty_msg"=>lang("lang_join_00770","비밀번호 확인을 입력해주세요."),"focus_id"=>"member_pw_confirm"));
		$member_phone = $this->_input_check("member_phone",array());
		// $member_phone = $this->_input_check("member_phone",array("empty_msg"=>lang("lang_member_info_00810","전화번호를 입력해 주세요."),"focus_id"=>"member_phone"));

		$member_name = $this->_input_check("member_name",array("empty_msg"=>lang("lang_join_00094","이름을 입력해 주세요."),"focus_id"=>"member_name"));
		$auth_check = $this->_input_check("auth_check",array("empty_msg"=>lang("lang_join_00093","전화번호 인증을 하지 않으셨습니다.")));
		$terms_check = $this->_input_check("terms_check",array());

		$data['member_id'] = $member_id;
		$data['member_pw'] = $member_pw;
    $data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone; // 임시로 고정값 넣음.

		$member_id_check = $this->model_join->member_id_check($data); // 회원 아이디 중복체크

		if($member_id_check > 0){
			$response->code = "-1";
			$response->code_msg = lang("lang_join_00086","이미 가입된 아이디 입니다. 확인 후 다시 진행 해 주세요.");

			echo json_encode($response);
			exit;
		}

		if($member_pw_confirm != $member_pw){
			$response->code = "-1";
			$response->code_msg = lang("lang_join_00091","비밀번호와 비밀번호 확인이 일치 하지 않습니다. 다시 확인해 주세요.");

			echo json_encode($response);
			exit;
		}

		if($auth_check == 'N'){
			$response->code = "-1";
			$response->code_msg = lang("lang_join_00093","전화번호 인증을 하지 않으셨습니다.");

			echo json_encode($response);
			exit;
		}

		$member_phone_check = $this->model_join->member_phone_check($data); // 회원 전화번호 중복체크

		if($member_phone_check > 0){
			$response->code = "-1";
			$response->code_msg = lang("lang_add_00826","이미 가입된 전화번호 입니다. 확인 후 다시 진행 해 주세요.");

			echo json_encode($response);
			exit;
		}

		$member_name_check = $this->model_join->member_name_check($data); // 회원 아이디 중복체크

		if($member_name_check > 0){
			$response->code = "-1";
			$response->code_msg = lang("lang_login_00114_0","이미 사용중인 이름입니다.");

			echo json_encode($response);
			exit;
		}

		// $member_info_check = $this->model_join->member_info_check($data); // 회원 아이디 중복체크

		// if($member_info_check > 0){
		// 	$response->code = "-1";
		// 	$response->code_msg = lang("lang_login_00114","이미 사용중인 이름과 전화번호 입니다.");

		// 	echo json_encode($response);
		// 	exit;
		// }

		if($terms_check == 'N'){
			$response->code = "-1";
			$response->code_msg = lang("lang_join_00092","필수 이용약관에 동의하지 않으셨습니다.2");

			echo json_encode($response);
			exit;
		}

		# model. 회원 가입
		$result = $this->model_join->member_reg_in($data);

		if($result == "0"){
			$response->code = "0";
			$response->code_msg = lang("lang_join_00769","정보를 불러오지 못했습니다. 잠시 후 다시 시도해주세요.");

		}else{
			$response->code = "1000";
			$response->code_msg = lang("lang_join_00097","회원가입이 완료되었습니다.");

			$data['member_idx'] = $result;
			$data['point'] = 2000;
			$data['memo_type'] = '1';

			$this->model_common->member_point_mod_up($data);

		}

		echo json_encode($response);
		exit;
  }
}// 클래스의 끝
?>

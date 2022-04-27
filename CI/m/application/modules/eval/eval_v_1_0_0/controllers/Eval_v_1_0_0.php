<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-11-15
| Memo : 평가목록
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

class Eval_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->session->userdata("member_idx") ){
			redirect("/".mapping('login')."?return_url=/".mapping('eval'));
			exit;
		}

		$this->load->model(mapping('eval').'/model_eval');
		$this->load->model('common/model_common');

	}

	//인덱스
  public function index() {

    $this->free_sell_reg();
  }

	// 퍈매자 무료나눔 평가 등록
  public function free_sell_reg(){
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다."),"focus_id"=>"product_idx"));

		$response = new stdClass();

		$response->product_idx = $product_idx;

		$this->_view2(mapping('eval').'/view_free_sell_reg',$response);
  }

	//구매자 무료나눔 평가 등록
  public function free_buy_reg(){
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다."),"focus_id"=>"product_idx"));

		$response = new stdClass();

		$response->product_idx = $product_idx;

		$this->_view2(mapping('eval').'/view_free_buy_reg',$response);
  }

	// 나눔 피드백 등록::판매자 무료나눔 평가 등록
	public function free_sell_reg_in(){
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다."),"focus_id"=>"product_idx"));
    $free_product_cnt_0 = $this->_input_check("free_product_cnt_0",array("ternary"=>'0'));
    $free_product_cnt_1 = $this->_input_check("free_product_cnt_1",array("ternary"=>'0'));
    $free_product_cnt_2 = $this->_input_check("free_product_cnt_2",array("ternary"=>'0'));
    $free_product_cnt_3 = $this->_input_check("free_product_cnt_3",array("ternary"=>'0'));

		if (empty($free_product_cnt_0) && empty($free_product_cnt_1) && empty($free_product_cnt_2) && empty($free_product_cnt_3) ) {
			$response = new stdClass();

			$response->code ="-1";
			$response->code_msg 	= lang("lang_mypage_00578","나눔 피드백을 한개 이상 선택해 주세요.");

			echo json_encode($response);
			exit;
		}

    $data['free_product_cnt_0'] = $free_product_cnt_0;
		$data['free_product_cnt_1'] = $free_product_cnt_1;
		$data['free_product_cnt_2'] = $free_product_cnt_2;
		$data['free_product_cnt_3'] = $free_product_cnt_3;
		$data['product_idx'] = $product_idx;

		$result = $this->model_eval->free_sell_reg_in($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");


			// 리뷰어 :: 거래 후 평가 작성이 1회 이상
			$data['badge_type'] = '6';
			$data['member_idx'] = $this->member_idx;
			$COM_badge_check = $this->model_common->COM_badge_check($data);

			// 알려주는 구매자 :: 중고거래 구매 후 평가 1회 이상
			$data['badge_type'] = '9';
			$data['member_idx'] = $this->member_idx;
			$COM_badge_check = $this->model_common->COM_badge_check($data);

		}
		echo json_encode($response);
		exit;
	}

	// 고마움 피드백 등록::구매자 무료나눔 평가 등록
	public function free_buy_reg_in(){
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다."),"focus_id"=>"product_idx"));
		$free_product_cnt_4 = $this->_input_check("free_product_cnt_4",array("ternary"=>'0'));
    $free_product_cnt_5 = $this->_input_check("free_product_cnt_5",array("ternary"=>'0'));
    $free_product_cnt_6 = $this->_input_check("free_product_cnt_6",array("ternary"=>'0'));
    $free_product_cnt_7 = $this->_input_check("free_product_cnt_7",array("ternary"=>'0'));
    $free_product_cnt_8 = $this->_input_check("free_product_cnt_8",array("ternary"=>'0'));

		if (empty($free_product_cnt_4) && empty($free_product_cnt_5) && empty($free_product_cnt_6) && empty($free_product_cnt_7)  && empty($free_product_cnt_8)) {
			$response = new stdClass();

			$response->code ="-1";
			$response->code_msg 	= lang("lang_mypage_00618","고마움 피드백을 한개 이상 선택해 주세요.");

			echo json_encode($response);
			exit;
		}

    $data['free_product_cnt_4'] = $free_product_cnt_4;
		$data['free_product_cnt_5'] = $free_product_cnt_5;
		$data['free_product_cnt_6'] = $free_product_cnt_6;
		$data['free_product_cnt_7'] = $free_product_cnt_7;
		$data['free_product_cnt_8'] = $free_product_cnt_8;
		$data['product_idx'] = $product_idx;

		$result = $this->model_eval->free_buy_reg_in($data); // 1:1 질문 등록하기

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");


			// 리뷰어 :: 거래 후 평가 작성이 1회 이상
			$data['badge_type'] = '6';
			$data['member_idx'] = $this->member_idx;
			$COM_badge_check = $this->model_common->COM_badge_check($data);

			//알람 108 :: 새로운 나눔 평가가 완료 되었습니다.
			// $check = $this->model_eval->product_detail($data);
			//
			// $index="108";
			// $alarm_data = array();
			// $this->_alarm_action($check->member_idx,0,$index, $alarm_data);

		}

		echo json_encode($response);
		exit;
	}


	//구매자 평가하기:: 좋음/나쁨 선택
  public function genelar_list(){
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다."),"focus_id"=>"product_idx"));

		$response = new stdClass();

		$response->product_idx = $product_idx;

		$this->_view2(mapping('eval').'/view_genelar_list',$response);
  }

	// 구매자 평가하기:: 좋음
  public function nice_reg(){
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다."),"focus_id"=>"product_idx"));

		$response = new stdClass();

		$response->product_idx = $product_idx;

		$this->_view2(mapping('eval').'/view_nice_reg',$response);
  }

	// 구매자 평가하기:: 나쁨
  public function bad_reg(){
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다."),"focus_id"=>"product_idx"));

		$response = new stdClass();

		$response->product_idx = $product_idx;

		$this->_view2(mapping('eval').'/view_bad_reg',$response);
  }

	// 구매자 좋음 평가
	public function good_buy_reg_in(){
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다."),"focus_id"=>"product_idx"));
    $good_product_cnt_0 = $this->_input_check("good_product_cnt_0",array("ternary"=>'0'));
    $good_product_cnt_1 = $this->_input_check("good_product_cnt_1",array("ternary"=>'0'));
    $good_product_cnt_2 = $this->_input_check("good_product_cnt_2",array("ternary"=>'0'));
    $good_product_cnt_3 = $this->_input_check("good_product_cnt_3",array("ternary"=>'0'));
    $good_product_cnt_4 = $this->_input_check("good_product_cnt_4",array("ternary"=>'0'));

    $data['good_product_cnt_0'] = $good_product_cnt_0;
		$data['good_product_cnt_1'] = $good_product_cnt_1;
		$data['good_product_cnt_2'] = $good_product_cnt_2;
		$data['good_product_cnt_3'] = $good_product_cnt_3;
		$data['good_product_cnt_4'] = $good_product_cnt_4;
		$data['product_idx'] = $product_idx;

		$result = $this->model_eval->good_buy_reg_in($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");


			// 리뷰어 :: 거래 후 평가 작성이 1회 이상
			$data['badge_type'] = '6';
			$data['member_idx'] = $this->member_idx;
			$COM_badge_check = $this->model_common->COM_badge_check($data);

			// 친절한 판매자 :: 중고거래 판매 후  좋음 평가가 10회 이상
			$data['badge_type'] = '7';
			$data['member_idx'] = $this->member_idx;
			$COM_badge_check = $this->model_common->COM_badge_check($data);

			// 알려주는 구매자 :: 중고거래 구매 후 평가 1회 이상
			$data['badge_type'] = '9';
			$data['member_idx'] = $this->member_idx;
			$COM_badge_check = $this->model_common->COM_badge_check($data);

			//알람 107 :: 새로운 평가가 완료 되었습니다.
			// $check = $this->model_eval->product_detail($data);
			//
			// $index="107";
			// $alarm_data = array();
			//
			// $this->_alarm_action($check->member_idx,0,$index, $alarm_data);

		}
		echo json_encode($response);
		exit;
	}

	// 판매자 나쁨 평가
	public function bad_buy_reg_in(){
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다."),"focus_id"=>"product_idx"));
    $bad_product_cnt_0 = $this->_input_check("bad_product_cnt_0",array("ternary"=>'0'));
    $bad_product_cnt_1 = $this->_input_check("bad_product_cnt_1",array("ternary"=>'0'));
    $bad_product_cnt_2 = $this->_input_check("bad_product_cnt_2",array("ternary"=>'0'));
    $bad_product_cnt_3 = $this->_input_check("bad_product_cnt_3",array("ternary"=>'0'));
    $bad_product_cnt_4 = $this->_input_check("bad_product_cnt_4",array("ternary"=>'0'));
    $bad_product_cnt_5 = $this->_input_check("bad_product_cnt_5",array("ternary"=>'0'));
    $bad_product_cnt_6 = $this->_input_check("bad_product_cnt_6",array("ternary"=>'0'));
    $bad_product_cnt_7 = $this->_input_check("bad_product_cnt_7",array("ternary"=>'0'));

    $data['bad_product_cnt_0'] = $bad_product_cnt_0;
		$data['bad_product_cnt_1'] = $bad_product_cnt_1;
		$data['bad_product_cnt_2'] = $bad_product_cnt_2;
		$data['bad_product_cnt_3'] = $bad_product_cnt_3;
		$data['bad_product_cnt_4'] = $bad_product_cnt_4;
		$data['bad_product_cnt_5'] = $bad_product_cnt_5;
		$data['bad_product_cnt_6'] = $bad_product_cnt_6;
		$data['bad_product_cnt_7'] = $bad_product_cnt_7;
		$data['product_idx'] = $product_idx;

		$result = $this->model_eval->bad_buy_reg_in($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");


			// 리뷰어 :: 거래 후 평가 작성이 1회 이상
			$data['badge_type'] = '6';
			$data['member_idx'] = $this->member_idx;
			$COM_badge_check = $this->model_common->COM_badge_check($data);

			// 알려주는 구매자 :: 중고거래 구매 후 평가 1회 이상
			$data['badge_type'] = '9';
			$data['member_idx'] = $this->member_idx;
			$COM_badge_check = $this->model_common->COM_badge_check($data);

			//알람 107 :: 새로운 평가가 완료 되었습니다.
			// $check = $this->model_eval->product_detail($data);
			//
			// $index="107";
			// $alarm_data = array();
			//
			// $this->_alarm_action($check->member_idx,0,$index, $alarm_data);

		}
		echo json_encode($response);
		exit;
	}


	//메인 화면
  public function complete(){
		$this->_view2(mapping('eval').'/view_complete');
  }

	//메인 화면
  public function history_list(){

		$result = $this->model_eval->mypage_detail(); // 회원 정보

		$response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('eval').'/view_history_list',$response);
  }



}// 클래스의 끝
?>

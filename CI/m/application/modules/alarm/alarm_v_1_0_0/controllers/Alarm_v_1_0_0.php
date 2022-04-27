<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-22
| Memo : 알람
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

class Alarm_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->session->userdata("member_idx") ){
			redirect("/".mapping('login')."?return_url=/".mapping('alarm'));
			exit;
		}

		$this->load->model(mapping('alarm').'/model_alarm');
	}

	//인덱스
  public function index() {
    $this->alarm_list();
  }

	// 알림 리스트 뷰
  public function alarm_list(){
		$this->_view2(mapping('alarm').'/view_alarm_list');
  }

	// 알림 리스트
	public function alarm_list_get(){

    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = 15;

		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$alarm_list = $this->model_alarm->alarm_list($data); //  알람리스트
		$alarm_list_count = $this->model_alarm->alarm_list_count(); //  알람리스트
    $no = $alarm_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($alarm_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->alarm_list = $alarm_list;
    $response->alarm_list_count = $alarm_list_count;
    $response->total_block = ceil($alarm_list_count/$page_size);

		$this->_ajax_view(mapping('alarm').'/view_alarm_list_get',$response);
	}

	// 알림 삭제
	public function alarm_del(){
		$response = new stdClass();

	  $alarm_idx = $this->_input_check("alarm_idx",array());

		$data['alarm_idx'] = $alarm_idx;

		$result = $this->model_alarm->alarm_del($data);

		if($result == "0") {
				$response->code = 0;
				$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
			} else {
				$response->code = 1;
				$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

		}

		echo json_encode($response);
		exit;
	}

	//삭제하기
	public function all_alarm_del(){
		$response = new stdClass();

		$result = $this->model_alarm->all_alarm_del();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}

	// 알림 읽음처리
	public function alarm_read_mod_up(){
		header('Content-Type: application/json');

		$alarm_idx = $this->_input_check("alarm_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['alarm_idx'] = $alarm_idx;

		$result = $this->model_alarm->alarm_read_mod_up($data); //새로온 알림 카운트

		$response = new stdClass();

		$response->code = "1000";
		$response->code_msg = "";

		echo json_encode($response);
		exit;
	}

		// 키워드 알림 설정 뷰
  public function keyword_set(){
		$this->_view2(mapping('alarm').'/view_keyword_set');
  }

	// 알림 방해 금지 설정 뷰
  public function alarm_setting(){
		$result_ = $this->model_alarm->get_alarm_setting();

		$no_alarm_yn = $result_->no_alarm_yn;
		$alram_s_date = $result_->alram_s_date;
		$alram_e_date = $result_->alram_e_date;

		$alram_s_date_arr = explode(":", $alram_s_date);
		$alram_e_date_arr = explode(":", $alram_e_date);

		$s_hour = !empty($alram_s_date_arr[0])?$alram_s_date_arr[0]:NULL;
		$s_minuet = !empty($alram_s_date_arr[1])?$alram_s_date_arr[1]:NULL;
		$e_hour = !empty($alram_e_date_arr[0])?$alram_e_date_arr[0]:NULL;
		$e_minuet = !empty($alram_e_date_arr[1])?$alram_e_date_arr[1]:NULL;

		$result = array();

		$result['no_alarm_yn'] = $no_alarm_yn;
		$result['s_hour'] = $s_hour;
		$result['s_minuet'] = $s_minuet;
		$result['e_hour'] = $e_hour;
		$result['e_minuet'] = $e_minuet;

		$response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('alarm').'/view_alarm_setting',$response);
  }

	// 알림 방해 금지 설정
	public function alarm_setting_mod_up(){
		$no_alarm_yn = $this->_input_check("no_alarm_yn",array());

		if($no_alarm_yn == 'Y'){
			$s_hour = $this->_input_check("s_hour",array("empty_msg"=>lang("lang_mypage_00670","시작시간과 종료시간을 입력하여 주세요.")));
			$s_minuet = $this->_input_check("s_minuet",array("empty_msg"=>lang("lang_mypage_00670","시작시간과 종료시간을 입력하여 주세요.")));
			$e_hour = $this->_input_check("e_hour",array("empty_msg"=>lang("lang_mypage_00670","시작시간과 종료시간을 입력하여 주세요.")));
			$e_minuet = $this->_input_check("e_minuet",array("empty_msg"=>lang("lang_mypage_00670","시작시간과 종료시간을 입력하여 주세요.")));
		} else {
			$s_hour = $this->_input_check("s_hour",array());
			$s_minuet = $this->_input_check("s_minuet",array());
			$e_hour = $this->_input_check("e_hour",array());
			$e_minuet = $this->_input_check("e_minuet",array());
		}

		$alram_s_date = $s_hour.':'.$s_minuet;
		$alram_e_date = $e_hour.':'.$e_minuet;

		$data['no_alarm_yn'] = $no_alarm_yn;
		$data['alram_s_date'] = $alram_s_date;
		$data['alram_e_date'] = $alram_e_date;

		$result = $this->model_alarm->alarm_setting_mod_up($data); // 알림 방해 금지 설정

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

		}

		echo json_encode($response);
		exit;

	}

	// 해시태그 등록
	public function hashtag_reg_in(){
		$alarm_keyword = $this->_input_check("alarm_keyword",array("empty_msg"=>lang("lang_product_00161","태그를 입력 해주세요.")));

		$hashtags = $this->model_alarm->hashtag_get(); // 해시태그 가져오기

		$hashtags_arr = explode(",",$hashtags->alarm_keyword);

		$this->tags_over_check($hashtags_arr); // 태그 등록 수 초과 체크
		$this->tags_dup_check($hashtags_arr, $alarm_keyword); // 태그 중복 체크

		if(empty($hashtags->alarm_keyword)){
			$data['alarm_keyword'] = $alarm_keyword;
		} else {
			$data['alarm_keyword'] = $alarm_keyword.','.$hashtags->alarm_keyword;
		}

		$result = $this->model_alarm->hashtag_reg_in($data); // 해시태그 등록

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

		}

		echo json_encode($response);
		exit;
	}

	// 해시태그 가져오기
	public function hashtag_get(){
		$result = $this->model_alarm->hashtag_get();	// 해시태그 가져오기

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

			$response->result = $result;
		}

		$this->_ajax_view(mapping('alarm').'/view_keyword_get',$response);
	}

	// 해시태그 삭제
	public function hashtag_del(){
		$alarm_keyword = $this->_input_check("alarm_keyword",array());
		$hashtags = $this->model_alarm->hashtag_get(); // 해시태그 가져오기

		$hashtags_arr = explode(",",$hashtags->alarm_keyword);

		$new_hashtags = "";
		$i=0;
		foreach($hashtags_arr as $row){
			if($row != $alarm_keyword){
				$new_hashtags .= $i==0?$row:','.$row;
			}
			$i++;
		}

		if (substr($new_hashtags, 0, 1)==',') {
			$new_hashtags = substr($new_hashtags, 1);
		}


		$data['alarm_keyword'] = $new_hashtags;

		$result = $this->model_alarm->hashtag_del($data); // 해시태그 삭제

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

		}

		echo json_encode($response);
		exit;
	}

	// 태그 등록 수 초과 체크
	private function tags_over_check($hashtags_arr){
		if(count($hashtags_arr) >= 30){
			$response = new stdClass();

			$response->code = "-1";
			$response->code_msg = lang("lang_member_info_00814","최대 30개 까지 등록 가능합니다.");

			echo json_encode($response);
			exit;
		}
	}

	// 태그 중복 체크
	private function tags_dup_check($hashtags_arr, $alarm_keyword){
		$res = false;
		foreach($hashtags_arr as $row){
			if($row == $alarm_keyword){
				$res = true;
			}
		}

		if($res){
			$response = new stdClass();

			$response->code = "-1";
			$response->code_msg = lang("lang_member_info_00815","이미 등록된 태그 입니다.");

			echo json_encode($response);
			exit;
		}
	}

}// 클래스의 끝
?>

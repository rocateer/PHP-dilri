<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-25
| Memo : 메인화면
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

class Main_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('main').'/model_main');
	}

	//인덱스
  public function index() {

    $this->main_detail();
  }

	//메인 화면
  public function main_detail(){

		

		$notice = $this->model_main->notice_get(); // 공지사항 가져오기
		$banner = $this->model_main->banner_get(); // 배너 가져오기
		$member_location_list = $this->model_main->member_location_list(); // 상품 리스트 카운트
		$category_management_list = $this->model_main->category_management_list(); // 상품 리스트 카운트
		
		if ($this->session->userdata("member_idx")) {
			$member_detail = $this->model_main->member_detail(); // 상품 리스트 카운트
			$my_location=$member_detail->member_location_idx;
			$category_management_idx=$member_detail->category_management_idx;
		}else {
			$my_location='0';
			$category_management_idx=get_cookie('category_management_idx');
		}
		
		$response = new stdClass();

		$response->category_management_idx = $category_management_idx;
		$response->notice = $notice;
		$response->banner = $banner;		
		$response->my_location = $my_location;		
		$response->member_detail = !empty($member_detail)?$member_detail:NULL;		
		$response->member_location_list = $member_location_list;		
		$response->category_management_list = $category_management_list;		
		$response->agent = $this->_user_agent();
		
		$this->_view(mapping('main').'/view_main_detail', $response);
  }
	
	//메인 화면
	public function main_list_get(){
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;
		
		$current_lat = $this->_input_check("current_lat",array("ternary"=>'37.5185682'));
		$current_lng = $this->_input_check("current_lng",array("ternary"=>'127.0230294'));
		$distance = $this->_input_check("distance",array("ternary"=>'6'));
		$category_management_idx = $this->_input_check("category_management_idx",array());
		
		$data['distance'] = $distance;
		$data['current_lat'] = $current_lat;
		$data['current_lng'] = $current_lng;
		$data['category_management_idx'] = $category_management_idx;

		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		set_cookie('category_management_idx', $category_management_idx, 3600*24*365);
		
		$this->model_main->category_management_idx_mod_up($data); // 카테고리 저장
		$result_list = $this->model_main->product_list_get($data); // 상품 리스트 가져오기
		$result_list_count = $this->model_main->product_list_count($data); // 상품 리스트 카운트
		
		$response = new stdClass();
		
		$response->total_block = ceil($result_list_count/$page_size);
		$response->result_list = $result_list;	
		
		$this->_ajax_view(mapping('main').'/view_main_list_get', $response);
	}
	
	// 내 위치 삭제
	public function member_location_del(){
		$member_location_idx = $this->_input_check("member_location_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['member_location_idx'] = $member_location_idx;

		$result = $this->model_main->member_location_del($data);

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
	
	// 주소 등록
	public function member_location_reg_in(){
		$member_addr = $this->_input_check("member_addr",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$member_lat = $this->_input_check("member_lat",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$member_lng = $this->_input_check("member_lng",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$title = $this->_input_check("title",array("empty_msg"=>lang("lang_product_00174","노출할 지역 이름을 지정해 주세요.")));
		$distance = $this->_input_check("addr_distance",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['member_addr'] = $member_addr;
		$data['member_lat'] = $member_lat;
		$data['member_lng'] = $member_lng;
		$data['title'] = $title;
		$data['distance'] = $distance;

		$result = $this->model_main->member_location_reg_in($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_product_00175","위치가 등록 되었습니다.");
		}
		echo json_encode($response);
		exit;
	}
	
	// 주소 지정
	public function my_location_mod_up(){
		$member_location_idx = $this->_input_check("member_location_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['member_location_idx'] = $member_location_idx;

		$result = $this->model_main->my_location_mod_up($data);

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
	
	
}// 클래스의 끝
?>

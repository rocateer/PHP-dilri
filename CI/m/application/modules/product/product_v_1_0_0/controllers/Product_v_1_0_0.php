<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-26
| Memo : 상품
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

class Product_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('product').'/model_product');
		$this->load->model('common/model_common');

	}

//인덱스
  public function index() {

    $this->product_detail();
  }

	// 상품 상세
  public function product_detail(){
		$product_idx = $this->_input_check("product_idx", array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$current_lat = $this->_input_check("current_lat", array());
		$current_lng = $this->_input_check("current_lng", array());

		$data['product_idx'] = $product_idx;
		$data['current_lat'] = $current_lat;
		$data['current_lng'] = $current_lng;

		if (empty($product_idx)) {
			redirect(mapping('product'));
		}

		$member_detail = $this->model_product->member_detail($data);
		$rst = $this->model_product->view_cnt_mod_up($data);
		$result = $this->model_product->product_detail($data); // 상품 상세

		$response = new stdClass();

		if($this->member_idx != ""){
			$like_yn_get = $this->model_product->like_yn_get($data); // 좋아요 여부 확인

			$response->like_yn_get = !empty($like_yn_get->like_yn)?$like_yn_get->like_yn:'';
		} else {
			$response->like_yn_get = '';
		}

		$response->member_detail = $member_detail;
		$response->result = $result;
		$response->viewer = $result->viewer;
		$response->agent = $this->_user_agent();

		$this->_view2(mapping('product').'/view_product_detail', $response);
  }

	// 주소 등록
	public function product_detail_distance(){
		$product_idx = $this->_input_check("product_idx", array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$current_lat = $this->_input_check("current_lat", array());
		$current_lng = $this->_input_check("current_lng", array());

		$data['product_idx'] = $product_idx;
		$data['current_lat'] = $current_lat;
		$data['current_lng'] = $current_lng;

		$result = $this->model_product->product_detail_distance($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

			$response->distance = $result->distance;
		}
		echo json_encode($response);
		exit;
	}

	//메인 화면
	public function main_list_get(){
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$current_lat = $this->_input_check("current_lat",array("ternary"=>'37.5185682'));
		$current_lng = $this->_input_check("current_lng",array("ternary"=>'127.0230294'));
		$distance = $this->_input_check("distance",array("ternary"=>'6'));
		$search_tag = $this->_input_check("search_tag",array());

		$data['distance'] = $distance;
		$data['current_lat'] = $current_lat;
		$data['current_lng'] = $current_lng;
		$data['search_tag'] = $search_tag;

		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		$result_list = $this->model_product->product_list_get($data); // 상품 리스트 가져오기
		$result_list_count = $this->model_product->product_list_count($data); // 상품 리스트 카운트

		$response = new stdClass();

		$response->total_block = ceil($result_list_count/$page_size);
		$response->result_list = $result_list;

		$this->_ajax_view(mapping('product').'/view_main_list_get', $response);
	}

	//메인 화면
  public function product_reg(){

		$category_management_list = $this->model_product->category_management_list(); // 상품 리스트 카운트
		$member_location_list = $this->model_product->member_location_list(); // 상품 리스트 카운트

		if ($this->session->userdata("member_idx")) {
			$member_detail = $this->model_product->member_detail(); // 상품 리스트 카운트
			$my_location=$member_detail->member_location_idx;
		}else {
			$my_location='0';
		}

		$response = new stdClass();

		$response->my_location = $my_location;
		$response->member_detail = $member_detail;
		$response->member_location_list = $member_location_list;
		$response->category_management_list = $category_management_list;
		$response->agent = $this->_user_agent();

		$this->_view2(mapping('product').'/view_product_reg', $response);
  }


	// 주소 등록
	public function member_location_reg_in(){
		$member_addr = $this->_input_check("member_addr",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$member_lat = $this->_input_check("member_lat",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$member_lng = $this->_input_check("member_lng",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$title = $this->_input_check("product_location_title",array("empty_msg"=>lang("lang_product_00174","노출할 지역 이름을 지정해 주세요.")));
		$distance = $this->_input_check("distance",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['member_addr'] = $member_addr;
		$data['member_lat'] = $member_lat;
		$data['member_lng'] = $member_lng;
		$data['title'] = $title;
		$data['distance'] = $distance;

		$result = $this->model_product->member_location_reg_in($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		} else {
			$response->code = 1;
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

			$response->title 	= $title;
			$response->member_addr 	= $member_addr;
			$response->member_location_idx 	= $result;
		}
		echo json_encode($response);
		exit;
	}

	// 상품 수정
	public function product_reg_in(){
		$response = new stdClass();

		$category_management_idx = $this->_input_check("category_management_idx", array("empty_msg"=>lang("lang_product_00157","카테고리를 입력해주세요.")));
		$title = $this->_input_check("title", array("empty_msg"=>lang("lang_product_00158","제목을 입력해주세요.")));
		$free_product_yn = $this->_input_check("free_product_yn", array("ternary"=>"N"));
		if ($free_product_yn=='Y') {
			$product_price = 0;
		}else {
			$product_price = $this->_input_check("product_price", array("empty_msg"=>lang("lang_product_00159","가격을 입력해주세요.")));
		}
		$img_path = $this->_input_check("img_path[]", array());
		$contents = $this->_input_check("contents", array("empty_msg"=>lang("lang_product_00160","내용을 입력해주세요.")));
		$tags = $this->_input_check("tags", array("empty_msg"=>lang("lang_product_00161","태그를 입력해주세요.")));
		$member_location_idx = $this->_input_check("member_location_idx", array("empty_msg"=>lang("lang_product_00162","거래위치를 입력해주세요.")));

		$data['category_management_idx'] = $category_management_idx;
		$data['title'] = $title;
		$data['free_product_yn'] = $free_product_yn;
		$data['product_price'] = $product_price;
		$data['img_path'] = $this->global_function->array_to_str($img_path);
		$data['contents'] = $contents;
		$data['tags'] = $tags;
		$data['member_location_idx'] = $member_location_idx;

		// 게시글 등록 개수 체크
		$product_reg_check = $this->model_product->product_reg_check($data); // 상품 수정

		if ($product_reg_check==-1) {
			$response->code = "-1";
			$response->code_msg = lang("lang_product_00774","중고거래 게시글은 하루 한 사용자당 5개 까지 등록 가능합니다.");

			echo json_encode($response);
			exit;

		}elseif ($product_reg_check==-2) {
			$response->code = "-1";
			$response->code_msg = lang("lang_product_00775","중고거래 게시글은 한 사용자당 최대 60개 까지 등록 가능합니다.");

			echo json_encode($response);
			exit;
		}

		// 금지어 체크
		$forbidden_search_check="";
		$forbidden_search_list = $this->model_product->forbidden_search_list();
		foreach ($forbidden_search_list as $row) {
			if (strpos($title, $row->title)!==false) {
				$forbidden_search_check = $row->title;
			}
			if (strpos($tags, $row->title)!==false) {
				$forbidden_search_check = $row->title;
			}
			if (strpos($contents, $row->title)!==false) {
				$forbidden_search_check = $row->title;
			}
		}

		if ($forbidden_search_check!="") {
			$response->code = "-1";
			$response->code_msg = lang("lang_product_00163_0","차단된 단어 '").$forbidden_search_check.lang("lang_product_00163_1","'가 게시글 내에 포함되어 있습니다.");

			echo json_encode($response);
			exit;
		}

		$result = $this->model_product->product_reg_in($data); // 상품 수정

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

			//알람 101 :: 키워드 "키워드"에 대한 새로운 중고거래 글이 등록 되었습니다.
			$index="101";
			$alarm_data['keywords'] = $tags;
			$alarm_data['title'] = $title;
			$alarm_data['product_idx'] = $result;

			$this->_alarm_action(0,0,$index, $alarm_data);
		}

		echo json_encode($response);
		exit;
	}


	// 상품 수정 뷰
  public function product_mod(){
		$product_idx = $this->_input_check("product_idx", array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['product_idx'] = $product_idx;

		$result = $this->model_product->product_mod_detail($data); // 상품 상세정보
		$category_management_list = $this->model_product->category_management_list(); // 상품 리스트 카운트
		$member_location_list = $this->model_product->member_location_list(); // 상품 리스트 카운트

		if ($this->session->userdata("member_idx")) {
			$member_detail = $this->model_product->member_detail(); // 상품 리스트 카운트
			$my_location=$member_detail->member_location_idx;
		}else {
			$my_location='0';
		}

		$response = new stdClass();

		$response->my_location = $my_location;
		$response->member_detail = $member_detail;
		$response->member_location_list = $member_location_list;
		$response->category_management_list = $category_management_list;
		$response->result = $result;
		$response->agent = $this->_user_agent();

		$this->_view2(mapping('product').'/view_product_mod', $response);
  }

	// 상품 수정
	public function product_mod_up(){
		$product_idx = $this->_input_check("product_idx", array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$category_management_idx = $this->_input_check("category_management_idx", array("empty_msg"=>lang("lang_product_00157","카테고리를 입력해주세요.")));
		$title = $this->_input_check("title", array("empty_msg"=>lang("lang_product_00158","제목을 입력해주세요.")));
		$free_product_yn = $this->_input_check("free_product_yn", array("ternary"=>"N"));
		if ($free_product_yn=='Y') {
			$product_price = 0;
		}else {
			$product_price = $this->_input_check("product_price", array("empty_msg"=>lang("lang_product_00159","가격을 입력해주세요.")));
		}
		$img_path = $this->_input_check("img_path[]", array());
		$contents = $this->_input_check("contents", array("empty_msg"=>lang("lang_product_00160","내용을 입력해주세요.")));
		$tags = $this->_input_check("tags", array("empty_msg"=>lang("lang_product_00161","태그를 입력해주세요.")));
		$member_location_idx = $this->_input_check("member_location_idx", array("empty_msg"=>lang("lang_product_00162","거래위치를 입력해주세요.")));

		$data['category_management_idx'] = $category_management_idx;
		$data['title'] = $title;
		$data['free_product_yn'] = $free_product_yn;
		$data['product_price'] = $product_price;
		$data['img_path'] = $this->global_function->array_to_str($img_path);
		$data['contents'] = $contents;
		$data['tags'] = $tags;
		$data['member_location_idx'] = $member_location_idx;
		$data['product_idx'] = $product_idx;

		$result = $this->model_product->product_mod_up($data); // 상품 수정

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}

	// 상품 좋아요
	public function product_like_reg_in(){
		$product_idx =  $this->_input_check("product_idx",array());

		$data['product_idx'] = $product_idx;
		$data['member_idx'] = $this->member_idx;

		$response = new stdClass;

		if($this->member_idx == ""){
			$response->code = "0";
			$response->code_msg = lang("lang_dev_00001","키가 누락됐습니다.");

			echo json_encode($response);
			exit;
		}

		$result = $this->model_product->product_like_reg_in($data); // 좋아요/좋아요 취소
		$like_cnt = $this->model_product->product_like_cnt($data); // 좋아요 갯수
		$like_yn_get = $this->model_product->like_yn_get($data); // 좋아요 여부 확인

		if($result == "-1000") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

			$response->like_cnt = $like_cnt->like_cnt;
			$response->like_yn = $like_yn_get->like_yn;
		}

		echo json_encode($response);
		exit;
	}

	/* ========================= 예약 관련 프로세스 =========================

	<판매자 프로세스>
		-판매중(예약안됨)
		  -> 예약중으로 변경(예약구매자 선택)

		-예약중
		  -> 예약완료로 변경

		-예약완료

	<구매자 프로세스>
		-판매중(예약안됨)
		  -> 채팅방으로 이동

		-예약중
		  -> 예약 취소 알림 예약

		-예약완료

	========================= 예약 관련 프로세스 ========================= */


	//예약하기 & 채팅 중인 회원 목록 좌표가져오기
  public function reserve_reg(){
		$product_idx = $this->_input_check("product_idx", array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['product_idx'] = $product_idx;

		$result = $this->model_product->product_detail($data); // 상품 상세
		$result_list = $this->model_product->chatting_room_list($data); // 상품 상세

		$response = new stdClass();

		$response->result = $result;
		$response->result_list = $result_list;

		$this->_view2(mapping('product').'/view_reserve_reg', $response);
  }

	//예약 완료 화면
  public function complete_reg(){

		$product_idx = $this->_input_check("product_idx", array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['product_idx'] = $product_idx;

		$result = $this->model_product->product_detail($data); // 상품 상세

		$response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('product').'/view_complete_reg', $response);
  }

	// 예약중으로 변경
	public function product_state_mod_up_1(){
		$product_idx =  $this->_input_check("product_idx",array("empty_msg"=>"키가 누락되었습니다."));
		$product_member_idx =  $this->_input_check("product_member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));

		$data['product_idx'] = $product_idx;
		$data['product_member_idx'] = $product_member_idx;

		$result = $this->model_product->product_state_mod_up_1($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}

	// 예약완료로 변경
	public function product_state_mod_up_2(){
		$product_idx =  $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['product_idx'] = $product_idx;

		$result = $this->model_product->product_state_mod_up_2($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

			//알람 104 :: 거래가 종료 되었습니다. 판매자를 평가하여 주세요.
			$index="104";
			$check = $this->model_product->product_detail($data); // 상품 상세
			$member_idx = $check->product_member_idx;
			$alarm_data = array();

			$this->_alarm_action($member_idx,0,$index, $alarm_data);

			// 뱃지
			if ($check->free_product_yn!='Y') {
				// 득탬 성공 :: 최초 중고거래 구매 완료가 1회 이상.
				$data['badge_type'] = '0';
				$data['member_idx'] = $check->product_member_idx;
				$COM_badge_check = $this->model_common->COM_badge_check($data);

				// 거래하는 기쁨 :: 최초 중고거래 판매 완료가 1회 이상
				$data['badge_type'] = '1';
				$data['member_idx'] = $this->member_idx;
				$COM_badge_check = $this->model_common->COM_badge_check($data);

			}else {
				// 나눔의 시작 :: 나눔 횟수 완료가 1회 이상
				$data['badge_type'] = '2';
				$data['member_idx'] = $this->member_idx;
				$COM_badge_check = $this->model_common->COM_badge_check($data);
			}


		}

		echo json_encode($response);
		exit;
	}

	//예약 해제 하기
	public function product_state_mod_up_0(){
		$product_idx =  $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['product_idx'] = $product_idx;

		$result = $this->model_product->product_state_mod_up_0($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

			//알람 109 :: 알림 요청 하신 예약이 취소된 중고거래 글이 있습니다.
			$index="109";
			$check = $this->model_product->product_detail($data); // 상품 상세
			$alarm_data = array();

			$this->_alarm_action($check->reserve_member_idxs,0,$index, $alarm_data);
		}

		echo json_encode($response);
		exit;
	}

	public function chatting_room_reg_in(){
		header('Content-Type: application/json');
		$response = new stdClass();

		$product_idx =  $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$partner_member_idx =  $this->_input_check("partner_member_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['product_idx'] = $product_idx;
		$data['member_idx'] = $this->member_idx;
		$data['partner_member_idx'] = $partner_member_idx;

    $check =$this->model_product->chatting_room_check($data);
    if(count($check)>0){

			if($check->state==2){
				$response->code = "-1";
				$response->code_msg = lang("lang_dev_00000","상대방과의 채팅 시간이 종료되었습니다.");
				echo json_encode($response);
				exit;
			}else{
				$response->code = "2000";
				$response->code_msg = lang("lang_dev_00000","이미 채팅방이 오픈되었습니다.");
				$response->chatting_room_idx = (String)$check->chatting_room_idx;
				echo json_encode($response);
				exit;
			}

		}

		// 예약 중 무료나눔 거래의 완료 여부 확인
		$check1 = $this->model_product->free_product_state_check();
		if($check1>0){

			$response->code = "-1";
			$response->code_msg = lang("lang_product_00207","무료나눔이 예약은 1건만 가능 합니다.");

			echo json_encode($response);
			exit;
		}

		// 완료된 무료나눔 거래의 평가 등록 확인
		$check2 = $this->model_product->free_product_review_check();
		if($check2>0){

			$response->code = "-1";
			$response->code_msg = lang("lang_product_00208","그 전에 나눔에서 피드백을 작성하지 않았어요!");

			echo json_encode($response);
			exit;
		}

		$result = $this->model_product->chatting_room_reg_in($data);

		if($result == -1){
			$response->code = "-1";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{

			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
			$response->chatting_room_idx = (String)$result;
		}
		echo json_encode($response);
		exit;
	}

	// 예약된 글 취소 알림 등록
	public function reserve_reg_in(){
		$product_idx =  $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));
		$member_idx =  $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));

		$data['product_idx'] = $product_idx;
		$data['member_idx'] = $member_idx;

		$reserve_member_idxs = $this->model_product->reserve_member_idxs_get($data); // 예약 취소 알림 등록 회원 목록

		$data['reserve_member_idxs'] = $reserve_member_idxs->reserve_member_idxs;

		$this->dup_check($data); // 중복등록 확인
		$data['new_reserve_member_idxs'] = $this->add_arr($data);   // 예약 취소 알림 등록 회원 목록에 회원 키 추가

		$result = $this->model_product->reserve_reg_in($data); // 예약된 글 취소 알림 등록
		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;

	}

	// 중복등록 확인
	private function dup_check($data){
		$member_idx = $data['member_idx'];
		$reserve_member_idxs = $data['reserve_member_idxs'];

		if($reserve_member_idxs != ""){
			$reserve_member_idxs_arr = explode(",",$reserve_member_idxs);

			$res = 0;

			foreach($reserve_member_idxs_arr as $row){
				if($row == $member_idx){
					$res = 1;
				}
			}

			$response = new stdClass();

			if($res == "1") {
				$response->code = "-1";
				$response->code_msg = lang("lang_product_00776","이미 취소 알림 등록이 되어있습니다.");

				echo json_encode($response);
				exit;
			}

		}

	}

	// 예약 취소 알림 등록 회원 목록에 회원 키 추가
	private function add_arr($data){
		$res = "";

		if($data['reserve_member_idxs'] == ""){
			$res = $data['member_idx'];
		} else {
			$res = $data['member_idx'].','.$data['reserve_member_idxs'];
		}

		return $res;
	}

	// 예약 해제하기
	public function reserve_cancel(){
		$product_idx =  $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다.")));

		$data['product_idx'] = $product_idx;

		$response = new stdClass;

		$result = $this->model_product->reserve_cancel($data); // 예약 해제하기


		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

			//알람 109 :: 알림 요청 하신 예약이 취소된 중고거래 글이 있습니다.
			$index="109";
			$result = $this->model_product->reserve_member_idxs_get($data); // 예약 취소 알림 등록 회원 목록
			$member_idxs = !empty($result->reserve_member_idxs)?$result->reserve_member_idxs:0;
			$alarm_data['product_idx'] = $product_idx;

			$this->_alarm_action($member_idxs,0,$index, $alarm_data);
		}

		echo json_encode($response);
		exit;
	}





	// 상품 신고
	public function product_report(){
		$product_idx =  $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다.")));
		$report_type =  $this->_input_check("report_type",array("empty_msg"=>lang("lang_product_00777","신고 유형이 누락되었습니다.")));
		$report_contents =  $this->_input_check("report_contents",array("empty_msg"=>lang("lang_product_00778","신고 내용이 누락되었습니다.")));

		$data['product_idx'] = $product_idx;
		$data['report_type'] = $report_type;
		$data['report_contents'] = $report_contents;
		$data['member_idx'] = $this->member_idx;

		$response = new stdClass;

		if($this->member_idx == ""){
			$response->code = "0";
			$response->code_msg = lang("lang_dev_00001","키가 누락되었습니다.");

			echo json_encode($response);
			exit;
		}

		$result = $this->model_product->product_report($data); // 상품 신고

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}

	// 상품 삭제
	public function product_del(){
		$product_idx =  $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다.")));

		$data['product_idx'] = $product_idx;

		$result = $this->model_product->product_del($data); // 상품 삭제

		$response = new stdClass;

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}

	// 무료 끌어올리기
	public function free_list_up(){
		$product_idx =  $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다.")));

		$data['product_idx'] = $product_idx;

		$list_up_info = $this->model_product->list_up_info_get($data); // 끌어 올리기 정보 가져오기

		$list_up_cnt = $list_up_info->list_up_cnt;

		if($list_up_cnt >= 15){
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = lang("lang_product_00222","한 게시글에 끌어올리기는 최대 15번까지만 가능합니다.");

			echo json_encode($response);
			exit;
		}

		$now = strtotime(date('Y-m-d H:i:s'));
		$target_date = strtotime($list_up_info->free_list_up_date);
		$diff = $now - $target_date;
		
		if($diff <= 60*60*24*3){
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = lang("lang_product_00218","무료 끌어올리기는 3일에 1회 입니다.");

			echo json_encode($response);
			exit;
		}

		$ins_date = strtotime($list_up_info->ins_date);
		$diff2 = $now - $ins_date;
		
		if($diff2 <= 60*60*24){
		
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = lang("lang_dev_00000","글이 등록된 후 24시간이 지난 후에 끌어 올리기가 가능합니다.");

			echo json_encode($response);
			exit;
		}

		$result = $this->model_product->free_list_up($data); // 무료 끌어올리기

		$response = new stdClass;

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}

	// 포인트 체크
	public function point_check(){
		$data['member_idx'] = $this->member_idx;

		$result = $this->model_product->point_check($data); // 포인트 체크

		if($result->member_point < 1000){
			$response = new stdClass;

			$response->code = "-1";
			$response->code_msg = lang("lang_product_00219_0","현재 내가 보유한 포인트 [ ").$result->member_point.lang("lang_product_00219_1"," ] P 입니다.\n끌어올리기를 하기 위해서는 1,000 포인트가 필요합니다.");

			echo json_encode($response);
			exit;
		}
	}

	// 포인트 끌어올리기
	public function list_up(){
		$product_idx =  $this->_input_check("product_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다.")));

		$data['product_idx'] = $product_idx;

		$this->point_check();

		$list_up_info = $this->model_product->list_up_info_get($data); // 끌어 올리기 정보 가져오기

		$list_up_cnt = $list_up_info->list_up_cnt;

		if($list_up_cnt >= 6){
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = lang("lang_product_00222","한 게시글에 끌어올리기는 최대 6번까지만 가능합니다.");

			echo json_encode($response);
			exit;
		}

		$now = strtotime(date('Y-m-d H:i:s'));
		$ins_date = strtotime($list_up_info->ins_date);
		$diff2 = $now - $ins_date;
		
		if($diff2 <= 60*60*24){
		
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = lang("lang_dev_00000","글이 등록된 후 24시간이 지난 후에 끌어 올리기가 가능합니다.");

			echo json_encode($response);
			exit;
		}

		$response = new stdClass;

		$result = $this->model_product->list_up($data); // 포인트 끌어올리기

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}



	// 위치 삭제
	public function member_location_del(){
		$member_location_idx =  $this->_input_check("member_location_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다.")));

		$data['member_location_idx'] = $member_location_idx;

		$response = new stdClass;

		$result = $this->model_product->member_location_del($data); // 위치 삭제

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}

	// 거래위치 목록 가져오기
	public function location_list_get(){

		$result_list = $this->model_product->location_list_get(); // 거래위치 목록 가져오기

		$response = new stdClass();

		$response->result_list = $result_list;

		$this->_ajax_view(mapping('product').'/view_location_list_get', $response);
	}
}// 클래스의 끝
?>

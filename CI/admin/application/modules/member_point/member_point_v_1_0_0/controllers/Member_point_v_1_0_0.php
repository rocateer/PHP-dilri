<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-20
| Memo :  포인트 관리
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

class Member_point_v_1_0_0 extends MY_Controller{

	// 생성자 영역
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('member_point').'/model_member_point');
	}

	// Index 
	public function index(){
		$this->member_point_list();
	}

	// 포인트 관리 리스트 뷰
	public function member_point_list(){

		$response = new stdClass();

		$this->_view(mapping('member_point').'/view_member_point_list', $response);
	}

	// 포인트 관리 리스트
	public function member_point_list_get(){
		$member_id = $this->_input_check("member_id",array());
		$member_name = $this->_input_check("member_name",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$point_type = $this->_input_check("point_type",array());
		$history_data = $this->_input_check("history_data",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['member_id'] = $member_id;
		$data['member_name'] = $member_name;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['point_type'] = $point_type;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_member_point->member_point_list($data); // 포인트 관리 리스트
		$result_list_count = $this->model_member_point->member_point_list_count($data); // 포인트 관리 리스트 카운트
		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->page_num = $page_num;
		$response->history_data = $history_data;

		$this->_list_view(mapping('member_point').'/view_member_point_list_get', $response);
	}

	// 포인트 지급/차감 뷰
	public function member_point_reg(){
    $point_type = $this->_input_check("point_type",array());
		$result_list = $this->model_member_point->member_list();

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->point_type = $point_type;

		$this->_popup_view(mapping('member_point').'/view_member_point_reg', $response);
	}

	// 포인트 지급/차감
	public function member_point_reg_in(){

		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원을 선택해주세요","focus_id" =>"member_idx"));
		$point = $this->_input_check("point",array("empty_msg"=>"포인트 개수를 입력해주세요.","focus_id" =>"point"));
		$point_type = $this->_input_check("point_type",array("empty_msg"=>"차감/지급 타입이 누락되었습니다.","focus_id" =>"point_type"));
		$memo = $this->_input_check("memo",array());

		$data['member_idx'] = $member_idx;
		$data['memo'] = $memo;
		$data['point_type'] = $point_type;
		$data['point'] = $point;

		if ($member_idx==0) {
			$result = $this->model_member_point->total_member_point_reg_in($data); // 포인트 단체 지급/차감
		}else {
			$result = $this->model_member_point->member_point_reg_in($data); // 포인트 지급/차감
		}

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "등록 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code = 1;
			$response->code_msg = "등록 성공하였습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 그룹 포인트 지급/차감 화면
	public function group_member_point_reg(){
    $member_idxs = $this->_input_check("member_idxs",array("ternary" => "0"));
    $point_type = $this->_input_check("point_type",array());
		
		// $data['member_idxs'] = $member_idxs;

		// $result_list = $this->model_member_point->group_member_list($data);

		$response = new stdClass();

		// $response->result_list = $result_list;
		$response->point_type = $point_type;

		$this->_popup_view(mapping('member_point').'/view_group_member_point_reg', $response);
	}

	// 회원 리스트
	public function member_list_get(){
		$member_id = $this->_input_check("member_id",array());
		$member_name = $this->_input_check("member_name",array());
		$del_yn = $this->_input_check("del_yn",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$s_member_point = $this->_input_check("s_member_point",array());
		$e_member_point = $this->_input_check("e_member_point",array());

		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;
		
		$data['member_id'] = $member_id;
		$data['member_name'] = $member_name;
		$data['del_yn'] = $del_yn;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['s_member_point'] = $s_member_point;
		$data['e_member_point'] = $e_member_point;
		
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_member_point->group_member_list($data); // 회원 리스트
		$result_list_count = $this->model_member_point->group_member_list_count($data); // 회원 리스트 카운트
		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = !empty($result_list_count)?$result_list_count:0;
		$response->no = $no;
		$response->paging = $paging;
		$response->page_num = $page_num;

		$this->_list_view(mapping('member_point').'/view_member_list_get', $response);
	}

	// 그룹 포인트 지급/차감
	public function group_member_point_reg_in(){

		$member_idxs = $this->_input_check("member_idxs",array("empty_msg"=>"회원을 선택해주세요","focus_id" =>"member_idxs"));
		$point = $this->_input_check("point",array("empty_msg"=>"포인트 개수를 입력해주세요.","focus_id" =>"point"));
		$point_type = $this->_input_check("point_type",array("empty_msg"=>"차감/지급 타입이 누락되었습니다.","focus_id" =>"point_type"));
		$memo = $this->_input_check("memo",array());

		$data['member_idxs'] = $member_idxs;
		$data['memo'] = $memo;
		$data['point_type'] = $point_type;
		$data['point'] = $point;

		$result = $this->model_member_point->group_member_point_reg_in($data); // 포인트 단체 지급/차감

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "등록 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code = 1;
			$response->code_msg = "등록 성공하였습니다.";
		}
		echo json_encode($response);
		exit;
	}

}

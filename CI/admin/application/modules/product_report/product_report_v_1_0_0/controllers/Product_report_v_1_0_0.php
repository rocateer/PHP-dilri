<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-15
| Memo : 상품 신고 관리
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

class Product_report_v_1_0_0 extends MY_Controller{

	// 생성자 영역 
	function __construct(){
		parent::__construct();
		$this->load->model(mapping('product_report').'/model_product_report');
	}

	// Index 
	public function index(){
		$this->product_report_list();
	}

	// 신고관리 리스트
	public function product_report_list(){
		$this->_view(mapping('product_report').'/view_product_report_list');
	}

	// 신고관리 리스트 가져오기
	public function product_report_list_get(){

		$member_name = $this->_input_check("member_name",array());
		$member_id = $this->_input_check("member_id",array());
		$reported_member_name = $this->_input_check("reported_member_name",array());
		$reported_member_id = $this->_input_check("reported_member_id",array());
		$report_type = $this->_input_check("report_type",array());
		$display_yn = $this->_input_check("display_yn",array());
		$history_data = $this->_input_check("history_data",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['member_name'] = $member_name;
		$data['member_id'] = $member_id;
		$data['reported_member_name'] = $reported_member_name;
		$data['reported_member_id'] = $reported_member_id;
		$data['report_type'] = $report_type;
		$data['display_yn'] = $display_yn;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_product_report->product_report_list($data);
		$result_list_count = $this->model_product_report->product_report_list_count($data);

		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->page_num = $page_num;
		$response->history_data = $history_data;

		$this->_list_view(mapping('product_report').'/view_product_report_list_get', $response);
	}
}

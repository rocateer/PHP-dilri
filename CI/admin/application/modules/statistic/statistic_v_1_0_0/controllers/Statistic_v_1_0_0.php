<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-20
| Memo : 통계
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

class Statistic_v_1_0_0 extends MY_Controller{
	
	// 생성자
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('statistic').'/model_statistic');
	}

  // index
	public function index(){
		$this->statistic();
	}
	
	// 통계 페이지
	public function statistic(){
		$history_data = $this->_input_check("history_data",array());

		$response = new stdClass();

		$response->history_data = $history_data;
			
		$this->_view(mapping('statistic').'/view_statistic',$response);
	}
	
	// 검색어 통계
	public function search_list_get(){
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;
		$history_data = $this->_input_check("history_data",array());
		
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;
		
		$result_list = $this->model_statistic->search_list($data); // 검색어 통계 리스트
		$result_list_count = $this->model_statistic->search_list_count($data); // 검색어 통계 리스트
		
		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num, 'search_list_get');
		
		$response = new stdClass();
		
		$response->result_list = $result_list;
		$response->no = $no;
		$response->paging = $paging;
		
		$this->_list_view(mapping('statistic').'/view_search_list_get',$response);
	}
	
	// 카테고리 통계
	public function category_list_get(){
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;
		$history_data = $this->_input_check("history_data",array());
		
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;
		
		$result_list = $this->model_statistic->category_list($data); // 검색어 통계 리스트
		$result_list_count = $this->model_statistic->category_list_count($data); // 검색어 통계 리스트
		
		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num, 'category_list_get');
		
		$response = new stdClass();
		
		$response->result_list = $result_list;
		$response->no = $no;
		$response->paging = $paging;
		
		$this->_list_view(mapping('statistic').'/view_category_list_get',$response);
	}

}	// 클래스의 끝

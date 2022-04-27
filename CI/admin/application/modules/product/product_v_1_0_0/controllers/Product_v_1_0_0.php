<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-15
| Memo : 커뮤니티 관리
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

class Product_v_1_0_0 extends MY_Controller{

	// 생성자 영역
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('product').'/model_product');
	}

	// Index
	public function index(){
		$this->product_list();
	}

	// 커뮤니티 리스트
	public function product_list(){
		$product_type = $this->_input_check("product_type",array());

		$data['product_type'] = $product_type;

		$response = new stdClass();

		$response->product_type = $product_type;

		$this->_view(mapping('product').'/view_product_list', $response);
	}

	// 커뮤니티 리스트 가져오기
	public function product_list_get(){

		$member_id = $this->_input_check("member_id",array());
		$member_name = $this->_input_check("member_name",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$title = $this->_input_check("title",array());
		$category_name = $this->_input_check("category_name",array());
		$tags = $this->_input_check("tags",array());
		$product_state = $this->_input_check("product_state",array());
		$display_yn = $this->_input_check("display_yn",array());
		$free_product_yn = $this->_input_check("free_product_yn",array());
		$famous_product_yn = $this->_input_check("famous_product_yn",array());
		$history_data = $this->_input_check("history_data",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['member_id'] = $member_id;
		$data['member_name'] = $member_name;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['title'] = $title;
		$data['category_name'] = $category_name;
		$data['tags'] = $tags;
		$data['product_state'] = $product_state;
		$data['display_yn'] = $display_yn;
		$data['free_product_yn'] = $free_product_yn;
		$data['famous_product_yn'] = $famous_product_yn;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;
		
		$result_list = $this->model_product->product_list($data);
		$result_list_count = $this->model_product->product_list_count($data);

		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->page_num = $page_num;
		$response->history_data = $history_data;

		$this->_list_view(mapping('product').'/view_product_list_get', $response);
	}
	
	public function product_list_excel(){
		$member_id = $this->_input_check("member_id",array());
		$member_name = $this->_input_check("member_name",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$title = $this->_input_check("title",array());
		$category_name = $this->_input_check("category_name",array());
		$tags = $this->_input_check("tags",array());
		$product_state = $this->_input_check("product_state",array());
		$display_yn = $this->_input_check("display_yn",array());
		$free_product_yn = $this->_input_check("free_product_yn",array());
		$famous_product_yn = $this->_input_check("famous_product_yn",array());

		$data['member_id'] = $member_id;
		$data['member_name'] = $member_name;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['title'] = $title;
		$data['category_name'] = $category_name;
		$data['tags'] = $tags;
		$data['product_state'] = $product_state;
		$data['display_yn'] = $display_yn;
		$data['free_product_yn'] = $free_product_yn;
		$data['famous_product_yn'] = $famous_product_yn;

		$result_list=$this->model_product->product_list_excel($data); //리스트

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->no = count($result_list);

		$this->_list_view(mapping('product').'/view_product_list_excel',$response);
	}

	// 커뮤니티 상세
	public function product_detail(){
		$product_idx = $this->_input_check("product_idx",array("empty_msg"=>"공지사항 키가 누락되었습니다."));
		$history_data = $this->_input_check("history_data",array());

		$data['product_idx'] = $product_idx;

		$result = $this->model_product->product_detail($data);

		$response = new stdClass();

		$response->result = $result;
		$response->history_data = $history_data;

		$this->_view(mapping('product').'/view_product_detail',$response);
	}
	
	// 노출여부 상태 변경
	public function famous_product_yn_mod_up(){
		$product_idx = $this->_input_check("product_idx",array());
		$famous_product_yn = $this->_input_check("famous_product_yn",array());

		$data['product_idx']  = $product_idx;
		$data['famous_product_yn'] = $famous_product_yn;

		// 인기노출상품 10개 이내 여부 체크
		$response = new stdClass();

		if ($famous_product_yn=='Y') {
			$famous_product_yn_cnt = $this->model_product->famous_product_yn_cnt();
			if ($famous_product_yn_cnt>=10) {
				$response->code = '-1';
				$response->code_msg = "인기상품은 최대 10개까지 지정 가능 합니다. 인기상품으로 지정된 항목을 해제 후 다시 지정하여 주세요.";
				
				echo json_encode($response);
				exit;
			}
		}
		
		$result = $this->model_product->famous_product_yn_mod_up($data);


		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "상태변경 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code = 1;
			$response->code_msg 	= "상태변경 성공하였습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 커뮤니티 상태변경
	public function product_display_yn_mod_up(){
		$product_idx = $this->_input_check("product_idx",array());
		$display_yn = $this->_input_check("display_yn",array());

		$data['product_idx']  = $product_idx;
		$data['display_yn'] = $display_yn;

		$result = $this->model_product->product_display_yn_mod_up($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "상태변경 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else  {
			$response->code = 1;
			$response->code_msg 	= "상태변경 성공하였습니다.";
		
			if ($display_yn == 'N') {
				$result = $this->model_product->product_detail($data);

				$index="113";
				$alarm_data['product_idx'] = $product_idx;

				$this->_alarm_action($result->member_idx,0,$index, $alarm_data);
			}
		
		}
		echo json_encode($response);
		exit;
	}

}

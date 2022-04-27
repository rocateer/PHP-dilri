<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-10-26
| Memo : 검색
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

class Search_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		// if(!$this->session->userdata("member_idx") ){
		// 	redirect("/".mapping('login')."?return_url=/".mapping('search'));
		// 	exit;
		// }
		
		// model_search 이름으로 공통 사용
		$this->load->model(mapping('search').'/model_search');
		$this->load->model('common/model_common');
	}

	//인덱스
  public function index() {
    $this->search_list();
  }

	//메인 화면
  public function search_list(){

		$member_detail = $this->model_search->member_detail(); // 상품 리스트 카운트
		
		$data['current_lat'] = 37.5185682;
		$data['current_lng'] = 127.0230294;
		
		$data['type'] = '0';
		$recommend_search_list_0 = $this->model_search->recommend_search_list($data);
		$data['type'] = '1';
		$recommend_search_list_1 = $this->model_search->recommend_search_list($data);
		
		$famous_product_list = $this->model_search->famous_product_list($data);
		$recent_search_list = $this->model_search->recent_search_list();
		$category_management_list = $this->model_search->category_management_list();
		
		$response = new stdClass();
		
		$response->recommend_search_list_0 = $recommend_search_list_0;
		$response->recommend_search_list_1 = $recommend_search_list_1;
		$response->famous_product_list = $famous_product_list;
		$response->recent_search_list = $recent_search_list;
		$response->category_management_list = $category_management_list;
		
		$this->_view(mapping('search').'/view_search_list', $response);
  }

	public function recent_search_list(){

		$recent_search_list = $this->model_search->recent_search_list();
		
		$response = new stdClass();
	
		$response->recent_search_list = $recent_search_list;
		
		$this->_view(mapping('search').'/view_search_list_get', $response);
  }

  public function famous_product_list(){

		
		$current_lat = $this->_input_check("current_lat",array("ternary"=>'37.5185682'));
		$current_lng = $this->_input_check("current_lng",array("ternary"=>'127.0230294'));
		
		$data['current_lat'] = $current_lat;
		$data['current_lng'] = $current_lng;
	
		$result_list = $this->model_search->famous_product_list($data);
		
		$response = new stdClass();
		
		$response->result_list = $result_list;
		
		$this->_ajax_view(mapping('search').'/view_famous_product_list_get', $response);
  }
	
	// 최근 검색어 삭제
	public function search_del(){
		$search_idx = $this->_input_check("search_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['search_idx'] = $search_idx;

		$result = $this->model_search->search_del($data);

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

	// 최근 검색어 등록
	public function search_reg_in(){
		$search_text = $this->_input_check("search_text",array());
		$search_type = $this->_input_check("search_type",array());

		$data['search_text'] = $search_text;
		$data['search_type'] = '0';

		$result = $this->model_search->search_reg_in($data);

		// if($result == "0") {
		// 	$response->code = 0;
		// 	$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		// } else {
		// 	$response->code = 1;
		// 	$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		// 	$response->search_idx = $result;

		// }
		// echo json_encode($response);
		// exit;

		$result_list = $this->model_search->recent_search_list();
		
		$response = new stdClass();
	
		$response->result_list = $result_list;
		
		$this->_ajax_view(mapping('search').'/view_search_list_get', $response);
	}
	
	// 최근 검색어 삭제
	public function search_del_all(){

		$result = $this->model_search->search_del_all();

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
	
	// order_list_get
	public function board_list_get(){

		$tab_type = $this->_input_check("tab_type",array());
		$search_text = $this->_input_check("search_text",array());
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;
		$data['search_text'] = $search_text;
		$data['type'] = '0';

		$result_list = $this->model_search->board_list($data);
		$result_list_count = $this->model_search->board_list_count($data);
		// if (!empty($search_text)) {
		// 	$this->model_search->search_reg_in($data);
		// }

		$response = new stdClass();

		$response->tab_type = $tab_type;
		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);

		$this->_ajax_view(mapping('search').'/view_community_list_get', $response);
	}
	
	
	//메인 화면
	public function product_list_get(){
		$type = $this->_input_check("type",array());
		$tab_type = $this->_input_check("tab_type",array());
		$search_text = $this->_input_check("search_text",array());
		$category_management_idx = $this->_input_check("category_management_idx",array());
		$s_product_price = $this->_input_check("s_product_price",array());
		$e_product_price = $this->_input_check("e_product_price",array());
		$free_product_yn = $this->_input_check("free_product_yn",array());
		$limit_distance = $this->_input_check("limit_distance",array());
		$current_lat = $this->_input_check("current_lat",array());
		$current_lng = $this->_input_check("current_lng",array());
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;
		$data['search_text'] = $search_text;
		$data['category_management_idx'] = $category_management_idx;
		$data['s_product_price'] = $s_product_price;
		$data['e_product_price'] = $e_product_price;
		$data['free_product_yn'] = $free_product_yn;
		$data['limit_distance'] = $limit_distance;
		$data['current_lat'] = $current_lat;
		$data['current_lng'] = $current_lng;
		$data['type'] = $type;
		
		$result_list = $this->model_search->product_list_get($data); // 상품 리스트 가져오기
		$result_list_count = $this->model_search->product_list_count($data); // 상품 리스트 카운트
		// if (!empty($search_text) && $type=='0') {
		// 	$this->model_search->search_reg_in($data);
		// }

		$response = new stdClass();
		
		$response->total_block = ceil($result_list_count/$page_size);
		$response->result_list = $result_list;	
		$response->tab_type = $tab_type;	
		
		$this->_ajax_view(mapping('search').'/view_product_list_get', $response);
	}
	

	//메인 화면
  public function search_comm_list(){
		$this->_view(mapping('search').'/view_search_comm_list');
  }

	//7_4/카테고리 선택시_검색 결과
  public function category_result(){
		
		$search_text = $this->_input_check("search_text",array());
		$category_management_idx = $this->_input_check("category_management_idx",array());
		
		$data['search_text'] = $search_text;
		$data['search_type'] = '1';
		
		$this->model_search->search_reg_in($data);
		
		$response = new stdClass();
		
		$response->category_management_idx = $category_management_idx;	
		$response->search_text = $search_text;	
		$response->type = '1';	
		
		$this->_view2(mapping('search').'/view_category_result', $response);
  }
	
	

	//
  public function searching(){
		$this->_view2(mapping('search').'/view_searching');
  }

	//
  public function search_result(){
		$this->_view(mapping('search').'/view_search_result');
  }
}// 클래스의 끝
?>

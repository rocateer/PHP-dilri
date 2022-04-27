<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인	
| Create-Date : 2021-11-15
| Memo :  회원 관리
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

class Member_v_1_0_0 extends MY_Controller{

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('member').'/model_member');
	}

	/* Index */
	public function index(){
		$this->member_list();
	}

	// 회원 리스트 뷰
	public function member_list(){

		$response = new stdClass();

		$this->_view(mapping('member').'/view_member_list', $response);
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
		$s_product_cnt = $this->_input_check("s_product_cnt",array());
		$e_product_cnt = $this->_input_check("e_product_cnt",array());
		$s_free_product_cnt = $this->_input_check("s_free_product_cnt",array());
		$e_free_product_cnt = $this->_input_check("e_free_product_cnt",array());
		$s_good_product_cnt = $this->_input_check("s_good_product_cnt",array());
		$e_good_product_cnt = $this->_input_check("e_good_product_cnt",array());
		$s_bad_product_cnt = $this->_input_check("s_bad_product_cnt",array());
		$e_bad_product_cnt = $this->_input_check("e_bad_product_cnt",array());
		$orderby = $this->_input_check("orderby",array());
		$history_data = $this->_input_check("history_data",array());
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;
		
		$data['member_id'] = $member_id;
		$data['member_name'] = $member_name;
		$data['del_yn'] = $del_yn;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['s_member_point'] = $s_member_point;
		$data['e_member_point'] = $e_member_point;
		$data['s_product_cnt'] = $s_product_cnt;
		$data['e_product_cnt'] = $e_product_cnt;
		$data['s_free_product_cnt'] = $s_free_product_cnt;
		$data['e_free_product_cnt'] = $e_free_product_cnt;
		$data['s_good_product_cnt'] = $s_good_product_cnt;
		$data['e_good_product_cnt'] = $e_good_product_cnt;
		$data['s_bad_product_cnt'] = $s_bad_product_cnt;
		$data['e_bad_product_cnt'] = $e_bad_product_cnt;
		$data['orderby'] = $orderby;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_member->member_list($data); // 회원 리스트
		$result_list_count = $this->model_member->member_list_count($data); // 회원 리스트 카운트
		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = !empty($result_list_count)?$result_list_count:0;
		$response->no = $no;
		$response->paging = $paging;
		$response->page_num = $page_num;
		$response->history_data = $history_data;

		$this->_list_view(mapping('member').'/view_member_list_get', $response);
	}
	
	// 회원 리스트 엑셀 다운로드
	public function member_list_excel(){
		$member_id = $this->_input_check("member_id",array());
		$member_name = $this->_input_check("member_name",array());
		$del_yn = $this->_input_check("del_yn",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$s_member_point = $this->_input_check("s_member_point",array());
		$e_member_point = $this->_input_check("e_member_point",array());
		$s_product_cnt = $this->_input_check("s_product_cnt",array());
		$e_product_cnt = $this->_input_check("e_product_cnt",array());
		$s_free_product_cnt = $this->_input_check("s_free_product_cnt",array());
		$e_free_product_cnt = $this->_input_check("e_free_product_cnt",array());
		$s_good_product_cnt = $this->_input_check("s_good_product_cnt",array());
		$e_good_product_cnt = $this->_input_check("e_good_product_cnt",array());
		$s_bad_product_cnt = $this->_input_check("s_bad_product_cnt",array());
		$e_bad_product_cnt = $this->_input_check("e_bad_product_cnt",array());
		$orderby = $this->_input_check("orderby",array());
		
		$data['member_id'] = $member_id;
		$data['member_name'] = $member_name;
		$data['del_yn'] = $del_yn;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['s_member_point'] = $s_member_point;
		$data['e_member_point'] = $e_member_point;
		$data['s_product_cnt'] = $s_product_cnt;
		$data['e_product_cnt'] = $e_product_cnt;
		$data['s_free_product_cnt'] = $s_free_product_cnt;
		$data['e_free_product_cnt'] = $e_free_product_cnt;
		$data['s_good_product_cnt'] = $s_good_product_cnt;
		$data['e_good_product_cnt'] = $e_good_product_cnt;
		$data['s_bad_product_cnt'] = $s_bad_product_cnt;
		$data['e_bad_product_cnt'] = $e_bad_product_cnt;
		$data['orderby'] = $orderby;

		$result_list = $this->model_member->member_list_excel($data); // 회원 리스트
		$no = COUNT($result_list);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->no = $no;

		$this->_list_view(mapping('member').'/view_member_list_excel', $response);
	}
	
	// 회원 상세
	public function member_detail(){
		$member_idx = $this->_input_check("member_idx",array());
		$history_data = $this->_input_check("history_data",array());

		$data['member_idx'] = $member_idx;

		$result = $this->model_member->member_detail($data); // 회원 상세보기

		if($member_idx == '' || COUNT($result) == 0){
			redirect("/".mapping('member'));
		}else{
			$response = new stdClass();

			$response->result = $result;
			$response->history_data = $history_data;

			$this->_view(mapping('member').'/view_member_detail',$response);
		}
	}
	
	// 메모 수정
	public function memo_mod_up(){
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다"));
		$memo = $this->_input_check("memo",array());
		
		$data['member_idx'] = $member_idx;
		$data['memo'] = $memo;
		
		$result = $this->model_member->memo_mod_up($data); // 메모 수정
		
		$response = new stdClass();
		
		if($result != '0'){
			$response->code = '1';
			$response->code_msg = "저장되었습니다.";
		} else {
			$response->code = '-1';
			$response->code_msg = "저장에 실패하였습니다.";
		}
		
		echo json_encode($response);
		exit;
	}
	
	// 회원 상태 변경
	public function member_state_mod_up(){
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"셀럽 키가 누락되었습니다."));
		$del_yn = $this->_input_check("del_yn",array("empty_msg"=>"상태 키가 누락되었습니다."));
		
		$data['member_idx'] = $member_idx;

		$response = new stdClass();

		if($del_yn == 'Y'){
			$response->code = '-1';
			$response->code_msg = '탈퇴한 계정 입니다.';

			echo json_encode($response);
			exit;
		}

		$data['del_yn'] = $del_yn == 'N' ? $del_yn = 'P' : $del_yn = 'N';

		$result = $this->model_member->member_state_mod_up($data);

		if($result == '0'){
			$response->code = '-1';
			$response->code_msg = '이용정지 실패. 다시 한번 시도 해주세요.';
		} else {
			$response->code = '1';
			$response->code_msg = '이용정지 성공';
		}

		echo json_encode($response);
		exit;
	}
	

}

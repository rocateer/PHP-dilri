<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	심정민
| Create-Date : 2021-10-22
| Memo : 1:1 문의
|------------------------------------------------------------------------
*/

class Qa_v_1_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

	  $this->load->model(mapping('qa').'/model_qa');
  }

  // 인덱스
	public function index(){

		$this->qa_list();
	}

  // 1:1 질문 리스트
	public function qa_list(){

		$this->_view2(mapping('qa').'/view_qa_list');
	}

  // 1:1 질문 리스트 가져오기
	public function qa_list_get(){

    $page_num = $this->_input_check("page_num",array());
    $page_size = PAGESIZE;

    $data['member_idx'] = $this->member_idx;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_qa->qa_list($data); // 1:1 질문 리스트 가져오기
		$result_list_count = $this->model_qa->qa_list_count($data); // 1:1 질문 개수 가져오기

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);

		$this->_list_view(mapping('qa').'/view_qa_list_get', $response);
	}

  // 1:1 질문 상세보기
	public function qa_detail(){
		$qa_idx = $this->_input_check("qa_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

    $data['qa_idx'] = $qa_idx;

    $result = $this->model_qa->qa_detail($data);

    if(empty($result) || COUNT($result) == 0){
      redirect("/".mapping('qa'));
    }else{
      $response = new stdClass();

      $response->result = $result;

			$this->_view2(mapping('qa').'/view_qa_detail', $response);
    }
	}

	// 1:1 질문 등록
	public function qa_reg(){
		$this->_view2(mapping('qa').'/view_qa_reg');
	}

	// 1:1 질문 등록하기
  public function qa_reg_in(){
    $qa_type = $this->_input_check("qa_type",array("empty_msg"=>lang("lang_qa_00818","문의유형을 선택해주세요."),"focus_id"=>"qa_type"));
		$qa_title = $this->_input_check("qa_title",array("empty_msg"=>lang("lang_qa_00731","제목을 입력 하세요."),"focus_id"=>"qa_title"));
		$qa_contents = $this->_input_check("qa_contents",array("empty_msg"=>lang("lang_qa_00733","내용을 입력 하세요."),"focus_id"=>"qa_contents"));

    $data['member_idx'] = $this->member_idx;
    $data['qa_type'] = $qa_type;
		$data['qa_title'] = $qa_title;
		$data['qa_contents'] = $qa_contents;

		$result = $this->model_qa->qa_reg_in($data); // 1:1 질문 등록하기

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

  // 삭제
  public function qa_del(){
		$qa_idx = $this->_input_check("qa_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['qa_idx'] = $qa_idx;

		$result = $this->model_qa->qa_del($data);

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

} // 클래스의 끝
?>

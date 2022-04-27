<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-11-09
| Memo : 커뮤니티
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

class Community_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		// if(!$this->session->userdata("member_idx") ){
		// 	redirect("/".mapping('login')."?return_url=/".mapping('community'));
		// 	exit;
		// }

		// model_board 이름으로 공통 사용
		$this->load->model(mapping('community').'/model_board');
		$this->load->model('common/model_common');
	}

	//인덱스
  public function index() {

    $this->community_list();
  }

	//메인 화면
  public function community_list(){
		$data['banner_type'] = '1';

		$rand_banner = $this->model_common->rand_banner($data);

		$recent_notice_detail = $this->model_common->recent_notice_detail();

		$response = new stdClass();

    $response->rand_banner = $rand_banner;
		$response->agent = $this->_user_agent();
		$response->recent_notice_detail = $recent_notice_detail;

		$this->_view(mapping('community').'/view_community_list', $response);
  }

	// order_list_get
	public function board_list_get(){

		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_board->board_list($data);
		$result_list_count = $this->model_board->board_list_count($data);

		$response = new stdClass();

		$response->page_num = $page_num;
		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);

		$this->_ajax_view(mapping('community').'/view_community_list_get', $response);
	}

	//메인 화면
  public function community_reg(){
		$this->_view2(mapping('community').'/view_community_reg');
  }

	//메인 화면
  public function community_mod(){

		$board_idx = $this->_input_check("board_idx",array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다.")));

		$data['board_idx'] = $board_idx;

		$result = $this->model_board->board_detail($data);

		$response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('community').'/view_community_mod', $response);
  }

	//메인 화면
  public function community_detail(){

		$board_idx = $this->_input_check('board_idx', array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_idx"));

		$data['board_idx'] = $board_idx;

		$result = $this->model_board->board_del_check($data);

		$response = new stdClass();

		if($result == "0") {
			// redirect("/".mapping('community'));
			$this->global_function->_alert_board_del("삭제된 게시물입니다.");

		}

		$result  = $this->model_board->board_summary_detail($data);

		$response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('community').'/view_community_detail', $response);
  }


	//등록
  public function board_reg_in(){
		$img_path =  $this->_input_check("img_path[]",array());
		$tags =  $this->_input_check("tags",array("empty_msg"=>"해시태그를 입력하세요."));
		$contents =  $this->_input_check("contents",array("empty_msg"=>"내용을 입력하여 주세요."));

		$data['img_path'] = $this->global_function->array_to_str($img_path);
		$data['tags'] = $tags;
		$data['contents'] = $contents;

		$result = $this->model_board->board_reg_in($data);

		$response = new stdClass;

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");

			// 커뮤티니 포인트 지급 & 뱃지 획득
			$data['badge_type'] = '3';
			$data['member_idx'] = $this->member_idx;
			$COM_badge_check = $this->model_common->COM_badge_check($data);

			$data['member_idx'] = $this->member_idx;
			$data['point'] = 60;
			$data['memo_type'] = '3';

			$this->model_common->member_point_mod_up($data);


			// $data['badge_type'] = '4';
			// $data['member_idx'] = $this->member_idx;
			// $data['board_type'] = '1';
			// $data['point'] = 20;
			//
			// $member_point_mod_up = $this->model_common->member_point_mod_up($data);
			// $COM_badge_check = $this->model_common->COM_badge_check($data);
		}

		echo json_encode($response);
		exit;
  }

	// 수정
	public function board_mod_up(){
		$board_idx =  $this->_input_check("board_idx",array(lang("lang_dev_00001","키가 누락되었습니다.")));
		$img_path =  $this->_input_check("img_path[]",array());
		$tags =  $this->_input_check("tags",array("empty_msg"=>"해시태그를 입력하세요."));
		$contents =  $this->_input_check("contents",array("empty_msg"=>"내용을 입력하여 주세요."));

		$data['img_path'] = $this->global_function->array_to_str($img_path);
		$data['tags'] = $tags;
		$data['contents'] = $contents;
		$data['board_idx'] = $board_idx;

		$result = $this->model_board->board_mod_up($data);

		$response = new stdClass;

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
  }

	// 2-3. 댓글 삭제
	public function board_del(){

		$board_idx = $this->_input_check('board_idx',array());

		$data['board_idx'] = $board_idx;

		$result = $this->model_board->board_del($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}

	// 삭제여부 체크
	public function board_del_check(){

		$board_idx = $this->_input_check('board_idx',array());

		$data['board_idx'] = $board_idx;

		$result = $this->model_board->board_del_check($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}

	public function my_board_cnt(){

		$result = $this->model_board->my_board_cnt();

		$response = new stdClass();

		$response->code = "1000";
		$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		$response->board_cnt = $result;

		echo json_encode($response);
		exit;
	}

	// 2-1. 댓글 리스트
	public function board_comment_list(){

		$board_idx = $this->_input_check('board_idx', array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_idx"));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
    $page_size = 10;

		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $this->member_idx;

		$data['page_size'] = $page_size;
	  $data['page_no'] = ($page_num-1)*$page_size;

		$result_list  = $this->model_board->board_comment_list($data);
		$result_list_count = $this->model_board->board_comment_list_count($data);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);

		$this->_ajax_view(mapping('community').'/view_board_comment_list_get', $response);

	}

	// 답글 보기
	public function board_comment_reply_list(){

		$board_reply_idx = $this->_input_check('board_reply_idx', array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_idx"));

		$data['board_reply_idx'] = $board_reply_idx;
		$data['member_idx'] = $this->member_idx;

		$result_list  = $this->model_board->board_comment_reply_list($data);

		$response = new stdClass();

		$response->result_list = $result_list;

		$this->_ajax_view(mapping('community').'/view_board_comment_reply_list_get', $response);
	}

	// 답글 보기
	public function board_comment_reply_list_more(){

		$board_reply_idx = $this->_input_check('board_reply_idx', array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_idx"));

		$data['board_reply_idx'] = $board_reply_idx;
		$data['member_idx'] = $this->member_idx;

		$result_list  = $this->model_board->board_comment_reply_list_more($data);

		$response = new stdClass();

		$response->result_list = $result_list;

		$this->_ajax_view(mapping('community').'/view_board_comment_reply_list_get_more', $response);
	}

	// 답글 보기
	public function board_reply_detail(){

		$board_reply_idx = $this->_input_check('board_reply_idx', array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_reply_idx"));

		$data['board_reply_idx'] = $board_reply_idx;
		$data['member_idx'] = $this->member_idx;

		$result  = $this->model_board->board_reply_detail($data);

		$response = new stdClass();

		$response->result = $result;

		$this->_ajax_view(mapping('community').'/view_board_reply_detail_get', $response);
	}

	// 2-2. 댓글/답글 등록
	public function board_comment_reg_in(){

		$board_idx = $this->_input_check('board_idx',array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_idx"));
		$depth = $this->_input_check('depth',array());
		$relpy_member_idx = $this->_input_check('relpy_member_idx',array());
		$reply_comment = $this->_input_check('reply_comment',array("empty_msg"=>"댓글을 입력해주세요.","focus_id"=>"reply_comment"));
		if($depth == "0"){
			$parent_board_reply_idx = NULL;
		}else{
			$parent_board_reply_idx = $this->_input_check('board_reply_idx',array());
		}

		$data['member_idx'] = $this->member_idx;
		$data['board_idx'] = $board_idx;
		$data['depth'] = $depth;
		$data['relpy_member_idx'] = $relpy_member_idx;
		$data['reply_comment'] = $reply_comment;
		$data['parent_board_reply_idx']  = $parent_board_reply_idx;

		$response = new stdClass();

		$result = $this->model_board->board_comment_reg_in($data);
		$board_summary_detail = $this->model_board->board_summary_detail($data);

		if($result == "0"){
			$response->code = "0";
			$response->code_msg = "등록 실패하였습니다. 관리자에게 문의해주세요.";
		}else{

			$response->code = "1000";
			$response->code_msg = "댓글이 작성 되었습니다.";
			$response->board_reply_idx = $result;
			$response->reply_cnt = $board_summary_detail->reply_cnt;

			//알람 105 :: 등록하신 게시글에 새로운 댓글이 작성 되었습니다.
			$check = $this->model_board->board_detail($data);

			if ($this->member_idx!=$check->member_idx && $this->member_idx!=$relpy_member_idx) {
				$index="105";
				$alarm_data['board_idx'] = $board_idx;

				$this->_alarm_action($check->member_idx,0,$index, $alarm_data);
			}

			if ($this->member_idx!=$relpy_member_idx) {

				$index="112";
				$alarm_data['board_idx'] = $board_idx;

				$this->_alarm_action($relpy_member_idx,0,$index, $alarm_data);
			}


			// // 커뮤티니 포인트 지급
			// $data['member_idx'] = $apply_check->member_idx;
			// $data['board_type'] = '1';
			// $data['point'] = 1;
			//
			// $member_point_mod_up = $this->model_common->member_point_mod_up($data);
			//
			// $data['member_idx'] = $this->member_idx;
			// $data['board_type'] = '1';
			// $data['point'] = 1;
			//
			// $member_point_mod_up = $this->model_common->member_point_mod_up($data);
		}

		echo json_encode($response);
		exit;
	}

	// 2-3. 댓글 삭제
	public function board_reply_del(){

		$board_reply_idx = $this->_input_check('board_reply_idx',array());
		$board_idx = $this->_input_check('board_idx',array());

		$data['board_reply_idx'] = $board_reply_idx;
		$data['board_idx'] = $board_idx;

		$result = $this->model_board->board_reply_del($data);//# model 6. 포토게시판댓글 삭제

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}



	/*
	   --------------------------------------------------------
	  |  신고
	  |________________________________________________________
	*/

	// 게시물신고
	public function board_report_reg_in(){

		$board_idx = $this->_input_check('board_idx',array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_idx"));
		$report_contents = $this->_input_check('report_contents',array("empty_msg"=>lang("lang_product_00778","신고 내용이 누락되었습니다."),"focus_id"=>"report_contents"));
		$report_type = $this->_input_check('report_type',array("empty_msg"=>lang("lang_product_00777","신고 유형이 누락되었습니다."),"focus_id"=>"report_type"));

		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $this->member_idx;
		$data['report_contents'] = $report_contents;
		$data['report_type'] = $report_type;

		$result = $this->model_board->board_report_reg_in($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}


	// 댓글신고
	public function board_reply_report_reg_in(){

		$board_reply_idx = $this->_input_check('board_reply_idx',array(lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_idx"));
		$report_type = $this->_input_check('report_type',array("empty_msg"=>lang("lang_product_00777","신고 유형이 누락되었습니다."),"focus_id"=>"report_type"));
		$report_position = $this->_input_check('report_position',array("empty_msg"=>"신고위치를 선택해주세요.","focus_id"=>"report_position"));
		$report_contents = $this->_input_check('report_contents',array("empty_msg"=>lang("lang_product_00778","신고 내용이 누락되었습니다."),"focus_id"=>"report_contents"));

		$data['board_reply_idx'] = $board_reply_idx;
		$data['member_idx'] = $this->member_idx;
		$data['report_type'] = $report_type;
		$data['report_position'] = $report_position;
		$data['report_contents'] = $report_contents;

		$result = $this->model_board->board_reply_report_reg_in($data);//

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}

	/*
		 --------------------------------------------------------
		|  차단
		|________________________________________________________
	*/

	// 회원 차단 등록
	public function member_block_reg_in(){

		$partner_member_idx = $this->_input_check('partner_member_idx', array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"member_idx"));

		$data['partner_member_idx'] = $partner_member_idx;

		$response = new stdClass;

		$result = $this->model_board->member_block_reg_in($data);

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
		}

		echo json_encode($response);
		exit;
	}


	// 게시글 스크랩
	public function board_scrap_reg_in(){

		$board_idx = $this->_input_check('board_idx', array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_idx"));

		$data['board_idx'] = $board_idx;

		$response = new stdClass;

		$result = $this->model_board->board_del_check($data);

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");

			echo json_encode($response);
			exit;
		}

		$apply_check = $this->model_board->board_detail($data);
		$data['member_idx'] = $this->member_idx;

		$result = $this->model_board->board_scrap_reg_in($data);
		$board_scrap_cnt = $this->model_board->board_scrap_cnt($data);

		if($result == "-1") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
			$response->scrap_cnt = $result;

			// 커뮤티니 포인트 지급 & 뱃지 획득
			if ($board_scrap_cnt>0) {
				$data['member_idx'] = $apply_check->member_idx;
				$data['point'] = 24;
				$data['memo_type'] = '4';

				$this->model_common->member_point_mod_up($data);
			}

		}

		echo json_encode($response);
		exit;
	}

	// 게시글 스크랩
	public function board_recommend_reg_in(){

		$board_idx = $this->_input_check('board_idx', array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_idx"));

		$data['board_idx'] = $board_idx;

		$response = new stdClass;

		$result = $this->model_board->board_del_check($data);

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");

			echo json_encode($response);
			exit;
		}

		$apply_check = $this->model_board->board_detail($data);
		$data['member_idx'] = $this->member_idx;

		$result = $this->model_board->board_recommend_reg_in($data);
		$board_recommend_cnt = $this->model_board->board_recommend_cnt($data);

		if($result == "-1") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
			$response->recommend_cnt = $result;

			// 커뮤티니 포인트 지급 & 뱃지 획득
			if ($board_recommend_cnt>0) {
				$data['member_idx'] = $apply_check->member_idx;
				$data['point'] = 24;
				$data['memo_type'] = '5';

				$this->model_common->member_point_mod_up($data);
			}

		}

		echo json_encode($response);
		exit;
	}

	// 게시글 좋아요
	public function board_like_reg_in(){

		$board_idx = $this->_input_check('board_idx', array("empty_msg"=>lang("lang_dev_00001","키가 누락되었습니다."),"focus_id"=>"board_idx"));

		$data['member_idx'] = $this->member_idx;
		$data['board_idx'] = $board_idx;

		$response = new stdClass;

		// $data['member_idx'] = $apply_check->member_idx;
		// $board_like_cnt = $this->model_board->board_like_cnt($data);

		$result = $this->model_board->board_like_reg_in($data);

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.");
		}else{
			$response->code = "1000";
			$response->code_msg 	= lang("lang_common_00821","정상적으로 처리되었습니다.");
			$response->like_cnt = $result;

			// 당신의 센스 ::  커뮤니티 게시글 좋아요 50개 이상
			$apply_check = $this->model_board->board_detail($data);

			$data['badge_type'] = '4';
			$data['member_idx'] = $apply_check->member_idx;
			$COM_badge_check = $this->model_common->COM_badge_check($data);

		}

		echo json_encode($response);
		exit;
	}

}// 클래스의 끝
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-10-28
| Memo : 뱃지
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

class Badge_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('badge').'/model_badge');
	}

//인덱스
  public function index() {

    $this->badge_list();
  }

//메인 화면
  public function badge_list(){
		// access_type = 0: 내 뱃지, 1: 회원 프로필 뱃지
		$access_type = $this->_input_check("access_type",array());
		$member_idx = $this->_input_check("member_idx",array());

		if ($access_type=='0') {
			$data['member_idx'] = $this->member_idx;
		}else {
			$data['member_idx'] = $member_idx;
		}

		//획득한뱃지(0:득탬 성공,1:거래하는 기쁨, 2:나눔의 시작, 3:소식통, 4:당신의 센스, 5:포인트 부자, 6:리뷰어, 7:친절한 판매자, 8:신뢰의 시작, 9: 알려주는 구매자)
		$result = $this->model_badge->badge_get($data); //뱃지 가져오기

		$response = new stdClass();

		$badge_0 = new stdClass();
		$badge_0->badge_type = '0';
		$badge_0->img_path_on = '/images/badge1.png';
		$badge_0->img_path_off = '/images/badge1_off.png';
		$badge_0->title = lang("lang_mypage_00623","득템 성공");
		$badge_0->how_to_get = lang("lang_badge_00795","최초 중고거래 구매 완료가 1회 이상.");

		$badge_1 = new stdClass();
		$badge_1->badge_type = '1';
		$badge_1->img_path_on = '/images/badge2.png';
		$badge_1->img_path_off = '/images/badge2_off.png';
		$badge_1->title = lang("lang_mypage_00624","거래하는 기쁨");
		$badge_1->how_to_get = lang("lang_badge_00796","최초 중고거래 판매 완료가 1회 이상");

		$badge_2 = new stdClass();
		$badge_2->badge_type = '2';
		$badge_2->img_path_on = '/images/badge3.png';
		$badge_2->img_path_off = '/images/badge3_off.png';
		$badge_2->title = lang("lang_mypage_00625","나눔의 시작");
		$badge_2->how_to_get = lang("lang_badge_00797","나눔 횟수 완료가 1회 이상");

		$badge_3 = new stdClass();
		$badge_3->badge_type = '3';
		$badge_3->img_path_on = '/images/badge4.png';
		$badge_3->img_path_off = '/images/badge4_off.png';
		$badge_3->title = lang("lang_mypage_00626","소식통");
		$badge_3->how_to_get = lang("lang_badge_00798","커뮤니티의 글 등록이 1회 이상");

		$badge_4 = new stdClass();
		$badge_4->badge_type = '4';
		$badge_4->img_path_on = '/images/badge5.png';
		$badge_4->img_path_off = '/images/badge5_off.png';
		$badge_4->title = lang("lang_mypage_00627","당신의 센스");
		$badge_4->how_to_get = lang("lang_badge_00799","커뮤니티 게시글 좋아요 50개 이상");

		$badge_5 = new stdClass();
		$badge_5->badge_type = '5';
		$badge_5->img_path_on = '/images/badge6.png';
		$badge_5->img_path_off = '/images/badge6_off.png';
		$badge_5->title = lang("lang_mypage_00628","포인트 부자");
		$badge_5->how_to_get = lang("lang_badge_00800","누적 포인트 획득 1,000점 이상 달성.");

		$badge_6 = new stdClass();
		$badge_6->badge_type = '6';
		$badge_6->img_path_on = '/images/badge7.png';
		$badge_6->img_path_off = '/images/badge7_off.png';
		$badge_6->title = lang("lang_mypage_00629","리뷰어");
		$badge_6->how_to_get = lang("lang_badge_00801","거래 후 평가 작성이 1회 이상");

		$badge_7 = new stdClass();
		$badge_7->badge_type = '7';
		$badge_7->img_path_on = '/images/badge8.png';
		$badge_7->img_path_off = '/images/badge8_off.png';
		$badge_7->title = lang("lang_mypage_00630","친절한 판매자");
		$badge_7->how_to_get = lang("lang_badge_00802","중고거래 판매 후  좋음 평가가 10회 이상");

		$badge_8 = new stdClass();
		$badge_8->badge_type = '8';
		$badge_8->img_path_on = '/images/badge9.png';
		$badge_8->img_path_off = '/images/badge9_off.png';
		$badge_8->title = lang("lang_mypage_00631","신뢰의 시작");
		$badge_8->how_to_get = lang("lang_badge_00803","프로필 사진 최초 등록 후");

		$badge_9 = new stdClass();
		$badge_9->badge_type = '9';
		$badge_9->img_path_on = '/images/badge10.png';
		$badge_9->img_path_off = '/images/badge10_off.png';
		$badge_9->title = lang("lang_mypage_00632","알려주는 구매자");
		$badge_9->how_to_get = lang("lang_badge_00804","중고거래 구매 후 평가 1회 이상");

		$my_badge = new stdClass();

		switch($result->my_badge){
			case '0': $my_badge->title = $badge_0->title; $my_badge->badge_type = '0'; break;
			case '1': $my_badge->title = $badge_1->title; $my_badge->badge_type = '1'; break;
			case '2': $my_badge->title = $badge_2->title; $my_badge->badge_type = '2'; break;
			case '3': $my_badge->title = $badge_3->title; $my_badge->badge_type = '3'; break;
			case '4': $my_badge->title = $badge_4->title; $my_badge->badge_type = '4'; break;
			case '5': $my_badge->title = $badge_5->title; $my_badge->badge_type = '5'; break;
			case '6': $my_badge->title = $badge_6->title; $my_badge->badge_type = '6'; break;
			case '7': $my_badge->title = $badge_7->title; $my_badge->badge_type = '7'; break;
			case '8': $my_badge->title = $badge_8->title; $my_badge->badge_type = '8'; break;
			case '9': $my_badge->title = $badge_9->title; $my_badge->badge_type = '9'; break;
			default : $my_badge->title = ""; $my_badge->badge_type = ""; break;
		}

		$response->result = $result;
		$response->badge_0 = $badge_0;
		$response->badge_1 = $badge_1;
		$response->badge_2 = $badge_2;
		$response->badge_3 = $badge_3;
		$response->badge_4 = $badge_4;
		$response->badge_5 = $badge_5;
		$response->badge_6 = $badge_6;
		$response->badge_7 = $badge_7;
		$response->badge_8 = $badge_8;
		$response->badge_9 = $badge_9;
		$response->my_badge = $my_badge;
		$response->access_type = $access_type;

		$this->_view2(mapping('badge').'/view_badge_list', $response);
  }

	// 대표 배지 설정
	public function my_badge_mod_up(){
		$my_badge = $this->_input_check("my_badge",array("empty_msg"=>lang("lang_dev_00001","키가 누락됐습니다.")));

		$data['my_badge'] = $my_badge;

		$result = $this->model_badge->my_badge_mod_up($data); // 대표 배지 설정

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

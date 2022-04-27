<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('mapping')){

  function mapping($str = '' ){

    $CI = get_instance();
    $CI->load->library('session');
    $version_change = $CI->session->userdata('version_change');

    if(isset($_SESSION['version_change'])){
      return $str = $version_change[$str];
    }

    if($_SERVER['REMOTE_ADDR'] =='211.118.222.232'){
      //개발

      $return_arr =  array(
        'test' => 'test_v_1_0_0', // ------------------------------- 대시보드
        'main' => 'main_v_1_0_0', // ------------------------------- 대시보드
        'style_guide' => 'style_guide_v_1_0_0', // ------------------------------- 스타일 가이드
        'calculate' => 'calculate_v_1_0_0', // --------------------- 정산 관리
        'member' => 'member_v_1_0_0', // --------------------------- 회원 관리
        'corp' => 'corp_v_1_0_0', // ------------------------------- 업체회원 관리
        'category_management' => 'category_management_v_1_0_0', // - 카테고리 관리
        'brand' => 'brand_v_1_0_0', // ------------------------- 브랜드 관리
        'product' => 'product_v_1_0_0', // ------------------------- 상품 관리
        'product_report' => 'product_report_v_1_0_0', // ------------------------- 상품 관리
        'product_plan' => 'product_plan_v_1_0_0', // ------------------------- 상품 기획전 관리
        'product_qa' => 'product_qa_v_1_0_0', // ----------- 상품qa
        'product_review' => 'product_review_v_1_0_0', // ----------- 상품리뷰관리
        'ticket_product' => 'ticket_product_v_1_0_0', // ----------- 티켓 관리
        'order' => 'order_v_1_0_0', //     ------------------------- 일반상품 결제
        'payment' => 'payment_v_1_0_0', // ------------------------- 일반상품 관리
        'ticket_payment' => 'ticket_payment_v_1_0_0', // ----------- 티켓상품 관리
        'board' => 'board_v_1_0_0', // ----------------------------- 자유게시판 관리
        'forbidden_search' => 'forbidden_search_v_1_0_0', // ----------------- 업체공지사항 관리
        'corp_notice' => 'corp_notice_v_1_0_0', // ----------------- 업체공지사항 관리
        'notice' => 'notice_v_1_0_0', // --------------------------- 공지사항 관리
        'faq' => 'faq_v_1_0_0', // --------------------------------- FAQ 관리
        'qa' => 'qa_v_1_0_0', // ----------------------------------- QA 관리
        'coupon' => 'coupon_v_1_0_0', // --------------------------- 쿠폰 관리
        'banner' => 'banner_v_1_0_0', // --------------------------- 배너 관리
        'board' => 'board_v_1_0_0', // --------------------------- 배너 관리
        'board_report' => 'board_report_v_1_0_0', // --------------------------- 신고 관리
        'board_reply_report' => 'board_reply_report_v_1_0_0', // --------------------------- 댓글신고 관리
  			'event' => 'event_v_1_0_0', // ----------------------------- 이벤트 관리
        'terms' => 'terms_v_1_0_0', // ----------------------------- 약관 관리
        'suboperator' => 'suboperator_v_1_0_0', // ----------------- 관리자 관리
        'start_popup' => 'start_popup_v_1_0_0', // --------------------------- 시작팝업 관리
        'project_member' => 'project_member_v_1_0_0', // --------------------------- 프로젝트 담당자 관리
        'emails' => 'emails_v_1_0_0', // --------------------------- 이메일
        'smtp_email' => 'smtp_email_v_1_0_0', // --------------------------- SMTP 관리
        'recommend' => 'recommend_search_v_1_0_0', // --------------------------- 추천 검색어 관리
        'statistic' => 'statistic_v_1_0_0', // --------------------------- 통계
        'member_point' => 'member_point_v_1_0_0' // --------------------------- 포인트 관리
  		);

    }else{
      //운영
      $return_arr =  array(
        'test' => 'test_v_1_0_0', // ------------------------------- 대시보드
        'main' => 'main_v_1_0_0', // ------------------------------- 대시보드
        'style_guide' => 'style_guide_v_1_0_0', // ------------------------------- 스타일 가이드
        'calculate' => 'calculate_v_1_0_0', // --------------------- 정산 관리
        'member' => 'member_v_1_0_0', // --------------------------- 회원 관리
        'corp' => 'corp_v_1_0_0', // ------------------------------- 업체회원 관리
        'category_management' => 'category_management_v_1_0_0', // - 카테고리 관리
        'brand' => 'brand_v_1_0_0', // ------------------------- 브랜드 관리
        'product' => 'product_v_1_0_0', // ------------------------- 상품 관리
        'product_report' => 'product_report_v_1_0_0', // ------------------------- 상품 관리
        'product_plan' => 'product_plan_v_1_0_0', // ------------------------- 상품 기획전 관리
        'product_qa' => 'product_qa_v_1_0_0', // ----------- 상품qa
        'product_review' => 'product_review_v_1_0_0', // ----------- 상품리뷰관리
        'ticket_product' => 'ticket_product_v_1_0_0', // ----------- 티켓 관리
        'order' => 'order_v_1_0_0', //     ------------------------- 일반상품 결제
        'payment' => 'payment_v_1_0_0', // ------------------------- 일반상품 관리
        'ticket_payment' => 'ticket_payment_v_1_0_0', // ----------- 티켓상품 관리
        'board' => 'board_v_1_0_0', // ----------------------------- 자유게시판 관리
        'forbidden_search' => 'forbidden_search_v_1_0_0', // ----------------- 업체공지사항 관리
        'corp_notice' => 'corp_notice_v_1_0_0', // ----------------- 업체공지사항 관리
        'notice' => 'notice_v_1_0_0', // --------------------------- 공지사항 관리
        'faq' => 'faq_v_1_0_0', // --------------------------------- FAQ 관리
        'qa' => 'qa_v_1_0_0', // ----------------------------------- QA 관리
        'coupon' => 'coupon_v_1_0_0', // --------------------------- 쿠폰 관리
        'banner' => 'banner_v_1_0_0', // --------------------------- 배너 관리
        'board' => 'board_v_1_0_0', // --------------------------- 배너 관리
        'board_report' => 'board_report_v_1_0_0', // --------------------------- 신고 관리
        'board_reply_report' => 'board_reply_report_v_1_0_0', // --------------------------- 댓글신고 관리
        'event' => 'event_v_1_0_0', // ----------------------------- 이벤트 관리
        'terms' => 'terms_v_1_0_0', // ----------------------------- 약관 관리
        'suboperator' => 'suboperator_v_1_0_0', // ----------------- 관리자 관리
        'start_popup' => 'start_popup_v_1_0_0', // --------------------------- 시작팝업 관리
        'project_member' => 'project_member_v_1_0_0', // --------------------------- 프로젝트 담당자 관리
        'emails' => 'emails_v_1_0_0', // --------------------------- 이메일
        'smtp_email' => 'smtp_email_v_1_0_0', // --------------------------- SMTP 관리
        'recommend' => 'recommend_search_v_1_0_0', // --------------------------- 추천 검색어 관리
        'statistic' => 'statistic_v_1_0_0', // --------------------------- 통계
        'member_point' => 'member_point_v_1_0_0' // --------------------------- 포인트 관리
  		);
    }
		return $str = $return_arr[$str];
  }
}

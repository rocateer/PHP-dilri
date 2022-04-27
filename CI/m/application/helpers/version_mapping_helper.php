<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('mapping')){

  function mapping($str = '' ){
    $CI = get_instance();
    $CI->load->library('session');
    $version_change = $CI->session->userdata('version_change');

    if(isset($_SESSION['version_change'])){
      return $str = $version_change[$str];
    }

    $substr_ip = substr($_SERVER['REMOTE_ADDR'], 0, 11);
    if($substr_ip == '211.118.222' || $_SERVER['REMOTE_ADDR'] == '211.118.222.232'){
      //개발

      $return_arr =  array(
        'main' => 'main_v_1_0_0', // ------------------------------- 홈
        'product' => 'product_v_1_0_0', // ------------------------------- 홈
        'community' => 'community_v_1_0_0', // ------------------------------- community
        'search' => 'search_v_1_0_0', // ------------------------------- search
        'badge' => 'badge_v_1_0_0', // ------------------------------- badge
        'chat' => 'chat_v_0_47_0', // ------------------------------- chat
        'chatting' => 'chatting_v_1_0_0', // ------------------------------- chat
        'setting' => 'setting_v_1_0_0', // ------------------------------- setting
        'join' => 'join_v_1_0_0', // ------------------------------- 가입
        'login' => 'login_v_1_0_0', // ------------------------------- 로그인
        'logout' => 'logout_v_1_0_0', // ------------------------------- 로그인
        'logout_default' => 'logout_default_v_1_0_0', // ------------------------------- 로그인
        'find_id' => 'find_id_v_1_0_0', // ------------------------------- 아이디찾기
        'find_pw' => 'find_pw_v_1_0_0', // ------------------------------- 비밀번호찾기
        'mypage' => 'mypage_v_1_0_0', // ------------------------------- 마이페이지
        'notice' => 'notice_v_1_0_0', // ------------------------------- 공지
        'faq' => 'faq_v_1_0_0', // ------------------------------- faq
        'qa' => 'qa_v_1_0_0', // ------------------------------- qa
        'member_pw_change' => 'member_pw_change_v_1_0_0', // ------------------------------- member_pw_change
        'member_out' => 'member_out_v_1_0_0', // ------------------------------- member_out
        'member_info' => 'member_info_v_1_0_0', // ------------------------------- member_info
        'alarm' => 'alarm_v_1_0_0', // ------------------------------- alarm
        'eval' => 'eval_v_1_0_0', // ------------------------------- eval
        'profile' => 'profile_v_1_0_0', // ------------------------------- profile
        'terms' => 'terms_v_1_0_0', // ------------------------------- 이용약관
        'tel_verify' => 'tel_verify_v_1_0_0', // ------------------------------- 이용약관
        'message' => 'message_v_1_0_0', // ------------------------------- 이용약관

  		);

    }else{
      //운영
      $return_arr =  array(
        'main' => 'main_v_1_0_0', // ------------------------------- 홈
        'product' => 'product_v_1_0_0', // ------------------------------- 홈
        'community' => 'community_v_1_0_0', // ------------------------------- community
        'search' => 'search_v_1_0_0', // ------------------------------- search
        'badge' => 'badge_v_1_0_0', // ------------------------------- badge
        'chat' => 'chat_v_0_47_0', // ------------------------------- chat
        'chatting' => 'chatting_v_1_0_0', // ------------------------------- chat
        'setting' => 'setting_v_1_0_0', // ------------------------------- setting
        'join' => 'join_v_1_0_0', // ------------------------------- 가입
        'login' => 'login_v_1_0_0', // ------------------------------- 로그인
        'logout' => 'logout_v_1_0_0', // ------------------------------- 로그인
        'logout_default' => 'logout_default_v_1_0_0', // ------------------------------- 로그인
        'find_id' => 'find_id_v_1_0_0', // ------------------------------- 아이디찾기
        'find_pw' => 'find_pw_v_1_0_0', // ------------------------------- 비밀번호찾기
        'mypage' => 'mypage_v_1_0_0', // ------------------------------- 마이페이지
        'notice' => 'notice_v_1_0_0', // ------------------------------- 공지
        'faq' => 'faq_v_1_0_0', // ------------------------------- faq
        'qa' => 'qa_v_1_0_0', // ------------------------------- qa
        'member_pw_change' => 'member_pw_change_v_1_0_0', // ------------------------------- member_pw_change
        'member_out' => 'member_out_v_1_0_0', // ------------------------------- member_out
        'member_info' => 'member_info_v_1_0_0', // ------------------------------- member_info
        'alarm' => 'alarm_v_1_0_0', // ------------------------------- alarm
        'eval' => 'eval_v_1_0_0', // ------------------------------- eval
        'profile' => 'profile_v_1_0_0', // ------------------------------- profile
        'terms' => 'terms_v_1_0_0', // ------------------------------- 이용약관
        'tel_verify' => 'tel_verify_v_1_0_0', // ------------------------------- 이용약관
        'message' => 'message_v_1_0_0', // ------------------------------- 이용약관

  		);
    }

		return $str = $return_arr[$str];
  }
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-01-12
|------------------------------------------------------------------------
*/

Class Global_function {

	function _alert_logout($str, $app_yn, $agent, $current_nation) {

		header('Content-Type: text/html; charset=UTF-8');

		// $script = "<script type=\"text/javascript\">";
		// $script .= "alert('" . $str . "');";
		// $script .= "location.href='/".mapping('logout')."';";
		// $script .= "</script>";

		$script = "<script type=\"text/javascript\">";

		$script .= "var agent ='".$agent."';";
		$script .= "var app_yn ='".$app_yn."';";

		$script .= "if(app_yn=='Y'){";
		$script .= "	api_request_logout();";
		$script .= "	alert('" . $str . "');";
		$script .= "	setTimeout(function() {";
		$script .= "		location.href='/".$current_nation."/".mapping('logout')."';";
		$script .= "	 }, 1000);";
		$script .= "}else{";
		$script .= "	alert('" . $str . "');";
		$script .= "	location.href='/".$current_nation."/".mapping('logout')."';";
		$script .= "}";

		$script .= "function api_request_logout(){";
		$script .= "	if( agent == 'android') {";
		$script .= "		window.rocateer.request_logout();";
		$script .= "	} else if ( agent == 'ios') {";
		$script .= "		var message = {";
		$script .= "									 'request_type' : 'request_logout'";
		$script .= "									};";
		$script .= "		window.webkit.messageHandlers.native.postMessage(message);";
		$script .= "	}";
		$script .= "}";
		$script .= "</script>";

		// $script .= "location.href='/".mapping('logout')."';";


		echo $script;
		return;
	}

	function _alert_board_del($str) {

		header('Content-Type: text/html; charset=UTF-8');

		$script = "<script type=\"text/javascript\">";
		$script .= "alert('" . $str . "');";
		$script .= "location.href='/us/".mapping('community')."';";
		$script .= "</script>";

		echo $script;
		return;
	}

	// 무료 나눔 지수 이미지
	function get_free_product_img($free_product_cnt){

		if ($free_product_cnt<3) {
			$img='/images/level_0.png';
		}elseif ($free_product_cnt>=3 && $free_product_cnt<10 ) {
			$img='/images/level_1.png';
		}elseif ($free_product_cnt>=10 && $free_product_cnt<20) {
			$img='/images/level_2.png';
		}elseif ($free_product_cnt>=20 && $free_product_cnt<40) {
			$img='/images/level_3.png';
		}elseif ($free_product_cnt>=40 && $free_product_cnt<80) {
			$img='/images/level_4.png';
		}elseif ($free_product_cnt>=80 && $free_product_cnt<160) {
			$img='/images/level_5.png';
		}elseif ($free_product_cnt>=160 && $free_product_cnt<300) {
			$img='/images/level_6.png';
		}elseif ($free_product_cnt>=300 && $free_product_cnt<600) {
			$img='/images/level_7.png';
		}elseif ($free_product_cnt>=600 && $free_product_cnt<1000) {
			$img='/images/level_8.png';
		}elseif ($free_product_cnt>=1000 && $free_product_cnt<10000) {
			$img='/images/level_9.png';
		}elseif ($free_product_cnt>=10000 ) {
			$img='/images/level_10.png';
		}

		return $img;
	}


	function get_badge_info($badge_type){

		$badge_info = new stdClass();

		$badge_info->badge_type = '';
		$badge_info->img_path_on = '';
		$badge_info->img_path_off = '';
		$badge_info->title = '';
		$badge_info->how_to_get = '';

		if ($badge_type=='0') {
			$badge_info->badge_type = '0';
			$badge_info->img_path_on = '/images/badge1.png';
			$badge_info->img_path_off = '/images/badge1_off.png';
			$badge_info->title = lang("lang_mypage_00623","득템 성공");
			$badge_info->how_to_get = lang("lang_badge_00795","최초 중고거래 구매 완료가 1회 이상.");
		}

		if ($badge_type=='1') {
			$badge_info->badge_type = '1';
			$badge_info->img_path_on = '/images/badge2.png';
			$badge_info->img_path_off = '/images/badge2_off.png';
			$badge_info->title = lang("lang_mypage_00624","거래하는 기쁨");
			$badge_info->how_to_get = lang("lang_badge_00796","최초 중고거래 판매 완료가 1회 이상");
		}

		if ($badge_type=='2') {
			$badge_info->badge_type = '2';
			$badge_info->img_path_on = '/images/badge3.png';
			$badge_info->img_path_off = '/images/badge3_off.png';
			$badge_info->title = lang("lang_mypage_00625","나눔의 시작");
			$badge_info->how_to_get = lang("lang_badge_00797","나눔 횟수 완료가 1회 이상");
		}

		if ($badge_type=='3') {
			$badge_info->badge_type = '3';
			$badge_info->img_path_on = '/images/badge4.png';
			$badge_info->img_path_off = '/images/badge4_off.png';
			$badge_info->title = lang("lang_mypage_00626","소식통");
			$badge_info->how_to_get = lang("lang_badge_00798","커뮤니티의 글 등록이 1회 이상");
		}

		if ($badge_type=='4') {
			$badge_info->badge_type = '4';
			$badge_info->img_path_on = '/images/badge5.png';
			$badge_info->img_path_off = '/images/badge5_off.png';
			$badge_info->title = lang("lang_mypage_00627","당신의 센스");
			$badge_info->how_to_get = lang("lang_badge_00799","커뮤니티 게시글 좋아요 50개 이상");
		}

		if ($badge_type=='5') {
			$badge_info->badge_type = '5';
			$badge_info->img_path_on = '/images/badge6.png';
			$badge_info->img_path_off = '/images/badge6_off.png';
			$badge_info->title = lang("lang_mypage_00628","포인트 부자");
			$badge_info->how_to_get = lang("lang_badge_00800","누적 포인트 획득 1,000점 이상 달성.");
		}

		if ($badge_type=='6') {
			$badge_info->badge_type = '6';
			$badge_info->img_path_on = '/images/badge7.png';
			$badge_info->img_path_off = '/images/badge7_off.png';
			$badge_info->title = lang("lang_mypage_00629","리뷰어");
			$badge_info->how_to_get = lang("lang_badge_00801","거래 후 평가 작성이 1회 이상");
		}

		if ($badge_type=='7') {
			$badge_info->badge_type = '7';
			$badge_info->img_path_on = '/images/badge8.png';
			$badge_info->img_path_off = '/images/badge8_off.png';
			$badge_info->title = lang("lang_mypage_00630","친절한 판매자");
			$badge_info->how_to_get = lang("lang_badge_00802","중고거래 판매 후  좋음 평가가 10회 이상");
		}

		if ($badge_type=='8') {
			$badge_info->badge_type = '8';
			$badge_info->img_path_on = '/images/badge9.png';
			$badge_info->img_path_off = '/images/badge9_off.png';
			$badge_info->title = lang("lang_mypage_00631","신뢰의 시작");
			$badge_info->how_to_get = lang("lang_badge_00803","프로필 사진 최초 등록 후");
		}

		if ($badge_type=='9') {
			$badge_info->badge_type = '9';
			$badge_info->img_path_on = '/images/badge10.png';
			$badge_info->img_path_off = '/images/badge10_off.png';
			$badge_info->title = lang("lang_mypage_00632","알려주는 구매자");
			$badge_info->how_to_get = lang("lang_badge_00804","중고거래 구매 후 평가 1회 이상");
		}

		return $badge_info;
	}

	function array_to_str_parm($arr_data, $parm_name){
		$str="";
		if (!empty($arr_data)) {
			for ($i=0; $i < count($arr_data); $i++) {
				if ($i==0) {
					$str = $arr_data[$i]->$parm_name;
				} else {
					$str = $str.",".$arr_data[$i]->$parm_name;
				}
			}
		}
		return $str;
	}

	function array_to_str($arr_data){
		$str="";
		if (!empty($arr_data)) {
			for ($i=0; $i < count($arr_data); $i++) {
				if ($i==0) {
					$str = $arr_data[$i];
				} else {
					$str = $str.",".$arr_data[$i];
				}
			}
		}
		return $str;
	}

	function array_to_str2($arr_data){
		$str="";
		if (!empty($arr_data)) {
			for ($i=0; $i < count($arr_data); $i++) {
				if ($i==0) {
					$str = $arr_data[$i];
				} else {
					$str = $str."^|^".$arr_data[$i];
				}
			}
		}
		return $str;
	}

	function array_to_str3($arr_data){
		$str="";
		if (!empty($arr_data)) {
			for ($i=0; $i < count($arr_data); $i++) {
				if ($i==0) {
					$str = $arr_data[$i];
				} else {
					$str = $str."^".$arr_data[$i];
				}
			}
		}
		return $str;
	}

	// 시간 표기형식 변환(초단위 기준)
	function convert_time_exp($time){
		$now = strtotime(date('Y-m-d H:i:s'));
		$target_date = strtotime($time);
		$diff = $now - $target_date;

		$res = "";

		// 1분(60초) 미만
		if($diff < 60){
			$res = lang("lang_mypage_00523","지금");
		}

		// 1분 이상 ~ 59분 이하
		if($diff >= 60 && $diff < 60*60){
			$time_ = floor($diff/60);
			$res = $time_.lang("lang_mypage_00524","분 전");
		}

		// 1시간 ~ 24시간 미만
		if($diff >= 60*60 && $diff < 60*60*24){
			$time_ = floor($diff/(60*60));
			$res = $time_.lang("lang_mypage_00525","시간 전");
		}

		// 등록일과 현재 날짜 차이가 7일 이내인 경우
		if($diff >= 60*60*24 && $diff < 60*60*24*7){
			$time_ = floor($diff/(60*60*24));
			$res = $time_.lang("lang_mypage_00526","일 전");
		}

		// 등록일과 현재 날짜 차이가 8 ~ 29일
		if($diff >= 60*60*24*7 && $diff < 60*60*24*30){
			$time_ = floor(($diff/(60*60*24))/7);
			$res = $time_.lang("lang_mypage_00527","주일 전");
		}

		// 등록일과 현재 날짜 차이가 30이상인 경우
		if($diff >= 60*60*24*30 && $diff < 60*60*24*360){
			$time_ = floor($diff/(60*60*24*30));
			$res = $time_.lang("lang_mypage_00528","개월 전");
		}

		// 등록일과 현재 날짜 차이가 30이상인 경우
		if($diff >= 60*60*24*360){
			$time_ = floor($diff/(60*60*24*360));
			$res = $time_.lang("lang_mypage_00529","년 전");
		}

		return $res;
	}

	function create_verify_num($type, $howlong){
		if($type == 'verify'){
			$characters = "0123456789";	// 발생시킬 문자 바운더리
		}else if($type == 'coupon'){
			$characters  = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";	// 발생시킬 문자 바운더리
		}else if($type == 'order'){
			$characters  = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";	// 발생시킬 문자 바운더리
		}else{
			$characters  = "0123456789";	// 발생시킬 문자 바운더리
		}

		$rendom_str = "";
		$loopNum = $howlong;	// 자리수

		while ($loopNum--) {
			$rendom_str .= $characters[mt_rand(0, strlen($characters)-1)];
		}

		if($type == 'order'){
			$now_date = date("Ymd");
			$rendom_str = $now_date."-".$rendom_str;
		}

		return $rendom_str;
	}

	// 코드로 저장된 데이터를 텍스트로 변환
	function code2text($code){
		$text = "Code Not Found";

		$text_arr = array(
			'1' => lang("lang_qa_00737","계정 문의"),
			'2' => lang("lang_qa_00738","판매 금지/거래 품목 문의"),
			'3' => lang("lang_qa_00739","거래 평가 항목 관련 문의"),
			'4' => lang("lang_qa_00740","게시글 노출, 미노출 문의"),
			'5' => lang("lang_qa_00741","채팅, 알림"),
			'6' => lang("lang_qa_00742","채팅알림"),
			'7' => lang("lang_qa_00743","앱 사용/ 거래 방법 문의"),
			'8' => lang("lang_qa_00744","커뮤니티 문의"),
			'9' => lang("lang_qa_00745","검색 문의"),
			'10' => lang("lang_qa_00746","기타 문의"),
			'11' => lang("lang_qa_00747","오류 제보"),
			'12' => lang("lang_qa_00748","개선 / 제안"),
		);

		if(!empty($text_arr[$code])){
			$text = $text_arr[$code];
		}

		return $text;
	}

	function _alert($str, $url="") {

		header('Content-Type: text/html; charset=UTF-8');

		$script = "<script type=\"text/javascript\">";
		$script .= "alert('" . $str . "');";
		if(!empty($url)) $script .= "location.href='" . $url . "';";
		$script .= "</script>";

		echo $script;
		return;
	}

	function _alert_close($str) {

		header('Content-Type: text/html; charset=UTF-8');

		$script = "<script type=\"text/javascript\">";
		$script .= "alert('" . $str . "');";
		$script .= "self.close();";
		$script .= "</script>";

		echo $script;
		return;
	}

	function date_Hi($str_date){
		$date = date("H:i", strtotime( $str_date ) );
		return $date;
	}

	function date_YmdHi_hyphen($str_date){
		$date = date("Y-m-d H:i", strtotime( $str_date ) );
		return $date;
	}

	function date_YmdHi_dot($str_date){
		$date = date("Y.m.d H:i", strtotime( $str_date ) );
		return $date;
	}

	function date_Ymd_hyphen($str_date){
		$date = date("Y-m-d", strtotime( $str_date ) );
		return $date;
	}

	function date_Ymd_dot($str_date){
		$date = date("Y.m.d", strtotime( $str_date ) );
		return $date;
	}


	// 시:분 하이픈
	function dateHi($str_date){
		$date = date("H:i", strtotime( $str_date ) );
		return $date;
	}



	// 년-월-일 시:분 하이픈
	function dateYmdHiHyphen($str_date){
		$date = date("Y-m-d H:i", strtotime( $str_date ) );
		return $date;
	}



	// 년.월.일 콤마
	function dateYmdComma($str_date){
		$date = date("Y.m.d", strtotime( $str_date ) );
		return $date;
	}

	// 년-월-일 하이픈
	function dateYmdHyphen($str_date){
		$date = date("Y-m-d", strtotime( $str_date ) );
		return $date;
	}


	// function paging($totalCnt,$pageSize,$pageNum,$fn=""){
	//
	// 	$pagenumber=PAGENUMBER;
	//
	// 	$total_page=ceil($totalCnt/$pageSize);
	// 	$total_block=ceil($total_page/$pagenumber);
	//
	// 	if(($pageNum)% $pagenumber!=0){
	// 		$block=ceil(($pageNum+1)/$pagenumber);
	// 	}else{
	// 		$block=ceil(($pageNum+1)/$pagenumber)-1;
	// 	}
	// 	$first_page=($block-1)*$pagenumber;
	// 	$last_page=$block*$pagenumber;
	//
	// 	$prev=$first_page;
	// 	$next=$last_page+1;
	// 	$go_page=$first_page+1;
	//
	// 	if($fn==""){
	// 		$fn="page_go";
	// 	}
	//
	//
	//
	// 	if($total_block<=$block)
	// 		$last_page=$total_page;
	//
	// 	$page_html="";
	// 	if($totalCnt>0){
	// 		$page_html.="<div class='paging'>";
	//
	// 		if($block>1){
	// 			$page_html.="
	// 				 <span class='prev'>
	// 				 <a href='javascript:".$fn."(1);'><i class='fa fa-angle-double-left'></i></a><a href=javascript:".$fn."($prev);> <i class='fa fa-angle-left'></i> </a>
	// 				 </span>
	// 			";
	// 		}else{
	// 			$page_html.="
	// 				 <span class='prev'>
	// 				 <a href='javascript:".$fn."(1);'><i class='fa fa-angle-double-left'></i></a><a href='#'><i class='fa fa-angle-left'></i></a>
	// 				 </span>
	// 			";
	// 		}
	//
	// 		for($go_page;$go_page<=$last_page;$go_page++){
	// 			if($pageNum==$go_page)
	// 				$page_html.="<a href=javascript:".$fn."($go_page);  class='on'>$go_page</a>";
	// 			else
	// 				$page_html.="<a href=javascript:".$fn."($go_page);>$go_page</a>";
	//
	// 		}
	//
	// 		if($block<$total_block){
	// 			$page_html.="
	// 				 <span class='next'>
	// 				 <a href=javascript:".$fn."($next);> <i class='fa fa-angle-right'></i> </a><a href='javascript:".$fn."($total_page);'> <i class='fa fa-angle-double-right'></i> </a>
	// 				 </span>
	// 				";
	// 		}else{
	// 			$page_html.="
	// 				 <span class='next'>
	// 				 <a href='#'><i class='fa fa-angle-right'></i></a><a href='javascript:".$fn."($total_page);'> <i class='fa fa-angle-double-right'></i> </a>
	// 				 </span>
	// 				";
	//
	// 		}
	// 		$page_html.="</div>";
	// 	}else{
	// 		$page_html.="<div class='paging'></div>";
	// 	}
	//
	// 	return $page_html;
	//
	// }

function paging($totalCnt,$pageSize,$pageNum,$fn=""){

		$pagenumber=PAGENUMBER;

		$total_page=ceil($totalCnt/$pageSize);
		$total_block=ceil($total_page/$pagenumber);

		if(($pageNum)% $pagenumber!=0){
			$block=ceil(($pageNum+1)/$pagenumber);
		}else{
			$block=ceil(($pageNum+1)/$pagenumber)-1;
		}
		$first_page=($block-1)*$pagenumber;
		$last_page=$block*$pagenumber;

		$prev=$first_page;
		$next=$last_page+1;
		$go_page=$first_page+1;

		if($fn==""){
			$fn="page_go";
		}

		if($total_block<=$block)
			$last_page=$total_page;

		$page_html="";
		if($totalCnt>0){
			$page_html.="<div class='paging'><ul class='btn_wrap'>";

			if($block>1){
				$page_html.="
					 <li class='btn_arrow start'>
					 <a href=javascript:".$fn."(1);>&nbsp;</a>
					 </li>
					 <li class='btn_arrow prev'><a class='no_next' href=javascript:".$fn."($prev);>&nbsp;
					 </a>
					 </li>
				";
			}else if($pageNum == "1"){
				$page_html.="
					 <li class='btn_arrow start'>
					 <a href='#".$pageNum."'>&nbsp;</a>
					 </li>
					 <li class='btn_arrow prev'><a class='no_next' href='#".$pageNum."'>&nbsp;</a>
					 </li>";
			}else{
				$page_html.="
					 <li class='btn_arrow start'>
					 <a href='javascript:".$fn."(1);'>&nbsp;</a>
					 </li>
					 <li class='btn_arrow prev'><a class='no_next' href='#".$pageNum."'>&nbsp;</a>
					 </li>";
			}

			for($go_page;$go_page<=$last_page;$go_page++){
				if($pageNum==$go_page)
					$page_html.="<li class='active'><a href='javascript:void(0)'>$go_page</a></li>";
				else
					$page_html.="<li><a href=javascript:".$fn."($go_page);>$go_page</a></li>";

			}

			if($block<$total_block){
				$page_html.="
						<li class='btn_arrow next'><a class='no_next' href=javascript:".$fn."($next);>&nbsp;</a>
						</li>
						<li class='btn_arrow end'><a href='javascript:".$fn."($total_page);'>&nbsp;</a>
						</li>
				";
			}else if($total_page == $pageNum){
				$page_html.="
						<li class='btn_arrow next'><a class='no_next' href='#".$pageNum."'>&nbsp;</a>
						</li>
						<li class='btn_arrow end'><a href='#".$pageNum."'>&nbsp;</a>
						</li>";
			}else{
				$page_html.="
						<li class='btn_arrow next'><a class='no_next' href='#".$pageNum."'>&nbsp;</a>
						</li>
						<li class='btn_arrow end'><a href='javascript:".$fn."($total_page);'>&nbsp;</a>
						</li>";
			}
			$page_html.="</ul></div>";
		}

		return $page_html;

	}

	function paging2($totalCnt,$pageSize,$pageNum,$fn=""){

		$pagenumber=PAGENUMBER;

		$total_page=ceil($totalCnt/$pageSize);
		$total_block=ceil($total_page/$pagenumber);

		if(($pageNum)% $pagenumber!=0){
			$block=ceil(($pageNum+1)/$pagenumber);
		}else{
			$block=ceil(($pageNum+1)/$pagenumber)-1;
		}
		$first_page=($block-1)*$pagenumber;
		$last_page=$block*$pagenumber;

		$prev=$first_page;
		$next=$last_page+1;
		$go_page=$first_page+1;

		if($fn==""){
			$fn="page_go";
		}



		if($total_block<=$block)
			$last_page=$total_page;

		$page_html="";
		if($totalCnt>0){
			$page_html.="<div class='paging_area02'>";

			if($block>1){
				$page_html.="
					 <a href=javascript:".$fn."($prev); > <img src='/images/prev02.png' alt='이전' /> </a>
				";
			}else{
				$page_html.="
					 <a href='#".$pageNum."'> <img src='/images/prev02.png' alt='이전' /></a>
				";
			}

			for($go_page;$go_page<=$last_page;$go_page++){
				if($pageNum==$go_page)
					$page_html.="<a class='page_select'>$go_page</a>";
				else
					$page_html.="<a href=javascript:".$fn."($go_page);>$go_page</a>";

			}

			if($block<$total_block){
				$page_html.="
					 <a href=javascript:".$fn."($next); > <img src='/images/next02.png' alt='다음'/> </a> ";
			}else{
				$page_html.="
					 <a href='#".$pageNum."'> <img src='/images/next02.png' alt='다음'/></a>";
			}
			$page_html.="</div>";
		}

		return $page_html;

	}

	function read_clob($field){

		if(is_null($field)){
			return "";
		}else{
			return $field->read($field->size());
		}
	}

	function textEnter($str){
		$str=str_replace("\n","<br/>",$str);
        		return $str;
	}
	public function trim_str($str){
		$str=str_replace(" ","",$str);
		return $str;
	}

  //핸드폰 형식세팅
	function set_phone_number($str){

		if($str){
			$rt = substr($str,0,3)."-".substr($str,3,4)."-".substr($str,7,4);
		}else{
			$rt ="";
		}
		return $rt;
	}


	//날짜
	function change_add_date($date){
		$date =str_replace("-","",$date);
		if($date){
			$rt =substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2);
		}else{
			$rt ="";
		}
		return $rt;
	}

	//시간
	function change_add_hm($hm){
		$hs =str_replace(":","",$hm);
		if($hs){
			$rt =substr($hs,0,2).":".substr($hs,2,2);
		}else{
			$rt ="";
		}
		return $rt;
	}


	  //날짜
	function change_strip_date($date){
		if($date){
			$rt =str_replace("-","",$date);
	  }else{
      $rt="";
		}
		return $rt;
	}

	//시간
	function change_strip_hm($hm){
		if($hm){
			$rt =str_replace(":","",$hm);
		}else{
			$rt ="";
		}

		return $rt;
	}

	//전화번호 '-'기준으로 나누기
	function telnumNoneHypen($str){

		/*
		$tel_num[0] = 전체
		$tel_num[1] = 지역번호or(010/011 ...)
		$tel_num[2] = 중간번호
		$tel_num[3] = 마지막번호
		*/
		preg_match('/\(?(?<Num1>\d{2,3})\)?-?\s*(?<Num2>\d{3,4})-?\s*(?<Num3>\d{4})/', $str, $tel_num);
		return $tel_num;
	}

	// url에 http/https가 있으면 냅두고 없으면 url에 http/https 붙여서 반환
	function check_str_http($str) {

		$chk_http = stristr($str, "http");

		if($chk_http == false) {
			$str = "http://".$str;
			return $str;
		}else {
			return $str;
		}

	}

	// 여행기간(tour_term_type)값 #붙여서 한글변환
	function convert_tour_term_type($str) {

		$tour_term = "";

		switch($str) {
			case '1': $tour_term = "#1박2일"; break;
			case '2': $tour_term = "#2박3일"; break;
			case '3': $tour_term = "#3박4일"; break;
			case '4': $tour_term = "#4박5일"; break;
			case '5': $tour_term = "#기타"; break;
			default: $tour_term = "#당일치기"; break;
		}

		return $tour_term;
	}

	// 태그값 (,) 구분자로 나누어 #붙여서 출력
	function convert_tag_name($str) {

		$tag_name = explode(',', $str);

		for ($i=0; $i<count($tag_name); $i++) {
			$tag_name[$i] = "#".$tag_name[$i];
		}

		return $tag_name;
	}

//faq type 별 title 가져오기
	function get_faq_title($str){
    switch($str){
			case "1" : $rt ="회원관련" ; break;
			case "2" : $rt ="포인트관련" ; break;
			case "3" : $rt ="그 외" ; break;
			case "4" : $rt ="" ; break;
		}
    return $rt;
	}


	function get_order_state($str){

		switch ($str) {
			case '0' : $rt ='주문완료'; break;
			case '1' : $rt='입금완료'; break;
			case '2' : $rt='배송준비'; break;
			case '3' : $rt='배송보류'; break;
			case '4' : $rt='배송중'; break;
			case '5' : $rt='배송완료'; break;
			case '20' : $rt='주문취소신청'; break;
			case '21' : $rt='주문취소'; break;
			case '30' : $rt='주문환불신청'; break;
			case '31' : $rt='주문환불완료'; break;
			case '32' : $rt='주문환불불가'; break;
			case '40' : $rt='주문교환신청'; break;
			case '41' : $rt='주문교환완료'; break;
			case '42' : $rt='주문교환불가'; break;
			}
			return $rt;
	}

	// 이미지 가로 사이즈 가져오기
	function get_images_width($url){
		if($url !=""){
			$result = getimagesize($url);
			return $result[0];
		}else{
			return 0;
		}
	}

	// 이미지 세로 사이즈 가져오기
	function get_images_height($url){
		if($url !=""){
			$result = getimagesize($url);
			return $result[1];
		}else{
			return 0;
		}
	}
}// 클래스의 끝
?>

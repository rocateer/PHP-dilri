<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-01-12
|------------------------------------------------------------------------
*/

Class Global_function {
	
	function get_product_state($str) {
		$rt = "";
		switch($str) {
			case '0': $rt = "판매중"; break;
			case '1': $rt = "예약중"; break;
			case '2': $rt = "거래완료"; break;
			default: $rt = ""; break;
		}
		return $rt;
	}

	function get_member_join_type($str) {
		$rt = "";
		switch($str) {
			case 'C': $rt = "일반 로그인"; break;
			case 'F': $rt = "페이스북 로그인"; break;
			case 'G': $rt = "구글 로그인"; break;
			default: $rt = ""; break;
		}
		return $rt;
	}
	
	
	//경고창
	function alert($str, $url="") {

		header('Content-Type: text/html; charset=UTF-8');

		$script = "<script type=\"text/javascript\">";
		$script .= "alert('" . $str . "');";
		if(!empty($url)) $script .= "location.href='" . $url . "';";
		$script .= "</script>";

		echo $script;
		return;
	}

	//경고창 후 닫기
	function alert_close($str) {

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

	//기본 페이징 디자인
	function paging($totalCnt,$pageSize,$pageNum,$fn=""){

		$pagenumber = PAGENUMBER;

		$total_page  = ceil($totalCnt/$pageSize);
		$total_block = ceil($total_page/$pagenumber);

		if(($pageNum)%$pagenumber != 0){
			$block = ceil(($pageNum+1)/$pagenumber);
		}else{
			$block = ceil(($pageNum+1)/$pagenumber)-1;
		}

		$first_page = ($block-1)*$pagenumber;
		$last_page  = $block*$pagenumber;

		$prev=$pageNum-1;
		$next=$pageNum+1;
		$go_page = $first_page+1;

		if($fn==""){
			$fn = "default_list_get";
		}

		if($total_block<=$block)
			$last_page=$total_page;

		$page_html="";

		if($totalCnt>0){
			$page_html.="<div class='paging'>";

			if($pageNum == "1"){
				$page_html.="<span class='prev'>
											<a href='javascript:void(0)' onclick='".$fn."(1);'><i class='fa fa-angle-double-left'></i></a><a href='javascript:void(0)'><i class='fa fa-angle-left'></i></a>
										 </span>";
			}else{
				$page_html.="<span class='prev'>
											 <a href='javascript:void(0)' onclick='".$fn."(1);'><i class='fa fa-angle-double-left'></i></a><a href='javascript:void(0)' onclick='".$fn."($prev);'> <i class='fa fa-angle-left'></i> </a>
										</span>";
			}

			for($go_page;$go_page<=$last_page;$go_page++){
				if($pageNum==$go_page)
					$page_html.="<a href=javascript:".$fn."($go_page);  class='on'>$go_page</a>";
				else
					$page_html.="<a href=javascript:".$fn."($go_page);>$go_page</a>";
			}

			if($total_page == $pageNum){
				$page_html.="<span class='next'>
											<a href='javascript:void(0)' ><i class='fa fa-angle-right'></i></a><a href='javascript:void(0)' > <i class='fa fa-angle-double-right'></i> </a>
										 </span>";
			}else{
				$page_html.="<span class='next'>
											 <a href='javascript:void(0)' onclick='".$fn."($next);'> <i class='fa fa-angle-right'></i> </a><a href='javascript:void(0)' onclick='".$fn."($last_page);'> <i class='fa fa-angle-double-right'></i> </a>
										 </span>";
			}
			$page_html.="</div>";
		}else{
			$page_html.="<div class='paging'></div>";
		}

		return $page_html;

	}


	function paging_2($totalCnt,$pageSize,$pageNum,$fn=""){

		$pagenumber=PAGENUMBER;

		$total_page  = ceil($totalCnt/$pageSize);
		$total_block = ceil($total_page/$pagenumber);

		if(($pageNum)%$pagenumber != 0){
			$block = ceil(($pageNum+1)/$pagenumber);
		}else{
			$block = ceil(($pageNum+1)/$pagenumber)-1;
		}

		$first_page = ($block-1)*$pagenumber;
		$last_page  = $block*$pagenumber;

		$prev    = $first_page;
		$next    = $last_page+1;
		$go_page = $first_page+1;

		if($fn == ""){
			$fn = "page_go_2";
		}

		if($total_block <= $block)
			$last_page = $total_page;

		$page_html="";
		if($totalCnt>0){
			$page_html.="<div class='paging'>";

			if($block>1){
				$page_html.="<span class='prev'>
										 	<a href='javascript:".$fn."(1);'><i class='fa fa-angle-double-left'></i></a><a href=javascript:".$fn."($prev);> <i class='fa fa-angle-left'></i> </a>
										 </span>";
			}else{
				$page_html.="<span class='prev'>
										 	<a href='javascript:".$fn."(1);'><i class='fa fa-angle-double-left'></i></a><a href='#'><i class='fa fa-angle-left'></i></a>
										 </span>";
			}

			for($go_page;$go_page<=$last_page;$go_page++){

				if($pageNum==$go_page)
					$page_html.="<a href=javascript:".$fn."($go_page);  class='on'>$go_page</a>";
				else
					$page_html.="<a href=javascript:".$fn."($go_page);>$go_page</a>";

			}

			if($block<$total_block){
				$page_html.="<span class='next'>
										 	<a href=javascript:".$fn."($next);> <i class='fa fa-angle-right'></i> </a><a href='javascript:".$fn."($total_page);'> <i class='fa fa-angle-double-right'></i> </a>
										 </span>";
			}else{
				$page_html.="<span class='next'>
										 	<a href='#'><i class='fa fa-angle-right'></i></a><a href='javascript:".$fn."($total_page);'> <i class='fa fa-angle-double-right'></i> </a>
										 </span>";
			}

			$page_html.="</div>";

		}else{
			$page_html.="<div class='paging'></div>";
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

	//엔터 \n을 <br>로 변경
	function textEnter($str){
		$str = str_replace("\n","<br/>",$str);

    return $str;
	}

  //엔터라인 제거
	function textEnterTrim($str){
		$arr = array("\r\n", "\r","\n");
		$str = str_replace($arr,"",$str);

		return $str;
	}

	// 띄어 쓰기 제거
	public function trimStr($str){
		$str = str_replace(" ","",$str);
		return $str;
	}

  // 핸드폰 형식세팅
	function set_phone_number($str){

		if($str){
			$rt = substr($str,0,3)."-".substr($str,3,4)."-".substr($str,7,4);
		}else{
			$rt ="";
		}
		return $rt;
	}

	// 전화번호 '-'기준으로 나누기
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

	// 서버 디렉토리와 파일명 조합
	function make_filename($sub_domain, $log_date) {

		$date = date("Y-m-d", strtotime($log_date));

		$str = "/home/krakenbeat/CI/".$sub_domain."/application/logs/log-".$date.".php";

		return $str;
	}

	// 서브도메인, 파일 있는지 체크
	function check_validation($sub_domain, $log_date) {

		$dir = "/home/krakenbeat/CI/".$sub_domain;

		if(!is_dir($dir)) {
			return false;
		}

		$dir .= "/application/logs";

		$handle  = opendir($dir);

		$files = array();
		while (false !== ($filename = readdir($handle))) {
	    if($filename == "." || $filename == ".."){
	        continue;
	    }
	    // 파일인 경우만 목록에 추가한다.
	    if(is_file($dir . "/" . $filename)) {
        $files[] = $filename;
	    }
		}

		closedir($handle);

		$files = implode(' ', $files);

		if(strpos($files, $log_date) !== false) {
			return true;
		}
	}

	// 핸드폰번호 하이폰 추가
	function format_phone($phone){
    $phone = preg_replace("/[^0-9]/", "", $phone);
    $length = strlen($phone);

    switch($length){
      case 11 :
          return preg_replace("/([0-9]{3})([0-9]{4})([0-9]{4})/", "$1-$2-$3", $phone);
          break;
      case 10:
          return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
          break;
      default :
          return $phone;
          break;
    }
	}

  //숫자 자릿수 한글로 변경
	function price_trans($number){

		$num = array('', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구');
		$unit4 = array('', '만', '억', '조', '경');
		$unit1 = array('', '십', '백', '천');

		$res = array();

		$number = str_replace(',','',$number);
		$split4 = str_split(strrev((string)$number),4);

		for($i=0;$i<count($split4);$i++){

			$temp = array();

			$split1 = str_split((string)$split4[$i], 1);

			for($j=0;$j<count($split1);$j++){

				$u = (int)$split1[$j];

				if($u > 0) $temp[] = $num[$u].$unit1[$j];

			}
			if(count($temp) > 0) $res[] = implode('', array_reverse($temp)).$unit4[$i];

		}

		echo implode('', array_reverse($res));
		echo "원";
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
	
	// qa 문의 유형
	function get_qa_type($str){
				
			switch ($str) {
				case '1' : $rt ='거래환불/분쟁 및 사기신고'; break;
				case '2' : $rt='계정 문의'; break;
				case '3' : $rt='판매 금지/거래 품목 문의'; break;
				case '4' : $rt='거래 평가 항목 관련 문의'; break;
				case '5' : $rt='게시글 노출, 미노출 문의'; break;
				case '6' : $rt='채팅, 알림'; break;
				case '7' : $rt='앱 사용/거래 방법 문의'; break;
				case '8' : $rt='커뮤니티 문의'; break;
				case '9' : $rt='검색 문의'; break;
				case '10' : $rt='기타 문의'; break;
				case '11' :$rt='오류 제보'; break;
				default : $rt=''; break;	
			}
		return $rt;
	}
	
	//faq 분류
	function get_faq_type($str){
	
		switch ($str) {
			case '1' : $rt='운영정책'; break;
			case '2' : $rt='계정/인증'; break;
			case '3' : $rt='구매/판매'; break;
			case '4' : $rt='거래품목'; break;
			case '5' : $rt='신뢰도 포인트'; break;
			case '6' : $rt='이용제재'; break;
			case '7' : $rt='기타'; break;
			case '8' : $rt='검색문의'; break;
			case '10' : $rt='오류 제보'; break;
			case '11' : $rt='커뮤니티 문의'; break;
			default : $rt=''; break;	

		}
		return $rt;
	}
	
}
?>

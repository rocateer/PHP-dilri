<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  function __construct(){
    parent::__construct();

		$this->load->library('global_function');
    $this->load->library('session');
		$this->load->library('email');
    $this->load->helper('url');
    $this->load->helper('version_mapping');

    $this->load->library('GCMPushMessage');

    /* Model */
    $this->load->model('gcm/model_gcm');


    // if(!$this->session->userdata("member_idx")){
    //
    //   $this->load->helper("url");
    //   redirect("/login");
    //   exit;
    //
    // }

    // if ($this->uri->segment(1)!="member" && $this->uri->segment(2)!="member_pwd_change_key_check" && ($this->uri->segment(2)!="course_share_view" || $this->uri->segment(1)!="course")) {
    //   if($this->uri->segment(1)!="login" && $this->uri->segment(1)!="main" && $this->uri->segment(1)!="faq" && $this->uri->segment(1)!="cscenter" && $this->uri->segment(1)!="notice" && $this->uri->segment(1)!="product" ) {
    //     if(!$this->session->userdata("member_idx")) {
    //       $this->load->helper("url");
    //       redirect("/login");
    //       exit;
    //     }
    //   }else if($this->uri->segment(1)=="login") {
    //     if($this->session->userdata("member_idx")) {
    //       $this->load->helper("url");
    //        redirect("/mypage");
    //        exit;
    //     }
    //   }
    // }



  //  $this->load->helper("url");
  //  echo $this->uri->segment(0);
    // if($this->uri->segment(0) == "api"){
    //   $version_path = $_SERVER['REQUEST_URI'];
    //   $url = str_replace("/api", "", $version_path);
    //   $uri = "http://api.life-planner.xyz/".$url;
    //   echo $version_path;
    //   redirect($uri);
    // }


  }

  function _view($view, $array="") {

    $this->load->view("common/inc/header");
    $this->load->view($view, $array);
    $this->load->view("common/inc/footer");

  }


  function _view2($view, $array="") {

    $this->load->view($view, $array);

  }

  function _view3($view, $array="") {
    $this->load->view("common/inc/header");
    $this->load->view($view, $array);
  }
  
  function _list_view($view, $array="") {
    $this->load->view($view, $array);
  }


  function _escstr($str) {
    $str=str_replace("\r\n","",$str);
      return trim($str);
  }

  // 알림 등록
  function _alarm_action($member_idx,$corp_idx,$index,$alarm_data) {
   // $sgcm = new GCMPushMessage();
   // $sgcm->setApiKey(GCM_KEY_1);
  
   $data['member_idx']=$member_idx;
   $data['corp_idx']=$corp_idx;
   $data['index']=$index;
   
   if ($index=='101') {
     $data['keywords']=$alarm_data['keywords'];
   }
  
   $member_search  = $this->model_gcm->member_search($data);//회원정보 가져오기
  
   foreach($member_search as $row){
     $data['member_idx'] = $row->member_idx;
     $data['corp_idx'] = $row->corp_idx;
     $data['gcm_key'] = $row->gcm_key;
     $data['device_os'] = $row->device_os;
  
     if ($row->current_lang=='kr') {
			switch ($index) {
				case '101' : $msg ="키워드 '".$row->keyword."'에 대한 새로운 중고거래 글이 등록 되었습니다.";$data['product_idx']=$alarm_data['product_idx']; break;
				case '102' : $msg ="구매자의 새로운 메시지가 도착 하였습니다.";$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
				case '103' : $msg ="판매자의 새로운 메시지가 도착 하였습니다.";$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
				case '104' : $msg ="거래가 종료 되었습니다. 판매자를 평가하여 주세요.";$data['tab_type']='2'; break;
				case '105' : $msg ="등록하신 게시글에 새로운 댓글이 작성 되었습니다.";$data['tab_type']='3'; break;
				case '106' : $msg ="문의하신 1:1 문의에 답변이 작성 되었습니다.";$data['qa_idx']=$alarm_data['qa_idx']; break;
				case '107' : $msg ="새로운 평가가 완료 되었습니다.";$data['tab_type']='1'; break;
				case '108' : $msg ="새로운 나눔 평가가 완료 되었습니다.";$data['tab_type']='1'; break;
				case '109' : $msg ="알림 요청 하신 예약이 취소된 중고거래 글이 있습니다.";$data['product_idx']=$alarm_data['product_idx']; break;
				case '113' : $msg ="관리자가 등록하신 중고거래 글을 블라인드 처리 하였습니다.";$data['product_idx']=$alarm_data['product_idx']; break;
				case '114' : $msg ="관리자가 등록하신 게시글을 글을 블라인드 처리 하였습니다.";$data['board_idx']=$alarm_data['board_idx']; break;
			}
		} elseif ($row->current_lang=='bd') {
			switch ($index) {
				case '101' : $msg ="নতুন পোস্ট আপলোড হয়েছে। '".$row->keyword."'নতুন পোস্ট আপলোড হয়েছে।";$data['product_idx']=$alarm_data['product_idx']; break;
				case '102' : $msg ="নতুন মেসেজ (ক্রেতা)";$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
				case '103' : $msg ="নতুন মেসেজ (বিক্রেতা)";$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
				case '104' : $msg ="লেনদেন সম্পন্ন হয়েছে। দয়া করে ক্রেতাকে নাম্বারিং করুন।";$data['tab_type']='2'; break;
				case '105' : $msg ="নতুন কমেন্ট এসেছ";$data['tab_type']='3'; break;
				case '106' : $msg ="আপনার প্রশ্নের উত্তর তৈরি।";$data['qa_idx']=$alarm_data['qa_idx']; break;
				case '107' : $msg ="একটি নতুন দাম আপডেট করা হয়েছে।";$data['tab_type']='1'; break;
				case '108' : $msg ="ফ্রি শেয়ারিং এর একটি নতুন দাম আপডেট করা হয়েছে।";$data['tab_type']='1'; break;
				case '109' : $msg ="নোটিফিকেশনঃ বুকিং বাতিল হয়েছে।";$data['product_idx']=$alarm_data['product_idx']; break;
				case '113' : $msg ="관리자가 등록하신 중고거래 글을 블라인드 처리 하였습니다.";$data['product_idx']=$alarm_data['product_idx']; break;
				case '114' : $msg ="관리자가 등록하신 게시글을 글을 블라인드 처리 하였습니다.";$data['board_idx']=$alarm_data['board_idx']; break;
			}
		} else {
			switch ($index) {
				case '101' : $msg ="New post has been uploaded of '".$row->keyword."'";$data['product_idx']=$alarm_data['product_idx']; break;
				case '102' : $msg ="New Message from Buyer";$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
				case '103' : $msg ="New Message from Seller";$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
				case '104' : $msg ="Deal has compeleted, please give star(or point)to seller";$data['tab_type']='2'; break;
				case '105' : $msg ="new comment posted";$data['tab_type']='3'; break;
				case '106' : $msg ="The answer of your question is ready";$data['qa_idx']=$alarm_data['qa_idx']; break;
				case '107' : $msg ="A new rate has been compeleted";$data['tab_type']='1'; break;
				case '108' : $msg ="A new rate of free sharing has been compeleted";$data['tab_type']='1'; break;
				case '109' : $msg ="Notification, Booking cancled";$data['product_idx']=$alarm_data['product_idx']; break;
				case '113' : $msg ="관리자가 등록하신 중고거래 글을 블라인드 처리 하였습니다.";$data['product_idx']=$alarm_data['product_idx']; break;
				case '114' : $msg ="관리자가 등록하신 게시글을 글을 블라인드 처리 하였습니다.";$data['board_idx']=$alarm_data['board_idx']; break;
			}
		}
  
     $data['title']=  "";
     $data['msg']=  $msg;
     $data["index"] =$index;
     $body_loc_key = $index;
     $body_loc_args =[""];
  
     $data["alarm_yn"] =$row->alarm_yn;
  
     $this->model_gcm->member_gcm_in($data); //회원 gcm 입력
  
     // if($data['gcm_key']){
     //   if($data["alarm_yn"]=="Y"){
     //     $sgcm->setDevices($data['gcm_key']);
     //     $response = $sgcm->send($data['msg'],$data['device_os'],$data,"",$body_loc_key,$body_loc_args,"");
     //   }
     // }
   }
  }

  // 웹뷰에서 메일 보내기
  function _web_sendmail($to,$subject,$message,$from_email="",$from_name=""){

    $config = array();
    $config['useragent'] = 'CodeIgniter';
    $config['mailpath']  = '/usr/sbin/sendmail';
    $config['protocol']  = 'smtp';
    $config['smtp_host'] = SMTP_HOST;
    $config['smtp_user'] = SMTP_USER;
    $config['smtp_pass'] = SMTP_PASS;
    $config['smtp_port'] = SMTP_PORT;
    $config['smtp_crypto'] = 'ssl';
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['wordwrap'] = TRUE;

    $this->email->initialize($config);
    $this->email->clear(TRUE);
    if($from_email ==""){
      $this->email->from(FROM_EMAIL, FROM_NAME);
    }else{
      $this->email->from($from_email, $from_name);
    }
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($message);

    $result=$this->email->send();

    return $result;
  }

  function user_agent(){
    $iPod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $iPhone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $iPad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    //file_put_contents('./public/upload/install_log/agent',$_SERVER['HTTP_USER_AGENT']);
    if($iPad||$iPhone||$iPod){
      return 'ios';
    }else if($android){
      return 'android';
    }else{
      return 'pc';
    }
  }
  // crontab으로 메일 보내기
  function _cron_sendmail($to,$subject,$message,$from_email="",$from_name=""){

    $config = array();
    $config['useragent'] = 'CodeIgniter';
    $config['mailpath']  = '/usr/sbin/sendmail';
    $config['protocol']  = 'smtp';
    $config['smtp_host'] = SMTP_HOST;
    $config['smtp_user'] = SMTP_USER;
    $config['smtp_pass'] = SMTP_PASS;
    $config['smtp_port'] = SMTP_PORT;
    $config['smtp_crypto'] = 'ssl';
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['wordwrap'] = TRUE;

    $this->email->initialize($config);
    $this->email->clear(TRUE);
    if($from_email ==""){
      $this->email->from(FROM_EMAIL, FROM_NAME);
    }else{
      $this->email->from($from_email, $from_name);
    }
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($message);

    $result=$this->email->send();
    // var_dump($this->email->print_debugger(array('headers', 'subject', 'body')));
    // exit;
    return $result;
  }


	// method 타입 자동 구별
	/*	function _input_check($data, $msg=["빈값체크 메세지", "정규표현식 메세지"], $esc=true, $empty=false, $type="default", $custom = ""){ */
	function _input_check($key,$data){

		/*
		.  ____  .    ____________________________
		|/      \|   | 유효성검사를 응원합니다.         |
	 [| ♥    ♥ |]  | ver 0.1                    |
		|___==___|  /          written by JAZZ.   |
								 |____________________________|
			 ---------------------------------------------------------------------------------
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
			|             price    : 숫자에 3자리 마다 콤마표기
			|            	default  : default, 검사를 안합니다.
			| $custom 	: 유효성검사 custom으로 진행 시 받을 값 (정규표현식)
			|
			|  !!!. 값이 array형태로 들어올 경우
			| $this->_input_check("파라미터로 받을 변수명[]");
			| 형태로 받는다.
			|_________________________________________________________________________________|
		*/

		// 빈값 메시지
		if(array_key_exists('empty_msg',$data)){
			$empty_msg = $data['empty_msg'];
			$empty = TRUE;
		}else{
			$empty_msg = "";
			$empty = FALSE;
		}
		// 포커스 ID
		if(array_key_exists('focus_id',$data)){
			$focus_id = $data['focus_id'];
		}else{
			$focus_id = "";
		}
		// 정규식 메시지
		if(array_key_exists('regular_msg',$data)){
			$regular_msg = $data['regular_msg'];
		}else{
			$regular_msg = "";
		}
		// 개행 문자 체크
		if(array_key_exists('esc',$data)){
			$esc = $data['esc'];
		}else{
			$esc = TRUE;
		}
		//정규식 타입
		if(array_key_exists('type',$data)){
			$type = $data['type'];
		}else{
			$type = "default";
		}
		// 정규식 커스텀 체크
		if(array_key_exists('custom',$data)){
			$custom = $data['custom'];
		}else{
			$custom = "custom";
		}
		// 삼항 연산자 체크
		if(array_key_exists('ternary',$data)){
			$ternary = $data['ternary'];
		} else{
			$ternary = "";
		}
	//	$key = $key;

		# method 확인
		$key = trim($key);

		# 1. post 타입인가?
		$method = "post";
		$var = $this->input->post($key, true) ? $this->input->post($key, true) : $ternary;

		if($var == ""){
			$var = array_key_exists($key,$_POST)? $_POST[$key] : "";
		}

		# 2. get 타입인가?
		if($var == ""){
			$method = "get";
			$var = $this->input->get($key, true) ? $this->input->get($key, true) : $ternary;

			if($var == ""){
				$var = array_key_exists($key,$_GET)? $_GET[$key] : "";
			}
		}



		/* 보류

		# 3. 다른 타입인가?
		if($var == ""){
			$method = $_SERVER['REQUEST_METHOD'];
			$method = strtolower($method);

			$var2 = parse_str(file_get_contents('php://input'), $put);
			var_dump($var2);
			exit;


			$var = array_key_exists($key,$_PUT)? $_PUT[$key] : "";

			vardump($_PUT);
		}
		*/
		/* 삼항 연산자 체크 */

		# -. 모두 찾을수 없는가?
		if($method == ""){
			$method = "not found";
			$message = "요청한 method type을 확인하세요.";
			$var = "찾을수 없습니다.";
			goto input_echo;
		}

		# 개행문자 제거 요청일 시
		if($esc){
			$var = str_replace("/\r|\n/","", $var);
			if(!is_array($var)){
				$var = trim($var);
			}
		}



		# 빈값 체크를 할 경우
		if($empty == true){
			if($var == ""){
				$message = $empty_msg;
				goto input_echo;
			}
		}else{
			if(is_array($var) == true){
				$x = 0;
				$var_arr = array();

				foreach ($var as $row) {
					if($row ==""){
						$var_arr[$x] = NULL;
					}else{
						$var_arr[$x] = $row;
					}
					$x++;
				}

				$var = $var_arr;
			}else{
				if($var == ""){
					$var = NULL;
				}
			}
		}

		# 유효성검사 타입 확인
		$validate_check = true;

		$type = strtolower($type);
		switch($type){
			# 숫자 유효성 검사
			case "number" :
				// if(!preg_match("/^\d+$/", $var)){
				if(!is_numeric($var)){
					$validate_check = false;
				}
				break;

			# 이메일 양식 유효성 검사
			case "email" :
				if(!preg_match("/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $var)){
					$validate_check = false;
				}
				break;

			# 비밀번호 양식 유효성 검사
			case "password" :
				if(!preg_match("/^.*(?=.{6,12})(?=.*[0-9])(?=.*[a-zA-Z]).*$/", $var)){
					$validate_check = false;
				}
				break;

			# 전화번호 양식1 : (- 미포함)
			case "tel1" :
				break;

			# 전화번호 양식2 : (- 포함)
			case "tel2" :
				break;

			case "phone":
				if(!preg_match("/^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/", $var)){
				$validate_check = false;
				}
				break;
			# 숫자에 3자리 마다 콤마표기
			case "price":
				$var = str_replace(',','',$var);
			break;
			# custom 요청 일 시.
			case "custom" :
				if(!preg_match($custom, $var)){
					$validate_check = false;
				}
				break;

			case "default" :
			default :
				break;

		}

		if(!$validate_check){
			$message = $regular_msg;
			goto input_echo;
		}

		# 모두 통과
		return $var;

		# input 검사 실패 시 나오는 메세지. label
		input_echo:

		$response['code'] = "-1";
		$response['code_msg'] = $message;
		$response['method'] = $method;
		$response['focus_id'] = $focus_id;
		$response[$key] = $var;

		echo json_encode($response);
		exit;

	} // end input check
}
?>

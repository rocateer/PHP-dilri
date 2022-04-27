<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  function __construct(){
    parent::__construct();
    /* Helper */
    $this->load->helper('empty_message');
    $this->load->helper('version_mapping');
    $this->load->helper('empty_message');
    $this->load->helper('cookie');

    /* Library */
		$this->load->library('global_function');
    $this->load->library('global_msg');
    $this->load->library('session');
		$this->load->library('email');
    $this->load->library('session');
    $this->load->model('common/model_common');


    /* 다국어 세팅*/
    $this->load->helper('url');

    // echo get_cookie('current_nation');
    // exit;

    if(get_cookie('member_idx') !=""){
      $member_data = array(
        "member_idx" => get_cookie('member_idx'),
        "member_id" => get_cookie('member_id'),
        "app_yn" => get_cookie('app_yn'),
        "current_nation" => get_cookie('current_nation'),
        "gcm_key" => get_cookie('gcm_key'),
        "device_os" => get_cookie('device_os'),
        "uuid" => get_cookie('uuid'),
      );
      $this->session->set_userdata($member_data);

      $this->member_idx = get_cookie('member_idx');
      $this->member_id = get_cookie('member_id');
      $this->app_yn = get_cookie('app_yn');
      $this->current_nation = get_cookie('current_nation');
      $this->gcm_key = get_cookie('gcm_key');
      $this->device_os = get_cookie('device_os');
      $this->uuid = get_cookie('uuid');

    }else{
      $this->member_idx = $this->session->userdata("member_idx");
      $this->member_id = $this->session->userdata("member_id");
      $this->app_yn = $this->session->userdata("app_yn");
      $this->current_nation = $this->session->userdata("current_nation");
      $this->gcm_key = $this->session->userdata("gcm_key");
      $this->device_os = $this->session->userdata("device_os");
      $this->uuid = $this->session->userdata("uuid");
    }
    $this->current_nation = !empty($this->current_nation)?$this->current_nation:'bd';

    $seg1 = $this->uri->segment(1);
    $seg2 = $this->uri->segment(2);
    $seg3 = $this->uri->segment(3);

    $lang_check = array(
        "kr",
        "bd",
        "us"
    );

    // echo "app_yn : ".$this->app_yn;
    // exit;
    if (!in_array($this->uri->segment(1), $lang_check)) {
      redirect("/".$this->current_nation."/".$seg1);
    }

    // if (empty($this->current_nation)) {
    //   $this->current_nation='us';
    // }
    
    if($this->session->userdata('member_idx') ){
      if( $this->uri->segment(2) == mapping("login") || $this->uri->segment(2) == mapping("logout") || $this->uri->segment(2) == mapping("find_id") ||  $this->uri->segment(2) == mapping("find_pw")){
      
      }elseif ($this->uri->segment(2) == "" ) {
        $member_detail=$this->model_common->member_detail();
        $seg1 = !empty($member_detail->current_lang)?$member_detail->current_lang:$seg1;
        $this->member_del_yn = $member_detail->del_yn;
        $this->member_uuid = $member_detail->uuid;

      }else{
        $member_detail=$this->model_common->member_detail();
        $seg1 = !empty($member_detail->current_lang)?$member_detail->current_lang:$seg1;
        $this->member_del_yn = $member_detail->del_yn;
        $this->member_uuid = $member_detail->uuid;

        // $current_lang = !empty($member_detail->current_lang)?$member_detail->current_lang:'us';
        // switch($current_lang) {
        //   case "kr" : $lang = "KOR";$this->current_nation = "kr"; break;
        //   case "bd" : $lang = "BDT";$this->current_nation = "bd"; break;
        //   case "us" : $lang = "ENG";$this->current_nation = "us"; break;
        //   default : $lang = "ENG";$this->current_nation = "us"; break;
        // }
        
        // $this->curlang = $lang;
        // var_dump($lang);
        // var_dump($member_detail->gcm_key);
        // exit;
        // if ($member_detail->del_yn != 'N') {
        //   if ($this->current_nation=='kr') {
        //     $this->global_function->_alert_logout("해당 계정이 이용정지 되었습니다. 관리자에게 문의해주세요.");
        //   } else if ($this->current_nation=='us'){
        //     $this->global_function->_alert_logout("해당 계정이 이용정지 되었습니다. 관리자에게 문의해주세요.");
        //   } else if ($this->current_nation=='bd'){
        //     $this->global_function->_alert_logout("해당 계정이 이용정지 되었습니다. 관리자에게 문의해주세요.");
        //   }

        //   // $this->global_function->_alert_logout("해당 계정이 이용정지 되었습니다. 관리자에게 문의해주세요.");
        //   // redirect("/".mapping('logout'));
        //   exit;

        // }

        // if (!empty($this->uuid)) {
		    //   $logout_yn = !empty($_REQUEST['logout_yn'])?$_REQUEST['logout_yn']:'N';

        //   if ( $this->uuid != $member_detail->uuid && $logout_yn!='Y' ) {
        //     if ($this->current_nation=='kr') {
        //       $this->global_function->_alert_logout("다른 기기에서 로그인되었습니다.".$this->uri->segment(2), $this->app_yn, $this->_user_agent(), $this->current_nation);
        //     } else if ($this->current_nation=='us'){
        //       $this->global_function->_alert_logout("다른 기기에서 로그인되었습니다.".$this->uri->segment(2), $this->app_yn, $this->_user_agent(), $this->current_nation);
        //     } else if ($this->current_nation=='bd'){
        //       $this->global_function->_alert_logout("다른 기기에서 로그인되었습니다.".$this->uri->segment(2), $this->app_yn, $this->_user_agent(), $this->current_nation);
        //     }
        //     // redirect("/".mapping('logout'));
        //   }
        // }

        // if (!empty($this->device_os) || !empty($this->gcm_key)) {
        //   if ( (($this->gcm_key != $member_detail->gcm_key) || ($this->device_os != $member_detail->device_os)) && !(empty($this->device_os) && empty($this->gcm_key)) ) {
        //     if ($this->current_nation=='kr') {
        //       $this->global_function->_alert_logout("다른 기기에서 로그인되었습니다.".$this->session->userdata('member_idx'));
        //     } else if ($this->current_nation=='us'){
        //       $this->global_function->_alert_logout("다른 기기에서 로그인되었습니다.".$this->session->userdata('member_idx'));
        //     } else if ($this->current_nation=='bd'){
        //       $this->global_function->_alert_logout("다른 기기에서 로그인되었습니다.".$this->session->userdata('member_idx'));
        //     }
        //     // redirect("/".mapping('logout'));
        //   }
        // }


        // $this->gcm_key = $member_detail->gcm_key;
        // $this->device_os = $member_detail->device_os;
      }
      
    }

    // echo $seg1;
    // exit;

    $lang_check_val = false;
    for($i=0;$i<count($lang_check);$i++){
        if($lang_check[$i] == $seg1){
            $lang_check_val = true;
        }
    }

    // if(!$lang_check_val){
    //     redirect("http://".$_SERVER["HTTP_HOST"]."/kr");
    //     exit;
    // }

    ######################## 국가 세팅 ###############################
    $this->nationcode = $this->current_nation;
    $this->category = $seg2;

    #####################  기본 언어 세팅 ######################
    if($this->input->cookie("lang", TRUE)) {

        $this->curlang = $this->input->cookie("lang", TRUE);
        $lang = $this->curlang;
    } else {

        // switch($this->current_nation) {
        switch($seg1) {
            case "kr" : $lang = "KOR";$this->current_nation = "kr"; break;
            case "bd" : $lang = "BDT";$this->current_nation = "bd"; break;
            case "us" : $lang = "ENG";$this->current_nation = "us"; break;
            default : $lang = "BDT";$this->current_nation = "bd"; break;
        }
        set_cookie('current_nation', $this->current_nation, 3600*24*365);
        $_SESSION['current_nation'] = $this->current_nation;
        $this->curlang = $lang;
    }

    
    $this->load->helper("language");
    $this->lang->load("all", $lang);
    // $lang = !empty($lang)?$lang:'us';

    /* Model */
    $this->load->model('gcm/model_gcm');

    
    // set_cookie('current_nation', $current_lang, 3600*24*365);
    // $_SESSION['current_nation'] = $current_lang;
    // $this->load->helper("language");
    // $this->lang->load("all", $lang);
    // echo "/".$current_lang;
    // exit;

    $this->load->helper("url");
    echo $this->uri->segment(0);
    // if($this->uri->segment(0) == "api"){
    //   $version_path = $_SERVER['REQUEST_URI'];
    //   $url = str_replace("/api", "", $version_path);
    //   $uri = "http://api.life-planner.xyz/".$url;
    //   echo $version_path;
    //   redirect($uri);
    // }

    // $this->member_idx = 36;
  }


  function _view($view, $array="") {
    $response = new stdClass();

    $response->agent = $this->_user_agent();

    $this->load->view("common/inc/header", $response);
    $this->load->view($view, $array);
    $this->load->view("common/inc/footer");
    // $this->load->view("common/inc/block", $response);

  }
  function _view2($view, $array="") {
    $response = new stdClass();

    $response->agent = $this->_user_agent();
    $this->load->view("common/inc/header", $response);
    $this->load->view($view, $array);
    // $this->load->view("common/inc/block", $response);

  }

  function _view3($view, $array="") {
    $response = new stdClass();

    $response->agent = $this->_user_agent();
    $this->load->view("common/inc/header", $response);
    $this->load->view($view, $array);

  }

  function _list_view($view, $array="") {
    $response = new stdClass();

    $response->agent = $this->_user_agent();
    $this->load->view($view, $array);
    $this->load->view("common/inc/block", $response);

  }

  function _ajax_view($view, $array="") {

    $this->load->view($view, $array);

  }

  function _view_pop($view, $array=""){

		$this->load->view("common/inc/header");
		$this->load->view($view, $array);

	}

  function _view_sub($view, $array="") {

    $this->load->view("common/inc/header");
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
     $data['title']=$alarm_data['title'];
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
         case '112' : $msg ="등록하신 댓글에 새로운 답글이 작성 되었습니다.";$data['board_idx']=$alarm_data['board_idx']; break;
         case '106' : $msg ="문의하신 1:1 문의에 답변이 작성 되었습니다.";$data['qa_idx']=$alarm_data['qa_idx']; break;
         case '107' : $msg ="새로운 평가가 완료 되었습니다.";$data['tab_type']='1'; break;
         case '108' : $msg ="새로운 나눔 평가가 완료 되었습니다.";$data['tab_type']='1'; break;
         case '109' : $msg ="알림 요청 하신 예약이 취소된 중고거래 글이 있습니다.";$data['product_idx']=$alarm_data['product_idx']; break;
       }
     } elseif ($row->current_lang=='bd') {
       switch ($index) {
         case '101' : $msg ="নতুন পোস্ট আপলোড হয়েছে। '".$row->keyword."'নতুন পোস্ট আপলোড হয়েছে।";$data['product_idx']=$alarm_data['product_idx']; break;
         case '102' : $msg ="নতুন মেসেজ (ক্রেতা)";$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
         case '103' : $msg ="নতুন মেসেজ (বিক্রেতা)";$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
         case '104' : $msg ="লেনদেন সম্পন্ন হয়েছে। দয়া করে ক্রেতাকে নাম্বারিং করুন।";$data['tab_type']='2'; break;
         case '105' : $msg ="নতুন কমেন্ট এসেছ";$data['tab_type']='3'; break;
         case '112' : $msg ="등록하신 댓글에 새로운 답글이 작성 되었습니다.";$data['board_idx']=$alarm_data['board_idx']; break;

         case '106' : $msg ="আপনার প্রশ্নের উত্তর তৈরি।";$data['qa_idx']=$alarm_data['qa_idx']; break;
         case '107' : $msg ="একটি নতুন দাম আপডেট করা হয়েছে।";$data['tab_type']='1'; break;
         case '108' : $msg ="ফ্রি শেয়ারিং এর একটি নতুন দাম আপডেট করা হয়েছে।";$data['tab_type']='1'; break;
         case '109' : $msg ="নোটিফিকেশনঃ বুকিং বাতিল হয়েছে।";$data['product_idx']=$alarm_data['product_idx']; break;
       }
     } else {
       switch ($index) {
         case '101' : $msg ="New post has been uploaded of '".$row->keyword."'";$data['product_idx']=$alarm_data['product_idx']; break;
         case '102' : $msg ="New Message from Buyer";$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
         case '103' : $msg ="New Message from Seller";$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
         case '104' : $msg ="Deal has compeleted, please give star(or point)to seller";$data['tab_type']='2'; break;
         case '105' : $msg ="new comment posted";$data['tab_type']='3'; break;
         case '112' : $msg ="등록하신 댓글에 새로운 답글이 작성 되었습니다.";$data['board_idx']=$alarm_data['board_idx']; break;

         case '106' : $msg ="The answer of your question is ready";$data['qa_idx']=$alarm_data['qa_idx']; break;
         case '107' : $msg ="A new rate has been compeleted";$data['tab_type']='1'; break;
         case '108' : $msg ="A new rate of free sharing has been compeleted";$data['tab_type']='1'; break;
         case '109' : $msg ="Notification, Booking cancled";$data['product_idx']=$alarm_data['product_idx']; break;
       }
     }


     // switch ($index) {
     //   case '101' : $msg =lang("lang_alarm_00022_0","키워드 '").$row->keyword.lang("lang_alarm_00022_1","'에 대한 새로운 중고거래 글이 등록 되었습니다.");$data['product_idx']=$alarm_data['product_idx']; break;
     //   case '102' : $msg =lang("lang_alarm_00023","구매자의 새로운 메시지가 도착 하였습니다.");$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
     //   case '103' : $msg =lang("lang_alarm_00024","판매자의 새로운 메시지가 도착 하였습니다.");$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
     //   case '104' : $msg =lang("lang_alarm_00025","거래가 종료 되었습니다. 판매자를 평가하여 주세요.");$data['tab_type']='2'; break;
     //   case '105' : $msg =lang("lang_alarm_00026","등록하신 게시글에 새로운 댓글이 작성 되었습니다.");$data['tab_type']='3'; break;
     //   case '106' : $msg =lang("lang_alarm_00027","문의하신 1:1 문의에 답변이 작성 되었습니다.");$data['qa_idx']=$alarm_data['qa_idx']; break;
     //   case '107' : $msg =lang("lang_alarm_00028","새로운 평가가 완료 되었습니다.");$data['tab_type']='1'; break;
     //   case '108' : $msg =lang("lang_alarm_00029","새로운 나눔 평가가 완료 되었습니다.");$data['tab_type']='1'; break;
     //   case '109' : $msg =lang("lang_alarm_00030","알림 요청 하신 예약이 취소된 중고거래 글이 있습니다.");$data['product_idx']=$alarm_data['product_idx']; break;
     // }

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

  /*
  - cafe24 SMS 호스팅서비스 모듈
  - cafe24 SMS 호스팅서비스 가입 후 사용
  - 사용 전 가입자 아이디 / 인증키 / 발신번호등록 필수!
  - sendSMS(보낼메시지, 받는사람번호)
    (string, string)
  */
  function _sendSMS_cafe24($msg, $tel_num){

    $userid = "";	// SMS 아이디
    $passwd = ""; // 인증키

    $oCurl = curl_init();
    $url =  "https://sslsms.cafe24.com/smsSenderPhone.php";
    $aPostData['userId'] = $userid;
    $aPostData['passwd'] = $passwd;
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_POST, 1);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS, $aPostData);
    curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, 0);
    $ret = curl_exec($oCurl);
    $ret = json_decode($ret);
    $sphone = explode('-',$ret->list[0]);

    $sms_url = "https://sslsms.cafe24.com/sms_sender.php";
    $sms['user_id'] = base64_encode($userid);
    $sms['secure'] = base64_encode($passwd);
    $sms['msg'] = base64_encode(stripslashes($msg)); // 보낼 메시지
    $sms['rphone'] = base64_encode($tel_num); // 받는사람 번호
    $sms['sphone1'] = base64_encode($sphone[0]);
    $sms['sphone2'] = base64_encode($sphone[1]);
    // $sms['sphone3'] = base64_encode($sphone[2]);
    $sms['mode'] = base64_encode("1");
    $returnurl = "";
    $host_info = explode("/", $sms_url);
    $host = $host_info[2];
    $path = $host_info[3];
    srand((double)microtime()*1000000);
    $boundary = "---------------------".substr(md5(rand(0,32000)),0,10);
    $header = "POST /".$path ." HTTP/1.0\r\n";
    $header .= "Host: ".$host."\r\n";
    $header .= "Content-type: multipart/form-data, boundary=".$boundary."\r\n";
    $data1 = "";
    foreach($sms AS $index => $value){
      $data1 .="--$boundary\r\n";
      $data1 .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
      $data1 .= "\r\n".$value."\r\n";
      $data1 .="--$boundary\r\n";
    }
    $header .= "Content-length: " . strlen($data1) . "\r\n\r\n";
    $fp = fsockopen($host, 80);
    fputs($fp, $header.$data1);
    $rsp = '';
    while(!feof($fp)) {
      $rsp .= fgets($fp,8192);
    }
    fclose($fp);
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

  function _user_agent(){
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

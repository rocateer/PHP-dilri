<!DOCTYPE html>
<html lang="kor">
<head>
  <!--타이틀 :	title 태그와 파비콘만 사용-->
  <title>딜리</title>
  <link rel="shortcut icon" href="/images/favicon.png">

  <!--메타 : 메타 태그만 사용-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="format-detection" content="telephone=no">

  <!--내부 기본 CSS : 내부에서 생성한 CSS만 사용-->
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/p_common.css">
  <link rel="stylesheet" href="/css/style.css">

  <!--외부 CSS : 외부 모듈에서 제공된 CSS만 사용-->
  <link rel="stylesheet" href="/external_css/swiper.css">
  <link rel="stylesheet" href="/external_css/jquery.tag-editor.css">
  <link rel="stylesheet" href="/external_css/swiper-bundle.min.css">

  <!--외부 CSS 커스텀 : 외부 모듈 적용 후 자체적으로 CSS변경 한 경우만 사용-->
  <link rel="stylesheet" href="/external_css/outside.css">

  <!--내부 기본 JS : 내부에서 생성한 JS 경우만 사용 하며. 이를 사용하기 위한 라이브러만사용(jquery.js) -->
  <script src="/js/jquery-1.12.4.min.js"></script>
  <script src="/js/jquery-ui.js"></script>
  <script src="/js/common.js"></script>

  <!--외부 JS : 외부 모듈에서 제공된 JS만 사용-->
  <script src="/external_js/swiper.jquery.js"></script>
  <script src="/external_js/swiper-bundle.min.js"></script>
  <script src="/external_js/jquery.tag-editor.js"></script>
  <script src="/js/jquery.caret.min.js"></script>

</head>
<script>
var member_idx ="<?=$this->member_idx?>";
var app_yn ="<?=$this->app_yn?>";
var agent ="<?=$agent?>";
var uuid = "<?=$this->uuid?>";
var member_uuid = '<?=@$this->member_uuid?>';

if (uuid!="" && member_uuid != "" && uuid != member_uuid) {
  if(app_yn=="Y"){
    api_request_logout();
    setTimeout(function() {
      alert("다른 기기에서 로그인되었습니다.");
      location.href= "/<?=$this->nationcode.'/'.mapping('logout')?>/double_login_logout";
    }, 1000);
  }else{
    alert("다른 기기에서 로그인되었습니다.");
    location.href= "/<?=$this->nationcode.'/'.mapping('logout')?>/double_login_logout";
  }
}

//브릿지::로그아웃
function api_request_logout(){

  if( agent == 'android') {
    window.rocateer.request_logout();
  } else if ( agent == 'ios') {
    var message = {
                  "request_type" : "request_logout"
                  };
    window.webkit.messageHandlers.native.postMessage(message);
  }
}

// alert(`uuid : '<?=get_cookie('uuid')?>'  agent : ${agent} / app_yn : ${app_yn}`);


// 새로운 대화가 있을 때
function update_chatting(){
  if ('<?=$this->uri->segment(2)?>'=='<?=mapping('chatting')?>') {
    new_chatting_room_list();
	}
}

//로그인 체크
function COM_login_check(member_idx,return_url){
  if(member_idx ==""){
    alert("<?=lang("lang_main_00137","로그인이 필요합니다.")?>");
    location.href= "/<?=$this->nationcode.'/'.mapping('login')?>?return_url="+return_url;
    return false;
  }else{
    return true;
  }
}

// 프로필 입력 체크
function COM_profile_check(member_idx,return_url,fnc){
  
  if(member_idx ==""){
    if (!confirm('<?=lang("lang_main_00137","로그인이 필요합니다. 로그인 하시겠습니까?")?>')) {
      return;
    }
    location.href= "/<?=$this->nationcode.'/'.mapping('login')?>?return_url="+return_url;
    return false;
  }
  
  var formData = {
    "member_idx" : member_idx
  };
  
  $.ajax({
    url      : "/<?=$this->nationcode?>/common/COM_profile_check",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){

      if(result.del_yn=='P'){
        alert('<?=lang("lang_product_00191", "이용 정지된 회원입니다.")?>')
        return;
      }

      if(result.code == "0"){
        if (!confirm('<?=lang("lang_main_00138","이용을 위해서 추가 정보가 필요합니다.")?>')) {
          return;
        }
        location.href= "/<?=$this->nationcode.'/'.mapping('login')?>/add_info_reg?return_url="+return_url+"&member_idx="+member_idx;
        return;
      }
      if (fnc) {
        eval(fnc);
      }
      return;
    }
  });
  
}


// 외부링크 이동 :: 사업자 정보 확인 및 배너 링크 이동
function api_request_external_link(url){
 if(agent == 'android') {
   window.rocateer.request_external_link(url);
 } else if (agent == 'ios') {
   var message = {
                  "request_type" : "request_external_link",
                  "url" : url,
                 };
   window.webkit.messageHandlers.native.postMessage(message);
 }
}

// 회원상태 체크

function history_back_fn(){

  if(window.history.length==1){
    location.href = '/<?=$this->nationcode.'/'.mapping('main')?>';
  }else{
    history.go(-1);
  }
}

// function setCookie(name, value, expiredays) {
//   var today = new Date();
//   today.setDate(today.getDate() + expiredays);
//   document.cookie = name + '=' + escape(value) + '; path=/; expires=' + today.toGMTString() + ';'
// }

// 쿠키 만들기
function setCookie(name, value, expiredays) {
	var today = new Date();
 today.setDate(today.getDate() + expiredays);
 document.cookie = name + '=' + escape(value) + '; path=/; expires=' + today.toGMTString() + ';'
}


// 쿠키 가져오기
function getCookie(name){
 var cName = name + "=";
 var x = 0;
	var i = 0;
 while ( i <= document.cookie.length ){
   var y = (x+cName.length);
   if ( document.cookie.substring( x, y ) == cName ){
     if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
       endOfCookie = document.cookie.length;
     return unescape( document.cookie.substring( y, endOfCookie ) );
   }
   x = document.cookie.indexOf( " ", x ) + 1;
   if ( x == 0 )
   break;
 }
 return "";
}

</script>
<body>
  <script type="text/javascript">

  var nation_code = '<?=$this->nationcode?>'!= ''?'<?=$this->nationcode?>':'us'; 
  // alert(nation_code);
  // api_language_mod_up();
  //브릿지::언어 변경
  function api_language_mod_up(){
    // alert("언어변경 브릿지 실행");
    if( agent == 'android') {
      window.rocateer.language_mod_up(nation_code);
    } else if ( agent == 'ios') {
      var message = {
                    "request_type" : "language_mod_up",
                    "nation_code" : nation_code
                    };
      window.webkit.messageHandlers.native.postMessage(message);
    }
  }

  //국가코드
  var redirect_dom = "/";
  function do_view_type(str){
      history.replaceState({ data: 'testData2' }, null, document.referrer);

      var this_url = $("#this_url").val();
      var nationcode = str;

      $.ajax({
        url : "/<?=$this->nationcode?>/language/nation_change",
        type : "post",
        dataType : "json",
        data : {
          "this_url" : this_url,
          "nationcode" : nationcode
        },
        async : false,
        success : function(dom){ 
          redirect_dom = dom;
          api_language_mod_up();
          alert("<?=lang("lang_common_00821","정상적으로 처리되었습니다.")?>");
          location.href=dom;

        }
      });
  }

  function api_response_anguage_mod_up(){
    alert("<?=lang("lang_common_00821","정상적으로 처리되었습니다.")?>");
    location.href=redirect_dom;
  }

//   //  요청 :: 디바이스 gcmkey --- 안드로이드 api 전달명 앞에 'api_' 가 붙어있음
// function api_request_device_gcmkey(){
//   if(agent == 'android') {
//     window.rocateer.api_request_device_gcmkey();
//   } else if (agent == 'ios') {
//     var message = {
//       "request_type" : "request_device_gcmkey",
//     };
//     window.webkit.messageHandlers.native.postMessage(message);
//   }
// }

// //  응답 :: 앱에서 받아서  데이타 처리
// function api_reponse_device_gcmkey(device_os,gcm_key){
//   $("#device_os").val(device_os);
//   $("#gcm_key").val(gcm_key);
// }

// $(function(){
//   if(agent!="pc"){
//     setTimeout(function() {
//           api_request_device_gcmkey();
//     }, 2000);
//   }
// });

  </script>
  <!-- wrap : s -->
  <div class="wrap">
<input type="hidden" name="device_os" id="device_os" value="">
<input type="hidden" name="gcm_key" id="gcm_key" value="">
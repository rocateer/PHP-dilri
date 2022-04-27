<input type="hidden" name="device_os" id="device_os" value="">
<input type="hidden" name="gcm_key" id="gcm_key" value="">

<script type="text/javascript">
// var agent ="<?=$agent?>";
// var app_yn ="<?=$this->app_yn?>";

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

// 차단 하기
function double_login_check(){
  
  var form_data = {
    'device_os' : $('#device_os').val(),
    'gcm_key' : $('#gcm_key').val(),
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('login')?>/double_login_check",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : 1,
    success : function(result){
      if(result.code == '-1'){
   			alert(result.code_msg);
   			return;
 		  }
 		  // 0:실패 1:성공
 		  if(result.code == 0) {
   			return;
 		  }else {
        location.href="/<?=$this->nationcode.'/'.mapping('logout')?>/sess_destroy";
   		}
    }
  });
}

//  요청 :: 디바이스 gcmkey --- 안드로이드 api 전달명 앞에 'api_' 가 붙어있음
function api_request_device_gcmkey(){
  if(agent == 'android') {
    window.rocateer.api_request_device_gcmkey();
  } else if (agent == 'ios') {
    var message = {
           "request_type" : "request_device_gcmkey",
          };
    window.webkit.messageHandlers.native.postMessage(message);
  }
}

//  응답 :: 앱에서 받아서  데이타 처리
function api_reponse_device_gcmkey(device_os,gcm_key){
  $("#device_os").val(device_os);
  $("#gcm_key").val(gcm_key);
  
  double_login_check();
}

$(function(){
  if(agent!="pc"){
    setTimeout(function() {
          api_request_device_gcmkey();
     }, 2000);
  }
});


</script>

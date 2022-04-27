<!-- header : s -->
<header class="transparent">
	<a class="btn_back" href="/<?=$this->nationcode.'/'.mapping('main')?>">
		<img src="/images/head_btn_close.png" alt="닫기">
	</a>
</header>
<!-- header : e -->
<div class="login_wrap row">
  <img src="/images/login_logo.png" alt="dilri" class="logo">
  <input type="text" id="member_id" name="member_id" class="login_input_id" placeholder="<?=lang("lang_login_00037","아이디") ?>">
  <input type="password" id="member_pw" name="member_pw" class="login_input_pw" placeholder="<?=lang("lang_login_00039","비밀번호") ?>">
  <div class="btn_full_weight btn_point mt30">
    <a href="javascript:void(0)" onClick="login_action_member();"><?=lang("lang_login_00036","로그인") ?></a>
  </div>
	<div class="txt_center row">
	  <ul class="login_find_ul">
			<li>
				<a href="/<?=$this->nationcode.'/'.mapping('find_id')?>"><?=lang("lang_login_00041","아이디 찾기") ?></a>
			</li>
	    <li>
	      <a href="/<?=$this->nationcode.'/'.mapping('find_pw')?>"><?=lang("lang_login_00042","비밀번호 찾기") ?></a>
	    </li>
			<li>
	      <a href="/<?=$this->nationcode.'/'.mapping('join')?>"><?=lang("lang_login_00043","회원가입") ?></a>
	    </li>
	  </ul>
	</div>
	<div class="btn_full_weight btn_face">
		<a href="javascript:void(0)" onclick="api_request_sns_login('F')"><?=lang("lang_login_00044","페이스북 로그인") ?></a>
	</div>
	<div class="btn_full_weight btn_gg">
		<a href="javascript:void(0)" onclick="api_request_sns_login('G')"><?=lang("lang_login_00045","구글 로그인") ?></a>
	</div>
  <? if($this->current_nation=='kr'){ ?>
    <p class="agree mb30">계속 진행하면 딜리 <a href="javascript:void(0)" onclick="terms_detail('0');">서비스 약관</a>에 동의하고 <a href="javascript:void(0)" onclick="terms_detail('1');">개인정보 보호정책</a>을 읽었음을 인정하는 것으로 간주됩니다.</p>

  <? } else if($this->current_nation=='us'){?>
    <p class="agree mb30">To further process, we consider you have read and accepted our <a href="javascript:void(0)" onclick="terms_detail('1');">Privacy policy</a> and <a href="javascript:void(0)" onclick="terms_detail('0');">terms and conditions</a>.</p>

  <? } else {?>
    <p class="agree mb30">সামনে আগানোর জন্য আমরা ধরে নিচ্ছি আপনি আমাদের সকল <a href="javascript:void(0)" onclick="terms_detail('1');">গোপনীয়তা নীতি</a>এবং <a href="javascript:void(0)" onclick="terms_detail('0');">নিরাপত্তা শর্তাবলী</a> মেনে নিয়েছেন।.</p>

  <? } ?>
  
</div>
<style>
.terms span{color:inherit;font-size: inherit}
.terms a{color:inherit;font-size: inherit}
.terms h1{color:inherit;font-family: inherit; font-weight: inherit;}
.terms h2, .terms h3, .terms h4, .terms h5, .terms h6{color:inherit;font-family: inherit; font-weight: inherit;}
.terms body, .terms div, .terms dl, .terms dt, .terms dd, .terms ul, .terms ol, .terms li, .terms h1, .terms h2, .terms h3, .terms h4, .terms h5, .terms h6, .terms pre, .terms code,
.terms form, .terms fieldset, .terms legend, .terms textarea, .terms p, .terms blockquote, .terms th, .terms td, .terms input, .terms select, .terms textarea, .terms button{padding:revert;}
.terms dl, .terms ul, .terms ol, .terms menu, .terms li{list-style: revert;}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{border:1px solid #ddd; vertical-align: middle;}
.terms .table > thead > tr > th, .terms .table > tbody > tr > th,
.terms .table > tfoot > tr > th, .terms .table > thead > tr > td, .terms .table > tbody > tr > td, .terms .table > tfoot > tr > td{padding: 8px 12px;line-height: 1.5;}
.terms iframe, .terms img{max-width: 100%}
</style>
<!-- modal : s -->
<div class="modal modal_terms">
  <header>
    <a class="btn_close" href="javascript:void(0)" onclick="modal_close('terms')"><img src="/images/head_btn_close.png" alt="닫기"></a>
    <h1 id="modal_title"></h1>
  </header>
  <!-- header : e -->
  <div class="body">
    <div class="inner_wrap mt20 terms" id="modal_contents" >

  	</div>
  </div>
</div>
<!-- modal : e -->
<input type="hidden" name="device_os" id="device_os" value="">
<input type="hidden" name="gcm_key" id="gcm_key" value="">

<form id="hidden_form" name="hidden_form"  method="get" >
	<?php
	foreach($_GET as $key => $value){
	if($key !="return_url"){
	?>
	<input type="hidden" name="<?=$key?>" id="<?=$key?>" value="<?=$value?>">
	<?php }}?>
</form>

<script>
var modal_open_arr = new Array(); 
function modal_open(element){
  $(".md_overlay_" + element).css("visibility", "visible").animate({opacity: 1}, 100);
  $(".modal_" + element).css({display: "block"});
  $.lockBody();
  $("#shop_head").css({"position":"absolute"});
  modal_open_arr.push(element);
  console.log(modal_open_arr);
}

function modal_close(element){
  $(".md_overlay_" + element).css("visibility", "hidden").animate({opacity: 0}, 100);
  $(".modal_" + element).css({display: "none"});
  $.unlockBody();
  modal_open_arr = modal_open_arr.filter(each => each != element);
  console.log(modal_open_arr);
}

  $(function(){
    history.pushState(null, document.title, location.href);  // push
    window.addEventListener('popstate', function(event) {    //  뒤로가기 이벤트 등록
    // alert(window.history.length);

      if (modal_open_arr.length>0) {
          modal_close(modal_open_arr.at(-1));
          history.pushState(null, document.title, location.href);  // push

        }else {
          history.back();
          // history_back_fn();
        }

    });

		setTimeout(function(){
			history.replaceState({ data: 'testData2' }, null, document.referrer);
		}, 100);
  })

  function terms_detail(type){

    var form_data = {
      'type' : type
    };

    $.ajax({
      url: "/<?=$this->nationcode.'/'.mapping('join')?>/terms_detail",
      type: 'POST',
      dataType: 'json',
      async: true,
      data: form_data,
      success: function(result){
        if(result.code == '-1'){
        alert(result.code_msg);
        return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
        alert(result.code_msg);
        } else {
          if (type=='0') {
            $('#modal_title').html("<?=lang("lang_join_00076","서비스 이용약관")?>");
          } else if (type=='1'){
            $('#modal_title').html("<?=lang("lang_join_00077","개인정보 취급방침")?>");
          } else if (type=='4'){
            $('#modal_title').html("<?=lang("lang_join_00080","위치기반 서비스 이용약관")?>");
          }
          // $('#modal_title').html(result.title);
          $('#modal_contents').html(result.contents);
          modal_open('terms');
        }
      }
    });
  }

  // 로그인
  function login_action_member(){

    var form_data = {
      'device_os' : $('#device_os').val(),
      'gcm_key' : $('#gcm_key').val(),
      'member_id' : $('#member_id').val(),
      'member_pw' : $('#member_pw').val()
    };

    $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('login')?>/login_action_member",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result){
        if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
        }
        // 0:실패 1:성공
        if(result.code == "0") {
          alert(result.code_msg);
        } else {
          alert(result.code_msg);
          if(app_yn=="Y"){
            api_request_login('',result.member_idx,result.member_id);
            setTimeout(function() {
              member_login_url();
             }, 1000);
          }else{
            member_login_url();
          }
        }
      }
    });
  }

  //api로그인
  function api_request_login(user_type,user_idx,user_name){
    if(agent == 'android') {
      window.rocateer.request_login(user_type,user_idx,user_name);
    } else if (agent == 'ios') {
      var message = {
                     "request_type" : "request_login",
                     "user_type" : user_type,
                     "user_idx" : String(user_idx),
                     "user_name" : user_name,
                    };
      window.webkit.messageHandlers.native.postMessage(message);
    }
  }

  // 로그인후  url
  function member_login_url(){
    <?if($return_url !=""){?>
    $("#hidden_form")[0].action="<?=$return_url?>";
    $("#hidden_form")[0].submit();
    <?}else{?>
    location.href ='/<?=$this->nationcode.'/'.mapping('main')?>';
    <?}?>
  }



//api sns 로그인 member_join_type : 회원 가입타입(C:일반,F:페이스북,G:구글)
function api_request_sns_login(member_join_type){
	if(agent == 'android') {
		window.rocateer.request_sns_login(member_join_type);
	} else if (agent == 'ios') {
		var message = {
			 "request_type" : "request_sns_login",
			 "member_join_type" : member_join_type
		};
		window.webkit.messageHandlers.native.postMessage(message);
	}
}

function api_response_sns_login(code, user_idx, new_yn){
  
  if(code==1000){

    var form_data = {
      'device_os' : $('#device_os').val(),
      'gcm_key' : $('#gcm_key').val(),
      'member_id' : $('#member_id').val(),
      'member_idx' : user_idx
    };

    $.ajax({
      url      : "/<?=$this->nationcode.'/native_login'?>/set_member_cookie",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result){

        if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
        }
        // 0:실패 1:성공
        if(result.code == "0") {

          alert(result.code_msg);
        } else {

          alert(result.code_msg);
          location.href="/<?=$this->nationcode.'/'.mapping('main')?>";

          // if (new_yn=='Y') {
          //   location.href="/<?=$this->nationcode.'/'.mapping('join')?>/join_complete_detail";
          // }else{
          //   location.href="/<?=$this->nationcode.'/'.mapping('main')?>";
          // }
        }
      }
    });
    
  }else{
    alert('<?=lang("lang_common_00822","문제가 발생하였습니다. 관리자에게 문의해주세요.")?>');
  }
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
}

$(function(){
  if(agent!="pc"){
    setTimeout(function() {
          api_request_device_gcmkey();
    }, 2000);
  }
});


</script>

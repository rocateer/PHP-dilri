<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1><?=lang("lang_mypage_00648","설정")?></h1>
</header>
<!-- header : e -->

<div class="body">
	<div class="mypage_title"><?=lang("lang_setting_00806","서비스")?></div>
  <ul class="list_ul setting">
    <li>
      <a href="javascript:void(0)"><?=lang("lang_mypage_00646","알림")?>
				<? if ($result->all_alarm_yn=='Y') {?>
          <label class="f_right switch"><input type="checkbox" name="all_alarm_yn" id="all_alarm_yn" value="Y" onclick="all_alarm_yn_mod_up('N')" checked><span class="check_slider"></span></label>
        <?}else {?>
          <label class="f_right switch"><input type="checkbox" name="all_alarm_yn" id="all_alarm_yn" value="Y" onclick="all_alarm_yn_mod_up('Y')"><span class="check_slider"></span></label>
        <?}?>
			</a>
    </li>
		<li class="lang">
			<?=lang("lang_mypage_00650","언어설정")?>
			<select class="lang_slt" name=""  onchange="do_view_type(this.value)">
				<option value="bd" <?php if($this->uri->segment(1)=="bd"){ echo "selected";}?> ><?=lang("lang_mypage_00652","방글라데시어")?></option>
				<option value="us" <?php if($this->uri->segment(1)=="us"){ echo "selected";}?> ><?=lang("lang_mypage_00651","영어")?></option>
				<option value="kr" <?php if($this->uri->segment(1)=="kr"){ echo "selected";}?> ><?=lang("lang_setting_00807","한국어")?></option>
			</select>
		</li>
  </ul>
  <hr class="space">
  <div class="mypage_title">MY</div>
  <ul class="list_ul setting">
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('member_info')?>"><?=lang("lang_mypage_00654","내 정보 수정")?></a>
    </li>
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('member_pw_change')?>"><?=lang("lang_mypage_00655","비밀번호 변경")?></a>
    </li>
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('alarm')?>/alarm_setting"><?=lang("lang_mypage_00653","알림 방해 금지 설정")?></a>
    </li>
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('alarm')?>/keyword_set"><?=lang("lang_setting_00808","해시태그 알림 설정")?></a>
    </li>
  </ul>
  <hr class="space">
  <div class="mypage_title"><?=lang("lang_setting_00809","고객지원")?></div>
  <ul class="list_ul setting">
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('notice')?>"><?=lang("lang_mypage_00657","공지사항")?></a>
    </li>
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('faq')?>">FAQ</a>
    </li>
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('qa')?>"><?=lang("lang_mypage_00658","1:1 문의")?></a>
    </li>
  </ul>
  <hr class="space">
  <div class="mypage_title"><?=lang("lang_member_out_00759","이용약관")?></div>
  <ul class="list_ul setting">
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('terms').'?type=1'?>"><?=lang("lang_join_00076","서비스 이용약관")?></a>
    </li>
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('terms').'?type=0'?>"><?=lang("lang_join_00077","개인정보 취급 방침 동의")?></a>
    </li>
  </ul>
  <hr class="space">
  <ul class="list_ul footer_margin">
    <li>
      <a href="javascript:void(0)" onclick="logout_action()"><?=lang("lang_mypage_00661","로그아웃")?></a>
    </li>
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('member_out')?>"><?=lang("lang_mypage_00662","회원탈퇴")?></a>
    </li>
  </ul>
</div>
<input type="hidden" name="this_url" id="this_url" value="<?=THIS_DOMAIN.'/'.$this->nationcode.'/'.mapping('setting')?>">



<script type="text/javascript">

// var agent ="<?=$agent?>";
// var app_yn ="<?=$this->app_yn?>";

// alert(`agent : ${agent} / app_yn : ${app_yn}`);

api_language_mod_up();

//로그아웃
function logout_action(){

  if (!confirm("<?=lang("lang_mypage_00663","로그아웃 하시겠습니까?")?>")) {
    return;
  }

  if(app_yn=="Y"){
    api_request_logout();
    setTimeout(function() {
      logout_url();
     }, 1000);
  }else{
    logout_url();
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

//로그아웃
function logout_url(){
  location.href="/<?=$this->nationcode.'/'.mapping('logout')?>";
}

// 외부링크 이동 :: 사업자 정보 확인
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

// 알림 설정
function all_alarm_yn_mod_up(all_alarm_yn){

  var formData = {
    "all_alarm_yn" : all_alarm_yn
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('setting')?>/all_alarm_yn_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        alert("<?=lang("lang_common_00821","정상적으로 처리되었습니다.")?>");
        location.reload();
      }
    }
  });
}
</script>

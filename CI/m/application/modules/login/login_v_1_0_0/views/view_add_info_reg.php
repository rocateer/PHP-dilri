<!-- header : s -->
<header class="transparent">
	<a class="btn_back" href="/<?=$this->nationcode.'/'.mapping('main')?>">
		<img src="/images/head_btn_close.png" alt="닫기">
	</a>
	<h1><?=lang("lang_login_00099","추가 정보 입력")?></h1>
</header>
<!-- header : e -->
<div class="body vh_wrap">
	<div class="vh_body inner_wrap">
		<h5 class="mt30 mb6"><?=lang("lang_add_plus_00003","반갑습니다!")?></h5>
		<p><?=lang("lang_login_00100","플랫폼 이용을 위해서는 다음의 정보를 추가로 입력 후 이용하실 수 있습니다.")?></p>
		<div class="label"><?=lang("lang_join_00069","이름")?> <span class="essential"> *</span></div>
		<input type="text" name="member_name" id="member_name" value="">
		<div class="label"><?=lang("lang_join_00070","전화번호")?> <span class="essential">*</span></div>
		<div class="flex_3">
			<input type="number" name="member_phone" id="member_phone" pattern="\d*"/>
			<button class="btn_enabled btn_flex_3"><?=lang("lang_join_00071","인증 받기")?></button>
		</div>
		<div class="flex_3 timer_area mt4">
			<span class="txt_timer">5:00</span>
			<input type="number" pattern="\d*"/ placeholder="<?=lang("lang_login_00106","인증 번호를 입력해 주세요.")?>">
			<button class="btn_disabled btn_flex_3"><?=lang("lang_login_00107","확인")?></button>
		</div>
		<div class="label"><?=lang("lang_login_00108","성별")?><span class="essential"> *</span></div>
		<ul class="gender_rdo_ul">
			<li>
				<input type="radio" name="member_gender" id="member_gender_1" value="0">
				<label for="member_gender_1"><span></span><?=lang("lang_login_00109","남")?></label>
			</li>
			<li>
				<input type="radio" name="member_gender" id="member_gender_2" value="1">
				<label for="member_gender_2"><span></span><?=lang("lang_login_00110","여")?></label>
			</li>
		</ul>
	</div>
	<div class="vh_footer btn_full_weight btn_point mt30 mb30">
		<a href="javascript:void(0)" onclick="member_info_mod_up()"><?=lang("lang_login_00111","저장")?></a>
	</div>
</div>

<!-- 개발 중 추후 N으로 변경해야 -->
<input type="text" name="auth_yn" id="auth_yn" value="Y" style="display: none;">
<form id="hidden_form" name="hidden_form"  method="get" >
	<?php
	foreach($_GET as $key => $value){
	if($key !="return_url"){
	?>
	<input type="hidden" name="<?=$key?>" id="<?=$key?>" value="<?=$value?>">
	<?php }}?>
</form>
<script type="text/javascript">

// 회원 정보 수정
function member_info_mod_up(){

	var auth_yn = $('#auth_yn').val();
	var member_name = $('#member_name').val();
	var member_phone = $('#member_phone').val();
	var member_phone_input = $('#member_phone_input').val();

	if (auth_yn!='Y') {
		alert("본인인증을 완료해주세요.");
		return;
	}
	
	var formData = {
		'member_name' :  member_name,
		'member_phone' :  member_phone,
		'member_gender' :  $("input[name='member_gender']:checked").val()
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('login')?>/member_info_mod_up",
		type     : 'POST',
		dataType : 'json',
		async    : true,
		data     : formData,
		success: function(result){
			if(result.code == '-1'){

				alert(result.code_msg);
				$("#"+result.focus_id).focus();
				return;
			}
			// 0:실패 1:성공
			if(result.code == 0) {
				alert(result.code_msg);
			} else {
				alert(result.code_msg);
				member_login_url();
			}
		}
	});
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
</script>

<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1><?=lang("lang_member_pw_change_00698","비밀번호 변경")?></h1>
</header>
<!-- header : e -->
<div class="vh_wrap row">
	<div class="vh_body body">
		<div class="form inner_wrap">
			<p class="label"><?=lang("lang_member_pw_change_00699","기존 비밀번호")?> <span class="essential">*</span></p>
			<input type="password" name="member_pw" id="member_pw" placeholder="<?=lang("lang_member_pw_change_00700","기존 비밀번호를 입력해 주세요")?>">
			<p class="label"><?=lang("lang_member_pw_change_00701","새 비밀번호")?> <span class="essential">*</span></p>
			<input type="password" name="member_pw_new" id="member_pw_new" placeholder="<?=lang("lang_member_pw_change_00702","영문, 숫자 조합 8~15자리로 입력해 주세요.")?>">
			<p class="label"><?=lang("lang_member_pw_change_00703","새 비밀번호 확인")?> <span class="essential">*</span></p>
			<input type="password" name="member_pw_new_confirm" id="member_pw_new_confirm" placeholder="<?=lang("lang_member_pw_change_00702","영문, 숫자 조합 8~15자리로 입력해 주세요.")?>">
		</div>
	</div>
	<div class="vh_footer btn_full_weight btn_point mt30 mb30">
		<a href="javascript:void(0)" onclick="member_pw_mod_up();"><?=lang("lang_member_pw_change_00698","비밀번호 변경")?></a>
	</div>
</div>

<script type="text/javascript">

	function member_pw_mod_up(){
		var member_pw = document.querySelector('#member_pw').value;
		var member_pw_new = document.querySelector('#member_pw_new').value;
		var member_pw_new_confirm = document.querySelector('#member_pw_new_confirm').value;
		
		var form_data = {
			'member_pw' : member_pw,
			'member_pw_new' : member_pw_new,
			'member_pw_new_confirm' : member_pw_new_confirm
		} 
		
		$.ajax({
			url : "/<?=$this->nationcode.'/'.mapping('member_pw_change').'/member_pw_mod_up'?>",
			type : "POST",
			dataType: "json",
			async : true,
			data : form_data,
			success : function(result){
				// 0:실패 1:성공
				if(result.code == -1){
					alert(result.code_msg);
					$("#"+result.focus_id).focus();
					return;
				}
				
				if(result.code == "0"){
					alert(result.code_msg);
				} else {
					alert(result.code_msg);
					location.href = '/<?=$this->nationcode.'/'.mapping('setting')?>';
				}
			}
		});
		
	}
	
</script>

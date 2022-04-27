<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1><?=lang("lang_find_pw_00060","비밀번호 찾기")?></h1>
</header>
<!-- header : e -->
<div class="body vh_wrap">
  <div class="vh_body" style="padding-bottom:90px;">
    <div class="inner_wrap">
      <div class="label"><?=lang("lang_find_pw_00056","아이디")?> <span class="essential">*</span></div>
      <input type="text" id="member_id" name="member_id">
      <div class="label"><?=lang("lang_find_pw_00057","이름")?> <span class="essential">*</span></div>
      <input type="text" id="member_name" name="member_name">
      <div class="label"><?=lang("lang_find_pw_00058","전화번호")?> <span class="essential">*</span></div>
      <input type="tel" pattern="\d*"/ id="member_phone" name="member_phone" placeholder="'-' 를 제외한 숫자만 입력해 주세요">
      <div class="find_result" id="find_result" style="display: none;">
        <p><?=lang("lang_find_id_00764","회원님의 정보를 찾았습니다.")?></p>
        <p class="point"><?=lang("lang_find_pw_00061_0","회원님의 이메일(아이디)로<br>비밀번호 변경 메일을 발송 하였습니다.")?></p>
        <p><?=lang("lang_find_pw_00061_1","비밀번호 변경 후 로그인 해 주세요.")?></p>
      </div>
      <div class="find_result" id="find_result_false" style="display: none;">
        <p class="none"><?=lang("lang_find_pw_00062","일치하는 회원정보가 없습니다.")?></p>
      </div>
    </div>
  </div>
  <div class="vh_footer btn_full_weight btn_point mb30">
    <a href="javascript:void(0)" onclick="find_pw_member()" name="find_pw_btn" id="find_pw_btn"><?=lang("lang_find_pw_00060","비밀번호 찾기")?></a>
  </div>
</div>

<script type="text/javascript">

function find_pw_member(){
  $("#find_pw_btn").attr("onclick", "");

	var form_data = {
		'member_name' : $('#member_name').val(),
		'member_id' : $('#member_id').val(),
		'member_phone' : $('#member_phone').val()
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('find_pw')?>/find_pw_member",
		type     : "POST",
		dataType : "json",
		async    : true,
		data     : form_data,
		success  : function(result) {
			//alert(result);
			if(result.code == '-1'){
				alert(result.code_msg);
				$("#"+result.focus_id).focus();
        $("#find_pw_btn").attr("onclick", "find_pw_member()");
				return;
			}else {
				//find_modal_open();
				if(result.code == '0'){
					$("#find_result").css("display","none");
					$("#find_result_false").css("display","block");
				}else{
					$("#find_result_false").css("display","none");
					$("#find_result").css("display","block");
				}
        $("#find_pw_btn").attr("onclick", "find_pw_member()");

			}
		}
	});
}

</script>

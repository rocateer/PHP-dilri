<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
    회원가입
  </h1>
</header>
<!-- header : e -->
<!-- 카페24 sms 서비스 신청 이후 테스트 시 #auth_yn 값을 N으로 변경해야 -->
<input type="hidden" name="auth_yn" id="auth_yn" value="Y">
<input type="hidden" name="time_over_yn" id="time_over_yn" value="N">
<input type="hidden" name="verify_idx" id="verify_idx" value="">

<input type="hidden" name="member_id" id="member_id" value="<?=$member_id?>">
<input type="hidden" name="member_join_type" id="member_join_type" value="<?=$member_join_type?>">
<input type="hidden" name="gcm_key" id="gcm_key" value="<?=$gcm_key?>">
<input type="hidden" name="device_os" id="device_os" value="<?=$device_os?>">

<form class="find_form" name="form_default" id="form_default" method="post" autocomplete="off">


  <label for="">닉네임<span class="essential"> *</span></label>
  <input type="text" name="member_nickname" id="member_nickname">
  <label for="">전화번호 인증<span class="essential"> *</span></label>
  <div class="flex_2">
    <input type="tel" id="member_phone_input" name="member_phone_input" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="'-' 를 제외한 숫자만 입력">
    <span class="btn"><a href="javascript:void(0)" onclick="tel_verify_setting();">인증요청</a></span>
    <input type="hidden" name="member_phone" id="member_phone" value="">
  </div>
  <div class="flex_2 timer_area mt10">
		<span class="txt_timer" id="span_auth_number">03:00</span>
		<input type="tel" name="verify_num" id="verify_num" placeholder="인증 번호 입력">
    <span class="btn tel_dark_gray"><a href="javascript:void(0)" onclick="tel_verify_confirm()" id="verify_check" >확인</a></span>
  </div>
  <div class="all_checkbox row mt50 mb40">
    <ul>
      <li>
        <input type="checkbox" name="checkAll" id="checkAll">
        <label for="checkAll">
          <span></span>
          전체 동의합니다.
        </label>
      </li>
			<hr class="mt15">
      <?php foreach ($terms_list as $row){ ?>
        <li>
          <input type="checkbox" name="checkOne" id="checkOne_<?=$row->type ?>" value="Y">
          <label for="checkOne_<?=$row->type ?>">
            <span></span>
            <?=$row->title ?> <div class="essential inline_block"> *</div>
          </label>
          <span><a href="/<?=$this->nationcode.'/'.mapping('terms')?>?type=<?=$row->type ?>"><img src="/images/select_i_arrow.png" alt="보기"></a></span>
        </li>
      <?php } ?>
    </ul>
  </div>
	<div class="btn_point btn_full_weight">
    <a href="javascript:void(0)" onclick="default_reg_in()">회원 가입</a>
  </div>
</form>



<script type="text/javascript">

// 가입하기
function default_reg_in(){

	if ($('#auth_yn').val() != 'Y') {
		alert("전화번호 인증을 하지 않으셨습니다.");
		return;
	}

	var member_phone = $('#member_phone').val();
	var member_phone_input = $('#member_phone_input').val();

	if (member_phone != member_phone_input) {
		alert("전화번호 인증을 하지 않으셨습니다.");
		return;
	}

	<? for ($i=0; $i < count($terms_list); $i++) { ?>
		if (!($("input:checkbox[id='checkOne_"+"<?=$terms_list[$i]->type ?>']").is(":checked"))) {
			alert("필수 약관 동의에 체크해주세요.");
			return;
		}
	<? } ?>

	$.ajax({
		url      : "/native_login/sns_member_reg_in",
		type     : 'POST',
		dataType : 'json',
		async    : true,
		data     : $("#form_default").serialize(),
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
				location.href ='/<?=$this->nationcode.'/'.mapping('join')?>/join_complete_detail';
			}
		}
	});
}


// 인증번호 요청
function tel_verify_setting(){

	var member_phone = $('#member_phone_input').val();

  var form_data = {
    'member_phone' : member_phone
  };

  $.ajax({
		url: "/<?=$this->nationcode.'/'.mapping('tel_verify')?>/tel_verify_setting",
		type: 'POST',
		dataType: 'json',
		async: true,
		data: form_data,
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
      $("#verify_idx").val(result.verify_idx);
      COM_set_timer(3,'span_auth_number');
    	//  $('#btn_auth_ok').text('확인');
      $('#span_auth_number').css('display','block');
			$("#verify_check").removeClass('deactive');
			$("#verify_check").addClass('active');
			$('#member_phone').val(member_phone);
		  }
	  }
  });
}

// 인증번호 확인
function tel_verify_confirm(){
  var form_data = {
    'verify_idx' : $('#verify_idx').val(),
    'verify_num' : $('#verify_num').val(),
    'time_over_yn' : $('#time_over_yn').val(),
  };

  $.ajax({
		url: "/<?=$this->nationcode.'/'.mapping('tel_verify')?>/tel_verify_confirm",
		type: 'POST',
		dataType: 'json',
		async: true,
		data: form_data,
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
      $('#auth_yn').val("Y");
      $('#span_auth_number').css('display','none');
			$("#verify_check").removeClass('active');
			$("#verify_check").addClass('deactive');
		  }
	  }
  });
}

</script>

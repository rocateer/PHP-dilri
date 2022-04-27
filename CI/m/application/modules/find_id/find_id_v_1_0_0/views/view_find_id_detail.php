<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1><?=lang("lang_find_id_00053","아이디 찾기")?></h1>
</header>
<!-- header : e -->
<div class="body vh_wrap">
  <div class="vh_body">
    <div class="inner_wrap">
      <div class="label"><?=lang("lang_find_id_00050","이름")?> <span class="essential">*</span></div>
      <input type="text" name="member_name" id="member_name">
      <div class="label"><?=lang("lang_find_id_00051","전화번호")?> <span class="essential">*</span></div>
      <input type="tel" name="member_phone" id="member_phone" pattern="\d*"/ placeholder="<?=lang("lang_find_id_00052","'-' 를 제외한 숫자만 입력해 주세요")?>">
      <div class="find_result" id="find_result" style="display: none;">
        <p><?=lang("lang_find_id_00764","회원님의 정보를 찾았습니다.")?></p>
        <p class="point" name="member_id" id="member_id">example@gmail.com</p>
      </div>
      <div class="find_result" id="find_result_false" style="display: none;">
        <p class="none"><?=lang("lang_find_id_00055","회원님의 정보를 찾을 수 없습니다.")?></p>
      </div>
    </div>
  </div>
  <div class="vh_footer btn_full_weight btn_point mt30 mb30">
    <a href="javascript:void(0)" onclick="find_id_member();"><?=lang("lang_find_id_00053","아이디 찾기")?></a>
  </div>
</div>

<script type="text/javascript">

function find_id_member(){

	var form_data = {
		'member_name' : $('#member_name').val(),
		'member_phone' : $('#member_phone').val()
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('find_id')?>/find_id_member",
		type     : "POST",
		dataType : "json",
		async    : true,
		data     : form_data,
		success  : function(result) {
			if(result.code == '-1'){
				alert(result.code_msg);
				$("#"+result.focus_id).focus();
				return;
			}else {
				if(result.code == '0'){
					$("#find_result").css("display","none");
					$("#find_result_false").css("display","block");
				}else{
					$("#find_result_false").css("display","none");
					$("#find_result").css("display","block");
					$("#member_id").html(result.member_id);
				}

			}
		}
	});
}

</script>

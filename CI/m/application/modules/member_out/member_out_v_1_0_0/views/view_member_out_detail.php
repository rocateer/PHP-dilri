<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1><?=lang("lang_member_out_00751","회원탈퇴")?></h1>
</header>
<!-- header : e -->
<div class="body">
  <div class="inner_wrap row">
  	<div class="member_out_page">
      <h4 class="mt30"><?=lang("lang_member_out_00752","회원탈퇴 전에 아래 내용을 확인 해 주세요.")?></h4>
  		<ul class="member_out_ul mt20 mb30">
        <li>
          <?=lang("lang_member_out_00753","고객님의 계정에 저장된 정보가 삭제될 예정입니다. 삭제된 정보는 추후에 복원할 수 없습니다.")?>
        </li>
        <li>
          <?=lang("lang_member_out_00754","같은 아이디로 재가입이 불가합니다.")?>
        </li>
  		</ul>
      <div class="label"><?=lang("lang_member_out_00755","서비스 이용 중 어떤 부분이 불편하셨나요?")?> <span class="essential">*</span></div>
  		<textarea name="member_leave_reason" id="member_leave_reason" style="height:280px;" placeholder="<?=lang("lang_member_out_00755","서비스 이용 중 어떤 부분이 불편하셨나요? 탈퇴 사유를 입력해 주세요.")?> <?=lang("lang_member_out_00756","소중한 의견을 반영하여 더 좋은 서비스로 찾아뵙겠습니다.")?>"></textarea>
  		<input type="checkbox" name="chk_1" id="chk_1_1">
      <label class="mt30" for="chk_1_1">
        <span></span>
        <?=lang("lang_member_out_00757","안내사항을 모두 확인하였으며, 이에 동의합니다.")?>
      </label>
      <div class="btn_half_wrap mb30 mt30">
        <span class="btn_full_weight btn_gray_line3">
          <a href="javascript:history.go(-1)"><?=lang("lang_product_00204","취소")?></a>
        </span>
    	  <span class="btn_full_weight btn_sub_point" id="btn_chk">
    	    <a href="javascript:void(0)" onclick="member_out();"><?=lang("lang_member_out_00758","탈퇴하기")?></a>
    	  </span>
      </div>
  	</div>
  </div>
</div>

<script>

//탈퇴
function member_out(){

  var member_leave_reason = $("#member_leave_reason").val();
  if (!member_leave_reason) {
    alert("<?=lang("lang_member_out_00755","탈퇴 사유를 입력해주세요.")?>");
    return;
  }

  // 체크여부 확인
  if($("input:checkbox[name=chk_1]").is(":checked") != true) {
    alert("<?=lang("lang_member_out_00760","동의에 체크해주세요.")?>");
    return;
  }
  var form_data = {
    'member_leave_reason' :  member_leave_reason
  };
  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('member_out')?>/member_out_mod_up",
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
      if(result.code == 0) {
      alert(result.code_msg);
      } else {
      alert(result.code_msg);
      location.href="/<?=$this->nationcode.'/'.mapping('logout')?>";
      }
    }
  });
}

</script>

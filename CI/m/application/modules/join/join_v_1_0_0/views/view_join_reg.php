<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1><?=lang("lang_join_00082","회원가입")?></h1>
</header>
<!-- header : e -->
<div class="body">
  <div class="inner_wrap row">
    <div class="label"><?=lang("lang_join_00063","아이디")?> <span class="essential">*</span></div>
    <input type="text" name="member_id" id="member_id" placeholder="<?=lang("lang_join_00064","이메일을 입력해 주세요.")?>">
    <div class="label"><?=lang("lang_join_00065","비밀번호")?> <span class="essential">*</span></div>
    <input type="password" name="member_pw" id="member_pw" placeholder="<?=lang("lang_join_00066","영문, 숫자 조합 8~15자리로 입력해 주세요.")?>">
    <div class="label"><?=lang("lang_join_00067","비밀번호 확인")?> <span class="essential">*</span></div>
    <input type="password" name="member_pw_confirm" id="member_pw_confirm" placeholder="<?=lang("lang_join_00068","영문, 숫자 조합 8~15자리로 입력해 주세요.")?>">
    <div class="label"><?=lang("lang_join_00069","이름")?> <span class="essential">*</span></div>
    <input type="text" name="member_name" id="member_name">
    <div class="label"><?=lang("lang_join_00070","전화번호")?> <span class="essential">*</span></div>
    <div class="flex_3">
      <input type="number" name="member_phone_input" id="member_phone_input" pattern="\d*"/>
      <button  onclick="tel_verify_setting();" class="btn_enabled btn_flex_3"><?=lang("lang_join_00071","인증 받기")?></button>
    </div>
    <div class="flex_3 timer_area mt4">
      <span class="txt_timer"  id="span_auth_number" >5:00</span>
      <input type="number" name="verify_num" id="verify_num" pattern="\d*"/ placeholder="<?=lang("lang_join_00073","인증 번호를 입력해 주세요.")?>">
      <button onclick="tel_verify_confirm();" class="btn_disabled btn_flex_3"><?=lang("lang_join_00074","확인")?></button>
      <input type="hidden" name="member_phone" id="member_phone" value="">

    
    </div>
    <div class="all_checkbox row mt50 mb30">
      <ul>
        <li class="mb10">
          <input type="checkbox" name="checkAll" id="checkAll">
          <label for="checkAll">
            <span></span>
            <?=lang("lang_join_00075","전체 약관 동의")?>
          </label>
        </li>
        <?
        $cnt = 1;
        if(!empty($terms_list)){
          foreach($terms_list as $row){?>
            <li>
              <input type="checkbox" name="checkOne" id="checkOne_<?=$cnt?>" value="Y" required>
              <label for="checkOne_<?=$cnt?>">
                <span></span>
                <? if($row->type=='0'){ ?>
                  <?=lang("lang_join_00076","서비스 이용약관")?>
                <? } else if($row->type=='1'){?>
                  <?=lang("lang_join_00077","개인정보 취급방침")?>
                <? } else if($row->type=='4'){?>
                  <?=lang("lang_join_00080","위치기반 서비스 이용약관")?>
                <? } ?>
                <div class="essential inline_block"> *</div>
              </label>
              <span><a href="javascript:void(0)" onclick="terms_detail(<?=$row->type?>);"><?=lang("lang_join_00081","보기")?></a></span>
            </li>
          <?$cnt++;}
        }?>
      </ul>
    </div>
    <div class="btn_full_weight btn_point mt30 mb30">
      <a href="javascript:(0)" onclick="default_reg_in()"><?=lang("lang_join_00082","회원가입")?></a>
    </div>
  </div>
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
    <h1 id="modal_title">약관 제목</h1>
  </header>
  <!-- header : e -->
  <div class="body">
    <div id="modal_contents" class="inner_wrap mt20 terms">
      약관 내용
  	</div>
  </div>
</div>
<!-- modal : e -->

<!-- <input type="text" name="auth_yn" id="auth_yn" value="Y" style="display: none;"> -->
<input type="hidden" name="timer_yn" id="timer_yn" value="N">
<input type="hidden" name="timer_cnt" id="timer_cnt" value="0">
<input type="hidden" name="auth_yn" id="auth_yn" value="Y">
<!-- <input type="hidden" name="auth_yn" id="auth_yn" value="N"> -->
<input type="hidden" name="time_over_yn" id="time_over_yn" value="N">
<input type="hidden" name="verify_idx" id="verify_idx" value="">


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
})

  // $(function(){
  // 	setTimeout(function(){
  // 		history.replaceState({ data: 'testData2' }, null, document.referrer);
  // 	}, 100);
  // });

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
          $('#modal_contents').html(result.contents);
          modal_open('terms');
        }
      }
    });
  }

  // 가입하기
  function default_reg_in(){

    var form_data = {
      'member_id' : $('#member_id').val(),
      'member_pw' : $('#member_pw').val(),
      'member_pw_confirm' : $('#member_pw_confirm').val(),
      'member_name' : $('#member_name').val(),
      'member_phone' : $('#member_phone').val(),
      'auth_check' : auth_check(), // 인증 체크
      'terms_check' : terms_check() // 필수약관 동의 확인
    };

    $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('join')?>/join_reg_in",
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
          location.href ='/<?=$this->nationcode.'/'.mapping('join')?>/join_complete_detail';
        }
      }
    });
  }

  // 인증 체크
  function auth_check(){
    var auth_yn = document.querySelector('#auth_yn').value;

    var res = auth_yn == 'Y' ? 'Y' : 'N';

    return res;
  }

  // 필수약관 동의 확인
  function terms_check(){
    var require = document.querySelectorAll("input[name='checkOne']:required");
    var res = 'Y';

    for(terms of require){
      if(!terms.checked){
        res = 'N';
        break;
      }
    }
    console.log(res);
    return res;
  }

  
//인증요청
function tel_verify_setting(){

  alert("발송 중입니다. 잠시만 기다려주세요.");

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

      // send_sms(result.msg);

      $("#verify_idx").val(result.verify_idx);
      if ($('#timer_yn').val()=='N') {
        COM_set_timer(5,'span_auth_number');
        $('#timer_yn').val('Y');
      }else {
        $('#timer_cnt').val('1');
        COM_set_timer(5,'span_auth_number');
      }
    	//  $('#btn_auth_ok').text('확인');
      $('#span_auth_number').css('display','block');
			$("#verify_check").removeClass('deactive');
			$("#verify_check").addClass('active');
			$('#member_phone').val(member_phone);
		  }
	  }
  });
}

function send_sms(msg){
  var member_phone = $('#member_phone_input').val();

  var form_data = {
    'api_key' : '<?=SMS_KEY?>',
    'msg' : msg,
    'to' : member_phone,
  };

  $.ajax({
		url: "https://api.sms.net.bd/sendsms",
		type: 'POST',
		dataType: 'json',
		async: true,
		data: form_data,
		success: function(result){
      console.log("success");
	  }
  });
}


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
      // modal_open('join');
		  }
	  }
  });
}

</script>

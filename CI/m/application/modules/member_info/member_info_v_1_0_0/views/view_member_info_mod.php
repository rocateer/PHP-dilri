<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
	<h1><?=lang("lang_member_info_00672","내 정보 수정")?></h1>
</header>
<!-- header : e -->
<div class="body">
	<div class="myinfo_profile">
		<div class="img_box">
			<img id="member_img_src" src="<?=$result->member_img?>" onerror="this.src='/images/default_user.png'" alt="">
		</div>
		<!-- <img  onclick="api_request_file_upload('member_img')" src="/images/btn_camera.png" alt="사진등록" class="btn_camera"> -->
		<img  onclick="modal_open_slide('photo_reg')" src="/images/btn_camera.png" alt="사진등록" class="btn_camera">
		<input type="hidden" name="member_img_path" id="member_img_path" value="<?=$result->member_img?>">
		
	</div>
	<div class="inner_wrap row">
		<table class="tbl_info">
			<tr>
				<?if($result->member_join_type == 'C'){?>
					<th><?=lang("lang_member_info_00673","아이디")?></th>
					<td><?=$result->member_id?></td>
				<?} else if($result->member_join_type == 'G'){?>
					<th><?=lang("lang_member_info_00695","소셜 로그인")?></th>
					<td><?=lang("lang_member_info_00696","구글 로그인")?></td>
				<?} else if($result->member_join_type == 'F'){?>
					<th><?=lang("lang_member_info_00695","소셜 로그인")?></th>
					<td><?=lang("lang_member_info_00697","페이스북 로그인")?></td>
				<?}?>					
			</tr>
		</table>
		<div class="label"><?=lang("lang_member_info_00674","이름")?><span class="essential"> *</span></div>
		<input type="text" name="member_name" id="member_name" value="<?=$result->member_name?>">
    <div class="label"><?=lang("lang_member_info_00675","전화번호")?> <span class="essential">*</span></div>
		<div class="flex_3">
			<input type="number" name="member_phone_input" id="member_phone_input"  value="<?=$result->member_phone?>" pattern="\d*"/>
			<input type="hidden" name="member_phone" id="member_phone" value="<?=$result->member_phone?>">
			<button class="btn_enabled btn_flex_3" id="send_verify_btn" onclick="tel_verify_setting()"><?=lang("lang_member_info_00676","인증 받기")?></button>
		</div>
		<div class="flex_3 timer_area mt4">
			<span class="txt_timer" id="span_auth_number">5:00</span>
			<input type="number" name="verify_num" id="verify_num" pattern="\d*"/ placeholder="<?=lang("lang_member_info_00678","인증 번호를 입력해 주세요.")?>">
			<button class="btn_disabled btn_flex_3" onclick="tel_verify_confirm()"><?=lang("lang_member_info_00679","확인")?></button>

		</div>
		<div class="label"><?=lang("lang_member_info_00681","성별")?><span class="essential"> *</span></div>
		<ul class="gender_rdo_ul">
			<li>
				<input type="radio" name="member_gender" id="rdo_1_1" value="0">
				<label for="rdo_1_1"><span></span><?=lang("lang_member_info_00682","남")?></label>
			</li>
			<li>
				<input type="radio" name="member_gender" id="rdo_1_2" value="1">
				<label for="rdo_1_2"><span></span><?=lang("lang_member_info_00683","여")?></label>
			</li>
		</ul>
		<div class="btn_full_weight btn_point mt30 mb30">
			<a href="javascript:void(0)" onclick="member_info_mod_up()"><?=lang("lang_member_info_00684","내 정보 수정")?></a>
		</div>
	</div>
</div>

<!-- 개발 중 추후 N으로 변경해야 -->
<input type="text" name="auth_yn" id="auth_yn" value="Y" style="display: none;">
<input type="text" name="verify_idx" id="verify_idx" value="" style="display: none;">

<div class="modal_photo_reg" >
  <ul class="more_ul">
    <li>
      <a href="javascript:void(0)" onclick="api_request_file_upload('member_img');modal_close_slide('photo_reg');">앨범에서 사진 선택</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="set_one_img('');modal_close_slide('photo_reg');">기본 이미지로 변경</a>
    </li>
    <li class="close">
      <a href="javascript:void(0)" onclick="modal_close_slide('photo_reg')"><?=lang("lang_product_00204","취소")?></a>
    </li>
  </ul>
</div>
<div class="md_overlay md_overlay_photo_reg" onclick="modal_close_slide('photo_reg');"></div>

<script type="text/javascript">

	// 더보기 슬라이드
	$(function(){
		let more_view_height = $('.modal_photo_reg').outerHeight();
		$('.modal_photo_reg').css('bottom',-more_view_height);
	})
	function modal_open_slide(e){
		$(".md_overlay_" + 'photo_reg').css("visibility", "visible").animate({opacity: 1}, 100);
		$(".modal_" + 'photo_reg').css({bottom: "0"});
		$.lockBody();
	}

	function modal_close_slide(e){
		$(".md_overlay_" + 'photo_reg').css("visibility", "hidden").animate({opacity: 0}, 100);
		$(".modal_" + 'photo_reg').css({bottom: "-400px"});
		$.unlockBody();
	}


</script>


<script type="text/javascript">

function set_one_img(file_path){
  $('#member_img_src').attr("src", file_path);
  $('#member_img_path').val(file_path);
  // $('#member_img_del').css({"display":"block"});
}

	window.onload = function(){
		setTimeout(gender_check(), 10);
	}
	
	// 회원 성별 체크
	function gender_check(){
		var member_gender = document.querySelector("input[name='member_gender'][value='<?=$result->member_gender?>']");
		member_gender.checked = true;
	}

	// 회원 정보 수정
	function member_info_mod_up(){

		var auth_yn = $('#auth_yn').val();
		var member_img_path = $('#member_img_path').val();
		var member_name = $('#member_name').val();
		var member_phone = $('#member_phone').val();
		var member_phone_input = $('#member_phone_input').val();
	
		if (auth_yn!='Y') {
			alert("<?=lang("lang_member_info_00687","전화번호 인증을 하지 않으셨습니다.")?>");
			return;
		}
		
		var formData = {
			'member_img' :  member_img_path,
			'member_name' :  member_name,
			'member_phone' :  member_phone_input,
			'member_gender' :  $("input[name='member_gender']:checked").val()
		};

		$.ajax({
			url      : "/<?=$this->nationcode.'/'.mapping('member_info')?>/member_info_mod_up",
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
					// location.reload();
				}
			}
		});
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

<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
	<h1>내 정보 수정</h1>
</header>
<!-- header : e -->
<div class="body">
	<div class="myinfo_profile">
		<div class="img_box">
			<img src="/images/default_user.png" alt="">
		</div>
		<img src="/images/btn_camera.png" onclick="modal_open_slide('photo_reg')" alt="사진등록" class="btn_camera">
	</div>
	<div class="inner_wrap row">
		<table class="tbl_info">
			<tr>
				<th>아이디</th>
				<td>id@email.com</td>
			</tr>
		</table>
		<div class="label">이름<span class="essential"> *</span></div>
		<input type="text" name="" value="">
    <div class="label">전화번호 <span class="essential">*</span></div>
		<div class="flex_3">
			<input type="number" pattern="\d*"/>
			<button class="btn_enabled btn_flex_3">인증 받기</button>
		</div>
		<div class="flex_3 timer_area mt4">
			<span class="txt_timer">05:00</span>
			<input type="number" pattern="\d*"/ placeholder="인증 번호를 입력해 주세요.">
			<button class="btn_disabled btn_flex_3">확인</button>
		</div>
		<div class="label">성별<span class="essential"> *</span></div>
		<ul class="gender_rdo_ul">
			<li>
				<input type="radio" name="rdo_1" id="rdo_1_1">
				<label for="rdo_1_1"><span></span>남</label>
			</li>
			<li>
				<input type="radio" name="rdo_1" id="rdo_1_2">
				<label for="rdo_1_2"><span></span>여</label>
			</li>
		</ul>
		<div class="btn_full_weight btn_point mt30 mb30">
			<a href="">내 정보 수정</a>
		</div>
	</div>
</div>
<div class="modal_photo_reg">
  <ul class="more_ul">
    <li>
      <a href="javascript:void(0)" onclick="modal_close_slide('photo_reg');">앨범에서 사진 선택</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_close_slide('photo_reg');">기본 이미지로 변경</a>
    </li>
    <li class="close">
      <a href="javascript:void(0)" onclick="modal_close_slide('photo_reg')">취소</a>
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

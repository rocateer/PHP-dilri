<!-- header : s -->
<header class="transparent">
	<a class="btn_back" href="/<?=mapping('main')?>">
		<img src="/images/head_btn_close.png" alt="닫기">
	</a>
	<h1>추가 정보 입력</h1>
</header>
<!-- header : e -->
<div class="body vh_wrap">
	<div class="vh_body inner_wrap">
		<h5 class="mt30 mb6">반갑습니다!</h5>
		<p>플랫폼 이용을 위해서는 다음의 정보를 추가로 입력 후 이용하실 수 있습니다.</p>
		<div class="label">아이디 <span class="essential"> *</span></div>
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
	</div>
	<div class="vh_footer btn_full_weight btn_point mt30 mb30">
		<a href="/<?=mapping('main')?>">저장</a>
	</div>
</div>

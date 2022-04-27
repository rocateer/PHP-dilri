<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1>비밀번호 찾기</h1>
</header>
<!-- header : e -->
<div class="body vh_wrap">
  <div class="vh_body" style="padding-bottom:90px;">
    <div class="inner_wrap">
      <div class="label">아이디 <span class="essential">*</span></div>
      <input type="text">
      <div class="label">이름 <span class="essential">*</span></div>
      <input type="text">
      <div class="label">전화번호 <span class="essential">*</span></div>
      <input type="tel" pattern="\d*"/ placeholder="'-' 를 제외한 숫자만 입력해 주세요">
      <div class="find_result">
        <p>회원님의 정보를 찾았습니다.</p>
        <p class="point">회원님의 이메일(아이디)로<br>비밀번호 변경 메일을 발송 하였습니다.</p>
        <p>비밀번호 변경 후 로그인 해 주세요.</p>
      </div>
      <div class="find_result">
        <p class="none">회원님의 정보를 찾을 수 없습니다.</p>
      </div>
    </div>
  </div>
  <div class="vh_footer btn_full_weight btn_point mb30">
    <a href="">비밀번호 찾기</a>
  </div>
</div>

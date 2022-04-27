<!-- header : s -->
<header>
	<a class="btn_back" href="/<?=mapping('mypage')?>">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1>설정</h1>
</header>
<!-- header : e -->

<div class="body">
	<div class="mypage_title">서비스</div>
  <ul class="list_ul setting">
    <li>
      <a href="">알림
        <label class="f_right switch"><input type="checkbox" name="all_alarm_yn" id="all_alarm_yn" value="Y" onclick="all_alarm_yn_mod_up()" checked=""><span class="check_slider"></span></label>
      </a>
    </li>
		<li class="lang">
			언어설정
			<select class="lang_slt" name="">
				<option value="">영어</option>
			</select>
		</li>
  </ul>
  <hr class="space">
  <div class="mypage_title">MY</div>
  <ul class="list_ul setting">
    <li>
      <a href="/<?=mapping('member_info')?>">내 정보 수정</a>
    </li>
    <li>
      <a href="/<?=mapping('member_pw_change')?>">비밀번호 변경</a>
    </li>
    <li>
      <a href="/<?=mapping('alarm')?>/alarm_setting">알림 방해 금지 설정</a>
    </li>
    <li>
      <a href="/<?=mapping('alarm')?>/keyword_set">해시태그 알림 설정</a>
    </li>
  </ul>
  <hr class="space">
  <div class="mypage_title">고객지원</div>
  <ul class="list_ul setting">
    <li>
      <a href="/<?=mapping('notice')?>">공지사항</a>
    </li>
    <li>
      <a href="/<?=mapping('faq')?>">FAQ</a>
    </li>
    <li>
      <a href="/<?=mapping('qa')?>">1:1 문의</a>
    </li>
  </ul>
  <hr class="space">
  <div class="mypage_title">이용약관</div>
  <ul class="list_ul setting">
    <li>
      <a href="/<?=mapping('terms')?>">서비스 이용약관</a>
    </li>
    <li>
      <a href="/<?=mapping('terms')?>">개인정보 취급 방침 동의</a>
    </li>
  </ul>
  <hr class="space">
  <ul class="list_ul footer_margin">
    <li>
      <a href="/<?=mapping('login')?>">로그아웃</a>
    </li>
    <li>
      <a href="/<?=mapping('member_out')?>">회원탈퇴</a>
    </li>
  </ul>
</div>

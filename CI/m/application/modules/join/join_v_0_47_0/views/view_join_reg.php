<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1>회원가입</h1>
</header>
<!-- header : e -->
<div class="body">
  <div class="inner_wrap row">
    <div class="label">아이디 <span class="essential">*</span></div>
    <input type="text" placeholder="이메일을 입력해 주세요.">
    <div class="label">비밀번호 <span class="essential">*</span></div>
    <input type="password" placeholder="영문, 숫자 조합 8~15자리로 입력해 주세요.">
    <div class="label">비밀번호 확인 <span class="essential">*</span></div>
    <input type="password" placeholder="영문, 숫자 조합 8~15자리로 입력해 주세요.">
    <div class="label">이름 <span class="essential">*</span></div>
    <input type="text">
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
    <div class="all_checkbox row mt50 mb30">
      <ul>
        <li class="mb10">
          <input type="checkbox" name="checkAll" id="checkAll">
          <label for="checkAll">
            <span></span>
            전체 약관 동의
          </label>
        </li>
        <li>
          <input type="checkbox" name="checkOne" id="checkOne_1" value="Y">
          <label for="checkOne_1">
            <span></span>
            서비스 이용약관 <div class="essential inline_block"> *</div>
          </label>
          <span><a href="javascript:void(0)" onclick="modal_open('terms')">보기</a></span>
        </li>
        <li>
          <input type="checkbox" name="checkOne" id="checkOne_2" value="Y">
          <label for="checkOne_2">
            <span></span>
            개인정보 이용방침 <div class="essential inline_block"> *</div>
          </label>
          <span><a href="javascript:void(0)" onclick="modal_open('terms')">보기</a></span>
        </li>
        <li>
          <input type="checkbox" name="checkOne" id="checkOne_3" value="Y">
          <label for="checkOne_3">
            <span></span>
            마케팅 정보 수신 동의 <div class="essential inline_block"> *</div>
          </label>
          <span><a href="javascript:void(0)" onclick="modal_open('terms')">보기</a></span>
        </li>
        <li>
          <input type="checkbox" name="checkOne" id="checkOne_4" value="Y">
          <label for="checkOne_4">
            <span></span>
            전자금융거래 이용약관 <div class="essential inline_block"> *</div>
          </label>
          <span><a href="javascript:void(0)" onclick="modal_open('terms')">보기</a></span>
        </li>
        <li>
          <input type="checkbox" name="checkOne" id="checkOne_5" value="Y">
          <label for="checkOne_5">
            <span></span>
            위치기반 서비스 이용약관 <div class="essential inline_block"> *</div>
          </label>
          <span><a href="javascript:void(0)" onclick="modal_open('terms')">보기</a></span>
        </li>
      </ul>
    </div>
    <div class="btn_full_weight btn_point mt30 mb30">
      <a href="/<?=mapping('join')?>/join_complete_detail">회원가입</a>
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
    <h1>개인정보 처리 방침</h1>
  </header>
  <!-- header : e -->
  <div class="body">
    <div class="inner_wrap mt20 terms">
      귀하는 서비스 내에서 적용되는 모든 정책을 준수해야 합니다. Google 서비스의 오용을 삼가시기 바랍니다. 예를 들어 서비스를 방해하거나 Google이 제공하는 인터페이스 및 안내사항 이외의 다른 방법을 사용하여 액세스를 시도하지 않아야 합니다. 귀하는 관련 수출 및 재수출 통제 법규 및 규정 등 오직 법률상 허용되는 범위에서만 Google 서비스를 이용할 수 있습니다. 귀하가 Google 약관이나 정책을 준수하지 않거나 Google이 부정행위 혐의를 조사하고 있는 경우, Google 서비스 제공이 일시 중지 또는 중단될 수 있습니다. Google 서비스를 사용한다고 해서 Google 서비스 또는 액세스하는 콘텐츠의 지적재산권을 소유하게 되는 것은 아닙니다.
  	</div>
  </div>
</div>
<!-- modal : e -->
<script>
$(function(){
  if($('.modal').css('display') === 'block'){
  	history.pushState(null, document.title, location.href);  // push
  	window.addEventListener('popstate', function(event) {    //  뒤로가기 이벤트 등록
  		$('.modal header a').click();
  	});
  }
})

</script>

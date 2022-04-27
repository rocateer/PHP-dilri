<!-- header : s -->
<header class="transparent">
	<a class="btn_back" href="/<?=mapping('main')?>">
		<img src="/images/head_btn_close.png" alt="닫기">
	</a>
</header>
<!-- header : e -->
<div class="login_wrap row">
  <img src="/images/login_logo.png" alt="dilri" class="logo">
  <input type="text" id="member_id" name="member_id" class="login_input_id" placeholder="아이디">
  <input type="password" id="member_pw" name="member_pw" class="login_input_pw" placeholder="비밀번호">
  <div class="btn_full_weight btn_point mt30">
    <a href="/<?=mapping('main')?>" onClick="login_action_member();">로그인</a>
  </div>
	<div class="txt_center row">
	  <ul class="login_find_ul">
			<li>
				<a href="/<?=mapping('find_id')?>">아이디 찾기</a>
			</li>
	    <li>
	      <a href="/<?=mapping('find_pw')?>">비밀번호 찾기</a>
	    </li>
			<li>
	      <a href="/<?=mapping('join')?>">회원가입</a>
	    </li>
	  </ul>
	</div>
	<div class="btn_full_weight btn_face">
		<a href="/<?=mapping('login')?>/add_info_reg">페이스북 로그인</a>
	</div>
	<div class="btn_full_weight btn_gg">
		<a href="">구글 로그인</a>
	</div>
	<p class="agree mb30">계속 진행하면 딜리 <a href="javascript:void(0)" onclick="modal_open('terms')">서비스 약관</a>에 동의하고 <a href="javascript:void(0)" onclick="modal_open('terms')">개인정보 보호정책</a>을 읽었음을 인정하는 것으로 간주됩니다.</p>
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

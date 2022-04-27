<!-- header : s -->
<header>
  <h1>평가하기</h1>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
</header>
<!-- header : e -->
<div class="body vh_wrap inner_wrap">
	<div class="nice_reg_wrap">
    <div class="vh_body">

  		<h4 class="mt30">기분이 나쁘셨다니, 유감입니다.</h4>
      <div class="sub_txt">어떤 부분이 기분 나쁜 거래셨을까요?</div>
      <ul class="eval_ul">
  			<li>
  				<input type="checkbox" id="chk_1_1" name="chk_1">
  				<label for="chk_1_1"><span></span>가격 비쌈</label>
  			</li>
  			<li>
  				<input type="checkbox" id="chk_1_2" name="chk_1">
  				<label for="chk_1_2"><span></span>가격을 속임</label>
  			</li>
  			<li>
  				<input type="checkbox" id="chk_1_3" name="chk_1">
  				<label for="chk_1_3"><span></span>시간 안 지킴</label>
  			</li>
  			<li>
  				<input type="checkbox" id="chk_1_4" name="chk_1">
  				<label for="chk_1_4"><span></span>응답 느림</label>
  			</li>
  			<li>
  				<input type="checkbox" id="chk_1_5" name="chk_1">
  				<label for="chk_1_5"><span></span>거래 취소함</label>
  			</li>
  			<li>
  				<input type="checkbox" id="chk_1_5" name="chk_1">
  				<label for="chk_1_5"><span></span>거래 거부</label>
  			</li>
  			<li>
  				<input type="checkbox" id="chk_1_5" name="chk_1">
  				<label for="chk_1_5"><span></span>불친절</label>
  			</li>
  		</ul>
    </div>
  	<div class="vh_footer btn_full_weight btn_deactive mt30 mb30" id="chk_active">
      <a href="/<?=mapping('eval')?>/complete">완료</a>
  	</div>
	</div>
</div>

<script type="text/javascript">
	// 버튼 활성/비활성
	$("input[name='chk_1']").click(function() {
		if($("input[name='chk_1']").is(':checked')){
			$('#chk_active').removeClass('btn_deactive');
			$('#chk_active').addClass('btn_point');
		}else{
			$('#chk_active').removeClass('btn_point');
			$('#chk_active').addClass('btn_deactive');
		}
	});
</script>

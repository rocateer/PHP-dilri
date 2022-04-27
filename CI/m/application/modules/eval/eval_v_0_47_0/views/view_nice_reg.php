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

  		<h4 class="mt30">거래가 즐거우셨다니,<br>저희도 함께 즐겁습니다.</h4>
      <div class="sub_txt">판매자님의 어떤 부분이 즐거운 거래이셨을까요?</div>
      <ul class="eval_ul">
  			<li>
  				<input type="checkbox" id="chk_1_1" name="chk_1">
  				<label for="chk_1_1"><span></span>적당한 가격</label>
  			</li>
  			<li>
  				<input type="checkbox" id="chk_1_2" name="chk_1">
  				<label for="chk_1_2"><span></span>시간 개념</label>
  			</li>
  			<li>
  				<input type="checkbox" id="chk_1_3" name="chk_1">
  				<label for="chk_1_3"><span></span>빠른 응답</label>
  			</li>
  			<li>
  				<input type="checkbox" id="chk_1_4" name="chk_1">
  				<label for="chk_1_4"><span></span>신뢰성</label>
  			</li>
  			<li>
  				<input type="checkbox" id="chk_1_5" name="chk_1">
  				<label for="chk_1_5"><span></span>매너 좋음</label>
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

<!-- header : s -->
<header>
  <h1>평가하기</h1>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
</header>
<!-- header : e -->
<div class="body vh_wrap eval_wrap inner_wrap">
	<div class="vh_body">
		<h4>판매자의 무료나눔은 잘 받으셨나요?</h4>
		<p class="sub_txt">판매자에게 고마움 마음을 남겨 보세요.</p>

		<ul class="eval_ul">
			<li>
				<input type="checkbox" id="chk_1_1" name="chk_1">
				<label for="chk_1_1"><span></span>행복을 나눠 주셔서 감사합니다.</label>
			</li>
			<li>
				<input type="checkbox" id="chk_1_2" name="chk_1">
				<label for="chk_1_2"><span></span>희망을 얻었습니다.</label>
			</li>
			<li>
				<input type="checkbox" id="chk_1_3" name="chk_1">
				<label for="chk_1_3"><span></span>마음의 위로를 받았습니다.</label>
			</li>
			<li>
				<input type="checkbox" id="chk_1_4" name="chk_1">
				<label for="chk_1_4"><span></span>감사합니다.</label>
			</li>
			<li>
				<input type="checkbox" id="chk_1_5" name="chk_1">
				<label for="chk_1_5"><span></span>꼭 보답하겠습니다.</label>
			</li>
		</ul>
	</div>
	<div class="vh_footer btn_full_weight btn_deactive mt30 mb30" id="chk_active">
		<a href="/<?=mapping('eval')?>/complete">완료</a>
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

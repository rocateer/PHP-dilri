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
		<h4>무료나눔을 해주셔서 감사합니다!</h4>
		<p class="sub_txt">판매자님 어떤 마음으로 무료나눔을 해주셨나요?</p>

		<ul class="eval_ul">
			<li>
				<input type="checkbox" id="chk_1_1" name="chk_1">
				<label for="chk_1_1"><span></span>행복하세요</label>
			</li>
			<li>
				<input type="checkbox" id="chk_1_2" name="chk_1">
				<label for="chk_1_2"><span></span>희망을 잃지 마세요</label>
			</li>
			<li>
				<input type="checkbox" id="chk_1_3" name="chk_1">
				<label for="chk_1_3"><span></span>건강하세요</label>
			</li>
			<li>
				<input type="checkbox" id="chk_1_4" name="chk_1">
				<label for="chk_1_4"><span></span>도움이 되길 바랍니다</label>
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

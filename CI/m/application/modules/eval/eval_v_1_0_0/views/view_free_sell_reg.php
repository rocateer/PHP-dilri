<!-- header : s -->
<header>
  <h1><?=lang("lang_mypage_00533","평가하기")?></h1>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
</header>
<!-- header : e -->
<div class="body vh_wrap eval_wrap inner_wrap">
	<div class="vh_body">
		<h4><?=lang("lang_mypage_00571_0","무료나눔을 해주셔서 감사합니다!")?></h4>
		<p class="sub_txt"><?=lang("lang_mypage_00571_1","판매자님 어떤 마음으로 무료나눔을 해주셨나요?")?></p>

		<ul class="eval_ul">
			<li>
				<input type="checkbox" id="free_product_cnt_0" name="chk_1" value="1">
				<label for="free_product_cnt_0"><span></span><?=lang("lang_mypage_00573","행복하세요")?></label>
			</li>
			<li>
				<input type="checkbox" id="free_product_cnt_1" name="chk_1" value="1">
				<label for="free_product_cnt_1"><span></span><?=lang("lang_mypage_00574","희망을 잃지 마세요")?></label>
			</li>
			<li>
				<input type="checkbox" id="free_product_cnt_2" name="chk_1" value="1">
				<label for="free_product_cnt_2"><span></span><?=lang("lang_mypage_00575","건강하세요")?></label>
			</li>
			<li>
				<input type="checkbox" id="free_product_cnt_3" name="chk_1" value="1">
				<label for="free_product_cnt_3"><span></span><?=lang("lang_mypage_00576","도움이 되길 바랍니다")?></label>
			</li>
		</ul>
	</div>
  <input type="hidden" name="product_idx" id="product_idx" value="<?=$product_idx?>">
  
	<div class="vh_footer btn_full_weight btn_deactive mt30 mb30" id="chk_active">
    <a href="javascript:void(0)" onclick="free_sell_reg_in()"><?=lang("lang_mypage_00577","완료")?></a>
	</div>
</div>


<script type="text/javascript">

function free_sell_reg_in(){

  var formData = {
    'free_product_cnt_0' : $('input:checkbox[id="free_product_cnt_0"]:checked').val(),
    'free_product_cnt_1' : $('input:checkbox[id="free_product_cnt_1"]:checked').val(),
    'free_product_cnt_2' : $('input:checkbox[id="free_product_cnt_2"]:checked').val(),
    'free_product_cnt_3' : $('input:checkbox[id="free_product_cnt_3"]:checked').val(),
    'product_idx' : $('#product_idx').val()
  }

  $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('eval')?>/free_sell_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success : function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.code_msg);
        }else {
          alert(result.code_msg);
          location.href ='/<?=$this->nationcode.'/'.mapping('mypage')?>';
        }
      }
    });
}
</script>
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

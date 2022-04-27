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
		<h4><?=lang("lang_mypage_00609","판매자의 무료나눔은 잘 받으셨나요?")?></h4>
		<p class="sub_txt"><?=lang("lang_mypage_00610","판매자에게 고마움 마음을 남겨 보세요.")?></p>

		<ul class="eval_ul">
			<li>
				<input type="checkbox" id="free_product_cnt_4" name="chk_1" value="1">
				<label for="free_product_cnt_4"><span></span><?=lang("lang_mypage_00612","행복을 나눠 주셔서 감사합니다.")?></label>
			</li>
			<li>
				<input type="checkbox" id="free_product_cnt_5" name="chk_1" value="1">
				<label for="free_product_cnt_5"><span></span><?=lang("lang_mypage_00613","희망을 얻었습니다.")?></label>
			</li>
			<li>
				<input type="checkbox" id="free_product_cnt_6" name="chk_1" value="1">
				<label for="free_product_cnt_6"><span></span><?=lang("lang_mypage_00614","마음의 위로를 받았습니다.")?></label>
			</li>
			<li>
				<input type="checkbox" id="free_product_cnt_7" name="chk_1" value="1">
				<label for="free_product_cnt_7"><span></span><?=lang("lang_mypage_00615","감사합니다.")?></label>
			</li>
			<li>
				<input type="checkbox" id="free_product_cnt_8" name="chk_1" value="1">
				<label for="free_product_cnt_8"><span></span><?=lang("lang_mypage_00616","꼭 보답하겠습니다.")?></label>
			</li>
		</ul>
	</div>
  <input type="hidden" name="product_idx" id="product_idx" value="<?=$product_idx?>">
  
	<div class="vh_footer btn_full_weight btn_deactive mt30 mb30" id="chk_active">
		<a href="javascript:void(0)" onclick="free_buy_reg_in()"><?=lang("lang_mypage_00617","완료")?></a>
	</div>
</div>


<script type="text/javascript">

function free_buy_reg_in(){

  var formData = {
    'free_product_cnt_4' : $('input:checkbox[id="free_product_cnt_4"]:checked').val(),
    'free_product_cnt_5' : $('input:checkbox[id="free_product_cnt_5"]:checked').val(),
    'free_product_cnt_6' : $('input:checkbox[id="free_product_cnt_6"]:checked').val(),
    'free_product_cnt_7' : $('input:checkbox[id="free_product_cnt_7"]:checked').val(),
    'free_product_cnt_8' : $('input:checkbox[id="free_product_cnt_8"]:checked').val(),
    'product_idx' : $('#product_idx').val()
  }

  $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('eval')?>/free_buy_reg_in",
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

<!-- header : s -->
<header>
  <h1><?=lang("lang_mypage_00533","평가하기")?></h1>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
</header>
<!-- header : e -->
<div class="body vh_wrap inner_wrap">
	<div class="nice_reg_wrap">
    <div class="vh_body">

  		<h4 class="mt30"><?=lang("lang_mypage_00585_0","거래가 즐거우셨다니,<br>저희도 함께 즐겁습니다.")?></h4>
      <div class="sub_txt"><?=lang("lang_mypage_00585_1","판매자님의 어떤 부분이 즐거운 거래이셨을까요?")?></div>
      <ul class="eval_ul">
  			<li>
  				<input type="checkbox" id="good_product_cnt_0" name="chk_1" value="1">
  				<label for="good_product_cnt_0"><span></span><?=lang("lang_mypage_00586","적당한 가격")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="good_product_cnt_1" name="chk_1" value="1">
  				<label for="good_product_cnt_1"><span></span><?=lang("lang_mypage_00587","시간 개념")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="good_product_cnt_2" name="chk_1" value="1">
  				<label for="good_product_cnt_2"><span></span><?=lang("lang_mypage_00588","빠른 응답")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="good_product_cnt_3" name="chk_1" value="1">
  				<label for="good_product_cnt_3"><span></span><?=lang("lang_mypage_00589","신뢰성")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="good_product_cnt_4" name="chk_1" value="1">
  				<label for="good_product_cnt_4"><span></span><?=lang("lang_profile_00307","매너 좋음")?></label>
  			</li>
  		</ul>
    </div>
    <input type="hidden" name="product_idx" id="product_idx" value="<?=$product_idx?>">
  	<div class="vh_footer btn_full_weight btn_deactive mt30 mb30" id="chk_active">
      <a href="javascript:void(0)" onclick="good_buy_reg_in()"><?=lang("lang_mypage_00591","완료")?></a>
  	</div>
	</div>
</div>

<script type="text/javascript">

function good_buy_reg_in(){

  var formData = {
    'good_product_cnt_0' : $('input:checkbox[id="good_product_cnt_0"]:checked').val(),
    'good_product_cnt_1' : $('input:checkbox[id="good_product_cnt_1"]:checked').val(),
    'good_product_cnt_2' : $('input:checkbox[id="good_product_cnt_2"]:checked').val(),
    'good_product_cnt_3' : $('input:checkbox[id="good_product_cnt_3"]:checked').val(),
    'good_product_cnt_4' : $('input:checkbox[id="good_product_cnt_4"]:checked').val(),
    'product_idx' : $('#product_idx').val()
  }

  $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('eval')?>/good_buy_reg_in",
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
          location.href ='/<?=$this->nationcode.'/'.mapping('eval')?>/complete';
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

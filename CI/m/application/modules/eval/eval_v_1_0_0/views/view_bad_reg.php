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

  		<h4 class="mt30"><?=lang("lang_mypage_00593_0","기분이 나쁘셨다니, 유감입니다.")?></h4>
      <div class="sub_txt"><?=lang("lang_mypage_00593_1","어떤 부분이 기분 나쁜 거래셨을까요?")?></div>
      <ul class="eval_ul">
  			<li>
  				<input type="checkbox" id="bad_product_cnt_0" name="chk_1" value="1">
  				<label for="bad_product_cnt_0"><span></span><?=lang("lang_mypage_00594","가격 비쌈")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="bad_product_cnt_1" name="chk_1" value="1">
  				<label for="bad_product_cnt_1"><span></span><?=lang("lang_mypage_00595","가격을 속임")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="bad_product_cnt_2" name="chk_1" value="1">
  				<label for="bad_product_cnt_2"><span></span><?=lang("lang_mypage_00596","시간 안 지킴")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="bad_product_cnt_3" name="chk_1" value="1">
  				<label for="bad_product_cnt_3"><span></span><?=lang("lang_mypage_00597","응답 느림")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="bad_product_cnt_4" name="chk_1" value="1">
  				<label for="bad_product_cnt_4"><span></span><?=lang("lang_mypage_00598","약속장소 안 나타남")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="bad_product_cnt_5" name="chk_1" value="1">
  				<label for="bad_product_cnt_5"><span></span><?=lang("lang_mypage_00599","거래 취소함")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="bad_product_cnt_6" name="chk_1" value="1">
  				<label for="bad_product_cnt_6"><span></span><?=lang("lang_mypage_00600","거래 거부")?></label>
  			</li>
  			<li>
  				<input type="checkbox" id="bad_product_cnt_7" name="chk_1" value="1">
  				<label for="bad_product_cnt_7"><span></span><?=lang("lang_mypage_00601","불친절")?></label>
  			</li>
  		</ul>
    </div>
    <input type="hidden" name="product_idx" id="product_idx" value="<?=$product_idx?>">

  	<div class="vh_footer btn_full_weight btn_deactive mt30 mb30" id="chk_active">
      <a href="javascript:void(0)" onclick="bad_buy_reg_in()"><?=lang("lang_mypage_00602","완료")?></a>
  	</div>
	</div>
</div>


<script type="text/javascript">

function bad_buy_reg_in(){

  var formData = {
    'bad_product_cnt_0' : $('input:checkbox[id="bad_product_cnt_0"]:checked').val(),
    'bad_product_cnt_1' : $('input:checkbox[id="bad_product_cnt_1"]:checked').val(),
    'bad_product_cnt_2' : $('input:checkbox[id="bad_product_cnt_2"]:checked').val(),
    'bad_product_cnt_3' : $('input:checkbox[id="bad_product_cnt_3"]:checked').val(),
    'bad_product_cnt_4' : $('input:checkbox[id="bad_product_cnt_4"]:checked').val(),
    'bad_product_cnt_5' : $('input:checkbox[id="bad_product_cnt_5"]:checked').val(),
    'bad_product_cnt_6' : $('input:checkbox[id="bad_product_cnt_6"]:checked').val(),
    'bad_product_cnt_7' : $('input:checkbox[id="bad_product_cnt_7"]:checked').val(),
    'product_idx' : $('#product_idx').val()
  }

  $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('eval')?>/bad_buy_reg_in",
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

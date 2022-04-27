<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
    FAQ
  </h1>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="body">
  <ul class="faq_nav_ul mt30 row">
    <li>
      <input type="radio" name="rdo_1" id="rdo_1_1" value="1" checked onclick="default_list_get(1, 1);">
      <label for="rdo_1_1"><?=lang("lang_faq_00714","운영정책")?></label>
    </li>
    <li>
      <input type="radio" name="rdo_1" id="rdo_1_2" value="2" onclick="default_list_get(1, 2);">
      <label for="rdo_1_2"><?=lang("lang_faq_00715","계정/인증")?></label>
    </li>
    <li>
      <input type="radio" name="rdo_1" id="rdo_1_3" value="3" onclick="default_list_get(1, 3);">
      <label for="rdo_1_3"><?=lang("lang_faq_00716","구매/판매")?></label>
    </li>
    <li>
      <input type="radio" name="rdo_1" id="rdo_1_4" value="4" onclick="default_list_get(1, 4);">
      <label for="rdo_1_4"><?=lang("lang_faq_00717","거래 품목")?></label>
    </li>
    <li>
      <input type="radio" name="rdo_1" id="rdo_1_5" value="5" onclick="default_list_get(1, 5);">
      <label for="rdo_1_5"><?=lang("lang_faq_00718","신뢰도 포인트")?></label>
    </li>
    <li>
      <input type="radio" name="rdo_1" id="rdo_1_6" value="6" onclick="default_list_get(1, 6);">
      <label for="rdo_1_6"><?=lang("lang_faq_00719","이용제재")?></label>
    </li>
    
    <li>
      <input type="radio" name="rdo_1" id="rdo_1_8" value="8" onclick="default_list_get(1, 8);">
      <label for="rdo_1_8"><?=lang("lang_qa_00744","검색 문의")?></label>
    </li>
    <li>
      <input type="radio" name="rdo_1" id="rdo_1_10" value="10" onclick="default_list_get(1, 10);">
      <label for="rdo_1_10"><?=lang("lang_qa_00746","오류 제보")?></label>
    </li>
    <li>
      <input type="radio" name="rdo_1" id="rdo_1_11" value="11" onclick="default_list_get(1, 11);">
      <label for="rdo_1_11"><?=lang("lang_qa_00743","커뮤니티 문의")?></label>
    </li>

    <li>
      <input type="radio" name="rdo_1" id="rdo_1_7" value="7" onclick="default_list_get(1, 7);">
      <label for="rdo_1_7"><?=lang("lang_faq_00720","기타")?></label>
    </li>

  </ul>
  <ul class="faq_list mt30" id="list_ajax">
    
  </ul>
</div>
<!-- body : e -->
<input type="hidden" name="total_block" id="total_block" value="1">

<script type="text/javascript">

function asd(){
  console.log('asd');
}

$(function(){
	setTimeout("default_list_get(1, 1)", 10);
});

var page_num_1, page_num_2, page_num_3, page_num_4, page_num_5, page_num_6, page_num_7, page_num_8, page_num_10, page_num_11 = 1;


$(window).scroll(function(){
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();
  var chked_rdo = document.querySelector("input[name='rdo_1']:checked");
  
    if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
      if(chked_rdo == 1){
        page_num_1++;
        default_list_get(page_num_1, 1);
      }
      if(chked_rdo == 2){
        page_num_2++;
        default_list_get(page_num_2, 2);
      }
      if(chked_rdo == 3){
        page_num_3++;
        default_list_get(page_num_3, 3);
      }
      if(chked_rdo == 4){
        page_num_4++;
        default_list_get(page_num_4, 4);
      }
      if(chked_rdo == 5){
        page_num_5++;
        default_list_get(page_num_5, 5);
      }
      if(chked_rdo == 6){
        page_num_6++;
        default_list_get(page_num_6, 6);
      }
      if(chked_rdo == 7){
        page_num_7++;
        default_list_get(page_num_7, 7);
      }
      if(chked_rdo == 8){
        page_num_8++;
        default_list_get(page_num_8, 8);
      }
      if(chked_rdo == 10){
        page_num_10++;
        default_list_get(page_num_10, 10);
      }
      if(chked_rdo == 11){
        page_num_11++;
        default_list_get(page_num_11, 11);
      }
    }    
});

function default_list_get(page_num, faq_type){

	var total_block = parseInt($("#total_block").val());

	var formData = {
		'page_num' : page_num,
    'faq_type' : faq_type
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('faq')?>/faq_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {

			if(page_num == 1){
				 $("#list_ajax").html(result);

			}else{
				if(total_block < page_num){
				 page_num = 1;

				}else{
				 $("#list_ajax").append(result);
				}

			}
		}
	});
}

</script>

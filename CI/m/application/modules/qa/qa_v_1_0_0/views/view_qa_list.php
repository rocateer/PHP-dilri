<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
    <?=lang("lang_qa_00723","1:1 문의")?>
  </h1>
  <p class="qa_title"><a href="/<?=$this->nationcode.'/'.mapping('qa')?>/qa_reg"><?=lang("lang_product_00155","등록")?></a></p>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="body">
  <div class="no_data" id="no_data" style="display:none">
      <p>
        <?=lang("lang_qa_00721","궁금하신 내용이<br>자주묻는질문(FAQ)으로는<br>해결이 어려우신가요?")?><br><br>
        <?=lang("lang_qa_00722","문의 글을 작성하시면<br>확인 후에 답변을 드립니다.")?>
      </p>
    </div>
	<ul class="qa_ul" id="list_ajax">

	</ul>
</div>
<!-- body : e -->

<input type="hidden" name="total_block" id="total_block" value="1">

<script type="text/javascript">

$(function(){
	setTimeout("default_list_get('1')", 10);
});

var page_num=1;

$(window).scroll(function(){
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();

	if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
		page_num++;
		default_list_get(page_num);
	}
});

function default_list_get(page_num){

	var total_block = parseInt($("#total_block").val());

	var formData = {
		'page_num' : page_num
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('qa')?>/qa_list_get",
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

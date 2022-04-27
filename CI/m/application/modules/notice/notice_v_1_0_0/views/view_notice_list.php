<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1 class="head_title"><?=lang("lang_mypage_00657","공지사항")?></h1>
</header>
<!-- header : e -->
<div class="row body">
  <div class="no_data" id="no_data" style="display: none;">
    <p><?=lang("lang_notice_00712","새로운 공지사항이 없습니다.")?></p>
  </div>

  <ul class="notice_ul mt30" id="list_ajax">

  </ul>
</div>

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
		url      : "/<?=$this->nationcode.'/'.mapping('notice')?>/notice_list_get",
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

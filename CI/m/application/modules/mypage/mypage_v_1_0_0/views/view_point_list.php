<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1><?=lang("lang_mypage_00635","포인트 내역")?></h1>
</header>
<!-- header : e -->

<div class="body row">
	<div class="inner_wrap mb30">
		<div class="point_info">
			<p><?=lang("lang_mypage_00636","사용 가능한 포인트")?></p>
			<div class="point"><span><?=number_format($result->member_point)?></span>Point</div>
		</div>

		<hr class="mb20">
		<div class="" id="list_ajax">
			
		</div>
	</div>
	<div class="no_data" id="no_data">
		<p><?=lang("lang_mypage_00645","포인트 내역이 없습니다.")?></p>
	</div>
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
			url      : "/<?=$this->nationcode.'/'.mapping('mypage')?>/point_list_get",
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

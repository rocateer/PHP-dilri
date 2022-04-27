<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
	<h1><?=$search_text?></h1>
</header>
<!-- header : e -->
<div class="body inner_wrap">
	<div class="no_datas mb30" id="no_data_0" style="display:none">
		<img src="/images/Icons-filter-gray.png" alt="">
		<p><?=lang("lang_search_00407","해당 카테고리에 상품이 없습니다. 상품을 등록해 보세요!")?></p>
	</div>
	<ul class="home_ul"  id="list_ajax_0"></ul>
</div>

<input type="hidden" name="type" id="type" value="1">
<input type="hidden" name="category_management_idx" id="category_management_idx" value="<?=$category_management_idx?>">
<input type="hidden" name="tab_type" id="tab_type" value="0">
<input type="hidden" name="total_block" id="total_block_0" value="1">
<input type="hidden" name="total_block" id="total_block_1" value="1">

<input type="hidden" name="current_lat" id="current_lat" value="37.5185682">
<input type="hidden" name="current_lng" id="current_lng" value="127.0230294">


<script type="text/javascript">


var search_type = '0';
function set_tab(tab_type){
	$("#tab_type").val(tab_type);
	search_type = tab_type;
}

$(function(){
	setTimeout("default_list_get('1','0')", 100);
	// setTimeout("default_list_get('1','1')", 200);
});

var page_num_0=1;
var page_num_1=1;

var modal_open_yn='N';
$(window).scroll(function(){
	if (modal_open_yn=='Y') {
	  var scrollHeight = $(document).height();
	  var scrollPosition = $(window).height() + $(window).scrollTop();

	  if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
	    if (search_type=='0') {
	      page_num_0++;
	      default_list_get(page_num_0, tab_type);
	    }else if (search_type=='1') {
	      page_num_1++;
	      default_list_get(page_num_1, tab_type);
	    }
	  }

	}
});

function default_list_get(page_num, tab_type){

	var formData = {
	  'page_num' : page_num,
	  'tab_type' : tab_type,
	  'category_management_idx' : $("#category_management_idx").val(),
	  'current_lat' : $("#current_lat").val(),
	  'current_lng' : $("#current_lng").val()
	};

	if (tab_type=='0') {
		var get_url = "/<?=$this->nationcode.'/'.mapping('search')?>/product_list_get";
	}else {
		var get_url = "/<?=$this->nationcode.'/'.mapping('search')?>/board_list_get";
	}

	$.ajax({
	  url      : get_url,
	  type     : "POST",
	  dataType : "html",
	  async    : true,
	  data     : formData,
	  success: function(result) {

	    if(page_num == 1){
	      $("#list_ajax_"+tab_type).html(result);

	    }else{
	      if(total_block < page_num){
	       page_num = 1;

	      }else{
	        $("#list_ajax_"+tab_type).append(result);
	      }

	    }
	  }
	});
}



</script>

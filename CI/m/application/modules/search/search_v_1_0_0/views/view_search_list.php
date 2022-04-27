<!-- <header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
</header> -->

<!-- <div class="search_wrap">
	<input type="text" name="search_text" id="search_text" placeholder="<?=lang("lang_search_00365","검색어를 입력하세요.")?>">
	<a href="javascript:void(0)" onclick="default_list_get('1','0');default_list_get('1','1');search_reg_in('0')"><img src="/images/headn_search.png" alt="search" class="btn_search"></a>
</div> -->

<header>
	<a class="btn_back" href="javascript:hide_back_btn()" id="btn_back_area" style="display: none;">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
	<div class="search_wrap" style="width: 100%;" id="search_wrap_area">
		<input type="text" name="search_text" id="search_text"  placeholder="<?=lang("lang_search_00365","검색어를 입력하세요.")?>">
		<!-- <img src="/images/i_delete_gray.png" alt="x" class="btn_delete"> -->
		<a href="javascript:void(0)" onclick="default_list_get('1','0');default_list_get('1','1');search_reg_in('0');show_back_btn()"><img src="/images/headn_search.png" alt="search" class="btn_search"></a>
	</div>
</header>

<script type="text/javascript">
//엔터키 시 검색
window.addEventListener('keydown', function(event){
	if (window.event.keyCode == 13) {
		// 엔터키가 눌렸을 때 실행할 내용
		default_list_get('1','0');
		default_list_get('1','1');
		search_reg_in(search_type);
		search_text_input.blur();

	}
})



</script>

<div class="search_tab footer_margin body" >



	<!-- 검색 중 -->
	<div class="" id="searching_div"   style="display:none">
		<div class="row inner_wrap mt30">
			<span class="font_gray_9"><?=lang("lang_search_00366","최근 검색어")?></span>
			<span class="essential f_right" onclick="search_del_all()"><?=lang("lang_community_00789","전체삭제")?></span>
		</div>

		<div class="no_datas mb30" id="no_data" style="display:<?=count($recent_search_list)>0?'none':'block' ?>">
			<img src="/images/Icons-search-gray.png" alt="">
			<p><?=lang("lang_search_00368","최근 검색 내역이 없습니다.")?></p>
		</div>

		<div class="recent_search_ul" id="list_ajax" style="display:<?=count($recent_search_list)>0?'block':'none' ?>">
			<?foreach ($recent_search_list as $row) {?>
				<li class="search_li" id="search_li_<?=$row->search_idx?>">
					<a href="javascript:void(0)" onclick="$('#search_text').val('<?=$row->title?>');default_list_get('1','0');default_list_get('1','1');search_reg_in('0')">
						<?=$row->title?>
					</a>
					<img src="/images/i_delete_gray.png" onclick="search_del('<?=$row->search_idx?>')" alt="x" class="btn_delete">
				</li>
			<?}?>
		</div>
	</div>
	<!-- 검색 중 -->



	<ul class="tab_toggle_menu clearfix" id="tab_ul">
	  <li class="active"  onclick="set_tab('0')" id="active_li_0" >
	    <a href="javascript:void(0)"><?=lang("lang_search_00371","중고거래")?></a>
	  </li>
	  <li class=""  onclick="set_tab('1')" id="active_li_1">
	    <a href="javascript:void(0)"><?=lang("lang_search_00372","커뮤니티")?></a>
	  </li>
	</ul>
	<div class="tab_area_wrap" id="tab_div">

		<!-- 탭 영역 0 : s -->
	  <div class="inner_wrap"  >

			<!-- 중고거래 탭 초기화면 -->
			<div class="" id="famous_div_0">
				<div class="font_gray_6 mt30"><?=lang("lang_search_00346","인기 검색어")?></div>
				<ul class="best_keyword_ul">
					<?foreach ($recommend_search_list_0 as $row) {?>
						<li>
							<a href="javascript:void(0)" onclick="$('#search_text').val('<?=$row->title?>');default_list_get('1','0');default_list_get('1','1');search_reg_in('0');show_back_btn()"><?=$row->title ?></a>
						</li>
					<?}?>
				</ul>
				<hr>
				<ul class="search_category_ul">
					<?foreach ($category_management_list as $row) {?>
						<li>
							<a href="/<?=$this->nationcode.'/'.mapping('search')?>/category_result?search_text=<?=$row->category_name ?>&category_management_idx=<?=$row->category_management_idx ?>">
								<img src="<?=$row->img_path ?>" alt="">
								<p><?=$row->category_name ?></p>
							</a>
						</li>
					<?}?>
				</ul>
				<div class="font_gray_6 mt30"><?=lang("lang_search_00348","인기 상품")?></div>
				<ul class="home_ul mb20" id="famous_ajax_list">

				</ul>
			</div>
			<!-- 중고거래 탭 초기화면 -->



			<!-- 필터 -->
			<div class="w_100 row mt20" id="filter_div" style="display:none">
				<img src="/images/icons-darl-filter.png" id="filter_btn" style="display:none" alt="filter" class="filter f_right" onclick="modal_open('search_filter')">
				<!-- modal : s -->
				<div class="modal modal_search_filter">
					<header>
						<a class="btn_back" href="javascript:void(0)" onclick="modal_close('search_filter')">
							<img src="/images/head_btn_close.png" alt="close">
						</a>
						<h1><?=lang("lang_search_00388","필터")?></h1>
					</header>
					<div class="body inner_wrap" onclick="event.stopPropagation();">
						<form name="filter_form" id="filter_form" >

							<p class="label"><?=lang("lang_search_00389","카테고리")?></p>
							<ul class="category_ul">

								<?foreach ($category_management_list as $row) {?>
									<li >
										<input type="checkbox" name="category_management_idx" id="category_management_idx_<?=$row->category_management_idx ?>" name="category_management_idx" value="<?=$row->category_management_idx ?>">
										<label for="category_management_idx_<?=$row->category_management_idx ?>"></label>
										<a href="javascript:void(0)">
											<img src="<?=$row->img_path ?>" alt="">
											<p><?=$row->category_name ?></p>
										</a>
									</li>
								<?}?>
							</ul>
							<div class="label"><?=lang("lang_search_00390","가격 범위")?></div>
							<div class="price_wrap">
								<input type="checkbox" id="free_product_yn_1" name="free_product_yn" value="Y">
								<label for="free_product_yn_1"><span></span><?=lang("lang_search_00391","무료나눔")?></label>
								<div class="flex_1">
									<div class="relative">
										<span class="unit">৳</span>
										<input type="number" authcomplete="off" name="s_product_price" id="s_product_price">
									</div>
									<span>~</span>

									<div class="relative">
										<span class="unit">৳</span>
										<input type="number" authcomplete="off" name="e_product_price" id="e_product_price">
									</div>
								</div>
							</div>
							<p class="label"><?=lang("lang_search_00392","검색 거리 범위")?></p>
							<select name="limit_distance" id="limit_distance">
								<option value=""><?=lang("lang_search_00393","1 ~ 10km 중 선택 하세요.")?></option>
								<option value="1">1km</option>
								<option value="2">2km</option>
								<option value="3">3km</option>
								<option value="4">4km</option>
								<option value="5">5km</option>
								<option value="6">6km</option>
								<option value="7">7km</option>
								<option value="8">8km</option>
								<option value="9">9km</option>
								<option value="10">10km</option>
							</select>
							<div class="btn_half_wrap2 mt30 mb30">
								<span class="btn_float_left btn_gray">
									<a href="javascript:void(0)" onclick="$('#filter_form')[0].reset()"><?=lang("lang_search_00394","초기화")?></a>
								</span>
								<span class="btn_float_right btn_point">
									<a href="javascript:void(0)" onclick="default_list_get('1','0');modal_close('search_filter');"><?=lang("lang_search_00395","필터 적용")?></a>
								</span>
							</div>
						</form>

					</div>
				</div>
				<!-- modal : e -->
			</div>
			<!-- 필터 -->


			<!-- no data:s -->
			<div class="no_datas" id="no_data_0"  style="display:none">
				<img src="/images/Icons-search-gray.png" alt="">
				<p><?=lang("lang_search_00368","검색 결과가 없습니다.")?></p>
			</div>
			<!-- no data:e -->

			<!-- 중고거래 검색결과 목록 -->
			<ul class="home_ul mb20"  id="list_ajax_0"  style="display:none"></ul>
			<!-- 중고거래 검색결과 목록 -->

	  </div>
		<!-- 탭 영역 0 : e -->

		<!-- 탭 영역 1 : s -->
		<div class="row">

			<!-- 커뮤니티 탭 초기 화면 -->
			<div class="inner_wrap" id="famous_div_1">

				<div class="font_gray_6 mt30"><?=lang("lang_search_00346","인기 검색어")?></div>
				<ul class="best_keyword_ul">
					<?foreach ($recommend_search_list_1 as $row) {?>
						<li>
							<a href="javascript:void(0)" onclick="$('#search_text').val('<?=$row->title?>');default_list_get('1','0');default_list_get('1','1');show_back_btn();"><?=$row->title ?></a>
						</li>
					<?}?>
				</ul>
			</div>
			<!-- 커뮤니티 탭 초기 화면 -->

			<!-- no data:s -->
			<div class="no_datas" id="no_data_1" style="display:none">
				<img src="/images/Icons-search-gray.png" alt="">
				<p><?=lang("lang_search_00368","검색 결과가 없습니다.")?></p>
			</div>
			<!-- no data:e -->

			<!-- 커뮤니티 검색결과 :s -->
			<ul class="community_ul mb70"  id="list_ajax_1" style="display:none;padding-top:10px"></ul>
	  </div>
		<!-- 탭 영역 1 : e -->


	</div>
</div>

<input type="hidden" name="type" id="type" value="0">
<input type="hidden" name="tab_type" id="tab_type" value="0">
<input type="hidden" name="total_block" id="total_block_0" value="1">
<input type="hidden" name="total_block" id="total_block_1" value="1">

<input type="hidden" name="current_lat" id="current_lat" value="37.5185682">
<input type="hidden" name="current_lng" id="current_lng" value="127.0230294">

<script type="text/javascript">

$(function(){
	// console.log(history.length);
	history.pushState(null, document.title, location.href);  // push
	window.addEventListener('popstate', function(event) {    //  뒤로가기 이벤트 등록
		if ($("#searching_div").css('display')=='block' || $("#searching_div").css('display')=='' || $("#tab_div").css('display')=='block') {
			hide_back_btn();
			history.pushState(null, document.title, location.href);  // push
			console.log(history.length);
			// $('#btn_back_area').click();

		}else {
			history.back();
		}
	});
})

$(document).ready(function(){
	api_request_position();
	setTimeout("famous_product_list()", 100);
});


function api_request_position(){
  if(agent == 'android') {
      window.rocateer.request_position();
  } else if (agent == 'ios') {
     var message = {
       "request_type" : "request_position",
    };
    window.webkit.messageHandlers.native.postMessage(message);
  }
}

// 나의위치::앱에서 받아서 실행
function api_reponse_position(api_current_lat,api_current_lng){
  $('#current_lat').val(api_current_lat);
  $('#current_lng').val(api_current_lng);
}



</script>

<script type="text/javascript">


var search_type = '0';
function set_tab(tab_type){
	$("#tab_type").val(tab_type);
	search_type = tab_type;
}

$(function(){
	setTimeout("default_list_get('1','0')", 100);
	setTimeout("default_list_get('1','1')", 200);
	// if ($("#search_text").val()) {
	// 	console.log("Asdasds");
	// 	show_back_btn();

	// }
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

	var search_text = $("#search_text").val();
	if (search_text=='') {
		return;
	}

	var formData = {
	  'page_num' : page_num,
	  'tab_type' : tab_type,
	  'search_text' : search_text,
	  'category_management_idx' : get_checkbox_value('category_management_idx'),
	  's_product_price' : $("#s_product_price").val(),
	  'e_product_price' : $("#e_product_price").val(),
	  'free_product_yn' : $('input:checkbox[name="free_product_yn"]:checked').val(),
	  'limit_distance' : $("#limit_distance").val(),
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
			if (tab_type=='0') {
				$("#filter_div").css('display','');
				$("#filter_btn").css('display','');

			}
			$("#tab_ul").css('display','');
			$("#tab_div").css('display','');
			$("#searching_div").css('display','none');
			$("#famous_div_"+tab_type).css('display','none');

	  }
	});
}

function famous_product_list(){

	var formData = {
	  'current_lat' : $("#current_lat").val(),
	  'current_lng' : $("#current_lng").val()
	};

	$.ajax({
	  url      : "/<?=$this->nationcode.'/'.mapping('search')?>/famous_product_list",
	  type     : "POST",
	  dataType : "html",
	  async    : true,
	  data     : formData,
	  success: function(result) {
			$("#famous_ajax_list").html(result);
	  }
	});
}




// 최근 검색어 영역 노출 토글
var search_text_input = document.querySelector("#search_text");
// search_text_input.addEventListener("keydown",function(e){
// 	if (e.target.value!="") {
// 		$("#tab_ul").css('display','none');
// 		$("#tab_div").css('display','none');
// 		$("#searching_div").css('display','');

// 		$("#btn_back_area").css('display','');
// 		$("#search_wrap_area").css('width','');


// 	}else {
// 		// $("#tab_ul").css('display','');
// 		// $("#tab_div").css('display','');
// 		// $("#searching_div").css('display','none');
// 		//
// 		// $("#btn_back_area").css('display','none');
// 		// $("#search_wrap_area").css('width','100%');

// 	}
// })
search_text_input.addEventListener("focus",function(e){
	$("#tab_ul").css('display','none');
	$("#tab_div").css('display','none');
	$("#searching_div").css('display','');

	$("#btn_back_area").css('display','');
	$("#search_wrap_area").css('width','');

})
search_text_input.addEventListener("keydown",function(e){
	$("#tab_ul").css('display','none');
	$("#tab_div").css('display','none');
	$("#searching_div").css('display','');

	$("#btn_back_area").css('display','');
	$("#search_wrap_area").css('width','');

})

function hide_back_btn(){
	$("#search_text").val('');

	$("#tab_ul").css('display','');
	$("#tab_div").css('display','');
	$("#no_data_0").css('display','none');
	$("#no_data_1").css('display','none');
	$("#filter_btn").css('display','none');
	$("#searching_div").css('display','none');

	$("#btn_back_area").css('display','none');
	$("#search_wrap_area").css('width','100%');

	// ajax_list display
	$("#famous_div_0").css('display','block');
	$("#famous_div_1").css('display','block');
	$("#list_ajax_0").html('');
	$("#list_ajax_1").html('');

}

function show_back_btn(){
	var search_text = $("#search_text").val();

	if(search_text==""){
		return;
	}

	$("#btn_back_area").css('display','');
	$("#search_wrap_area").css('width','');

}


// 최근 검색어 등록
function search_reg_in(search_type){

	if ('<?=$this->member_idx?>'=='') {
		return;
	}

	var search_text = $("#search_text").val();

	if(search_text==""){
		return;
	}

	var formData = {
	  'search_text' : search_text,
	  'search_type' : search_type
	};


  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('search')?>/search_reg_in",
    type     : 'POST',
    dataType : 'html',
    async    : true,
    data     : formData,
    success: function(result){
			console.log(result);
      // if(result.code == '-1'){
      //   alert(result.code_msg);
      //   $("#"+result.focus_id).focus();
      //   return;
      // }
      // // 0:실패 1:성공
      // if(result.code == 0) {
			// 	alert(result.code_msg);
      // } else {
			// 	var str = "";
			// 	str += "<li class=\"search_li\" id=\"search_li_"+result.search_idx+"\">";
			// 	str += "	<a href=\"javascript:void(0)\" onclick=\"$('#search_text').val('"+search_text+"');default_list_get('1','0');default_list_get('1','1');search_reg_in('0')\">";
			// 	str += 			search_text;
			// 	str += "	</a>";
			// 	str += "	<img src=\"/images/i_delete_gray.png\" onclick=\"search_del('"+result.search_idx+"')\" alt=\"x\" class=\"btn_delete\">";
			// 	str += "</li>";

			// 	$("#list_ajax").prepend(str);

      // }
			$("#list_ajax").html(result);
    }
  });
}

// 최근 검색어 삭제
function search_del(search_idx){

	if ('<?=$this->member_idx?>'=='') {
		return;
	}

	var formData = {
		'search_idx' : search_idx
	};

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('search')?>/search_del",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
				alert(result.code_msg);
      } else {
				// alert(result.code_msg);
				$("#search_li_"+search_idx).remove();
				if ($(".search_li").length==0) {
					$("#no_data").css('display','block');

				}
      }
    }
  });
}

// 최근 검색어 삭제
function search_del_all(){

	if ('<?=$this->member_idx?>'=='') {
		return;
	}

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('search')?>/search_del_all",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : 1,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
				alert(result.code_msg);
      } else {
				// alert(result.code_msg);
				$(".search_li").remove();
				$("#no_data").css('display','block');

      }
    }
  });
}



// 중고거래 글 좋아요
function product_like_reg_in(product_idx, element){

	var formData = {
		"product_idx" : product_idx
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('product')?>/product_like_reg_in",
		type     : 'POST',
		dataType : 'json',
		async    : true,
		data     : formData,
		success: function(result){
			if(result.code == "0"){
				alert(result.code_msg);
			}else{
				// wish_btn(element);
				wish_btn($('#like_span_'+product_idx));
				$('#like_cnt_'+product_idx).html(result.like_cnt);

				// alert(result.code_msg);
				// default_list_get($('#page_num').val());
				// $('#product_table_'+product_idx).remove();
				// location.reload();
			}
		}
	});
}

// 중고거래 글 좋아요(인기상품용)
function product_like_reg_in2(product_idx, element){

	var formData = {
		"product_idx" : product_idx
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('product')?>/product_like_reg_in",
		type     : 'POST',
		dataType : 'json',
		async    : true,
		data     : formData,
		success: function(result){
			if(result.code == "0"){
				alert(result.code_msg);
			}else{
				// wish_btn(element);
				wish_btn($('#_like_span_'+product_idx));
				$('#_like_cnt_'+product_idx).html(result.like_cnt);

				// alert(result.code_msg);
				// default_list_get($('#page_num').val());
				// $('#product_table_'+product_idx).remove();
				// location.reload();
			}
		}
	});
}

// 스크랩
function board_scrap_reg_in(board_idx, element){

  var formData = {
    "board_idx" : board_idx
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_scrap_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        // wish_btn(element);
        wish_btn($('#scrap_span_'+board_idx));
        $('#scrap_cnt_'+board_idx).html(result.scrap_cnt);

        // alert(result.code_msg);
        // default_list_get($('#page_num').val());
        // $('#board_table_'+board_idx).remove();
        // location.reload();
      }
    }
  });
}

// 추천
function board_recommend_reg_in(board_idx, element){

  var formData = {
    "board_idx" : board_idx
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_recommend_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        // wish_btn(element);
        wish_btn($('#recommend_span_'+board_idx));
        $('#recommend_cnt_'+board_idx).html(result.recommend_cnt);

        // alert(result.code_msg);
        // default_list_get($('#page_num').val());
        // $('#board_table_'+board_idx).remove();
        // location.reload();
      }
    }
  });
}

</script>



<script type="text/javascript">
// 탭메뉴 토글기능
  $(document).ready(function() {
    $(".tab_area_wrap > div").hide();
    $(".tab_area_wrap > div").first().show();
    $(".tab_toggle_menu li").click(function() {
      var list = $(this).index();
      $(".tab_toggle_menu li").removeClass("active");
      $(this).addClass("active");

      $(".tab_area_wrap > div").hide();
      $(".tab_area_wrap > div").eq(list).show();
    });
  });
</script>

<script type="text/javascript">

// main_visual
var main_visual = new Swiper('.main_visual', {
	slidesPerView: 1,
	slidesPerGroup:1,
	touchReleaseOnEdges:true,
  pagination: {
    el: ".main_visual .swiper-pagination",
    dynamicBullets: true,
  },
});
// 위시리스트 토글버튼
function wish_btn(element){
  if($(element).hasClass("on")){
    $(element).removeClass("on");
  } else {
    $(element).addClass("on");
  }
}

$(function(){
  // 전체보기
  $('.more_view').click(function(){
    $(this).siblings('.txt').css('-webkit-line-clamp','initial');
    $(this).css('display','none');
  })

})
</script>

<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1><?=lang("lang_profile_00819","프로필")?></h1>
</header>
<!-- header : e -->

<div class="body row">
	<div class="mypage_top">
		<table class="tbl_mypage">
			<colgroup>
				<col width="60">
				<col width="*">
			</colgroup>
			<tr>
				<th rowspan="2">
					<div class="img_box">
						<img src="<?=$result->member_img?>" onerror="this.src='/images/default_user.png'">
					</div>
				</th>
				<td>
					<h5 class="inline_block"><?=$result->member_name?></h5>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="fs_12 font_gray_9"><?=$result->member_id?></div>
				</td>
			</tr>
		</table>
	</div>
  <ul class="mypage_icons_ul">
    <li>
      <a href="javascript:void(0)">
			<img src="<?=$this->global_function->get_free_product_img($result->free_product_cnt)?>"  onerror="this.src=''">

			<!-- <? if($result->free_product_cnt>=3){ ?>
        <img src="<?=$this->global_function->get_free_product_img($result->free_product_cnt)?>"  onerror="this.src=''">
      <? } else {?>
        <div style="margin: 0 auto 4px;width: 28px;height: 28px"></div>
      <? } ?> -->
				<!-- <img src="<?=$this->global_function->get_free_product_img($result->free_product_cnt)?>"  onerror="this.src='/images/i_tree.png'"> -->
        <?=number_format($result->free_product_cnt)?>
      </a>
    </li>
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('badge')?>?access_type=1&member_idx=<?=$member_idx?>">
        <img src="<?=$this->global_function->get_badge_info($result->my_badge)->img_path_on?>"  onerror="this.src='/images/badge_off.png'">
        <?=lang("lang_profile_00820","대표 배지")?>
      </a>
    </li>
    <li>
      <a href="javascript:void(0)">
        <img src="/images/i_manner1_b.png">
        <?=number_format($result->good_product_cnt)?>
      </a>
    </li>
    <li>
      <a href="javascript:void(0)">
        <img src="/images/i_manner2_b.png">
        <?=number_format($result->bad_product_cnt)?>
      </a>
    </li>
  </ul>
  <div class="tab_profile">
    <ul class="tab_toggle_menu mt30 clearfix">
      <li class="active">
        <a href="javascript:void(0)"  onclick="set_tab('0')" id="tab_cnt_0"><?=lang("lang_profile_00285","판매 상품 목록")?></a>
      </li>
      <li>
        <a href="javascript:void(0)" onclick="set_tab('1')"><?=lang("lang_profile_00286","받은 거래 후기")?></a>
      </li>
    </ul>
    <div class="tab_area_wrap">
      <!-- 탭 영역 1 : s -->
      <div class="inner_wrap">
				<ul class="home_ul mb70" id="list_ajax_0"></ul>
      </div>
      <!-- 탭 영역 1 : e -->
      <!-- 탭 영역 2 : s -->
      <div class="">
        <div class="eval_title">
          <img src="/images/i_manner1_b.png" alt="">
          <?=lang("lang_profile_00302","좋음 평가")?>
        </div>
        <ul class="eval_info_ul">
					<li>
			      <?=lang("lang_profile_00303","적당한 가격")?>
			      <span class="num"><?=$result->good_product_cnt_0?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00304","시간 개념")?>
			      <span class="num"><?=$result->good_product_cnt_1?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00305","빠른 응답")?>
			      <span class="num"><?=$result->good_product_cnt_2?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00306","신뢰성")?>
			      <span class="num"><?=$result->good_product_cnt_3?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00307","매너 좋음")?>
			      <span class="num"><?=$result->good_product_cnt_4?></span>
			    </li>
        </ul>
        <div class="eval_title">
          <img src="/images/i_manner2_b.png" alt="">
          <?=lang("lang_profile_00308","나쁜 평가")?>
        </div>
        <ul class="eval_info_ul">
					<li>
			      <?=lang("lang_profile_00309","가격 비쌈")?>
			      <span class="num"><?=$result->bad_product_cnt_0?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00310","가격을 속임")?>
			      <span class="num"><?=$result->bad_product_cnt_1?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00311","시간 안 지킴")?>
			      <span class="num"><?=$result->bad_product_cnt_2?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00312","응답 느림")?>
			      <span class="num"><?=$result->bad_product_cnt_3?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00313","약속장소 안 나타남")?>
			      <span class="num"><?=$result->bad_product_cnt_4?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00314","거래 취소함")?>
			      <span class="num"><?=$result->bad_product_cnt_5?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00315","거래거부")?>
			      <span class="num"><?=$result->bad_product_cnt_6?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00316","불친절")?>
			      <span class="num"><?=$result->bad_product_cnt_7?></span>
			    </li>
        </ul>
        <div class="eval_title">
          <img src="/images/i_gift.png" alt="">
          <?=lang("lang_profile_00317","나눔 피드백")?>
        </div>
        <ul class="eval_info_ul">
					<li>
			      <?=lang("lang_profile_00318","행복하세요")?>
			      <span class="num"><?=$result->free_product_cnt_0?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00319","희망을 잃지 마세요")?>
			      <span class="num"><?=$result->free_product_cnt_1?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00320","건강 하세요")?>
			      <span class="num"><?=$result->free_product_cnt_2?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00321","도움이 되길 바랍니다.")?>
			      <span class="num"><?=$result->free_product_cnt_3?></span>
			    </li>
        </ul>
        <div class="eval_title">
          <img src="/images/i_thanks.png" alt="">
          <?=lang("lang_profile_00322","고마움 피드백")?>
        </div>
        <ul class="eval_info_ul">
					<li>
			      <?=lang("lang_profile_00323","행복을 나눠 주셔서 감사합니다.")?>
			      <span class="num"><?=$result->free_product_cnt_4?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00324","희망을 얻었습니다.")?>
			      <span class="num"><?=$result->free_product_cnt_5?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00325","마음의 위로를 받았습니다.")?>
			      <span class="num"><?=$result->free_product_cnt_6?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00326","감사합니다.")?>
			      <span class="num"><?=$result->free_product_cnt_7?></span>
			    </li>
			    <li>
			      <?=lang("lang_profile_00327","꼭 보답하겠습니다.")?>
			      <span class="num"><?=$result->free_product_cnt_8?></span>
			    </li>
        </ul>
      </div>
      <!-- 탭 영역 2 : e -->
    </div>
  </div>
</div>

<input type="hidden" name="member_idx" id="member_idx" value="<?=$member_idx?>">
<input type="hidden" name="tab_type" id="tab_type" value="0">
<input type="hidden" name="total_block" id="total_block_0" value="1">
<input type="hidden" name="total_block" id="total_block_1" value="1">
<input type="hidden" name="current_lat" id="current_lat" value="37.5185682">
<input type="hidden" name="current_lng" id="current_lng" value="127.0230294">

<script type="text/javascript">
var tab_type = '0';
function set_tab(tab_type_val){
	$("#tab_type").val(tab_type_val);
	tab_type = tab_type_val;
}

$(function(){
	setTimeout("default_list_get('1','0')", 100);
});

var page_num_0=1;

$(window).scroll(function(){
  if (tab_type=='0') {
    var scrollHeight = $(document).height();
    var scrollPosition = $(window).height() + $(window).scrollTop();

    if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
      if (tab_type=='0') {
        page_num_0++;
        default_list_get(page_num_0, tab_type);
      }
    }

  }
});

// 상품목록
function default_list_get(page_num, tab_type){

	if (tab_type!='0') {
		return;
	}

	var total_block = parseInt($("#total_block_"+tab_type).val());


	var formData = {
		'page_num' : page_num,
    'member_idx' : $("#member_idx").val(),
    'current_lat' : $("#current_lat").val(),
		'current_lng' : $("#current_lng").val(),
		'tab_type' : tab_type
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('profile')?>/main_list_get",
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


//브릿지 ::: api 좌표가져오기
var agent ="<?=$agent?>";
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

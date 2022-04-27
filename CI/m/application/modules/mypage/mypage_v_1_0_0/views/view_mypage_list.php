<!-- header : s -->
<header>
  <h1><?=lang("lang_mypage_00511","마이페이지")?></h1>
	<a class="btn_cate" href="/<?=$this->nationcode.'/'.mapping('setting')?>">
		<img src="/images/head_btn_setting.png" alt="category">
	</a>
	<a class="btn_alarm" href="/<?=$this->nationcode.'/'.mapping('alarm')?>">
		<img src="/images/head_btn_alram.png" alt="알림">
	</a>
</header>
<!-- header : e -->

<div class="body footer_margin row">
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
					<a href="/<?=$this->nationcode.'/'.mapping('mypage')?>/point_list"><h4 class="inline_block f_right"><?=number_format($result->member_point)?> P</h4></a>
				</td>
			</tr>
			<tr>
				<td colspan="2">
          <?if($result->member_join_type=='C'){?>
            <div class="fs_12 font_gray_9"><?=$result->member_id?></div>

          <?}elseif($result->member_join_type=='G'){?>
            <div class="fs_12 font_gray_9"><?=lang("lang_member_info_00696","구글 로그인")?></div>

          <?}elseif($result->member_join_type=='F'){?>
            <div class="fs_12 font_gray_9"><?=lang("lang_member_info_00697","페이스북 로그인")?></div>

          <?} ?>
				</td>
			</tr>
		</table>
	</div>
  <div class="inner_wrap">
    <div class="btn_full_thin btn_gray_line2 mt15">
      <a href="/<?=$this->nationcode.'/'.mapping('badge')?>?access_type=0"><?=lang("lang_mypage_00512","보유 배지 보기")?></a>
    </div>
  </div>
  <ul class="mypage_icons_ul">
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('eval')?>/history_list">
        <img src="<?=$this->global_function->get_free_product_img($result->free_product_cnt)?>"  onerror="this.src=''">
      <!-- <? if($result->free_product_cnt>=3){ ?>
        <img src="<?=$this->global_function->get_free_product_img($result->free_product_cnt)?>"  onerror="this.src=''">
      <? } else {?>
        <div style="margin: 0 auto 4px;width: 28px;height: 28px"></div>
      <? } ?> -->
        <?=number_format($result->free_product_cnt)?>
      </a>
    </li>
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('eval')?>/history_list">
        <img src="/images/i_manner1_b.png">
        <?=number_format($result->good_product_cnt)?>
      </a>
    </li>
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('eval')?>/history_list">
        <img src="/images/i_manner2_b.png">
        <?=number_format($result->bad_product_cnt)?>
      </a>
    </li>
  </ul>

  <div class="tab_mypage">
    <ul class="tab_toggle_menu clearfix">
      <li class="active">
        <a href="javascript:void(0)" onclick="set_sub_tab('0')" ><?=lang("lang_mypage_00514","판매 내역")?></a>
      </li>
      <li id="tab_li_2">
        <a href="javascript:void(0)" onclick="set_tab('2')" id="tab_cnt_2" ><?=lang("lang_mypage_00515","구매 내역")?>(<?=$result2->cnt_2>=1000?round($result2->cnt_2/1000,1)."K":$result2->cnt_2?>)</a>
      </li>
      <li id="tab_li_3">
        <a href="javascript:void(0)" onclick="set_sub_tab('1')" ><?=lang("lang_mypage_00516","커뮤니티")?></a>
      </li>
      <li>
        <a href="javascript:void(0)" onclick="set_tab('6')"  id="tab_cnt_6"><?=lang("lang_mypage_00517","찜")?>(<?=$result2->cnt_6>=1000?round($result2->cnt_6/1000,1)."K":$result2->cnt_6?>)</a>
      </li>
    </ul>

    <div class="tab_area_wrap">
      <!-- 탭 영역 1 : s -->
      <div class="">

        <ul class="mypage_filter_slt_ul tab_toggle_menu2">
          <li class="active" onclick="set_tab('0')" id="tab_cnt_0">
            <?=lang("lang_mypage_00518","판매 중")?>(<?=$result2->cnt_0>=1000?round($result2->cnt_0/1000,1)."K":$result2->cnt_0?>)
          </li>
          <li onclick="set_tab('1')" id="tab_cnt_1">
            <?=lang("lang_mypage_00519","거래 완료")?>(<?=$result2->cnt_1>=1000?round($result2->cnt_1/1000,1)."K":$result2->cnt_1?>)
          </li>
        </ul>

        <div class="tab_area_wrap2">
          <div class="">
            <div class="no_datas" id="no_data_0"  style="display:none">
              <img src="/images/Icons-search-gray_p.png" alt="">
              <p><?=lang("lang_mypage_00521","판매 중인 상품이 없습니다.<br>판매할 상품을 등록해 보세요!</p>")?>
            </div>
            <ul class="home_ul"  id="list_ajax_0">

            </ul>
          </div>

          <div class="">
            <div class="no_datas" id="no_data_1"  style="display:none">
              <img src="/images/Icons-search-gray_p.png" alt="">
              <p><?=lang("lang_community_00790","거래 완료된 상품이 없습니다.")?></p>
            </div>
            <ul class="home_ul"  id="list_ajax_1"></ul>
          </div>

        </div>
      </div>
      <!-- 탭 영역 1 : e -->

      <!-- 탭 영역 2 : s -->
      <div class="inner_wrap">

        <div class="no_datas" id="no_data_2"  style="display:none">
          <img src="/images/Icons-search-gray_p.png" alt="">
          <p><?=lang("lang_community_00791","구매한 내역이 없습니다.")?></p>
        </div>

        <ul class="home_ul mb70" id="list_ajax_2"></ul>
      </div>
      <!-- 탭 영역 2 : e -->
      <!-- 탭 영역 3 : s -->
      <div class="">
        <div class="inner_wrap">
          <ul class="mypage_filter_slt_ul mt16 tab_toggle_menu3">
            <li class="active"  onclick="set_tab('3')" id="tab_cnt_3">
              <?=lang("lang_mypage_00538","내 게시글")?>(<?=$result2->cnt_3>=1000?round($result2->cnt_3/1000,1)."K":$result2->cnt_3?>)
            </li>
            <li  onclick="set_tab('4')" id="tab_cnt_4">
              <?=lang("lang_mypage_00539","내 댓글")?>(<?=$result2->cnt_4>=1000?round($result2->cnt_4/1000,1)."K":$result2->cnt_4?>)
            </li>
            <li  onclick="set_tab('5')" id="tab_cnt_5">
              <?=lang("lang_mypage_00540","스크랩")?>(<?=$result2->cnt_5>=1000?round($result2->cnt_5/1000,1)."K":$result2->cnt_5?>)
            </li>
          </ul>
        </div>

        <?
        $return_url_str = "/".$this->nationcode.'/'.mapping('community')."/community_reg";
        $fnc_str = "location.href=\'".$return_url_str."\'";
        ?>
        <a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')"><img src="/images/floating_btn.png" alt="reg" class="btn_float"></a>
        <!-- <a href="/<?=$this->nationcode.'/'.mapping('community')?>/community_reg"><img src="/images/floating_btn.png" alt="reg" class="btn_float"></a> -->

        
        <div class="tab_area_wrap3">
          <div class="">
            <div class="no_datas" id="no_data_3"  style="display:none">
              <img src="/images/Icons-search-gray_b.png" alt="">
              <p><?=lang("lang_community_00792","등록한 게시글이 없습니다.")?></p>
            </div>
            <div class="">
              <ul class="community_ul mb70" id="list_ajax_3"></ul>
            </div>
          </div>

          <div class="">
            <div class="no_datas" id="no_data_4"  style="display:none">
              <img src="/images/Icons-search-gray_c.png" alt="">
              <p><?=lang("lang_community_00793","등록한 댓글이 없습니다.")?></p>
            </div>
            <div class="">
              <ul class="community_reply_ul" id="list_ajax_4"></ul>
            </div>
          </div>

          <div class="">
            <div class="no_datas" id="no_data_5"  style="display:none">
              <img src="/images/Icons-search-gray_s.png" alt="">
              <p><?=lang("lang_community_00792","등록한 게시글이 없습니다.")?></p>
            </div>
            <div class="" >
              <ul class="community_ul" id="list_ajax_5">

              </ul>
            </div>
          </div>
        </div>
        <!-- 스크랩:e -->

        <!-- 스크랩:e -->
      </div>
      <!-- 탭 영역 3 : e -->
      <!-- 탭 영역 4 : s -->
      <div class="inner_wrap">

        <div class="no_datas" id="no_data_6"  style="display:none">
          <img src="/images/Icons-search-gray_h.png" alt="">
          <p><?=lang("lang_community_00794","찜한 목록이 없습니다.")?></p>
        </div>

        <ul class="home_ul" id="list_ajax_6"></ul>
      </div>
      <!-- 탭 영역 4 : e -->
    </div>
  </div>
</div>
<!-- <div class="modal_more">
  <ul class="more_ul">
    <li>
      <a href="/<?=$this->nationcode.'/'.mapping('community')?>/community_mod"><?=lang("lang_product_00212","수정")?></a>
    </li>
    <li class="close">
      <a href="javascript:void(0)" onclick="modal_close_slide('more')"><?=lang("lang_product_00204","취소")?></a>
    </li>
  </ul>
</div>
<div class="md_overlay md_overlay_more" onclick="modal_close_slide('more');"></div> -->


<div class="modal_more">
  <ul class="more_ul">
    <? if($this->member_del_yn=='N'){ ?>
      <li id="mod_btn_li">
        <a href="/<?=$this->nationcode.'/'.mapping('community')?>/community_mod" id="mod_btn"><?=lang("lang_community_00447","수정")?></a>
      </li>
    <? } ?>
    
    <li id="del_btn_li">
      <a href="javascript:void(0)" onclick="community_del('0')" id="del_btn"><?=lang("lang_community_00448","삭제")?></a>
    </li>
    <li id="report_btn_li">
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more');"><?=lang("lang_community_00431","신고")?></a>
    </li>
    <li class="close">
      <a href="javascript:void(0)" onclick="modal_close_slide('more')"><?=lang("lang_community_00445","취소")?></a>
    </li>
  </ul>
</div>
<div class="md_overlay md_overlay_more" onclick="modal_close_slide('more');"></div>

<!-- modal : s -->
<div class="modal modal_report">
  <div class="" onclick="event.stopPropagation();">
    <div class="title"><?=lang("lang_community_00431","신고")?></div>
    <p class="txt">
      <?=lang("lang_community_00439","부적절한 내용인가요?<br>모두가 즐길 수 있는 컨텐츠를 만들기 위해<br>서는 신고가 필요합니다.")?>
    </p>
    <select class="" name="report_type" id="report_type">
      <option value=""><?=lang("lang_community_00440","선택")?></option>
      <option value="0"><?=lang("lang_community_00441","욕설, 비방글")?></option>
      <option value="1"><?=lang("lang_community_00442","음란성 글")?></option>
      <option value="2"><?=lang("lang_community_00443","기타 비매너")?></option>
    </select>
    <textarea  name="report_contents" id="report_contents" class="mt4" placeholder="<?=lang("lang_community_00444","신고사유를 정확하게 입력해 주세요.")?>"></textarea>
    <div class="btn_md_wrap">
      <span class="btn_md_left btn_gray">
        <a href="javascript:void(0)" onclick="modal_close('report')"><?=lang("lang_community_00445","취소")?></a>
      </span>
      <span class="btn_md_right btn_sub_point">
        <a  href="javascript:void(0)" onclick="board_report_reg_in()" id="report_reg_btn"><?=lang("lang_community_00431","신고")?></a>
      </span>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_report" onclick="javascript:modal_close('report')"></div>
<!-- modal : e -->

<input type="hidden" name="modal_open_yn" id="modal_open_yn" value="N">
<input type="hidden" name="tab_type" id="tab_type" value="0">
<!-- 판매내역 -->
<input type="hidden" name="sub_tab_type" id="sub_tab_type_0" value="0">
<!-- 커뮤니티 -->
<input type="hidden" name="sub_tab_type" id="sub_tab_type_1" value="3">
<input type="hidden" name="total_block" id="total_block_0" value="1">
<input type="hidden" name="total_block" id="total_block_1" value="1">
<input type="hidden" name="total_block" id="total_block_2" value="1">
<input type="hidden" name="total_block" id="total_block_3" value="1">
<input type="hidden" name="total_block" id="total_block_4" value="1">
<input type="hidden" name="total_block" id="total_block_5" value="1">
<input type="hidden" name="total_block" id="total_block_6" value="1">
<input type="hidden" name="current_lat" id="current_lat" value="37.5185682">
<input type="hidden" name="current_lng" id="current_lng" value="127.0230294">


<script type="text/javascript">


$(document).ready(function(){
	api_request_position();
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

$(document).ready(function() {
	$(".tab_area_wrap2 > div").hide();
	$(".tab_area_wrap2 > div").first().show();
	$(".tab_toggle_menu2 li").click(function() {
		var list = $(this).index();
		$(".tab_toggle_menu2 li").removeClass("active");
		$(this).addClass("active");

		$(".tab_area_wrap2 > div").hide();
		$(".tab_area_wrap2 > div").eq(list).show();
	});
});

$(document).ready(function() {
	$(".tab_area_wrap3 > div").hide();
	$(".tab_area_wrap3 > div").first().show();
	$(".tab_toggle_menu3 li").click(function() {
		var list = $(this).index();
		$(".tab_toggle_menu3 li").removeClass("active");
		$(this).addClass("active");

		$(".tab_area_wrap3 > div").hide();
		$(".tab_area_wrap3 > div").eq(list).show();
	});
});

var search_type = '0';
function set_sub_tab(tmp_type){
  var sub_tab_type = $("#sub_tab_type_"+tmp_type).val();
  $("#tab_type").val(sub_tab_type);
  search_type = tab_type;
}

var tab_type = '0';
function set_tab(tab_type){
  $("#tab_type").val(tab_type);
  search_type = tab_type;

  if (tab_type=='0' || tab_type=='1') {
    $("#sub_tab_type_0").val(tab_type);
  }else if (tab_type=='3' || tab_type=='4' || tab_type=='5') {
    $("#sub_tab_type_1").val(tab_type);
  }

}

$(function(){
	// setTimeout("set_total()", 10);
	setTimeout("default_list_get('1','0')", 100);
	setTimeout("default_list_get('1','1')", 200);
	setTimeout("default_list_get('1','2')", 300);
	setTimeout("default_list_get('1','3')", 400);
	setTimeout("default_list_get('1','4')", 500);
	setTimeout("default_list_get('1','5')", 600);
	setTimeout("default_list_get('1','6')", 700);
});

var page_num_0=1;
var page_num_1=1;
var page_num_2=1;
var page_num_3=1;
var page_num_4=1;
var page_num_5=1;
var page_num_6=1;

var modal_open_yn='N';
$(window).scroll(function(){
  if (modal_open_yn=='N') {
    var scrollHeight = $(document).height();
    var scrollPosition = $(window).height() + $(window).scrollTop();

    if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
      if (search_type=='0') {
        page_num_0++;
        default_list_get(page_num_0, search_type);
      }else if (search_type=='1') {
        page_num_1++;
        default_list_get(page_num_1, search_type);
      }else if (search_type=='2') {
        page_num_2++;
        default_list_get(page_num_2, search_type);
      }else if (search_type=='3') {
        page_num_3++;
        default_list_get(page_num_3, search_type);
      }else if (search_type=='4') {
        page_num_4++;
        default_list_get(page_num_4, search_type);
      }else if (search_type=='5') {
        page_num_5++;
        default_list_get(page_num_5, search_type);
      }else if (search_type=='6') {
        page_num_6++;
        default_list_get(page_num_6, search_type);
      }
    }

  }
});

function default_list_get(page_num, tab_type){

  var total_block = $("#total_block_"+tab_type).val();

	var formData = {
		'page_num' : page_num,
    'current_lat' : $("#current_lat").val(),
		'current_lng' : $("#current_lng").val(),
		'tab_type' : tab_type
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('mypage')?>/main_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {

			if(page_num == 1){
        $("#list_ajax_"+tab_type).html(result);
        $("#list_ajax_"+tab_type).css('display','block');
        $("#search_ul_"+tab_type).css('display','none');

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



// 중고거래 글 좋아요
function product_like_reg_in(product_idx, tba_type){

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
        $('.like_span_'+product_idx).each(function(){
          wish_btn(this);
        });

				$('.like_cnt_'+product_idx).html(result.like_cnt);

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

        wish_btn($('#scrap_span2_'+board_idx));
        $('#scrap_cnt2_'+board_idx).html(result.scrap_cnt);

        // alert(result.code_msg);
        // default_list_get($('#page_num').val());
        // $('#board_table_'+board_idx).remove();
        // location.reload();
      }
    }
  });
}


// 게시글 삭제
function board_del(board_idx){

if (!confirm("<?=lang("lang_community_00449","삭제 하시겠습니까?")?>")) {
  return;
}

var formData = {
  "board_idx" : board_idx
};

$.ajax({
  url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_del",
  type     : 'POST',
  dataType : 'json',
  async    : true,
  data     : formData,
  success: function(result){
    if(result.code == '-1') {
      alert(result.code_msg);
      $("#"+result.focus_id).focus();
      return;
    }

    if(result.code == "0"){
      alert(result.code_msg);
    }else{
      alert(result.code_msg);
      $('.board_li_'+board_idx).each(function(){
        $(this).remove();
      });
      if ($(".board_li").length==0) {
        $("#no_data").css("display","block");
      }
      modal_close_slide();
      my_board_cnt();
    }
  }
});
}

function my_board_cnt(){

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/my_board_cnt",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : 1,
    success: function(result){

      if(result.code == "0"){
        // alert(result.code_msg);
      }else{
        var cnt = result.board_cnt>=1000?parseInt(result.board_cnt).toFixed(1)+"K":result.board_cnt;
        $("#tab_cnt_3").html("<?=lang("lang_mypage_00538","내 게시글")?>("+cnt+")");

      }
    }
  });
}

// 메뉴 세팅
function set_report(my_board_yn, report_yn, board_idx){

  var formData = {
    "board_idx" : board_idx
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_del_check",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == '-1') {
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }

      if(result.code == "0"){
        alert(result.code_msg);
        location.reload();

      }else{
        modal_open_slide('more');
        // 삭제버튼 노출여부 확인
        if (my_board_yn=='Y') {
          $("#report_btn_li").css('display','none');
          $("#mod_btn").attr("href", "/<?=$this->nationcode.'/'.mapping('community')?>/community_mod?board_idx="+board_idx);
          $("#mod_btn_li").css('display','block');
          $("#del_btn_li").css('display','block');
          $("#del_btn").attr("onclick", "board_del("+board_idx+")");
        }else {
          if (report_yn=='Y') {
            $("#report_btn_li").css('display','none');
          }else {
            $("#report_btn_li").css('display','block');
            $("#report_reg_btn").attr("onclick","board_report_reg_in('"+board_idx+"')");
          }
          $("#mod_btn_li").css('display','none');
          $("#del_btn_li").css('display','none');
        }

      }
    }
  });



}


// 게시글 신고
function board_report_reg_in(board_idx){

var formData = {
  "board_idx" : board_idx,
  "report_contents" : $("#report_contents").val(),
  "report_type" : $("#report_type").val()
};

$.ajax({
  url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_report_reg_in",
  type     : 'POST',
  dataType : 'json',
  async    : true,
  data     : formData,
  success: function(result){
    if(result.code == '-1') {
      alert(result.code_msg);
      $("#"+result.focus_id).focus();
      return;
    }

    if(result.code == "0"){
      alert(result.code_msg);
    }else{
      alert(result.code_msg);
      // modal_close('more');
      modal_close('report');
      $("#btn_more_"+board_idx).attr("onclick","set_report('N', 'Y', '"+board_idx+"');modal_open_slide('more')");
    }
  }
});
}



</script>

<script type="text/javascript">
// 더보기 슬라이드
$(function(){
  let more_view_height = $('.modal_more').outerHeight();
  $('.modal_more').css('bottom',-more_view_height);
})
function modal_open_slide(e){
  $(".md_overlay_" + 'more').css("visibility", "visible").animate({opacity: 1}, 100);
  $(".modal_" + 'more').css({bottom: "0"});
  $.lockBody();
}

function modal_close_slide(e){
  $(".md_overlay_" + 'more').css("visibility", "hidden").animate({opacity: 0}, 100);
  $(".modal_" + 'more').css({bottom: "-400px"});
  $.unlockBody();
}

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

    // 전체보기
    $('.more_view').click(function(){
      $(this).siblings('.txt').css('-webkit-line-clamp','initial');
      $(this).css('display','none');
    })

    if ('<?=$tab_type?>'=='1') {
      document.getElementById('tab_cnt_1').click();

    }else if ('<?=$tab_type?>'=='2') {
      document.getElementById('tab_li_2').click();

    }else if ('<?=$tab_type?>'=='3') {
      document.getElementById('tab_li_3').click();

    }else if ('<?=$tab_type?>'=='4') {
      document.getElementById('tab_li_3').click();
      document.getElementById('tab_cnt_4').click();

    }


  });

  // main_visual
  // var main_visual = new Swiper('.main_visual', {
  // 	slidesPerView: 1,
  // 	slidesPerGroup:1,
  // 	touchReleaseOnEdges:true,
  //   pagination: {
  //     el: ".main_visual .swiper-pagination",
  //     dynamicBullets: true,
  //   },
  // });

  // 위시리스트 토글버튼
  function wish_btn(element){
  	if($(element).hasClass("on")){
  		$(element).removeClass("on");
  	} else {
  		$(element).addClass("on");
  	}
  }
</script>

<?
  $viewer = 'buyer';
  if($this->member_idx == $result->member_idx){
    $viewer = 'seller';
  }
?>
<header class="transparent">
  <img src="/images/head_btn_back_white.png" alt="back" class="head_btn_back_white" onclick="javascript:history.go(-1)">

  <?
  $return_url_str = "/".$this->nationcode.'/'.mapping('product')."/product_detail?product_idx=".$result->product_idx;
  $fnc_str = "modal_open_slide(\'more\')";
  ?>

  <? if($this->member_idx == $result->member_idx && $this->member_del_yn=='P'){ ?>
    <img  onclick="modal_open_slide('more')" src="/images/head_btn_more_white.png" alt="more" class="head_btn_more_white" >
  
  <? } else {?>
    <img  onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" src="/images/head_btn_more_white.png" alt="more" class="head_btn_more_white" >

  <? } ?>

  <!-- <img  onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" src="/images/head_btn_more_white.png" alt="more" class="head_btn_more_white" > -->
</header>
<? if (!empty($result->img_path)) {?>
<div class="swiper-container product_visual">
  <div class="swiper-wrapper">
      <?$img_arr = explode(",",$result->img_path);
      foreach($img_arr as $row){?>
        <div class="swiper-slide">
          <a href="javascript:void(0)" class="img_box"><img src="<?=$row?>"></a>
        </div>
      <?}?>

    </div>
    <!-- Add Scrollbar -->
    <div class="swiper-scrollbar"></div>
  </div>
<?}else {?>
  <div class="swiper-container product_visual">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <a href="javascript:void(0)" class="img_box"><img src="/images/default_img.png"></a>
      </div>

    </div>
    <!-- Add Scrollbar -->
    <div class="swiper-scrollbar"></div>
  </div>
<?} ?>
<div class="product_detail_info_wrap">
  <table class="tbl_product_info">
    <colgroup>
      <col width="65px">
      <col width="*">
      <col width="40px">
    </colgroup>
    <tr>
      <th rowspan="4">
        <a href="/<?=$this->nationcode.'/'.mapping('profile')?>/profile_detail?member_idx=<?=$result->member_idx?>">
          <div class="img_box">
            <img src="<?=$result->member_img?>"  onerror="this.src='/images/default_user.png'" alt="">
          </div>
        </a>
      </th>
    </tr>
      <td>
        <h6><?=$result->member_name?> · <span id="product_distance" style="font-weight: bold"></span> km</h6>
      </td>
      <? if($result->free_product_cnt>=3){ ?>
        <td rowspan="2" class="txt_center">
          <img src="<?=$this->global_function->get_free_product_img($result->free_product_cnt)?>" alt="free" class="free">
          <h6><?=$result->free_product_cnt?></h6>
        </td>
      <? } ?>
    </tr>
    <tr>
      <td>
        <ul class="appr">
          <li>
            <img src="/images/i_manner1.png" alt=""><?=$result->good_product_cnt?>
          </li>
          <li>
            <img src="/images/i_manner2.png" alt=""><?=$result->bad_product_cnt?>
          </li>
        </ul>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <p class="price"><?=$result->product_addr?></pl>
      </td>
    </tr>
  </table>
</div>
<div class="inner_wrap footer_margin">
  <hr class="mb20">
  <h4><?=$result->title?></h4>
  <p class="product_category"><?=$result->category_name?> · <?=$result->list_up_cnt > 0 ? lang("lang_product_00220","끌어올리기") : ''?> <?=$this->global_function->convert_time_exp($result->list_up_date)?></p>
  <h4>
    <? if($result->product_price>0){ ?>
      <span class="fs_16">৳</span> <?=number_format($result->product_price)?>
    <? } else {?>
      <?=lang("lang_main_00132","무료나눔")?>
    <? } ?>
    <ul class="product_detail_info_ul">
      <li>
        <img src="/images/i_eye.png" alt=""> <?=$result->view_cnt?>
      </li>
      <li>
        <img src="/images/icons-comment.png" alt=""> <?=$result->chatting_cnt?>
      </li>
      <li >
				<img src="/images/icons-heart.png" alt="">
				<span id="like_cnt"><?=$result->like_cnt?></span>
			</li>
    </ul>
  </h4>

  <ul class="tag_ul mt30">
    <?$tags_arr = explode(",",$result->tags);
    foreach($tags_arr as $row){?>
      <li onclick="$('#search_tag').val('<?=$row?>');$('#search_text').html('#<?=$row?>');modal_open_yn='Y';default_list_get('1');modal_open('keyword_result')">
        <?=$row?>
      </li>
    <?}?>
  </ul>
  <p class="mt10 contents_txt"><?=$result->contents?></p>
</div>
<div class="btn_bottom_float">

  <?if($viewer == 'buyer'){?>
    <span class="btn_float_left btn_gray_line">
      <? if($this->member_idx != ""){
          $like_yn_get == 'Y' ? $like_yn_get = 'on' : $like_yn_get = '';
      }?>

      <?
      $return_url_str = "/".$this->nationcode.'/'.mapping('product')."/product_detail?product_idx=".$result->product_idx;
      $fnc_str = "product_like_reg_in(\'".$result->product_idx."\',this)";
      ?>
      <a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" class="wish_btn like_2 <?=$like_yn_get?>" id="like_span"></a>
    </span>

    <!-- 구매자 -->
    <?if($result->product_state == '0'){?>

      <?
      $return_url_str = "/".$this->nationcode.'/'.mapping('product')."/product_detail?product_idx=".$result->product_idx;
      $fnc_str = "chatting_room_reg_in(\'".$result->product_idx."\',\'".$result->member_idx."\')";
      ?>

      <span class="btn_float_right btn_point">
        <a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" ><?=lang("lang_product_00779","채팅 문의하기")?></a>
        <!-- <a href="javascript:void(0)"onclick="chatting_room_reg_in('<?=$result->product_idx?>','<?=$result->member_idx?>')" ><?=lang("lang_product_00779","채팅 문의하기")?></a> -->
      </span>
    <?} else if($result->product_state == '1'){?>

      <?
      $return_url_str = "/".$this->nationcode.'/'.mapping('product')."/product_detail?product_idx=".$result->product_idx;
      $fnc_str = "modal_open(\'cancel_alarm\')";
      ?>
      
      <span class="btn_float_right btn_point">
        <a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')"><?=lang("lang_product_00233","예약된 글입니다.")?></a>
        <!-- <a href="javascript:void(0)" onclick="modal_open('cancel_alarm')"><?=lang("lang_product_00233","예약된 글입니다.")?></a> -->
      </span>
    <?} else if($result->product_state == '2'){?>
      <span class="btn_float_right btn_deactive">
        <a href="javascript:void(0)"><?=lang("lang_product_00234","거래 완료된 글입니다.")?></a>
      </span>
    <?}?>

  <!-- 판매자 -->
  <?} else if($viewer == 'seller'){?>
    <span class="btn_float_left btn_deact">
      <a href="javascript:void(0)" class="wish_btn like_2"></a>
    </span>

    <?if($result->product_state == '0'){?>
      <span class="btn_float_right btn_deactive">
        <a href="javascript:void(0)"><?=lang("lang_product_00226","거래중인 상품 입니다.")?></a>
      </span>
    <?} else if($result->product_state == '1'){?>
      <span class="btn_float_right btn_deactive">
        <a href="javascript:void(0)"><?=lang("lang_product_00233","예약된 글입니다.")?></a>
      </span>
    <?} else if($result->product_state == '2'){?>
      <span class="btn_float_right btn_deactive">
        <a href="javascript:void(0)"><?=lang("lang_product_00234","거래 완료된 글입니다.")?></a>
      </span>
    <?}?>
  <?}?>


</div>

<div class="modal modal_cancel_alarm">
  <div class="md_inner" onclick="event.stopPropagation();">
    <h5><?=lang("lang_product_00780","예약된 글")?></h5>
    <p class="md_txt"><?=lang("lang_product_00206","예약된 글에는 채팅으로 문의를 할 수 없습니다. 취소되면 알림으로 알려드릴까요?")?></p>
    <div class="btn_full_weight btn_point">
      <a href="javascript:void(0)" onclick="reserve_reg_in()"><?=lang("lang_product_00197","네")?></a>
    </div>
    <div class="mt15 btn_full_weight btn_gray">
      <a href="javascript:void(0)" onclick="modal_close('cancel_alarm')"><?=lang("lang_product_00196","아니요")?></a>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_cancel_alarm" onclick="modal_close('cancel_alarm');"></div>

<div class="modal modal_keyword_result">
  <header>

    <a class="btn_back" href="javascript:void(0)" onclick="modal_close('keyword_result')">
  		<img src="/images/head_btn_back.png" alt="뒤로가기">
  	</a>
  </header>
  <div class="body inner_wrap">
    <h2 class="mt16" id="search_text">#</h2>
    <ul class="home_ul mb70"  id="list_ajax"></ul>


  </div>
</div>

<div class="modal_more">
  <ul class="more_ul">
    <?if($viewer == 'buyer' && $result->report_cnt==0){?>
      <li class="report_li">
        <a href="javascript:void(0)" onclick="member_state_check('report');modal_close_slide('more');"><?=lang("lang_product_00177","신고")?></a>
      </li>
    <?}?>
    <?if($viewer == 'seller'){?>

      <? if($this->member_del_yn=='P'){ ?>
        <?if($result->product_state == 0){?>

          <li>
            <a href="javascript:void(0)" onclick="default_del();"><?=lang("lang_product_00213","삭제")?></a>
          </li>
    
        <?} else if($result->product_state == 1) {?>

        <?} else if($result->product_state == 2) {?>
          <li>
            <a href="javascript:void(0)" onclick="default_del();"><?=lang("lang_product_00213","삭제")?></a>
          </li>
        <?}?>
      <? }else{?>
        <?if($result->product_state == 0){?>
          
          <li>
            <a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_mod?product_idx=<?=$result->product_idx?>"><?=lang("lang_product_00212","수정")?></a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="default_del();"><?=lang("lang_product_00213","삭제")?></a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="free_list_up();modal_close_slide('more');"><?=lang("lang_product_00214","무료 끌어올리기")?></a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="list_up();modal_close_slide('more');"><?=lang("lang_product_00215","포인트 끌어올리기")?></a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="reserve_confirm();"><?=lang("lang_product_00216","예약하기")?></a>
          </li>
        <?} else if($result->product_state == 1) {?>
          <li>
            <a href="javascript:void(0)" onclick="reserve_cancel();"><?=lang("lang_product_00227","예약 해제하기")?></a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="complete_confirm();"><?=lang("lang_product_00228","완료하기")?></a>
          </li>
        <?} else if($result->product_state == 2) {?>
          <li>
            <a href="javascript:void(0)" onclick="default_del();"><?=lang("lang_product_00213","삭제")?></a>
          </li>
        <?}?>
      <? } ?>

    <?}?>

    <li class="close">
      <a href="javascript:void(0)" onclick="modal_close_slide('more')"><?=lang("lang_product_00224","취소")?></a>
    </li>
  </ul>
</div>
<div class="md_overlay md_overlay_more" onclick="modal_close_slide('more');"></div>

<!-- modal : s -->
<div class="modal modal_report">
  <div class="" onclick="event.stopPropagation();">
    <div class="title"><?=lang("lang_product_00177","신고")?></div>
    <p class="txt">
      <?=lang("lang_community_00439","부적절한 내용인가요?<br>모두가 즐길 수 있는 컨텐츠를 만들기 위해<br>서는 신고가 필요합니다.")?>
    </p>
    <select class="" name="report_type" id="report_type">
      <option value=""><?=lang("lang_community_00440","선택")?></option>
      <option value="0"><?=lang("lang_community_00441","욕설, 비방글")?></option>
      <option value="1"><?=lang("lang_community_00442","음란성 글")?></option>
      <option value="2"><?=lang("lang_community_00443","기타 비매너")?></option>
    </select>
    <textarea class="mt4" name="report_contents" id="report_contents"
    placeholder="<?=lang("lang_product_00781","신고사유를 정확하게 입력해 주세요.")?>"></textarea>
    <div class="btn_md_wrap">
      <span class="btn_md_left btn_gray">
        <a href="javascript:void(0)" onclick="modal_close('report')"><?=lang("lang_community_00445","취소")?></a>
      </span>
      <span class="btn_md_right btn_sub_point">
        <a href="javascript:void(0)" onclick="product_report();"><?=lang("lang_community_00431","신고")?></a>
      </span>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_report" onclick="javascript:modal_close('report')"></div>
<!-- modal : e -->

<input type="hidden" name="member_idx" id="member_idx" value="<?=$this->member_idx?>" >
<input type="hidden" name="product_idx" id="product_idx" value="<?=$result->product_idx?>">
<input type="hidden" name="current_lat" id="current_lat" value="<?=!empty($member_detail->member_lat)?$member_detail->member_lat:37.5185682?>">
<input type="hidden" name="current_lng" id="current_lng" value="<?=!empty($member_detail->member_lng)?$member_detail->member_lng:127.0230294?>">
<input type="hidden" name="distance" id="distance" value="<?=!empty($member_detail->distance)?$member_detail->distance:6?>">
<input type="hidden" name="search_tag" id="search_tag" value="">
<input type="hidden" name="total_block" id="total_block" value="1">

<script type="text/javascript">

$(document).ready(function(){
  // api_request_position();
  setTimeout("product_detail_distance()", 100);
});

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
var swiper = new Swiper(".product_visual", {
	slidesPerView: 1,
	slidesPerGroup:1,
	touchReleaseOnEdges:true,
  scrollbar: {
    el: ".product_visual .swiper-scrollbar",
    hide: false,
  },
});
// 위시리스트 토글버튼
function wish_btn(element){
  // var like_value = Number($(element).text());
  if($(element).hasClass("on")){
    $(element).removeClass("on");
    //$(element).text(like_value - 1);
  } else {
    $(element).addClass("on");
    //$(element).text(like_value + 1);
  }
}



var page_num=1;
var modal_open_yn = 'N';
$(window).scroll(function(){
  if (modal_open_yn=='Y') {
    var scrollHeight = $(document).height();
    var scrollPosition = $(window).height() + $(window).scrollTop();

    if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
      page_num++;
      default_list_get(page_num);
    }
  }
});

function default_list_get(page_num){

	var total_block = parseInt($("#total_block").val());

	var formData = {
		'page_num' : page_num,
		'current_lat' : $("#current_lat").val(),
		'current_lng' : $("#current_lng").val(),
		'distance' : $("#distance").val(),
		'search_tag' : $("#search_tag").val()
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('product')?>/main_list_get",
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



var agent ="<?=$agent?>";
function api_native_window_open(chatting_room_idx, user_idx){
	if(agent == 'android') {
		window.rocateer.native_window_open(chatting_room_idx, user_idx);
	} else if (agent == 'ios') {
  	 var message = {
  	    "request_type" : "native_window_open",
				"chatting_room_idx" : String(chatting_room_idx),
				"user_idx" : String(user_idx)
  	};
	 window.webkit.messageHandlers.native.postMessage(message);
	}
}


// 대화방 생성
function chatting_room_reg_in(product_idx,partner_member_idx){

	var formData = {
		'product_idx' :  product_idx,
		'partner_member_idx' :  partner_member_idx,
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('product')?>/chatting_room_reg_in",
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
        api_native_window_open(result.chatting_room_idx);
        console.log("채팅 실행!");
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
				$('#like_cnt').html(result.like_cnt);

        if($('#like_span').hasClass("on")){
          $('#like_span').removeClass("on");
        } else {
          $('#like_span').addClass("on");
        }

				// alert(result.code_msg);
				// default_list_get($('#page_num').val());
				// $('#product_table_'+product_idx).remove();
				// location.reload();
			}
		}
	});
}

// 상품 좋아요
// function product_like_reg_in(product_idx){
//
//   var member_idx = document.querySelector('#member_idx').value;
//
//   login_check(member_idx); // 로그인 체크
//   member_info_check(); // 회원정보 체크
//
//   var form_data = {
//     "member_idx" : member_idx,
//     "product_idx" : product_idx,
//   };
//
//   $.ajax({
//     url      : "/<?=$this->nationcode.'/'.mapping('product')?>/product_like_reg_in",
//     type     : 'POST',
//     dataType : 'json',
//     async    : true,
//     data     : form_data,
//     success: function(result){
//       if(result.code == "0"){
//       }else{
//         document.querySelector('#like_cnt').lastChild.textContent = ` ${result.like_cnt} `;
//         if(result.like_yn == 'Y'){
//           document.querySelector('.wish_btn').classList.add('on');
//         } else {
//           document.querySelector('.wish_btn').classList.remove('on');
//         }
//       }
//     }
//   });
// }

function product_detail_distance(){

  var form_data = {
    "product_idx" : $('#product_idx').val(),
    "current_lat" : $('#current_lat').val(),
    "current_lng" : $('#current_lng').val()
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('product')?>/product_detail_distance",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      if(result.code == "0"){

      }else{
        $('#product_distance').html(result.distance);

      }
    }
  });
}

// 로그인 체크
function login_check(member_idx){
  var res = '1';
  if(member_idx == ""){
    res =  '0';
    if(confirm('<?=lang("lang_search_00425","로그인이 필요합니다. 로그인 하시겠습니까?")?>')){
      location.href = '<?="/".$this->nationcode.'/'.mapping('login')."?return_url=/".$this->nationcode.'/'.mapping('product').'/product_detail&product_idx='.$result->product_idx?>';
    }
  }
  return res;
}

// 회원정보 체크
function member_info_check(){

  var member_idx = document.querySelector('#member_idx').value;
  var product_idx = document.querySelector('#product_idx').value;

  var form_data = {
    "member_idx" : member_idx,
    "product_idx" : product_idx,
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('member_info').'/member_info_check'?>",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      if(result.code == '0'){
        if(confirm('<?=lang("lang_search_00426","이용을 위해서 추가 정보가 필요합니다.")?>')){
          location.href = '<?="/".$this->nationcode.'/'.mapping('login')."/add_info_reg?return_url=/".$this->nationcode.'/'.mapping('product').'/product_detail?product_idx='.$result->product_idx?>';
          return;
        }
      }
    }
  });

}

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
// reserve_confirm
function reserve_confirm(){
  modal_close_slide('more');
  if (!confirm('<?=lang("lang_add_00830","더이상 채팅 요청을 받으실 수 없습니다.\n진행 하시겠습니까?")?>')) {
    return;
  } else {
    location.href='/<?=$this->nationcode.'/'.mapping('product')?>/reserve_reg?product_idx=<?=$result->product_idx?>';
  }
}

// 예약 상태 해제
function reserve_cancel(){
  modal_close_slide('more');

  if (!confirm('<?=lang("lang_product_00229","예약 상태 해제 하시겠습니까?")?>')) {
    return;
  }

  var product_idx = document.querySelector('#product_idx').value;

  var form_data = {
    'product_idx' : product_idx,
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('product').'/reserve_cancel'?>",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        return;
      }

      if(result.code == '0'){
        alert(result.code_msg);
      } else {
        location.reload();
      }
    }
  });

}

// complete_confirm
function complete_confirm(){
  modal_close_slide('more');
  if (!confirm('<?=lang("lang_product_00230","거래완료로 상태를 변경 하시겠습니까?")?>')) {
    return;
  }

  var product_idx = document.querySelector('#product_idx').value;

  var form_data = {
    'product_idx' : $('#product_idx').val(),
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('product').'/product_state_mod_up_2'?>",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        return;
      }

      if(result.code == '0'){
        alert(result.code_msg);
      } else {
        alert(result.code_msg);
        location.href='/<?=$this->nationcode.'/'.mapping('product')?>/complete_reg?product_idx=<?=$result->product_idx?>';
      }
    }
  });

}

// 위시리스트 토글버튼
// function wish_btn(element){
// 	if($('.'+ element).hasClass("on")){
// 		$('.'+ element).removeClass("on");
// 	} else {
// 		$('.'+ element).addClass("on");
// 	}
// }


// 예약된 글 취소 알림 등록
function reserve_reg_in(){
  var product_idx = document.querySelector('#product_idx').value;
  var member_idx = document.querySelector('#member_idx').value;

  login_check(member_idx); // 로그인 체크
  member_info_check(); // 회원정보 체크

  var form_data = {
    'product_idx' : product_idx,
    'member_idx' : member_idx
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('product').'/reserve_reg_in'?>",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        modal_close('cancel_alarm');

        return;
      }

      if(result.code == '0'){
        alert(result.code_msg);
      } else {
        alert(result.code_msg);
      }
      modal_close('cancel_alarm');
    }
  });
}

// 상품 신고
function product_report(){
  var product_idx = document.querySelector('#product_idx').value;
  var member_idx = document.querySelector('#member_idx').value;
  var report_type = document.querySelector('#report_type').value;
  var report_contents = document.querySelector('#report_contents').value;

  login_check(member_idx); // 로그인 체크
  member_info_check(); // 회원정보 체크

  var form_data = {
    'product_idx' : product_idx,
    'member_idx' : member_idx,
    'report_type' : report_type,
    'report_contents' : report_contents
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('product').'/product_report'?>",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        return;
      }

      if(result.code == '0'){
        alert(result.code_msg);
      } else {
        alert(result.code_msg);
        modal_close('report');
        $(".report_li").css('display', 'none');
      }
    }
  });
}

// 회원 상태 체크
function member_state_check(menu){
  var product_idx = document.querySelector('#product_idx').value;
  var member_idx = document.querySelector('#member_idx').value;

  if(login_check(member_idx) == '1'){// 로그인 체크
    member_info_check(); // 회원정보 체크

    if(menu == 'report'){
      modal_open('report');
    }

  }
}


// 상품 삭제
function default_del(){

  if(!confirm('<?=lang("lang_product_00236","삭제 하시겠습니까?")?>')){
    return;
  }

  var product_idx = document.querySelector('#product_idx').value;

  var form_data = {
    'product_idx' : product_idx,
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('product').'/product_del'?>",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        return;
      }

      if(result.code == '0'){
        alert(result.code_msg);
      } else {
        if (document.referrer) {
          history.back();
        }else {
          location.href='/<?=$this->nationcode.'/'.mapping('main')?>';
        }
      }
    }
  });
}

// 무료 끌어올리기
function free_list_up(){
  var product_idx = document.querySelector('#product_idx').value;

  var form_data = {
    'product_idx' : product_idx,
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('product').'/free_list_up'?>",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        return;
      }

      if(result.code == '0'){
        alert(result.code_msg);
      } else {
        location.reload();
      }
    }
  });
}

// 포인트 끌어올리기
function list_up(){

  var text = "<?=lang("lang_product_00221","끌어올리기를 한 시점으로 등록시간을 변경하여 다른 게시물 보다 먼저 노출을 시킬 수 있습니다.\n끌어올리기를 하는 경우 1000 딜리 포인트가 필요합니다. 끌어올리기를 하시겠습니까?")?>"

  if(!confirm(text)){
    return;
  }

  var product_idx = document.querySelector('#product_idx').value;

  var form_data = {
    'product_idx' : product_idx,
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('product').'/list_up'?>",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        return;
      }

      if(result.code == '0'){
        alert(result.code_msg);
      } else {
        location.reload();
      }
    }
  });
}

</script>

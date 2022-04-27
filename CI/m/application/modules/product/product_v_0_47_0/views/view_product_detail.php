<header class="transparent">
  <img src="/images/head_btn_back_white.png" alt="back" class="head_btn_back_white" onclick="javascript:history.go(-1)">
  <img src="/images/head_btn_more_white.png" alt="more" class="head_btn_more_white" onclick="modal_open_slide('more')">
</header>
<div class="swiper-container product_visual">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <a href="javascript:void(0)" class="img_box"><img src="/p_images/s2.jpg"></a>
    </div>
    <div class="swiper-slide">
      <a href="javascript:void(0)" class="img_box"><img src="/p_images/s3.jpg"></a>
    </div>
    <div class="swiper-slide">
      <a href="javascript:void(0)" class="img_box"><img src="/p_images/s1.jpg"></a>
    </div>
  </div>
  <!-- Add Scrollbar -->
  <div class="swiper-scrollbar"></div>
</div>
<div class="product_detail_info_wrap">
  <table class="tbl_product_info">
    <colgroup>
      <col width="65px">
      <col width="*">
      <col width="40px">
    </colgroup>
    <tr>
      <th rowspan="4">
        <a href="/<?=mapping('profile')?>/profile_detail">
          <div class="img_box">
            <img src="/p_images/p1.png" alt="">
          </div>
        </a>
      </th>
    </tr>
      <td>
        <h6>무함마드 · 15.2km</h6>
      </td>
      <td rowspan="2" class="txt_center">
        <img src="/images/i_tree.png" alt="free" class="free">
        <h6>160</h6>
      </td>
    </tr>
    <tr>
      <td>
        <ul class="appr">
          <li>
            <img src="/images/i_manner1.png" alt="">33
          </li>
          <li>
            <img src="/images/i_manner2.png" alt="">3
          </li>
        </ul>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <p class="price">223 Bir Uttam Mir Shawkat Sarak,<br>Dhaka 1208 방글라데시</pl>
      </td>
    </tr>
  </table>
</div>
<div class="inner_wrap footer_margin">
  <hr class="mb20">
  <h4>입생로랑 2020 S/S 제품 입니다.</h4>
  <p class="product_category">여성잡화/지갑 · 끌어올리기 1일 전</p>
  <h4>
    <span class="fs_16">৳</span>40
    <ul class="product_detail_info_ul">
      <li>
        <img src="/images/i_eye.png" alt=""> 154
      </li>
      <li>
        <img src="/images/icons-comment.png" alt=""> 12
      </li>
      <li>
				<img src="/images/icons-heart.png" alt="">
				9
			</li>
    </ul>
  </h4>

  <ul class="tag_ul mt30">
    <li onclick="modal_open('keyword_result')">해시태그</li>
    <li>입생로랑</li>
  </ul>
  <p class="mt10 contents_txt">올해 초 샀던건데 남자친구가 하나 다른거 사줘서 팔게 되었습니다. 1~2번 착용했고 하자 전혀없는 새거라고 보시면 됩니다! 가격내고 해달라고 하시는 분들이 많으신데 최대한 내고해서 17만원에 팝니다! 정가는 30만원이 넘습니다.ㅜ 최대한 택배가아닌 직접 와주실수 있는 분이였으면 좋겠어요~</p>
</div>
<div class="btn_bottom_float">
  <!-- <span class="btn_float_left btn_deact">
    <a href="javascript:void(0)" onclick="wish_btn('like_2')" class="wish_btn like_2"></a>
  </span> -->
  <span class="btn_float_left btn_gray_line">
    <a href="javascript:void(0)" onclick="wish_btn('like_2')" class="wish_btn like_2"></a>
  </span>
  <!-- <span class="btn_float_right btn_point">
    <a href="javascript:void(0)">채팅 문의하기</a>
  </span> -->
  <span class="btn_float_right btn_point">
    <a href="javascript:void(0)" onclick="modal_open('cancel_alarm')">예약된 글입니다.</a>
  </span>
  <!-- <span class="btn_float_right btn_deactive">
    <a href="/<?=mapping('product')?>/complete_reg">거래 완료된 글입니다.</a>
  </span> -->
  <!-- <span class="btn_float_right btn_deactive">
    <a href="javascript:void(0)">거래중인 상품 입니다.</a>
  </span> -->
</div>

<div class="modal modal_cancel_alarm">
  <div class="md_inner" onclick="event.stopPropagation();">
    <h5>예약된 글</h5>
    <p class="md_txt">예약된 글에는 채팅으로 문의를 할 수 없습니다. 취소되면 알림으로 알려드릴까요?</p>
    <div class="btn_full_weight btn_point">
      <a href="">네</a>
    </div>
    <div class="mt15 btn_full_weight btn_gray">
      <a href="">아니요</a>
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
    <h2 class="mt16">#입생로랑</h2>
    <ul class="home_ul mb70">
			<li>
					<table class="tbl_4">
					<colgroup>
						<col width="125">
					</colgroup>
					<tr>
						<th rowspan="6">
							<a href="/<?=mapping('product')?>/product_detail">
								<div class="img_box thum">
									<img src="/p_images/s1.jpg" onerror="this.src='/images/default_img.png'">
								</div>
							</a>
						</th>
					</tr>
					<tr>
						<td>
							<a href="/<?=mapping('product')?>/product_detail">
								<div class="title">개봉전 샤넬지갑 팔아요. 정품 인증서 가지고 있습니다!</div>
							</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="/<?=mapping('product')?>/product_detail">
								<div class="place">236/C-237/A, Dhaka 1208 방글라데시</div>
							</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="/<?=mapping('product')?>/product_detail">
								<div class="s_info">1분 전 · 나와의 거리 15km</div>
							</a>
						</td>
					</tr>
					<tr>
						<td>
							<a href="/<?=mapping('product')?>/product_detail">
								<div class="price">
									<span class="state">예약중</span>
									৳60
								</div>
							</a>
						</td>
					</tr>
					<tr>
						<td style="vertical-align:bottom">
							<ul class="info_ul">
								<li>
									<img src="/images/icons-comment.png" alt="">
									51
								</li>
								<li onclick="wish_btn('like_1')">
									<span class="like like_1"></span>
									9
								</li>
								<li>
									<img src="/images/i_manner1.png" alt="">
									88
								</li>
								<li>
									<img src="/images/i_manner2.png" alt="">
									1
								</li>
							</ul>
						</td>
					</tr>
				</table>
				</a>
			</li>
    </ul>
  </div>
</div>

<div class="modal_more">
  <ul class="more_ul">
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more');">신고</a>
    </li>

    <li>
      <a href="<?=mapping('product')?>/product_mod">수정</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more');">삭제</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more');">무료 끌어올리기</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more');">포인트 끌어올리기</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="reserve_confirm();">예약하기</a>
    </li>

    <li>
      <a href="javascript:void(0)" onclick="complete_confirm();">완료하기</a>
    </li>

    <li class="close">
      <a href="javascript:void(0)" onclick="modal_close_slide('more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_overlay md_overlay_more" onclick="modal_close_slide('more');"></div>

<!-- modal : s -->
<div class="modal modal_report">
  <div class="" onclick="event.stopPropagation();">
    <div class="title">신고</div>
    <p class="txt">
      부적절한 내용인가요?<br>모두가 즐길 수 있는 컨텐츠를 만들기 위해<br>서는 신고가 필요합니다.
    </p>
    <select class="" name="">
      <option value="">선택</option>
    </select>
    <textarea class="mt4" placeholder="신고사유를 정확하게 입력해 주세요."></textarea>
    <div class="btn_md_wrap">
      <span class="btn_md_left btn_gray">
        <a href="javascript:void(0)" onclick="modal_close('report')">취소</a>
      </span>
      <span class="btn_md_right btn_sub_point">
        <a href="">신고</a>
      </span>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_report" onclick="javascript:modal_close('report')"></div>
<!-- modal : e -->


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
  if (!confirm("더이상 채팅 요청을 받으실 수 없습니다.\n진행 하시겠습니까?")) {
    return;
  } else {
    location.href='/<?=mapping('product')?>/reserve_reg';
  }
}
// complete_confirm
function complete_confirm(){
  modal_close_slide('more');
  if (!confirm("거래완료로 상태를 변경 하시겠습니까?")) {
    return;
  } else {
    location.href='/<?=mapping('product')?>/complete_reg';
  }
}

// 위시리스트 토글버튼
function wish_btn(element){
	if($('.'+ element).hasClass("on")){
		$('.'+ element).removeClass("on");
	} else {
		$('.'+ element).addClass("on");
	}
}

</script>

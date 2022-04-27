<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1>보유 배지</h1>
</header>
<!-- header : e -->

<div class="body row badge inner_wrap">
  <h4>나의 대표 배지</h4>
  <!-- <p class="sub_title">획득한 배지가 있는 경우<br>원하는 것을 나의 대표 배지로 설정할 수 있습니다.</p> -->
  <p class="sub_title">최초 중고거래 구매를 성공했어요.</p>
  <!-- <img src="/images/badge_off.png" onerror="this.src='/images/badge_off.png'" class="badge_img"> -->
  <img src="/images/badge_big_2.png"  onclick="modal_open_slide('badge_detail')"  onerror="this.src='/images/badge_off.png'" class="badge_img">
  <h5>거래하는 기쁨</h5>
  <hr class="mt20">
  <ul class="badge_ul">
    <li>
      <img src="/images/badge1_off.png" onclick="modal_open_slide('badge_detail')">
      <p>득템 성공</p>
    </li>
    <li>
      <img src="/images/badge2.png" onclick="modal_open_slide('badge_detail')">
      <p>거래하는 기쁨</p>
    </li>
    <li>
      <img src="/images/badge3.png" onclick="modal_open_slide('badge_detail')">
      <p>나눔의 시작</p>
    </li>
    <li>
      <img src="/images/badge4.png" onclick="modal_open_slide('badge_detail')">
      <p>소식통</p>
    </li>
    <li>
      <img src="/images/badge5.png" onclick="modal_open_slide('badge_detail')">
      <p>당신의 센스</p>
    </li>
    <li>
      <img src="/images/badge6.png" onclick="modal_open_slide('badge_detail')">
      <p>포인트 부자</p>
    </li>
    <li>
      <img src="/images/badge7.png" onclick="modal_open_slide('badge_detail')">
      <p>리뷰어</p>
    </li>
    <li>
      <img src="/images/badge8_off.png" onclick="modal_open_slide('badge_detail')">
      <p>친절한 판매자</p>
    </li>
    <li>
      <img src="/images/badge9.png" onclick="modal_open_slide('badge_detail')">
      <p>신뢰의 시작</p>
    </li>
    <li>
      <img src="/images/badge10.png" onclick="modal_open_slide('badge_detail')">
      <p>알려주는 구매자</p>
    </li>
  </ul>
</div>

<div class="modal_badge_detail">
  <img src="/images/badge9.png" onclick="modal_open_slide('badge_detail')">
  <h4>신뢰의 시작</h4>
  <p class="txt">좋음 평가를 10회 받으면 획득할 수 있어요.</p>
  <div class="btn_full_thin btn_point_line mt20">
    <a href="">나의 대표 배지로 사용</a>
  </div>
  <!-- <div class="btn_full_thin btn_deactive mt20">
    <a href="">나의 대표 배지로 사용</a>
  </div> -->
</div>
<div class="md_overlay md_overlay_badge_detail" onclick="modal_close_slide('badge_detail');"></div>

<script type="text/javascript">
let badge_detail_view_height;
window.onload = function(){
	badge_detail_view_height = $('.modal_badge_detail').outerHeight();
  $('.modal_badge_detail').css('bottom',-badge_detail_view_height);
};
function modal_open_slide(e){
  $(".md_overlay_" + 'badge_detail').css("visibility", "visible").animate({opacity: 1}, 100);
  $(".modal_" + 'badge_detail').css({bottom: "0",transition:'0.4s'});
  $.lockBody();
}

function modal_close_slide(e){
  $(".md_overlay_" + 'badge_detail').css("visibility", "hidden").animate({opacity: 0}, 100);
  $(".modal_" + 'badge_detail').css({bottom: -badge_detail_view_height});
  $.unlockBody();
}
</script>

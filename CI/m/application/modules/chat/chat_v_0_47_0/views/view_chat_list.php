<header>
	<h1 class="left">채팅</h1>
</header>
<div class="body inner_wrap footer_margin">
	<ul class="chat_ul mt30">
		<li>
			<table class="table_chat_list">
				<colgroup>
					<col width="65">
					<col width="*">
				</colgroup>
				<tr>
					<th colspan="2">
						<span class="title">입생로랑 2020 S/S 제품 입니다.</span>
						<img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')">
					</th>
				</tr>
				<tr>
					<td rowspan="2">
						<div class="img_box profile">
							<img src="/p_images/p11.png" onerror="this.src='/images/default_user.png'">
							<span class="new"></span>
						</div>
					</td>
					<td>
						술라이만
						<span class="date">2020.01.01. 00:00</span>
					</td>
				</tr>
				<tr>
					<td>
						<p class="fs_12 font_gray_9">거래 하고 싶습니다~ 내고 가능한가요?</p>
					</td>
				</tr>
			</table>
		</li>
		<li>
			<table class="table_chat_list">
				<colgroup>
					<col width="65">
					<col width="*">
				</colgroup>
				<tr>
					<th colspan="2">
						<span class="title">입생로랑 2020 S/S 제품 입니다.</span>
						<img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')">
					</th>
				</tr>
				<tr>
					<td rowspan="2">
						<div class="img_box profile">
							<img src="/p_images/p1.png" onerror="this.src='/images/default_user.png'">
						</div>
					</td>
					<td>
						술라이만
						<span class="date">2020.01.01. 00:00</span>
					</td>
				</tr>
				<tr>
					<td>
						<p class="fs_12 font_gray_9">거래 하고 싶습니다~ 내고 가능한가요?</p>
					</td>
				</tr>
			</table>
		</li>
	</ul>
</div>

<div class="modal_more">
  <ul class="more_ul">
    <li>
      <a href="javascript:void(0)" onclick="alert('삭제하시겠습니까?');modal_close_slide('more');">삭제</a>
    </li>
    <li class="close">
      <a href="javascript:void(0)" onclick="modal_close_slide('more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_overlay md_overlay_more" onclick="modal_close_slide('more');"></div>

<script>
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
</script>

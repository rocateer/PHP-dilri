<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1>댓글 200</h1>
</header>
<!-- header : e -->
<div class="body inner_wrap mb60">

	<div class="no_datas mb30">
		<img src="/images/icon-black-chat_c.png" alt="">
		<p>작성된 댓글이 없습니다.<br>댓글을 작성해 주세요.</p>
	</div>

	<ul class="comment_ul">
		<li>
			<table class="tbl_3">
				<colgroup>
					<col width="48px">
					<col width="*">
					<col width="25px">
				</colgroup>
				<tr>
					<td>
						<div class="img_box profile">
							<img src="/p_images/p1.png" alt="">
						</div>
					</td>
					<td class="normal_bold">
						মুছে ফেলুন <span class="writer">글쓴이</span>
					</td>
					<th>
						<img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')">
					</th>
				</tr>
			</table>
			<p class="cmt">이사 온 지 얼마 안 됐는데 담비한테 친구들이 생겨서 다행이에요 매주 모이면 좋겠어요!</p>
			<span class="date">2020.01.01. 00:00</span>
			<span class="btn_reply" onclick="btn_reply()">답글 달기</span>
		</li>
		<li>
			<div class="del_cmt">삭제된 글입니다.</div>
		</li>
		<li class="ml30">
			<table class="tbl_3">
				<colgroup>
					<col width="48px">
					<col width="*">
					<col width="25px">
				</colgroup>
				<tr>
					<td>
						<div class="img_box profile">
							<img src="/p_images/p1.png" alt="">
						</div>
					</td>
					<td class="normal_bold">
						মুছে ফেলুন
					</td>
					<th>
						<img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')">
					</th>
				</tr>
			</table>
			<p class="cmt">이사 온 지 얼마 안 됐는데 담비한테 친구들이 생겨서 다행이에요 매주 모이면 좋겠어요!</p>
			<span class="date">2020.01.01. 00:00</span>
			<span class="btn_reply" onclick="btn_reply()">답글 달기</span>
		</li>
		<li class="ml30">
			<table class="tbl_3">
				<colgroup>
					<col width="48px">
					<col width="*">
					<col width="25px">
				</colgroup>
				<tr>
					<td>
						<div class="img_box profile">
							<img src="/p_images/p1.png" alt="">
						</div>
					</td>
					<td class="normal_bold">
						মুছে ফেলুন
					</td>
					<th>
						<img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')">
					</th>
				</tr>
			</table>
			<p class="cmt">이사 온 지 얼마 안 됐는데 담비한테 친구들이 생겨서 다행이에요 매주 모이면 좋겠어요!</p>
			<span class="date">2020.01.01. 00:00</span>
			<span class="btn_reply" onclick="btn_reply()">답글 달기</span>
		</li>
		<li class="ml30">
			<span class="reply_view">답글 보기</span>
		</li>
		<li>
			<table class="tbl_3">
				<colgroup>
					<col width="48px">
					<col width="*">
					<col width="25px">
				</colgroup>
				<tr>
					<td>
						<div class="img_box profile">
							<img src="/p_images/p1.png" alt="">
						</div>
					</td>
					<td class="normal_bold">
						মুছে ফেলুন
					</td>
					<th>
						<img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')">
					</th>
				</tr>
			</table>
			<p class="cmt">이사 온 지 얼마 안 됐는데 담비한테 친구들이 생겨서 다행이에요 매주 모이면 좋겠어요!</p>
			<span class="date">2020.01.01. 00:00</span>
			<span class="btn_reply" onclick="btn_reply()">답글 달기</span>
		</li>
		<li>
			<div class="del_cmt">탈퇴한 회원의 글입니다.</div>
		</li>
		<li>
			<div class="del_cmt">관리자에 의해 블라인드 된 글입니다.</div>
		</li>
	</ul>
</div>
<div class="cmt_input_wrap">
	<div class="replying">@단호박님에게 답글을 남기는 중</div>
	<input type="text" placeholder="매너있는 댓글을 입력해 주세요." id="cmt_input">
	<img src="/images/btn_send.png" alt="전송" class="btn_send">
</div>
<div class="modal_more">
  <ul class="more_ul">
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more');">신고</a>
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
<div id="reply_back" onclick="reply_back_close()"></div>
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


// 답글 닫기
function reply_back_close(){
  $('#input').blur();
  $('#input').val('');
  $('#reply_tag').css('display','none');
  $('#reply_back').css('display','none');
}

//댓글입력 포커스
$(function(){
	$('.btn_send').css('display','none');
	$('.replying').css('display','none');
	if($('#cmt_input').focus()){
	  $('#reply_tag').css('display','block');
	  $('#reply_back').css('display','block');
	};
	// 모든 텍스트의 변경에 반응합니다.
	$("#cmt_input").on("propertychange change keyup paste input", function() {
		// 현재 변경된 데이터 셋팅
    var newValue = $(this).val().length;
    if(newValue > 0){
      $('.btn_send').css('display','block')
    }else{
      $('.btn_send').css('display','none')
    }
	});
});
// 답글달기
function btn_reply(){
	$('#cmt_input').focus();
	$('.replying').css('display','block');
  $('#reply_tag').css('display','block');
  $('#reply_back').css('display','block');
}
</script>

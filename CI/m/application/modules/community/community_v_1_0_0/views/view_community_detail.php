<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1 id="reply_cnt_h1"><?=lang("lang_community_00459","댓글")?> <?=$result->reply_cnt?></h1>
</header>
<!-- header : e -->
<div class="body inner_wrap mb60">

	<div class="no_datas mb30" id="no_data">
		<img src="/images/icon-black-chat_c.png" alt="">
		<p><?=lang("lang_community_00787","작성된 댓글이 없습니다.<br>댓글을 작성해 주세요.")?></p>
	</div>

	<ul class="comment_ul" id="list_ajax"></ul>
</div>
<div class="cmt_input_wrap">
	<div class="replying"  id="reply_tag" style="display:none"></div>
	<!-- <div class="replying"  id="reply_tag" style="display:none">@단호박님에게 답글을 남기는 중</div> -->
	<input type="text" placeholder="<?=lang("lang_community_00468","매너있는 댓글을 입력해 주세요.")?>" id="cmt_input">
	<? if($this->input->cookie('current_nation')=='kr'){ ?>
		<img src="/images/btn_send.png" onclick="board_comment_reg_in()" alt="<?=lang("lang_add_plus_00006","전송")?>" class="btn_send">
	<? } else if($this->input->cookie('current_nation')=='us') {?>
		<img src="/images/btn_send_us.png" onclick="board_comment_reg_in()" alt="<?=lang("lang_add_plus_00006","전송")?>" class="btn_send">
	<? } else {?>
		<img src="/images/btn_send_bd.png" onclick="board_comment_reg_in()" alt="<?=lang("lang_add_plus_00006","전송")?>" class="btn_send">
	<? } ?></div>
<div class="modal_more">
  <ul class="more_ul">
		<li id="del_btn_li">
      <a href="javascript:void(0)" onclick="board_reply_del('0')" id="del_btn"><?=lang("lang_community_00462","삭제")?></a>
    </li>
    <li id="report_btn_li">
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more');"><?=lang("lang_community_00461","신고")?></a>
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
    <div class="title"><?=lang("lang_community_00461","신고")?></div>
    <p class="txt">
      <?=lang("lang_community_00474","부적절한 내용인가요?<br>모두가 즐길 수 있는 컨텐츠를 만들기 위해<br>서는 신고가 필요합니다.")?>
    </p>
		<select name="report_type" id="report_type">
			<option value=""><?=lang("lang_community_00475","선택")?></option>
      <option value="0"><?=lang("lang_community_00476","욕설, 비방글")?></option>
      <option value="1"><?=lang("lang_community_00477","음란성 글")?></option>
      <option value="2"><?=lang("lang_community_00478","기타 비매너")?></option>
    </select>
    <textarea class="mt4"  name="report_contents" id="report_contents" placeholder="<?=lang("lang_community_00479","신고사유를 정확하게 입력해 주세요.")?>"></textarea>
    <div class="btn_md_wrap">
      <span class="btn_md_left btn_gray">
        <a href="javascript:void(0)" onclick="modal_close('report')"><?=lang("lang_community_00480","취소")?></a>
      </span>
      <span class="btn_md_right btn_sub_point">
        <a href="javascript:void(0)" onclick="board_reply_report_reg_in()" id="report_reg_btn"><?=lang("lang_community_00461","신고")?></a>
      </span>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_report" onclick="javascript:modal_close('report')"></div>
<!-- modal : e -->


<input type="text" name="board_idx" id="board_idx" value="<?=$result->board_idx ?>"  style="display:none">
<input type="hidden" name="depth" id="depth" value="0" >
<input type="hidden" name="board_reply_idx" id="board_reply_idx" value="0" >
<input type="hidden" name="relpy_member_idx" id="relpy_member_idx" value="0" >
<input type="hidden" name="total_block" id="total_block" value="1" >

<input type="hidden" name="report_position" id="report_position" value="0" >
<input type="hidden" name="reported_board_reply_idx" id="reported_board_reply_idx" value="0" >


<script type="text/javascript">

$(document).ready(function(){
  setTimeout("default_list_get('1')", 10);
});

var page_num=1;

// $(window).scroll(function(){
$("#list_ajax").scroll(function(){
	// var scrollHeight = $(document).height();
	// var scrollPosition = $(window).height() + $(window).scrollTop();

	// if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
	// 	page_num++;
	// 	default_list_get(page_num);
	// }

  var scrollTop = $(this).scrollTop();
  var innerHeight = $(this).innerHeight();
  var scrollHeight = $(this).prop('scrollHeight');
  // console.log(`scrollTop + innerHeight : ${scrollTop + innerHeight} / scrollHeight : ${scrollHeight}`);

  if(scrollTop + innerHeight +2 >= scrollHeight){
    page_num++;
    default_list_get(page_num);
  }

});

// 목록
function default_list_get(page_num){
  // console.log("paging");
  var total_block = parseInt($("#total_block").val());

  var formData = {
    'board_idx' :  $('#board_idx').val(),
    'page_num' : page_num
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_comment_list",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : formData,
    success: function(result) {

      if(page_num == 1){
				 $("#list_ajax").append(result);

			}else{
				if(total_block < page_num){
				 page_num = 1;

				}else{
				 $("#list_ajax").append(result);
				}

			}

      // $('#list_ajax').append(result);
      // $('#page_num').val(parseInt(page)+1);
    }
  });
}

// 댓글 더보기
function board_comment_reply_list_more(board_reply_idx){

  if ($("#more_list_text_"+board_reply_idx).hasClass("on")) {
    $("#more_list_"+board_reply_idx).css("display", "none");
    $("#more_list_text_"+board_reply_idx).html("<?=lang("lang_community_00784","답글 더보기")?>");
    $("#more_list_text_"+board_reply_idx).removeClass("on");

  }else {
    var formData = {
      'board_reply_idx' : board_reply_idx
    };

    $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_comment_reply_list_more",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $("#more_list_"+board_reply_idx).css("display", "block");
        $("#more_list_"+board_reply_idx).html(result);
        $("#more_list_text_"+board_reply_idx).html("<?=lang("lang_community_00785","답글 접기")?>");
        $("#more_list_text_"+board_reply_idx).addClass("on");
      }
    });
  }


}

// 댓글 더보기 토글
function reply_toggle_btn(board_reply_idx){

  $(".reply_"+board_reply_idx).toggleClass("hide_reply");
  if ($("#reply_toggle_btn_"+board_reply_idx).hasClass('on')) {
    $("#reply_toggle_btn_"+board_reply_idx).html("<?=lang("lang_community_00784","답글 더보기")?>");
  }else {
    $("#reply_toggle_btn_"+board_reply_idx).html("<?=lang("lang_community_00785","답글 접기")?>");
  }
  $("#reply_toggle_btn_"+board_reply_idx).toggleClass("on");

}


// 댓글작성란 포커스 아웃 시 댓글 데이터 세팅
// document.querySelector('#input').addEventListener('focusout', (event) => {
//   set_relpy_data('0', '0', '0', '');
// });

// 댓글 답글 데이터 세팅
function set_relpy_data(depth, board_reply_idx, relpy_member_idx, relpy_member_name){
  if (depth=='0') {
    $('#reply_tag').css('display','none');
    $('#depth').val('0');
    $('#board_reply_idx').val('0');
    $('#relpy_member_idx').val('0');
    $('#cmt_input').val('');
  }else {
    $('#reply_tag').css('display','block');
    $('#reply_tag').html("@"+relpy_member_name);
    $('#depth').val('1');
    $('#board_reply_idx').val(board_reply_idx);
    $('#relpy_member_idx').val(relpy_member_idx);
    $('#cmt_input').val('');
    $('#cmt_input').focus();
  }
}

// 댓글/답글 달기
function board_comment_reg_in(){

  var reply_comment = $('#cmt_input').val();
  var board_idx = $('#board_idx').val();
  var board_reply_idx = $('#board_reply_idx').val();
  var relpy_member_idx = $('#relpy_member_idx').val();
  var depth = $('#depth').val();

  // $("#reply_reg_btn").attr("onclick", "");

  var formData = {
    "reply_comment" : reply_comment,
    "board_idx" : board_idx,
    "board_reply_idx" : board_reply_idx,
    "relpy_member_idx" : relpy_member_idx,
    "depth" : depth
  };


  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_comment_reg_in",
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
        board_reply_detail(result.board_reply_idx,board_reply_idx, depth);
        $('#cmt_input').val("");
        $('#reply_cnt_h1').html("<?=lang("lang_community_00459","댓글")?> "+result.reply_cnt);



      }
    }
  });
}


// 댓글 상세
function board_reply_detail(board_reply_idx,parent_board_reply_idx, depth){

  var formData = {
    'board_reply_idx' : board_reply_idx
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_reply_detail",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : formData,
    success: function(result) {

      if (depth=='0') {
        $("#list_ajax").append(result);
        if ($('.reply_li').length!=0) {
          $("#no_data").css('display','none');
        }
      }else {
        $("#more_list_"+parent_board_reply_idx).append(result);
        $("#more_list_"+parent_board_reply_idx).css('display','block');
      }
      set_relpy_data('0','0','0','');
    }
  });
}

// 더보기 메뉴 세팅
function set_report(my_board_yn, report_yn, reported_board_reply_idx, report_position){

  // 삭제버튼 노출여부 확인
  if (my_board_yn=='Y') {
    $("#report_btn_li").css('display','none');
    $("#del_btn_li").css('display','block');
    $("#del_btn").attr("onclick", "board_reply_del('"+reported_board_reply_idx+"', '"+report_position+"')");
  }else {
    if (report_yn=='Y') {
      $("#report_btn_li").css('display','none');
    }else {
      $("#report_btn_li").css('display','block');
      $("#report_reg_btn").attr("onclick","board_reply_report_reg_in('"+reported_board_reply_idx+"', '"+report_position+"')");
    }
    $("#del_btn_li").css('display','none');
  }

}


// 사용자 차단
function member_block_reg_in(partner_member_idx){

  if (!confirm("<?=lang("lang_add_00823","차단 하시겠습니까? 차단한 사용자의 게시글은 더이상 회원님에게 노출되지 않습니다.")?>")) {
    return;
  }

  var formData = {
    "partner_member_idx" : partner_member_idx
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/member_block_reg_in",
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
        location.href="/<?=$this->nationcode.'/'.mapping('community')?>";
        // alert(result.code_msg);
        // default_list_get($('#page_num').val());
        // $('#board_table_'+board_idx).remove();
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
        location.href="/<?=$this->nationcode.'/'.mapping('community')?>";
        // alert(result.code_msg);
        // default_list_get($('#page_num').val());
        // $('#board_table_'+board_idx).remove();
      }
    }
  });
}

// 댓글 답글 삭제
function board_reply_del(board_reply_idx, report_position){

  if (!confirm("<?=lang("lang_community_00449","삭제 하시겠습니까?")?>")) {
    return;
  }

  var formData = {
    "board_reply_idx" : board_reply_idx,
    "board_idx" : $("#board_idx").val()
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_reply_del",
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

        var str = "";
        if (report_position=='0') {
          str += "<li><div class='del_cmt'><?=lang("lang_community_00463","삭제된 글입니다.")?></div></li>";
        }else {
          str += "<li class='ml30'><div class='del_cmt'><?=lang("lang_community_00463","삭제된 글입니다.")?></div></li>";
        }

        $('#tbl_reply_'+board_reply_idx).replaceWith(str);
        modal_close_slide('more');

				if ($(".board_reply_li").length==0) {
					$("#no_data").css("display","block");
				}else {
					$("#no_data").css("display","none");
				}

      }
    }
  });
}

// 게시글 신고
function board_report_reg_in(){

  var formData = {
    "board_idx" : $("#board_idx").val(),
    "board_type" : $("#board_type").val(),
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
        modal_close('more');
      }
    }
  });
}

//댓글 답글 신고
function board_reply_report_reg_in(reported_board_reply_idx, report_position){

  var formData = {
    "board_reply_idx" : reported_board_reply_idx,
    "report_position" : report_position,
    "report_contents" : $("#report_contents").val(),
    "report_type" : $("#report_type").val()
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_reply_report_reg_in",
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
        $("#btn_more_"+reported_board_reply_idx).attr("onclick","set_report('N', 'Y', '"+reported_board_reply_idx+"', '"+report_position+"');modal_open_slide('more')");
      }
    }
  });
}


</script>


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

//댓글입력 포커스
$(function(){
	$('.btn_send').css('display','none');
	$('.replying').css('display','none');

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
}
</script>

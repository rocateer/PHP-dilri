<header>
	<h1 class="left"><?=lang("lang_menu_00034","채팅")?></h1>
</header>
<div class="body inner_wrap footer_margin">
<div class="no_datas mb30" id="no_data" style="display:none">
		<img src="/images/icon-black-chat_c.png" alt="">
		<p><?=lang("lang_dev_00000","진행중인 거래가 없습니다.")?></p>
	</div>
	<ul class="chat_ul mt30" id="list_ajax"></ul>
</div>

<div class="modal_more">
  <ul class="more_ul">
    <li>
      <a href="javascript:void(0)" onclick="chatting_del();"><?=lang("lang_product_00213","삭제")?></a>
    </li>
    <li class="close">
      <a href="javascript:void(0)" onclick="modal_close_slide('more')"><?=lang("lang_product_00224","취소")?></a>
    </li>
  </ul>
</div>
<div class="md_overlay md_overlay_more" onclick="modal_close_slide('more');"></div>



<input type="hidden" name="total_block" id="total_block" value="1">
<input type="hidden" name="chatting_room_idx" id="chatting_room_idx" value="0">

<script type="text/javascript">
$(function(){
	setTimeout("default_list_get('1')", 10);
  // setTimeout("new_chatting_room_list()", 100);
	if (parseInt('<?=$chatting_room_idx?>')>0) {
		api_native_window_open('<?=$chatting_room_idx?>', '<?=$this->member_idx?>');
	}

});

var page_num=1;

$(window).scroll(function(){
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();

	if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
		page_num++;
		default_list_get(page_num);
	}
});

function default_list_get(page_num){
	var total_block = parseInt($("#total_block").val());

	var formData = {
		'page_num' : page_num
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('chatting')?>/chatting_room_list_get",
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
      // update_chatting();
		}
	});
}

// 새로운 대화가 있을 때
function update_chatting(){
  if ('<?=$this->uri->segment(2)?>'=='<?=mapping('chatting')?>') {
		default_list_get('1');
		// new_chatting_room_list();
	}
}


// 새 채팅 목록 업데이트
function new_chatting_room_list(){

	$(".chatting_new").remove();

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('chatting')?>/new_chatting_room_list",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : 1,
		success: function(result) {

			$("#list_ajax").prepend(result);
			for (var i = 0; i < arr.length; i++) {
				$('.chatting_room_'+arr[i]+'.old ').remove();
			}
		}
	});
}


function chatting_del(){

	if (!confirm("<?=lang("lang_product_00217","삭제 하시겠습니까?")?>")) {
		return;
	}

	var chatting_room_idx = $("#chatting_room_idx").val();

	var form_data = {
			'chatting_room_idx' : chatting_room_idx,
			'user_idx' : '<?=$this->member_idx?>'
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('chatting')?>/chatting_del",
		type     : 'POST',
		dataType : 'json',
		async    : true,
		data     : form_data,
		success : function(result){
			if(result.code == '-1'){
				alert(result.code_msg);
				$("#"+result.focus_id).focus();
				return;
			}
			// 0:실패 1:성공
			if(result.code == 0) {
				alert(result.code_msg);
			} else {
				alert(result.code_msg);
				$('#chatting_room_'+chatting_room_idx).remove();
			}
			modal_close_slide('more');
		}
	});
}


var agent ="<?=$agent?>";
function api_native_window_open(chatting_room_idx, user_idx){

	$('#chatting_room_'+chatting_room_idx).removeClass('chatting_new');
	$('#chatting_room_'+chatting_room_idx).addClass('old');
	$('#new_img_'+chatting_room_idx).removeClass('new');

	console.log("채팅 호출");
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
</script>

<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
    <?=lang("lang_mypage_00649","알림")?>
  </h1>
  <a href="javascript:void(0)" onclick="all_alarm_del()" class="btn_alarm" style="width: 100px;padding:13px;position: absolute; left: calc(100% - 80px);top: 50%;transform: translateY(-50%);color:#bbb">
    <?=lang("lang_community_00789","전체삭제")?>
  </a>
</header>
<!-- header : e -->
<!-- body : s -->
<div class="body row">
  <div class="inner_wrap">
    <div class="no_data" id="no_data">
      <p><?=lang("lang_mypage_00647","새로운 알림이 없습니다")?></p>
    </div>
    <ul class="ul_alarm" id="list_ajax">

    </ul>
  </div>
</div>
<!-- body : e -->

<input type="hidden" name="total_block" id="total_block" value="1">

<script type="text/javascript">


//페이지바로가기
function go_url(alarm_data){

  var go_url ="";

  switch (alarm_data.index) {
    case "101": go_url="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx="+alarm_data.product_idx; break;
    case "102": go_url="/<?=$this->nationcode.'/'.mapping('chatting')?>??chatting_open_yn=Y&chatting_room_idx="+alarm_data.chatting_room_idx;break;
    case "103": go_url="/<?=$this->nationcode.'/'.mapping('chatting')?>??chatting_open_yn=Y&chatting_room_idx="+alarm_data.chatting_room_idx;break;
    case "104": go_url="/<?=$this->nationcode.'/'.mapping('mypage')?>/mypage_list?tab_type="+alarm_data.tab_type; break;
    case "105": go_url="/<?=$this->nationcode.'/'.mapping('mypage')?>/mypage_list?tab_type="+alarm_data.tab_type; break;
    case "106": go_url="/<?=$this->nationcode.'/'.mapping('qa')?>/qa_detail?qa_idx="+alarm_data.qa_idx; break;
    case "107": go_url="/<?=$this->nationcode.'/'.mapping('mypage')?>/mypage_list?tab_type="+alarm_data.tab_type; break;
    case "108": go_url="/<?=$this->nationcode.'/'.mapping('mypage')?>/mypage_list?tab_type="+alarm_data.tab_type; break;
    case "109": go_url="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx="+alarm_data.product_idx; break;
    case "109": go_url="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx="+alarm_data.product_idx; break;
    case "109": go_url="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx="+alarm_data.product_idx; break;
    case "110": go_url="/<?=$this->nationcode.'/'.mapping('badge')?>/?access_type=0"; break;
    case "111": go_url="/<?=$this->nationcode.'/'.mapping('mypage')?>/point_list"; break;
    case "112": go_url="/<?=$this->nationcode.'/'.mapping('community')?>/community_detail?board_idx="+alarm_data.board_idx; break;
    case "113": go_url="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx="+alarm_data.product_idx; break;
    case "114": go_url="/<?=$this->nationcode.'/'.mapping('community')?>/community_detail?board_idx="+alarm_data.board_idx; break;
  }

  if(go_url !=""){
    location.href=go_url;
  }

}



$(function(){
	setTimeout("default_list_get('1')", 10);
});

var page_num=1;

// $(window).scroll(function(){
// 	var scrollHeight = $(document).height();
// 	var scrollPosition = $(window).height() + $(window).scrollTop();

// 	if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
// 		page_num++;
// 		default_list_get(page_num);
// 	}
// });

function default_list_get(page_num){

	var total_block = parseInt($("#total_block").val());

  var form_data = {
		'page_num' : page_num
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('alarm')?>/alarm_list_get",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : form_data,
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

//알림읽음
function alarm_read_mod_up(alarm_idx){

  var form_data = {
      'alarm_idx' : alarm_idx,
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('alarm')?>/alarm_read_mod_up",
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

    	}
		}
  });
}

function alarm_del(alarm_idx){

	var form_data = {
      'alarm_idx' : alarm_idx,
  };

	$.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('alarm')?>/alarm_del",
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
        $('#alarm_idx_'+alarm_idx).remove();
				if ($('.alarm_li').length==0) {
          default_list_get('1');
					// $("#no_data").css("display","block");
				}
				// new_alarm_count();
      }
    }
  });
}

function all_alarm_del(){

	$.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('alarm')?>/all_alarm_del",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : 1,
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
        location.reload();
      }
    }
  });
}


</script>

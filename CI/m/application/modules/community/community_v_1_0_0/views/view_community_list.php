<!-- header : s -->
<header>
  <h1 class="left"><?=lang("lang_community_00429","커뮤니티")?></h1>
</header>
<!-- header : e -->
<div class="body row footer_margin">
  <? if(!empty($recent_notice_detail->title)){ ?>
		<div class="notice_line">
			<a href="/<?=$this->nationcode.'/'.mapping('notice')?>/notice_detail?notice_idx=<?=$recent_notice_detail->notice_idx?>"><span>[<?=lang("lang_main_00122","플랫폼 공지사항")?>]</span> <?=$recent_notice_detail->title?></a>
		</div>
	<? } ?>

  <? if(!empty($rand_banner->img_path)){ ?>
      <? if($agent=="pc"){ ?>
        <a href="<?=$rand_banner->link_url ?>" target="_blank" class="bn_full img_box" ><img src="<?=$rand_banner->img_path?>" ></a>
      <? } else {?>
        <a href="javascript:void(0)"  onclick="api_request_external_link('<?=$rand_banner->link_url ?>')" class="bn_full img_box"><img src="<?=$rand_banner->img_path?>" ></a>
      <? } ?>
      <!-- <img src="/p_images/p2.png" alt=""> -->
  <? } ?>

  <div class="no_datas mb30" id="no_data" style="display:none">
		<img src="/images/Icons-search-gray_b.png" alt="">
		<p><?=lang("lang_community_00433","커뮤니티에 등록된 글이 없습니다.")?></p>
	</div>

	<ul class="community_ul mb70" id="list_ajax"></ul>
</div>
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

<input type="text" name="total_block" id="total_block" value="1" style="display:none">


<script type="text/javascript">

// 외부링크 이동 :: 사업자 정보 확인 및 배너 링크 이동
function api_request_external_link(url){
 if(agent == 'android') {
   window.rocateer.request_external_link(url);
 } else if (agent == 'ios') {
   var message = {
                  "request_type" : "request_external_link",
                  "url" : url,
                 };
   window.webkit.messageHandlers.native.postMessage(message);
 }
}


$(function(){
	setTimeout("default_list_get('1')", 10);
});

var page_num=1;
var append_close_yn = 'Y';

$(window).scroll(function(){
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();

	if((scrollHeight - scrollPosition) / scrollHeight <=0.018 && append_close_yn=='Y'){
		page_num++;
		default_list_get(page_num);
	}
});

function default_list_get(page_num){

  append_close_yn = 'N';

	var total_block = parseInt($("#total_block").val());

	var formData = {
		'board_type' : $("#board_type").val(),
		'search_text' : $("#search_text").val(),
		'order_by' : $("#order_by").val(),
		'current_lat' : $("#current_lat").val(),
		'current_lng' : $("#current_lng").val(),
		'page_num' : page_num
	};

  if (total_block < page_num) {
    return;
  }

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_list_get",
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
      append_close_yn='Y';

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

        // alert(result.code_msg);
        // default_list_get($('#page_num').val());
        // $('#board_table_'+board_idx).remove();
        // location.reload();
      }
    }
  });
}

// 추천
function board_recommend_reg_in(board_idx, element){

  var formData = {
    "board_idx" : board_idx
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_recommend_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        // wish_btn(element);
        wish_btn($('#recommend_span_'+board_idx));
        $('#recommend_cnt_'+board_idx).html(result.recommend_cnt);

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
        $('#board_li_'+board_idx).remove();
        if ($(".board_li").length==0) {
          $("#no_data").css("display","block");
        }
        modal_close_slide();
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
        modal_open_slide();
        
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

// 게시글 삭제 체크
function board_del_check(board_idx){

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
        // alert(result.code_msg);
        
      }
    }
  });
}

</script>

<?
$return_url_str = "/".$this->nationcode.'/'.mapping('community')."/community_reg";
$fnc_str = "location.href=\'".$return_url_str."\'";
?>
<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')"><img src="/images/floating_btn.png" alt="reg" class="btn_float"></a>
<script type="text/javascript">

// main_visual
// var main_visual = new Swiper('.main_visual', {
// 	slidesPerView: 1,
// 	slidesPerGroup:1,
// 	touchReleaseOnEdges:true,
//   pagination: {
//     el: ".main_visual .swiper-pagination",
//     dynamicBullets: true,
//   },
//   observer: true, 
// 	observeParents: true
// });
// 위시리스트 토글버튼
function wish_btn(element){
  if($(element).hasClass("on")){
    $(element).removeClass("on");
  } else {
    $(element).addClass("on");
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

$(function(){
  // 전체보기
  $('.more_view').click(function(){
    $(this).siblings('.txt').css('-webkit-line-clamp','initial');
    $(this).css('display','none');
  })

})

</script>

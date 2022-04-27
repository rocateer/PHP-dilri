
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>
		<li class="board_li_<?=$row->board_idx?>">
			<?
			$return_url_str = "/".$this->nationcode."/".mapping('community')."/community_detail?board_idx=".$row->board_idx;
			$fnc_str = "location.href=\'".$return_url_str."\'";
			?>
			<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')">
			<!-- <a href="/<?=$this->nationcode.'/'.mapping('community')?>/community_detail?board_idx=<?=$row->board_idx?>"> -->
				<span class="img_box">
					<img src="<?=explode(',',$row->img_path)[0]?>" onerror="this.src='/images/default_img.png'" alt="">
				</span>
				<div class="txt">
					<? if(!empty($row->reply_member_name)){ ?>
						<span class="nickname">@<?=$row->reply_member_name?></span>
					<? } ?>
					<?=$row->reply_comment?></div>
				<div class="date"><?=$row->ins_date?></div>
			</a>
		</li>

<?php
		}
	}
?>


<script type="text/javascript">
$(document).ready(function(){
	$("#total_block_<?=$tab_type?>").val('<?=$total_block ?>');
});

$("#no_data_<?=$tab_type?>").css("display","<?=$display?>");
// <? if($tab_type=='3'){ ?>
// 	$("#tab_cnt_<?=$tab_type?>").html("<?=lang("lang_mypage_00538","내 게시글")?>(<?=$result_list_count>=1000?round($result_list_count/1000,1)."K":$result_list_count ?>)");
// <? } elseif($tab_type=='4') {?>
// 	$("#tab_cnt_<?=$tab_type?>").html("<?=lang("lang_mypage_00539","내 댓글")?>(<?=$result_list_count>=1000?round($result_list_count/1000,1)."K":$result_list_count?>)");
// <? } elseif($tab_type=='5') {?>
// 	$("#tab_cnt_<?=$tab_type?>").html("<?=lang("lang_mypage_00540","스크랩")?>(<?=$result_list_count>=1000?round($result_list_count/1000,1)."K":$result_list_count?>)");
// <? } ?>
	// main_visual
	// var main_visual = new Swiper('.main_visual', {
	// 	slidesPerView: 1,
	// 	slidesPerGroup:1,
	// 	touchReleaseOnEdges:true,
	// 	pagination: {
	// 		el: ".main_visual .swiper-pagination",
	// 		dynamicBullets: true,
	// 	},
	// });

	$(function(){
	  // 전체보기
	  $('.more_view').click(function(){
	    $(this).siblings('.txt').css('-webkit-line-clamp','initial');
	    $(this).css('display','none');
	  })

	})

</script>


<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>

	<? if(($row->member_del_yn!='N' || $row->display_yn=='N') && $row->member_idx!=$this->member_idx  ){ ?>
		<li class="">
			<div class="blind"><?=lang("lang_mypage_00541","관리자에 의해 블라인드 게시글입니다.<br>관리자에게 문의하세요.")?></div>
		</li>
	<? } else {?>
		<li class="board_li board_li_<?=$row->board_idx?>" id="board_li_<?=$row->board_idx?>">
			<table class="tbl_1">
				<colgroup>
					<col width="48px">
					<col width="*">
					<col width="25px">
				</colgroup>
				<tr>
					<td>
						<div class="img_box">
							<img src="<?=$row->member_img?>" onerror="this.src='/images/default_user.png'">
						</div>
					</td>
					<td class="normal_bold">
						<?=$row->member_name?>
						<span class="date">
							<?=$this->global_function->convert_time_exp($row->ins_date)?>
						</span>
					</td>
					<th>
						<img src="/images/icons-dark-more.png" alt="더보기" id="btn_more_<?=$row->board_idx?>" class="btn_more" onclick="set_report('<?=$row->my_board_yn?>', '<?=$row->report_yn?>', '<?=$row->board_idx?>');">
					</th>
				</tr>
			</table>
			<? if(!empty($row->img_path)){ ?>
				<div class="swiper-container main_visual">
					<? if($row->best_yn=='Y'){ ?>
						<img src="/images/tag_best.png" alt="best" class="mark_best">
					<? } ?>
					<div class="swiper-wrapper">
						<?
						$img_path_arr = explode(',', $row->img_path);
						foreach ($img_path_arr as $each) {?>
							<div class="swiper-slide">
								<a href="javascript:void(0)" class="img_box"><img src="<?=$each?>"></a>
							</div>
						<?}?>
					</div>
					<!-- Add Scrollbar -->
					<div class="swiper-pagination"></div>
				</div>
			<? } ?>


			<table class="tbl_2">
				<tr>
					<? if($tab_type==3){ ?>
						<td>
							<?
							$return_url_str = "/".$this->nationcode."/".mapping('community');
							$fnc_str = "board_scrap_reg_in(\'".$row->board_idx."\',this)";
							?>
							<span id="scrap_span_<?=$row->board_idx?>" class="toggle_scrap scrap_2 <? echo $row->scrap_yn == 'Y'? 'on':'' ?>" src="/images/bookmark_off.png" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')"></span>
							<span id="scrap_cnt_<?=$row->board_idx?>"><?=$row->scrap_cnt?></span>
						</td>
					<? } else {?>
						<td>
							<?
							$return_url_str = "/".$this->nationcode."/".mapping('community');
							$fnc_str = "board_scrap_reg_in(\'".$row->board_idx."\',this)";
							?>
							<span id="scrap_span2_<?=$row->board_idx?>" class="toggle_scrap scrap_2 <? echo $row->scrap_yn == 'Y'? 'on':'' ?>" src="/images/bookmark_off.png" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')"></span>
							<span id="scrap_cnt2_<?=$row->board_idx?>"><?=$row->scrap_cnt?></span>
						</td>
					<? } ?>
					<th>
					<?
						$return_url_str = "/".$this->nationcode."/".mapping('community')."/community_detail?board_idx=".$row->board_idx;
						$fnc_str = "location.href=\'".$return_url_str."\'";
						?>
						<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')"><img src="/images/icon-black-chat.png" alt="">
						<!-- <a href="/<?=$this->nationcode.'/'.mapping('community')?>/community_detail?board_idx=<?=$row->board_idx?>"><img src="/images/icon-black-chat.png" alt=""> -->
						<?=$row->reply_cnt?>
						</a>
						<? if($tab_type=='5'){ ?>
							<span class="toggle_like like_4" src="/images/i_like_off.png" onclick="wish_btn('like_4')"></span>
							<?=$row->recommend_cnt?>
						<? } ?>
					</th>
				</tr>
			</table>
			<div class="inner_wrap">
				<ul class="tag_ul row">
					<?
					$tags_arr = explode(',', $row->tags);
					foreach ($tags_arr as $tag) {?>
					  <li><?=$tag ?></li>
					<?}?>
				</ul>
				<p class="contents">
					<span class="txt">
						<?=nl2br($row->contents)?>
					</span>
					<span class="more_view"><?=lang("lang_community_00786","전체보기")?></span>
				</p>
			</div>
		</li>
	<? } ?>


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



	$(function(){
	  // 전체보기
	  $('.more_view').click(function(){
	    $(this).siblings('.txt').css('-webkit-line-clamp','initial');
	    $(this).css('display','none');
	  })

		// main_visual
		var main_visual = new Swiper('.main_visual', {
				slidesPerView: 1,
				slidesPerGroup:1,
				touchReleaseOnEdges:true,
				observer: true, 
				observeParents: true,
				pagination: {
					el: ".main_visual .swiper-pagination",
					dynamicBullets: true,
				},
			});

	})

	

</script>

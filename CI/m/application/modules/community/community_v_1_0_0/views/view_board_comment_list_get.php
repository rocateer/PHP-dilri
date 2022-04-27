
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>
		<!-- 댓글: tbl_cmt, 답글: tbl_reply, 답글의 답글: tbl_re_reply, etc: none_txt -->
		<? if($row['display_yn']=='N'){?>
			<li class="board_reply_li reply_li">
				<div class="del_cmt"><?=lang("lang_community_00465","관리자에 의해 블라인드 된 글입니다.")?></div>
			</li>
		<? } elseif($row['member_del_yn']=='Y'){?>
			<li class="board_reply_li reply_li">
				<div class="del_cmt"><?=lang("lang_community_00466","탈퇴한 회원의 글입니다.")?></div>
			</li>
		<? } elseif($row['member_del_yn']=='P'){?>
			<li class="board_reply_li reply_li">
				<div class="del_cmt"><?=lang("lang_community_00467","관리자에의해 제재된 사용자의 글입니다.")?></div>
			</li>
		<? } elseif($row['del_yn']=='Y'){?>
			<li class="board_reply_li reply_li">
				<div class="del_cmt"><?=lang("lang_community_00463","삭제된 글입니다.")?></div>
			</li>
		<? } else { ?>

			<li class="board_reply_li reply_li"  id="tbl_reply_<?=$row['board_reply_idx']?>">
				<table class="tbl_3">
					<colgroup>
						<col width="28px">
						<col width="*">
						<col width="35px">
					</colgroup>
					<tr>
						<td>
							<div class="img_box profile">
								<img src="<?=$row['member_img']?>"  onerror="this.src='/images/default_user.png'" alt="">
							</div>
						</td>
						<td class="normal_bold">
							<? if($row['board_member_reply_yn']=='Y'){ ?>
								<?=$row['member_name']?> <span class="writer"><?=lang("lang_community_00464","글쓴이")?></span>
							<? } else {?>
								<?=$row['member_name']?>
							<? } ?>
						</td>
						<th>
							<!-- <img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')"> -->
							<img src="/images/i_dot.png" alt="더보기"  id="btn_more_<?=$row['board_reply_idx']?>" class="btn_more"   onclick="set_report('<?=$row['my_board_yn']?>', '<?=$row['report_yn']?>', '<?=$row['board_reply_idx']?>', '0');modal_open_slide('more')">

						</th>
					</tr>
				</table>
				<p class="cmt"><?=nl2br($row['reply_comment'])?></p>
				<span class="date"><?=$row['ins_date']?></span>
				<!-- <span class="btn_reply" onclick="btn_reply()">답글 달기</span> -->
				<span class="btn_reply" onclick="set_relpy_data('1','<?=$row['board_reply_idx']?>','<?=$row['member_idx']?>','<?=$row['member_name']?>')"><?=lang("lang_community_00788","답글 달기")?></span>
			</li>

		<? } ?>
		<!-- 답글:시작 -->
		<? if(!empty($row['board_reply'])){ ?>


			<? if($row['board_reply']->display_yn=='N'){?>
				<li class="board_reply_li reply_li">
					<div class="del_cmt"><?=lang("lang_community_00465","관리자에 의해 블라인드 된 글입니다.")?></div>
				</li>
			<? } elseif($row['board_reply']->member_del_yn=='Y'){?>
				<li class="board_reply_li reply_li">
					<div class="del_cmt"><?=lang("lang_community_00466","탈퇴한 회원의 글입니다.")?></div>
				</li>
			<? } elseif($row['board_reply']->member_del_yn=='P'){?>
				<li class="board_reply_li reply_li">
					<div class="del_cmt"><?=lang("lang_community_00467","관리자에의해 제재된 사용자의 글입니다.")?></div>
				</li>
			<? } elseif($row['board_reply']->del_yn=='Y'){?>
				<li class="board_reply_li reply_li">
					<div class="del_cmt"><?=lang("lang_community_00463","삭제된 글입니다.")?></div>
				</li>
			<? } else { ?>


				<li class="ml30 board_reply_li" id="tbl_reply_<?=$row['board_reply_idx']?>">
					<table class="tbl_3">
						<colgroup>
							<col width="28px">
							<col width="*">
							<col width="35px">
						</colgroup>
						<tr>
							<td>
								<div class="img_box profile">
									<img src="<?=$row['board_reply']->member_img?>" alt="">
								</div>
							</td>
							<td class="normal_bold">
								<? if($row['board_reply']->board_member_reply_yn=='Y'){ ?>
									<?=$row['board_reply']->member_name?> <span class="writer"><?=lang("lang_community_00464","글쓴이")?></span>
								<? } else {?>
									<?=$row['board_reply']->member_name?>
								<? } ?>
							</td>
							<th>
								<!-- <img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')"> -->
								<img src="/images/i_dot.png" alt="더보기" id="btn_more_<?=$row['board_reply']->board_reply_idx?>" class="btn_more"   onclick="set_report('<?=$row['board_reply']->my_board_yn?>', '<?=$row['board_reply']->report_yn?>', '<?=$row['board_reply']->board_reply_idx?>', '1');modal_open_slide('more')">

							</th>
						</tr>
					</table>
					<p class="cmt">
						<? if($row['board_reply']->relpy_member_idx>0){ ?>
							<b>@<?=$row['board_reply']->reply_member_name?> </b>
						<? } ?>
						<?=nl2br($row['board_reply']->reply_comment)?></p>
					<span class="date"><?=$row['board_reply']->ins_date?></span>
					<!-- <span class="btn_reply" onclick="btn_reply()">답글 달기</span> -->
					<!-- <span class="btn_reply" onclick="set_relpy_data('1','<?=$row['board_reply']->board_reply_idx?>','<?=$row['board_reply']->member_idx?>','<?=$row['board_reply']->member_name?>')">답글 달기</span> -->
					<span class="btn_reply" onclick="set_relpy_data('1','<?=$row['parent_board_reply_idx']?>','<?=$row['board_reply']->member_idx?>','<?=$row['board_reply']->member_name?>')"><?=lang("lang_community_00788","답글 달기")?></span>
				</li>
			<? } ?>

		<? } ?>
		<li>
			<ul id="more_list_<?=$row['board_reply_idx']?>" style="display:none"></ul>

		</li>
		<? if($row['board_reply_cnt']>1){ ?>
			<li class="ml30">
				<span  id="more_list_text_<?=$row['board_reply_idx']?>" onclick="board_comment_reply_list_more('<?=$row['board_reply_idx']?>')" class="reply_view"><?=lang("lang_community_00784","답글 더보기")?></span>
			</li>
		<? } ?>
		<!-- 답글:끝 -->

<?php
		}
	}
?>


<script type="text/javascript">
	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

	$("#no_data").css("display","<?=$display?>");

</script>

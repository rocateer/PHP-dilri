
<?php
$display =(count($result_list)<2)? "block":"none";
if(!empty($result_list)){
	for ($i=1; $i < count($result_list); $i++) {
?>
		<!-- 댓글: tbl_cmt, 답글: tbl_reply, 답글의 답글: tbl_re_reply, etc: none_txt -->
		<? if($result_list[$i]->display_yn=='N'){?>
			<li class="ml30 board_reply_li">
				<div class="del_cmt"><?=lang("lang_community_00465","관리자에 의해 블라인드 된 글입니다.")?></div>
			</li>
		<? } elseif($result_list[$i]->member_del_yn=='Y'){?>
			<li class="ml30 board_reply_li">
				<div class="del_cmt"><?=lang("lang_community_00466","탈퇴한 회원의 글입니다.")?></div>
			</li>
		<? } elseif($result_list[$i]->member_del_yn=='P'){?>
			<li class="ml30 board_reply_li">
				<div class="del_cmt"><?=lang("lang_community_00467","관리자에의해 제재된 사용자의 글입니다.")?></div>
			</li>
		<? } elseif($result_list[$i]->del_yn=='Y'){?>
			<li class="ml30 board_reply_li">
				<div class="del_cmt"><?=lang("lang_community_00463","삭제된 글입니다.")?></div>
			</li>
		<? } else { ?>

			<li class="ml30 board_reply_li"  id="tbl_reply_<?=$result_list[$i]->board_reply_idx?>">
				<table class="tbl_3">
					<colgroup>
						<col width="28px">
						<col width="*">
						<col width="35px">
					</colgroup>
					<tr>
						<td>
							<div class="img_box profile">
								<img src="<?=$result_list[$i]->member_img?>"  onerror="this.src='/images/default_user.png'" alt="">
							</div>
						</td>
						<td class="normal_bold">
							<? if($result_list[$i]->board_member_reply_yn=='Y'){ ?>
								<?=$result_list[$i]->member_name?> <span class="writer"><?=lang("lang_community_00464","글쓴이")?></span>
							<? } else {?>
								<?=$result_list[$i]->member_name?>
							<? } ?>
						</td>
						<th>
							<!-- <img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')"> -->
							<img src="/images/i_dot.png" alt="더보기" id="btn_more_<?=$result_list[$i]->board_reply_idx?>" class="btn_more"   onclick="set_report('<?=$result_list[$i]->my_board_yn?>', '<?=$result_list[$i]->report_yn?>', '<?=$result_list[$i]->board_reply_idx?>', '1');modal_open_slide('more')">

						</th>
					</tr>
				</table>
				<p class="cmt">
					<? if($result_list[$i]->relpy_member_idx>0){ ?>
						<b>@<?=$result_list[$i]->reply_member_name?> </b>
					<? } ?>
					<?=nl2br($result_list[$i]->reply_comment)?>
				</p>
				<span class="date"><?=$result_list[$i]->ins_date?></span>
				<!-- <span class="btn_reply" onclick="btn_reply()">답글 달기</span> -->
				<span class="btn_reply" onclick="set_relpy_data('1','<?=$result_list[$i]->parent_board_reply_idx?>','<?=$result_list[$i]->member_idx?>','<?=$result_list[$i]->member_name?>')"><?=lang("lang_community_00788","답글 달기")?></span>
			</li>


		<? } ?>

<?php
		}
	}
?>

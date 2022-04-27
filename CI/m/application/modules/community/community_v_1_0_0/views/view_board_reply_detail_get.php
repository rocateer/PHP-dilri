<!-- 댓글: tbl_cmt, 답글: tbl_reply, 답글의 답글: tbl_re_reply, etc: none_txt -->
<? if($result->depth==0){ ?>

	<li  class="board_reply_li reply_li" id="tbl_reply_<?=$result->board_reply_idx?>">
		<table class="tbl_3">
			<colgroup>
				<col width="28px">
				<col width="*">
				<col width="35px">
			</colgroup>
			<tr>
				<td>
					<div class="img_box profile">
						<img src="<?=$result->member_img?>"  onerror="this.src='/images/default_user.png'" alt="">
					</div>
				</td>
				<td class="normal_bold">
					<? if($result->board_member_reply_yn=='Y'){ ?>
						<?=$result->member_name?> <span class="writer"><?=lang("lang_community_00464","글쓴이")?></span>
					<? } else {?>
						<?=$result->member_name?>
					<? } ?>
				</td>
				<th>
					<!-- <img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')"> -->
					<img src="/images/i_dot.png" alt="더보기" id="btn_more_<?=$result->board_reply_idx?>" class="btn_more"   onclick="set_report('<?=$result->my_board_yn?>', '<?=$result->report_yn?>', '<?=$result->board_reply_idx?>', '0');modal_open_slide('more')">

				</th>
			</tr>
		</table>
		<p class="cmt"><?=nl2br($result->reply_comment)?></p>
		<span class="date"><?=$result->ins_date?></span>
		<!-- <span class="btn_reply" onclick="btn_reply()">답글 달기</span> -->

		<span class="btn_reply" onclick="set_relpy_data('1','<?=$result->board_reply_idx?>','<?=$result->member_idx?>','<?=$result->member_name?>')"><?=lang("lang_community_00788","답글 달기")?></span>

		<li>
			<ul id="more_list_<?=$result->board_reply_idx?>" style="display:none"></ul>

		</li>
	</li>

<? } else {?>

	<li class="ml30 board_reply_li reply_li"  id="tbl_reply_<?=$result->board_reply_idx?>">
		<table class="tbl_3">
			<colgroup>
				<col width="28px">
				<col width="*">
				<col width="35px">
			</colgroup>
			<tr>
				<td>
					<div class="img_box profile">
						<img src="<?=$result->member_img?>"  onerror="this.src='/images/default_user.png'" alt="">
					</div>
				</td>
				<td class="normal_bold">
					<? if($result->board_member_reply_yn=='Y'){ ?>
						<?=$result->member_name?> <span class="writer"><?=lang("lang_community_00464","글쓴이")?></span>
					<? } else {?>
						<?=$result->member_name?>
					<? } ?>
				</td>
				<th>
					<!-- <img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')"> -->
					<img src="/images/i_dot.png" alt="더보기" id="btn_more_<?=$result->board_reply_idx?>" class="btn_more"   onclick="set_report('<?=$result->my_board_yn?>', '<?=$result->report_yn?>', '<?=$result->board_reply_idx?>', '1');modal_open_slide('more')">

				</th>
			</tr>
		</table>
		<p class="cmt">
			<? if($result->relpy_member_idx>0){ ?>
				<b>@<?=$result->reply_member_name?></b> 
			<? } ?>
			<?=nl2br($result->reply_comment)?>
		</p>
		<span class="date"><?=$result->ins_date?></span>
		<!-- <span class="btn_reply" onclick="btn_reply()">답글 달기</span> -->
		<span class="btn_reply" onclick="set_relpy_data('1','<?=$result->parent_board_reply_idx?>','<?=$result->member_idx?>','<?=$result->member_name?>')"><?=lang("lang_community_00788","답글 달기")?></span>
	</li>

<? } ?>

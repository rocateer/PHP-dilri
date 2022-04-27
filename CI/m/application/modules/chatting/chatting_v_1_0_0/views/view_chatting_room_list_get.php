
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>
	<li class="relative chatting_li chatting_room_<?=$row->chatting_room_idx?> old" id="chatting_room_<?=$row->chatting_room_idx?>">
		<a href="javascript:void(0)" onclick="api_native_window_open('<?=$row->chatting_room_idx?>', '<?=$this->member_idx?>')" class="click_link"></a>
		<table class="table_chat_list">
			<colgroup>
				<col width="65">
				<col width="*">
			</colgroup>
			<tr>
				<th colspan="2">
					<span class="title" onclick="api_native_window_open('<?=$row->chatting_room_idx?>', '<?=$this->member_idx?>')"><?=$row->title?></span>
					<img src="/images/i_dot.png" alt="더보기" class="btn_more" onclick="$('#chatting_room_idx').val('<?=$row->chatting_room_idx?>');modal_open_slide('more')">
				</th>
			</tr>
			<tr>
				<td rowspan="2">
					<div class="img_box profile">
						<? if($row->member_idx==$this->member_idx){ ?>
							<img src="<?=$row->partner_member_img?>" onerror="this.src='/images/default_user.png'">
							<? if($row->member_read_yn=='N'){ ?>
								<span class="new"></span>
							<? } ?>
						<? } else {?>
							<img src="<?=$row->member_img?>" onerror="this.src='/images/default_user.png'">
							<? if($row->partner_member_read_yn=='N'){ ?>
								<span class="new"></span>
							<? } ?>
						<? } ?>
					</div>
				</td>
				<td>
					<? if($row->member_idx==$this->member_idx){ ?>
						<?=$row->partner_member_name?>
					<? } else {?>
						<?=$row->member_name?>
					<? } ?>
					<span class="date"><?=$row->last_chatting_date?></span>
				</td>
			</tr>
			<tr>
				<td>
					<p class="fs_12 font_gray_9"><?=$row->last_chatting_comment?></p>
				</td>
			</tr>
		</table>
	</li>

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

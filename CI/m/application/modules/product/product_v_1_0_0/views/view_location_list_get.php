<li>
	<?=lang("lang_main_00120","현재 내 위치")?>
</li>
<?
if(!empty($result_list)){
	foreach($result_list as $row){
?>
	<li name="member_location" id="member_location_<?=$row->member_location_idx?>" onclick="change_location(<?=$row->member_location_idx?>,'<?=$row->title?>','<?=$row->member_addr?>'); active_mod(<?=$row->member_location_idx?>);">
		<?=$row->title?> <img src="/images/i_s_delete.png" alt="x" class="btn_delete" onclick="member_location_del(<?=$row->member_location_idx?>)">
	</li>
<?
		}
	}
?>

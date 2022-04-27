<?php
$display =(count($alarm_list)<1)? "block":"none";

if(!empty($alarm_list)){
	foreach($alarm_list as $row){
?>
		<li class="alarm_li" id="alarm_idx_<?=$row->alarm_idx?>">
			<a href="javascript:void(0)"  onClick="alarm_read_mod_up('<?=$row->alarm_idx?>'); go_url(<?=str_replace("\"","'", $row->data)?>);">
				<p><?=$row->msg?></p>
				<div class="date"><?=$row->ins_date?></div>
			</a>
			<img src="/images/i_alarim_delete.png" onClick="alarm_del('<?=$row->alarm_idx?>')" alt="x" class="btn_delete">
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

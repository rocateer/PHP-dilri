
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	$date_temp = "";
	foreach($result_list as $row){
		$date_temp = $row->ins_date;
?>
	<ul class="point_ul">
		<li>
			<div class="point_date"><?=$row->ins_date?></div>
			<table class="tbl_point">
	      <?  foreach ($point_list as $point_row){ 
							if($date_temp == $point_row->ins_date){
				?>
					<tr>
						<th><?=$point_row->memo?></th>
						<?if($point_row->point_type == 0){?>
							<td>+<?=number_format($point_row->point)?>P</td>
						<?} else {?>
							<td class="minus"><?=number_format($point_row->point)?>P</td>
						<?}?>
					</tr>
				<?    }
					 }
				?>
			</table>
		</li>
	</ul>
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

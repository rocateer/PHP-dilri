
<?php
$display =(count($result_list)<1)? "block":"none";
$display2 =(count($result_list)<1)? "none":"block";

if(!empty($result_list)){
	foreach($result_list as $row){
?>

		<li class="search_li" id="search_li_<?=$row->search_idx?>">
			<a href="javascript:void(0)" onclick="$('#search_text').val('<?=$row->title?>');default_list_get('1','0');default_list_get('1','1');search_reg_in('0')">
				<?=$row->title?>
			</a>
			<img src="/images/i_delete_gray.png" onclick="search_del('<?=$row->search_idx?>')" alt="x" class="btn_delete">
		</li>

<?php
		}
	}
?>


<script type="text/javascript">

	$("#no_data").css("display","<?=$display?>");
	$("#list_ajax").css("display","<?=$display2?>");

</script>


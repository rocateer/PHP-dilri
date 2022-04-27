
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>

<li class="accordion">
	<p class="trigger"><img src="/images/i_question.png" class="question"><?=$row->title?></p>
	<div class="answer_wrap panel">
		<?=nl2br($row->contents)?>
	</div>
</li>

<?php
		}
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

</script>

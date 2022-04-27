
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>
	<? if($row->reply_yn == 'Y'){ ?>

		<li>
      <a href="/<?=$this->nationcode.'/'.mapping('qa')?>/qa_detail?qa_idx=<?=$row->qa_idx?>" class="block">
			<div class="title"><span>[<?=$this->global_function->code2text($row->qa_type)?>]</span><p><?=$row->qa_title?></p></div>
			<button class="active"><?=lang("lang_qa_00726","답변완료")?></button>
			<span><?=$this->global_function->date_Ymd_Hyphen($row->ins_date)?></span>
      </a>
		</li>
	<? } else {?>
		<li>
      <a href="/<?=$this->nationcode.'/'.mapping('qa')?>/qa_detail?qa_idx=<?=$row->qa_idx?>" class="block">
				<div class="title"><span>[<?=$this->global_function->code2text($row->qa_type)?>]</span><p><?=$row->qa_title?></p></div>
				<button class="deactive"><?=lang("lang_qa_00725","답변대기")?></button>
				<span><?=$this->global_function->date_Ymd_Hyphen($row->ins_date)?></span>
      </a>
		</li>
	<? } ?>


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

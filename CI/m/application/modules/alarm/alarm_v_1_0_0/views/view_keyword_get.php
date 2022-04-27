<?php
if(empty($result->alarm_keyword)){
  $keyword_list = array();
}else {
  $keyword_list = explode(",",$result->alarm_keyword);
}

if(!empty($result->alarm_keyword)){
  $tag_num = 0;
	foreach($keyword_list as $row){
?>
  <li name="tag_num" value="<?=$tag_num?>">
    <?=$row?>
    <img src="/images/i_delete.png" alt="x" class="btn_delete" onclick="hashtag_del(<?=$tag_num?>);">
  </li>
<?$tag_num++;
		}
	}
?>

<script type="text/javascript">
  document.querySelector(".cnt_num").innerText = <?=count($keyword_list)?>+'/30';
</script>

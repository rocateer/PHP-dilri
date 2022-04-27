<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1 class="over_txt">
    <?=lang("lang_qa_00748","상세")?>
  </h1>
  <p class="qa_title del" onclick="qa_del()"><?=lang("lang_qa_00750","삭제")?></p>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="body">
  <div class="qa_top_txt">
    <div class="title">[<?=$this->global_function->code2text($result->qa_type)?>] <?=$result->qa_title?></div>
    <div class="date"><?=$this->global_function->date_YmdHi_Hyphen($result->ins_date)?></div>
    <?=nl2br($result->qa_contents)?>
  </div>
  <?php if ($result->reply_yn == 'Y') { ?>
  <div class="qa_bottom_txt">
    <p>
      <?=nl2br($result->reply_contents)?>
    </p>
    <div class="date"><?=$this->global_function->date_YmdHi_Hyphen($result->reply_date)?></div>
  </div>
  <?php }  ?>
</div>
<!-- body : e -->


<input name="qa_idx" id="qa_idx" type="hidden" value="<?=$result->qa_idx?>">

<script type="text/javascript">

// 댓글 삭제
function qa_del(){

  if(confirm("<?=lang("lang_qa_00749","해당 문의글을 삭제 하시겠습니까? 삭제 하시면 해당 글은 다시 복구 할 수 없습니다.")?>")){

    $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('qa')?>/qa_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {
        "qa_idx" : $('#qa_idx').val()
      },
      success : function(result){
        if(result.code == '-1'){
     			alert(result.code_msg);
     			$("#"+result.focus_id).focus();
     			return;
   		  }
   		  // 0:실패 1:성공
   		  if(result.code == 0) {
     			alert(result.code_msg);
   		  }else {
          alert(result.code_msg);
          location.href ='/<?=$this->nationcode.'/'.mapping('qa')?>/qa_list';
     		}
      }
    });
  }
}

</script>

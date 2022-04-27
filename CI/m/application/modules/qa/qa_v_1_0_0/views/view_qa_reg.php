<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
   <?=lang("lang_qa_00727","1:1 문의 등록")?>
  </h1>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="qa_reg_page body vh_wrap">
  <div class="vh_body">
    <div class="inner_wrap">
      <div class="label"><?=lang("lang_qa_00728","문의 유형")?> <span class="essential">*</span></div>
      <select class="" name="qa_type" id="qa_type">
        <option value=""><?=lang("lang_qa_00729","선택하여 주세요.")?></option>
        <option value="1"><?=lang("lang_qa_00736","환불/분쟁사기")?></option>
        <option value="2"><?=lang("lang_qa_00737","계정")?></option>
        <option value="3"><?=lang("lang_qa_00738","판매금지")?></option>
        <option value="4"><?=lang("lang_qa_00739","거래평가")?></option>
        <option value="5"><?=lang("lang_qa_00740","게시글 노출유무")?></option>
        <option value="6"><?=lang("lang_qa_00741","채팅알림")?></option>
        <option value="7"><?=lang("lang_qa_00742","앱사용/거래방법")?></option>
        <option value="8"><?=lang("lang_qa_00743","커뮤니티")?></option>
        <option value="9"><?=lang("lang_qa_00744","검색")?></option>
        <option value="10"><?=lang("lang_qa_00745","기타")?></option>
        <option value="11"><?=lang("lang_qa_00746","오류제보")?></option>
      </select>
      <div class="label"><?=lang("lang_qa_00730","제목")?> <span class="essential">*</span></div>
      <input type="text" id="qa_title" name="qa_title" placeholder="<?=lang("lang_qa_00731","제목을 입력해 주세요")?>">
      <div class="label"><?=lang("lang_qa_00732","내용")?> <span class="essential">*</span></div>
      <textarea id="qa_contents" name="qa_contents" placeholder="<?=lang("lang_qa_00733","내용을 입력해 주세요")?>"></textarea>
    </div>
  </div>
  <div class="vh_footer btn_full_weight mt30 mb30 btn_point">
    <a href="javascript:void(0)" onclick="qa_reg_in();"><?=lang("lang_product_00155","등록")?></a>
  </div>
</div>
<!-- body : e -->


<script type="text/javascript">
// setTimeout(function(){
//   history.replaceState({ data: 'testData2' }, null, document.referrer);
// }, 100);

function qa_reg_in(){

  var formData = {
    'qa_type' : $('#qa_type').val(),
    'qa_title' : $('#qa_title').val(),
    'qa_contents' : $('#qa_contents').val()
  }

  $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('qa')?>/qa_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
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
          history.replaceState({ data: 'testData2' }, null, document.referrer);
          history.back();
          // location.href ='/<?=$this->nationcode.'/'.mapping('qa')?>/qa_list';
     		}
      }
    });
}
</script>

<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
   등록
  </h1>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="qa_reg_page body vh_wrap">
  <div class="vh_body">
    <div class="inner_wrap">
      <div class="label">문의 유형 <span class="essential">*</span></div>
      <select class="" name="">
        <option value="">선택하여 주세요.</option>
      </select>
      <div class="label">제목 <span class="essential">*</span></div>
      <input placeholder="제목을 입력해 주세요">
      <div class="label">내용 <span class="essential">*</span></div>
      <textarea placeholder="내용을 입력해 주세요"></textarea>
    </div>
  </div>
  <div class="vh_footer btn_full_weight mt30 mb30 btn_point">
    <a href="/<?=mapping('qa')?>">등록</a>
  </div>
</div>
<!-- body : e -->

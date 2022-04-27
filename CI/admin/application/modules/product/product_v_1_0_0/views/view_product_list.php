<!-- container-fluid : s -->
<div class="container-fluid wide" style="width:1900px">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>상품 관리</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <form name="form_default" id="form_default" method="post">
      <table class="search_table">
        <colgroup>
          <col style="width:120px">
          <col style="width:330px">
          <col style="width:120px">
          <col style="width:330px">
        </colgroup>
        <tbody>
          <tr>
            <th style="text-align:center">사용자 ID</th>
            <td>
              <input name="member_id" id="member_id" class="form-control">
            </td>
            <th style="text-align:center">사용자 이름</th>
            <td>
              <input name="member_name" id="member_name" class="form-control">
            </td>
          </tr>
          <tr>
            <th style="text-align:center">등록일</th>
            <td>
              <input name="s_date" id="s_date" class="form-control datepicker">&nbsp;<i class="fa fa-calendar-o"></i>&nbsp;~&nbsp;
              <input name="e_date" id="e_date" class="form-control datepicker">&nbsp;<i class="fa fa-calendar-o"></i>
            </td>
            <th style="text-align:center">제목</th>
            <td >
              <input name="title" id="title" class="form-control">
            </td>
          </tr>
          <tr>
            <th style="text-align:center">카테고리</th>
            <td >
              <input name="category_name" id="category_name" class="form-control">
            </td>
            <th style="text-align:center">해시태그</th>
            <td >
              <input name="tags" id="tags" class="form-control">
            </td>
          </tr>

          <tr>
            <th style="text-align:center">거래상태</th>
            <td >
              <label class="radio-inline"><input type="radio" name="product_state" checked="" value=""> 전체</label>
              <label class="radio-inline"><input type="radio" name="product_state" value="0"> 판매중</label>
              <label class="radio-inline"><input type="radio" name="product_state" value="1"> 예약중</label>
              <label class="radio-inline"><input type="radio" name="product_state" value="2"> 거래완료</label>
            </td>
            <th style="text-align:center">게시상태</th>
            <td >
              <label class="radio-inline"><input type="radio" name="display_yn" checked="" value=""> 전체</label>
              <label class="radio-inline"><input type="radio" name="display_yn" value="Y"> 게시중</label>
              <label class="radio-inline"><input type="radio" name="display_yn" value="N"> 블라인드</label>
            </td>
          </tr>
          <tr>
            <th style="text-align:center">무료나눔</th>
            <td >
              <label class="radio-inline"><input type="radio" name="free_product_yn" checked="" value=""> 전체</label>
              <label class="radio-inline"><input type="radio" name="free_product_yn" value="Y"> 무료나눔</label>
              <label class="radio-inline"><input type="radio" name="free_product_yn" value="N"> 대상아님</label>
            </td>
            <th style="text-align:center">인기상품</th>
            <td >
              <label class="radio-inline"><input type="radio" name="famous_product_yn" checked="" value=""> 전체</label>
              <label class="radio-inline"><input type="radio" name="famous_product_yn" value="Y"> 인기상품 설정</label>
              <label class="radio-inline"><input type="radio" name="famous_product_yn" value="N"> 인기상품 설정 안함</label>
            </td>
          </tr>
        </tbody>
      </table>
      </form>
      <div class="text-center mt20">
        <a class="btn btn-success" href="javascript:void(0)" onclick="default_list_get(1);">검색</a>
      </div>
    </div>
    <!-- search : e -->

    <div class="bg_wh mb20" id="list_ajax"></div>

  </div>
  <!-- body : e -->

</div>
<!-- container-fluid : e -->

<!-- modal : s -->
<div class="admin_modal modal_img_full">
  <img src="" id="img_modal_src" class="img_block">
</div>
<div class="md_overlay md_overlay_img_full" onclick="javascript:modal_close('img_full')"></div>
<!-- modal : e -->

<input type="text" name="page_num" id="page_num" value="1"  style="display:none">

<script>

//엔터키 시 검색
window.addEventListener('keydown', function(event){
  if (window.event.keyCode == 13) {
    // 엔터키가 눌렸을 때 실행할 내용
    default_list_get(1);
  }
})

$(document).ready(function(){
  setTimeout("default_list_get($('#page_num').val())", 10);
});

//카테고리 리스트 가져오기
function default_list_get(page){

  $('#page_num').val(page);

  var formData = {
    'member_id' :  $('#member_id').val(),
    'member_name' : $('#member_name').val(),
    's_date' : $('#s_date').val(),
    'e_date' : $('#e_date').val(),
    'title' : $('#title').val(),
    'category_name' : $('#category_name').val(),
    'tags' : $('#tags').val(),
    'product_state' : $("input[name='product_state']:checked").val(),
    'display_yn' : $("input[name='display_yn']:checked").val(),
    'free_product_yn' : $("input[name='free_product_yn']:checked").val(),
    'famous_product_yn' : $("input[name='famous_product_yn']:checked").val(),
    'history_data' : window.history.length,
    'page_num' : page,
  };

  $.ajax({
    url      : "/<?=mapping('product')?>/product_list_get",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : formData,
    success: function(result) {
      $('#list_ajax').html(result);
    }
  });
}

// 인기상품 설정 상태 수정
function famous_product_yn_mod_up(product_idx, famous_product_yn){

  var formData = {
    "product_idx" : product_idx,
    "famous_product_yn" : famous_product_yn
  };

  $.ajax({
    url      : "/<?=mapping('product')?>/famous_product_yn_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        alert(result.code_msg);
        default_list_get($('#page_num').val());
      }
    }
  });
}



var do_excel_down = function() {
  console.log(document.form_default);
  document.form_default.action ="/<?=mapping('product')?>/product_list_excel";
  document.form_default.submit();
}

</script>

<!-- container-fluid : s -->
<div class="container-fluid  wide">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>상품 신고 관리</h1>
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
            <th style="text-align:center;">신고한 회원 이름</th>
            <td>
              <input name="member_name" id="member_name" class="form-control">
            </td>
            <th style="text-align:center;">신고한 회원 아이디</th>
            <td>
              <input name="member_id" id="member_id" class="form-control">
            </td>
          </tr>
          <tr>
            <th style="text-align:center;">신고 받은 회원 이름</th>
            <td>
              <input name="reported_member_name" id="reported_member_name" class="form-control">
            </td>
            <th style="text-align:center;">신고 받은 회원 아이디</th>
            <td>
              <input name="reported_member_id" id="reported_member_id" class="form-control">
            </td>
          </tr>
          <tr>
            <th style="text-align:center;">신고유형</th>
            <td>
              <label class="checkbox-inline"><input type="radio" name="report_type" id="report_type_all" value="" checked> 전체</label>
              <label class="checkbox-inline"><input type="radio" name="report_type" value="0" > 욕설 및 비방글</label>
              <label class="checkbox-inline"><input type="radio" name="report_type" value="1" > 음란성 글</label>
              <label class="checkbox-inline"><input type="radio" name="report_type" value="2" > 기타 비매너</label>
            </td>
            <th style="text-align:center;">게시 상태</th>
            <td>
              <label class="checkbox-inline"><input type="radio" name="display_yn" id="display_yn" value="" checked>전체</label>
              <label class="checkbox-inline"><input type="radio" name="display_yn" value="Y" >게시중</label>
              <label class="checkbox-inline"><input type="radio" name="display_yn" value="N" >블라인드</label>
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
  })

  function default_list_get(page){
    $('#page_num').val(page);

    var formData = {
      'member_name' :  $('#member_name').val(),
      'member_id' :  $('#member_id').val(),
      'reported_member_name' :  $('#reported_member_name').val(),
      'reported_member_id' :  $('#reported_member_id').val(),
      'report_type' :  $("input[name='report_type']:checked").val(),
      'display_yn' :  $("input[name='display_yn']:checked").val(),
      'page_num' : page,
    };

    $.ajax({
      url      : "/<?=mapping('product_report')?>/product_report_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

  function product_display_yn_mod_up(product_idx, display_yn){

    var formData = {
      "product_idx" : product_idx,
      "display_yn" : display_yn
    };

    $.ajax({
      url      : "/<?=mapping('product')?>/product_display_yn_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success: function(result){
        if(result.code == "0"){
          alert(result.code_msg);
        }else{
          alert(result.code_msg);
          default_list();
        }
      }
    });
  }

</script>

<!-- container-fluid : s -->
<div class="container-fluid wide">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>회원 관리</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <form name="form_default" id="form_default">

      <table class="search_table">
        <colgroup>
          <col style="width:100px">
          <col style="width:350px">
          <col style="width:100px">
          <col style="width:350px">
        </colgroup>
        <tbody>
          <tr>
            <th style="text-align:center">아이디</th>
            <td>
              <input name="member_id" id="member_id" class="form-control">
            </td>
            <th style="text-align:center">이름</th>
            <td>
              <input name="member_name" id="member_name" class="form-control">
            </td>
          </tr>
          <tr>
            <th style="text-align:center">회원 상태</th>
            <td class="filter_wrap">
               <label class="radio-inline"><input type="radio" name="del_yn" value="" checked>전체</label>
               <label class="radio-inline"><input type="radio" name="del_yn" value="N">이용중</label>
               <label class="radio-inline"><input type="radio" name="del_yn" value="P">이용정지</label>
               <label class="radio-inline"><input type="radio" name="del_yn" value="Y">탈퇴</label>
          </td>
            <th style="text-align:center">가입일</th>
            <td>
              <input name="s_date" id="s_date" class="form-control datepicker" >&nbsp;<i class="fa fa-calendar-o"></i>&nbsp;~&nbsp;
              <input name="e_date" id="e_date" class="form-control datepicker" >&nbsp;<i class="fa fa-calendar-o"></i>
            </td>
          </tr>
          <tr>
            <th style="text-align:center">잔여 포인트</th>
            <td>
              <input name="s_member_point" id="s_member_point" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">&nbsp;~&nbsp;
              <input name="e_member_point" id="e_member_point" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">
            </td>
            <th style="text-align:center">거래 글 등록 수</th>
            <td>
              <input name="s_product_cnt" id="s_product_cnt" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">&nbsp;~&nbsp;
              <input name="e_product_cnt" id="e_product_cnt" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">
            </td>
          </tr>
          <tr>
            <th style="text-align:center">무료 나눔 완료 수</th>
            <td>
              <input name="s_free_product_cnt" id="s_free_product_cnt" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">&nbsp;~&nbsp;
              <input name="e_free_product_cnt" id="e_free_product_cnt" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">
            </td>
            <th style="text-align:center">좋음 평가 수</th>
            <td>
              <input name="s_good_product_cnt" id="s_good_product_cnt" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">&nbsp;~&nbsp;
              <input name="e_good_product_cnt" id="e_good_product_cnt" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">
            </td>
          </tr>
          <tr>
            <th style="text-align:center">나쁨 평가 수</th>
            <td >
              <input name="s_bad_product_cnt" id="s_bad_product_cnt" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">&nbsp;~&nbsp;
              <input name="e_bad_product_cnt" id="e_bad_product_cnt" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">
            </td>
            <th style="text-align:center">정렬</th>
            <td>
              <select name="orderby" id="orderby" class="form-control w_auto">
                  <option value="">선택</option>
                  <option value="0">가입일 오름차순</option>
                  <option value="1">가입일 내림차순</option>
                  <option value="2">거래글 등록수 오름차순</option>
                  <option value="3">거래글 등록수 내림차순</option>
                  <option value="4">잔여 포인트 오름차순</option>
                  <option value="5">잔여 포인트 내림차순</option>
                  <option value="6">좋음 평가수 오름차순</option>
                  <option value="7">좋음 평가수 내림차순</option>
                  <option value="8">나쁨 평가수 오름차순</option>
                  <option value="9">나쁨 평가수 내림차순</option>
                  <option value="10">무료 나눔 완료수 오름차순</option>
                  <option value="11">무료 나눔 완료수 내림차순</option>
                </select>
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
<input type="hidden" name="page_num" id="page_num" value="1"  style="display:none">
<script>

//엔터키 시 검색
window.addEventListener('keydown', function(event){
  if (window.event.keyCode == 13) {
    // 엔터키가 눌렸을 때 실행할 내용
    default_list_get(1);
  }
})


  window.onload = function(){
    setTimeout(default_list_get(1), 10);
  }

  function default_list_get(page){
    $('#page_num').val(page);

    var formData = {
      'member_id' : $('#member_id').val(),
      'member_name' : $('#member_name').val(),
      'del_yn' : $("input[name='del_yn']:checked").val(),
      's_date' : $('#s_date').val(),
      'e_date' : $('#e_date').val(),
      's_member_point' : $('#s_member_point').val(),
      'e_member_point' : $('#e_member_point').val(),
      's_product_cnt' : $('#s_product_cnt').val(),
      'e_product_cnt' : $('#e_product_cnt').val(),
      's_free_product_cnt' : $('#s_free_product_cnt').val(),
      'e_free_product_cnt' : $('#e_free_product_cnt').val(),
      's_good_product_cnt' : $('#s_good_product_cnt').val(),
      'e_good_product_cnt' : $('#e_good_product_cnt').val(),
      's_bad_product_cnt' : $('#s_bad_product_cnt').val(),
      'e_bad_product_cnt' : $('#e_bad_product_cnt').val(),
      'orderby' : $('#orderby').val(),
      'history_data' : window.history.length,
      'page_num' : page
    };

    $.ajax({
      url      : "/<?=mapping('member')?>/member_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

  // 엑셀 다운로드
  var do_excel_down = function() {
    document.form_default.action ="/<?=mapping('member')?>/member_list_excel";
    document.form_default.submit();
  }


</script>

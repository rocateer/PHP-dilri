<!-- container-fluid : s -->
<div class="container-fluid" style="width:50%">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>검색어 통계</h1>
  </div>

  <!-- search table : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <form name="form_default" id="form_default" method="post">
      <table class="search_table">
        <colgroup>
          <col style="width:100px">
          <col style="width:350px">
          <col style="width:100px">
          <col style="width:350px">
        </colgroup>
        <tbody>
          <tr>
            <th style="text-align:center">기간</th>
            <td colspan="3">
              <input name="s_date_1" id="s_date_1" class="form-control datepicker">&nbsp;<i class="fa fa-calendar-o"></i>&nbsp;~&nbsp;
              <input name="e_date_1" id="e_date_1" class="form-control datepicker">&nbsp;<i class="fa fa-calendar-o"></i>
              <a class="btn btn-success" href="javascript:void(0)" onclick="search_list_get(1);">검색</a>
            </td>
          </tr>
        </tbody>
      </table>
      </form>
    </div>
    <!-- search : e -->

    <div class="bg_wh mb20" id="list_ajax_1"></div>

  </div>
  <!-- search table : e -->
  
  <!-- Page Heading -->
  <div class="page-header" style="padding-top:20px;">
    <h1>카테고리 통계</h1>
  </div>
  
  <!-- category table table : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <form name="form_default" id="form_default" method="post">
      <table class="search_table">
        <colgroup>
          <col style="width:100px">
          <col style="width:350px">
          <col style="width:100px">
          <col style="width:350px">
        </colgroup>
        <tbody>
          <tr>
            <th style="text-align:center">기간</th>
            <td colspan="3">
              <input name="s_date_2" id="s_date_2" class="form-control datepicker">&nbsp;<i class="fa fa-calendar-o"></i>&nbsp;~&nbsp;
              <input name="e_date_2" id="e_date_2" class="form-control datepicker">&nbsp;<i class="fa fa-calendar-o"></i>
              <a class="btn btn-success" href="javascript:void(0)" onclick="category_list_get(1);">검색</a>
            </td>
          </tr>
        </tbody>
      </table>
      </form>
    </div>
    <!-- category table : e -->

    <div class="bg_wh mb20" id="list_ajax_2"></div>

  </div>
  <!-- search table : e -->
</div>
<!-- container-fluid : e -->

<input type="text" name="page_num_1" id="page_num_1" value="1" style="display: none;">
<input type="text" name="page_num_2" id="page_num_2" value="1" style="display: none;">

<script>
  // 검색어 통계 리스트
  function search_list_get(page_num){
   $('#page_num_1').val(page_num);
   
    var formData = {
      'history_data' : window.history.length,
      's_date' : $('#s_date_1').val(),
      'e_date' : $('#e_date_1').val(),
      'page_num' : page_num
    };

    $.ajax({
      url      : "/<?=mapping('statistic')?>/search_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $('#list_ajax_1').html(result);
      }
    });
  }
  
  // 카테고리 통계 리스트
  function category_list_get(page_num){
   $('#page_num_2').val(page_num);
   
    var formData = {
      'history_data' : window.history.length,
      's_date' : $('#s_date_2').val(),
      'e_date' : $('#e_date_2').val(),
      'page_num' : page_num
    };

    $.ajax({
      url      : "/<?=mapping('statistic')?>/category_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $('#list_ajax_2').html(result);
      }
    });
  }
  
</script>

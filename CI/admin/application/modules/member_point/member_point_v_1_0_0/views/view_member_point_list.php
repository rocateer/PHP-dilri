<!-- container-fluid : s -->
<div class="container-fluid wide">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>포인트 관리</h1>
  </div>

  <!-- body : s -->
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
            <th style="text-align:center;">아이디</th>
            <td>
              <input name="member_id" id="member_id" class="form-control">
            </td>
            <th style="text-align:center;">이름</th>
            <td>
              <input name="member_name" id="member_name" class="form-control">
            </td>
          </tr>
          <tr>
            <th style="text-align:center;">구분</th>
            <td class="filter_wrap">
               <label class="radio-inline"><input type="radio" name="point_type" value="" checked>전체</label>
               <label class="radio-inline"><input type="radio" name="point_type" value="0">지급</label>
               <label class="radio-inline"><input type="radio" name="point_type" value="1">차감</label>
               <label class="radio-inline"><input type="radio" name="point_type" value="2">사용</label>
          </td>
            <th style="text-align:center;">일자</th>
            <td>
              <input name="s_date" id="s_date" class="form-control datepicker">&nbsp;<i class="fa fa-calendar-o"></i>&nbsp;~&nbsp;
              <input name="e_date" id="e_date" class="form-control datepicker">&nbsp;<i class="fa fa-calendar-o"></i>


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
      'member_name' :  $('#member_name').val(),
      'member_id' :  $('#member_id').val(),
      's_date' : $('#s_date').val(),
      'e_date' : $('#e_date').val(),
      'point_type' :   get_checkbox_value('point_type'),
      'device_os' :  $("input[name='device_os']:checked").val(),
      'member_gender' :  $("input[name='member_gender']:checked").val(),
      'history_data' : window.history.length,
      'page_num' : page
    };

    $.ajax({
      url      : "/<?=mapping('member_point')?>/member_point_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

  // 포인트 지급, 포인트 차감
  var member_point_reg = function(point_type) {
    openWin = window.open("/<?=mapping('member_point')?>/member_point_reg?point_type="+point_type,"CLIENT_WINDOW", "width=1100, height=500, resizable = no, scrollbars = no");
  }

  // 포인트 지급, 포인트 차감
  var group_member_point_reg = function(point_type) {

    var member_idxs = get_checkbox_value('checkbox');

    openWin = window.open("/<?=mapping('member_point')?>/group_member_point_reg?point_type="+point_type+"&member_idxs="+member_idxs,"CLIENT_WINDOW", "width=1100, height=900, resizable = no, scrollbars = no");
  }

  // 검색 입력필드 초기화
  function dateInit(){
    $('#s_date').val(''); // 초기화
    $('#e_date').val(''); // 초기화
  }

  // 검색 날짜 입력하기
  function makeDate(date,today){
    $('#s_date').val(date);
    $('#e_date').val(today);
  }


</script>

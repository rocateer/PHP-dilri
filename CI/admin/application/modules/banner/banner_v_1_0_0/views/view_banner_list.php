<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>배너 관리</h1>
  </div>

  <!-- search : s -->
   <div class="bg_wh mt20">
     <div class="table-responsive">
       <form name="form_default" id="form_default" method="post">
       <table class="search_table">
         <colgroup>
           	<col style="width:15%">
           	<col style="width:35%">
           	<col style="width:15%">
           	<col style="width:35%">
         </colgroup>
         <tbody>
           <tr>
             <th style="text-align:center">배너명</th>
             <td>
               <input name="title" id="title" class="form-control">
             </td>
             <th style="text-align:center">등록일</th>
             <td>
               <input name="s_date" id="s_date" class="form-control datepicker" autocomplete="off" >&nbsp;<i class="fa fa-calendar-o"></i>&nbsp;~&nbsp;
               <input name="e_date" id="e_date" class="form-control datepicker" autocomplete="off" >&nbsp;<i class="fa fa-calendar-o"></i>
             </td>
           </tr>
           <tr>
             <th height="50" style="text-align:center">상태</th>
             <td>
                <label class="radio-inline"><input type="radio" name="state" value="" checked>&nbsp;전체</label>
               &nbsp;&nbsp;&nbsp;&nbsp;<label class="radio-inline"><input type="radio" name="state" value="1">&nbsp;노출</label>
                &nbsp;&nbsp;&nbsp;&nbsp;<label class="radio-inline"><input type="radio" name="state" value="0">&nbsp;노출안함</label>
             </td>
             <th></th>
             <td></td>
           </tr>
         </tbody>
       </table>
       </form>
       <div class="text-center mt20">
         <a href="javascript:void(0)" onclick="default_list_get('1');" class="btn btn-success">검색</a>
       </div>
     </div>
   </div>
   <!-- search : e -->

  <!-- body : s -->
  <div class="bg_wh mb20">
    <div class="table-responsive">
      <div id="list_ajax">
        <!--리스트-->
      </div>
    </div>
  </div>
  <!-- body : e -->
</div>
<!-- container-fluid : e -->

<input type="text" name="page_num" id="page_num" value="1" style="display:none">

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

  // 메인 베너 리스트 가져오기
  function default_list_get(page_num){
   $('#page_num').val(page_num);

    var form_data = {
      'history_data' : window.history.length,
      'title' : $('#title').val(),
      's_date' : $('#s_date').val(),
      'e_date' : $('#e_date').val(),
      'state' : $("input[name='state']:checked").val(),
      'page_num' : page_num
    };

    $.ajax({
      url      : "/<?=mapping('banner')?>/banner_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : form_data,
      success  : function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

  // 메인 배너 상태 수정
  function banner_state_mod_up(banner_idx, state){

    var formData = {
      "banner_idx" : banner_idx,
      "state" : state
    };

    $.ajax({
      url      : "/<?=mapping('banner')?>/banner_state_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success: function(result){
        if(result.code == "0"){
          alert(result.code_msg);
        }else{
          alert(result.code_msg);
          location.reload();
        }
      }
    });
  }

</script>

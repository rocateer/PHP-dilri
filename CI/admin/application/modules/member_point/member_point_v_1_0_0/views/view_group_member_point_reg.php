<!-- container-fluid : s -->
<div class="container-fluid" style="margin:20px">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>포인트 <?=($point_type =="0")?"지급":"차감";?></h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
  	<div class="table-responsive">

    <!-- body : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">

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
            <td colspan='3'>
              <input name="s_member_point" id="s_member_point" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">&nbsp;~&nbsp;
              <input name="e_member_point" id="e_member_point" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width: 150px;">
            </td>
            
          </tr>
          

        </tbody>
      </table>
      <div class="text-center mt20">
        <a class="btn btn-success" href="javascript:void(0)" onclick="default_list_get(1);">검색</a>
      </div>
    </div>
    <!-- search : e -->

    <div class="bg_wh mb20" id="list_ajax"></div>

  </div>
  <!-- body : e -->

      <section>
        <form name="form_default" id="form_default" method="post">
          <input type="text" name="point_type" id="point_type" value="<?=$point_type?>"  style="display:none">
        	<table class="table table-bordered td_left">
            <colgroup>
          	<col style="width:15%">
          	<col style="width:35%">
          	<col style="width:15%">
          	<col style="width:35%">
            </colgroup>
        		<tbody>

              <tr>
                <th> <span class="text-danger">*</span><?=$point_type == 0 ? '지급' : '차감'?>할 포인트</th>
                <td colspan="3">
                    <input name="point" id="point" type="text" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                </td>
              </tr>

              <tr>
                <th>내역</th>
                <td colspan="3">
                    <input name="memo" id="memo" type="text" class="form-control" maxlength="100">
                </td>
              </tr>

            </tbody>
          </table>
        </form>
      </section>

      <div class="row">
        <div class="col-lg-12 text-right">
          <a href="javascript:void(0)" onclick="window.close();" class="btn btn-gray">취소</a>
          <a href="javascript:void(0)" onclick="default_reg();" class="btn btn-success">포인트 <?=$point_type == 0 ? '지급' : '차감'?></a>
        </div>
      </div>

    </div>
  </div>
  <!-- body : e -->

</div>
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
      'page_num' : page
    };

    $.ajax({
      url      : "/<?=mapping('member_point')?>/member_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

  function default_reg(){

    var formData = {
      'member_idxs' : get_checkbox_value('checkbox'),
      'point_type' : $('#point_type').val(),
      'point' : $('#point').val(),
      'memo' : $('#memo').val()
    };

    // alert(get_checkbox_value('checkbox'));
    // return;

    $.ajax({
      url      : "/<?=mapping('member_point')?>/group_member_point_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success: function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 1) {
          alert(result.code_msg);
          opener.location.reload();
          $("#form_list")[0].reset();
          // self.close();
        } else {
          alert(result.code_msg);

        }
      }
    });
  }

</script>

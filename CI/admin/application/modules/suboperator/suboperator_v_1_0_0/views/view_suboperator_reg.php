<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>관리자관리</h1>
  </div>
  <div class="bg_wh mg_btm_20">
    <div class="table-responsive">
      <form name="form_default" id="form_default" method="post">
      <table class="table table-bordered td_left">
        <colgroup>
          <col style="width:15%">
          <col style="width:35%">
          <col style="width:15%">
          <col style="width:35%">
        </colgroup>
        <tbody>
          <tr>
            <tr>
              <th><span class="text-danger">*</span> 관리자ID</th>
              <td><input class="form-control" type="text" name="admin_id"  id="admin_id" value="" autocomplete="off"></td>
							<th><span class="text-danger">*</span> 관리자명</th>
							<td><input class="form-control" type="text" name="admin_name"  id="admin_name" value="" autocomplete="off" ></td>
						</tr>
						<tr>
							<th><span class="text-danger">*</span> 전화번호</th>
							<td>
								<input class="form-control" type="text" name="admin_tel"  id="admin_tel" value="" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" autocomplete="off" >
							</td>
							<th><span class="text-danger">*</span> 비밀번호</th>
							<td>
								<input class="form-control" type="password" name="admin_pw"  id="admin_pw" value="" autocomplete="off" >
							</td>
						</tr>
						<tr>
							<th><span class="text-danger">*</span> 접근 권한</th>
							<td colspan="3">
                <?php $arr_right = array(); ?>
                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="0" <?php if(in_array('0', $arr_right)) echo 'checked'; ?>>회원관리</label>
                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="1" <?php if(in_array('1', $arr_right)) echo 'checked'; ?>>포인트 관리</label>
                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="2" <?php if(in_array('2', $arr_right)) echo 'checked'; ?>>상품관리</label>
                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="3" <?php if(in_array('3', $arr_right)) echo 'checked'; ?>>커뮤니티 관리</label></br>

                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="4" <?php if(in_array('4', $arr_right)) echo 'checked'; ?>>신고 관리</label>
                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="5" <?php if(in_array('5', $arr_right)) echo 'checked'; ?>>추천 검색어 관리</label>
                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="6" <?php if(in_array('6', $arr_right)) echo 'checked'; ?>>차단 검색어 관리</label>
                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="7" <?php if(in_array('7', $arr_right)) echo 'checked'; ?>>통계</label></br>

                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="8" <?php if(in_array('8', $arr_right)) echo 'checked'; ?>>배너관리</label>
                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="9" <?php if(in_array('9', $arr_right)) echo 'checked'; ?>>카테고리 관리</label>
                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="10" <?php if(in_array('10', $arr_right)) echo 'checked'; ?>>고객 센터</label>
                  <label class="checkbox-inline" style="width:200px"><input type="checkbox" name="_admin_right" value="11" <?php if(in_array('11', $arr_right)) echo 'checked'; ?>>약관 관리</label>
              </td>
						</tr>
        </tbody>
      </table>
      <div>
        <a href="/<?=mapping('suboperator')?>/suboperator_list" class="btn btn-gray">목록</a>
        <a href="javascript:void(0)" onclick="default_reg()" class="btn btn-success" style="float:right;">등록</a>
      </div>
    </div>
    <!-- table-responsive -->
  </div>
</div>
<!-- container-fluid : e -->
  <input type="text" name="admin_right"  id="admin_right" value="" style="display:none;">
</form>

<script>
// 관리자 관리 등록
function default_reg() {
  $("#admin_right").val(get_checkbox_value('_admin_right'));

  $.ajax({
    url: "/<?=mapping('suboperator')?>/suboperator_reg_in",
    type: 'POST',
    dataType: 'json',
    async: true,
    data: $("#form_default").serialize(),
    success: function(result) {
      if(result.code == '-1'){
   			alert(result.code_msg);
   			$("#"+result.focus_id).focus();
 			    return;
 		  }
 		  // 0:실패 1:성공
 		  if(result.code == 0) {
 			    alert(result.code_msg);
 		  } else {
   			alert(result.code_msg);
   			location.href = '/<?=mapping('suboperator')?>/suboperator_list';
 		  }
    }
  });
}
</script>

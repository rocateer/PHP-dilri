<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
	<div class="page-header">
		<h1>배너 등록</h1>
	</div>

  <!-- body : s -->
  <div class="bg_wh mt20">
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
							<th><span class="text-danger">*</span> 배너 명</th>
							<td colspan=3>
                  <input class="form-control" type="text" name="title" id="title" value="">
              </td>
						</tr>
						<tr>
							<th style="height:200px;">
								<p><span class="text-danger">*</span> 배너 이미지</p>
								<p>(690x148)</p>
								<input type="button" class="btn btn-xs btn-default" id="file1" value="파일 업로드" onclick="file_upload_click('img','image','1','150','150','.jpg ,.png');">
							</th>
							<td style="vertical-align:top;" colspan=3>
								<div class="view_img">
									<ul class="img_hz" id="img" ></ul>
								</div>
								<p>이미지의 파일 형식은 png 또는 jpg로 1장만 등록이 가능합니다.</p>
							</td>
						</tr>
            <tr>
              <th>URL</th>
              <td colspan=3><input class="form-control" name ="link_url" id ="link_url" placeholder="http://www.example.co.kr" autocomplete="off"></td>
            </tr>
            <tr>
              <th style="height:50px;">배너 위치</th>
              <td colspan="3">
								<label class="radio-inline"><input type="radio" name="banner_type" value="0" checked >&nbsp;메인</label> &nbsp;&nbsp;&nbsp;&nbsp;
								<label class="radio-inline"><input type="radio" name="banner_type" value="1">&nbsp;커뮤니티</label>
              </td>
            </tr>
					</tbody>
				</table>
      </form>
      <div>
				<a href="javascript:void(0)" onclick="default_list();" class="btn btn-gray">목록</a>
				<a href="javascript:void(0)" onclick="default_reg();" class="btn btn-success" style="float:right;">등록</a>
			</div>
    </div><!-- table-responsive -->
  </div>
  <!-- body : e -->
</div>
  <!-- container-fluid : e -->
<script>

  // 베너 등록
  function default_reg() {
    $.ajax({
      url      : "/<?=mapping('banner')?>/banner_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : $('#form_default').serialize(),
      success  : function(result) {
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
  				location.href = "/<?=mapping('banner')?>/banner_list";
  			}
      }
    });
  }

  // 뒤로가기
  function default_list(){
      location.href ="/<?=mapping('banner')?>/banner_list";
  }

</script>

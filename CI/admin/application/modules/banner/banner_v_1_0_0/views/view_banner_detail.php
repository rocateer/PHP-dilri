<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
	<div class="page-header">
		<h1>배너 상세</h1>
    <span style="line-height:35px; float:right">
      등록일시: <?=$this->global_function-> date_YmdHi_dot($result->ins_date)?>
    </span>
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
							<th><span class="text-danger">*</span> 배너 명
              </th>
							<td colspan=3>
                  <input class="form-control" type="text" name="title" id="banner_title" value="<?=$result->title?>">
              </td>
						</tr>
						<tr>
							<th style="height:200px;">
								<p><span class="text-danger">*</span> 배너 이미지</p>
								<p>(690x148)</p>
								<input type="button" class="btn btn-xs btn-default" id="file1" value="파일 업로드" onclick="file_upload_click('img','image','1','150','150','.jpg ,.png');">
							</th>
							<td style="vertical-align:top;"  colspan=3>
								<div class="view_img mg_btm_20">
									<ul class="img_hz" id="img">
										<?php if($result->img_path != ""){ ?>
											<li id="id_file_img_0" style="display:inline-block;">
												<img src="/images/btn_del.gif" style="width:15px "onclick="file_upload_remove('img_0')"/><br>
												<img src="<?=$result->img_path?>" style="width:150px">
												<input type="hidden" name="img_path[]" id="img_path[]" value="<?=$result->img_path?>"/>
											</li>
										<?php }?>
									</ul>
									<p>이미지의 파일 형식은 png 또는 jpg로 1장만 등록이 가능합니다.</p>
								</div>
							</td>
						</tr>
            <tr>
              <th>URL</th>
              <td colspan=3>
                <input class="form-control" name="link_url" id="link_url" value="<?=$result->link_url?>"  autocomplete="off">
              </td>
            </tr>
          </tbody>
				</table>
        <input type="hidden" name="banner_idx" id="banner_idx" value="<?=$result->banner_idx?>">
      </form>
      <div>
				<a href="javascript:void(0);" onclick="default_list();" class="btn btn-gray">목록</a>
        <a href="javascript:void(0);" onclick="default_mod();" class="btn btn-info" style="float:right;">수정</a>
        <a href="javascript:void(0)" onClick="banner_del('<?=$result->banner_idx?>')" class="btn btn-danger" style="float:right;">삭제</a>
			</div>
    </div>
  </div>
  <!-- body : e -->
</div>
  <!-- container-fluid : e -->
<script>

	// 배너 목록
	function default_list(){
		history.back(<?=$history_data?>);
	}
	
  // 배너 수정
  function default_mod(){

    $.ajax({
      url      : "/<?=mapping('banner')?>/banner_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : $('#form_default').serialize(),
      success  : function(result){
        if(result.code == "-1"){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert("수정이 실패하였습니다.");
        } else {
          alert("수정되었습니다.");
          default_list();
        }
      }
    });
  }

  // 베너 삭제
  function banner_del(banner_idx){

		if(!confirm("삭제하시겠습니까?")){
    return;
  	}

    $.ajax({
      url      : "/<?=mapping('banner')?>/banner_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {"banner_idx" : banner_idx},
      success: function(result) {
        if(result.code == '-1') {
          alert(result.code_msg);
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert("삭제가 실패하였습니다.");
        } else {
          alert("삭제되었습니다.");
          default_list();
        }
      }
    });
  }

</script>

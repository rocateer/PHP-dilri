
<div >
  <div class="body">
    
    <div class="table-responsive">
    
      <div class="row table_title">
        <div class="col-lg-12"><strong class="h1">업로드 </strong></div>
        <div class="col-lg-6 text-left" style="margin-bottom:10px">
          
        </div>
        <div class="col-lg-6 text-left" style="margin-bottom:10px">
          <input name="member_id" id="member_id" value="<?=$orig_name?>" readonly style="width:65%">
          <a href="javascript:void(0);" class="btn btn-info" onclick="$('#file').click();">파일 선택</a>
          <a href="javascript:void(0);" class="btn btn-info" onclick="sample_download();">샘플 다운로드</a>
        </div>
      </div>
      <div class="" id="temp_list_ajax"  style="height:500px;overflow-y:scroll">
        <table class="table table-bordered" >
          <thead>
            <tr>
              <th width="50">No</th>
              <th width="*">금지어</th>
            </tr>
          </thead>
          <tbody>
            
						<?php
				      if(!empty($result_list)){
				        foreach($result_list as $row){
				    ?>
				      <tr>
				        <td>
				          <?=$no--?>
				        </td>
				        <td>
				          <?=$row->title ?>
				        </td>
				      </tr>
				    <?php
				        }
				      }else{
				    ?>
				    <tr>
				      <td colspan="15">
				        <?=no_contents('0')?>
				      </td>
				    </tr>
				    <?php } ?>
    
          </tbody>
        </table>  
      </div>
          
        <div class="text-right" style="float:right;margin-top:20px">
          <a class="btn btn-gray" href="javascript:void(0)" onclick="self.close();">취소</a>
          <a class="btn btn-success" href="javascript:void(0)" onclick="real_data_reg_in();">데이터 업로드</a>
        </div>
        
        
    </div>
	</div>
  <form name="form_file" id="form_file" method="post" enctype="multipart/form-data" style="">
    <input type="hidden" name="upload_data_type" id="upload_data_type" value="<?=$upload_data_type?>"/>
		<input type="text" name="keycode" id="keycode" value="<?=$keycode?>"  style="display:none">
		<input type="file" name="file" id="file" value="데이터 업로드" onchange="excelUpload();" style="display:none"  />
  </form>
</div>

<script language="javascript">
$(document).ready(function(){
	
  setTimeout("temp_data_list_get('<?=$keycode?>')", 100);
});

var excelUpload=function(){
	document.form_file.action="./data_excel_upload_action";
	document.form_file.submit();
}


function temp_data_list_get(keycode){
  $('#keycode').val(keycode);

  var form_data = {
    'keycode' : '<?=$keycode?>',
  };

  $.ajax({
    url      : "/<?=mapping('forbidden_search')?>/temp_data_list_get",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : form_data,
    success  : function(result) {
      $('#temp_list_ajax').html(result);
    }
  });
}


//실제등록
function real_data_reg_in(){
  if($('#keycode').val() ==""){
    alert("엑셀업로드 이후 실행하세요!!");
    return;
  }

  if(!confirm("데이터를 등록하시겠습니까?")){
    return;
  }

  var form_data = {
      'keycode' : $('#keycode').val(),
  };

	 $.ajax({
    url      : "/<?=mapping('forbidden_search')?>/real_data_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data: form_data,
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
				opener.default_list_get('1');
				self.close();
 		  }
    }
  });

}


//데이타 업로드
function sample_download() {
  location.href="/media/excel/sample.xlsx";
}

</script>



<script language="javascript">
temp_data_list_get('<?=$keycode?>');
	// opener.fileUpload_success('<?=$orig_name?>','<?=$keycode?>','<?=$upload_data_type?>','<?=$result?>');
	// self.close();
</script>

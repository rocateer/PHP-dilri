
<div class="container-fluid">
  <div class="body">

    <div class="title">
      <strong class="h1">데이타 업로드 </strong>
    </div>
		<p></p>
	</div>
	<form name="form_file" id="form_file" method="post" enctype="multipart/form-data">
	  <input type="hidden" name="upload_data_type" id="upload_data_type" value="<?=$upload_data_type?>"/>
	  <input type="file" name="file" id="file" value="file" onchange="excelUpload();"/>
	</form>
</div>

<script language="javascript">
var excelUpload=function(){
	document.form_file.action="./data_excel_upload_action";
	document.form_file.submit();
}
</script>

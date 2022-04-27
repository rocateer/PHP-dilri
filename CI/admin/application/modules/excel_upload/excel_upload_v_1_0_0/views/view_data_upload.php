  <!-- container-fluid : s -->
  <div class="container-fluid wide">
    <!-- Page Heading -->
    <div class="page-header">
      <h1>파일 업로드</h1>
    </div>
    <div class="bg_wh table-responsive">


      <input type="button" class="btn btn-m btn-success f_right" id="" value="샘플다운로드" onclick="sample_download();">
      <input type="button" class="btn btn-m btn-success f_right" id="" value="엑셀업로드" onclick="file_upload('0');">
      <!-- <input type="button" class="btn btn-m btn-success f_right" id="" value="직접::엑셀업로드" onclick="file_upload('1');"> -->
      <p class="status_annot" id="error_msg" ></p>
      <!-- form : s -->
        <div id="list_ajax">
        <table class="table table-bordered wide">
          <thead>
            <tr>
              <th width="80">No</th>
              <th width="*">도서명</th>
              <th width="150">장르</th>
              <th width="120">출판사명</th>
              <th width="120">저자명</th>
              <th width="120">ISBN</th>
            </tr>
          </thead>
         <tbody>
         </tbody>
        </table>
        </div>
      <!-- form : e -->
      <div class="text-right">
        <a href="/<?=mapping('book')?>/" class="btn btn-gray">목록</a>
        <a href="javascript:void(0)" class="btn btn-danger"  id="reg_btn"  onclick="real_data_reg_in();">데이타업로드</a>
      </div>
    </div>
  </div>
  <!-- container-fluid : e -->

<input type="text" name="keycode" id="keycode" value=""  style="display:none1">
<script>

//데이타 업로드
function sample_download() {
  location.href="/media/excel/sample.xlsx";
}
//데이타 업로드
function file_upload(upload_data_type) {
  openWin = window.open("/<?=mapping('excel_upload')?>/data_excel_fileUpload?upload_data_type="+upload_data_type,"CLIENT_WINDOW", "width=500, height=100, resizable = no, scrollbars = no");
}

//리스트
function fileUpload_success(ori_filename,keycode,upload_data_type,result){
  if(upload_data_type =="0"){
    default_list_get(keycode);
  }else{
    alert("정상적으로 등록되었습니다.");
  }
}

function default_list_get(keycode){
  $('#keycode').val(keycode);

  var form_data = {
    'keycode' : keycode,
  };

  $.ajax({
    url      : "/<?=mapping('excel_upload')?>/temp_data_list_get",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : form_data,
    success  : function(result) {
      $('#list_ajax').html(result);
    }
  });
}

//default_list_get('1585891477');


//실제등록
function real_data_reg_in(){
  if($('#keycode').val() ==""){
    alert("엑셀업로드이후 실행하세요!!");
    return;
  }

  if(!confirm("데이타를 등록하시겠습니까?")){
    return;
  }

  var form_data = {
      'keycode' : $('#keycode').val(),
  };

	 $.ajax({
    url      : "/<?=mapping('excel_upload')?>/real_data_reg_in",
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
   			location.reload();
 		  }
    }
  });

}

</script>

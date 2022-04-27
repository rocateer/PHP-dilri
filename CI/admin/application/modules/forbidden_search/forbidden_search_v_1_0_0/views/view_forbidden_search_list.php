<!-- container-fluid : s -->
<div class="container-fluid" style="width:500px">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>금지어 설정</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">

    <div class="bg_wh mb20" id="list_ajax"></div>

  </div>
  <!-- body : e -->

</div>
<!-- container-fluid : e -->
<input type="text" name="keycode" id="keycode" value=""  style="display:none">
<input type="text" name="page_num" id="page_num" value="1" style="display:none">
<script>

$(document).ready(function(){
  setTimeout("default_list_get($('#page_num').val())", 10);
});

// 공지사항 리스트 가져오기
function default_list_get(page_num){
 $('#page_num').val(page_num);
 
  var formData = {
    'history_data' : window.history.length,
    'page_num' : page_num
  };

  $.ajax({
    url      : "/<?=mapping('forbidden_search')?>/forbidden_search_list_get",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : formData,
    success: function(result) {
      $('#list_ajax').html(result);
    }
  });
}

// 공지사항 상태 수정
function forbidden_search_state_mod_up(forbidden_search_idx, forbidden_search_state){

  var formData = {
    "forbidden_search_idx" : forbidden_search_idx,
    "forbidden_search_state" : forbidden_search_state
  };

  $.ajax({
    url      : "/<?=mapping('forbidden_search')?>/forbidden_search_state_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        alert(result.code_msg);
        default_list_get($('#page_num').val());
      }
    }
  });
}
  
// 업로드
function file_upload() {
  openWin = window.open("/<?=mapping('forbidden_search')?>/data_excel_fileUpload?upload_data_type=0","CLIENT_WINDOW", "width=700, height=700, resizable = no, scrollbars = no");
}

//리스트
function fileUpload_success(ori_filename,keycode,upload_data_type,result){
  if(upload_data_type =="0"){
    temp_data_list_get(keycode);
  }else{
    alert("정상적으로 등록되었습니다.");
  }
}


function temp_data_list_get(keycode){
  $('#keycode').val(keycode);

  var form_data = {
    'keycode' : keycode,
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
   			location.reload();
 		  }
    }
  });

}


//데이타 업로드
function sample_download() {
  location.href="/media/excel/sample.xlsx";
}

</script>

<!-- container-fluid : s -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="page-header">
		<h1>1:1 문의 관리</h1>
	</div>

  <!-- body : s -->
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
              <th style="text-align:center">이름</th>
                <td>
                  <input name="member_name" id="member_name" class="form-control" style="width:100%" placeholder="">
                </td>
              <th style="text-align:center">문의일</th>
                <td>
                  <input name="s_date" id="s_date" class="form-control" style="width:43%" placeholder="" autocomplete="off" >&nbsp;<i class="fa fa-calendar-o"></i>&nbsp;~&nbsp;
                  <input name="e_date" id="e_date" class="form-control" style="width:43%" placeholder="" autocomplete="off" >&nbsp;<i class="fa fa-calendar-o"></i>
                </td>
            </tr>
            <tr>
              <th style="text-align:center">아이디</th>
              <td>
                <input name="member_id" id="member_id" class="form-control" style="width:100%" placeholder="">
              </td>
              <th style="text-align:center">답변 상태</th>
              <td>
                <input type="radio" name="reply_yn" id="reply_yn_1" checked value=""> 전체 &nbsp;
                <input type="radio" name="reply_yn" id="reply_yn_2" value="Y"> 답변완료 &nbsp;
                <input type="radio" name="reply_yn" id="reply_yn_3" value="N"> 답변안함
              </td>
            </tr>
						<tr>
              <th style="text-align:center">문의 유형</th>
              <td class="check_wrap" colspan="3">
								<div>
									&nbsp;<label class="checkbox-inline" style="width:200px"> <input type="checkbox" name="qa_type_all" value="" class="all_check"> 전체</label>
									<?for($i=1;$i<12;$i++){?>
										<label class="checkbox-inline" style="width:200px"> <input type="checkbox" name="qa_type" value="<?=$i?>" class="checkbox"><?=$this->global_function->get_qa_type($i)?></label>
										<?}?>
								</div>
              </td>
            </tr>
    			</tbody>
    		</table>
      </form>

  		<div class="text-center mt20">
  			<a href="javascript:void(0)" class="btn btn-success" onclick="default_list_get(1);">검색</a>
  		</div>

  	</div>
    <!-- search : e -->

  	<div class="table-responsive">
      <div id="list_ajax"></div>
  	</div>
  </div>
  <!-- body : e -->
</div>

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
		checkall_func('qa_type_all', 'qa_type'); // 체크박스 전체 선택
	});

	// qa 리스트 가져오기
  function default_list_get(page_num){
    $('#page_num').val(page_num);

		var form_data = {
			'history_data' : window.history.length,
			's_date' : $('#s_date').val(),
			'e_date' : $('#e_date').val(),
			'member_name' : $('#member_name').val(),
			'member_id' : $('#member_id').val(),
			'qa_type' :  get_checkbox_value('qa_type'),
			'reply_yn' :  $("input[name='reply_yn']:checked").val(),
			'page_num' : page_num
		};

    $.ajax({
      url      : "/<?=mapping('qa')?>/qa_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : form_data,
      success: function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

</script>

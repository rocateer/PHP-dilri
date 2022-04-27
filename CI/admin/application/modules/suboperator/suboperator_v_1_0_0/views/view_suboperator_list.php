  <!-- container-fluid : s -->
  <div class="container-fluid">
    <!-- Page Heading -->
		<div class="page-header">
			<h1>관리자 관리</h1>
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
              <th style="text-align:center;">관리자명</th>
              <td>
                <input name="admin_name" id="admin_name" class="form-control" autocomplete="off" >
              </td>
              <th style="text-align:center;">관리자 ID</th>
              <td>
                <input name="admin_id" id="admin_id" class="form-control" autocomplete="off" >
              </td>
            </tr>
          </tbody>
        </table>
        </form>
        <div class="text-center mt20">
          <a class="btn btn-success" href="javascript:void(0)" onclick="default_list_get(1);">검색</a>
        </div>
      </div>

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

  $(document).ready(function(){
    setTimeout("default_list_get($('#page_num').val())", 10);
  });

  // 관리자 관리 리스트 가져오기
  var default_list_get = function(page_num) {
    $('#page_num').val(page_num);

    var form_data = {
    'history_data' : window.history.length,
    'admin_name' : $('#admin_name').val(),
    'admin_id' : $('#admin_id').val(),
    'page_num' : page_num
    };

    $.ajax({
      url: "/<?=mapping('suboperator')?>/suboperator_list_get",
      type: 'POST',
      dataType: 'html',
      async: true,
      data: form_data,
      success: function(dom) {
        $('#list_ajax').html(dom);
      }
    });
  }

</script>

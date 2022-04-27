<!-- container-fluid : s -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>커뮤니티 관리 상세</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <div class="row table_title"><div class="col-lg-12"> <span class="f_right">등록일시 : <?= date('Y-m-d H:i',strtotime($result->ins_date)) ?></span></div></div>
      <section>
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
                <th> 이름</th>
                <td ><?=$result->member_name?></td>
                <th> 신고 수</th>
                <td ><?=$result->report_cnt?></td>
              </tr>
              <tr>
                <th> 상태</th>
                <td ><?php echo $result->display_yn == "Y"? "게시중":"블라인드"; ?></td>
                <th> 댓글 & 답글 수</th>
                <td ><?=$result->reply_cnt?></td>
              </tr>
              <tr>
                <th> 추천수</th>
                <td ><?=$result->recommend_cnt?></td>
                <th>스크랩수</th>
                <td ><?=$result->scrap_cnt?></td>
              </tr>
              <tr>
                <th> 조회수</th>
                <td colspan="3" ><?=$result->view_cnt?></td>
              </tr>
              <tr>
                <th>사진</th>
                <td colspan="3">
                  <div>
                    <ul class="img_hz" id="img">
                      <?php if($result->img_path != ""){ ?>
                        <?
                        $img_arr = explode(',', $result->img_path);
                        foreach ($img_arr as $row) {?>
                          <li  style="display:inline-block;">
                            <img src="<?=$row?>" style="width:150px">
                          </li>
                        <?}?>
                      <?php } ?>
                    </ul>
                  </div>
                </td>
              </tr>
              <tr>
                <th> 내용</th>
                <td colspan="3" style="height:200px;"><?=nl2br($result->contents)?></td>
              </tr>
              <tr>
                <th> 해시태그</th>
                <td colspan="3">
                  <?=str_replace(',', ', ', $result->tags)?>
                </td>
              </tr>
              <tr>
                <th colspan="4">댓글 & 답글</th>
              </tr>
              <tr>
                <td colspan="4" >
                  <table class="table table-bordered td_left">
                    <colgroup>
                      <col style="width:15%">
                      <col style="width:35%">
                      <col style="width:15%">
                      <col style="width:35%">
                    </colgroup>
                    <tbody>
                      <tr>
                        <th> 이름</th>
                        <td ><input name="member_name" id="member_name" class="form-control"></td>
                        <th> 정렬순서</th>
                        <td >
                          <select class="form-control" style="width:220px" id="orderby" name="orderby" >
                            <option value="0">신고수 내림차순</option>
                            <option value="1">신고수 올림차순</option>
                            <option value="2">등록일자 내림차순</option>
                            <option value="3">등록일자 올림차순</option>
                         </select>
                       </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="text-center mt20">
                    <a class="btn btn-success" href="javascript:void(0)" onclick="reply_list_get(1);">검색</a>
                  </div>
                  <div class="text-center mt20">

                  </div>

                  <div class="bg_wh mb20" id="reply_ajax">  <div>

                </td>
              </tr>
            </tbody>
          </table>
          <input type="hidden" name="board_idx" id="board_idx" value="<?=$result->board_idx?>">
        </form>
      </section>

      <div class="text-right" style="float:right;">
        <a class="btn btn-gray" href="javascript:void(0)" onclick="default_list();">목록</a>
        <a class="btn btn-info" href="javascript:void(0)" onclick="board_display_yn_mod_up('<?=$result->board_idx?>', '<?php echo $result->display_yn == "Y"? "N":"Y"; ?>')"><?php echo $result->display_yn == "Y"? "블라인드":"블라인드 해제"; ?></a>
      </div>

    </div>
  </div>
  <!-- body : e -->
</div>
<!-- container-fluid : e -->
<input type="hidden" name="page_num" id="page_num" value="1">
<script>

reply_list_get(1);

window.addEventListener('keydown', function(event){
  if (window.event.keyCode == 13) {
    // 엔터키가 눌렸을 때 실행할 내용
    event.preventDefault();
    reply_list_get(1);
  }
})

function reply_list_get(page){

  var formData = {
    'board_idx' :  $('#board_idx').val(),
    'orderby' :  $('#orderby').val(),
    'member_name' :  $('#member_name').val(),
    'page_num' : page
  };

  $.ajax({
    url      : "/<?=mapping('board')?>/reply_list_get",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : formData,
    success: function(result) {
      $('#reply_ajax').html(result);
    }
  });
}

function board_display_yn_mod_up(board_idx, display_yn){

  var formData = {
    "board_idx" : board_idx,
    "display_yn" : display_yn
  };

  $.ajax({
    url      : "/<?=mapping('board')?>/board_display_yn_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        alert(result.code_msg);
        default_list();
      }
    }
  });
}

function default_list(){
  history.back(<?=$history_data?>);
}
</script>

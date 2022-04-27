
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50">No</th>
          <th width="100">작성자 닉네임</th>
          <th width="*">내용</th>
          <th width="100">종류</th>
          <th width="100">원 댓글 작성자</th>
          <th width="100">신고수</th>
          <th width="150">등록일시</th>
          <th width="150">상태</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($result_list)){
            foreach($result_list as $row){
        ?>
          <tr>
            <td><?=$no--?></td>
            <td><?=$row->member_name?></td>
            <td><?=$row->reply_comment?></td>
            <td><?php echo $row->depth == 0? "댓글":"답글"; ?></td>
            <td><?=$row->parent_member_name?></td>
            <td><?=$row->report_cnt?></td>
            <td><?=$row->ins_date?></td>
            <td>
              <a class="btn btn-success" href="javascript:void(0)" onclick="display_yn_mod_up('<?=$row->board_reply_idx?>', '<?php echo $row->display_yn == "Y"? "N":"Y"; ?>');"><?php echo $row->display_yn == "Y"? "블라인드":"블라인드 해제"; ?></a>
            </td>
          </tr>
        <?php
            }
          }else{
        ?>
        <tr>
          <td colspan="9">
            <?=no_contents('0')?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

	<?=$paging?>

<input type="hidden" name="page_num" id="page_num" value="<?=$page_num ?>">

<script type="text/javascript">

// 댓글 노출여부 상태 수정
function display_yn_mod_up(board_reply_idx, display_yn){

  var page_num = $('#page_num').val();

  var formData = {
    "board_reply_idx" : board_reply_idx,
    "display_yn" : display_yn
  };

  $.ajax({
    url      : "/<?=mapping('board')?>/display_yn_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        alert(result.code_msg);
        reply_list_get(page_num);
      }
    }
  });
}


</script>

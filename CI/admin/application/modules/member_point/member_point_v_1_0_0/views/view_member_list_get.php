<div class="table-responsive">

  <div class="row table_title">
    <div class="col-lg-6">&nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
    <div class="col-lg-6 text-right"> &nbsp;
      <!-- <a class="btn btn-success" href="javascript:void(0)" onClick="do_excel_down()">엑셀 다운로드</a> -->
    </div>
  </div>

  

  <form name="form_list" id="form_list" method="post">  
  <table class="table table-bordered">
    <thead>
      <tr>
        <th width="50"><input type="checkbox" name="checkAll" ></th>
        <th width="50">No</th>
        <th width="*">아이디(이메일)</th>
        <th width="100">이름</th>
        <th width="120">가입일</th>
        <th width="100">잔여 포인트</th>
        <th width="120">탈퇴일</th>
        <th width="100">회원 상태</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(!empty($result_list)){
          foreach($result_list as $row){
      ?>
        <tr>
          <td>

            <input type="checkbox"  name="checkbox" value="<?=$row->member_idx?>">
          </td>
          <td><?=$no--?></td>
          <td><?=$row->member_id?></td>
          <td><?=$row->member_name?></td>
          <td><?=$row->ins_date?></td>
          <td><?=number_format($row->member_point)?> p</td>
          <td>
            <? if(!empty($row->member_leave_date)){?>
              <?=$row->member_leave_date?>
            <?} ?>
          </td>
          <td>
            <?switch($row->del_yn){
              case 'N': echo "이용중"; break;
              case 'P': echo "이용정지"; break;
              case 'Y': echo "탈퇴"; break;
            }?>
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
  </form>
	<?=$paging?>
</div>

<script>

checkall_func('checkAll', 'checkbox');

</script>

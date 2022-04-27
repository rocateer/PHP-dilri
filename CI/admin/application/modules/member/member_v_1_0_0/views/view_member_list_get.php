<div class="table-responsive">

  <div class="row table_title">
    <div class="col-lg-6">&nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
    <div class="col-lg-6 text-right"> &nbsp;
      <a class="btn btn-success" href="javascript:void(0)" onClick="do_excel_down()">엑셀 다운로드</a>
    </div>
  </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50">No</th>
          <th width="*">아이디(이메일)</th>
          <th width="100">이름</th>
          <th width="120">가입일</th>
          <th width="100">잔여 포인트</th>
          <th width="100">거래글 등록 수</th>
          <th width="140">무료 나눔 완료 수</th>
          <th width="140">좋음 평가 수</th>
          <th width="140">나쁨 평가 수</th>
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
            <td><?=$no--?></td>
            <td>
            <a href="/<?=mapping('member')?>/member_detail?member_idx=<?=$row->member_idx?>&history_data=<?=$history_data?>"><?=$row->member_id?></a>
            </td>
            <td><?=$row->member_name?></td>
            <td><?=$row->ins_date?></td>
            <td><?=number_format($row->member_point)?> p</td>
            <td><?=number_format($row->product_cnt)?></td>
            <td><?=number_format($row->free_product_cnt)?></td>
            <td><?=number_format($row->good_product_cnt)?></td>
            <td><?=number_format($row->bad_product_cnt)?></td>
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
	<?=$paging?>
</div>

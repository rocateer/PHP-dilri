<div class="table-responsive">

  <div class="row table_title">
    <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
  </div>

  <form name="form_default" id="form_default" method="post">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50">No</th>
          <th width="100">신고 한<br />회원 이름</th>
          <th width="100">신고 한<br />회원 아이디</th>
          <th width="100">신고 받은<br />회원 이름</th>
          <th width="100">신고 받은<br />회원 아이디</th>
          <th width="100">신고 대상 게시글</th>
          <th width="*">신고 사유</th>
          <th width="100">신고일</th>
          <th width="100">게시 상태</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($result_list)){
            foreach($result_list as $row){
          		switch ($row->report_type) {
          			case '0' : $report_type ='욕설 및 비방글'; break;
                case '1' : $report_type='음란성 글'; break;
          			case '2' : $report_type='기타 비매너'; break;
          			}
        ?>
          <tr>
            <td><?=$no--?></td>
            <td><?=$row->member_name?></td>
            <td><?=$row->member_id?></td>
            <td><a href="/<?=mapping('member')?>/member_detail?member_idx=<?=$row->reported_member_idx?>&history_data=<?=$history_data?>"> <?=$row->reported_member_name?></a>
            </td>
            <td><?=$row->reported_member_id?></td>
            <td>
              <button type="button" class="btn btn-primary" onclick="location.href='/<?=mapping('board')?>/board_detail?board_idx=<?=$row->board_idx?>' ">원글 보기</button>
            </td>
            <td><?=$row->report_contents?></td>
            <td><?=$this->global_function->date_Ymd_hyphen($row->ins_date)?></td>
            <td><?=($row->display_yn=='Y')?'게시중':'블라인드'?></td>
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
  </form>
	<?=$paging?>
</div>

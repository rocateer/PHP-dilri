<div class="table-responsive">
<div class="row table_title">
  <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=number_format($result_list_count)?></strong> 건</div>
</div>

<!-- top  -->
<form name="checkedBox" id="checkedBox" method="post">
  <table class="table table-bordered check_wrap">
    <thead>
      <tr>
        <th width="50">No</th>
        <th width="150">아이디</th>
        <th width="100">이름</th>
        <th width="*">제목</th>
        <th width="200">문의 유형</th>
        <th width="100">답변 상태</th>
        <th width="100">관리자 확인 여부</th>
        <th width="150">문의일</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(!empty($result_list)){
          foreach($result_list as $row){
            
            switch ($row->qa_type) {
              case '1' : $qa_type ='거래환불/분쟁 및 사기신고'; break;
              case '2' : $qa_type='계정 문의'; break;
              case '3' : $qa_type='판매 금지/거래 품목 문의'; break;
              case '4' : $qa_type='거래 평가 항목 관련 문의'; break;
              case '5' : $qa_type='게시글 노출, 미노출 문의'; break;
              case '6' : $qa_type='채팅, 알림'; break;
              case '7' : $qa_type='앱 사용/거래 방법 문의'; break;
              case '8' : $qa_type='커뮤니티 문의'; break;
              case '9' : $qa_type='검색 문의'; break;
              case '10' : $qa_type='기타 문의'; break;
              case '11' : $qa_type='오류 제보'; break;
              default : $qa_type=''; break;	
            }
      ?>
        <tr>
          <td>
            <?=$no--?>
          </td>
          <td>
            <?=$row->member_id?>
          </td>
          <td>
            <?=$row->member_name?>
          </td>
          <td>
            <a href="/<?=mapping('qa')?>/qa_detail?qa_idx=<?=$row->qa_idx?>&history_data=<?=$history_data?>"><?=$row->qa_title?></a>
          </td>
          <td>
            <?=$qa_type;?>
          </td>
          <td>
            <?=($row->reply_yn == "Y")? "<span class='state_02'>답변완료</span>": "<span class='state_01'>미답변</span>";?>
          </td>
          <td>
            <?=($row->check_yn == "Y")? "<span class='state_02'>확인완료</span>": "<span class='state_01'>미확인</span>";?>
          </td>
          <td>
            <?=$this->global_function->date_YmdHi_hyphen($row->ins_date)?>
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

      <?php
        }
      ?>

    </tbody>
  </table>
</form>

<?=$paging?>
</div>
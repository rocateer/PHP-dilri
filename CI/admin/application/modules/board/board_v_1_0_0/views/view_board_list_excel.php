<?php
  $filename="커뮤니티 관리_".date('Ymd');
	header( "Content-type: application/vnd.ms-excel; charset=utf-8" );
	header( "Expires: 0" );
	header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
	header( "Pragma: public" );
	header( "Content-Disposition: attachment; filename=$filename.xls" );
?>

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<table class="table table-bordered">
	<thead>
    <tr>
      <th width="50">No</th>
      <th width="100">이름</th>
      <!-- <th width="100">카테고리</th> -->
      <th width="*">내용</th>
      <!-- <th width="150">주제</th> -->
      <th width="60">추천수</th>
      <th width="60">스크랩수</th>
      <th width="60">조회수</th>
      <th width="60">신고수</th>
      <th width="60">댓글 &<br>답글수</th>
      <th width="100">BEST설정</th>
      <th width="80">상태</th>
      <th width="150">등록일시</th>
    </tr>
	</thead>
	<tbody>
    <?php
			if(!empty($result_list)){
    		foreach ($result_list as $row){
    ?>
    <tr>
      <td><?=$no--?></td>
      <td><?=$row->member_name?></td>
      <!-- <td>카테고리 ----</td> -->
      <td ><?=$row->contents?></td>
      <!-- <td>주제--</td> -->
      <td><?=$row->recommend_cnt?></td>
      <td><?=$row->scrap_cnt?></td>
      <td><?=$row->view_cnt?></td>
      <td><?=$row->report_cnt?></td>
      <td><?=$row->reply_cnt?></td>
      <td>
        <?php if($row->best_yn == "N"){ ?>
          베스트 외
        <?php }else if($row->best_yn == "Y"){ ?>
          베스트
        <?php } ?>
      </td>
      <td><?php if($row->display_yn == 'Y'){echo "게시중";} elseif($row->display_yn == 'N'){echo "블라인드";}?></td>
      <td><?=$row->ins_date?></td>
    </tr>
		<?php
		    }
			}
		?>
	</tbody>
</table>

<?php
  $filename="상품관리_".date('Ymd');
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
      <th >No</th>
      <th >사용자 ID</th>
      <th >사용자 이름</th>
      <th >제목</th>
      <th >구매 대상자 ID</th>
      <th >구매 대상자 이름</th>
      <th >해시태그</th>
      <th >신고수</th>
      <th >무료나눔</th>
      <th >금액</th>
      <th >거래 상태</th>
      <th >인기상품 설정</th>
      <th >게시상태</th>
      <th >등록일시</th>
    </tr>
	</thead>
	<tbody>
    <?php
			if(!empty($result_list)){
    		foreach ($result_list as $row){
    ?>
          <tr>
            <td><?=$no--?></td>
            <td><?=$row->member_id?></td>
            <td><?=$row->member_name?></td>
            <td><?=$row->title?></td>
            <td><?=$row->partner_member_id?></td>
            <td><?=$row->partner_member_name?></td>
            <td><?=$row->tags?></td>
            <td><?=$row->report_cnt?></td>
            <td><?php if($row->free_product_yn == 'Y'){echo "무료나눔";} elseif($row->free_product_yn == 'N'){echo "-";}?></td>
            <td><?=number_format($row->product_price)?></td>
            <td><?=$this->global_function->get_product_state($row->product_state)?></td>
            <td><?php if($row->famous_product_yn == 'Y'){echo "TRUE";} elseif($row->free_product_yn == 'N'){echo "FALSE";}?></td>
            <td><?php if($row->display_yn == 'Y'){echo "게시중";} elseif($row->display_yn == 'N'){echo "블라인드";}?></td>
            <td><?=$row->ins_date?></td>
          </tr>
		<?php
		    }
			}
		?>
	</tbody>
</table>

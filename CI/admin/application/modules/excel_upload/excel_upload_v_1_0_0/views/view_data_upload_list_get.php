<table class="table table-bordered wide">
  <thead>
    <tr>
      <th width="80">No</th>
      <th width="*">도서명</th>
      <th width="150">장르</th>
      <th width="120">출판사명</th>
      <th width="120">저자명</th>
      <th width="120">ISBN</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $error_cnt =0;
      if(!empty($result_list)){
      foreach($result_list as $row){
        $td_error ="";
        // if($row->excel_idx>0 &&  $row->barcode_scan_date ==""){
        //   $error_cnt++;
        //   $td_error ="<span class='text-danger'>중복데이타</span>";
        // }
    ?>
    <tr>
      <td><?=$no--?></td>
      <td><?=$row->item_0?></td>
      <td><?=$row->item_3?></td>
      <td><?=$row->item_0?></td>
      <td><?=$row->item_0?></td>
      <td><?=$row->item_0?></td>
    </tr>
    <?php
          }
        }else{
      ?>
      <tr>
        <td colspan="25">
          <?=no_contents('0')?>
        </td>
      </tr>

      <?php
        }
      ?>
  </tbody>
</table>

<script>
<?if($error_cnt>0){?>
  $('#error_msg').html('이미 등록된 데이터를 발견 하였습니다.중복 데이터를 확인 후 다시 파일을 선택 해 주세요.');
  $('#reg_btn').css("display","none");
<?}?>
</script>

<div class="table-responsive">

  <div class="row table_title">
  </div>

  <form name="form_default" id="form_default" method="post">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50">No</th>
          <th width="*">카테고리명</th>
          <th width="150">터치 횟수</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($result_list)){
            foreach($result_list as $row){
        ?>
        <tr>
          <td>
            <?=$no--?>
          </td>
          <td>
            <?=$row->title?>
          </td>
          <td>
            <?=number_format($row->category_cnt)?>
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

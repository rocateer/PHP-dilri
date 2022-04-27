<div class="table-responsive">

  <div class="row table_title">
    <div class="col-lg-12"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
    <div class="col-lg-6 text-right" style="margin-bottom:10px">
    </div>
    <div class="col-lg-6 text-right" style="margin-bottom:10px">
      <a href="javascript:void(0);" class="btn btn-info" onclick="file_upload();">엑셀 업로드</a>
    </div>
  </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50">No</th>
          <th width="*">금지어</th>
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
              <?=$row->title ?>
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

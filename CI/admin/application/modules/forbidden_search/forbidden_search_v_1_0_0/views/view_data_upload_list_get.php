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
          <?=$row->item_0 ?>
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


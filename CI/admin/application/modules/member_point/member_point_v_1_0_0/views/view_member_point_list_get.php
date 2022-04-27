<div class="table-responsive">

  <div class="row table_title">
    <div class="col-lg-6"></div>
    <div class="col-lg-6 text-right"> &nbsp;
      <a class="btn btn-success" href="javascript:void(0)" onClick="member_point_reg('1')">포인트 차감</a>
      <a class="btn btn-success" href="javascript:void(0)" onClick="member_point_reg('0')">포인트 지급</a>
      <a class="btn btn-success" href="javascript:void(0)" onClick="group_member_point_reg('1')">단체 포인트 차감</a>
      <a class="btn btn-success" href="javascript:void(0)" onClick="group_member_point_reg('0')">단체 포인트 지급</a>
    </div>
  </div>

  <form name="form_default" id="form_default" method="post">
    <table class="table table-bordered">
      <thead>
        <tr>
          <!-- <th width="50"><input type="checkbox" onclick="chkBox(this.checked)"></th> -->

          <th width="50">No</th>
          <th width="150">아이디</th>
          <th width="120">이름</th>
          <th width="120">구분</th>
          <th width="100">포인트 개수</th>
          <th width="*">내역</th>
          <th width="150">일자</th>

        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($result_list)){
            foreach($result_list as $row){
             switch($row->point_type){
               case "0" : $point_type="지급";break;
               case "1" : $point_type="차감";break;
               case "2" : $point_type="사용";break;
             }
        ?>

          <tr>
            <!-- <input type="checkbox"  name="checkbox" value=""> -->
            <td>
              <?=$no--?>
            </td>

            <td><?=$row->member_id?></td>
            <td><?=$row->member_name?></td>
            <td><?=$point_type?></td>
            <td><?=number_format($row->point)?> 개</td>
            <td><?=$row->memo?></td>
            <td><?=$this->global_function->date_YmdHi_Hyphen($row->ins_date)?></td>

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

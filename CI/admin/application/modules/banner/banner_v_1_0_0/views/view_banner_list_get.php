<div class="row table_title">
  <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
  <div  class="col-lg-6 text-right">&nbsp;<a href="/<?=mapping('banner')?>/banner_reg" class="btn btn-success">등록</a></div>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th width="50">No</th>
      <th width="*">배너명</th>
      <th width="150">배너위치</th>
      <th width="150">상태</th>
      <th width="150">등록일</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(!empty($result_list)){
			  foreach($result_list as $row ){
    ?>
    <tr>
      <td>
        <?=$no--?>
      </td>
      <td>
        <a href="/<?=mapping('banner')?>/banner_detail?banner_idx=<?=$row->banner_idx?>&history_data=<?=$history_data?>"><?=$row->title?></a>
      </td>
      <td>
        <?=($row->banner_type == "0")? "메인":"커뮤니티"; ?>
      </td>
      <td>
        <?php if($row->state == "0"){ ?>
          노출 안함  <label  class="switch">
            <input type="checkbox" onchange="banner_state_mod_up(<?=$row->banner_idx?>, '1');">
            <span class="check_slider"></span>
          </label>  노출
        <?php }else if($row->state == "1"){ ?>
          노출 안함  <label class="switch">
            <input type="checkbox" onchange="banner_state_mod_up(<?=$row->banner_idx?>, '0');" checked>
            <span class="check_slider"></span>
          </label>  노출
        <?php } ?>
      </td>
      <td>
        <?=$this->global_function->date_Ymd_hyphen($row->ins_date)?>
      </td>
    </tr>
    <?php
        }
      }else{
	  ?>
    <tr>
      <td colspan="5">
        <?=no_contents('0')?>
      </td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>


<?=$paging?>

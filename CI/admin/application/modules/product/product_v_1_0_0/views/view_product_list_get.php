<div class="table-responsive">

  <div class="row table_title">
    <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
    <div class="col-lg-6 text-right" style="margin-bottom:10px">
      <a href="javascript:void(0);" class="btn btn-success" onclick="do_excel_down();">엑셀 다운로드</a>
    </div>
  </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50">No</th>
          <th width="300">이미지</th>
          <th width="100">사용자 ID</th>
          <th width="100">사용자 이름</th>
          <th width="*">제목</th>
          <th width="60">구매 대상자 ID</th>
          <th width="60">구매 대상자 이름</th>
          <th width="200">해시태그</th>
          <th width="60">신고수</th>
          <th width="60">무료나눔</th>
          <th width="100">금액</th>
          <th width="80">거래 상태</th>
          <th width="80">인기상품 설정</th>
          <th width="80">게시상태</th>
          <th width="150">등록일시</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($result_list)){
            foreach($result_list as $row){
        ?>
          <tr>
            <td><?=$no--?></td>
            <td>
              <div class="view_img mg_btm_20" style="width:100%;">
                <ul class="img_hz" id="img" style="padding:0;">
                <? if(!empty($row->img_path)){ ?>
                  <?
                  $i=0;
                  $img_paths_arr = explode(',', $row->img_path);
                  foreach ($img_paths_arr as $img_path){
                  ?>
                    <li style="display:inline-block;margin-right:10px;padding-right:0;float:left;margin-bottom:10px;"  onclick="set_img_modal('<?=$img_path ?>', 'img_full');">
                      <a id="single_image" href="javascript:void(0)" class="img_box"><img style="" src="<?=$img_path ?>"></a>
                    </li>
                  <? $i++;} ?>
                <? } ?>
                  
                </ul>
              </div>
            </td>
            <td><?=$row->member_id?></td>
            <td><?=$row->member_name?></td>
            <td><a href="/<?=mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>&history_data=<?=$history_data?>"><?=$row->title?></a></td>
            <td><?=$row->partner_member_id?></td>
            <td><?=$row->partner_member_name?></td>
            <td><?=$row->tags?></td>
            <td><?=$row->report_cnt?></td>
            <td><?php if($row->free_product_yn == 'Y'){echo "무료나눔";} elseif($row->free_product_yn == 'N'){echo "-";}?></td>
            <td><?=number_format($row->product_price)?></td>
            <td><?=$this->global_function->get_product_state($row->product_state)?></td>
            <td>
              <?php if($row->famous_product_yn == "N"){ ?>
                <label class="switch">
                  <input type="checkbox" onchange="famous_product_yn_mod_up(<?=$row->product_idx?>, 'Y');">
                  <span class="check_slider"></span>
                </label>
              <?php }else if($row->famous_product_yn == "Y"){ ?>
                <label class="switch">
                  <input type="checkbox" onchange="famous_product_yn_mod_up(<?=$row->product_idx?>, 'N');" checked>
                  <span class="check_slider"></span>
                </label>
              <?php } ?>
            </td>
            <td><?php if($row->display_yn == 'Y'){echo "게시중";} elseif($row->display_yn == 'N'){echo "블라인드";}?></td>
            <td><?=$row->ins_date?></td>
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

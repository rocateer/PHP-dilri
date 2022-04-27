<!-- container-fluid : s -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>상품 관리 상세</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <div class="row table_title"><div class="col-lg-12"> <span class="f_right">등록일시 : <?= date('Y-m-d H:i',strtotime($result->ins_date)) ?></span></div></div>
      <section>
        <form name="form_default" id="form_default" method="post">
          <table class="table table-bordered td_left">
            <colgroup>
            	<col style="width:15%">
            	<col style="width:35%">
            	<col style="width:15%">
            	<col style="width:35%">
            </colgroup>
            <tbody>
              <tr>
                <th> 사용자 ID</th>
                <td ><?=$result->member_id?></td>
                <th> 사용자 이름</th>
                <td ><?=$result->member_name?></td>
              </tr>
              <tr>
                <th> 제목</th>
                <td colspan="3" ><?=$result->title?></td>
              </tr>
              <tr>
                <th> 카테고리</th>
                <td ><?=$result->category_name?></td>
                <th> 등록일시</th>
                <td ><?=$result->ins_date?></td>
              </tr>
              <tr>
                <th> 거래 상태</th>
                <td ><?=$this->global_function->get_product_state($result->product_state)?></td>
                <th> 상태</th>
                <td ><?php echo $result->display_yn == "Y"? "게시중":"블라인드"; ?></td>
              </tr>
              <tr>
                <th> 신고수</th>
                <td ><?=$result->report_cnt?></td>
                <th> 채팅수</th>
                <td ><?=$result->chatting_cnt?></td>
              </tr>
              <tr>
                <th> 구매 대상자 ID</th>
                <td ><?=$result->partner_member_id?></td>
                <th> 구매 대상자 이름</th>
                <td ><?=$result->partner_member_name?></td>
              </tr>
              <tr>
                <th> 무료 나눔</th>
                <td ><?php echo $result->free_product_yn == "Y"? "무료 나눔":"-"; ?></td>
                <th> 판매 금액</th>
                <td ><?=number_format($result->product_price)?></td>
              </tr>
              <tr>
                <th>상품 사진</th>
                <td colspan="3">
                  <div>
                    <ul class="img_hz" id="img">
                      <?php if($result->img_path != ""){ ?>
                        <?
                        $img_arr = explode(',', $result->img_path);
                        foreach ($img_arr as $row) {?>
                          <li  style="display:inline-block;">
                            <img src="<?=$row?>" style="width:150px">
                          </li>
                        <?}?>
                      <?php } ?>
                    </ul>
                  </div>
                </td>
              </tr>
              <tr>
                <th> 해시태그</th>
                <td colspan="3">
                  <?=str_replace(',', ', ', $result->tags)?>
                </td>
              </tr>
              <tr>
                <th> 내용</th>
                <td colspan="3" style="height:200px;"><?=nl2br($result->contents)?></td>
              </tr>
              
            </tbody>
          </table>
          <input type="hidden" name="product_idx" id="product_idx" value="<?=$result->product_idx?>">
        </form>
      </section>

      <div class="text-right" style="float:right;">
        <a class="btn btn-gray" href="javascript:void(0)" onclick="default_list();">목록</a>
        <a class="btn btn-info" href="javascript:void(0)" onclick="product_display_yn_mod_up('<?=$result->product_idx?>', '<?php echo $result->display_yn == "Y"? "N":"Y"; ?>')"><?php echo $result->display_yn == "Y"? "블라인드":"블라인드 해제"; ?></a>
      </div>

    </div>
  </div>
  <!-- body : e -->
</div>
<!-- container-fluid : e -->
<input type="hidden" name="page_num" id="page_num" value="1">
<script>

function product_display_yn_mod_up(product_idx, display_yn){

  var msg = display_yn=='Y'?'블라인드 해제하시겠습니까?':'블라인드 처리하시겠습니까?';

  if (!confirm(msg)) {
    return;
  }

  var formData = {
    "product_idx" : product_idx,
    "display_yn" : display_yn
  };

  $.ajax({
    url      : "/<?=mapping('product')?>/product_display_yn_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        alert(result.code_msg);
        default_list();
      }
    }
  });
}

function default_list(){
  history.back(<?=$history_data?>);
}
</script>

<!-- container-fluid : s -->
<div class="container-fluid" style="width:50%">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>중고거래 추천 검색어 설정</h1>
  </div>

  <!-- category table : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <div class="bg_wh mb20 col-md-12" style="height:500px;margin-top:20px;">
        <form name="form_default_0" id="form_default_0" method="post">
          <input type="hidden" name="type" id="type_0" value="0">
          <table class="table table-bordered" >
            <colgroup>
              <col style="width:20%">
              <col style="width:55%">
              <col style="width:25%">
            </colgroup>
            <tbody>
              <?php
                  $i =1;
                  foreach ($result_list as $row){
                ?>
              <tr>
                <th>추천검색어 <?=$i?></th>
                <td>
                  <input type="text" name="title_0[]"  id="title_0_<?=$row->recommend_search_idx?>" value="<?=$row->title?>" style="width:90%; text-align:center;" checked autocomplete="off">
                  <input type="text" name="recommend_search_idx_0[]" id="recommend_search_idx_0_<?=$row->recommend_search_idx?>" value="<?=$row->recommend_search_idx?>" style="display:none;">
                </td>
                <td>
                    노출 여부&nbsp; <label class="switch">
                      <input type="checkbox" name="display_yn_0[]" id = "display_checkbox_<?=$row->recommend_search_idx?>" onchange="display_yn_up(<?=$row->recommend_search_idx?>);" <? if($row->display_yn == "Y"){ echo "checked";}?>>
                      <span class="check_slider"></span>
                    </label>
                    <input type="hidden" name="display_yn_0[]" id="display_<?=$row->recommend_search_idx?>" value="<?=$row->display_yn?>">
                </td>
              </tr>
                <?php $i++; 
              }?>
            </tbody>
          </table>
        </form>
        <a href="javascript:void(0)" onClick="default_mod(0);" class="btn btn-success" style="float:right">저장</a>
      </div>
    </div>

  </div>
  <!-- category table : e -->
  
  <!-- Page Heading -->
  <div class="page-header" style="padding-top:20px;">
    <h1>커뮤니티 추천 검색어 설정</h1>
  </div>
  
  <!-- category table : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <div class="bg_wh mb20 col-md-12" style="height:500px;margin-top:20px;" >
        <form name="form_default_1" id="form_default_1" method="post">
          <input type="hidden" name="type" id="type_1" value="1">
        <table class="table table-bordered" >
          <colgroup>
            <col style="width:20%">
            <col style="width:55%">
            <col style="width:25%">
          </colgroup>
          <tbody>
            <?php
                $j =1;
                foreach ($result_community_list as $row2){
              ?>
            <tr>
              <th>추천검색어 <?=$j?></th>
              <td>
                <input type="text" name="title_1[]"  id="title_1_<?=$row2->recommend_search_idx?>" value="<?=$row2->title?>" style="width:90%; text-align:center;" checked>
                <input type="text" name="recommend_search_idx_1[]" id="recommend_search_idx_1_<?=$row2->recommend_search_idx?>" value="<?=$row2->recommend_search_idx?>" style="display:none;">
              </td>
              <td>
                  노출 여부&nbsp; <label class="switch">
                    <input type="checkbox" name="display_yn_1[]" id = "display_checkbox_<?=$row2->recommend_search_idx?>" onchange="display_yn_up(<?=$row2->recommend_search_idx?>);" <? if($row2->display_yn == "Y"){ echo "checked";}?>>
                    <span class="check_slider"></span>
                  </label>
                  <input type="hidden" name="display_yn_1[]" id="display_<?=$row2->recommend_search_idx?>" value="<?=$row2->display_yn?>">
              </td>
            </tr>
              <?php $j++; 
            }?>
          </tbody>
        </table>
        </form>
        <a href="javascript:void(0)" onClick="default_mod(1);" class="btn btn-success" style="float:right">저장</a>
      </div>
    </div>

  </div>
  <!-- category table : e -->
</div>
<!-- container-fluid : e -->
<script>
  
  // 추천 검색어 관리 저장
  function default_mod(type) {

    if($("input[name='display_yn_"+type+"[]']:checked").length > 5){
      alert('추천 검색어 노출은 최대 5개까지 지정 가능합니다. 노출로 지정된 항목을 해제후 다시 지정하여 선택해주세요.');
      return;
    }
    
    $.ajax({
      url      : "/<?=mapping('recommend')?>/recommend_search_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : $("#form_default_"+type).serialize(),
      success : function(result) {
        if(result.code == '-1') {
          alert(result.code_msg);
        }else {
          alert("적용 되었습니다.");
          location.reload();
        }
      }
    });
  }
  
  // 체크 박스 값넣기
  function display_yn_up(recommend_search_idx){
    
    console.log($("#display_"+recommend_search_idx).val());
    
   if($('#display_checkbox_'+recommend_search_idx).is(':checked')==true){
     $("#display_"+recommend_search_idx).val('Y');
   }else{
     $("#display_"+recommend_search_idx).val('N');
   }
  }

</script>

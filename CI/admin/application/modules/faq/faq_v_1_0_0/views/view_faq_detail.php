<!-- container-fluid : s -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>FAQ 상세</h1>
    <span style="line-height:35px; float:right;">
      등록일: <?=$this->global_function->date_Ymd_hyphen($result->ins_date)?>
    </span>
  </div>
  <!-- body : s -->
  <div class="bg_wh mt20">
    <!-- search : s -->
  	<div class="table-responsive">
      <form name="form_default" id="form_default" method="post">
        <input type="hidden" name="faq_idx" id="faq_idx" value="<?=$result->faq_idx?>">
    		 <table class="table table-bordered td_left">
          <colgroup>
        	<col style="width:15%">
        	<col style="width:35%">
        	<col style="width:15%">
        	<col style="width:35%">
          </colgroup>
          <tbody>
            <tr>
              <th><span class="text-danger">*</span> 분류 </th>
              <td colspan=3>
                <select class="form-control w_auto" name="faq_type" id="faq_type">
                  <?for($i=1;$i<=11;$i++){?>
                    <? if($i!=9){ ?>
                      <option value="<?=$i?>" <?=($result->faq_type ==$i)? "selected": "";?>><?=$this->global_function->get_faq_type($i)?></option>
                    <? } ?>
                  <?}?>
                </select>
              </td>
            </tr>
            <tr>
              <th><span class="text-danger">*</span> 제목 </th>
              <td colspan=3>
                <input name="title" id="title" type="text" class="form-control" value="<?=$result->title?>">
              </td>
            </tr>
            <tr>
              <th colspan="4">
                <span class="text-danger" >*</span> 내용
              </th>
            </tr>
            <tr>
              <td colspan="4" class="table_left" colspan="3">
                <textarea class="input_default textarea_box" name="contents" id="contents" placeholder=""><?=$result->contents?></textarea>
              </td>
            </tr>
            <tr>
             <th>노출 여부</th>
               <td colspan="3">
                     <?php if($result->state == "N"){ ?>
                       <label class="switch">
                         <input type="checkbox" name="state" id="state" value="Y">
                         <span class="check_slider"></span>
                       </label>
                     <?php }else if($result->state == "Y"){ ?>
                       <label class="switch">
                         <input type="checkbox" name="state" id="state" value="Y" checked>
                         <span class="check_slider"></span>
                       </label>
                     <?php } ?>
               </td>
             </tr>
          </tbody>
        </table>
        <div class="mt15">
          <a class="btn btn-gray" href="javascript:void(0)" onclick="default_list();">목록</a>
          <a class="btn btn-info" href="javascript:void(0)" onclick="default_mod();" style="float:right;">수정</a>
          <a class="btn btn-danger" href="javascript:void(0)" onClick="default_del('<?=$result->faq_idx?>')" style="float:right;">삭제</a>
        </div>
      </div>
    </div>
  </form>
  <!-- body : e -->

</div>
<!-- container-fluid : e -->

<script>

  // faq 목록
  function default_list(){
    history.back(<?=$history_data?>);
  }

  // faq 수정
  function default_mod(){

    $.ajax({
      url      : "/<?=mapping('faq')?>/faq_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : $("#form_default").serialize(),
      success: function(result){
        if(result.code == "-1"){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
        }else{
          alert("정상적으로 수정되었습니다.");
          default_list();
        }
      }
    });
  }

  // faq 삭제
  function default_del(faq_idx){

    if(!confirm("정말 삭제하시겠습니까?")){
      return;
    }

    $.ajax({
      url      : "/<?=mapping('faq')?>/faq_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {
        "faq_idx": faq_idx
      },
      success: function(result) {
        if(result.code == "-1"){
          alert(result.code_msg);
        }else{
          alert("정상적으로 삭제되었습니다.");
          default_list();
        }
      }
    });

  }

  // faq 상태 수정
  function faq_state_mod_up(faq_idx, state){

    var formData = {
      "faq_idx" : faq_idx,
      "state" : state
    };

    $.ajax({
      url      : "/<?=mapping('faq')?>/faq_state_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success: function(result){
        if(result.code == "-1"){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
      }
    });
  }


</script>

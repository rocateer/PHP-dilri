<!-- container-fluid : s -->
<div class="container-fluid" style="margin:20px">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>포인트 <?=($point_type =="0")?"지급":"차감";?></h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
  	<div class="table-responsive">

      <section>
        <form name="form_default" id="form_default" method="post">
          <input type="text" name="point_type" id="point_type" value="<?=$point_type?>"  style="display:none">
        	<table class="table table-bordered td_left">
            <colgroup>
          	<col style="width:15%">
          	<col style="width:35%">
          	<col style="width:15%">
          	<col style="width:35%">
            </colgroup>
        		<tbody>

              <tr>
                <th> <span class="text-danger">*</span> 회원</th>
                <td >
                  <select class="form-control" style="width:300px" id="member_idx" name="member_idx" >
                  <option value="">선택</option>
                  <option value="0">전체<?=$point_type == 0 ? '지급' : '차감'?></option>
                  <?php
                    foreach($result_list as $row){
                      if ($row->member_join_type=='C') {
                        $member_id = $row->member_id;
                      }else {
                        $member_id = $this->global_function->get_member_join_type($row->member_join_type);
                      }
                  ?>
                  <option value="<?=$row->member_idx?>" ><?=$member_id?> / <?=!empty($row->member_name)?$row->member_name:'닉네임 미정'?> / 잔여 포인트 : <?=number_format($row->member_point)?>개</option>
                  <?php
                    }
                  ?>
                </select>
                </td>
                <th> <span class="text-danger">*</span><?=$point_type == 0 ? '지급' : '차감'?>할 포인트</th>
                <td colspan="3">
                    <input name="point" id="point" type="text" class="form-control" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                </td>
              </tr>

              <tr>
                <th>내역</th>
                <td colspan="3">
                    <input name="memo" id="memo" type="text" class="form-control" maxlength="100">
                </td>
              </tr>

            </tbody>
          </table>
        </form>
      </section>

      <div class="row">
        <div class="col-lg-12 text-right">
          <a href="javascript:void(0)" onclick="window.close();" class="btn btn-gray">취소</a>
          <a href="javascript:void(0)" onclick="default_reg();" class="btn btn-success">포인트 <?=$point_type == 0 ? '지급' : '차감'?></a>
        </div>
      </div>

    </div>
  </div>
  <!-- body : e -->

</div>
<script>
  $("#member_idx").select2({
    placeholder: "선택하세요.",
    allowClear: true
  });

  function default_reg(){

    $.ajax({
      url      : "/<?=mapping('member_point')?>/member_point_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : $("#form_default").serialize(),
      success: function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 1) {
          alert(result.code_msg);
          opener.location.reload();
          self.close();
        } else {
          alert(result.code_msg);

        }
      }
    });
  }

</script>

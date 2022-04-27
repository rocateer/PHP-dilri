<!-- container-fluid : s -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>1:1 문의 상세</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
  	<div class="table-responsive">

      <!-- top -->
      <div class="row table_title">
        <div class="col-lg-12"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;회원질문
        <span class="f_right" style="line-height:35px;">
          등록일: <?=$this->global_function->date_YmdHi_hyphen($result->ins_date)?>
        </span>
        </div>
      </div>

      <!-- top  -->
      <section>
      	<table class="table table-bordered td_left">
          <colgroup>
        	<col style="width:15%">
        	<col style="width:35%">
        	<col style="width:15%">
        	<col style="width:35%">
          </colgroup>
      		<tbody>
      			<tr>
              <th>닉네임</th>
              <td>
                <?=$result->member_name?>
              </td>
              <th>아이디</th>
              <td>
                <?=$result->member_id?>
              </td>
            </tr>
            <tr>
              <th>제목</th>
              <td>
                <?=$result->qa_title?>
              </td>
              <th>문의 유형</th>
              <td>
                <?=$this->global_function->get_qa_type($result->qa_type)?>
              </td>
            </tr>
            <tr>
              <th>질문 내용</th>
              <td colspan="3">
                <div class="board_box">
                  <?=nl2br($result->qa_contents)?>
                </div>
              </td>
            </tr>
            
          </tbody>
      	</table>
      </section>

      <!-- top -->
      <div class="row table_title">
        <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;답변 등록</div>
      </div>

      <!-- top  -->
      <section>
      	<table class="table table-bordered td_left">
          <colgroup>
        	<col style="width:15%">
        	<col style="width:35%">
        	<col style="width:15%">
        	<col style="width:35%">
          </colgroup>
      		<tbody>
            <tr>
              <th>답변 내용</th>
              <td colspan=3>
                <textarea name="reply_contents" style="width:100%; height:200px;" id="reply_contents" placeholder="내용" class="input_default"><?=$result->reply_contents?></textarea>
              </td>
            </tr>
          </tbody>
      	</table>
      </section>

      <div>
        <a href="javascript:void(0)" onclick="default_list()" class="btn btn-gray">목록</a>
        <a href="javascript:void(0)" onclick="reply_reg();" class="btn btn-success" style="float:right;">답글 등록</a>
        <? if($result->check_yn=='N'){ ?>
          <a href="javascript:void(0)" onclick="check_reg();" class="btn btn-primary" style="float:right;">관리자 확인 완료</a>
        
        <? } ?>
        <a href="javascript:void(0)" onclick="reply_del()" class="btn btn-danger" style="float:right;">답글 삭제</a>
      </div>

  	</div>
  </div>
  <!-- body : e -->

</div>
<!-- container-fluid : e -->

<input name="qa_idx" id="qa_idx" type="hidden" value="<?=$result->qa_idx?>">

<script>

  // qa 목록
  function default_list(){
    history.back(<?=$history_data?>);
  }

  // qa 답변 등록
  function reply_reg(){

    var formData = {
      'qa_idx' : $('#qa_idx').val(),
      'reply_contents' : $('#reply_contents').val()
    }

    $.ajax({
    		url      : "/<?=mapping('qa')?>/qa_reply_reg_in",
    		type     : 'POST',
    		dataType : 'json',
    		async    : true,
    		data     : formData,
    		success : function(result){
          if(result.code == "-1"){
            alert(result.code_msg);
          }else{
            alert('답변이 등록 되었습니다.');
            default_list();
          }
    		}
    	});
  }

  // 관리자 확인
  function check_reg(){

    var formData = {
      'qa_idx' : $('#qa_idx').val()
    }

    $.ajax({
    		url      : "/<?=mapping('qa')?>/check_reg_in",
    		type     : 'POST',
    		dataType : 'json',
    		async    : true,
    		data     : formData,
    		success : function(result){
          if(result.code == "-1"){
            alert(result.code_msg);
          }else{
            alert(result.code_msg);
            location.reload();
          }
    		}
    	});
  }

  // qa 답변 삭제
  function reply_del(){

    if(confirm("답변하신 내용을 삭제 하시겠습니까? 답변을 삭제 하시면, 미답변 상태로 변경 됩니다.")){

      $.ajax({
        url      : "/<?=mapping('qa')?>/qa_reply_del",
        type     : 'POST',
        dataType : 'json',
        async    : true,
        data     : {
          "qa_idx" : $('#qa_idx').val()
        },
        success : function(result){
          if(result.code == "-1") {
            alert(result.code_msg);
          }else{
            alert('답변이 삭제 되었습니다.');
            location.reload();
          }
        }
      });
    }
  }

</script>

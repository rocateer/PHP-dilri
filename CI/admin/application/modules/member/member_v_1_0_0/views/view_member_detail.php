  <!-- container-fluid : s -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="page-header">
      <h1>회원 정보</h1>
    </div>

    <!-- body : s -->
    <div class="bg_wh mt20">
    	<div class="table-responsive">
        <section>
          <!-- top -->
          <div class="row table_title">
            <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;회원 정보</div>
          </div>
          <!-- top  -->
        	<table class="table table-bordered td_left">
            <colgroup>
            	<col style="width:15%">
            	<col style="width:35%">
            	<col style="width:15%">
            	<col style="width:35%">
            </colgroup>
        		<tbody>
        			<tr>
                <th>아이디(이메일)</th>
                <td ><?=$result->member_id?></td>
                <th>이름</th>
                <td ><?=$result->member_name?></td>
              </tr>
              <tr>
                <th>가입일</th>
                <td ><?=$this->global_function->date_Ymd_Hyphen($result->ins_date)?></td>
                <th>회원상태</th>
                <td>
                  <?switch($result->del_yn){
                    case 'N': echo "이용중"; break;
                    case 'P': echo "이용정지"; break;
                    case 'Y': echo "탈퇴"; break;
                  }?>
                </td>
              </tr>
              <tr>
                <th>탈퇴일</th>
                <td><?if($result->member_leave_date != ""){
                        echo $this->global_function->date_YmdHi_Hyphen($result->member_leave_date);
                      }else{
                        echo "-";
                      }?>
                    </td>
                <th>탈퇴 사유</th>
                <td><?if($result->member_leave_reason != ""){
                        echo $result->member_leave_reason;
                      }else{
                        echo "-";
                      }?>
                </td>
              </tr>
              <?if(!($result->del_yn == 'Y')){?>
                <tr>
                  <th>잔여 포인트</th>
                  <td><?=$result->member_point?></td>
                  <th>거래 글 등록 수</th>
                  <td><?=$result->product_cnt?></td>
                </tr>
                <tr>
                  <th>무료 나눔 완료 수</th>
                  <td><?=$result->free_product_cnt?></td>
                  <th>좋음 평가 수</th>
                  <td><?=$result->good_product_cnt?></td>
                </tr>
                <tr>
                  <th>나쁨 평가 수</th>
                  <td colspan="3"><?=$result->bad_product_cnt?></td>
                </tr>
                <tr>
                  <th>좋음 평가</th>
                  <td>
                    <table class="table table-bordered" name="inner_table">
                      <colgroup>
                        <col style="width:80%">
                        <col style="width:20%">
                      </colgroup>
                      <tbody>
                        <tr>
                          <th>적당한 가격</th>
                          <td>
                            <?=$result->good_product_cnt_0?>
                          </td>
                        </tr>
                        <tr>
                          <th>시간 개념</th>
                          <td>
                            <?=$result->good_product_cnt_1?>
                          </td>
                        </tr>
                        <tr>
                          <th>빠른 응답</th>
                          <td>
                            <?=$result->good_product_cnt_2?>
                          </td>
                        </tr>
                        <tr>
                          <th>신뢰성</th>
                          <td>
                            <?=$result->good_product_cnt_3?>
                          </td>
                        </tr>
                        <tr>
                          <th>매너 좋음</th>
                          <td>
                            <?=$result->good_product_cnt_4?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <th>나쁜 평가</th>
                  <td>
                    <table class="table table-bordered" name="inner_table">
                      <colgroup>
                        <col style="width:80%">
                        <col style="width:20%">
                      </colgroup>
                      <tbody>
                        <tr>
                          <th>가격 비쌈</th>
                          <td>
                            <?=$result->bad_product_cnt_0?>
                          </td>
                        </tr>
                        <tr>
                          <th>가격을 속임</th>
                          <td>
                            <?=$result->bad_product_cnt_1?>
                          </td>
                        </tr>
                        <tr>
                          <th>시간 안지킴</th>
                          <td>
                            <?=$result->bad_product_cnt_2?>
                          </td>
                        </tr>
                        <tr>
                          <th>응답 느림</th>
                          <td>
                            <?=$result->bad_product_cnt_3?>
                          </td>
                        </tr>
                        <tr>
                          <th>약속장소 안 나타남</th>
                          <td>
                            <?=$result->bad_product_cnt_4?>
                          </td>
                        </tr>
                        <tr>
                          <th>거래 취소함</th>
                          <td>
                            <?=$result->bad_product_cnt_5?>
                          </td>
                        </tr>
                        <tr>
                          <th>거래거부</th>
                          <td>
                            <?=$result->bad_product_cnt_6?>
                          </td>
                        </tr>
                        <tr>
                          <th>불친절</th>
                          <td>
                            <?=$result->bad_product_cnt_7?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <th>무료나눔 - 나눔</th>
                  <td>
                    <table class="table table-bordered" name="inner_table">
                      <colgroup>
                        <col style="width:80%">
                        <col style="width:20%">
                      </colgroup>
                      <tbody>
                        <tr>
                          <th>행복하세요</th>
                          <td>
                            <?=$result->free_product_cnt_0?>
                          </td>
                        </tr>
                        <tr>
                          <th>희망을 잃지 마세요</th>
                          <td>
                            <?=$result->free_product_cnt_1?>
                          </td>
                        </tr>
                        <tr>
                          <th>건강 하세요</th>
                          <td>
                            <?=$result->free_product_cnt_2?>
                          </td>
                        </tr>
                        <tr>
                          <th>도움이 되길 바랍니다.</th>
                          <td>
                            <?=$result->free_product_cnt_3?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <th>무료나눔 - 고마움</th>
                  <td>
                    <table class="table table-bordered" name="inner_table">
                      <colgroup>
                        <col style="width:80%">
                        <col style="width:20%">
                      </colgroup>
                      <tbody>
                        <tr>
                          <th>행복을 나눠 주셔서 감사합니다.</th>
                          <td>
                            <?=$result->free_product_cnt_4?>
                          </td>
                        </tr>
                        <tr>
                          <th>희망을 얻었습니다.</th>
                          <td>
                            <?=$result->free_product_cnt_5?>
                          </td>
                        </tr>
                        <tr>
                          <th>마음의 위로를 받았습니다.</th>
                          <td>
                            <?=$result->free_product_cnt_6?>
                          </td>
                        </tr>
                        <tr>
                          <th>감사합니다.</th>
                          <td>
                            <?=$result->free_product_cnt_7?>
                          </td>
                        </tr>
                        <tr>
                          <th>꼭 보답하겠습니다.</th>
                          <td>
                            <?=$result->free_product_cnt_8?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
	                </td>
                </tr>
                <tr>
                  <th>
                    <p>메모</p>
                    <p><input class="btn btn-success btn-sm"type="button" onclick="memo_mod_up()" value="저장"></p>
                  </th>
                  <td colspan="3">
                    <textarea class="form-control" name="memo" id="memo" value=""><?=$result->memo?></textarea>
                  </td>
                </tr>
              <?}?>
            </tbody>
        	</table>
        </section>

        <div class="row">
          <div class="col-lg-12 text-right">
            <a href="javascript:void(0)" onclick="default_list();" class="btn btn-gray">목록</a>
            <?if($result->del_yn == 'N'){?>
            <a href="javascript:void(0)" onclick="member_state_mod_up(<?=$result->member_idx?>,'<?=$result->del_yn?>')" class="btn btn-danger">이용정지</a>
            <?} else if($result->del_yn == 'P'){ ?>
            <a href="javascript:void(0)" onclick="member_state_mod_up(<?=$result->member_idx?>,'<?=$result->del_yn?>')" class="btn btn-primary">이용정지 해제</a>
            <?}?>
          </div>
        </div>
    	</div>
    </div>
    <!-- body : e -->
  </div>
  <!-- container-fluid : e -->
  
  <input type="text" name="member_idx" id="member_idx" value="<?=$result->member_idx?>" style="display: none;">

  <script>
  
  window.onload = function(){
    setTimeout(thLeft(), 10); // th 좌측정렬
    setTimeout(tdRight(), 10); // td 우측정렬
  }
  
  // th 좌측정렬
  function thLeft(){
    var innerTable = document.querySelectorAll("table[name='inner_table'] > tbody th");
    
    for(var item of innerTable){
      item.style.textAlign = "left";
    }
  }
  
  // td 우측정렬
  function tdRight(){
    var innerTable = document.querySelectorAll("table[name='inner_table'] > tbody td");

    for(var item of innerTable){
        item.style.textAlign = "right";
    }
  }
  
  function default_list(){
    history.back(<?=$history_data?>);
  } 
  
  // 회원 상태 변경
  function member_state_mod_up(member_idx, del_yn){
    if(del_yn == 'N'){
      if(!confirm('이용 정지 처리 하시겠습니까?')){
        return;
      }
    } else if(del_yn == 'P'){
      if(!confirm('이용 정지 해제 하시겠습니까?')){
        return;
      }
    }

    var form_data = {
      "member_idx" : member_idx,
      "del_yn" : del_yn
    };

    $.ajax({
      url      : "/<?=mapping('member')?>/member_state_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result){
        if(result.code == "-1"){
          alert(result.code_msg);
        }
        if(result.code == "1"){
          location.reload();
        }
      }
    });
  }
  
  // 메모 수정
  function memo_mod_up(){
    var member_idx = document.querySelector('#member_idx').value;
    var memo = document.querySelector('#memo').value;

    var form_data = {
      "member_idx" : member_idx,
      "memo" : memo
    };

    $.ajax({
      url      : "/<?=mapping('member')?>/memo_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result){
        if(result.code == "-1"){
          alert(result.code_msg);
        }
        if(result.code == "1"){
          alert(result.code_msg);
          location.reload();
        }
      }
    });
  }

  </script>

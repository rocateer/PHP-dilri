<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
    <?=lang("lang_setting_00808","해시태그 알림 설정")?>
  </h1>
</header>
<!-- header : e -->
<!-- body : s -->
<div class="body row">
  <div class="inner_wrap">
    <div class="relative keyword">
      <p><?=lang("lang_member_info_00817","알림 받을 해시태그")?></p>
      <div class="keyword_num"></div>
    </div>
    <div class="relative">
      <div class="cnt_num">0/30</div>
      <div class="flex_4">
        <input type="text" name="alarm_keyword" id="alarm_keyword">
        <button class="btn_reg" onclick="hashtag_reg_in();"><?=lang("lang_mypage_00711","등록")?></button>
      </div>
    </div>
    <ul class="keyword_ul" id="list_ajax">

    </ul>
  </div>
</div>
<!-- body : e -->
<script>

  window.onload = function(){
    setTimeout(default_list_get(), 10);
  }

  //엔터키 시 검색
  window.addEventListener('keydown', function(event){
    if (window.event.keyCode == 13) {
      // 엔터키가 눌렸을 때 실행할 내용
      hashtag_reg_in();
    }
  })

  //해시태그 등록
  function hashtag_reg_in(){

    var input_text = document.querySelector('#alarm_keyword');

    var form_data = {
      'alarm_keyword' : input_text.value
    };

    $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('alarm')?>/hashtag_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success : function(result){
        if(result.code == '-1'){
    			alert(result.code_msg);
    			$("#"+result.focus_id).focus();
    			return;
  		  }
  		  // 0:실패 1:성공
  		  if(result.code == 0) {
  			  alert(result.code_msg);
  		  } else {
          default_list_get();
          input_text.value = "";
      	}
  		}
    });
  }

  //해시태그 삭제
  function hashtag_del(tag_num){
    var alarm_keyword = document.querySelector(`li[name='tag_num'][value='${tag_num}']`).innerText.trim();

    var form_data = {
      'alarm_keyword' : alarm_keyword
    };

    $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('alarm')?>/hashtag_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success : function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.code_msg);
        } else {
          default_list_get();
        }
      }
    });
  }

  // 해시태그 가져오기
  function default_list_get(){

    var form_data = {
    };

    $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('alarm')?>/hashtag_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : form_data,
      success: function(result) {
        $("#list_ajax").html(result);
      }
    });
  }
</script>

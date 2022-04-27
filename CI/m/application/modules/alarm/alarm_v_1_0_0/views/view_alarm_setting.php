<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
    <?=lang("lang_mypage_00664","알림 방해 금지 설정")?>
  </h1>
</header>
<!-- header : e -->
<!-- body : s -->
<div class="body row vh_wrap">

  <div class="vh_body">
    <ul class="list_ul mt12 setting">
      <li>
        <a href=""><?=lang("lang_mypage_00664","알림 방해 금지 설정")?>
          <label class="f_right switch">
            <input type="checkbox" name="no_alarm_yn" id="no_alarm_yn" <?=$result['no_alarm_yn'] == 'Y' ? "checked" : ""?>>
            <span class="check_slider"></span>
          </label>
        </a>
      </li>
    </ul>
    <div class="inner_wrap">
      <div class="label"><?=lang("lang_mypage_00665","시작 시간")?></div>
      <div class="flex_5">
        <select name="hourBox" id="s_hour">
          <option value=""><?=lang("lang_mypage_00667","시")?></option>
        </select>
        <select name="minuetBox" id="s_minuet">
          <option value=""><?=lang("lang_mypage_00668","분")?></option>
        </select>
      </div>
      <div class="label"><?=lang("lang_mypage_00666","종료 시간")?></div>
      <div class="flex_5">
        <select name="hourBox" id="e_hour">
          <option value=""><?=lang("lang_mypage_00667","시")?></option>
        </select>
        <select name="minuetBox" id="e_minuet">
          <option value=""><?=lang("lang_mypage_00668","분")?></option>
        </select>
      </div>
    </div>
    <div class="vh_footer btn_full_weight btn_point mt30 mb30">
      <a href="javascript:void(0)" onclick="alarm_setting_mod_up();"><?=lang("lang_mypage_00669","저장")?></a>
    </div>
  </div>
</div>
<!-- body : e -->
<script type="text/javascript">

  window.onload = function(){
    setTimeout(getTime(), 10);
    setTimeout(loadMemberTime(), 10);
  }

  function loadMemberTime(){
    document.querySelector('#s_hour').value = "<?=$result['s_hour']?>";
    document.querySelector('#s_minuet').value = "<?=$result['s_minuet']?>";
    document.querySelector('#e_hour').value = "<?=$result['e_hour']?>";
    document.querySelector('#e_minuet').value = "<?=$result['e_minuet']?>";
  }

  // 알림 방해 금지 설정 변경
  function alarm_setting_mod_up(){

    var no_alarm_yn = document.querySelector("#no_alarm_yn").checked == true ? 'Y' : 'N';

  	var form_data = {
  		'no_alarm_yn' : no_alarm_yn,
      's_hour' : document.querySelector('#s_hour').value,
      's_minuet' : document.querySelector('#s_minuet').value,
      'e_hour' : document.querySelector('#e_hour').value,
      'e_minuet' : document.querySelector('#e_minuet').value,
  	};

    $.ajax({
      url      : "/<?=$this->nationcode.'/'.mapping('alarm')?>/alarm_setting_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result){
        if(result.code == "0"){
          alert(result.code_msg);
        }else{
          alert(result.code_msg);

        }
      }
    });

  }

  // 시간 형식 로딩
  function getTime(){
    var hourBox = document.querySelectorAll("select[name='hourBox']");
    var minuetBox = document.querySelectorAll("select[name='minuetBox']");

    var hour = document.querySelector("#hour");
    var minuet = document.querySelector("#minuet");

    for(var item of hourBox){
      for(var i = 1; i <= 23; i++){
        var newHour = document.createElement('option');
        if(i < 10){
          i = '0'+i;
        }
        newHour.setAttribute("value", i);
        newHour.innerText = `${i} <?=lang("lang_mypage_00667","시")?>`;
        item.appendChild(newHour);
      }
    }

    for(var item of minuetBox){
      for(var i = 0; i <= 59; i+=30){
        var newMinuet = document.createElement('option');
        if(i < 10){
          i = '0'+i;
        }
        newMinuet.setAttribute("value", i);
        newMinuet.innerText = `${i} <?=lang("lang_mypage_00668","분")?>`;
        i = parseInt(i);
        item.appendChild(newMinuet);
      }
    }
  }

</script>

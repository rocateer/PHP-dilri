<!doctype html>
<html lang="ko">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta charset="utf-8">
    <!-- Favicon -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <title><?=SERVICE_NAME?></title>
    <style>
    </style>
  </head>
  <body style="margin:0;padding:0;max-width: 100%;background-color: #F9F9F9;">
    <div style="width:100%; height:100%; margin: 0 auto; background-color: #F9F9F9;">
      <div style="max-width:600px;width: 100%; height:auto; margin: 0 auto; padding: 44px 20px 60px 20px;box-sizing: border-box;background-color: #F9F9F9;">
        <header>
          <img src="http://sususoft.m.rocateerdev.co.kr/images/login_logo.png" alt="<?=SERVICE_NAME?>" style="width:171px;">
        </header>
        <p style="font-size:26px; font-weight: bold; font-family: 'NotoSansKR-Bold'; letter-spacing: -1.3px;margin:60px 0 30px 0;"><?=$this->global_function->get_translation('lang_member_pw_change_00698', $data['current_lang'], "비밀번호 변경")?></p>
        <div style="background:#fff; border-radius: 10px; padding:40px; box-sizing:border-box;">
          <p style="color:#333;font-family: 'NotoSansKR-Bold'; font-size:16px; font-weight: bold;line-height:26px;margin:0;padding:0">
            <?=$this->global_function->get_translation('lang_member_pw_change_00701', $data['current_lang'], "신규 비밀번호")?> <span style="font-size:16px; color:#E56353;">*</span>
          </p>
          <input name="member_pw" id="member_pw" style="border-radius: 0;text-indent: 10px;margin-top:10px; margin-bottom:30px;height:48px; border:1px solid #ddd; width:100%;" type="password" placeholder="<?=$this->global_function->get_translation('lang_member_pw_change_00702', $data['current_lang'], "영문,숫자 조합으로 8~15자리로 입력해 주세요")?>">
          <p style="color:#333;font-family: 'NotoSansKR-Bold'; font-size:16px; font-weight: bold;line-height:26px;margin:0;padding:0">
            <?=$this->global_function->get_translation('lang_member_pw_change_00703', $data['current_lang'], "비밀번호 확인")?> <span style="font-size:16px; color:#E56353;">*</span>
          </p>
          <input name="member_pw_check" id="member_pw_check" style="border-radius: 0;text-indent: 10px;margin-top:10px;height:48px; border:1px solid #ddd; width:100%;" type="password" placeholder="<?=$this->global_function->get_translation('lang_member_pw_change_00702', $data['current_lang'], "영문,숫자 조합으로 8~15자리로 입력해 주세요")?>">
          <div style="text-align:center;margin: 0 auto; max-width:260px; margin-top:60px;">
            <a href="javascript:void(0)" onclick="saveFn();"style="padding: 13px 0; text-decoration: none; display: block; background:#009648;border-radius:2px; color:#fff; text-align:center;"><?=$this->global_function->get_translation('lang_join_00074', $data['current_lang'], "변경")?></a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<input type="hidden" name="p_code" id="p_code" value="<?=$data['p_code']?>">
<input type="hidden" name="current_lang" id="current_lang" value="<?=$data['current_lang']?>">

<script src="/js/jquery-1.12.4.min.js"></script>
<script>

  function saveFn(){

    var formData = {
      "current_lang" : $('#current_lang').val(),
      "p_code" : $('#p_code').val(),
      "member_pw" : $('#member_pw').val(),
      "member_pw_check" : $('#member_pw_check').val()
    };

    $.ajax({
      url : "/find_pw_to_email/member_pw_reset_up",
      type : "post",
      dataType : "json",
      data: formData,
      success : function(data){
        if(data.code == '-1'){
          alert(data.code_msg);
        }else{
          alert(data.code_msg);
          location.href="/find_pw_to_email/member_pw_complete";
        }
      }
    });
  }

</script>

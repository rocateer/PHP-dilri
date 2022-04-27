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
    <div style="width:100%; height:100%;min-height: calc(100vh - 410px); margin: 0 auto;background-color: #F9F9F9;">
      <div style="max-width:600px; height:auto; margin: 0 auto; padding: 44px 20px 60px 20px; box-sizing: border-box;background-color: #F9F9F9;">
        <header>
          <img src="http://m.dilri.com/images/logo_mail.png" alt="<?=SERVICE_NAME?>" style="width:171px;">
        </header>
        <p style="font-size:26px; font-weight: bold; font-family: 'NotoSansKR-Bold'; letter-spacing: -1.3px;margin:60px 0 30px 0;"><?=lang("lang_find_pw_00003","비밀번호 변경")?></p>
        <div style="background:#fff; border-radius: 10px; padding:40px; box-sizing:border-box;">
          <p style="letter-spacing: -0.5px;color:#333; font-size:15px; line-height:26px;margin:0;padding:0">
            <?=lang("lang_find_pw_00004","비밀번호 변경을 위해 아래 링크로 이동하여 주세요.")?></p>
          <div style="text-align:center;margin: 0 auto; max-width:260px; margin-top:60px;">
            <a href="http://pw.dilri.com/find_pw_to_email/member_pw_change_key_check?p_code=<?=$data['change_pw_key']?>&current_lang=<?=$data['current_lang']?>" style="padding: 13px 0; text-decoration: none; display: block; background:#009648;border-radius:2px; color:#fff; text-align:center;"><?=lang("lang_find_pw_00005","링크로 이동")?></a>
          </div>
        </div>
      </div>
      <div style="background:#eee;width:100%;overflow:hidden;margin:0 auto;padding:30px 0;">
        <div style="max-width:600px; padding:0 20px;box-sizing:border-box; height:auto; margin: 0 auto; box-sizing: border-box;">
          <p style="margin-block-start:0;margin-block-end:0;font-size:14px; line-height: 24px; color:#666">
            <?=lang("lang_find_pw_00011","회사정보~~~")?><br>
            <?=lang("lang_find_pw_00012","회사정보~~~")?>
          </p>
          <p style="margin-block-start:0;margin-block-end:0;font-size:14px; color:#999;margin-top:30px;"><?=lang("lang_find_pw_00013","ⓒ 2021 Rocateer, Inc. All rights reserved.")?></p>
        </div>
      </div>
    </div>
  </body>
</html>

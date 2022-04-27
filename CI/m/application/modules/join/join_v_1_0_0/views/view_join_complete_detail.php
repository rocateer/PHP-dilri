<div class="vh_wrap complete_wrap">
  <div class="vh_body">
    <img src="/images/img_success1.png">
    <div class="title"><?=lang("lang_join_00768","축하합니다!")?></div>
    <p><?=lang("lang_join_00097","회원가입이 완료되었습니다.")?></p>
  </div>
  <div class="vh_footer btn_full_weight btn_point mb30 mt30">
    <a href="/<?=$this->nationcode.'/'.mapping('login')?>"><?=lang("lang_join_00098","로그인 화면으로")?></a>
  </div>
</div>

<script>
setTimeout(function(){
  history.replaceState({ data: 'testData2' }, null, document.referrer);
}, 100);

</script>

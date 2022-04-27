<!-- header : s -->
<header>
  <h1><?=lang("lang_badge_00805","평가목록")?></h1>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
</header>
<!-- header : e -->
<div class="body">
  <div class="eval_title">
    <img src="/images/i_manner1_b.png" alt="">
    <?=lang("lang_mypage_00545","좋음 평가")?>
  </div>
  <ul class="eval_info_ul">
    <li>
      <?=lang("lang_mypage_00546","적당한 가격")?>
      <span class="num"><?=$result->good_product_cnt_0?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00547","시간 개념")?>
      <span class="num"><?=$result->good_product_cnt_1?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00548","빠른 응답")?>
      <span class="num"><?=$result->good_product_cnt_2?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00549","신뢰성")?>
      <span class="num"><?=$result->good_product_cnt_3?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00550","매너 좋음")?>
      <span class="num"><?=$result->good_product_cnt_4?></span>
    </li>
  </ul>
  <div class="eval_title">
    <img src="/images/i_manner2_b.png" alt="">
    <?=lang("lang_mypage_00551","나쁨 평가")?>
  </div>
  <ul class="eval_info_ul">
    <li>
      <?=lang("lang_mypage_00552","가격 비쌈")?>
      <span class="num"><?=$result->bad_product_cnt_0?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00553","가격을 속임")?>
      <span class="num"><?=$result->bad_product_cnt_1?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00554","시간 안 지킴")?>
      <span class="num"><?=$result->bad_product_cnt_2?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00555","응답 느림")?>
      <span class="num"><?=$result->bad_product_cnt_3?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00556","약속장소 안 나타남")?>
      <span class="num"><?=$result->bad_product_cnt_4?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00557","거래 취소함")?>
      <span class="num"><?=$result->bad_product_cnt_5?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00558","거래거부")?>
      <span class="num"><?=$result->bad_product_cnt_6?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00559","불친절")?>
      <span class="num"><?=$result->bad_product_cnt_7?></span>
    </li>
  </ul>
  <div class="eval_title">
    <img src="/images/i_gift.png" alt="">
    <?=lang("lang_mypage_00560","나눔 피드백")?>
  </div>
  <ul class="eval_info_ul">
    <li>
      <?=lang("lang_mypage_00561","행복하세요")?>
      <span class="num"><?=$result->free_product_cnt_0?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00562","희망을 잃지 마세요")?>
      <span class="num"><?=$result->free_product_cnt_1?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00563","건강 하세요")?>
      <span class="num"><?=$result->free_product_cnt_2?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00564","도움이 되길 바랍니다")?>
      <span class="num"><?=$result->free_product_cnt_3?></span>
    </li>
  </ul>
  <div class="eval_title">
    <img src="/images/i_thanks.png" alt="">
    <?=lang("lang_mypage_00565","고마움 피드백")?>
  </div>
  <ul class="eval_info_ul">
    <li>
      <?=lang("lang_mypage_00566","행복을 나눠 주셔서 감사합니다.")?>
      <span class="num"><?=$result->free_product_cnt_4?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00567","희망을 얻었습니다.")?>
      <span class="num"><?=$result->free_product_cnt_5?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00568","마음의 위로를 받았습니다.")?>
      <span class="num"><?=$result->free_product_cnt_6?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00569","감사합니다.")?>
      <span class="num"><?=$result->free_product_cnt_7?></span>
    </li>
    <li>
      <?=lang("lang_mypage_00570","꼭 보답하겠습니다.")?>
      <span class="num"><?=$result->free_product_cnt_8?></span>
    </li>
  </ul>
</div>

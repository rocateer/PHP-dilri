<!-- header : s -->
<header>
  <h1><?=lang("lang_mypage_00533","평가하기")?></h1>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
</header>
<!-- header : e -->
<div class="body inner_wrap">
	<div class="genelar_wrap">
		<h4 class="txt_center"><?=lang("lang_mypage_00582","거래는 즐거우셨나요?<br>판매자에 대한 평가를 부탁 드립니다.")?></h4>
    <ul class="genelar_ul">
      <li>
        <a href="/<?=$this->nationcode.'/'.mapping('eval')?>/nice_reg?product_idx=<?=$product_idx?>">
          <? if($this->current_nation=='kr'){ ?>
            <img src="/images/good.png" alt="good">
          <? } else if($this->current_nation=='bd') {?>
            <img src="/images/Positive_bd.png" alt="good">
          <? } else {?>
            <img src="/images/Positive_us.png" alt="good">
          <? } ?>
        </a>
      </li>
      <li>
        <a href="/<?=$this->nationcode.'/'.mapping('eval')?>/bad_reg?product_idx=<?=$product_idx?>">
        <? if($this->current_nation=='kr'){ ?>
          <img src="/images/bad.png" alt="bad">
        <? } else if($this->current_nation=='bd') {?>
          <img src="/images/Negative_bd.png" alt="bad">
        <? } else {?>
          <img src="/images/Negative_us.png" alt="bad">
        <? } ?>
        </a>
      </li>
    </ul>
	</div>
</div>

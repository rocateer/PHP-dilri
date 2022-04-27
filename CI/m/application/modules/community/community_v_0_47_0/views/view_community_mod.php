<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1>커뮤니티 수정</h1>
</header>
<!-- header : e -->
<div class="body row">
	<div class="label inner_wrap">사진</div>
	<div class="x_scroll_img_reg">
    <div class="cnt_num">3/10</div>
    <ul class="img_reg_ul" id="">
      <li>
        <div class="img_box">
          <img src="/images/img_plus.png" alt="">
        </div>
      </li>
      <li>
        <img src="/images/i_delete.png" alt="x" class="btn_delete">
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
      <li>
				<img src="/images/i_delete.png" alt="x" class="btn_delete">
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
    </ul>
  </div>
	<div class="inner_wrap">
		<div class="label">내용 <span class="essential">*</span></div>
		<textarea style="height:300px">날씨가 따뜻해지는 게 느껴지네요. 조금만 있으면 벚꽃도 필 것 같네요?</textarea>
		<div class="label">해시태그 <span class="essential">*</span></div>
		<p class="font_gray_9 mb8">입력 후 사이띄게를 입력하시면 태그가 등록됩니다.</p>

		<input class="form-control" type="text" name="tags" id="tags" value="">

		<div class="btn_full_weight btn_point mt30 mb30">
			<a href="">수정</a>
		</div>
	</div>

</div>
<script type="text/javascript">
$(function(){
	var tagData = new Array();
	$('#tags').tagEditor({
		initialTags: [
		  '태그1',
			'ㄴㄴㅇ'
		],
		placeholder : "태그를 입력하세요.",
		autocomplete: {
				delay: 10, // show suggestions immediately
				position: { collision: 'flip' }, // automatic menu position up/down
				source: tagData
		},
		forceLowercase: false
	});
});

</script>

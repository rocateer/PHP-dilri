<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
	<div class="search_wrap">
		<input type="text" placeholder="검색어를 입력하세요." class="search_val">
		<img src="/images/i_delete_gray.png" alt="x" class="btn_delete">
		<img src="/images/headn_search.png" alt="search" class="btn_search">
	</div>
</header>
<div class="body">
	<div class="search_tab footer_margin">
		<ul class="tab_toggle_menu clearfix">
		  <li class="active">
		    <a href="javascript:void(0)">중고거래</a>
		  </li>
		  <li class="">
		    <a href="javascript:void(0)">커뮤니티</a>
		  </li>
		</ul>
		<div class="tab_area_wrap">
		  <!-- 탭 영역 1 : s -->
		  <div class="inner_wrap">
				<!-- no data:s -->
				<div class="no_datas">
					<img src="/images/Icons-search-gray.png" alt="">
					<p>검색 결과가 없습니다.</p>
				</div>
				<!-- no data:e -->
				<div class="w_100 row mt20">
					<img src="/images/icons-darl-filter.png" alt="filter" class="filter f_right" onclick="modal_open('search_filter')">
					<!-- modal : s -->
			    <div class="modal modal_search_filter">
						<header>
							<a class="btn_back" href="javascript:void(0)" onclick="modal_close('search_filter')">
								<img src="/images/head_btn_close.png" alt="close">
							</a>
							<h1>필터</h1>
						</header>
			      <div class="body inner_wrap" onclick="event.stopPropagation();">
							<p class="label">카테고리</p>
							<ul class="search_category_ul">
								<li>
									<a href="<?=mapping('search')?>/category_result">
										<img src="/images/i_catalog_1.png" alt="">
										<p>식물</p>
									</a>
								</li>
								<li>
									<a href="<?=mapping('search')?>/category_result">
										<img src="/images/i_catalog_2.png" alt="">
										<p>식물</p>
									</a>
								</li>
								<li>
									<a href="<?=mapping('search')?>/category_result">
										<img src="/images/i_catalog_3.png" alt="">
										<p>식물</p>
									</a>
								</li>
								<li>
									<a href="<?=mapping('search')?>/category_result">
										<img src="/images/i_catalog_4.png" alt="">
										<p>식물</p>
									</a>
								</li>
								<li>
									<a href="<?=mapping('search')?>/category_result">
										<img src="/images/i_catalog_5.png" alt="">
										<p>식물</p>
									</a>
								</li>
								<li>
									<a href="<?=mapping('search')?>/category_result">
										<img src="/images/i_catalog_6.png" alt="">
										<p>식물</p>
									</a>
								</li>
								<li>
									<a href="<?=mapping('search')?>/category_result">
										<img src="/images/i_catalog_7.png" alt="">
										<p>식물</p>
									</a>
								</li>
								<li>
									<a href="<?=mapping('search')?>/category_result">
										<img src="/images/i_catalog_8.png" alt="">
										<p>식물</p>
									</a>
								</li>
							</ul>
							<div class="label">가격 범위</div>
							<div class="price_wrap">
					      <input type="checkbox" id="chk_1_1" name="chk_1">
					      <label for="chk_1_1"><span></span>무료나눔</label>
								<div class="flex_1">
									<div class="relative">
							      <span class="unit">৳</span>
							      <input type="number" authcomplete="off" id="price">
									</div>
									<span>~</span>

									<div class="relative">
							      <span class="unit">৳</span>
							      <input type="number" authcomplete="off" id="price">
									</div>
								</div>
					    </div>
							<p class="label">검색 거리 범위</p>
							<select name="" id="">
								<option value="">1 ~ 10km 중 선택 하세요.</option>
							</select>
							<div class="btn_half_wrap2 mt30 mb30">
								<span class="btn_float_left btn_gray">
									<a href="">초기화</a>
								</span>
								<span class="btn_float_right btn_point">
									<a href="">초기화</a>
								</span>
							</div>
			      </div>
			    </div>
			    <!-- modal : e -->
				</div>
				<ul class="home_ul mb20">
					<li>
						<table class="tbl_4">
							<colgroup>
								<col width="125">
							</colgroup>
							<tr>
								<th rowspan="6">
									<a href="/<?=mapping('product')?>/product_detail">
										<div class="img_box thum">
											<img src="/p_images/s1.jpg" onerror="this.src='/images/default_img.png'">
										</div>
									</a>
								</th>
							</tr>
							<tr>
								<td>
									<a href="/<?=mapping('product')?>/product_detail">
										<div class="title">개봉전 샤넬지갑 팔아요. 정품 인증서 가지고 있습니다!</div>
									</a>
								</td>
							</tr>
							<tr>
								<td>
									<a href="/<?=mapping('product')?>/product_detail">
										<div class="place">236/C-237/A, Dhaka 1208 방글라데시</div>
									</a>
								</td>
							</tr>
							<tr>
								<td>
									<a href="/<?=mapping('product')?>/product_detail">
										<div class="s_info">1분 전 · 나와의 거리 15km</div>
									</a>
								</td>
							</tr>
							<tr>
								<td>
									<a href="/<?=mapping('product')?>/product_detail">
										<div class="price">
											<span class="state">예약중</span>
											৳60
										</div>
									</a>
								</td>
							</tr>
							<tr>
								<td style="vertical-align:bottom">
									<ul class="info_ul">
										<li>
											<img src="/images/icons-comment.png" alt="">
											51
										</li>
										<li onclick="wish_btn('like_1')">
											<span class="like like_1"></span>
											9
										</li>
										<li>
											<img src="/images/i_manner1.png" alt="">
											88
										</li>
										<li>
											<img src="/images/i_manner2.png" alt="">
											1
										</li>
									</ul>
								</td>
							</tr>
						</table>
					</li>
					<li>
							<table class="tbl_4">
							<colgroup>
								<col width="125">
							</colgroup>
							<tr>
								<th rowspan="6">
									<a href="/<?=mapping('product')?>/product_detail">
										<div class="img_box thum">
											<img src="/p_images/s1.jpg" onerror="this.src='/images/default_img.png'">
										</div>
									</a>
								</th>
							</tr>
							<tr>
								<td>
									<a href="/<?=mapping('product')?>/product_detail">
										<div class="title">개봉전 샤넬지갑 팔아요. 정품 인증서 가지고 있습니다!</div>
									</a>
								</td>
							</tr>
							<tr>
								<td>
									<a href="/<?=mapping('product')?>/product_detail">
										<div class="place">236/C-237/A, Dhaka 1208 방글라데시</div>
									</a>
								</td>
							</tr>
							<tr>
								<td>
									<a href="/<?=mapping('product')?>/product_detail">
										<div class="s_info">1분 전 · 나와의 거리 15km</div>
									</a>
								</td>
							</tr>
							<tr>
								<td>
									<a href="/<?=mapping('product')?>/product_detail">
										<div class="price">
											<span class="state comp">거래완료</span>
											৳60
										</div>
									</a>
								</td>
							</tr>
							<tr>
								<td style="vertical-align:bottom">
									<ul class="info_ul">
										<li>
											<img src="/images/icons-comment.png" alt="">
											51
										</li>
										<li onclick="wish_btn('like_1')">
											<span class="like like_1"></span>
											9
										</li>
										<li>
											<img src="/images/i_manner1.png" alt="">
											88
										</li>
										<li>
											<img src="/images/i_manner2.png" alt="">
											1
										</li>
									</ul>
								</td>
							</tr>
						</table>
					</li>
				</ul>
		  </div>
		  <!-- 탭 영역 1 : e -->
		  <!-- 탭 영역 2 : s -->
		  <div class="">
				<div class="inner_wrap">
					<!-- no data:s -->
					<div class="no_datas">
						<img src="/images/Icons-search-gray.png" alt="">
						<p>검색 결과가 없습니다.</p>
					</div>
					<!-- no data:e -->
					<div class="font_gray_6 mt30">인기 검색어</div>
					<ul class="best_keyword_ul">
						<li>
							<a href="javascript:void(0)">부동산</a>
						</li>
					</ul>
				</div>
				<!-- 커뮤니티 검색결과 :s -->
				<ul class="community_ul mb70">
					<li>
						<table class="tbl_1">
							<colgroup>
								<col width="48px">
								<col width="*">
								<col width="25px">
							</colgroup>
							<tr>
								<td>
									<div class="img_box">
										<img src="/p_images/1sp1.png" onerror="this.src='/images/default_user.png'">
									</div>
								</td>
								<td class="normal_bold">
			  					মুছে ফেলুন
									<span class="date">
										1일 전
									</span>
								</td>
								<th>
									<img src="/images/icons-dark-more.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')">
								</th>
							</tr>
						</table>
						<div class="swiper-container main_visual">
			        <img src="/images/tag_best.png" alt="best" class="mark_best">
					    <div class="swiper-wrapper">
					      <div class="swiper-slide">
			            <a href="javascript:void(0)" class="img_box"><img src="/p_images/s2.jpg"></a>
			          </div>
					      <div class="swiper-slide">
			            <a href="javascript:void(0)" class="img_box"><img src="/p_images/s3.jpg"></a>
			          </div>
					      <div class="swiper-slide">
			            <a href="javascript:void(0)" class="img_box"><img src="/p_images/s1.jpg"></a>
			          </div>
					    </div>
					    <!-- Add Scrollbar -->
			        <div class="swiper-pagination"></div>

					  </div>

			      <table class="tbl_2">
			        <tr>
			          <td>
			            <span class="toggle_scrap scrap_2" src="/images/bookmark_off.png" onclick="wish_btn('scrap_2')"></span>
			            28
			          </td>
			          <th>
			            <a href="/<?=mapping('community')?>/community_detail"><img src="/images/icon-black-chat.png" alt="">
			            59</a>
			            <span class="toggle_like like_4" src="/images/i_like_off.png" onclick="wish_btn('like_4')"></span>
			            1
			          </th>
			        </tr>
			      </table>
			      <div class="inner_wrap">
			        <ul class="tag_ul row">
			          <li>
			            해시태그
			          </li>
			          <li>
			            새것
			          </li>
			          <li>
			            입생로랑
			          </li>
			        </ul>
			        <p class="contents">
			          <span class="txt">আকাশে তারুণ্যের গর্জন ঘুরে বেড়ায়, আর বক্ষের জন্য,
			            <!-- এটি একটি সিম্ফনি। বড় জনতা কি খুশি এবং যীশু ফুঁ দিচ্ছেন? স্বর্গ ঝলমল করছে, গতিশীলতা। দৃশ্যমান তৈলটি জীবনের প্রজ্ঞার সমান, এবং এটি বসন্তের হাওয়া যা তুষারময় পাহাড়ে মনোযোগ আকর্ষণ করে। তারুণ্য কি করবে রক্ত ​​পচে না যাওয়া পর্যন্ত নষ্ট হয় না। বাঁচাতে এবং না ধরে রাখার জন্য। এটি তরুণদের গান, শক্তিশালী, এবং শ্রোতার আদর্শ। এটাই হৃদয়ের জীবন। নিজেকে বিস্তৃত করার জন্য ঘুরে বেড়ানো,  -->
			            এটি উপলব্ধিকে ধরে রাখার জন্য প্রচুর পরিমাণে সার দেয় এবং ফোঁড়া হয়। যা থাকে তা হল ফুটন্ত পয়েন্ট যেখানে সানিয়া একটি জায়গায় পরিণত হয়।</span>
			          <span class="more_view">전체보기</span>
			        </p>
			      </div>
					</li>
					<li>
						<table class="tbl_1">
							<colgroup>
								<col width="48px">
								<col width="*">
								<col width="25px">
							</colgroup>
							<tr>
								<td>
									<div class="img_box">
										<img src="/p_images/p1.png" alt="">
									</div>
								</td>
								<td class="normal_bold">
			  					মুছে ফেলুন
									<span class="date">
										1일 전
									</span>
								</td>
								<th>
									<img src="/images/icons-dark-more.png" alt="더보기" class="btn_more" onclick="modal_open_slide('more')">
								</th>
							</tr>
						</table>
			      <table class="tbl_2">
			        <tr>
			          <td>
			            <span class="toggle_scrap scrap_1" src="/images/bookmark_off.png" onclick="wish_btn('scrap_1')"></span>
			            28
			          </td>
			          <th>
			            <a href="/<?=mapping('community')?>/community_detail"><img src="/images/icon-black-chat.png" alt="">
			            59</a>
			            <span class="toggle_like like_2" src="/images/i_like_off.png" onclick="wish_btn('like_2')"></span>
			            1
			          </th>
			        </tr>
			      </table>
			      <div class="inner_wrap">
			        <ul class="tag_ul row">
			          <li>
			            해시태그
			          </li>
			          <li>
			            새것
			          </li>
			          <li>
			            입생로랑
			          </li>
			        </ul>
			        <p class="contents">
			          <span class="txt">강남, 삼청동 유명 맛집 힛더스팟의 베이커리 파트와 이탈리아 100년 전통의 파브리의 콜라보로
			          유럽명가의 빵과 음료를 한국에서 직접 느낄 수 있는 힛더</span>
			          <span class="more_view">전체보기</span>
			        </p>
			      </div>
					</li>
				</ul>
		  </div>
		  <!-- 탭 영역 2 : e -->
		</div>
	</div>

</div>
<script>
// search_input_delete
$(function(){
	$('.btn_delete').css('display','none');
	$('.btn_delete').click(function(){
		$('.search_val').val('');
		$('.btn_delete').css('display','none');
	});
});
$(".search_val").on("change keyup paste", function() {
  if($(this).val() == '') {
    $('.btn_delete').css('display','none');
  } else {
    $('.btn_delete').css('display','block');
  }
});

// main_visual
var main_visual = new Swiper('.main_visual', {
	slidesPerView: 1,
	slidesPerGroup:1,
	touchReleaseOnEdges:true,
  pagination: {
    el: ".main_visual .swiper-pagination",
    dynamicBullets: true,
  },
});
$(function() {
	// 탭ui
	$(".tab_area_wrap > div").hide();
	$(".tab_area_wrap > div").first().show();
	$(".tab_toggle_menu li").click(function() {
		var list = $(this).index();
		$(".tab_toggle_menu li").removeClass("active");
		$(this).addClass("active");

		$(".tab_area_wrap > div").hide();
		$(".tab_area_wrap > div").eq(list).show();
	});
});

// 위시리스트 토글버튼
function wish_btn(element){
  if($('.'+ element).hasClass("on")){
    $('.'+ element).removeClass("on");
  } else {
    $('.'+ element).addClass("on");
  }
}

$(function(){
  // 전체보기
  $('.more_view').click(function(){
    $(this).siblings('.txt').css('-webkit-line-clamp','initial');
    $(this).css('display','none');
  })

})
</script>

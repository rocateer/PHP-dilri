<div class="search_wrap">
	<input type="text" placeholder="검색어를 입력하세요.">
	<a href="/<?=mapping('search')?>/searching"><img src="/images/headn_search.png" alt="search" class="btn_search"></a>
</div>
<div class="search_tab footer_margin">
	<ul class="tab_toggle_menu clearfix">
	  <li class="">
	    <a href="/<?=mapping('search')?>/search_list">중고거래</a>
	  </li>
	  <li class="active">
	    <a href="/<?=mapping('search')?>/search_comm_list">커뮤니티</a>
	  </li>
	</ul>
	<div class="tab_area_wrap">
	  <div class="row">
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
	</div>
</div>
<script type="text/javascript">

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

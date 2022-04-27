<!-- header : s -->
<header>
  <h1>마이페이지</h1>
	<a class="btn_cate" href="<?=mapping('setting')?>">
		<img src="/images/head_btn_setting.png" alt="category">
	</a>
	<a class="btn_alarm" href="<?=mapping('alarm')?>">
		<img src="/images/head_btn_alram.png" alt="알림">
	</a>
</header>
<!-- header : e -->

<div class="body footer_margin row">
	<div class="mypage_top">
		<table class="tbl_mypage">
			<colgroup>
				<col width="60">
				<col width="*">
			</colgroup>
			<tr>
				<th rowspan="2">
					<div class="img_box">
						<img src="/p_images/1p1.png" onerror="this.src='/images/default_user.png'">
					</div>
				</th>
				<td>
					<h5 class="inline_block">김딜리</h5>
					<a href="/<?=mapping('mypage')?>/point_list"><h4 class="inline_block f_right">1,000 P</h4></a>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="fs_12 font_gray_9">dd@dsdfdsf</div>
				</td>
			</tr>
		</table>
	</div>
  <div class="inner_wrap">
    <div class="btn_full_thin btn_gray_line2 mt15">
      <a href="/<?=mapping('badge')?>">보유 배지 보기</a>
    </div>
  </div>
  <ul class="mypage_icons_ul">
    <li>
      <a href="/<?=mapping('eval')?>/history_list">
        <img src="/images/i_tree.png">
        160
      </a>
    </li>
    <li>
      <a href="/<?=mapping('eval')?>/history_list">
        <img src="/images/i_manner1_b.png">
        160
      </a>
    </li>
    <li>
      <a href="/<?=mapping('eval')?>/history_list">
        <img src="/images/i_manner2_b.png">
        160
      </a>
    </li>
  </ul>
  <div class="tab_mypage">
    <ul class="tab_toggle_menu clearfix">
      <li class="active">
        <a href="javascript:void(0)">판매 내역</a>
      </li>
      <li>
        <a href="javascript:void(0)">구매 내역</a>
      </li>
      <li>
        <a href="javascript:void(0)">커뮤니티</a>
      </li>
      <li>
        <a href="javascript:void(0)">찜(1.0k)</a>
      </li>
    </ul>
    <div class="tab_area_wrap">
      <!-- 탭 영역 1 : s -->
      <div class="">

        <div class="no_datas">
          <img src="/images/Icons-search-gray_p.png" alt="">
          <p>판매 중인 상품이 없습니다.<br>판매할 상품을 등록해 보세요!</p>
        </div>
        <!-- <div class="no_datas">
          <img src="/images/Icons-search-gray_p.png" alt="">
          <p>거래 완료된 상품이 없습니다.</p>
        </div> -->
        <ul class="mypage_filter_slt_ul">
          <li class="active">
            판매 중(3)
          </li>
          <li>
            거래 완료(5)
          </li>
        </ul>
        <ul class="home_ul">
          <li>
            <div class="blind">관리자에 의해 블라인드 게시글입니다.<br>관리자에게 문의하세요.</div>
          </li>
          <li>
  					<table class="tbl_4">
    					<colgroup>
    						<col width="125">
    					</colgroup>
    					<tr>
    						<th rowspan="6">
                  <a href="<?=mapping('product')?>/product_detail">
      							<div class="img_box thum">
      								<img src="/p_images/s1.jpg" onerror="this.src='/images/default_img.png'">
      							</div>
                  </a>
    						</th>
    					</tr>
    					<tr>
    						<td>
                  <a href="<?=mapping('product')?>/product_detail">
      							<div class="title">개봉전 샤넬지갑 팔아요. 정품 인증서 가지고 있습니다!</div>
                  </a>
    						</td>
    					</tr>
    					<tr>
    						<td>
                  <a href="<?=mapping('product')?>/product_detail">
      							<div class="place">236/C-237/A, Dhaka 1208 방글라데시</div>
                  </a>
    						</td>
    					</tr>
    					<tr>
    						<td>
                  <a href="<?=mapping('product')?>/product_detail">
      							<div class="s_info">1분 전</div>
                  </a>
    						</td>
    					</tr>
    					<tr>
    						<td>
                  <a href="<?=mapping('product')?>/product_detail">
      							<div class="price">
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
    									<span class="like like_1 on"></span>
    									9
    								</li>
    							</ul>
    						</td>
    					</tr>
    				</table>
    			</li>
          <!-- 거래완료 : ↓ -->
          <li>
  					<table class="tbl_4">
    					<colgroup>
    						<col width="125">
    					</colgroup>
    					<tr>
    						<th rowspan="6">
                  <a href="<?=mapping('product')?>/product_detail">
      							<div class="img_box thum">
      								<img src="/p_images/s1.jpg" onerror="this.src='/images/default_img.png'">
      							</div>
                  </a>
    						</th>
    					</tr>
    					<tr>
    						<td>
                  <a href="<?=mapping('product')?>/product_detail">
      							<div class="title">개봉전 샤넬지갑 팔아요. 정품 인증서 가지고 있습니다!</div>
                  </a>
    						</td>
    					</tr>
    					<tr>
    						<td>
                  <a href="<?=mapping('product')?>/product_detail">
      							<div class="place">236/C-237/A, Dhaka 1208 방글라데시</div>
                  </a>
    						</td>
    					</tr>
    					<tr>
    						<td>
                  <a href="<?=mapping('product')?>/product_detail">
      							<div class="s_info">1분 전</div>
                  </a>
    						</td>
    					</tr>
    					<tr>
    						<td>
                  <a href="<?=mapping('product')?>/product_detail">
      							<div class="price">
      							  무료나눔
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
                    <li onclick="wish_btn('like_2')">
    									<span class="like like_2"></span>
    									9
    								</li>
    							</ul>
    						</td>
    					</tr>
    				</table>
            <div class="btn_full_thin btn_point mt12">
              <a href="/<?=mapping('eval')?>/free_sell_reg">평가하기</a>
            </div>
    			</li>
        </ul>

      </div>
      <!-- 탭 영역 1 : e -->
      <!-- 탭 영역 2 : s -->
      <div class="inner_wrap">
        <div class="no_datas">
          <img src="/images/Icons-search-gray_p.png" alt="">
          <p>구매한 내역이 없습니다.</p>
        </div>
        <ul class="home_ul mb70">
    			<li>
  					<table class="tbl_4">
    					<colgroup>
    						<col width="125">
    					</colgroup>
    					<tr>
    						<th rowspan="6">
    							<a href="<?=mapping('product')?>/product_detail">
    								<div class="img_box thum">
    									<img src="/p_images/s1.jpg" onerror="this.src='/images/default_img.png'">
    								</div>
    							</a>
    						</th>
    					</tr>
    					<tr>
    						<td>
    							<a href="<?=mapping('product')?>/product_detail">
    								<div class="title">개봉전 샤넬지갑 팔아요. 정품 인증서 가지고 있습니다!</div>
    							</a>
    						</td>
    					</tr>
    					<tr>
    						<td>
    							<a href="<?=mapping('product')?>/product_detail">
    								<div class="place">236/C-237/A, Dhaka 1208 방글라데시</div>
    							</a>
    						</td>
    					</tr>
    					<tr>
    						<td>
    							<a href="<?=mapping('product')?>/product_detail">
    								<div class="s_info">1분 전 · 나와의 거리 15km</div>
    							</a>
    						</td>
    					</tr>
    					<tr>
    						<td>
    							<a href="<?=mapping('product')?>/product_detail">
    								<div class="price">
    									무료나눔
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
    								<li onclick="wish_btn('like_3')">
    									<span class="like like_3"></span>
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
            <div class="btn_full_thin btn_point mt12">
              <a href="/<?=mapping('eval')?>/free_buy_reg">평가하기</a>
            </div>
    			</li>
    			<li>
  					<table class="tbl_4">
    					<colgroup>
    						<col width="125">
    					</colgroup>
    					<tr>
    						<th rowspan="6">
    							<a href="<?=mapping('product')?>/product_detail">
    								<div class="img_box thum">
    									<img src="/p_images/s1.jpg" onerror="this.src='/images/default_img.png'">
    								</div>
    							</a>
    						</th>
    					</tr>
    					<tr>
    						<td>
    							<a href="<?=mapping('product')?>/product_detail">
    								<div class="title">개봉전 샤넬지갑 팔아요. 정품 인증서 가지고 있습니다!</div>
    							</a>
    						</td>
    					</tr>
    					<tr>
    						<td>
    							<a href="<?=mapping('product')?>/product_detail">
    								<div class="place">236/C-237/A, Dhaka 1208 방글라데시</div>
    							</a>
    						</td>
    					</tr>
    					<tr>
    						<td>
    							<a href="<?=mapping('product')?>/product_detail">
    								<div class="s_info">1분 전 · 나와의 거리 15km</div>
    							</a>
    						</td>
    					</tr>
    					<tr>
    						<td>
    							<a href="<?=mapping('product')?>/product_detail">
    								<div class="price">
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
    								<li onclick="wish_btn('like_4')">
    									<span class="like like_4"></span>
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
            <div class="btn_full_thin btn_point mt12">
              <a href="/<?=mapping('eval')?>/genelar_list">평가하기</a>
            </div>
    			</li>
        </ul>
      </div>
      <!-- 탭 영역 2 : e -->
      <!-- 탭 영역 3 : s -->
      <div class="">
        <div class="inner_wrap">
          <ul class="mypage_filter_slt_ul mt16">
            <li class="active">
              내 게시글(99)
            </li>
            <li>
              내 댓글(99)
            </li>
            <li>
              스크랩(2)
            </li>
          </ul>
        </div>

        <div class="no_datas">
          <img src="/images/Icons-search-gray_b.png" alt="">
          <p>등록한 게시글이 없습니다.</p>
        </div>
        <div class="no_datas">
          <img src="/images/Icons-search-gray_c.png" alt="">
          <p>등록한 댓글이 없습니다.</p>
        </div>
        <div class="no_datas">
          <img src="/images/Icons-search-gray_s.png" alt="">
          <p>등록한 게시글이 없습니다.</p>
        </div>

        <a href="/<?=mapping('community')?>/community_reg"><img src="/images/floating_btn.png" alt="reg" class="btn_float"></a>
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
          <li class="inner_wrap">
            <div class="blind">관리자에 의해 블라인드 게시글입니다.<br>관리자에게 문의하세요.</div>
          </li>
        </ul>
        <!-- 내댓글:s -->
        <ul class="community_reply_ul">
          <li>
            <a href="/<?=mapping('community')?>/community_detail">
              <span class="img_box">
                <img src="/p_images/s1.jpg" alt="">
              </span>
              <div class="txt"> 이사 온 지 얼마 안 됐는데 담비한테 친구들이 생겨서 다행이에요 매주 모이면 좋겠어요!</div>
              <div class="date">2020.01.01. 00:00</div>
            </a>
          </li>
          <li>
            <a href="/<?=mapping('community')?>/community_detail">
              <span class="img_box">
                <img src="/p_images/s1.jpg" alt="">
              </span>
              <div class="txt"><span class="nickname">@님과함께</span> 이사 온 지 얼마 안 됐는데 담비한테 친구들이 생겨서 다행이에요 매주 모이면 좋겠어요!</div>
              <div class="date">2020.01.01. 00:00</div>
            </a>
          </li>
        </ul>
        <!-- 내댓글:e -->
        <!-- 스크랩:e -->
        <ul class="community_ul">
      		<li>
      			<table class="tbl_1">
      				<colgroup>
      					<col width="48px">
      					<col width="*">
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
                  <span class="toggle_scrap scrap_6 on" src="/images/bookmark_off.png" onclick="wish_btn('scrap_6')"></span>
                  28
                </td>
                <th>
                  <a href="/<?=mapping('community')?>/community_detail"><img src="/images/icon-black-chat.png" alt="">
                  59</a>
                  <span class="toggle_like like_3" src="/images/i_like_off.png" onclick="wish_btn('like_3')"></span>
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
        </ul>
        <!-- 스크랩:e -->
      </div>
      <!-- 탭 영역 3 : e -->
      <!-- 탭 영역 4 : s -->
      <div class="inner_wrap">
        <div class="no_datas">
          <img src="/images/Icons-search-gray_h.png" alt="">
          <p>찜한 목록이 없습니다.</p>
        </div>
        <ul class="home_ul">
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
    								<li onclick="wish_btn('like_5')">
    									<span class="like like_5"></span>
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
    								<li onclick="wish_btn('like_6')">
    									<span class="like like_6"></span>
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
      <!-- 탭 영역 4 : e -->
    </div>
  </div>
</div>
<div class="modal_more">
  <ul class="more_ul">
    <li>
      <a href="/<?=mapping('community')?>/community_mod">수정</a>
    </li>
    <li class="close">
      <a href="javascript:void(0)" onclick="modal_close_slide('more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_overlay md_overlay_more" onclick="modal_close_slide('more');"></div>

<script type="text/javascript">
// 더보기 슬라이드
$(function(){
  let more_view_height = $('.modal_more').outerHeight();
  $('.modal_more').css('bottom',-more_view_height);
})
function modal_open_slide(e){
  $(".md_overlay_" + 'more').css("visibility", "visible").animate({opacity: 1}, 100);
  $(".modal_" + 'more').css({bottom: "0"});
  $.lockBody();
}

function modal_close_slide(e){
  $(".md_overlay_" + 'more').css("visibility", "hidden").animate({opacity: 0}, 100);
  $(".modal_" + 'more').css({bottom: "-400px"});
  $.unlockBody();
}

// 탭메뉴 토글기능
  $(document).ready(function() {
    $(".tab_area_wrap > div").hide();
    $(".tab_area_wrap > div").first().show();
    $(".tab_toggle_menu li").click(function() {
      var list = $(this).index();
      $(".tab_toggle_menu li").removeClass("active");
      $(this).addClass("active");

      $(".tab_area_wrap > div").hide();
      $(".tab_area_wrap > div").eq(list).show();
    });

    // 전체보기
    $('.more_view').click(function(){
      $(this).siblings('.txt').css('-webkit-line-clamp','initial');
      $(this).css('display','none');
    })

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

  // 위시리스트 토글버튼
  function wish_btn(element){
  	if($('.'+ element).hasClass("on")){
  		$('.'+ element).removeClass("on");
  	} else {
  		$('.'+ element).addClass("on");
  	}
  }
</script>

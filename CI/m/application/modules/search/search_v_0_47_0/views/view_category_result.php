<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
	<h1>꽃</h1>
</header>
<!-- header : e -->
<div class="body inner_wrap">
	<div class="w_100 row mt20">
		<ul class="category_tag_ul">
			<li>
				식물
			</li>
			<li>
				৳10,000 ~ ৳20,000
			</li>
			<li>
				5km
			</li>
		</ul>
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
						<a href="">필터 적용</a>
					</span>
				</div>
			</div>
		</div>
		<!-- modal : e -->
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

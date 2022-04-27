<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
</header>
<!-- header : e -->
<div class="body vh_wrap">
	<div class="vh_body">
		<div class="inner_wrap mt16">
			<table class="tbl_product_info">
				<colgroup>
					<col width="62">
					<col width="*">
				</colgroup>
				<tr>
					<th rowspan="2">
						<div class="img_box">
							<img src="/p_images/s1.jpg" onerror="this.src='/images/default_img.png'">
						</div>
					</th>
					<td>
						<div class="fs_16">입생로랑 2020 S/S 제품 입니다.</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="date">01.09.2021</div>
					</td>
				</tr>
			</table>
		</div>
		<hr class="mt16">
		<div class="inner_wrap">
			<h2 class="mt20 mb10">예약을 거시겠습니까?</h2>
			<div class="font_gray_6">예약 대상자를 선택하여 주세요.</div>
			<ul class="reserve_ul">
				<li>
					<table class="tbl_reserve_slt">
						<colgroup>
							<col width="65px">
							<col width="*">
							<col width="25px">
						</colgroup>
						<tr>
							<th rowspan="2">
								<div class="img_box">
									<img src="/p_images/s2.jpg" onerror="this.src='/images/default_user.png'">
								</div>
							</th>
							<td>
								<h6>무함마드</h6>
							</td>
							<td rowspan="2">
								<input type="radio" name="rdo_1" id="rdo_1_1">
								<label for="rdo_1_1"><span></span></label>
							</td>
						</tr>
						<tr>
							<td>
								<div class="last_time">마지막 대화 18초 전</div>
							</td>
						</tr>
					</table>
				</li>
				<li>
					<table class="tbl_reserve_slt">
						<colgroup>
							<col width="65px">
							<col width="*">
							<col width="25px">
						</colgroup>
						<tr>
							<th rowspan="2">
								<div class="img_box">
									<img src="/p_images/s12.jpg" onerror="this.src='/images/default_user.png'">
								</div>
							</th>
							<td>
								<h6>무함마드</h6>
							</td>
							<td rowspan="2">
								<input type="radio" name="rdo_1" id="rdo_1_2">
								<label for="rdo_1_2"><span></span></label>
							</td>
						</tr>
						<tr>
							<td>
								<div class="last_time">마지막 대화 18초 전</div>
							</td>
						</tr>
					</table>
				</li>
			</ul>
		</div>
	</div>
	<div class="vh_footer btn_full_weight btn_point mt30 mb30">
		<a href="/<?=mapping('product')?>/product_detail">예약완료</a>
	</div>
</div>

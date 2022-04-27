<!-- header : s -->
<header>
	<div class="place_slt" onclick="modal_open('place_slt')">
		HOME
	</div>
	<a class="btn_cate" href="javascript:void(0)" onclick="modal_open('category')">
		<img src="/images/head_btn_list.png" alt="category">
	</a>
	<a class="btn_alarm" href="<?=mapping('alarm')?>">
		<img src="/images/head_btn_alram.png" alt="알림">
	</a>
</header>
<!-- header : e -->

<div class="modal modal_place_slt">
  <div class="" onclick="event.stopPropagation();">
    <ul class="place_slt_ul scroll_none">
      <li>
        현재 내 위치
      </li>
			<li class="active">
				HOME <img src="/images/i_s_delete.png" alt="x" class="btn_delete">
			</li>
			<li>
				OFFICE <img src="/images/i_s_delete.png" alt="x" class="btn_delete">
			</li>
			<li>
				MOM <img src="/images/i_s_delete.png" alt="x" class="btn_delete">
			</li>
    </ul>
    <button class="btn_add" onclick="modal_close('place_slt');modal_open('place_add');">ADD <img src="/images/i_plus.png" alt="+"></button>
  </div>
</div>
<div class="md_overlay md_overlay_place_slt" onclick="javascript:modal_close('place_slt')"></div>

<div class="modal modal_place_add">
  <div class="" onclick="event.stopPropagation();">
		<!-- <header>
		  <a class="btn_back" href="javascript:void(0)" onclick="modal_close('place_add')">
				<img src="/images/head_btn_close.png" alt="닫기">
			</a>
			<h1>위치 지정</h1>
		</header> -->
		<div id="map_ma" style="width:100%;min-height:calc(100vh - 298px)"></div>
		<!-- <div class="reg_box" id="reg_box">
			<h5>서울특별시 금천구 가산디지털 1로 145길<br>금호아파트</h5>
			<input type="text" placeholder="노출될 이름을 입력해 주세요.">
			<select name="" id="">
				<option value="">1km</option>
				<option value="">2km</option>
				<option value="">3km</option>
				<option value="">4km</option>
				<option value="">5km</option>
				<option value="" selected>6km</option>
				<option value="">7km</option>
				<option value="">8km</option>
				<option value="">9km</option>
				<option value="">10km</option>
			</select>
			<div class="btn_full_weight btn_point mt30">
				<a href="">등록</a>
			</div>
		</div> -->
  </div>
</div>

<style media="screen">
a[href^="http://maps.google.com/maps"]{display:none !important} a[href^="https://maps.google.com/maps"]{display:none !important} .gmnoprint a, .gmnoprint span, .gm-style-cc { display:none; } .gmnoprint div { background:none !important; }
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDjSc91_XZD01ikBRSKOB5u-aGsISuciV0" ></script>
<script type="text/javascript">
$(document).ready(function() {

	var myLatlng = new google.maps.LatLng(35.837143,128.558612); // 위치값 위도 경도
	var Y_point			= 35.837143;		// Y 좌표
	var X_point			= 128.558612;		// X 좌표
	var zoomLevel		= 18;				// 지도의 확대 레벨 : 숫자가 클수록 확대정도가 큼
	var markerTitle		= "대구광역시";		// 현재 위치 마커에 마우스를 오버을때 나타나는 정보

	var myIcon = new google.maps.MarkerImage("/images/i_map_active.png", new google.maps.Size(43,52), google.maps.Point(21.5, 52), google.maps.Point(21.5, 52), new google.maps.Size(43,56));
	var myLatlng = new google.maps.LatLng(Y_point, X_point);
	var mapOptions = {
					zoom: zoomLevel,
					disableDefaultUI: true,
					setMapToolbarEnalbed:false,
					center: myLatlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
	var map = new google.maps.Map(document.getElementById('map_ma'), mapOptions);
	var marker = new google.maps.Marker({
										position: myLatlng,
										map: map,
										title: markerTitle,
										icon: myIcon,
										draggable: true,
	});

	google.maps.event.addListener(marker, 'click', function() {

	});
});
</script>
<!-- modal : s -->
<div class="modal modal_category">
  <header>
  	<h1>카테고리</h1>
	  <a class="btn_back" href="javascript:void(0)" onclick="modal_close('category')">
			<img src="/images/head_btn_close.png" alt="닫기">
		</a>
  </header>
	<div class="body inner_wrap">
		<ul class="category_ul">
			<li>
				<a href="<?=mapping('search')?>/category_result">
					<img src="/images/category_1.png" alt="">
				</a>
			</li>
			<li>
				<a href="<?=mapping('search')?>/category_result">
					<img src="/images/category_2.png" alt="">
				</a>
			</li>
			<li>
				<a href="<?=mapping('search')?>/category_result">
					<img src="/images/category_3.png" alt="">
				</a>
			</li>
			<li>
				<a href="<?=mapping('search')?>/category_result">
					<img src="/images/category_4.png" alt="">
				</a>
			</li>
			<li>
				<a href="<?=mapping('search')?>/category_result">
					<img src="/images/category_5.png" alt="">
				</a>
			</li>
			<li>
				<a href="<?=mapping('search')?>/category_result">
					<img src="/images/category_6.png" alt="">
				</a>
			</li>
			<li>
				<a href="<?=mapping('search')?>/category_result">
					<img src="/images/category_7.png" alt="">
				</a>
			</li>
			<li>
				<a href="<?=mapping('search')?>/category_result">
					<img src="/images/category_8.png" alt="">
				</a>
			</li>
		</ul>
	</div>
</div>
<!-- modal : e -->
<div class="body footer_margin">
	<div class="notice_line">
		<span>[공지]</span>
		플랫폼 업데이트 1.25.ver 업데이트 오류 수정
	</div>
	<a href="" class="bn_full img_box" target="_blank">
		<img src="/p_images/p2.png" alt="">
	</a>
	<div class="no_datas mb30">
		<img src="/images/Icons-search-gray.png" alt="">
		<p>주변 상품을 찾을 수 없습니다.<br>지역과 검색 반경을 변경하여<br>다시 검색해 보세요.</p>
	</div>
	<div class="inner_wrap row">
		<ul class="home_ul mb70">
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
								<img src="/p_images/dd.jpg" onerror="this.src='/images/default_img.png'">
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
				<div class="blind">
					관리자에 의해 제재된 사용자의 게시글입니다.
				</div>
			</li>
		</ul>
	</div>
</div>
<a href="/<?=mapping('product')?>/product_reg"><img src="/images/floating_btn.png" alt="reg" class="btn_float"></a>
<script type="text/javascript">
// 위시리스트 토글버튼
function wish_btn(element){
	if($('.'+ element).hasClass("on")){
		$('.'+ element).removeClass("on");
	} else {
		$('.'+ element).addClass("on");
	}
}

</script>

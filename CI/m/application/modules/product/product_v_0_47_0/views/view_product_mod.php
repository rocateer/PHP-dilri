<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
	<h1>상품수정</h1>
</header>
<!-- header : e -->
<div class="body row ">
	<div class="inner_wrap">
		<div class="label">카테고리 <span class="essential"> *</span></div>
		<select name="" id="">
			<option value="">일렉트로닉스</option>
		</select>
		<div class="label">제목 <span class="essential"> *</span></div>
		<input type="text" name="" value="">
		<div class="label">가격 <span class="essential"> *</span></div>
		<div class="price_wrap">
	    <input type="checkbox" id="chk_1_1" name="chk_1" checked>
	    <label for="chk_1_1"><span></span>무료나눔</label>
	    <span class="unit">৳</span>
	    <input type="number" authcomplete="off" id="price">
	  </div>
	</div>
	<div class="label inner_wrap">사진</div>
	<div class="x_scroll_img_reg">
    <div class="cnt_num">0/10</div>
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
		<textarea style="height:300px">날씨가 따뜻해지는 게 느껴지네요. 조금만 있으면 벚꽃도 필 것 같네요</textarea>
		<div class="label">해시태그 <span class="essential">*</span></div>
		<p class="font_gray_9 mb8">입력 후 사이띄게를 입력하시면 태그가 등록됩니다.</p>

		<input class="form-control" type="text" name="tags" id="tags" value="">
    <div class="label">거래위치 <span class="essential"> *</span></div>
    <div class="btn_slt_place font_gray_3" onclick="modal_open('place_slt')">
    	HOME
    </div>
		<h5 class="mt16">서울특별시 금천구 가산디지털 1로 145길 금호아파트</h5>
		<div class="modal modal_place_slt center">
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
				<header>
				  <a class="btn_back" href="javascript:void(0)" onclick="modal_close('place_add')">
						<img src="/images/head_btn_close.png" alt="닫기">
					</a>
					<h1>위치 지정</h1>
				</header>
				<div id="map_ma" style="width:100%;height:calc(100vh - 298px)"></div>
				<div class="reg_box" id="reg_box">
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
				</div>
		  </div>
		</div>

		<style media="screen">
		a[href^="http://maps.google.com/maps"]{display:none !important} a[href^="https://maps.google.com/maps"]{display:none !important} .gmnoprint a, .gmnoprint span, .gm-style-cc { display:none; } .gmnoprint div { background:none !important; }
		</style>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDn2FK30f7459i8j4PDH8PBmJav9WWKKHc" ></script>
		<script type="text/javascript">
		$(document).ready(function() {
			console.log($('#reg_box')+"?");
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


		<div class="btn_full_weight btn_point mt30 mb30">
			<a href="">수정하기</a>
		</div>
	</div>
</div>
<script>
$(function(){
	var tagData = new Array();
	$('#tags').tagEditor({
		initialTags: [
		  '태그'
		],
		placeholder : "태그를 입력하세요.",
		autocomplete: {
				delay: 10, // show suggestions immediately
				position: { collision: 'flip' }, // automatic menu position up/down
				source: tagData
		},
		forceLowercase: false
	});

	if($('#chk_1_1').prop('checked')){
		$('#price').val('');
		$('#price').attr('disabled','disabled');
	}else{
		$('#price').attr('disabled',false);
	}
	$("#chk_1_1").on('click', function() {
		if($('#chk_1_1').prop('checked')){
			$('#price').attr('disabled','disabled');
			$('#price').val('');
		}else{
			$('#price').attr('disabled',false);
		}
	});
});

</script>

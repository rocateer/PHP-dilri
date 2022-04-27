<!-- header : s -->
<header>
	<div class="place_slt" onclick="modal_open('place_slt')" id="my_location_title">
		<?=$my_location!='0'?$member_detail->title:lang("lang_main_00120","현재 내 위치")?>
	</div>
	<a class="btn_cate" href="javascript:void(0)" onclick="modal_open('category')">
		<img src="/images/head_btn_list.png" alt="category">
	</a>
	<a class="btn_alarm" href="/<?=$this->nationcode.'/'.mapping('alarm')?>">
		<img src="/images/head_btn_alram.png" alt="알림">
	</a>
</header>
<!-- header : e -->

<div class="modal modal_place_slt">
  <div class="" onclick="event.stopPropagation();">
    <ul class="place_slt_ul scroll_none">
      <li class="<?='0'==$my_location?'active':''?>"  onclick="my_location_mod_up('0')">
        <?=lang("lang_main_00120","현재 내 위치")?>
      </li>
			<?foreach ($member_location_list as $row) {?>
				<li class="<?=$row->member_location_idx==$my_location?'active':''?>" id="member_location_li_<?=$row->member_location_idx ?>">
				  <span onclick="my_location_mod_up('<?=$row->member_location_idx ?>')"><?=$row->title ?></span>	 <img src="/images/i_s_delete.png" onclick="member_location_del('<?=$row->member_location_idx ?>')" alt="x" class="btn_delete">
				</li>
			<?}?>
    </ul>

		<?
		$return_url_str = "/".$this->nationcode.'/'.mapping('main');
		$fnc_str = "location.href=\'".$return_url_str."\'";
		?>
    <button class="btn_add" onclick="COM_login_check('<?=$this->member_idx?>','<?=$return_url_str?>');modal_close('place_slt');modal_open('place_add');">ADD <img src="/images/i_plus.png" alt="+"></button>
  </div>
</div>
<div class="md_overlay md_overlay_place_slt" onclick="javascript:modal_close('place_slt')"></div>

<div class="modal modal_place_add">
  <div class="" onclick="event.stopPropagation();">
		<header>
		  <a class="btn_back" href="javascript:void(0)" onclick="modal_close('place_add')">
				<img src="/images/head_btn_close.png" alt="닫기">
			</a>
			<h1><?=lang("lang_product_00169","위치 지정")?></h1>
		</header>
		<div id="map_ma" style="width:100%;height:calc(100vh - 298px)"></div>
		<div class="reg_box" id="reg_box">

			<form name="address_form" id="address_form">


				<h5 id="address_area"></h5>
				<input type="text" name="title" id="title" placeholder="<?=lang("lang_main_00771","노출될 이름을 입력해 주세요.")?>">
				<select name="addr_distance" id="addr_distance">
					<option value="1">1km</option>
					<option value="2">2km</option>
					<option value="3">3km</option>
					<option value="4">4km</option>
					<option value="5">5km</option>
					<option value="6" selected>6km</option>
					<option value="7">7km</option>
					<option value="8">8km</option>
					<option value="9">9km</option>
					<option value="10">10km</option>
				</select>

				<input type="hidden" name="member_addr"id="member_addr" value="">
				<input type="hidden" name="member_lat"id="member_lat" value="">
				<input type="hidden" name="member_lng"id="member_lng" value="">
				<div class="btn_full_weight btn_point mt30">
					<a href="javascript:void(0)" onclick="member_location_reg_in()"><?=lang("lang_community_00455","등록")?></a>
				</div>
			</form>

		</div>
  </div>
</div>

<input type="hidden" name="current_lat" id="current_lat" value="<?=!empty($member_detail->member_lat)?$member_detail->member_lat:37.5185682?>">
<input type="hidden" name="current_lng" id="current_lng" value="<?=!empty($member_detail->member_lng)?$member_detail->member_lng:127.0230294?>">
<input type="hidden" name="distance" id="distance" value="<?=!empty($member_detail->distance)?$member_detail->distance:6?>">


<style media="screen">
a[href^="http://maps.google.com/maps"]{display:none !important} a[href^="https://maps.google.com/maps"]{display:none !important} .gmnoprint a, .gmnoprint span, .gm-style-cc { display:none; } .gmnoprint div { background:none !important; }
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDjSc91_XZD01ikBRSKOB5u-aGsISuciV0" ></script>
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDn2FK30f7459i8j4PDH8PBmJav9WWKKHc" ></script> -->
<script type="text/javascript">

// alert('<?=$this->session->userdata('member_idx')?>');

$(document).ready(function(){
	<?if ('0'==$my_location) {?>
		api_request_position();
	<?}?>
  setTimeout("set_map()", 100);
});

//브릿지 ::: api 좌표가져오기
var agent ="<?=$agent?>";
function api_request_position(){
  if(agent == 'android') {
      window.rocateer.request_position();
  } else if (agent == 'ios') {
     var message = {
       "request_type" : "request_position",
    };
    window.webkit.messageHandlers.native.postMessage(message);
  }
}

// 나의위치::앱에서 받아서 실행
function api_reponse_position(api_current_lat,api_current_lng){
  $('#current_lat').val(api_current_lat);
  $('#current_lng').val(api_current_lng);
}


var myLatlng = new google.maps.LatLng(35.837143,128.558612); // 위치값 위도 경도
var Y_point			= 35.837143;		// Y 좌표
var X_point			= 128.558612;		// X 좌표
var zoomLevel		= 18;				// 지도의 확대 레벨 : 숫자가 클수록 확대정도가 큼
var markerTitle		= "대구광역시";		// 현재 위치 마커에 마우스를 오버을때 나타나는 정보

function set_map(){
	Y_point = $('#current_lat').val();
  X_point = $('#current_lng').val();

	$('#member_lat').val(Y_point);
	$('#member_lng').val(X_point);

	var geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(Y_point, X_point);
	geocoder.geocode({ 'latLng': latlng }, function (results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			if (results[1]) {
				$("#address_area").html(results[1].formatted_address);
				$("#member_addr").val(results[1].formatted_address);
			}
		}
	});

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


	// 화면 이동 시 좌표 가져오기 & 좌표->주소
	google.maps.event.addListener(map, 'center_changed', function() {
		// console.log(map.getCenter().lat());
		// console.log(map.getCenter().lng());

		var latlng = new google.maps.LatLng(map.getCenter().lat(), map.getCenter().lng());
		$("#member_lat").val(map.getCenter().lat());
		$("#member_lng").val(map.getCenter().lng());
    marker.setPosition(latlng);

		var geocoder = geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng }, function (results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[1]) {
					$("#address_area").html(results[1].formatted_address);
					$("#member_addr").val(results[1].formatted_address);
        }
      }
    });

	});

}




</script>
<!-- modal : s -->
<div class="modal modal_category">
  <header>
  	<h1><?=lang("lang_main_00121","카테고리")?></h1>
	  <a class="btn_back" href="javascript:void(0)" onclick="modal_close('category')">
			<img src="/images/head_btn_close.png" alt="닫기">
		</a>
  </header>
	<div class="body inner_wrap">
		<ul class="category_ul mt40">
			<?
			$category_arr = array();
			if (!empty($category_management_idx)) {
				$category_arr = explode(',', $category_management_idx);
			}

			foreach ($category_management_list as $row) {?>
				<li >
					<input type="checkbox" name="category_management_idx" id="category_management_idx_<?=$row->category_management_idx ?>" name="category_management_idx" value="<?=$row->category_management_idx ?>"  <?=in_array($row->category_management_idx, $category_arr)?'checked':'' ?> >
					<label for="category_management_idx_<?=$row->category_management_idx ?>"></label>
					<a href="javascript:void(0)">
						<img src="<?=$row->img_path ?>" alt="">
						<p><?=$row->category_name ?></p>
					</a>
				</li>
			<?}?>
		</ul>
	</div>
</div>
<script type="text/javascript">
	var arr = document.getElementsByName('category_management_idx');
	if (arr.length>0) {
		for (var each of arr) {
			each.addEventListener('change',function(){
				default_list_get('1');
			})
		}
	}
</script>

<!-- modal : e -->
<div class="body footer_margin">
	<? if(!empty($notice)){ ?>
		<div class="notice_line">
			<a href="/<?=$this->nationcode.'/'.mapping('notice')?>/notice_detail?notice_idx=<?=$notice->notice_idx?>"><span>[<?=lang("lang_main_00122","플랫폼 공지사항")?>]</span> <?=$notice->title?></a>
		</div>
	<? } ?>

	<? if(!empty($banner->img_path)){ ?>
      <? if($agent=="pc"){ ?>
        <a href="<?=$banner->link_url ?>" target="_blank" class="bn_full img_box" ><img src="<?=$banner->img_path?>" ></a>
      <? } else {?>
        <a href="javascript:void(0)"  onclick="api_request_external_link('<?=$banner->link_url ?>')" class="bn_full img_box"><img src="<?=$banner->img_path?>" ></a>
      <? } ?>
      <!-- <img src="/p_images/p2.png" alt=""> -->
  <? } ?>


	<div class="no_datas mb30" id="no_data">
		<img src="/images/Icons-search-gray.png" alt="">
		<p><?=lang("lang_join_00773","주변 상품을 찾을 수 없습니다.<br>지역과 검색 반경을 변경하여<br>다시 검색해 보세요.")?></p>
	</div>
	<div class="inner_wrap row">
		<ul class="home_ul mb70" id="list_ajax"></ul>
	</div>
</div>
<input type="hidden" name="total_block" id="total_block" value="1">

<?
$return_url_str = "/".$this->nationcode.'/'.mapping('product')."/product_reg";
$fnc_str = "location.href=\'".$return_url_str."\'";
?>
<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')"><img src="/images/floating_btn.png" alt="reg" class="btn_float"></a>

<script type="text/javascript">
// 위시리스트 토글버튼
function wish_btn(element){
	if($(element).hasClass("on")){
		$(element).removeClass("on");
	} else {
		$(element).addClass("on");
	}
}

$(function(){
	setTimeout("default_list_get('1')", 500);
});

var page_num=1;

$(window).scroll(function(){
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();

	if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
		page_num++;
		default_list_get(page_num);
	}
});

function default_list_get(page_num){

	var total_block = parseInt($("#total_block").val());

	var formData = {
		'page_num' : page_num,
		'current_lat' : $("#current_lat").val(),
		'current_lng' : $("#current_lng").val(),
		'distance' : $("#distance").val(),
		'category_management_idx' : get_checkbox_value('category_management_idx')
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('main')?>/main_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {

			if(page_num == 1){
				 $("#list_ajax").html(result);

			}else{
				if(total_block < page_num){
				 page_num = 1;

				}else{
				 $("#list_ajax").append(result);
				}

			}
		}
	});
}



// 최근 검색어 삭제
function member_location_del(member_location_idx){

	if (!confirm("<?=lang("lang_product_00217","삭제 하시겠습니까?")?>")) {
		return;
	}


	var formData = {
		'member_location_idx' : member_location_idx
	};

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('main')?>/member_location_del",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
				alert(result.code_msg);
      } else {
				// alert(result.code_msg);
				$("#member_location_li_"+member_location_idx).remove();
				$("#my_location_title").html("<?=lang("lang_main_00120","현재 내 위치")?>");



      }
    }
  });
}

// 주소 등록
function member_location_reg_in(){

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('main')?>/member_location_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : $("#address_form").serialize(),
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
				alert(result.code_msg);
      } else {
				alert(result.code_msg);
				location.reload();

      }
    }
  });
}

// 주소 등록
function my_location_mod_up(member_location_idx){

	var formData = {
		'member_location_idx' : member_location_idx
	};

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('main')?>/my_location_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
				alert(result.code_msg);
      } else {
				alert(result.code_msg);
				location.reload();

      }
    }
  });
}

// 중고거래 글 좋아요
function product_like_reg_in(product_idx, element){

	var formData = {
		"product_idx" : product_idx
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('product')?>/product_like_reg_in",
		type     : 'POST',
		dataType : 'json',
		async    : true,
		data     : formData,
		success: function(result){
			if(result.code == "0"){
				alert(result.code_msg);
			}else{
				// wish_btn(element);
				wish_btn($('#like_span_'+product_idx));
				$('#like_cnt_'+product_idx).html(result.like_cnt);

				// alert(result.code_msg);
				// default_list_get($('#page_num').val());
				// $('#product_table_'+product_idx).remove();
				// location.reload();
			}
		}
	});
}

// 외부링크 이동 :: 사업자 정보 확인 및 배너 링크 이동
function api_request_external_link(url){
	console.log("호출");
 if(agent == 'android') {
   window.rocateer.request_external_link(url);
 } else if (agent == 'ios') {
   var message = {
                  "request_type" : "request_external_link",
                  "url" : url,
                 };
   window.webkit.messageHandlers.native.postMessage(message);
 }
}
</script>

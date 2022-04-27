<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1><?=lang("lang_product_00143","상품등록")?></h1>
</header>
<!-- header : e -->
<div class="body row">
	<form name="form_default" id="form_default">
	
	  <div class="inner_wrap">
	    <div class="label"><?=lang("lang_product_00144","카테고리")?> <span class="essential"> *</span></div>
	    <select name="category_management_idx" id="category_management_idx">
	      <option value=""><?=lang("lang_product_00145","선택하여 주세요.")?></option>
				<?foreach ($category_management_list as $row) {?>
					<option value="<?=$row->category_management_idx ?>"><?=$row->category_name ?></option>
				<?}?>    
			</select>
	    <div class="label"><?=lang("lang_product_00146","제목")?> <span class="essential"> *</span></div>
	    <input type="text" name="title" id="title">
	    <div class="label"><?=lang("lang_product_00147","가격")?> <span class="essential"> *</span></div>
	    <div class="price_wrap">
	      <input type="checkbox" id="free_product_yn_1" name="free_product_yn" value="Y">
	      <label for="free_product_yn_1"><span></span><?=lang("lang_product_00148","무료나눔")?></label>
	      <span class="unit">৳</span>
	      <input type="number" authcomplete="off" name="product_price" id="product_price" value="">
	    </div>
	  </div>
		<div class="label inner_wrap"><?=lang("lang_product_00149","사진")?></div>
		<div class="x_scroll_img_reg">
	    <div class="cnt_num" id="img_cnt">0/10</div>
	    <ul class="img_reg_ul" id="img">
	      <li>
	        <div class="img_box" onclick="api_request_file_upload('img', 10, '<?=$this->current_nation?>')">
	          <img src="/images/img_plus.png" alt="">
	        </div>
	      </li>
	    </ul>
	  </div>
		<div class="inner_wrap">
			<div class="label"><?=lang("lang_product_00150","내용")?> <span class="essential">*</span></div>
			<textarea name="contents" id="contents" style="height:300px"></textarea>
			<div class="label"><?=lang("lang_product_00151","해시태그")?> <span class="essential">*</span></div>
			<p class="font_gray_9 mb8"><?=lang("lang_product_00152","입력 후 사이띄게를 입력하시면 태그가 등록됩니다.")?></p>

			<input class="form-control" type="text" name="tags" id="tags" value="">
	    <div class="label"><?=lang("lang_product_00153","거래위치")?> <span class="essential"> *</span></div>
	    <div class="btn_slt_place" onclick="modal_open('place_slt')" id="product_location_title_str">
	      <?=lang("lang_product_00154","거래할 위치를 선택 하세요.")?>
	    </div>
			<h5 class="mt16" id="product_addr_str"></h5>
			
			<input type="hidden" name="current_lat" id="current_lat" value="37.5185682">
			<input type="hidden" name="current_lng" id="current_lng" value="127.0230294">
			<input type="hidden" name="member_location_idx" id="member_location_idx" value="0">

			<div class="btn_full_weight btn_point mt30 mb30">
				<a href="javascript:void(0)" onclick="product_reg_in()"><?=lang("lang_product_00155","등록")?></a>
			</div>
		</div>
	</form>

</div>

<div class="modal modal_place_slt center">
	<div class="" onclick="event.stopPropagation();">
		<ul class="place_slt_ul scroll_none" id="my_location_ul">
			<?foreach ($member_location_list as $row) {?>
				<li >
					<span id="hidden_title_<?=$row->member_location_idx ?>" onclick="set_location('<?=$row->member_location_idx ?>')"><?=$row->title ?></span>
					<input type="hidden" name="hidden_product_addr" id="hidden_product_addr_<?=$row->member_location_idx ?>" value="<?=$row->member_addr ?>">
				</li>
			<?}?>
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
			<h1><?=lang("lang_product_00169","위치 지정")?></h1>
		</header>
		<div id="map_ma" style="width:100%;height:calc(100vh - 298px)"></div>
		<div class="reg_box" id="reg_box">
			<form name="address_form" id="address_form">
					
				
				<h5 id="address_area"></h5>
				<input type="text" name="product_location_title" id="product_location_title" placeholder="<?=lang("lang_product_00171","노출될 이름을 입력해 주세요.")?>">
				<select name="distance" id="distance">
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
					<a href="javascript:void(0)" onclick="member_location_reg_in()"><?=lang("lang_product_00173","등록")?></a>
				</div>
			</form>
		</div>
	</div>
</div>


<style media="screen">
a[href^="http://maps.google.com/maps"]{display:none !important} a[href^="https://maps.google.com/maps"]{display:none !important} .gmnoprint a, .gmnoprint span, .gm-style-cc { display:none; } .gmnoprint div { background:none !important; }
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDjSc91_XZD01ikBRSKOB5u-aGsISuciV0" ></script>
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDn2FK30f7459i8j4PDH8PBmJav9WWKKHc" ></script> -->
<script type="text/javascript">

setTimeout(function(){
  history.replaceState({ data: 'testData2' }, null, document.referrer);
}, 100);


$(document).ready(function(){
	api_request_position();
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

<script type="text/javascript">


img_id_val = 'img';
var i = 0;
function set_img(file_path){
  var str = "";
  str += "<li class='"+img_id_val+"_div' id='id_file_0_"+i+"' >";
  str += "  <img src='/images/i_delete.png' alt='X' onclick=\"file_img_remove('id_file_0_"+i+"')\" class='btn_delete'>";
  str += "  <div class='img_box'>";
  str += "    <img src='"+file_path+"' alt=''>";
  str += "  </div>";
  str += "  <input type='hidden' name='"+img_id_val+"_path[]' id='"+img_id_val+"_path_0_"+i+"' value='"+file_path+"'/>";
  str += "</li>";

  $('#'+img_id_val).append(str);
  $('#'+img_id_val+'_cnt').html($("."+img_id_val+"_div").length+"/10");

  i++;
}

function file_img_remove(file_no){
  $("#"+file_no).remove();
  $('#'+img_id_val+'_cnt').html($("."+img_id_val+"_div").length+"/10");
}


function set_location(member_location_idx){
	$("#member_location_idx").val(member_location_idx);
	$("#product_location_title_str").html($("#hidden_title_"+member_location_idx).html());
	$("#product_addr_str").html($("#hidden_product_addr_"+member_location_idx).val());
	modal_close('place_slt');
}

// 주소 등록
function member_location_reg_in(){
	
	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('product')?>/member_location_reg_in",
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
				
				var str = "";
				str += "<li>";
				str += "<span id='hidden_title_"+result.member_location_idx+"' onclick='set_location("+result.member_location_idx+")'>"+result.title+"</span>";
				str += "<input type='hidden' name='hidden_product_addr' id='hidden_product_addr_"+result.member_location_idx+"' value='"+result.member_addr+"'>";
				str += "</li>";
				
				$("#my_location_ul").append(str);
				modal_open('place_slt');
				modal_close('place_add');
				
				
			}
		}
	});
}


function product_reg_in(){

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('product')?>/product_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : $("#form_default").serialize(),
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
        location.href="/<?=$this->nationcode.'/'.mapping('main')?>";

      }
    }
  });
}

</script>

<script type="text/javascript">
$(function(){
	var tagData = new Array();
	$('#tags').tagEditor({
		// initialTags: [
		//   '?'
		// ],
		placeholder : "<?=lang("lang_product_00161","태그를 입력하세요.")?>",
		autocomplete: {
				delay: 10, // show suggestions immediately
				position: { collision: 'flip' }, // automatic menu position up/down
				source: tagData
		},
		delimiter: ', ', /* space and comma */
		forceLowercase: false
	});

	if($('#free_product_yn_1').prop('checked')){
		$('#product_price').val('');
		$('#product_price').attr('disabled','disabled');
	}else{
		$('#product_price').attr('disabled',false);
	}
	$("#free_product_yn_1").on('click', function() {
		if($('#free_product_yn_1').prop('checked')){
			$('#product_price').attr('disabled','disabled');
			$('#product_price').val('');
		}else{
			$('#product_price').attr('disabled',false);
		}
	});

});

</script>

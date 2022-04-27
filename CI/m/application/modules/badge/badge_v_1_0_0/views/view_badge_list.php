<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1><?=lang("lang_mypage_00620","보유 배지")?></h1>
</header>
<!-- header : e -->

<div class="body row badge inner_wrap">
  <h4><?=lang("lang_mypage_00621","나의 대표 배지")?></h4>
	<?if($my_badge->badge_type == ""){?>
		<p class="sub_title"><?=lang("lang_mypage_00622","획득한 배지가 있는 경우<br>원하는 것을 나의 대표 배지로 설정할 수 있습니다.")?></p>
	<?}else {?>
		<p class="sub_title">
		<?=$this->global_function->get_badge_info($my_badge->badge_type)->how_to_get?>
		</p>
	<?}?>
	<?if($result->my_badge != ""){?>
		<img src="/images/badge_big_<?=$result->my_badge+1?>.png"  onclick="modal_mod_up(<?=$my_badge->badge_type?>,'Y'); modal_open_slide('badge_detail')"  onerror="this.src='/images/badge_off.png'" class="badge_img">
	<?} else {?>
		<img src="/images/badge_off.png" onerror="this.src='/images/badge_off.png'" class="badge_img">
	<?}?>
  <h5><?=$my_badge->title?></h5>
  <hr class="mt20">
  <ul class="badge_ul">
    <li>
      <img src="<?=strpos($result->my_badge_types, $badge_0->badge_type) !== false ? $badge_0->img_path_on : $badge_0->img_path_off?>" onclick="modal_mod_up(<?=$badge_0->badge_type?>, '<?=strpos($result->my_badge_types, $badge_0->badge_type) !== false?'Y':'N'?>'); modal_open_slide('badge_detail')">
      <p><?=$badge_0->title?></p>
    </li>
		<li>
			<img src="<?=strpos($result->my_badge_types, $badge_1->badge_type) !== false ? $badge_1->img_path_on : $badge_1->img_path_off?>" onclick="modal_mod_up(<?=$badge_1->badge_type?>, '<?=strpos($result->my_badge_types, $badge_1->badge_type) !== false?'Y':'N'?>'); modal_open_slide('badge_detail')">
			<p><?=$badge_1->title?></p>
		</li>
		<li>
			<img src="<?=strpos($result->my_badge_types, $badge_2->badge_type) !== false ? $badge_2->img_path_on : $badge_2->img_path_off?>" onclick="modal_mod_up(<?=$badge_2->badge_type?>, '<?=strpos($result->my_badge_types, $badge_2->badge_type) !== false?'Y':'N'?>'); modal_open_slide('badge_detail')">
			<p><?=$badge_2->title?></p>
		</li>
		<li>
			<img src="<?=strpos($result->my_badge_types, $badge_3->badge_type) !== false ? $badge_3->img_path_on : $badge_3->img_path_off?>" onclick="modal_mod_up(<?=$badge_3->badge_type?>, '<?=strpos($result->my_badge_types, $badge_3->badge_type) !== false?'Y':'N'?>'); modal_open_slide('badge_detail')">
			<p><?=$badge_3->title?></p>
		</li>
		<li>
			<img src="<?=strpos($result->my_badge_types, $badge_4->badge_type) !== false ? $badge_4->img_path_on : $badge_4->img_path_off?>" onclick="modal_mod_up(<?=$badge_4->badge_type?>, '<?=strpos($result->my_badge_types, $badge_4->badge_type) !== false?'Y':'N'?>'); modal_open_slide('badge_detail')">
			<p><?=$badge_4->title?></p>
		</li>
		<li>
			<img src="<?=strpos($result->my_badge_types, $badge_5->badge_type) !== false ? $badge_5->img_path_on : $badge_5->img_path_off?>" onclick="modal_mod_up(<?=$badge_5->badge_type?>, '<?=strpos($result->my_badge_types, $badge_5->badge_type) !== false?'Y':'N'?>'); modal_open_slide('badge_detail')">
			<p><?=$badge_5->title?></p>
		</li>
		<li>
			<img src="<?=strpos($result->my_badge_types, $badge_6->badge_type) !== false ? $badge_6->img_path_on : $badge_6->img_path_off?>" onclick="modal_mod_up(<?=$badge_6->badge_type?>, '<?=strpos($result->my_badge_types, $badge_6->badge_type) !== false?'Y':'N'?>'); modal_open_slide('badge_detail')">
			<p><?=$badge_6->title?></p>
		</li>
		<li>
			<img src="<?=strpos($result->my_badge_types, $badge_7->badge_type) !== false ? $badge_7->img_path_on : $badge_7->img_path_off?>" onclick="modal_mod_up(<?=$badge_7->badge_type?>, '<?=strpos($result->my_badge_types, $badge_7->badge_type) !== false?'Y':'N'?>'); modal_open_slide('badge_detail')">
			<p><?=$badge_7->title?></p>
		</li>
		<li>
			<img src="<?=strpos($result->my_badge_types, $badge_8->badge_type) !== false ? $badge_8->img_path_on : $badge_8->img_path_off?>" onclick="modal_mod_up(<?=$badge_8->badge_type?>, '<?=strpos($result->my_badge_types, $badge_8->badge_type) !== false?'Y':'N'?>'); modal_open_slide('badge_detail')">
			<p><?=$badge_8->title?></p>
		</li>
		<li>
			<img src="<?=strpos($result->my_badge_types, $badge_9->badge_type) !== false ? $badge_9->img_path_on : $badge_9->img_path_off?>" onclick="modal_mod_up(<?=$badge_9->badge_type?>, '<?=strpos($result->my_badge_types, $badge_9->badge_type) !== false?'Y':'N'?>'); modal_open_slide('badge_detail')">
			<p><?=$badge_9->title?></p>
		</li>
  </ul>
</div>

<div class="modal_badge_detail">
  <img id="img_path" src="/images/badge9.png" onclick="modal_open_slide('badge_detail')">
  <h4 id="title"></h4>
  <p class="txt" id="how_to_get"></p>
  <div class="btn_full_thin btn_point_line mt20" style="display:<?=$access_type=='0'?'block':'none' ?>">
		<a id="my_badge" href="javascript:void(0)" onclick="my_badge_mod_up()"><?=lang("lang_mypage_00634","나의 대표 배지로 사용")?></a>
  </div>
  <!-- <div class="btn_full_thin btn_deactive mt20">
    <a href="javascript:void(0)">나의 대표 배지로 사용</a>
  </div> -->
</div>
<div class="md_overlay md_overlay_badge_detail" onclick="modal_close_slide('badge_detail');"></div>

<script type="text/javascript">
let badge_detail_view_height;
window.onload = function(){
	badge_detail_view_height = $('.modal_badge_detail').outerHeight();
  $('.modal_badge_detail').css('bottom',-badge_detail_view_height);
};
function modal_open_slide(e){
	badge_detail_view_height = $('.modal_badge_detail').outerHeight();
  $(".md_overlay_" + 'badge_detail').css("visibility", "visible").animate({opacity: 1}, 100);
  $(".modal_" + 'badge_detail').css({bottom: "0",transition:'0.4s'});
  $.lockBody();
}

function modal_close_slide(e){
  $(".md_overlay_" + 'badge_detail').css("visibility", "hidden").animate({opacity: 0}, 100);
  $(".modal_" + 'badge_detail').css({bottom: -badge_detail_view_height});
  $.unlockBody();
}

// 모달 정보 수정
function modal_mod_up(badge_type, my_badge_yn){

	var img_path = document.querySelector('#img_path');
	var title = document.querySelector('#title');
	var how_to_get = document.querySelector('#how_to_get');
	var my_badge = document.querySelector('#my_badge');
	if(my_badge_yn=='Y'){
		img_path.src = '/images/badge'+(badge_type+1)+'.png';
	}else{
		img_path.src = '/images/badge'+(badge_type+1)+'_off.png';
	}


	if(badge_type == 0){
		title.innerText = '<?=$badge_0->title?>';
		how_to_get.innerText = '<?=$badge_0->how_to_get?>';
		var my_badge_types = '<?=$result->my_badge_types?>';

		if(my_badge_types.indexOf(badge_type) == -1){
			my_badge.removeAttribute('onclick');
			my_badge.parentElement.classList.replace('btn_point_line', 'btn_deactive')
		} else {
			my_badge.setAttribute('onclick', 'my_badge_mod_up(<?=$badge_0->badge_type?>)');
			my_badge.parentElement.classList.replace('btn_deactive', 'btn_point_line')
		}
	}

	if(badge_type == 1){
		title.innerText = '<?=$badge_1->title?>';
		how_to_get.innerText = '<?=$badge_1->how_to_get?>';
		var my_badge_types = '<?=$result->my_badge_types?>';

		if(my_badge_types.indexOf(badge_type) == -1){
			my_badge.removeAttribute('onclick');
			my_badge.parentElement.classList.replace('btn_point_line', 'btn_deactive')
		} else {
			my_badge.setAttribute('onclick', 'my_badge_mod_up(<?=$badge_1->badge_type?>)');
			my_badge.parentElement.classList.replace('btn_deactive', 'btn_point_line')

		}
	}
	if(badge_type == 2){
		title.innerText = '<?=$badge_2->title?>';
		how_to_get.innerText = '<?=$badge_2->how_to_get?>';
		var my_badge_types = '<?=$result->my_badge_types?>';

		if(my_badge_types.indexOf(badge_type) == -1){
			my_badge.removeAttribute('onclick');
			my_badge.parentElement.classList.replace('btn_point_line', 'btn_deactive')
		} else {
			my_badge.setAttribute('onclick', 'my_badge_mod_up(<?=$badge_2->badge_type?>)');
			my_badge.parentElement.classList.replace('btn_deactive', 'btn_point_line')

		}
	}
	if(badge_type == 3){
		title.innerText = '<?=$badge_3->title?>';
		how_to_get.innerText = '<?=$badge_3->how_to_get?>';
		var my_badge_types = '<?=$result->my_badge_types?>';

		if(my_badge_types.indexOf(badge_type) == -1){
			my_badge.removeAttribute('onclick');
			my_badge.parentElement.classList.replace('btn_point_line', 'btn_deactive')
		} else {
			my_badge.setAttribute('onclick', 'my_badge_mod_up(<?=$badge_3->badge_type?>)');
			my_badge.parentElement.classList.replace('btn_deactive', 'btn_point_line')

		}
	}
	if(badge_type == 4){
		title.innerText = '<?=$badge_4->title?>';
		how_to_get.innerText = '<?=$badge_4->how_to_get?>';
		var my_badge_types = '<?=$result->my_badge_types?>';

		if(my_badge_types.indexOf(badge_type) == -1){
			my_badge.removeAttribute('onclick');
			my_badge.parentElement.classList.replace('btn_point_line', 'btn_deactive')
		} else {
			my_badge.setAttribute('onclick', 'my_badge_mod_up(<?=$badge_4->badge_type?>)');
			my_badge.parentElement.classList.replace('btn_deactive', 'btn_point_line')

		}
	}
	if(badge_type == 5){
		title.innerText = '<?=$badge_5->title?>';
		how_to_get.innerText = '<?=$badge_5->how_to_get?>';
		var my_badge_types = '<?=$result->my_badge_types?>';

		if(my_badge_types.indexOf(badge_type) == -1){
			my_badge.removeAttribute('onclick');
			my_badge.parentElement.classList.replace('btn_point_line', 'btn_deactive')
		} else {
			my_badge.setAttribute('onclick', 'my_badge_mod_up(<?=$badge_5->badge_type?>)');
			my_badge.parentElement.classList.replace('btn_deactive', 'btn_point_line')

		}
	}
	if(badge_type == 6){
		title.innerText = '<?=$badge_6->title?>';
		how_to_get.innerText = '<?=$badge_6->how_to_get?>';
		var my_badge_types = '<?=$result->my_badge_types?>';

		if(my_badge_types.indexOf(badge_type) == -1){
			my_badge.removeAttribute('onclick');
			my_badge.parentElement.classList.replace('btn_point_line', 'btn_deactive')
		} else {
			my_badge.setAttribute('onclick', 'my_badge_mod_up(<?=$badge_6->badge_type?>)');
			my_badge.parentElement.classList.replace('btn_deactive', 'btn_point_line')

		}
	}
	if(badge_type == 7){
		title.innerText = '<?=$badge_7->title?>';
		how_to_get.innerText = '<?=$badge_7->how_to_get?>';
		var my_badge_types = '<?=$result->my_badge_types?>';

		if(my_badge_types.indexOf(badge_type) == -1){
			my_badge.removeAttribute('onclick');
			my_badge.parentElement.classList.replace('btn_point_line', 'btn_deactive')
		} else {
			my_badge.setAttribute('onclick', 'my_badge_mod_up(<?=$badge_7->badge_type?>)');
			my_badge.parentElement.classList.replace('btn_deactive', 'btn_point_line')

		}
	}
	if(badge_type == 8){
		title.innerText = '<?=$badge_8->title?>';
		how_to_get.innerText = '<?=$badge_8->how_to_get?>';
		var my_badge_types = '<?=$result->my_badge_types?>';

		if(my_badge_types.indexOf(badge_type) == -1){
			my_badge.removeAttribute('onclick');
			my_badge.parentElement.classList.replace('btn_point_line', 'btn_deactive')
		} else {
			my_badge.setAttribute('onclick', 'my_badge_mod_up(<?=$badge_8->badge_type?>)');
			my_badge.parentElement.classList.replace('btn_deactive', 'btn_point_line')

		}
	}
	if(badge_type == 9){
		title.innerText = '<?=$badge_9->title?>';
		how_to_get.innerText = '<?=$badge_9->how_to_get?>';
		var my_badge_types = '<?=$result->my_badge_types?>';

		if(my_badge_types.indexOf(badge_type) == -1){
			my_badge.removeAttribute('onclick');
			my_badge.parentElement.classList.replace('btn_point_line', 'btn_deactive')
		} else {
			my_badge.setAttribute('onclick', 'my_badge_mod_up(<?=$badge_9->badge_type?>)');
			my_badge.parentElement.classList.replace('btn_deactive', 'btn_point_line')

		}
	}
	// btn_deactive
	// btn_point_line
}


// 대표 배지 설정
function my_badge_mod_up(badge_type){

  var form_data = {
		'my_badge' : badge_type
  };

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('badge')?>/my_badge_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
			if(result.code == "-1"){
        alert(result.code_msg);
				return;
      }

      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        alert(result.code_msg);
        location.reload();
      }
    }
  });
}
</script>

<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
  <h1><?=lang("lang_community_00485","커뮤니티 수정")?></h1>
</header>
<!-- header : e -->
<div class="body row">
	<form name="form_default" id="form_default">
		
		<div class="label inner_wrap"><?=lang("lang_community_00486","사진")?></div>
		<div class="x_scroll_img_reg">
			<? $img_arr = explode(',', $result->img_path); ?>
			
			<div class="cnt_num" id="img_cnt"><?=count($img_arr) ?>/10</div>
			<ul class="img_reg_ul" id="img">
	      <li>
	        <div class="img_box" onclick="api_request_file_upload('img', 10, '<?=$this->current_nation?>')">
	          <img src="/images/img_plus.png" alt="">
	        </div>
	      </li>
				<? if(!empty($result->img_path)){ ?>
					<?
					$i=0;
					foreach ($img_arr as $row) {
					?>
						<li  class='img_div' id='id_file_0_<?=$i ?>' >
							<img src="/images/i_delete.png"  onclick="file_img_remove('id_file_0_<?=$i ?>')" alt="X" class="btn_delete">
							<div class="img_box">
								<img src="<?=$row ?>" alt="">
							</div>
							<input type="hidden" name="img_path[]" value="<?=$row ?>">
						</li>
					<?$i++;}?>
				<? } ?>
				
	    </ul>
	  </div>
		<div class="inner_wrap">
			<div class="label"><?=lang("lang_community_00487","내용")?> <span class="essential">*</span></div>
			<textarea   name="contents" id="contents" style="height:300px"><?=$result->contents?></textarea>
			<div class="label"><?=lang("lang_community_00488","해시태그")?> <span class="essential">*</span></div>
			<p class="font_gray_9 mb8"><?=lang("lang_community_00489","입력 후 사이띄게를 입력하시면 태그가 등록됩니다.")?></p>

			<input class="form-control" type="text" name="tags" id="tags" value="<?=$result->tags?>">

			<div class="btn_full_weight btn_point mt30 mb30">
				<a href="javascript:void(0)" onclick="board_mod_up()"><?=lang("lang_community_00490","수정")?></a>
			</div>
		</div>
		<input type="hidden" name="board_idx" id="board_idx" value="<?=$result->board_idx?>">
	</form>
	
</div>


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

function board_mod_up(){

  $.ajax({
    url      : "/<?=$this->nationcode.'/'.mapping('community')?>/board_mod_up",
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
        location.href="/<?=$this->nationcode.'/'.mapping('community')?>";

      }
    }
  });
}
</script>


<script type="text/javascript">
$(function(){
	var tagData = new Array();
	$('#tags').tagEditor({
		initialTags: [],
		placeholder : "<?=lang("lang_community_00493","태그를 입력하세요.")?>",
		autocomplete: {
				delay: 10, // show suggestions immediately
				position: { collision: 'flip' }, // automatic menu position up/down
				source: tagData
		},
		delimiter: ', ', /* space and comma */
		forceLowercase: false
	});
});

</script>

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
							<img src="<?=explode(',',$result->img_path)[0]?>" onerror="this.src='/images/default_img.png'">
						</div>
					</th>
					<td>
						<div class="fs_16"><?=$result->title?></div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="date"><?=$this->global_function->convert_time_exp($result->list_up_date)?></div>
					</td>
				</tr>
			</table>
		</div>
		<hr class="mt16">
		<div class="inner_wrap">
			<h2 class="mt20 mb10"><?=lang("lang_product_00280","예약 완료 처리 하시겠습니까?")?></h2>
			<div class="font_gray_6"><?=lang("lang_product_00277","예약 대상자를 선택하여 주세요.")?></div>
			<ul class="reserve_ul">
				<?foreach ($result_list as $row) {?>
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
										<img src="<?=$row->partner_member_img ?>" onerror="this.src='/images/default_user.png'">
									</div>
								</th>
								<td>
									<h6><?=$row->partner_member_name ?></h6>
								</td>
								<td rowspan="2">
									<input type="radio" name="product_member_idx" id="product_member_idx_<?=$row->member_idx ?>" value="<?=$row->member_idx ?>">
									<label for="product_member_idx_<?=$row->member_idx ?>"><span></span></label>
								</td>
							</tr>
							<tr>
								<td>
									<div class="last_time"><?=lang("lang_product_00278","마지막 대화")?> <?=$this->global_function->convert_time_exp($row->last_chatting_date)?></div>
								</td>
							</tr>
						</table>
					</li>
				<?}?>
			</ul>
		</div>
	</div>
	
	<input type="hidden" name="product_idx" id="product_idx" value="<?=$result->product_idx?>">
	
	<div class="vh_footer btn_full_weight btn_point mt30 mb30">
		<a href="javascript:void(0)" onclick="product_state_mod_up_1()"><?=lang("lang_product_00279","예약완료")?></a>
	</div>
</div>

<script type="text/javascript">

function product_state_mod_up_1(){
	
	if (!$("input[name='product_member_idx']:checked").val()) {
		alert("<?=lang("lang_product_00277","예약 대상자를 선택하여 주세요.")?>");
		return;
	}

	var formData = {
		'product_idx' :  $("#product_idx").val(),
		'product_member_idx' :  $("input[name='product_member_idx']:checked").val()
	};

	$.ajax({
		url      : "/<?=$this->nationcode.'/'.mapping('product')?>/product_state_mod_up_1",
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
				history.back();
			}
		}
	});
}
</script>

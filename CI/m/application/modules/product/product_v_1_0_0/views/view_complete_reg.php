<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)">
		<img src="/images/head_btn_back.png" alt="뒤로가기">
	</a>
	<h1><?=lang("lang_product_00283","구매자")?></h1>
</header>
<!-- header : e -->
<div class="body vh_wrap product_complete">
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
			<img src="/images/complete_illust.png" class="complete_illust">
			<div class="img_box profile">
				<img src="<?=$result->partner_member_img ?>"  onerror="this.src='/images/default_user.png'" alt="">
			</div>
			<h4><?=$result->partner_member_name ?></h4>
			<h3><?=lang("lang_join_00768","축하합니다!")?></h3>
			<p class="fs_16"><?=lang("lang_product_00284","거래가 완료 되었어요.")?></p>
		</div>
	</div>
</div>

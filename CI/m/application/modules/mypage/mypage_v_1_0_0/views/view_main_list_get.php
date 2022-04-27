
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>
<?if( ($row->del_yn != 'P' && $row->display_yn=='Y') || $row->member_idx==$this->member_idx || $tab_type=='2' || $tab_type=='6'  ){?>

	<li>
		<table class="tbl_4">
			<colgroup>
				<col width="125">
			</colgroup>
			<?
			$return_url_str = "/".$this->nationcode."/".mapping('product')."/product_detail&product_idx=".$row->product_idx;
			$fnc_str = "location.href=\'"."/".$this->nationcode."/".mapping('product')."/product_detail?product_idx=".$row->product_idx."\'";
			?>
			<tr>
				<th rowspan="6">
					<? if($row->member_idx==$this->member_idx || $tab_type=='0' || $tab_type=='1'){ ?>
						<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
					<? } else {?>
						<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" >
					<? } ?>
					
						<div class="img_box thum">
							<img src="<?=explode(",",$row->img_path)[0]?>" onerror="this.src='/images/default_img.png'">
						</div>
					</a>
				</th>
			</tr>
			<tr>
				<td>
					<? if($row->member_idx==$this->member_idx  || $tab_type=='0' || $tab_type=='1'){ ?>
						<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
					<? } else {?>
						<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" >
					<? } ?>
						<div class="title"><?=$row->title?></div>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<? if($row->member_idx==$this->member_idx || $tab_type=='0' || $tab_type=='1'){ ?>
						<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
					<? } else {?>
						<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" >
					<? } ?>
						<div class="place"><?=$row->product_addr?></div>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<? if($row->member_idx==$this->member_idx || $tab_type=='0' || $tab_type=='1'){ ?>
						<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
					<? } else {?>
						<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" >
					<? } ?>
						<div class="s_info"><?=$row->list_up_cnt > 0 ? lang("lang_mypage_00643","끌어올리기") : ''?> <?=$this->global_function->convert_time_exp($row->list_up_date)?> · <?=lang("lang_main_00131","나와의 거리")?> <?=$row->distance?>km</div>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<? if($row->member_idx==$this->member_idx || $tab_type=='0' || $tab_type=='1'){ ?>
						<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
					<? } else {?>
						<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" >
					<? } ?>
						<div class="price">
							<?if($row->product_state == '1'){?>
								<span class="state"><?=lang("lang_main_00134","예약")?></span>
							<?} else if($row->product_state == '2'){?>
								<span class="state comp"><?=lang("lang_main_00135","완료")?></span>
							<?}?>
							<? if($row->product_price>0){ ?>
								৳ <?=number_format($row->product_price)?>
							<? } else {?>
								<?=lang("lang_profile_00296","무료나눔")?>
							<? } ?>
						</div>
					</a>
				</td>
			</tr>
			<tr>
				<td style="vertical-align:bottom">
					<ul class="info_ul">
						<li>
							<img src="/images/icons-comment.png" alt="">
							<?=number_format($row->chatting_cnt)?>
						</li>
						<li  >

							<?
							$return_url_str = "/".$this->nationcode."/".mapping('product')."/product_detail&product_idx=".$row->product_idx;
							$fnc_str = "product_like_reg_in(".$row->product_idx.",".$tab_type.")";
							?>

							<!-- <span id="" onclick="product_like_reg_in('<?=$row->product_idx?>',this)" class="like like_1 <?=$row->like_yn=='Y'?'on':''?>"></span> -->
							<!-- <span id="like_span_<?=$row->product_idx?>_<?=$tab_type?>" onclick="product_like_reg_in('<?=$row->product_idx?>','<?=$tab_type?>')" class="like like_span_<?=$row->product_idx?> like_1 <?=$row->like_yn=='Y'?'on':''?>"></span> -->
							<span id="like_span_<?=$row->product_idx?>_<?=$tab_type?>" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" class="like like_span_<?=$row->product_idx?> like_1 <?=$row->like_yn=='Y'?'on':''?>"></span>
							<span id="like_cnt_<?=$row->product_idx?>_<?=$tab_type?>" class="like_cnt_<?=$row->product_idx?>">
								<?=number_format($row->like_cnt)?>
							</span>
						</li>
						<? if($tab_type=='2' || $tab_type=='6'){ ?>
							<li>
								<img src="/images/i_manner1.png" alt="">
								<?=number_format($row->good_product_cnt)?>
							</li>
							<li>
								<img src="/images/i_manner2.png" alt="">
								<?=number_format($row->bad_product_cnt)?>
							</li>
						<? } ?>
					</ul>
				</td>
			</tr>
		</table>
		<? if($tab_type=='1' && $row->free_product_yn=='Y' && $row->seller_review_yn=='N'){ ?>
			<?
			$return_url_str = "/".$this->nationcode."/".mapping('eval')."/free_sell_reg&product_idx=".$row->product_idx;
			$fnc_str = "location.href=\'"."/".$this->nationcode."/".mapping('eval')."/free_sell_reg?product_idx=".$row->product_idx."\'";
			?>
			<div class="btn_full_thin btn_point mt12">
				<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" ><?=lang("lang_mypage_00533","평가하기")?></a>
				<!-- <a href="/<?=$this->nationcode.'/'.mapping('eval')?>/free_sell_reg?product_idx=<?=$row->product_idx?>"><?=lang("lang_mypage_00533","평가하기")?></a> -->
			</div>
		<? }elseif($tab_type=='2' && $row->free_product_yn=='Y' && $row->buyer_review_yn=='N') {?>

			<?
			$return_url_str = "/".$this->nationcode."/".mapping('eval')."/free_buy_reg&product_idx=".$row->product_idx;
			$fnc_str = "location.href=\'"."/".$this->nationcode."/".mapping('eval')."/free_buy_reg?product_idx=".$row->product_idx."\'";
			?>
			<div class="btn_full_thin btn_point mt12">
				<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')"><?=lang("lang_mypage_00533","평가하기")?></a>
				<!-- <a href="/<?=$this->nationcode.'/'.mapping('eval')?>/free_buy_reg?product_idx=<?=$row->product_idx?>"><?=lang("lang_mypage_00533","평가하기")?></a> -->
			</div>
		<? }elseif($tab_type=='2' && $row->free_product_yn=='N' && $row->buyer_review_yn=='N') {?>

			<?
			$return_url_str = "/".$this->nationcode."/".mapping('eval')."/genelar_list&product_idx=".$row->product_idx;
			$fnc_str = "location.href=\'"."/".$this->nationcode."/".mapping('eval')."/genelar_list?product_idx=".$row->product_idx."\'";
			?>
			<div class="btn_full_thin btn_point mt12">
				<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')"><?=lang("lang_mypage_00533","평가하기")?></a>
				<!-- <a href="/<?=$this->nationcode.'/'.mapping('eval')?>/genelar_list?product_idx=<?=$row->product_idx?>"><?=lang("lang_mypage_00533","평가하기")?></a> -->
			</div>
		<?} ?>
	</li>
<?} else {?>
	<li>
		<div class="blind"><?=lang("lang_mypage_00520","관리자에 의해 블라인드 게시글입니다.<br>관리자에게 문의하세요.")?></div>
	</li>
<?}?>

<?php
		}
	}
?>


<script type="text/javascript">
$(document).ready(function(){
	$("#total_block_<?=$tab_type?>").val('<?=$total_block ?>');
});

$("#no_data_<?=$tab_type?>").css("display","<?=$display?>");
// <? if($tab_type=='0'){ ?>
// 	$("#tab_cnt_<?=$tab_type?>").html("<?=lang("lang_mypage_00518","판매중")?>(<?=$result_list_count>=1000?round($result_list_count/1000,1)."K":$result_list_count ?>)");
// <? } elseif($tab_type=='1') {?>
// 	$("#tab_cnt_<?=$tab_type?>").html("<?=lang("lang_mypage_00519","거래완료")?>(<?=$result_list_count>=1000?round($result_list_count/1000,1)."K":$result_list_count?>)");
// <? } elseif($tab_type=='2') {?>
// 	$("#tab_cnt_<?=$tab_type?>").html("<?=lang("lang_mypage_00515","구매내역")?>(<?=$result_list_count>=1000?round($result_list_count/1000,1)."K":$result_list_count?>)");
// <? } elseif($tab_type=='6') {?>
// 	$("#tab_cnt_<?=$tab_type?>").html("<?=lang("lang_mypage_00517","찜")?>(<?=$result_list_count>=1000?round($result_list_count/1000,1)."K":$result_list_count?>)");
// <? } ?>

</script>

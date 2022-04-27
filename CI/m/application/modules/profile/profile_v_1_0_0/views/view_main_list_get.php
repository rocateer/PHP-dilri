
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>
<?if($row->del_yn != 'P'){?>

	<li>
		<table class="tbl_4">
			<colgroup>
				<col width="125">
			</colgroup>
			<tr>
				<th rowspan="6">
					<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
						<div class="img_box thum">
							<img src="<?=explode(",",$row->img_path)[0]?>" onerror="this.src='/images/default_img.png'">
						</div>
					</a>
				</th>
			</tr>
			<tr>
				<td>
					<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
						<div class="title"><?=$row->title?></div>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
						<div class="place"><?=$row->product_addr?></div>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
						<div class="s_info"><?=$row->list_up_cnt > 0 ? lang("lang_search_00356","끌어올리기") : ''?> <?=$this->global_function->convert_time_exp($row->list_up_date)?> · <?=lang("lang_main_00131","나와의 거리")?> <?=$row->distance?>km</div>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
						<div class="price">
							<?if($row->product_state == '1'){?>
								<span class="state"><?=lang("lang_main_00134","예약")?></span>								
							<?} else if($row->product_state == '2'){?>
								<span class="state comp"><?=lang("lang_main_00135","완료")?></span>
							<?}?>
							<? if($row->product_price>0){ ?>
								৳ <?=number_format($row->product_price)?>
							<? } else {?>
								<?=lang("lang_main_00132","무료나눔")?>
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
						<li onclick="wish_btn('like_1')">
							<span class="like like_1"></span>
							<?=number_format($row->like_cnt)?>
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
			<div class="btn_full_thin btn_point mt12">
				<a href="/<?=$this->nationcode.'/'.mapping('eval')?>/free_sell_reg?product_idx=<?=$row->product_idx?>"><?=lang("lang_mypage_00533","평가하기")?></a>
			</div>
		<? }elseif($tab_type=='2' && $row->free_product_yn=='Y' && $row->buyer_review_yn=='N') {?>
			<div class="btn_full_thin btn_point mt12">
				<a href="/<?=$this->nationcode.'/'.mapping('eval')?>/free_buy_reg?product_idx=<?=$row->product_idx?>"><?=lang("lang_mypage_00533","평가하기")?></a>
			</div>
		<? }elseif($tab_type=='2' && $row->free_product_yn=='N' && $row->buyer_review_yn=='N') {?>
			<div class="btn_full_thin btn_point mt12">
				<a href="/<?=$this->nationcode.'/'.mapping('eval')?>/genelar_list?product_idx=<?=$row->product_idx?>"><?=lang("lang_mypage_00533","평가하기")?></a>
			</div>
		<?} ?>
	</li>
<?} else {?>
	<li>
		<div class="blind"><?=lang("lang_mypage_00534","관리자에 의해 블라인드 게시글입니다.<br>관리자에게 문의하세요.")?></div>
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

<? if($tab_type=='0'){ ?>
	$("#tab_cnt_<?=$tab_type?>").html("<?=lang("lang_profile_00285","판매 상품 목록")?>(<?=$result_list_count>=1000?round($result_list_count/1000,1)."K":$result_list_count ?>)");
<? } ?>

</script>

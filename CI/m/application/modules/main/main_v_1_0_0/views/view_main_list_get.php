
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>
<?if( ($row->del_yn != 'P' && $row->display_yn=='Y') || $row->member_idx==$this->member_idx ){?>

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
					<? if($row->member_idx==$this->member_idx){ ?>
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
					<? if($row->member_idx==$this->member_idx){ ?>
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
					<? if($row->member_idx==$this->member_idx){ ?>
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
					<? if($row->member_idx==$this->member_idx){ ?>
						<a href="/<?=$this->nationcode.'/'.mapping('product')?>/product_detail?product_idx=<?=$row->product_idx?>">
					<? } else {?>
						<a href="javascript:void(0)" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" >
					<? } ?>
						<div class="s_info"><?=$row->list_up_cnt > 0 ? lang("lang_main_00130","끌어올리기") : ''?> <?=$this->global_function->convert_time_exp($row->list_up_date)?> · <?=lang("lang_main_00131","나와의 거리")?> <?=$row->distance?>km</div>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<? if($row->member_idx==$this->member_idx){ ?>
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
						<li  >
							<?
							$return_url_str = "/".$this->nationcode."/".mapping('main');
							$fnc_str = "product_like_reg_in(\'".$row->product_idx."\',this)";
							?>
							<span id="like_span_<?=$row->product_idx?>" onclick="COM_profile_check('<?=$this->member_idx?>','<?=$return_url_str?>','<?=$fnc_str?>')" class="like like_1 <?=$row->like_yn=='Y'?'on':''?>"></span>
							<span id="like_cnt_<?=$row->product_idx?>">
								<?=number_format($row->like_cnt)?>
							</span>
						</li>
						<li>
							<img src="/images/i_manner1.png" alt="">
							<?=number_format($row->good_product_cnt)?>
						</li>
						<li>
							<img src="/images/i_manner2.png" alt="">
							<?=number_format($row->bad_product_cnt)?>
						</li>
					</ul>
				</td>
			</tr>
		</table>
	</li>
<?} else {?>
	<li>
		<div class="blind">
			<?=lang("lang_main_00136","관리자에 의해 제재된 사용자의 게시글입니다.")?>
		</div>
	</li>
<?}?>
<?php
		}
	}
?>


<script type="text/javascript">
	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

	$("#no_data").css("display","<?=$display?>");

</script>

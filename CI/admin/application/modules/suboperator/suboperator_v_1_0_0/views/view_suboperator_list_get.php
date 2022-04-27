<div class="row table_title">
	<div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=number_format($result_list_count)?></strong> 건</div>
	<div class="col-lg-6 text-right"><a href="/<?=mapping('suboperator')?>/suboperator_reg" class="btn btn-success">관리자 등록</a></div>
</div>

<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th width="50">No</th>
			<th width="120">관리자명</th>
			<th width="*">관리자 ID</th>
			<th width="150">등록일</th>
		</tr>
	</thead>
	<tbody>
	<? foreach ($result_list as $row ) { ?>
		<tr>
			<td><?=$no--?></td>
			<td><?=$row->admin_name?></td>
			<td><a href="/<?=mapping('suboperator')?>/suboperator_detail?admin_idx=<?=$row->admin_idx?>"><?=$row->admin_id?></a></td>
			<td><?=$this->global_function->dateYmdHyphen($row->ins_date)?></td>
		</tr>
	<? }	?>
	</tbody>
</table>

<?=$paging?>

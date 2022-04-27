<?php
  $filename="회원관리_".date('Ymd');
	header( "Content-type: application/vnd.ms-excel; charset=utf-8" );
	header( "Expires: 0" );
	header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
	header( "Pragma: public" );
	header( "Content-Disposition: attachment; filename=$filename.xls" );
?>

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<table class="table table-bordered">
	<thead>
    <tr>
      <th>No</th>
      <th>아이디(이메일)</th>
      <th width="100">휴대폰번호</th>
      <th width="100">이름</th>
      <th width="100">회원 상태</th>
      <th width="120">가입일</th>
      <th width="120">탈퇴일</th>
      <th width="100">탈퇴사유</th>
    </tr>
	</thead>
	<tbody>
    <?php
			if(!empty($result_list)){
    		foreach ($result_list as $row){
    ?>
          <tr>
            <td><?=$no--?></td>
            <td><?=$row->member_id?></td>
            <td><?=$this->global_function->set_phone_number($row->member_phone)?></td>
            <td><?=$row->member_name?></td>
            <td>
              <?switch($row->del_yn){
                case 'N': echo "이용중"; break;
                case 'P': echo "이용정지"; break;
                case 'Y': echo "탈퇴"; break;
              }?>
            </td>
            <td><?=$row->ins_date?></td>
            <td>
              <? if(!empty($row->member_leave_date)){?>
                <?=$row->member_leave_date?>
              <?} ?>
            </td>
            <td><?=$row->member_leave_reason?></td>
          </tr>
		<?php
		    }
			}
		?>
	</tbody>
</table>

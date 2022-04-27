<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2018-11-05
| Memo : 채팅
|------------------------------------------------------------------------
*/

Class Model_chatting extends MY_Model{

	// 예약 중 무료나눔 거래의 완료 여부 확인
	public function free_product_state_check($data){
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_product AS a
						WHERE
							a.del_yn = 'N'
							AND a.product_state = 1
							AND a.free_product_yn = 'Y'
							AND a.product_member_idx = '$member_idx'
		";

		return $this->query_cnt($sql, array());
	}

	// 완료된 무료나눔 거래의 평가 등록 확인
	public function free_product_review_check($data){
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_product AS a
						WHERE
							a.del_yn = 'N'
							AND a.product_state = 2
							AND a.free_product_yn = 'Y'
							AND a.product_member_idx = '$member_idx'
							AND a.buyer_review_yn = 'N'
		";

		return $this->query_cnt($sql, array());
	}

	// 채팅방 목록
	public function chatting_room_list($data) {

		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$sql = "SELECT
						 a.chatting_room_idx,
						 a.member_idx,
						 a.partner_member_idx,
						 a.state,
						 a.member_read_yn,
						 a.partner_member_read_yn,
						 DATE_FORMAT(a.last_chatting_date, '%Y.%m.%d. %H:%i') as last_chatting_date,
						 a.last_chatting_comment,
						 FN_AES_DECRYPT(c.member_name) AS member_name,
						 c.member_img as member_img,
						 FN_AES_DECRYPT(d.member_name) AS partner_member_name,
						 d.member_img as partner_member_img,
						 b.title
						FROM
							tbl_chatting_room as a
							join tbl_product as b on b.product_idx=a.product_idx
							left join tbl_member as c on c.member_idx=a.member_idx
							left join tbl_member as d on d.member_idx=a.partner_member_idx

						WHERE
							a.del_yn ='N'
							and (a.member_idx='$this->member_idx' OR a.partner_member_idx='$this->member_idx')
		";

			$sql .=" ORDER BY a.last_chatting_date DESC LIMIT ?, ?";


			return $this->query_result($sql,
															array(
															$page_no,
															$page_size
															),$data
															);
	}

	// 채팅방 목록수
	public function chatting_room_list_count() {

		$sql = "SELECT
						 count(*) as cnt
						FROM
							tbl_chatting_room as a
							left join tbl_member as c on c.member_idx=a.member_idx

						WHERE
							a.del_yn ='N'
							and (a.member_idx='$this->member_idx' OR a.partner_member_idx='$this->member_idx')
		";

			return $this->query_cnt($sql,array());
	}

	// 새 채팅방 목록
	public function new_chatting_room_list(){

		$sql = "SELECT
							a.chatting_room_idx,
							a.member_idx,
							a.partner_member_idx,
							a.state,
							a.member_read_yn,
							a.partner_member_read_yn,
							DATE_FORMAT(a.last_chatting_date, '%Y.%m.%d. %H:%i') as last_chatting_date,
							a.last_chatting_comment,
							FN_AES_DECRYPT(c.member_name) AS member_name,
							c.member_img as member_img,
							FN_AES_DECRYPT(d.member_name) AS partner_member_name,
							d.member_img as partner_member_img,
							b.title
						FROM
							tbl_chatting_room as a
							join tbl_product as b on b.product_idx=a.product_idx
							left join tbl_member as c on c.member_idx=a.member_idx
							left join tbl_member as d on d.member_idx=a.partner_member_idx
						WHERE
							a.del_yn = 'N'
							and (
								(a.member_idx='$this->member_idx' AND a.member_read_yn='N')
								OR
								(a.partner_member_idx='$this->member_idx' AND a.partner_member_read_yn='N')
							)
		";

		$sql .=" ORDER BY last_chatting_date DESC";

		return $this->query_result($sql,array());

	}


	//채팅방 오픈 여부
	public function chatting_room_check($data) {
		$product_idx = $data['product_idx'];

		$sql = "SELECT
						 a.chatting_room_idx,
						 a.product_idx,
						 a.state
						FROM   tbl_chatting_room as a
						WHERE	 a.del_yn ='N'
							 and a.product_idx=?
		";

			return $this->query_row($sql,
															array(
															$product_idx
															),
															$data);
	}

	//  방등록
	public function	chatting_room_reg_in($data){
		$member_idx     = $data['member_idx'];
		$partner_member_idx = $data['partner_member_idx'];
		$product_idx = $data['product_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_chatting_room
							(
  							member_idx,
								partner_member_idx,
								product_idx,
								state,
								del_yn,
								ins_date,
								upd_date
							)VALUES (
								?,
								?,
								?,
								'N',
								NOW(),
								NOW()
							)
							ON DUPLICATE KEY UPDATE member_idx=?,partner_member_idx=?,product_idx=?,upd_date=NOW()
  ";
   $this->query($sql,
							array(
								$member_idx,
								$partner_member_idx,
								$product_idx,
								$member_idx,
								$partner_member_idx,
								$product_idx,
							),
							$data
							);
     $chatting_room_idx = $this->db->insert_id();


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return $chatting_room_idx;
		}
	}

  //채팅방정보
	public function chatting_room_detail($data) {
		$chatting_room_idx = $data['chatting_room_idx'];

		$sql = "SELECT
						 a.chatting_room_idx,
						 a.product_idx,
						 a.member_idx,
						 a.partner_member_idx,
						 b.member_idx as product_owner_idx,
						 b.product_member_idx as product_order_idx,
						 b.product_state,
						 b.title,
						 b.img_path,
						 DATE_FORMAT(b.ins_date,'%Y.%m.%d') as product_ins_date,
						 b.display_yn,
						 c.del_yn as member_del_yn,
						 d.del_yn as partner_member_del_yn,
						 a.partner_member_idx,
						 a.state,
						 a.ins_date
						FROM   tbl_chatting_room as a
						join tbl_product as b on b.product_idx=a.product_idx
						left join tbl_member as c on c.member_idx=a.member_idx
						left join tbl_member as d on d.member_idx=a.partner_member_idx
						WHERE	 a.del_yn ='N'
							 and a.chatting_room_idx=?
		";

			return $this->query_row($sql,
															array(
															$chatting_room_idx
															),
															$data);
	}


	// 1.  리스트
	public function chatting_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$member_idx = $data['member_idx'];
		$chatting_room_idx = $data['chatting_room_idx'];


		$sql = "UPDATE
							tbl_chatting_room
						SET
							member_read_yn=IF(member_idx='$member_idx','Y', 'N'),
							partner_member_read_yn=IF(partner_member_idx='$member_idx','Y', 'N'),
							member_read_date=now(),
							partner_member_read_date=now(),
							upd_date=NOW()
						WHERE
							chatting_room_idx=?
			";

			$this->query($sql,
									array(
									$chatting_room_idx,
									),
									$data
									);

		$sql = "SELECT
							DATE_FORMAT(a.ins_date,'%Y-%m-%d') as st_date
						FROM
							tbl_chatting_list as a
						WHERE
							a.del_yn = 'N'
							and a.chatting_room_idx='$chatting_room_idx'
							group by DATE_FORMAT(a.ins_date,'%Y-%m-%d')
		";

		$sql .=" ORDER BY DATE_FORMAT(a.ins_date,'%Y-%m-%d') desc limit ?, ?";

		$result_list=	$this->query_result($sql,array($page_no,$page_size),$data);
		$data_array = array();

    if(count($result_list)>0){
			$x=count($result_list)-1;
			$data_arr = array();
			foreach($result_list as $row){
			 $data_arr[$x]['st_date']	= $row->st_date;
			 $st_date= $row->st_date;

			 $data_array2 = array();

			 $result_list2 = $this->chatting_selected_list($chatting_room_idx,$st_date,$member_idx);
			 $j=0;
			 foreach($result_list2 as $row2){
				$data_array2[$j]['ins_hi'] =  $row2->ins_hi;

				if($row2->member_idx ==$member_idx){
					$data_array2[$j]['member_idx']	= "";
					$data_array2[$j]['member_img']	= "";
					$data_array2[$j]['member_name']	= "";
				}else{
					$data_array2[$j]['member_idx']	= $row2->member_idx;
					$data_array2[$j]['member_img']	= !empty($row2->member_img)?$row2->member_img:'/images/default_user.png';
					$data_array2[$j]['member_name']	= $row2->member_name;
				}

				$data_array2[$j]['comment']	= $row2->comment;
				$data_array2[$j]['img_path']	= !empty($row2->img_path)?$row2->img_path:'/images/default_img.png';

				$j++;
			 }

			 $data_arr[$x]['day_list_array']	= $data_array2;
			 $x--;
			}

			for($i=0;$i<count($result_list);$i++){
				$data_array[$i]['st_date'] =$data_arr[$i]['st_date'];
				$data_array[$i]['day_list_array'] =$data_arr[$i]['day_list_array'];
			}
		}

		return $data_array;
	}


	// 1.  리스트
	public function chatting_selected_list($chatting_room_idx,$st_date){

		$sql = "SELECT
							a.chatting_list_idx,
							a.chat_writer_type,
							a.member_idx,
							IFNULL(b.member_img, '/images/default_user.png') as member_img,
							FN_AES_DECRYPT(b.member_name) AS member_name,
					  	a.comment,
							a.img_path,
							a.ins_date,
							DATE_FORMAT(a.ins_date,'%Y-%m-%d') as ins_day,
							DATE_FORMAT(a.ins_date,'%H:%i') as ins_hi
						FROM
							tbl_chatting_list as a
							left join tbl_member as b on b.member_idx=a.member_idx
						WHERE
							a.del_yn = 'N'
							and a.chatting_room_idx='$chatting_room_idx'
							and DATE_FORMAT(a.ins_date,'%Y-%m-%d')='$st_date'
		        ORDER BY a.chatting_list_idx asc
		 ";

		return	$this->query_result($sql,array());

	}

	// 1-1.  리스트 총 카운트
	public function chatting_list_count($data){
		$member_idx = $data['member_idx'];
		$chatting_room_idx = $data['chatting_room_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
            (
							SELECT
							 DATE_FORMAT(a.ins_date,'%Y-%m-%d'),
							 COUNT(*) AS cnt
						 FROM
							 tbl_chatting_list as a
						 WHERE
							 a.del_yn = 'N'
							 and a.chatting_room_idx='$chatting_room_idx'
							 group by DATE_FORMAT(a.ins_date,'%Y-%m-%d')
						) as ta

		";

		return	$this->query_cnt($sql,
															array(
															),$data
															);

	}

	// 등록
	public function	chatting_reg_in($data){
		$member_idx     = $data['member_idx'];
		$chatting_room_idx = $data['chatting_room_idx'];
		$img_path = $data['img_path'];
		$comment         = $data['comment'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_chatting_list
							(
								chatting_room_idx,
								chat_writer_type,
								member_idx,
								comment,
								img_path,
								del_yn,
								ins_date,
								upd_date
							) values (
								 ?,
								 0,
								 ?,
								 ?,
								 ?,
								'N',
								NOW(),
								NOW()
							)
			";

			$this->query($sql,
									array(
										$chatting_room_idx,
										$member_idx,
										$comment,
										$img_path,
									),
									$data
									);


				$sql = "UPDATE
									tbl_chatting_room
								SET
									last_chatting_date = NOW(),
									last_chatting_comment = ?,
									member_read_yn=IF(member_idx='$member_idx','Y', 'N'),
									partner_member_read_yn=IF(partner_member_idx='$member_idx','Y', 'N'),
									member_read_date=now(),
									partner_member_read_date=now(),
									upd_date=NOW()
								WHERE
									chatting_room_idx=?
				";

				$this->query($sql,
										array(
										$comment,
										$chatting_room_idx,
										),
										$data
										);


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}


	// 채팅방 리스트
	public function chatting_member_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$member_idx = $data['member_idx'];

		$sql = "SELECT
							z.member_idx,
							z.chatting_room_idx,
							z.last_chatting_date,
							z.last_chatting_comment,
							c.product_state,
							c.title,
							c.display_yn,
							if(z.member_idx=$member_idx, 'M','P') as member_type,
							if(z.member_idx=$member_idx, b.member_idx,a.member_idx) as partner_member_idx,
							if(z.member_idx=$member_idx, b.member_img,a.member_img) as member_img,
							if(z.member_idx=$member_idx, b.member_nickname,a.member_nickname) as member_nickname,
							ifnull((SELECT count(*)  FROM tbl_chatting_list WHERE del_yn = 'N' AND chatting_room_idx = z.chatting_room_idx AND member_idx = if(z.member_idx=$member_idx, z.partner_member_idx,z.member_idx) AND ins_date >  if(z.member_idx=$member_idx,  ifnull(z.member_read_date,z.ins_date), ifnull(z.partner_member_read_date,z.ins_date))),0) AS my_read_count
						FROM tbl_chatting_room as z
						  join tbl_member as a on a.member_idx=z.member_idx   and  a.del_yn='N'
						  join tbl_member as b on b.member_idx=z.partner_member_idx   and  b.del_yn='N'
						  join tbl_product as c on c.product_idx=z.product_idx
					 WHERE z.del_yn = 'N'
					 and ( (z.partner_member_idx='$member_idx' and z.partner_member_cancel_yn='N' ) or (z.member_idx='$member_idx' and z.member_cancel_yn='N' ) )

		";

		$sql .= "	ORDER BY IF(z.last_chatting_date is null,z.ins_date, z.last_chatting_date) DESC  LIMIT ?,? ";

		return $this->query_result($sql,
															array(
															$page_no,
															$page_size
															),$data
															);
	}

	// 채팅중인회원 리스트 카운트
	public function chatting_member_list_count($data){

    $member_idx = $data['member_idx'];

		$sql = "SELECT
							count(*) as cnt
						FROM tbl_chatting_room as z
						  join tbl_member as a on a.member_idx=z.member_idx   and  a.del_yn='N'
						  join tbl_member as b on b.member_idx=z.partner_member_idx   and  b.del_yn='N'
							join tbl_product as c on c.product_idx=z.product_idx
					 WHERE z.del_yn = 'N'
					 and ( (z.partner_member_idx='$member_idx' and z.partner_member_cancel_yn='N' ) or (z.member_idx='$member_idx' and z.member_cancel_yn='N' ) )

		";

		return $this->query_cnt($sql,array(),$data);

	}


	// 등록
	public function	chatting_del($data){
		$chatting_room_idx = $data['chatting_room_idx'];

		$this->db->trans_begin();

		$sql="UPDATE
						tbl_chatting_room
					SET
					  del_yn='Y',
						upd_date = NOW()
					WHERE
						chatting_room_idx = ?
		";

		$this->query($sql,
								array(
								$chatting_room_idx,
								),
								$data);

		$sql="UPDATE
						tbl_chatting_list
					SET
					  del_yn='Y',
						upd_date = NOW()
					WHERE
						chatting_room_idx = ?
		";

		$this->query($sql,
								array(
								$chatting_room_idx,
								),
								$data);


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// 읽어야 될 데이타
public function member_read_count($data){
	$member_idx = $data['member_idx'];

	$sql = "SELECT
						COUNT(*) AS cnt
					FROM tbl_chatting_list AS a
						JOIN  tbl_chatting_room AS b  ON b.chatting_room_idx=a.chatting_room_idx AND b.del_yn='N'  AND ( b.partner_member_idx='$member_idx'  OR b.member_idx='$member_idx'  )
					WHERE a.del_yn='N'
					AND  a.ins_date >= IF(b.member_idx ='$member_idx', b.member_read_date,b.partner_member_read_date)
					and a.member_idx<>$member_idx
	";

	return	$this->query_cnt($sql,
														array(
														),$data
														);

}


//  읽음
public function	chatting_read_mod_up($data){
	$member_idx     = $data['member_idx'];
	$chatting_room_idx = $data['chatting_room_idx'];

	$this->db->trans_begin();

	$sql = "UPDATE
						tbl_chatting_room
					SET
						member_read_date=if(member_idx=$member_idx, now(),member_read_date),
						member_read_yn=if(member_idx=$member_idx, 'Y',member_read_yn),
						partner_member_read_date=if(partner_member_idx=$member_idx, now(),partner_member_read_date),
						partner_member_read_yn=if(partner_member_idx=$member_idx, 'Y',partner_member_read_yn),
						upd_date=NOW()
					WHERE
						chatting_room_idx=?
	";

	$this->query($sql,
							array(
							$chatting_room_idx
							),
							$data
							);

	if($this->db->trans_status() === FALSE){
		$this->db->trans_rollback();
		return "-1";
	}else{
		$this->db->trans_commit();
		return 1000;
	}
}


}	//클래스의 끝
?>

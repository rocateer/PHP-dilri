<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-15
| Memo : 커뮤니티 댓글/답굴 신고 관리
|------------------------------------------------------------------------
*/

Class Model_board_reply_report extends MY_Model{

	// 신고관리 리스트
	public function board_reply_report_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$member_name = $data['member_name'];
		$title = $data['title'];
		$report_type = $data['report_type'];

		$sql = "SELECT
							a.board_reply_report_idx,
							a.board_reply_idx,
							b.member_idx as reported_member_idx,
							FN_AES_DECRYPT(c.member_name) as member_name,
							FN_AES_DECRYPT(c.member_id) as member_id,
							FN_AES_DECRYPT(d.member_name) as reported_member_name,
							FN_AES_DECRYPT(d.member_id) as reported_member_id,
							a.report_contents,
							a.report_type,
							b.board_idx,
							b.reply_comment,
							c.member_nickname,
							d.member_nickname AS reported_member_nickname,
							a.ins_date,
							DATE_FORMAT(a.upd_date,'%Y.%m.%d') as  upd_date,
							a.del_yn
						FROM
							tbl_board_reply_report a
							LEFT JOIN tbl_board_reply b ON b.board_reply_idx = a.board_reply_idx AND b.del_yn = 'N'
							LEFT JOIN tbl_member c ON c.member_idx = a.member_idx
							LEFT JOIN tbl_member d ON d.member_idx = b.member_idx
							JOIN tbl_board e ON e.board_idx = b.board_idx 
						WHERE
							a.del_yn = 'N'

		";

		if($member_name != ""){
			$sql .= " AND FN_AES_DECRYPT(c.member_name) LIKE '%$member_name%' ";
		}
		if($title != ""){
			$sql .= " AND b.reply_comment LIKE '%$title%' ";
		}
		if($report_type != ""){
			$sql .= " AND a.report_type IN ($report_type) ";
		}
	
		$sql .=" ORDER BY board_reply_report_idx DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data
														 );
	}

	// 신고관리 리스트 총 카운트
	public function board_reply_report_list_count($data){

		$member_name = $data['member_name'];
		$title = $data['title'];
		$report_type = $data['report_type'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board_reply_report a
							LEFT JOIN tbl_board_reply b ON b.board_reply_idx = a.board_reply_idx AND b.del_yn = 'N'
							LEFT JOIN tbl_member c ON c.member_idx = a.member_idx
							LEFT JOIN tbl_member d ON d.member_idx = b.member_idx
							JOIN tbl_board e ON e.board_idx = b.board_idx 
						WHERE
							a.del_yn = 'N'

		";

if($member_name != ""){
	$sql .= " AND FN_AES_DECRYPT(c.member_name) LIKE '%$member_name%' ";
}
if($title != ""){
	$sql .= " AND b.reply_comment LIKE '%$title%' ";
}
if($report_type != ""){
	$sql .= " AND a.report_type IN ($report_type) ";
}

		return $this->query_cnt($sql,array(), $data);
	}

}	//클래스의 끝
?>

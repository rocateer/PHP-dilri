<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2021-09-03
| Memo : FAQ
|------------------------------------------------------------------------
*/

Class Model_faq extends MY_Model{

	// FAQ 리스트
	public function faq_list_get($data){

		$faq_type = (int)$data['faq_type'];
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$sql = "SELECT
							a.faq_idx,
							a.title,
							a.del_yn,
							a.faq_type,
							a.contents,
							a.ins_date
						FROM
							tbl_faq a
						WHERE
							a.del_yn = 'N'
						AND a.faq_type = ?
						AND a.state = 'Y'
						";


		$sql .=" ORDER BY a.faq_idx DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															array(
															$faq_type,
															$page_no,
															$page_size
															),$data
															);
	}

	// FAQ 리스트 총 카운트
	public function faq_list_count($data){
		$faq_type = (int)$data['faq_type'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_faq a
						WHERE
							a.del_yn = 'N'
							AND a.faq_type = ?
							AND a.state = 'Y'
						";

		return $this->query_cnt($sql,
														array(
														$faq_type
														),
														$data
													);
	}


}	//클래스의 끝
?>

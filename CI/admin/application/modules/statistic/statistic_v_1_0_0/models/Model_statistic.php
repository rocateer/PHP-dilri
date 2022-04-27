<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	심정민
| Create-Date : 2021-10-20
| Memo : 통계
|------------------------------------------------------------------------
*/

Class Model_statistic extends MY_Model {

	// 검색어 통계 리스트
	public function search_list($data) {
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							title,
							sum(search_cnt) AS search_cnt
						FROM
							tbl_search
						WHERE
							search_type = '0'";

		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		
		$sql .= " GROUP BY
								title
							ORDER BY
								search_cnt DESC, title ASC
							LIMIT ?,?
							";

		return $this->query_result($sql,
															array(
																$page_no,
																$page_size
															),
															$data
														);
	}
	
	// 검색어 통계 리스트 카운트
	public function search_list_count($data) {
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							(SELECT
								title
							FROM
								tbl_search
							WHERE
								search_type = '0'
							GROUP BY
								title) AS ta
						";

		return $this->query_cnt($sql,
															array(
															),
															$data
														);
	}

	// 카테고리 통계 리스트
	public function category_list($data) {
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							title,
							sum(search_cnt) AS category_cnt
						FROM
							tbl_search
						WHERE
							search_type = '1'";

		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		
		$sql .= " GROUP BY
								title
							ORDER BY
								category_cnt DESC, title ASC
							LIMIT ?,?
							";

		return $this->query_result($sql,
															array(
																$page_no,
																$page_size
															),
															$data
														);
	}
	
	// 카테고리 통계 리스트 카운트
	public function category_list_count($data) {
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							(SELECT
								title
							FROM
								tbl_search
							WHERE
								search_type = '1'";
								
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		
		$sql .=	"	GROUP BY
								title) AS ta
						";
				

		return $this->query_cnt($sql,
															array(
															),
															$data
														);
	}

}	// 클래스의 끝

?>

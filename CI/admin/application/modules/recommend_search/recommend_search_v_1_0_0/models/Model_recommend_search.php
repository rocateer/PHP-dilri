<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2021-10-15
| Memo : 추천 검색어 관리
|------------------------------------------------------------------------
*/

Class Model_recommend_search extends MY_Model {

	// 추천 검색어 관리 리스트 _ 중고거래 추천 검색어
	public function recommend_search_list() {

		$sql = "SELECT
							recommend_search_idx,
							title,
							type,
							display_yn,
							order_no
						FROM
							tbl_recommend_search
						where
							type = '0'
						order by recommend_search_idx
						";

		return $this->query_result($sql, array());
	}
	
	// 추천 검색어 관리 리스트 _ 커뮤니티 추천 검색어
	public function recommend_community_list() {

		$sql = "SELECT
							recommend_search_idx,
							title,
							type,
							display_yn,
							order_no
						FROM
							tbl_recommend_search
						where
							type = '1'
						order by recommend_search_idx
						";

		return $this->query_result($sql, array());
	}

	// 추천 검색어 관리 저장
  public function recommend_search_mod_up($data){

		$title = $data['title'];
		$display_yn = $data['display_yn'];
		$recommend_search_idx = $data['recommend_search_idx'];

		$this->db->trans_begin();

		for ($i=0; $i < count($recommend_search_idx) ; $i++) {

			$sql = "UPDATE
								tbl_recommend_search
							SET
								title=?,
								display_yn=?
							WHERE
							  recommend_search_idx = ?
			";
				
			$this->query($sql,
									 array(
									 $title[$i],
									 $display_yn[$i],
									 $recommend_search_idx[$i]
									 ),
									 $data);
		}
	
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
  }

}	// 클래스의 끝

?>

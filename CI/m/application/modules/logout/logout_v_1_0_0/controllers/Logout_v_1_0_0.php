<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	심정민
| Create-Date : 2021-10-22
| Memo : 로그아웃
|------------------------------------------------------------------------
*/

class Logout_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model(mapping('logout').'/model_logout');

	}


//인덱스
  public function index() {
		$this->logout();
	}

	public function logout() {

		$data['member_idx'] = $this->member_idx;

		$result = $this->model_logout->member_gcm_del($data);//gcm_key 삭제

		
		$this->sess_destroy();
  }

	public function double_login_logout() {
		$this->sess_destroy();
  }
	
	public function sess_destroy() {
		
		$member_data = array(
			"member_idx" => "",
			"member_id" =>  "",
			"gcm_key" =>  "",
			"device_os" =>  "",
			"app_yn" =>  $this->app_yn,
			"uuid" =>  $this->uuid,
		);

		$this->session->set_userdata($member_data);
		
		set_cookie('member_idx', "", 3600*24*365);
		set_cookie('member_id', "", 3600*24*365);
		set_cookie('gcm_key', "", 3600*24*365);
		set_cookie('device_os', "", 3600*24*365);
		set_cookie('app_yn', $this->app_yn, 3600*24*365);
		set_cookie('uuid', $this->uuid, 3600*24*365);

		// echo "4";
		// exit; 

    // redirect('/?member_idx=&app_yn='.$this->app_yn.'&logout_yn=Y');
    redirect('/'.mapping('main').'?logout_yn=Y');
  }

}// 클래스의 끝
?>

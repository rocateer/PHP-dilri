<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :    김옥훈
| Create-Date : 2016-02-25
| Memo : 메인화면
|------------------------------------------------------------------------
*/



class Language extends MY_Controller{
  function __construct(){
    parent::__construct();

    $this->load->helper('url');
    $this->load->library('session');
    $this->load->library('global_function');


  }

  public function index(){
    $this->main();
  }

  //다국어 설정
  public function nation_change(){

    $this_url=($this->input->post("this_url", TRUE) != "")    ?    $this->escstr($this->input->post("this_url", TRUE)) : "";
    $nationcode=($this->input->post("nationcode", TRUE) != "")    ?    $this->escstr($this->input->post("nationcode", TRUE)) : "";

    //url division
    $lang_check = explode("/",$this_url);
    $result = str_replace($lang_check[0]."//".$lang_check[2]."/".$lang_check[3],$lang_check[0]."//".$lang_check[2]."/".$nationcode,$this_url);

    echo json_encode($result);
    exit;

  }

}
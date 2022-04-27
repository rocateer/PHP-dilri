<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 감옥훈
| Create-Date : 2018-03-02
| Memo : 부운영자권한관리
|------------------------------------------------------------------------

_input_check 가이드
_________________________________________________________________________________
|  !!. 변수설명
| $key       : 파라미터로 받을 변수명
| $empty_msg : 유효성검사 실패 시 전송할 메세지,
|              ("empty_msg" => "유효성검사 메세지") 로 구분하며 list 타입임.
| $focus_id  : 유효성검사 실패 시 foucus 이동 ID,
|              ("focus_id" => "foucus 대상 ID")
| $ternary  : 삼항 연산자 받을 변수명
|              ("ternary" => "1")
| $esc       : 개행문자 제거 요청시 true, 아닐시 false
|              false를 요청하는 경우-> (ex. 장문의 글 작성 시 false)
|           	 값이 array 형태일 경우 false로 적용
| $regular_msg : 정규표현식 검사 실패 시 전송할 메세지,
|              ("regular_msg" => "정규표현식 메세지","type" => "number")
| $type    	: 유효성검사할 타입
|           	 number   : 숫자검사
|            	email    : 이메일 양식 검사
|            	password : 비밀번호 양식 검사
|            	tel1     : 전화번호 양식 검사 (- 미포함)
|            	tel2     : 전화번호 양식 검사 (- 포함)
|            	custom   : 커스텀 양식, $custom의 양식으로 검사함
|            	default  : default, 검사를 안합니다.
| $custom 	: 유효성검사 custom으로 진행 시 받을 값 (정규표현식)
|
|  !!!. 값이 array형태로 들어올 경우
| $this->input_chkecu("파라미터로 받을 변수명[]");
| 형태로 받는다.
|_________________________________________________________________________________
*/

class Excel_upload_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		/* Library */
		$this->load->library('phpexcel');

		/* model */
	 $this->load->model(mapping('excel_upload').'/model_excel_upload');

	}

	public function index(){
		$this->data_upload();
	}

	public function data_upload(){

		$response = new stdClass();

		$this->_view(mapping('excel_upload').'/view_data_upload',$response);
	}

	/*
	|------------------------------------------------------------------------
	| Memo :  엑셀업로드
	|------------------------------------------------------------------------
*/
	public function data_excel_fileUpload(){
		$upload_data_type = $this->_input_check("upload_data_type",array());

		$this->load->view(mapping('excel_upload').'/view_data_excel_upload',array('upload_data_type'=>$upload_data_type));
	}

	//엑셀 업로드
	public function data_excel_upload_action() {
		date_default_timezone_set('Asia/Seoul');
		$upload_data_type = $this->_input_check("upload_data_type",array());

		if(!is_dir("./media/commonfile/")){
			@mkdir("./media/commonfile/",0777);
		}
		if(!is_dir("./media/commonfile/".date("Ym")."/")){
			@mkdir("./media/commonfile/".date("Ym")."/",0777);
		}
		if(!is_dir("./media/commonfile/".date("Ym")."/".date("d")."/")){
			@mkdir("./media/commonfile/".date("Ym")."/".date("d")."/",0777);
		}
		$file_path=ABS_PATH."/media/commonfile/".date("Ym")."/".date("d")."/";
		$file_url="/media/commonfile/".date("Ym")."/".date("d")."/";

		$config['upload_path'] = $file_path;
		$config['max_size']	= '100000000';
		$config['encrypt_name']  = 'true';
		$config['remove_spaces']  = 'true';
		$config['allowed_types'] = '*';

		$this->load->library('upload', $config);

		if($this->upload->do_upload('file')){

			$data=$this->upload->data();

			$list = array(
				'orig_name'=>$data['orig_name'],
				'filename' =>$data['file_name'],
				'file_type'=>$data['file_type'],
				'file_ext' =>$data['file_ext'],
				'path'     =>$file_url.$data['file_name'],
				'path2'    =>$file_path,
				'url'      =>$file_url.$data['file_name'],
			 );

			$filecode=$file_url.$data['file_name'];
			$this->data_detail_excel($filecode, $list, $upload_data_type);
		}else{
			$this->load->view(mapping('excel_upload').'/view_data_excel_upload_success', array("result"=>'1'));
		}
	}

	//엑셀 업로드 ::임시데이타 등록
	public function data_detail_excel($filecode, $list, $upload_data_type) {
		header("Content-type: text/html; charset=utf-8");
		ini_set('memory_limit','-1');

		$this->load->library('phpexcel');
		$objPHPExcel = PHPExcel_IOFactory::load('..'.$filecode);

	  $keycode=time();
	  $orig_name=$list['orig_name'];
	  $data['keycode']=$keycode;
	  $data['upload_data_type']=$upload_data_type;
		$cnt=0;
		for($z=0;$z<1;$z++){
			$objPHPExcel->setActiveSheetIndex($z);

			$objWorksheet = $objPHPExcel->getActiveSheet();
			$rowIterator = $objWorksheet->getRowIterator();
			$i=0;
			$data_detail=array();
			foreach($rowIterator as $row) {
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false);

				$k=0;
				foreach ($cellIterator as $cell){
					$data_detail[$i][$k]= $cell->getValue();
			    $k++;
				}
				$i++;

			}
			$data['data_detail'] =$data_detail;

			if($upload_data_type=="0"){
				$result=$this->model_excel_upload->temp_data_reg_in($data); //임시테이블 등록
			}else{
				$result=$this->model_excel_upload->immediately_reg_in($data); //바로등록
			}


		}
		$this->load->view(mapping('excel_upload').'/view_data_excel_upload_success', array('orig_name'=>$orig_name,'keycode'=>$keycode,'upload_data_type'=>$upload_data_type,'result'=>$result));
	}

	// 임시데이타 리스트 get
	public function temp_data_list_get(){
		$keycode = $this->_input_check("keycode",array());

		$data['keycode'] = $keycode;

		$result_list = $this->model_excel_upload->temp_data_list($data);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->no = count($result_list);

		$this->_list_view(mapping('excel_upload').'/view_data_upload_list_get', $response);
	}

	// 데이타 등록
	public function real_data_reg_in(){
		$keycode = $this->_input_check("keycode",array());

		$data['keycode'] = $keycode;

		$result = $this->model_excel_upload->real_data_reg_in($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "등록 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "등록 성공하였습니다.";
		}
		echo json_encode($response);
		exit;
	}



}// 클래스의 끝
?>

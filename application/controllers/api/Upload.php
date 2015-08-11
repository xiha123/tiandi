<?php
include_once(APPPATH . 'controllers/api/Base_api.php');

class Upload extends base_api {
	function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('course_model');
		$this->me = $this->admin_model->check_login();
	}


	public function pic(){
       	parent::require_login();
		$type = $this->input->post("type", true);




		if(isset($_FILES["userfile"])){
			$data = $this->course_model->get_list($type);
			if(!isset($data[0]['steps']['img'])){
				$config['file_name'] =date("Ymd"). rand(100000000000,9999999999999);
			}else{
				$config['file_name'] =$data[0]['steps']['img'];
			}
            	$config['overwrite'] = true;
			$config['upload_path'] = './static/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['file_name'] =date("Ymd"). rand(100000000000,9999999999999);
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload("userfile")){
				echo  '{"status" : "false"}';
			}else{
				$data = $this->upload->data();
				$this->load->model ("admin_model" , "model");
				echo  '{"status" : "true"}';
			}
		}
	}


}

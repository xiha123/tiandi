<?php

class upload extends CI_Controller {
	function __construct() {
		parent::__construct();
		// $this->load->model('admin_model');
		// $this->user_info = $this->admin_model->check_login();
	}

	public function pic(){
		$type = $this->input->post("type", true);
		$id = $this->input->post("id", true);
		if(isset($_FILES["userfile"])){
			$config['upload_path'] = './static/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['file_name'] =date("Ymd"). rand(100000000000,9999999999999);
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload("userfile")){
				echo  '{"status" : "false"}';
			}else{
				$data = $this->upload->data();
				$this -> load -> model ("admin_model" , "model");
				$this -> model -> insertUploadPic($id , $type , $data["file_name"]);
				echo  '{"status" : "true"}';
			}
		}
	}
}

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
			$data = $this->course_model->get_list($type,0,1,true);
			$temp=array();
			$file = json_decode($data[0]['site']);
			foreach ($file as $key => $value) {
				$temp[$value->t] = $value->value;
			}
			$file=$temp;
			if(@$file["img"] ==""){
				$config['file_name'] = date("Ymd"). rand(100000000000,9999999999999);
			}else{
				$config['file_name'] = $file['img'];
			}
            	$config['overwrite'] = true;
			$config['upload_path'] = './static/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload("userfile")){
				echo  '{"status" : "false","error":"无法上传照片到服务器"}';
			}else{
				$file = $this->upload->data();
				$this->course_model->edit_tag($type,
					array("site" => $this->edit_json($data[0]['site'],"img",$file['file_name'], true))
				);
				$this->load->model ("admin_model" , "model");
				echo  '{"status" : "true"}';
			}
		}
	}


}

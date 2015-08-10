<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class Guide_api extends base_api {
	public function __construct(){
		parent::__construct();
		$this->load->model("guide_model");
		$this->load->model("admin_model");
    		$this->me = $this->admin_model->check_login();
	}
	// public function delete_guide(){
	// 	parent::require_login();$params = $this->get_params('POST', array( 'id'));extract($params);
	// 	if($this->guide_mode->remove($id)){
  		// 	$this->finish(true);
  		// }else{
    // 			$this->finish(false,"网络异常，无法删除");
  		// }
	// }

	public function edit_guide(){
		parent::require_login();$params = $this->get_params('POST', array( 'id','title','link'));extract($params);
		$guide_data = $this->guide_model->get(array("id" => $id));
		if(isset($_FILES["userfile"])){
			$config['upload_path'] = './static/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['file_name'] = $guide_data['img'] == "" ? date("Ymd"). rand(10000000,99999999).".jpg" : $guide_data['img'];
			$config['overwrite'] = true;
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload("userfile")){
       			$this->finish(false,"无法上传照片");
			}else{
				if($this->guide_model->edit($id,array(
					"name" => $title,
					"img" => $config['file_name'],
					"link" => $link,
				))){
       				 $this->finish(true);
				}else{
       				 $this->finish(false,"未知原因导致上传失败");
				}
			}
		}else{
			if($this->guide_model->edit($id,array(
				"name" => $title,
				"link" => $link,
			))){
     				 $this->finish(true);
			}else{
     				 $this->finish(false,"未知原因导致上传失败");
			}
		}
	}


}
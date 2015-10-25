<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class Video_api extends Base_api {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->me = $this->admin_model->check_login();
	}

	public function remove_video(){
		parent::require_login();
		$this->load->helper('file');
		$video_file_name = $this->input->post("videoName" , true);
		$video_file = dirname(APPPATH) . "/video/" . $video_file_name;
		if(file_exists($video_file)){
			if(unlink($video_file)){
				parent::finish(true );
			}else{
				parent::finish(false , "没有权限删除该文件或该文件被占用！");
			}
		}else{
			parent::finish(false , "视频不存在无法删除该视频！");
		}
	}

	public function do_upload(){
		parent::require_login();
		$config['upload_path'] = './video/';
		$config['allowed_types'] = 'avi|rmvb|wmv|mp4|flv';
		$config['max_size'] = 1024 * 500;
		$config['file_name'] = rand(1000000,9999999) . rand(1000000,9999999);
		$this->load->library('upload',$config);
		if($this->upload->do_upload("videoFile")){
			$file_name = $this->upload->data('file_name');
			parent::finish(true , "" , $file_name);
		}else{
			parent::finish(false , "无法上传视频到服务器");
		}
	}

}
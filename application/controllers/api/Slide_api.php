<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class slide_api extends base_api {
    public function __construct() {
		parent::__construct();
		$this->load->model('slide_model');
    }

    public function create() {
		$this->load->model('admin_model');
        $this->me = $this->admin_model->check_login();
        parent::require_login();
        $params = parent::get_params('POST', array('name', 'type', 'link', 'color'));
        extract($params);

		if(!isset($_FILES["userfile"])) parent::finish(false, '请选择图片');
		if(empty($name)) parent::finish(false, '请输入名称');
		if(empty($link)) parent::finish(false, '请输入链接');
		if(empty($color)) parent::finish(false, '请输入背景色');

		$config['upload_path'] = './static/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '2048';
		$config['file_name'] =date("Ymd"). rand(100000000000,9999999999999);
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload("userfile")){
            parent::finish(false, $this->upload->display_errors());
		} else {
			$returnConfig = $this->upload->data();
			$data = array(
				'name' => $name,
				'type' => 1,
				'img' => $returnConfig['file_name'],
				'link' => $link,
				'color' => $color,
			);
			$this->db->insert('slide', $data);
            parent::finish(true);
		}
    }
}

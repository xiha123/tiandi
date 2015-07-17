<?php defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('admin_model');
		$this->user_info = $this->admin_model->check_login();
	}

	public function index() {
		if (empty($this->user_info)) redirect('admin/login');

		$data = array (
			'me' => $this->user_info
		);

		$this->load->view('admin/home.php', $data);
	}

	public function slider(){
		if (empty($this->user_info)) redirect('admin/login');

		$data = array (
			'me' => $this->user_info
		);

		$this->load->view('admin/slider.php', $data);
	}

	public function users() {
		if (empty($this->user_info)) redirect('admin/login');

		$data = array (
			'me' => $this->user_info
		);

		$this->load->view('admin/users.php', $data);
	}

	public function login() {
		$this->load->view('admin/login.php');
	}

	public function onlineClass(){
		if (empty($this->user_info)) redirect('admin/login');

		$data = array (
			'me' => $this->user_info
		);

		$this->load->view('admin/onlineClass.php', $data);
	}


	//添加首页轮播图片
	public function addIndexSlider(){
		$title = $this->input->post("title", true);
		$link = $this->input->post("link", true);
		$description = $this->input->post("description", true);
		$color = $this->input->post("color", true);

		$config['upload_path'] = './static/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload("updata")){
			$this->load->view('admin/slider.php' , array("uptype" => false));
		}else{
			$returnConfig = $this->upload->data();
			$this->load->database();
			$data = array(
				'title' => $title,
				'link' => $link,
				'time' => time(),
				'description' => $description,
				'type' => "0",
				'img' => $returnConfig['file_name'],
				'color' => $color,
			);
			$this->db->insert('tiand_index_slider', $data);
			$this->load->view('admin/slider.php' , array("uptype" => true));
		}
	}




	//在线课堂 轮播设置

	//在线课堂课程表
	public function onlineList(){
		$this->load->view('admin/onlineList.php');
	}

	//新手引导栏设置
	public function onlineNew(){
		$this->load->view('admin/onlineNew.php');
	}

	//课程方向引导栏设置
	public function onlineGoTo(){
		$this->load->view('admin/onlineGoTo.php');
	}


	//课程内容详情页设置
	public function onlineListContent(){
		$this->load->view('admin/onlineListContent.php');
	}


	public function onlineClassSlider(){
		$this->load->view('admin/onlineClassSlider.php');
	}
}

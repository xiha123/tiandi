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
		$this->load->database();

		$data_list = array();
		$this->db->order_by("time", "DESC"); 
		$temp_list = $this->db->get('slide');
		
		
		$temp_list = $temp_list->result();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"id" => $temp_list[$index] -> id,
				"title" => $temp_list[$index] -> name,
				"img" => $temp_list[$index] -> img,
				"link" => $temp_list[$index] -> link,
				"time" =>date("Y-m-d H:i:s" ,  $temp_list[$index] -> time),
				"color" => $temp_list[$index] -> color,
				"text" => $temp_list[$index] -> text,
			));
		}
		
		$data = array(
			"data_list" => $data_list,
			"me" => $this->user_info
		);
		$this->load->library('parser');
		$this->parser->parse('admin/slider.php', $data);
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
			'me' => $this->user_info,
			'guide' => $this->admin_model->get_guide()
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
		$config['max_size'] = '2048';


		$this->load->library('upload', $config);
		if(!$this->upload->do_upload("userfile")){
			echo  '{"status" : "false" , "error" : "' . $this->upload->display_errors() . '"}';
		}else{
			$returnConfig = $this->upload->data();
			$this->load->database();
			$data = array(
				'id' => "NULL",
				'name' => $title,
				'type' => "0",
				'img' => $returnConfig['file_name'],
				'link' => $link,
				'color' => $color,
				'time' => time(),
				'text' => $description,

			);
			$this->db->insert('slide', $data);
			echo  '{"status" : "true"}';
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

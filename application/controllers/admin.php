<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	public function index(){
		$this->load->model('admin_interface' , "admin");
		$user_info = $this->admin->check_login();
		if (empty($user_info)) {
			$this->load->view('admin/login.php');
		} else {
			$this->load->view('admin/home.php', $user_info);
		}
	}

	public function slider(){
		$this->load->database();
		$data_array = array();
		$query = $this->db->get('tiand_index_slider');
		foreach ($query->result() as $row){
			array_push($data_array , array(
				"title" => $row->title , 
				"link" => $row->link , 
				"time" => $row->time ,
				"description" => $row->description ,
				"type" => $row->type ,
				"img" => $row->img ,
				"color" => $row->color));
		}
		$data = array(
			"data_list" => $data_array,
		);
		$this->load->library('parser');
		$this->parser->parse('admin/slider.php' , $data);
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
	public function onlineClass(){
		$this->load->view('admin/onlineClass.php');
	}
	
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

	public function onlineClass(){
		$this->load->view('admin/onlineClass.php');
	}

	public function login() {
		$this->load->model('admin_interface', "admin");
		$username = $this->input->post("username", true);
		$password = $this->input->post("password", true);

		if ($username === '' || $password === '') {
			$this->finish(-1, '用户名和密码不能为空');
			return;
		}

		if ($this->admin->login($username , $password) === false) {
			$this->finish(-1, '用户名或密码错误');
			return;
		}

		$this->finish(0);
	}

	private function finish($status, $error='', $data='') {
        echo json_encode(array(
	        'status' => $status,
			'error' => $error,
			'data' => $data
        ));
	}

}

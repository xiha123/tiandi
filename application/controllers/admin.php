<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('admin_model' ,"model");
		$this->load->model('slide_model');
		$this->load->model('course_model');
		$this->user_info = $this->model->check_login();

	}

	public function index() {
		if ($this->model->require_login() === false) redirect('admin/login');
		$data = array (
			'me' => $this->model->me
		);
		$this->load->view('admin/home.php', $data);
	}

	public function slider(){
		if(empty($this->user_info)) redirect('admin/login');
		$returnData = $this ->slide_model -> get_list(0);
		$data = array(
			"data_list" => $returnData,
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


	//编辑首页图片
	public function eidtIndexSlider(){
		$title = $this->input->post("title", true);
		$link = $this->input->post("link", true);
		$description = $this->input->post("description", true);
		$color = $this->input->post("color", true);
		$id = $this->input->post("id", true);
		$type = $this->input->post("type", true);

		if(isset($_FILES["userfile"])){
			$config['upload_path'] = './static/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['file_name'] =date("Ymd"). rand(100000000000,9999999999999);
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload("userfile")){
				echo  '{"status" : "false" , "error" : "' . $this->upload->display_errors() . '"}';
			}else{
				$returnConfig = $this->upload->data();
				$this->load->database();
				$data = array(
					'name' => $title,
					'type' => $type,
					'img' => $returnConfig['file_name'],
					'link' => $link,
					'color' => $color,
					'time' => time(),
					'text' => $description,

				);
				$this->db->where('id', $id);
				$this->db->update('slide', $data);
				echo  '{"status" : "true"}';
			}
		}else{
			$this->load->database();
			$data = array(
				'name' => $title,
				'type' => $type,
				'link' => $link,
				'color' => $color,
				'text' => $description,
			);
			$this->db->where('id', $id);
			$this->db->update('slide', $data);
			echo  '{"status" : "true"}';
		}
	}


	//添加首页轮播图片
	public function addIndexSlider(){
		$title = $this->input->post("title", true);
		$link = $this->input->post("link", true);
		$description = $this->input->post("description", true);
		$color = $this->input->post("color", true);
		$type = $this->input->post("type", true);

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
				'type' => $type,
				'img' => $returnConfig['file_name'],
				'link' => $link,
				'color' => $color,
				'text' => $description,
			);
			$this->db->insert('slide', $data);
			echo  '{"status" : "true"}';
		}
	}




	/*
	*	课程详情
	*	classList		首页 （课程设置，课程的添加删改）
	*	classListSite 	课程详细设置
	*/
	public function classList(){
		if (empty($this->user_info)) redirect('admin/login');
		$returnData = $this -> course_model -> get_list(0);
		$data = array(
			"data_list" => $returnData,
			"me" => $this->user_info
		);
		$this->load->library('parser');
		$this->parser->parse('admin/classList/home.php' , $data);
	}

	public function classListTag(){
		if (empty($this->user_info)) redirect('admin/login');
		$returnData = $this -> admin_model -> getClassList();
		$data = array(
			"data_list" => $returnData,
			"me" => $this->user_info
		);
		$this->load->library('parser');
		$this->parser->parse('admin/classList/home.php' , $data);
	}

	public function classListSite($id = ""){
		if(empty($this->user_info)) redirect('admin/login');
		$return_data = $this -> admin_model -> getClassListData($id);
		$return_tag = $this -> admin_model -> getClassListTag($id);
		$return_chapter = $this -> admin_model -> getClassListChapter($id);
		$return_course_0 = $this -> admin_model -> getClassListCourse($id);
		$return_course_1 = $this -> admin_model -> getClassListCourse($id , "1");

		$data = array (
			"id" => $id,
			"data_tag" => $return_tag,
			"data_list" => $return_data,
			"data_chapter" => $return_chapter,
			'me' => $this->user_info,
			"course_0" => $return_course_0,
			"course_1" => $return_course_1
		);
		$this->load->library('parser');
		$this->parser->parse('admin/classList/classListSite.php', $data);
	}



	/*
	*	在线课堂
	*	onlineClass 首页 （新手引导）
	*	onlineSlider 轮播设置
	*	onlineGoTo 课程方向引导
	*/
	public function onlineClass(){
		if (empty($this->user_info)) redirect('admin/login');
		$data = array (
			'me' => $this->user_info,
			'guide' => $this->admin_model->get_guide()
		);
		$this->load->view('admin/onlineClass/home.php', $data);
	}
	public function onlineSlider(){
		if (empty($this->user_info)) redirect('admin/login');
		$this -> load -> model ("admin_model" , "model");
		$returnData = $this -> slide_model -> get_list(1);
		$data = array(
			"data_list" => $returnData,
			"me" => $this->user_info
		);
		$this->load->library('parser');
		$this->parser->parse('admin/onlineClass/onlineSlider.php', $data);
	}
	public function onlineGoTo(){
		if (empty($this->user_info)) redirect('admin/login');
		$data = array(
			"me" => $this->user_info
		);
		$this->load->library('parser');
		$this->parser->parse('admin/onlineClass/onlineGoTo.php', $data);
	}

}

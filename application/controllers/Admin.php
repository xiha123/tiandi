<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load-> model ("guide_model" );
		$this->load->model('admin_model' );
		$this->load->model('slide_model');
		$this->load->model('course_model');
		$this->load->model('course_class_model');
    	$this->load->model('course_chapter_model');
    	$this->load->model('user_model');
		$this->user_info = $this->admin_model->check_login();
	}

	public function fake_users() {
		if($this->admin_model->require_login() === false) redirect('admin/login');
		for ($i = 0; $i < 100; $i++) {
			$this->user_model->create(array(
				"nickname" => $i,
				"email" => $i . '@kingcraft.cc',
				"pwd" => 'miaoda'
			));
		}
	}

	public function god_apply(){
		if($this->admin_model->require_login() === false) redirect('admin/login');
		$data['page'] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$data['me'] = $this->user_info;
		$data['user'] = $this->user_model->get_list(array("type" => 2) , ($data['page'] - 1) , 10);
		foreach ($data['user'] as $key => $value) {
			$data['user'][$key]['type'] = $data['user'][$key]['type'] == "2" ? "<font style='color:#cc0000;font-weight:700'>待审核</font>" : "";
		}
		$data['user_max'] = $this->user_model->get_count(array("type" => 2));
		$this->load->library('parser');
		$this->parser->parse('admin/god_apply.php', $data);
	}

	public function user(){
		if($this->admin_model->require_login() === false) redirect('admin/login');
		$data['page'] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$data['me'] = $this->user_info;
		$where = !isset($_GET['search']) ? array() : array("id" => $this->input->get("search"));
		$data['user'] = $this->user_model->get_list($where, ($data['page'] - 1) , 10);
		foreach ($data['user'] as $key => $value) {
			if($data['user'][$key]['type']  == "0"){
				$data['user'][$key]['type'] = "学员";
			}else{
				$data['user'][$key]['type'] = $data['user'][$key]['type'] == "1" ? "大神" : "<font style='color:#cc0000;font-weight:700'>待审核</font>";
			}
		}
		$data['user_max'] = $this->user_model->get_count($where);
		$this->load->library('parser');
		$this->parser->parse('admin/user.php', $data);
	}

	public function index() {
		if ($this->admin_model->require_login() === false) redirect('admin/login');
		$data = array (
			'me' => $this->admin_model->me
		);
		$this->load->view('admin/home.php', $data);
	}

	public function slider(){
		if(empty($this->user_info)) redirect('admin/login');
		$data['page'] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$returnData = $this ->slide_model -> get_list(0,($data['page']-1)*5);

		$data = array(
			"data_count" => $this ->slide_model -> get_count(array("type" => 0)),
			"data_list" => $returnData,
			"me" => $this->user_info,
			"page" => $data["page"]
		);
		$this->load->library('parser');
		$this->parser->parse('admin/slider.php', $data);
	}

	public function tags() {
		if (empty($this->user_info)) redirect('admin/login');
		$this->load->model('tag_model');
		$page = !isset($_GET['page']) ? 1 : $this->input->get('page');
		$where = !isset($_GET['search']) ? array() : array("id" => $this->input->get("search"));
		$search_type = !isset($_GET['search']) ? false : true;

		$list = $this->tag_model->get_list($where, ($page - 1) * 10, 10);
		$tag_count = $this->tag_model->get_count($where);
		foreach ($list as &$item) {
			$item['type'] = $item['type'] === 0 ? '课程' : '秒答';
		}
		$data = array (
			'me' => $this->user_info,
			'tags' => $list,
			"page" => $page,
			"tag_count" => $tag_count
		);
		$this->parser->parse('admin/tags.php', $data);
	}

	public function problems() {
		if (empty($this->user_info)) redirect('admin/login');
		$this->load->model('problem_model');
		$page = !isset($_GET['page']) ? 1 : $this->input->get['page'];
		$where = !isset($_GET['search']) ? array() : array("id" => $this->input->get("search"));
		$search_type = !isset($_GET['search']) ? false : true;
		$list = $this->problem_model->get_list($where , ($page - 1) * 10, 10);
		$problem_count = $this->problem_model->get_count($where);


		foreach ($list as &$item) {
			switch($item['type']) {
				case '0':
					$item['type'] = '未认领';
					break;
				case '1':
					$item['type'] = '认领中';
					break;
				case '2':
					$item['type'] = '已回答';
					break;
				case '3':
					$item['type'] = '已关闭';
					break;
			}
			$item['owner'] = $this->user_model->get(array(
				'id' => $item['owner_id']
			))['nickname'];
			$item['answer'] = $this->user_model->get(array(
				'id' => $item['answer_id']
			))['nickname'];
		}
		$data = array (
			'me' => $this->user_info,
			'list' => $list,
			'page' => $page,
			'problem_count' => $problem_count,
			'search_type' => $search_type,
		);
		$this->parser->parse('admin/problems.php', $data);
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
				$data = array(
					'name' => $title,
					'type' => $type,
					'img' => $returnConfig['file_name'],
					'link' => $link,
					'color' => $color,
					'text' => $description,
				);
				$this->db->where('id', $id);
				$this->db->update('slide', $data);
				echo  '{"status" : "true"}';
			}
		}else{
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
		$page = isset($_GET['page']) ? $this->input->get("page") : 1;
		$returnData = $this->course_model->get_list("all" , ($page - 1) * 10 ,10);
		$course_max = $this->course_model->get_count(array());
		$data = array(
			"page" => $page,
			"data_list" => $returnData,
			"me" => $this->user_info,
			"course_max" => $course_max,
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

		$data = $this->course_model->get_list($id , 0 , 1)[0];
		if(count($data) <= 0) show_404();

		$data['class_type'] = $this->input->get("type");
		$data['page'] = !isset($_GET['page']) ? "1" : $this->input->get("page");

		switch ($data['class_type']) {
			case 'tag':
				$data["tag_count"] = count($data['tags'] );
				$data['tags'] =  $data['page'] -1* 10 > $data["tag_count"] ? array_slice($data['tags'],($data['page'] -1)* 10 ) : $data['tags'] = array_slice($data['tags'],($data['page'] -1)* 10 , 10);
				break;

			case 'step':
				$data["steps_count"] = count($data['steps'] );
				$data['steps'] =  $data['page'] -1* 10 > $data["steps"] ? array_slice($data['steps'],($data['page'] -1)* 10 ) : $data['steps'] = array_slice($data['steps'],($data['page'] -1)* 10 , 10);
				break;
			
			case 'chapter':
				$data["chapter_count"] = $this->course_chapter_model->get_count(array());
				$data['chapter'] = $this->course_chapter_model->get_list(array("course_id" => $id) ,$data['page'] -1* 10 , 10);
				break;

			case 'class':
				$data["class_count"] = $this->course_class_model->get_count(array());
				$data['class'] = $this->course_class_model->get_list(array("form" => $id) ,$data['page']-1 * 10 , 10);
				break;

			default:
				$data["tag_count"] = count($data['tags'] );
				$data['tags'] =  $data['page'] -1* 10 > $data["tag_count"] ? array_slice($data['tags'],($data['page'] -1)* 10 ) : $data['tags'] = array_slice($data['tags'],($data['page'] -1)* 10 , 10);
				foreach ($data['tags'] as $key => $value) {

				}
				break;
		}

		$data['me'] = $this->user_info;
		$data['type'] = $id;


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
			'guide' => $this->guide_model->get_guide()
		);
		$this->load->view('admin/onlineClass/home.php', $data);
	}

	public function onlineGoTo(){
		if (empty($this->user_info)) redirect('admin/login');
		$this->load->model('site_model');
		$this->parser->parse('admin/onlineClass/onlineGoTo.php', array(
			"me" => $this->user_info,
			'guide_list' => $this->guide_model->get_list(),
			'slide_list' => $this->slide_model->get_list(1),
			'schedule_course' => $this->site_model->get_content('001'),
			'schedule_date' => $this->site_model->get_content('002'),
		));
	}

}

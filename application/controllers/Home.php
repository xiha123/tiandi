<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("problem_model");
		$this->load->model('course_model');
		$this->load->model("tag_model");
		$this->me = $this->user_model->check_login();
	}

	public function index() {
		$id = !isset($_GET['uid']) ? false : $this->input->get("uid");
		if($id == false) show_404();

		$user_data = $this->user_model->get_user($id);
		if($user_data == false) show_404();


		// 决定给用户展示什么页面
		$user_type = $user_data['type'] == 2 ? 0 : $user_data['type'];
		if($user_type > 2 || $user_type < 0) show_404();
		if(!isset($_GET["home"])){
			$user_type = $user_type == 1 && @$this->me['id'] != $id ? 2 : $user_type;
		}else{
			$user_type = 0;
		}


		// 构造数据准备传递
		$push_data = $this->me;
		$push_data['data'] = array("u3d","Swift","Web","Cocos2d-x","Android");
		$push_data['user'] = $user_data;
		$push_data['love'] = isset($_GET['love']) ? true : false;
		$push_data['owner'] = isset($_GET['owner']) ? true : false;
		$push_data['follow_type'] = false;
		$push_data["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");

		if($user_type == 0){
			if($push_data['love']){
				$push_data['follow_type'] = true;
				$love_user = json_decode($push_data['user']['follow_users']);
				$owner_list_count = count($love_user);
				$problem_list = array();
				$love_user = array_slice($love_user, ($push_data["page"] - 1) * 6 , 6);
				foreach ($love_user as $key => $value) {
					array_push($problem_list , $this->user_model->get(array("id" => $value[0])));
				}
				$push_data['hot'] = "&love=love";

			}
			if($push_data['owner']){
				$problem_list = $this->problem_model->handle_tag($this->problem_model->get_list(array("owner_id" => $id) , $push_data['page'] - 1 , 20));
				$owner_list_count = $this->problem_model->get_count(array("owner_id" => $id));
				$push_data['hot'] = "&owner=owner";
				foreach ($problem_list as $key => $value) {
					$problem_list[$key]['answer_id'] = $this->user_model->get(array("id" => $value['answer_id']) , array("nickname"));
				}
			}
			if(!$push_data['love'] && !$push_data['owner'] ){
				$problem_list = $this->problem_model->get_collect($push_data['user']['collect_problems']);
				$owner_list_count = count($push_data['user']['collect_problems']);
				$push_data['hot'] = "";
				foreach ($problem_list as $key => $value) {
					$problem_list[$key]['answer_id'] = $this->user_model->get(array("id" => $value['answer_id']) , array("nickname"));
				}
			}

			$push_data['problem_list'] = $problem_list;
			$push_data['owner_list_count'] = $owner_list_count;
		}
		if($user_type == 1){
			$temp_data = array();
			$course_data = $this->course_model->get_list("all" , 0 , 2 , true , true);
			foreach ($course_data as $key => $value) {
				$value['type'] = $push_data['data'][$value['type']];
				$temp_data[] = $value;
			}
			$push_data["course"] = $temp_data;
			$push_data["recommend_list"] = $this->problem_model->get_list_by_hot(0, 5 , "random","hot",false);
			$push_data["hot_type"] = isset($_GET['ok']) ? true : false;
			if(!$push_data["hot_type"]){
				$push_data["news_problem"] = $this->problem_model->get_list_by_time($push_data["page"]-1, 5,0);
				$push_data["problem_list_count"] = $this->problem_model->get_count(array("type" => 0));
			}else{
				$push_data["news_problem"] = $this->problem_model->get_answer($id , $push_data["page"]);
				$push_data["problem_list_count"] = $this->problem_model->answer_count($id);
			}
		}
		if($user_type == 2){
			$temp_data = array();
			$course_data = $this->course_model->get_list("all" , 0 , 3 , true , true);
			foreach ($course_data as $key => $value) {
				$value['type'] = $push_data['data'][$value['type']];
				$temp_data[] = $value;
			}
			$push_data["course"] = $temp_data;
			$push_data["answer"] = $this->problem_model->get_answer($id , $push_data["page"]  , 10);
			$push_data["answer_count"] = $this->problem_model->answer_count($id);
		}

		switch ($user_type) {
			case 0:$file_name = "studentHome.php";break;
			case 1:$file_name = "god/home.php";break;
			case 2:$file_name = "god/show.php";break;
		}
		$this->parser->parse("miaoda/" . $file_name , $push_data);
	}

}

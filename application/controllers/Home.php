<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("problem_model");
		$this->load->model("god_course_model");
		$this->load->model('course_model');
		$this->load->model("tag_model");
		$this->me = $this->user_model->check_login();
	}

	/***/
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
			$push_data['active_nav'] = 1;
		}else{
			$user_type = 0;
			$push_data['active_nav'] = 0;
		}


		// 构造数据准备传递
		$push_data = $this->me;
		$push_data['data'] = array("u3d","Swift","Web","Cocos2d-x","Android");
		$push_data['user'] = $user_data;
		$push_data['love'] = isset($_GET['love']) ? true : false;
		$push_data['owner'] = isset($_GET['owner']) ? true : false;
		$push_data['follow_type'] = false;
		$page = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$push_data["page"] = $page < 1 ? '1' : $page;

		if($user_type == 0){
			if($push_data['love']) {
				$push_data['follow_type'] = true;
				$love_user = json_decode($user_data['follow_users']);
				$owner_list_count = count($love_user);
				$problem_list = array();
				//$love_user = array_slice($love_user, ($push_data["page"] - 1) * 6 , 6);
				foreach ($love_user as $value) {
					//$this->user_model->get(array("id" => $item['answer_id']) , array("nickname"))
                    		$problem_list[] = $this->user_model->get(array('id' => $value));
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
		if($user_type == 1) {
			$push_data['course'] = $this->god_course_model->get_list(array(
				'god' => $user_data['id']
			), 0, 4);

			$recommend_list = $this->problem_model->get_recommend_list(0);
			$push_data["recommend_list"]  = $recommend_list;

			$push_data["hot_type"] = isset($_GET['ok']) ? true : false;
			if($push_data["hot_type"]) {
				$push_data["news_problem"] = $this->problem_model->get_answer($id , $push_data["page"], 5);
				$push_data["problem_list_count"] = $this->problem_model->answer_count($id);
			} else {
				$news_problems = $this->db->query('select * from problem where type = 0 order by id desc')->result_array();
				foreach ($recommend_list as $p) {
					foreach ($news_problems as $index => $new_p) {
						if ($p['id'] == $new_p['id']) {
							unset($news_problems[$index]);
						}
					}
				}
				$push_data["problem_list_count"] = count($news_problems);
				$news_problems = array_slice($news_problems, ($push_data['page'] - 1) * 5, 5);
				foreach($news_problems as &$item) {
					$item['ctime'] = date("H:i:s",strtotime($item['ctime']));
					$item['tags'] = $this->tag_model->get_list_by_json($item['tags']);
				}
				$push_data["news_problem"] = $news_problems;
				//$push_data["news_problem"] = $this->problem_model->get_list_by_time($push_data["page"] - 1, 5, 0);
				//$push_data["problem_list_count"] = $this->problem_model->get_count(array("type" => 0));
			}
		}
		if($user_type == 2){
			$push_data['course'] = $this->god_course_model->get_list(array(
				'god' => $user_data['id']
			), 0, 4);

			$push_data["answer"] = $this->problem_model->get_answer($id , $push_data["page"]  , 10);
			$push_data["answer_count"] = $this->problem_model->answer_count($id);
		}

		switch ($user_type) {
			case 0:$file_name = "studentHome.php";break;
			case 1:$file_name = "god/home.php";break;
			case 2:$file_name = "god/show.php";break;
		}

		// 在问过列表中添加众筹的问题
		function custom_sort($a, $b) {
			return $b['id']  - $a['id'];
		}
		if ($push_data['owner']) {
			$fund_list = $this->problem_model->get_json($user_data['chou']);
			$push_data['problem_list'] = array_merge($push_data['problem_list'], $fund_list);
			usort($push_data['problem_list'], "custom_sort");
		}

		$this->parser->parse("miaoda/" . $file_name , $push_data);
	}

	public function active($key = '') {
		if ($key === '') show_404();
		if ($this->me === false) show_404();

		if ($this->me['key'] !== $key) {
			echo '无效激活码';
			return;
		}
		if ($this->me['email_active'] == 1) {
			echo '该账户已激活';
			return;
		}

		$this->user_model->edit($this->me['id'], array(
			'email_active' => 1,
			'silver_coin' => 'silver_coin + 300'
		));

		$this->load->model('news_model');
		$this->news_model->create(array(
			'target' => $this->me['id'],
			'type' => '002'
		));
		redirect('userset');
	}

}

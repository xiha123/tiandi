<?php

class Tag extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("tag_model");
		$this->load->model("problem_model");
	}

	public function index() {

		if (empty($_GET['name'])) show_404();

		if(isset($_GET['hot'])) {
			$type = "hot";
			$problem_type = "hot";
		} else {
			$type = "ctime";
			if(isset($_GET['love'])) {
				$problem_type = "love";
			} else {
				$problem_type = "";
			}
		}


		$name = $this->input->get("name", true);
		$userdata = $this->user_model->check_login();

		$userdata['tag_data'] = $this->tag_model->get_tag(0 , 1 , $name);
		if(!isset($userdata['tag_data'])) show_404();

		$page = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$userdata["page"] = $page < 1 ? '1' : $page;
		if(count($userdata['tag_data']) <= 0) show_404();

		switch ($problem_type) {
			case 'hot':
				$userdata['tag_list'] = $this->problem_model->get_list_by_tag($name , "hot", $userdata['page'] - 1);
				$userdata['problem_list_count'] = $this->problem_model->get_list_by_tag_count($name , array("who !=" => "[]"));
				break;
			case 'love':
				$userdata['tag_list'] = $this->problem_model->get_list_by_tag($name , "chou", $userdata['page'] - 1);
				$userdata['problem_list_count'] = $this->problem_model->get_list_by_tag_count($name , array("up_count >=" => 1));
				break;
			default:
				$userdata['tag_list'] = $this->problem_model->get_list_by_tag($name , $type, $userdata['page'] - 1);
				$userdata['problem_list_count'] = $this->problem_model->get_list_by_tag_count($name);
				break;
		}


		/*开始构造数据准备传递*/
		$userdata['hot_type'] = $problem_type;
		$userdata['tag_count'] = $this->tag_model->get(array(
			'type' => 1,
			'name' => $name
		))['count'];

		$userdata['collect_type'] = $this->tag_model->is_collect_tag($userdata['tag_data']['id']);


		// 大神与标签学员榜
		$god_array = array();
		$student_array = array();
		$data = $this->tag_model->get(array("name" => $name));
		if(!isset($data)) show_404();
		$data = json_decode($data['json_who']);
		foreach ($data as $key => $value) {
			$user = $this->user_model->get_user_list(array("id"=>$value->t , "type" => 0 , "type" => 2),0,13);
			$god = $this->user_model->get_list(array("id"=>$value->t , "type" => 1),0,5);
			if($god != array()){
				array_push($god_array , $god);
			}
			if($user != array()){
				array_push($student_array ,$user );
			}
		}
		$userdata['student'] = $student_array;
		$userdata['god'] = $god_array;

		$this->parser->parse("miaoda/tag/home.php" , $userdata);
	}

}

<?php

class Index extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("problem_model");
		$this->load->model("problem_detail_model");
		$this->load->model("problem_comment_model");
		$this->load->model("user_model");
	}
	public function index(){
		if(!isset($_GET['p']) || $_GET['p'] == ""){show_404();}
		$id = $this->input->get("p");
		$userdata = $this->user_model->check_login();
		$userdata["problem_data"] = $this->problem_model->get_list_by_id($id);
		if(!isset($userdata["problem_data"]["title"])){
			show_404();
		}

		// 用户每次访问问题增加火力值
		$this->problem_model->hot($id , "0.01" , true);


		$userdata["problem_detail"] = $this->problem_detail_model->get_detail($userdata["problem_data"]['id']);
		$userdata["problem_user"] = $this->user_model->get_user_data($userdata["problem_data"]["owner_id"]);
		@$userdata["problem_collect"] = $this->user_model->is_problem($id) == true ? true : false;
		$userdata["problem_follow"] = !$this->user_model->is_problem($id , "follow_problems")  ? true : false;
		$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$userdata["problem_commenct"] = $this->problem_comment_model->get_list(array(
				"problem_id" => $userdata["problem_data"]['id']
		),$userdata["page"] - 1, 5);
		$index = 0;
		foreach ($userdata["problem_commenct"] as $key => $value) {
			$userdata["problem_commenct"][$index]['user']=$this->user_model->get_user_data($value['owner_id']);
			$index ++;
		}
		$userdata["page_max"] = $this->problem_comment_model->get_count(array(
				"problem_id" => $userdata["problem_data"]['id']
		));



		//Get god max count
		$userdata['god_count'] = $this->user_model->get_count(array("type" => 1));

		// User online  problem handle
		$this->problem_model->online_problem($id);

		// God of temporary storage
		$userdata['temp_data'] = $this->problem_detail_model->get(array("problem_id" => $id , "type" => 3));

		// Problem time out
		if($userdata["problem_data"]["type"] == 1 && $userdata["problem_data"]["answer_time"] + 1200 < time()){
			$this->problem_model->def($userdata["problem_data"]["id"]);
			$userdata["problem_data"]["type"] = "0";
			$this->news_model->add_news($userdata["problem_data"]["answer_id"] , "您认领的问题已经过期，如若超时两次则24小时内不能再认领任何问题！");

			//Empty problem temp data
			$this->problem_detail_model->remove_where(array("problem_id" => $id , "type" => 3));
		}


		$this->load->library('parser');
		$this->parser->parse("miaoda/problem/problem.php" , $userdata);
	}

}
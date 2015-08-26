<?php

class Miaoda extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model("user_model");
		$this->load->model("problem_model");
		$this->load->model("problem_detail_model");

	}

	public function index() {
		$userdata = $this->user_model->check_login();
		$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");

		if(isset($_GET['hot'])){
			if($_GET['hot'] == "chou"){
				$userdata["hot_type"] = "2";
				$userdata["problem_list"] = $this->problem_model->get_problem_value(($userdata["page"] -1) *10);
				$userdata["problem_list_count"] = $this->problem_model->get_count(array("who !=" => "[]"));
			}else{
				$userdata["hot_type"] = "0";
				$userdata["problem_list"] = $this->problem_model->get_list_by_hot($userdata["page"] -1);
				$userdata["problem_list_count"] = $this->problem_model->get_count(array("up_count >" => 1));
			}
		}else{
			$userdata["hot_type"] = "1";
			$userdata["problem_list_count"] = $this->problem_model->get_list_count();
			$userdata["problem_list"] = $this->problem_model->get_list_by_time($userdata["page"] -1);
		}
		foreach ($userdata["problem_list"] as $key => $value) {
			$userdata["problem_list"][$key]['answer_id'] = $this->user_model->get(array("id"=>$userdata["problem_list"][$key]['answer_id']));
		}

		if($userdata["page"] > ceil($userdata["problem_list_count"] / 20)){
			if($userdata["page"] > 1){
				show_404();
			}
		}
		$this->load->library('parser');
		$this->parser->parse("miaoda/home.php" , $userdata);
	}

}

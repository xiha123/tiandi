<?php


class index extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("problem_model");
		$this->load->model("problem_detail_model");
	}
	public function index(){
		if(!isset($_GET['p']) || $_GET['p'] == ""){show_404();}
		$id = $this->input->get("p");
		$userdata = $this->user_model->check_login();
		$userdata["problem_data"] = $this->problem_model->get_list_by_id($id);
		if($userdata["problem_data"] == false){
			show_404();
		}
		$userdata["problem_detaill"] = $this->problem_detail_model->get_detaill($userdata["problem_data"]['id']);
		$userdata["problem_user"] = $this->user_model->get_user_data($userdata["problem_data"]["owner_id"]);
		$this->load->library('parser');
		$this->parser->parse("seconds/problem/problem.php" , $userdata);
	}

	public function p($id = ""){
		echo "mysql";

	}

}
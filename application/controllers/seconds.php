<?php


class seconds extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model("user_model");
		$this->load->model("problem_model");
		$this->load->model("problem_detail_model");

	}

	public function index() {
		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		// 去你妹的体验！
		if(isset($_GET['hot'])){
			$userdata["hot_type"] = true;
			$userdata["problem_list"] = $this->problem_model->get_list_by_hot($userdata["page"] -1);
		}else{
			$userdata["hot_type"] = false;
			$userdata["problem_list"] = $this->problem_model->get_list_by_time($userdata["page"] -1);
		}


		$userdata["problem_list_count"] = $this->problem_model->get_list_count();
		if($userdata["page"] > ceil($userdata["problem_list_count"] / 20)){
			show_404();
		}

		$this->load->library('parser');
		$this->parser->parse("seconds/home.php" , $userdata);
	}




	public function god() {
		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$this->load->view('seconds/god.php' , $userdata);
	}
	public function search() {
		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$this->load->view('seconds/search.php' , $userdata);
	}
	public function tag(){
		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$this->load->view('seconds/tag.php' , $userdata);
	}
	public function tacher(){
		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$this->load->view("seconds/tacher.php" , $userdata);
	}
	public function student(){
		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$this->load->view("seconds/student.php" , $userdata);
	}

	public function godhome(){
		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$this->load->view("seconds/godhome.php" , $userdata);
	}
	public function closeProblem(){
		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$this->load->view("seconds/closeProblem.php" , $userdata);
	}

	public function p($id = NULL){
		if($id == NULL){show_404();}

		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}


		$problem = $this->problem_model->get_list_by_id($id);
		$userdata["problem_data"] = array($problem);
		$problem = $this->problem_detail_model->get_detaill($id);
		$userdata["problem_detaill"] = array($problem);
		$userdata["problem_user"] = array($this->user_model->get_user_data($problem["owner_id"]));

		$this->load->library('parser');
		$this->parser->parse("seconds/problem.php" , $userdata);
	}

}
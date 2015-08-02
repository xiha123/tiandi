<?php


class seconds extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
	}

	public function index() {
		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$this->load->view('seconds/home.php' , $userdata);
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


}
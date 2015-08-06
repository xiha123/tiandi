<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("problem_model");
	}

	public function index()
	{
		$userdata = $this->user_model->check_login();
		if(!isset($_GET["uid"])){
			show_404();	
		}
		$userdata["user"] = $this->user_model->get_user_data($this->input->get("uid" , true));if(!$userdata['user']){show_404();}
		if($userdata["user"]["type"] == "0"){
			$this->load->view("seconds/studentHome.php" , $userdata);
		}else{
			$userdata["recommend_list"] = $this->problem_model->get_list_by_hot(0 , 5 , "random");
			$userdata["news_problem"] = $this->problem_model->get_list_by_time(0 , 5);
			$userdata["problem_list_count"] = $this->problem_model->get_list_count();
			$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");
			$userdata["hot_type"] = !isset($_GET['ok']) ? true : false;



			$this->load->view("seconds/god/home.php" , $userdata);
		}
	}
}

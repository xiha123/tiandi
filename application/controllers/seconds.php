<?php


class seconds extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
	}

	public function index() {
		$userdata = $this->user_model->check_login();
		print_r($userdata);
		$this->load->view('seconds/home.php' , $userdata);
	}

	public function god() {
		$this->load->view('seconds/god.php');
	}
	public function search() {
		$this->load->view('seconds/search.php');
	}
	public function tag(){
		$this->load->view('seconds/tag.php');
	}
	public function tacher(){
		$this->load->view("seconds/tacher.php");
	}
	public function student(){
		$this->load->view("seconds/student.php");
	}
	public function home(){
		$this->load->view("seconds/studentHome.php");
	}
	public function godhome(){
		$this->load->view("seconds/godhome.php");
	}
	public function closeProblem(){
		$this->load->view("seconds/closeProblem.php");
	}


}
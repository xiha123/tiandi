<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
	}

	public function index()
	{
		$userdata = $this->user_model->check_login();
		if(!isset($_GET["uid"])){
			show_404();
		}
		$userdata["user"] = $this->user_model->get_user_data($this->input->get("uid" , true));
		if(!$userdata['user']){
			show_404();
		}
		$this->load->view("seconds/studentHome.php" , $userdata);
	}
}

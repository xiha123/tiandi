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
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$this->load->view("seconds/studentHome.php" , $userdata);
	}
}

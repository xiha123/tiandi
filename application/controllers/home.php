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
			if($userdata == false){
				exit("请登录后再查看学员主页");
			}
			if($userdata["avatar"] == NULL){
				$userdata["avatar"] = "static/image/default.jpg";
			}
		}else{
			// 用于浏览其他用户的个人主页
			$this->input->get("uid" , true);
			$userdata = array();
		}
		
		$this->load->view("seconds/studentHome.php" , $userdata);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
	}
	public function index()
	{
		$this->load->model('index_model' , "model");
		$data_list = $this -> model -> getIndexSlider();
		$this->load->library('parser');
		$data_list = array("data_list" => $data_list);
		$this->parser->parse('pages/home.php', $data_list);
	}
	public function myhome()
	{
		$userdata = $this->user_model->check_login();
		if($userdata["avatar"] == NULL){
			$userdata["avatar"] = "static/image/default.jpg";
		}
		$this->load->view("seconds/studentHome.php" , $userdata);
	}
}
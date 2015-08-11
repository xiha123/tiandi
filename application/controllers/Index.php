<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
	}
	public function index()
	{
		$this->load->model('index_model' , "model");
		$data_list = $this -> model -> getIndexSlider();
		$this->load->library('parser');
		$userdata = $this->user_model->check_login();
		$userdata['data_list'] = $data_list;

		$this->parser->parse('pages/home.php', $userdata);
	}

}

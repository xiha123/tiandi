<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	public function index()
	{
		$this->load->model('index_model' , "model");
		$data_list = $this -> model -> getSlider();
		$this->load->library('parser');
		$data_list = array("data_list" => $data_list);
		$this->parser->parse('pages/home.php', $data_list);
	}
}

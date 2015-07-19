<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class olClass extends CI_Controller {

	public function index()
	{
		$this->load->model('index_model' , "model");
		$data_list = $this -> model -> getSlider("1");
		$this->load->library('parser');
		$data_list = array("data_list" => $data_list);

		$this->parser->parse('pages/olClass.php', $data_list);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class olClass extends CI_Controller {

	public function index()
	{
		$this->load->model('index_model' , "model");
		$data_list = $this -> model -> getSlider();
		$data_left = $this -> model -> getLefts();
		$this->load->library('parser');
		$data_list = array(
			"data_list" => $data_list,
			"data_left" => $data_left
		);
		$this->parser->parse('pages/olClass.php', $data_list);
	}
}

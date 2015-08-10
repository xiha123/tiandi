<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class olclass extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('slide_model');
		$this->load->model('guide_model');
		$this->load->library('parser');
	}

	public function index() {

		$slide_list = $this->slide_model->get_list(1);
		$guide_list = $this->guide_model->get_list();

		$data = array(
			"slide_list" => $slide_list,
			"guide_list" => $guide_list
		);
		
		$this->parser->parse('pages/olClass.php', $data);
	}

}

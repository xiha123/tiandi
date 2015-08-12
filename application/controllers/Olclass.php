<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Olclass extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('slide_model');
		$this->load->model('guide_model');
		$this->load->library('parser');
	}

	public function index() {
		$userdata = $this->user_model->check_login();
		$userdata['slide_list'] = $this->slide_model->get_list(1);
		$userdata['guide_list'] = $this->guide_model->get_list();
		$userdata['guide_list'] = $this->guide_model->get_list();

		$this->parser->parse('pages/olClass.php', $userdata);
	}

}

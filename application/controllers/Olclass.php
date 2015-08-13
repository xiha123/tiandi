<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Olclass extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('slide_model');
		$this->load->model('guide_model');
		$this->load->model('course_model');
	}

	public function index() {
		$userdata = $this->user_model->check_login();
		$userdata['guide_list'] = $this->guide_model->get_list();
		$userdata['slide_list'] = $this->course_model->get_list("all" , 0 , 3 , true , true);


		$this->load->library('parser');
		$this->parser->parse('pages/olClass.php', $userdata);
	}

}

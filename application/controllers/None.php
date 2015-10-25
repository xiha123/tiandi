<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class None extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->me = $this->user_model->check_login();
	}

	public function index() {
		$this->load->view('pages/QA/404');
	}
}

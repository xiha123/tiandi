<?php

class qa extends CI_Controller {

	function __construct() {
    	parent::__construct();
	}

	public function index() {
    	$this->load->view('pages/QA/formOne.php');
	}

	public function login() {
    	$this->load->view('pages/QA/login.php');
	}
}



<?php

class Seacher extends CI_Controller {

	function __construct() {
    		parent::__construct();
	}

	public function index() {
    		$this->load->view('miaoda/search.php');
	}


}

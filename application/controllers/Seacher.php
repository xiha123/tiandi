<?php

class Seacher extends CI_Controller {

	function __construct() {
    		parent::__construct();
    		$this->me = $this->user_model->check_login();
	}

	public function index() {
		$key = $this->input->get("key");
		$this->me['data'] = array();
    		$this->load->view('miaoda/search.php',$this->me);
	}


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSet extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->me = $this->user_model->check_login();
	}
	public function index()
	{
		if(!isset($this->me['name'])){show_404();}
		$this->load->view('miaoda/userSet.php', $this->me);
	}

}

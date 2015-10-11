<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class godHelp extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->me = $this->user_model->check_login();
	}

	public function index()
	{
		$this->load->view("help/godHelp.php", $this->me);
	}
	public function gift()
	{
		$this->load->view("help/gift.php", $this->me);
	}
}

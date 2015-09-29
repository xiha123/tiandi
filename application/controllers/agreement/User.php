<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->me = $this->user_model->check_login();
	}

	public function index() {
		$this->load->view("agreement/user.php", $this->me);
	}
}

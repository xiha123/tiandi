<?php
class index extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function index() {
		$userdata = $this->user_model->check_login();
		$this->load->view('miaoda/god/list.php' , $userdata);
	}

}

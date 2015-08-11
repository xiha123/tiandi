<?php
class Apply extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->me = $this->user_model->check_login();
	}
	public function index() {
		if($this->me['type'] == 1){exit ("您已经是大神了，无需再次申请！");}
		


		$this->load->view('miaoda/god/apply.php' , $this->me);
	}

}
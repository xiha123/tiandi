<?php

class Seacher extends CI_Controller {

	function __construct() {
    		parent::__construct();
    		$this->me = $this->user_model->check_login();
	}

	public function index() {
		$this->load->model('problem_model');
		$this->load->model('problem_detail_model');

		$key = $this->input->get("key");
		$count = 20; // 需要获取多少个
		$result = array_merge($this->problem_model->search($key, $count), $this->problem_detail_model->search($key, $count));
		$result = array_slice($result, 0, $count);
		$this->me['data'] = array();
		$this->load->view('miaoda/search.php',$this->me);
	}

}

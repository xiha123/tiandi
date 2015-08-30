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
		$this->me["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$this->me["key"] = $key;

		$count = 20; // 需要获取多少个
		$result = $this->problem_model->search($key, $count);
		$result = $this->problem_model->handle_tag($result);

		$this->me['count'] = count($result);
		$result = array_slice($result, 0, $count);
		$this->me['data'] = $result;
		$this->parser->parse('miaoda/search.php', $this->me);
	}

}

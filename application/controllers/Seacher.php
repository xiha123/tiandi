<?php

class Seacher extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->me = $this->user_model->check_login();
	}

	public function index() {
		$data = $this->me;
		$this->load->model('problem_model');
		$this->load->model('problem_detail_model');
		$key = $this->input->get("key");
		$page = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$page = $page < 1 ? '1' : $page;
		$data["page"] = $page;
		$data["key"] = $key;

		$count = 20; // 一页多少个
		$result = $this->problem_model->search($key);
		$result = $this->problem_model->handle_tag($result);

		$data['count'] = count($result);
		$result = array_slice($result, ($page - 1)* $count, $count);
		$data['problems'] = $result;

		$this->parser->parse('miaoda/search.php', $data);
	}

}

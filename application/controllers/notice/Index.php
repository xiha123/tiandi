<?php


class index extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("news_model");
	}


	public function index() {
		$userdata = $this->user_model->check_login();
		if(!$userdata){exit("请登录后再查看");}
		$userdata["news_count"] = $this->news_model->get_news_count($userdata['id']);
		$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$userdata["news_list"] = $this->news_model->get_news($userdata['id'] , $userdata["page"] , 20);
		$this->load->view('notice/home.php' , $userdata);
	}

}
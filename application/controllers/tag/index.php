<?php


class Index extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("tag_model");
		$this->load->model("problem_model");
	}
	public function index(){
		if(!isset($_GET['name']) || $_GET['name'] == ""){show_404();}
		$type = !isset($_GET['hot']) ? "ctime" : "hot";
		$name = $this->input->get("name");
		$userdata = $this->user_model->check_login();
		$userdata['tag_data'] = $this->tag_model->get_tag(0 , 1 , $name);
		if(!$userdata['tag_data'])show_404();
		$userdata["hot_type"] = !isset($_GET['hot']) ? false : true;
		$userdata['tag_list'] = $this->problem_model->get_list_by_tag($name , $type);
		$userdata['problem_list_count'] = $this->problem_model->get_list_by_tag_count($name);
		$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$userdata['tag_count'] = $this->problem_model->get_list_by_tag_count($name);
		$userdata['collect_type'] = $this->tag_model->is_collect_tag($userdata['tag_data']['id']);
		$this->load->library('parser');
		$this->parser->parse("miaoda/tag/home.php" , $userdata);
	}



}

<?php


class index extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("news_model");
	}


	public function index() {
		$userdata = $this->user_model->check_login();
		if(!$userdata){exit("请登录后再查看");}
		
		// 用户查看通知页面后就将所有未读的消息设为已读
		$this->news_model->edit_array(array("to" => $userdata['id']),array("type" => "1"));
		$userdata = $this->user_model->check_login();
		
		// 拉出通知列表以及页数相关
		$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$userdata["news_count"] = $this->news_model->get_news_count($userdata['id']);
		$userdata["news_list"] = $this->news_model->get_news($userdata['id'] , $userdata["page"] , 20);

		$this->load->view('notice/home.php' , $userdata);
	}

}
<?php

class Tag extends CI_Controller {
    public $headTitle = '';
    public $headKeyWords = '';
    public $headDesc = '';
	public function __construct() {
		parent::__construct();
		$this->load->model("tag_model");
		$this->load->model("problem_model");

	}

	public function index() {
		if (empty($_GET['name'])) show_404();

		if (isset($_GET['hot'])) {
			$type = "hot";
			$problem_type = "hot";
		} else {
			$type = "ctime";
			if(isset($_GET['love'])) {
				$problem_type = "love";
			} else {
				$problem_type = "";
			}
		}


		$name = $this->input->get("name", true);
		$userdata = $this->user_model->check_login();

		$userdata['tag_data'] = $this->tag_model->get_tag(0 , 1 , $name);
		if(!isset($userdata['tag_data'])) show_404();

		$page = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$userdata["page"] = $page < 1 ? '1' : $page;
		if(count($userdata['tag_data']) <= 0) show_404();

		switch ($problem_type) {
			case 'hot':
				$userdata['tag_list'] = $this->problem_model->get_list_by_tag($name , "hot", $userdata['page'] - 1 , 10);
				$userdata['problem_list_count'] = $this->problem_model->get_list_by_tag_count($name , array("who !=" => "[]"));
				break;
			case 'love':
				$userdata['tag_list'] = $this->problem_model->get_list_by_tag($name , "not", $userdata['page'] - 1 , 10);
				$userdata['problem_list_count'] = $this->problem_model->get_list_by_tag_count($name , array("type" => 0));
				break;
			default:
				$userdata['tag_list'] = $this->problem_model->get_list_by_tag($name , $type, $userdata['page'] - 1 , 10);
				$userdata['problem_list_count'] = $this->problem_model->get_list_by_tag_count($name);
				break;
		}


		/*开始构造数据准备传递*/
		$userdata['hot_type'] = $problem_type;
		$userdata['tag_count'] = $this->tag_model->get(array(
			'type' => 1,
			'name' => $name
		))['count'];

		$userdata['collect_type'] = $this->tag_model->is_collect_tag($userdata['tag_data']['id']);


		// 大神与标签学员榜
		$userdata['active_god'] = $this->tag_model->get_active_user($userdata['tag_data']['id'], 5, true);
		$userdata['active_stu'] = $this->tag_model->get_active_user($userdata['tag_data']['id'], 5);

        $this->headTitle = "秒答_{$name}问题集合";
        $this->headKeyWords = "{$name},自学{$name},{$name}学习,{$name}学习资料";
        $this->headDesc = $userdata['tag_data']['content'];
		$this->parser->parse("miaoda/tag/home.php" , $userdata);
	}

}

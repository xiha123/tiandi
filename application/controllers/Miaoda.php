<?php

class Miaoda extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model("user_model");
		$this->load->model("problem_model");
		$this->load->model("problem_detail_model");

	}

	public function index() {
		$userdata = $this->user_model->check_login();
		$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");

		if(isset($_GET['hot'])){
			if($_GET['hot'] == "chou"){
				$userdata["hot_type"] = "2";
				$userdata["problem_list"] = $this->problem_model->get_fund_list(($userdata["page"] - 1));
				$userdata["problem_list_count"] = $this->problem_model->get_fund_count();
			}else{
				$userdata["hot_type"] = "0";
				$userdata["problem_list"] = $this->problem_model->get_hot_list($userdata["page"] - 1);
				$userdata["problem_list_count"] = $this->problem_model->get_count(array("up_count >" => 1));
			}
		}else{
			$userdata["hot_type"] = "1";
			$userdata["problem_list_count"] = $this->problem_model->count(array("type" => 3));
			$userdata["problem_list"] = $this->problem_model->get_list_by_time($userdata["page"] - 1);
		}

		foreach ($userdata["problem_list"] as $key => $value) {
			$userdata["problem_list"][$key]['answer_id'] = $this->user_model->get(array("id"=>$userdata["problem_list"][$key]['answer_id']));
		}

		if($userdata["page"] > ceil($userdata["problem_list_count"] / 20)){
			if($userdata["page"] > 1){
				show_404();
			}
		}

		$hot_tags = $this->tag_model->get_tag(0 , 20 , "all");
		$hot_tags = empty($hot_tags) ? array() : $hot_tags;
		foreach ($hot_tags as &$tag) {
			$tag['encode_name'] = urlencode($tag['name']);
		}
		$userdata['hot_tags'] = $hot_tags;

        $this->headTitle = '秒答_国内首个针对零基础初学者学习编程的编程社区_编程问题，就上秒答';
        $this->headKeyWords = '秒答,编程社区,零基础,编程问题,VR游戏,AR游戏,unity5,cocos2dx,android,ios,flash,java,html5';

        $this->headDesc = '秒答是国内首个针对零基础初学者学习编程的编程社区。在这里你能提问Unity3D、Web、Cocos2D-X等热门编程领域的问题。每个问题都能被快速准确地解答，绝不留着难题过夜。让编程初学者不再走弯路，想提升编程学习效率，上秒答，就对了。';


        $this->parser->parse("miaoda/home.php" , $userdata);
	}

}

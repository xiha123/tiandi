<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("problem_model");
		$this->load->model("tag_model");
	}

	public function index() {
		$userdata = $this->user_model->check_login();
		if(!isset($_GET["uid"])){
			show_404();
		}
		$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$uid = $this->input->get("uid");
		$userdata["user"] = $this->user_model->get_user_data($this->input->get("uid" , true));
		if(count($userdata['user']) <=2){
			show_404();
		}
		if($userdata["user"]["type"] == "0" || $userdata["user"]["type"] == "2"){
			$userdata['love'] = isset($_GET['love']) ? true : false;
			$userdata['owner'] = isset($_GET['owner']) ? true : false;
			if($userdata['love']){
				$userdata["problem_list"] = $this->problem_model->get_collect($userdata['user']['follow_problems']);
				$userdata["owner_list_count"] = count($userdata['user']['follow_problems']);
			}
			if($userdata['owner']){
				$userdata["problem_list"] = $this->problem_model->get_answer($uid,$userdata["page"],20,"owner_id");
				$userdata["owner_list_count"] = $this->problem_model->answer_count($uid,"owner_id");
			}
			if(!$userdata['love'] && !$userdata['owner'] ){
				$userdata["problem_list"] = $this->problem_model->get_collect($userdata['user']['collect_problems']);
				$userdata["owner_list_count"] = count($userdata['user']['collect_problems']);
			}
			$index = 0;
			$skilled_tags = json_decode($userdata['skilled_tags']);
			foreach ($skilled_tags as $key => $value) {
				$tagData = $this->tag_model->get(array("id" => $value->t));
				$skilled_tags[$index]->t = $tagData['name'];
				$index ++;
			}
			$userdata["skilled_tags"] = $skilled_tags;
			$this->load->view("miaoda/studentHome.php" , $userdata);

		} else {
			if($userdata['id'] == $uid){
				$userdata["recommend_list"] = $this->problem_model->get_list_by_hot(0, 5 , "random");
				$userdata["hot_type"] = isset($_GET['ok']) ? true : false;
				if(!$userdata["hot_type"]){
					$userdata["news_problem"] = $this->problem_model->get_list_by_time($userdata["page"]-1, 5);
					$userdata["problem_list_count"] = $this->problem_model->get_list_count();
				}else{
					$userdata["news_problem"] = $this->problem_model->get_answer($uid , $userdata["page"] , 5);
					$userdata["problem_list_count"] = $this->problem_model->answer_count($uid);
				}
				$this->load->view("miaoda/god/home.php" , $userdata);
				return false;
			}
			$userdata["answer"] = $this->problem_model->get_answer($uid , $userdata["page"] , 10);
			$userdata["answer_count"] = $this->problem_model->answer_count($uid);
			$this->load->view("miaoda/god/show.php" , $userdata);
		}
	}
}

<?php
include_once(APPPATH . 'controllers/api/Base_api.php');
include_once('./static/lib/phpanalysis/index.php');

class Index extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("problem_model");
		$this->load->model("problem_detail_model");
		$this->load->model("problem_comment_model");
		$this->load->model("user_model");
		$this->load->model("tag_model");
	}

	public function index(){
		if(!isset($_GET['p']) || $_GET['p'] == ""){show_404();}
		$id = $this->input->get("p");
		$userdata = $this->user_model->check_login();
		$userdata["problem_data"] = $this->problem_model->get_by_id($id);
		if(!isset($userdata["problem_data"]["title"])){
			show_404();
		}

		// 用户每次访问问题增加火力值
		$this->problem_model->hot($id , "0.01" , true);
		$tag_replace_temp = array();
		$tag_list_temp = array();
		$tag_list = $this->tag_model->get_list(array() , 0 , 50 , array("name"));
		foreach ($tag_list as $key => $value) {
			array_push($tag_list_temp , $value['name']);
			array_push($tag_replace_temp , "<a href='./tag?name=" . urldecode($value['name']) ."'>" . $value['name'] . "</a>");
		}
		$userdata["problem_detail"] = $this->problem_detail_model->get_detail($userdata["problem_data"]['id']);
		foreach ($userdata['problem_detail'] as $key => $value) {
			foreach ($tag_list_temp as $keys => $value_content) {
				$userdata["problem_detail"][$key]['content'] = str_replace_once($value_content , "<a href='./tag?name=" . urldecode($value_content) ."'>" .$value_content . "</a>" , $userdata["problem_detail"][$key]['content']);
			}
		}

		$userdata["problem_user"] = $this->user_model->get_user_data($userdata["problem_data"]["owner_id"]);
		@$userdata["problem_collect"] = $this->user_model->is_problem($id) == true ? true : false;
		$userdata["problem_follow"] = !$this->user_model->is_problem($id , "follow_problems")  ? true : false;
		$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$userdata["problem_commenct"] = $this->problem_comment_model->get_list(array(
				"problem_id" => $userdata["problem_data"]['id']
		),$userdata["page"] - 1, 5);
		$index = 0;
		foreach ($userdata["problem_commenct"] as $key => $value) {
			$userdata["problem_commenct"][$index]['user']=$this->user_model->get_user_data($value['owner_id']);
			$index ++;
		}
		$userdata["page_max"] = $this->problem_comment_model->get_count(array(
			"problem_id" => $userdata["problem_data"]['id']
		));

		// 推送相关问题推荐 列出关键词
		$problem_temp = array();
		$problem_key = get_tags_arr($userdata["problem_data"]['title'] ." ". strip_tags($userdata['problem_detail'][0]['content']));
		$problem_key = array_unique($problem_key);
		if($userdata['problem_data']['type'] == 0){
			$problem_data = $this->problem_model->search_key($problem_key , 4 , array("type" => 3));
			$userdata['useful_list'] = $problem_data;
		}
		$problem_data = $this->problem_model->search_key($problem_key , 4);
		$userdata['recommend_list'] = $problem_data;
		// $detail_content = $this->problem_detail_model->search_key($problem_key , 2);
		// foreach ($detail_content as $key => $value) {
		// 	$problem_temp[$value['problem_id']] = $this->problem_model->get(array('id'=>$value['problem_id']) , array("title","id"));
		// }
		// foreach ($problem_data as $key => $value) {
		// 	$problem_temp[$value['id']] = array("title" => $value['title'] , "id" => $value['id']);
		// }

		//Get god max count
		$userdata['god_count'] = $this->user_model->get_count(array("type" => 1));

		// User online  problem handle
		$this->problem_model->online_problem($id);

		// God of temporary storage
		$userdata['temp_data'] = $this->problem_detail_model->get(array("problem_id" => $id , "type" => 3));

		// Problem time out
		if($userdata["problem_data"]["type"] == 1 && $userdata["problem_data"]["answer_time"] + 1200 < time()){
			$this->problem_model->def($userdata["problem_data"]["id"]);
			$userdata["problem_data"]["type"] = "0";
			$this->news_model->create(array(
				'target' => $userdata["problem_data"]["answer_id"],
				'type' => '401'
			));

			//Empty problem temp data
			$this->problem_detail_model->remove_where(array("problem_id" => $id , "type" => 3));
		}

		$fund_list = json_decode($userdata['problem_data']['who']);
		$userdata['is_fund'] = in_array($userdata['id'], $fund_list);

		$this->parser->parse("miaoda/problem/problem.php" , $userdata);
	}

}

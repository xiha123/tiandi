<?php
include_once(APPPATH . 'controllers/api/Base_api.php');
include_once('./static/lib/phpanalysis/index.php');

class Index extends CI_Controller {
    public $headTitle = '';
    public $headKeyWords = '';
    public $headDesc = '';
	public function __construct() {

		parent::__construct();
		$this->load->model("problem_model");
		$this->load->model("problem_detail_model");
		$this->load->model("problem_comment_model");
		$this->load->model("user_model");
		$this->load->model("tag_model");
	}
	private function rand_key($max){
		$select_key = "!@#$%^&*()~";$return_data="";
		for($index = 0; $index < $max;$index++){
			$return_data .= $select_key[rand(0 , 10)];
		}
		return $return_data;
	}
	public function index(){
		if(!isset($_GET['p']) || $_GET['p'] == ""){show_404();}
		$id = $this->input->get("p");
		$userdata = $this->user_model->check_login();
		$userdata["page"] = !isset($_GET['page']) ? 1 : $this->input->get("page");
		$userdata["problem_data"] = $this->problem_model->get_by_id($id);
		if(!isset($userdata["problem_data"]["title"])){
			show_404();
		}
		// 用户每次访问问题增加火力值
		$this->problem_model->hot($id , "0.01" , true);
		$tag_replace_temp = array();
		$tag_list_temp = array();
		$tag_list = $this->tag_model->get_list(array() , 0 , 100 , array("name"));
		$problem_detail = $this->problem_detail_model->get_detail($userdata["problem_data"]['id']);
		foreach ($tag_list as $key => $value) {
			$tag_list[$key] = $value['name'];
			array_push($tag_list_temp , $value['name']);
			array_push($tag_replace_temp , "<a href='./tag?name=" . urldecode($value['name']) ."'>" . $value['name'] . "</a>");
		}
        $this->headTitle = $userdata["problem_data"]['title'];
        if (isset($problem_detail[1])) {
            $this->headDesc = strip_tags($problem_detail[1]['content']);
        }else{
            $this->headDesc = $userdata["problem_data"]['title'];
        }

		// problem detail tag replace 感觉这样做性能会很差产自2015年9月11日 12:00:24
		foreach ($problem_detail as &$value) {
			$temp_array = array();
			preg_match_all("/<((?!p)|(?!strong)|(?!b)|(?!span)|(?!em)|(?!i))[^>]+>/i", $value['content'], $matches);
			for ($index=0; $index < count($matches[0]); $index++) {
				$key = "[t:" . $this->rand_key(6) . "]";
				array_push($temp_array, $key);
			}

			$value['content'] = str_replace('&lt;p [removed] normal;&quot;&gt;', "", $value['content']);
			$value['content'] = str_replace('&lt;span [removed] normal;&quot;&gt;', "", $value['content']);
			$value['content'] = str_replace("white-space", "tocurd", $value['content']);
			$value['content'] = str_replace($matches[0] , $temp_array , $value['content']);
			foreach ($tag_list_temp as $key => $values) {
				$temp_array_two = array();
				preg_match_all("/<((?!p)|(?!strong)|(?!b)|(?!span)|(?!em)|(?!i))[^>]+>/i", $value['content'], $ches);
				for ($index=0; $index < count($matches[0]); $index++) {
					$key_value = "[t:" . $this->rand_key(6) . "]";
					array_push($temp_array_two, $key_value);
				}
				$value['content'] = str_replace($ches[0] , $temp_array_two , $value['content']);
				$value['content'] = str_replace_once($tag_list_temp[$key] , $tag_replace_temp[$key] , $value['content']);
				$value['content'] = str_replace($temp_array_two , $ches[0] , $value['content']);
			}
			$value['content'] = str_replace($temp_array , $matches[0] , $value['content']);
		}
		$userdata["problem_detail"]  = $problem_detail;


		// problem from user
		$userdata["problem_user"] = $this->user_model->get_user_data($userdata["problem_data"]["owner_id"]);

		// problem is collect
		$userdata["problem_collect"] = $this->user_model->is_problem($id) ? true : false;

		// problem get commenct list
		$userdata["problem_commenct"] = $this->problem_comment_model->get_list(array(
				"problem_id" => $userdata["problem_data"]['id']
		),($userdata["page"] - 1) * 5, 5);
		foreach ($userdata["problem_commenct"] as &$value) {
			$value['user']=$this->user_model->get_user_data($value['owner_id']);
		}
        $pid = $this->input->get("p");
        $userdata['qqshare'] = site_url('share?'.http_build_query([
                'type'=>'qq',
                'pid'=> $pid,
            ]));
        $userdata['qqzshare'] = site_url('share?'.http_build_query([
                'type'=>'qqz',
                'pid'=> $pid,
            ]));
        $userdata['sinashare'] = site_url('share?'.http_build_query([
                'type'=>'sina',
                'pid'=> $pid,
            ]));
		$userdata["page_max"] = $this->problem_comment_model->get_count(array(
			"problem_id" => $userdata["problem_data"]['id']
		));



		// 推送相关问题推荐 列出关键词
		$problem_temp = array();
		$problem_key = array();
		foreach ($userdata['problem_data']['tags'] as $keys => $values) {
			$problem_key[] = $values['name'];
		}
		if($userdata['problem_data']['type'] == 0){
			$problem_data = $this->problem_model->search_key($problem_key , 4 , array("type" => 3));
			$userdata['useful_list'] = $problem_data;
		}
		$problem_data = $this->problem_model->search_key($problem_key , 4);
		$userdata['recommend_list'] = $problem_data;


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

		if (isset($userdata['id'])) {
			$fund_list = json_decode($userdata['problem_data']['who']);
			$userdata['is_fund'] = in_array($userdata['id'], $fund_list);
		} else {
			$userdata['is_fund'] = false;
		}

		$this->parser->parse("miaoda/problem/problem.php" , $userdata);
	}

}

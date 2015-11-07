<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/Base_model.php');

class Problem_model extends Base_model {

	public function __construct() {
		parent::__construct();
		$this->load->model('tag_model');
		$this->table_name = 'problem';
		$this->me = $this->user_model->check_login();
	}


	/**
	* 用户问题在线人数统计
	* @param problem_id 问题编号
	*/
	public function online_problem($problem_id){
		$problem = $this->get(array("id" => $problem_id));
		if($problem['type'] != 1) return false;
		if(!isset($_SESSION['key'])){
			$_SESSION['key'] = rand(100000 , 999999);
		}
		$key = $_SESSION['key'];
		$problem_online_temp = array();
		$problem_online = json_decode($problem['online']);
		if(count($problem_online) >0){
			foreach ($problem_online as $keys => $value) {
				if($key != $value->key){
					if(time() - $value->time < 90){
						array_push($problem_online_temp , array("key"=>$value->key,"time"=>$value->time));
					}
				}
			}
		}
		array_push($problem_online_temp , array("key"=>$key,"time"=>time()));
		$this->problem_model->edit($problem_id,array("online" => json_encode($problem_online_temp)));
		return true;
	}

	/**
	* 有条件的获得数量
	*/
	public function count($where){
		return $this->db->where($where)->count_all_results($this->table_name);
	}
	/**
	* 处理问题火力值
	* @param problem_id
	* @param hot，要增加或减少的的火力值
	* @param type，为true则增加，false则减少
	* @return bool
	*/
	public function hot($problem_id , $hot , $type = true){
		if($hot <= 0){return false;}
		$up_down = $type ? "+" : "-";
		$this->db->query("update `" . $this->table_name ."` SET
		`hot` = `hot` {$up_down} {$hot}
		WHERE `id` = {$problem_id}");
		return $this->db->affected_rows() > 0;
	}


	/**
	* get_json 通过json获得问题列表
	* @param  [type] $json  [description]
	* @param  [type] $page  [description]
	* @param  [type] $count [description]
	* @return [type]        [description]
	*/
	public function get_json($json , $page = 0, $count = 20){
		$index = 0;
		$returnData = array();
		$json = json_decode($json);
		$json = array_slice($json , $page , $count);
		foreach ($json as $value) {
			$data = parent::get(array(
				'id' => $value
			));
			$data['ctime'] = date("H:i:s",strtotime($data['ctime']));
			@$data['tags'] = $this->tag_model->get_list_by_json($data['tags']);
			$returnData[] = $data;
			$index ++;
		}
		return $returnData;
	}

	/**
	* 特殊问题价值排序，金币第一排序，银币第二排序。
	* @param  integer $page  [description]
	* @param  integer $count [description]
	* @return [type]         [description]
	*/
	public function get_problem_value($page = 0, $count = 20){
		$this->db->limit($page , $count);
		$this->db->order_by("gold_coin","DESC");
		$this->db->order_by("silver_coin","DESC");
		$this->db->where(array("who !=" => "[]" , "type" => 3));
		return $this->handle_tag($this->db->get($this->table_name)->result_array());
	}

	/**
	* handle_tag 处理问题中的tag以及时间
	* @param  [type] $data_array [数据库数据]
	* @return array
	*/
	public function handle_tag($data_array){
		$temp_array = array();
		foreach ($data_array as $key => $value) {
			$value['ctime'] = date("H:i:s",strtotime($value['ctime']));
			@$value['tags'] = $this->tag_model->get_list_by_json($value['tags']);
			$temp_array[] = $value;
		}
		return $temp_array;
	}

	/**
	* 获得最新问题
	* @param  integer $page  [description]
	* @param  integer $count [description]
	* @return [type]         [description]
	*/
	public function get_list_by_time($page = 0, $count = 20, $type = 3) {
		$list = parent::get_list(array("type" => $type), $page, $count);

		foreach($list as &$item) {
			$item['ctime'] = date("H:i:s",strtotime($item['ctime']));
			$item['tags'] = $this->tag_model->get_list_by_json($item['tags']);
		}
		return $list;
	}

	/**
	* 获得热门问题
	* @param  integer $page  [description]
	* @param  integer $count [description]
	* @param  string  $type  [description]
	* @param  string  $key   [description]
	* @return [type]         [description]
	*/
	public function get_list_by_hot($page = 0, $count = 20, $type="desc", $key = 'hot', $up = true) {
		if($up == true) {
			$this->db->where(array("up_count >= " => 1 , "type" => 3));
		}
		$list = $this->db->order_by($key, $type)->limit($count, $page * $count)->get($this->table_name)->result_array();

		foreach($list as &$item) {
			$item['ctime'] = date("H:i:s",strtotime($item['ctime']));
			$item['tags'] = $this->tag_model->get_list_by_json($item['tags']);
		}
		return $list;
	}


	public function get_list_by_fund($page = 0, $count = 20) {
		$list = parent::get_list(array(), $page, $count);

		foreach($list as &$item) {
			$item['ctime'] = date("H:i:s",strtotime($item['ctime']));
			$item['tags'] = $this->tag_model->get_list_by_json($item['tags']);
		}
		return $list;
	}




	public function delete_user($userid){
		$data = $this->db->get_where($this->table_name,array("owner_id" => $userid))->result_array();
		foreach ($data as $key => $value) {
			$tags = json_decode(substr($value['tags'], 0 , strlen($value['tags']) - 2) . "]");

			foreach (empty($tags) ? array() : $tags as $tag_key => $tag_value) {
				if($this->problem_model->get_list_by_tag_count($tag_value->name) <= 1){
					$this->tag_model->delete_tag($tag_value->name);
				}
			}
		}
		$this->db->delete($this->table_name,array(
			"owner_id" => $userid,
		));
	}


	public function get_collect($json , $page = 0, $count = 10, $type = "collect"){
		$collect = json_decode($json);
		if($collect == array())return array();
		foreach ($collect as $key => $value) {
			$this->db->or_where("id" , $value->t);
		}
		$this->db->limit($page * $count , $count);
		$data = $this->db->get($this->table_name)->result_array();
		$index = 0;
		foreach($data as $item) {
			$data[$index]['ctime'] = date("H:i:s",strtotime($item['ctime']));
			@$data[$index]['tags'] = $this->tag_model->get_list_by_json($data[$index]['tags']);
			$index ++;
		}
		return $data;
	}

	public function get_answer($uid , $page = 0 , $count = 10 , $where = "answer_id"){
		$this->db->limit($count , ($page -1)* $count);
		$data = $this->db->get_where($this->table_name,array(
			$where => $uid,
		))->result_array();
		$index = 0;
		foreach($data as $item) {
			$data[$index]['ctime'] = date("H:i:s",strtotime($item['ctime']));
			@$data[$index]['tags'] = $this->tag_model->get_list_by_json($data[$index]['tags']);
			$index ++;
		}
		return $data;
	}
	public function answer_count($uid, $where = "answer_id") {
		return $this->db->where(array(
			$where => $uid
		))->count_all_results($this->table_name);
	}





	// pid, uid
	public function request($params) {
		extract($params);
		$data = $this->db->get_where($this->table_name,array('id' => $params['pid']))->result_array();
		if($data[0]["type"] == "1" || $data[0]["type"] == "2"){
			return false;
		}
		$this->db->where(array(
			'id' => $params['pid'],
			'type' => "0"
		))->update($this->table_name, array(
			'answer_id' => $params['uid'],
			'answer_time' =>  time(),
			'type' => 1
		));
		return $this->db->affected_rows() > 0;
	}

	public function def($pid) {
		$this->db->where(array(
			'id' => $pid,
			'type' => 1
		))->update($this->table_name, array(
			'type' => 0
		));
		return $this->db->affected_rows() > 0;
	}
	public function no($pid) {
		$this->db->where(array(
			'id' => $pid,
			'type' => 2
		))->update($this->table_name, array(
			'type' => 0
		));
		return $this->db->affected_rows() > 0;
	}
	public function done($pid) {
		$this->db->where(array(
			'id' => $pid,
			'type' => 1
		))->update($this->table_name, array(
			'type' => 2
		));
		return $this->db->affected_rows() > 0;
	}

	public function close($pid) {
		$this->db->where(array(
			'id' => $pid['pid'],
			'type' => 2
		))->update($this->table_name, array(
			'type' => 3
		));
		return $this->db->affected_rows() > 0;
	}

	public function get_list_by_id($id) {
		$list = $this->db->where('id', $id)->get($this->table_name)->row_array();
		$list['tags'] = $this->tag_model->get_list_by_json($list['tags']);
		$list = count($list) <= 0 ? false : $list;
		return $list;
	}

	public function get_list_by_tag($tag_name = "" , $type = "ctime" , $page = 0, $count = 20 , $all = false , $tag = true) {
		$index = 0;
		if($type == "hot"){
			$this->db->order_by($type,'DESC');
			$this->db->where(array("up_count >=" => 1));
		}
		if($type == "not"){
			$this->db->where(array("type" => "0"));
		}
		if($type == "ctime"){
			$this->db->order_by($type,'DESC');
		}

		if(!$all){
			$this->db->limit($count, $page * $count);
		}
		$tag_name = str_replace(array("{" , "}") , array("" , "") , json_encode(array("t" => $tag_name)));
		$list = $this->db->like('tags', $tag_name)->get($this->table_name)->result_array();
		if($tag){
			foreach($list as $item) {
				$list[$index]['ctime'] = date("H:i:s",strtotime($item['ctime']));
				$list[$index]['answer_id'] = $this->user_model->get(array("id" => $item['answer_id']) , array("nickname"));
				@$list[$index]['tags'] = $this->tag_model->get_list_by_json($list[$index]['tags']);
				$index ++;
			}
		}
		return count($list) <= 0 ? false : $list;
	}

	public function get_list_by_tag_count($tag_name = "" , $where = array()){
		$tag_name = str_replace(array("{" , "}") , array("" , "") , json_encode(array("t" => $tag_name)));
		return $this->db->like('tags',  ($tag_name))->where($where)->count_all_results($this->table_name);
	}

	public function get_list_count(){
		return $this->db->count_all_results($this->table_name);
	}


	// 收藏问题
	public function collect($pid) {
		if(!$this->user_model->collect_problem($pid))return false;
		$this->db->query("update `" . $this->table_name ."` SET
		`hot` = `hot` + 3 ,
		`collect_count` = `collect_count` + 1
		WHERE `id` = $pid");
		return $this->db->affected_rows() > 0;
	}
	public function uncollect($pid) {
		if(!$this->user_model->uncollect_problem($pid))return false;
		$this->db->query("update `" . $this->table_name ."` SET
		`hot` = `hot` - 3 ,
		`collect_count` = `collect_count` - 1
		WHERE `id` = $pid");
		return $this->db->affected_rows() > 0;
	}




	public function get_problem($pid){
		$data = $this->db->select(array("up_count" , "hot" ,"up_users",'is_prestige','answer_id'))->get_where($this->table_name , array("id" => $pid) , 0,1)->result_array();
		return $data;
	}

	public function up($array) {
		$this->db->where('id', $array['id'])->update($this->table_name, array(
			'up_count' => $array["up_count"],
			'hot' =>  $array["hot"],
			'up_users' =>   $array["up_users"]
		));
		return $this->db->affected_rows() > 0;
	}

	public function down($pid) {
		$this->db->where('id', $pid)->update($this->table_name, array(
			'up_count' => $data[0]['up_count'] - 1,
			'hot' => $data[0]['hot'] - 5,
			'up_users ' =>  json_encode($up_users)
		));
		return $this->db->affected_rows() > 0;
	}

	public function search_key($str, $count , $where=array()) {
		if (empty($str)) return array();
		foreach ($str as $key => $value) {
			$this->db->where($where);
			$this->db->like("title" ,$value);
		}
		return $this->db->order_by('id', 'DESC')->limit($count)->get($this->table_name)->result_array();
	}
	public function search($str) {
		return $this->db->like('title', $str)->order_by('id', 'DESC')->get($this->table_name)->result_array();
	}

	public function get_hot_list($page, $count = 20) {
		$list = $this->db->where(array(
			'type >=' => '2'
		))->order_by('hot DESC, id DESC')->limit($count, $page * $count)->get($this->table_name)->result_array();
		foreach($list as &$item) {
			$item['ctime'] = date("H:i:s",strtotime($item['ctime']));
			$item['tags'] = $this->tag_model->get_list_by_json($item['tags']);
		}
		return $list;
	}

	public function get_fund_list($page) {
		$list = parent::get_list(array(
			'type <=' => '1'
		), $page, 20);
		foreach($list as &$item) {
			$item['ctime'] = date("H:i:s",strtotime($item['ctime']));
			$item['tags'] = $this->tag_model->get_list_by_json($item['tags']);
		}
		return $list;
	}

	public function get_fund_count() {
		return parent::get_count(array(
			'type <=' => '1'
		));
	}

	private function tags_match($problem, $my) {
		if (count($my) === 0) return true;

		foreach($problem as $val) {
			if(in_array($val['name'], $my)) return true;
		}
		return false;
	}

	public function get_recommend_list($page, $count = 5) {
		$this->db->where(array(
			"type" => 0
		));
		$list = $this->db->order_by('id', 'random')->get($this->table_name)->result_array();
		$myTags = json_decode($this->me['god_skilled_tags']);
		$curCount = 0;
		$res = array();

		// 补全tag字典
		$tag_dict = array(
			array('unity-3d', 'unity', 'u3d', 'unity3d', 'unity 3d'),
			array('cocos2d-x', 'cocos2dx', 'coco', 'cocos', '2dx'),
			array('javascript', 'js'),
			array('html5', 'h5'),
			array('objective-c', 'oc', 'objc', 'objectiveC', 'Obj-C'),
			array('android', '安卓'),
			array('actionscript3', 'as3'),
			array('jquery', 'jq'),
		);
		foreach($myTags as $my) {
			foreach($tag_dict as $dict) {
				if (in_array($my, $dict)) {
					$myTags = array_merge($myTags, $dict);
				}
			}
		}

		foreach($list as &$item) {
			$tags = $this->tag_model->get_list_by_json($item['tags']);
			if (!$this->tags_match($tags, $myTags)) continue;
			$item['ctime'] = date("H:i:s",strtotime($item['ctime']));
			$item['tags'] = $this->tag_model->get_list_by_json($item['tags']);
			$res[] = $item;
			if (++$curCount >= $count) return $res;
		}

		return $res;
	}

	public function get_by_id($id) {
		$list = $this->db->where('id', $id)->get($this->table_name)->row_array();
		$list['tags'] = $this->tag_model->get_list_by_json($list['tags']);
		$list = count($list) <= 0 ? false : $list;
		return $list;
	}

	public function get_ask_problems($id) {

	}
}

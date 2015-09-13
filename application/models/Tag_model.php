<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');include_once(APPPATH . 'models/Base_model.php');class Tag_model extends Base_model {	public function __construct() {		parent::__construct();       	$this->load->model('user_model');		$this->table_name = 'tag';	}	public function get_tag_key($key){		if(strlen($key) < 1)return array();		return json_encode($this->db->like("name",$key)->limit(7,0)->get($this->table_name)->result_array());	}	/**	 * 添加一个标签	 * @param name	 * @param type 0:前端页面，1:在线课程标签	 * @param string	 */	public function add_tag($name , $type = "0" , $content = ""){		$name = trim($name);		if(!$this->is_exist(array("name" => $name ,"type" => $type ))){			if(!$this->create(array(				"count" => 0,				"name" => $name,				"type" => $type,				"content" => $content,			))) return false;		}		return true;	}	/**	 * 将JSON转换成TAG数组	 * @param  JSON	 * @return array	 */	public function get_list_by_json($json, $where = "name") {		$result = array();		$list = json_decode($json);		if(count($list) <=0){return false;}		foreach ($list as $tag) {			$data = $this->get(array(				@$where => $tag->t			));			$data['url'] = urlencode($data['name']);			$result[] = $data;		}		return $result;	}	/**	 * 获得tag列表	 * @param start	 * @param count	 * @param id 当ID为all时则列出所有标签	 * @return array	 */	public function get_tag($start = 0 , $count = 5 , $id = "all"){		if($id == "all")$this->db->limit($start * $count , $count);		$tag_data = $id == "all" ? $this->db->order_by('count', 'DESC')->get_where($this->table_name,array("type"=>0))->result_array() : $this->get(array("name" => $id));		return count($tag_data) <= 0 ? false : $tag_data;	}	public function delete_tag($tag_name){		$this->db->delete($this->table_name,array("name" =>$tag_name));		return true;	}	public function is_collect_tag($id){        	$this->me = $this->user_model->check_login();        	$temp_collect = array();        	if(!isset($this->me['skilled_tags'])){        		return false;        	}		$collect_array = json_decode($this->me['skilled_tags']);		if (count($collect_array) <=0)return false;		foreach ($collect_array as $key => $value) {			if($value->t == $id){				return true;			}		}		return false;	}	public function collect_tag($id){        	$this->me = $this->user_model->check_login();		$collect_array = json_decode($this->me['skilled_tags']);		array_push($collect_array , array("t" => $id));		$collect_array = json_encode($collect_array);		if($this->user_model->edit($this->me['id'],array(			"skilled_tags" => $collect_array		))){			return true;		}else{			return false;		}	}	public function uncollect_tag($id){        	$this->me = $this->user_model->check_login();        	$temp_collect = array();		$collect_array = json_decode($this->me['skilled_tags']);		foreach ($collect_array as $key => $value) {			if($value->t != $id){				array_push($temp_collect, array("t" => $value->t));			}		}		$temp_collect = json_encode($temp_collect);		if($this->user_model->edit($this->me['id'],array(			"skilled_tags" => $temp_collect		))){			return true;		}else{			return false;		}	}	public function add_user_tag($id){		$data = $this->get(array("id" => $id));		$tag_array = json_decode($data['json_who']);		array_push($tag_array , array("t" => $this->me['id']));		$tag_array = json_encode($tag_array);		if($this->edit($data['id'],array(			"json_who" => $tag_array		))){			return true;		}else{			return false;		}	}	public function un_user_tag($id){		$data = $this->get(array("id" => $id));		$temp_collect = array();		$tag_array = json_decode($data['json_who']);		foreach ($tag_array as $key => $value) {			if($value->t != $this->me['id']){				array_push($temp_collect, array("t" => $value->t));			}		}		$tag_array = json_encode($temp_collect);		if($this->edit($data['id'],array(			"json_who" => $tag_array		))){			return true;		}else{			return false;		}	}	public function add_tag_json($json){		$result = array();		$json = substr($json, 0 , strlen($json) - 2) . "]";		$json = json_decode($json);		if(count(@$json[0]) < 1){return -1;}		foreach($json as $tag) {			if(strlen($tag->name) < 2 && strlen($tag->name) > 12){				return -2;			}			if(!$this->is_exist(array("name" => $tag->name,"type" =>"0" ))){				$this->create(array(					"count" => "0",					"name" => $tag->name,					"type" => "0",					"content" => "",				));			}		}		return 0;	}	public function plus($id, $count = 1) {		$query = $this->db->select('count')->where('id', $id)->get($this->table_name)->row_array();		$this->db->where('id', $id)->update($this->table_name, array(			'count' => $query['count'] + $count		));	}	public function minus($id, $count = 1) {		$query = $this->db->select('count')->where('id', $id)->get($this->table_name)->row_array();		$this->db->where('id', $id)->update($this->table_name, array(			'count' => $query['count'] - $count		));	}	public function get_tag_list($json){		$result = array();		foreach (json_decode($json) as $value) {			$result[] = $this->get(array(				'id' => $value->t			));		}		return $result;	}}
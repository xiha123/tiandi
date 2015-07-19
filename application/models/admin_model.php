<?php

class admin_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	
	
	//>>>>>>>>>>>>>>>>>>>>>> 课程列表开始
	
	//获得课程列表
	public function getClassList(){
		$temp_list = $this -> db -> get_where("classlist")->result();
		$data_list = array();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"id" => $temp_list[$index] -> id,
				"name" => $temp_list[$index] -> name,
				"video" => $temp_list[$index] -> video,
				"time" => date("Y-m-d H:i:s" ,  $temp_list[$index] -> time),
				"text" => $temp_list[$index] -> text,
			));
		}	
		return $data_list;	
	}
	
	//删除课程列
	public function deleteClassList($id){
		$this->db->delete('classlist', array('id' => $id)); 
		return true;
	}
	
	//添加新的课程列表
	public function addClassList($params = array()){
		$result = $this -> db -> get_where("classlist" , array("name" => $params["className"]) , 0 ,1) -> result();
		if(count($result) > 0){
			return false;	
		}
		$this -> db -> insert("classlist" , array("name" => $params["className"] , "video" => $params["video"]  , "time" => time() , "text" => $params["text"]));
		return true;
	}
	
	//<<<<<<<<<<<<<<<<<<<<< 课程列表结束
	
	
	public function getSlider($type = "0"){
		$data_list = array();
		$this->db->order_by("time", "DESC"); 
		$temp_list = $this -> db -> get_where("slide" , array("type" => $type));
		$temp_list = $temp_list->result();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"id" => $temp_list[$index] -> id,
				"title" => $temp_list[$index] -> name,
				"img" => $temp_list[$index] -> img,
				"link" => $temp_list[$index] -> link,
				"time" =>date("Y-m-d H:i:s" ,  $temp_list[$index] -> time),
				"color" => $temp_list[$index] -> color,
				"text" => $temp_list[$index] -> text,
			));
		}
		return $data_list;
	}


	public function deleteSlider($id){
		$this->db->delete('slide', array('id' => $id)); 
		return true;
	}


	public function login($username, $pwd){
		$user = $this->db->select('id, pwd, salt')->where('name', $username)->get('admin')->row_array();
		if (empty($user) || $user['pwd'] !== md5($pwd . $user['salt'])) return false;

		$this->session->set_userdata('auid', $user['id']);
		return true;
	}

	public function check_login() {
		$auid = $this->session->userdata('auid');
		if (!isset($auid)) return false;
		return $this->db->where('id', $auid)->get('admin')->row_array();
	}

	public function create($params) {
		if (!empty($this->db->where('name', $params['name'])->get('admin')->row_array())) return false;

		$salt = substr(uniqid(rand()), -10);
		$this->db->insert('admin', array(
			'nickname' => $params['nickname'],
			'name' => $params['name'],
			'salt' => $salt,
			'pwd' => md5($params['pwd'] . $salt)
		));
	}

	public function remove($params) {
		$query = $this->db->select('id')->where('name', $params['name'])->get('admin')->row_array();
		if (empty($query) || $query['id'] === $params['auid']) return false;

		$this->db->where('name', $params['name'])->delete('admin');
	}

	public function edit($params) {
		$this->db->where('id', $auid)->update('admin', array(
			'nickname' => $params['nickname']
		));
	}

	public function get_guide() {
		return $this->db->get('guide')->result_array();
	}
}

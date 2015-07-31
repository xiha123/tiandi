<?php

class admin_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function insertUploadPic($id,$type,$url){
		switch ($type) {
			case 'classPic':
				$this->db->where("id",$id);
				$this->db->update("classlist",array("url" => $url));
				break;
			default:
				# code...
				break;
		}
	}

	public function editClassPublic($pr){
		$this -> db -> where("id" , $pr['id']);
		if($this -> db -> update("classlistcourse" , array(
			"time" => strtotime($pr["time"] ),
			"title" =>  $pr["title"] ,
			"content" => $pr["content"]
		))){
			return true;
		}
		return false;
	}

	public function deleteClassPublic($id){
		if($this->db->delete('classlistcourse', array('id' => $id))){
			return true;
		}else{
			return false;
		}
	}

	public function addClassPublic($array){
		if($this->db->insert('classlistcourse', array(
			'form' => $array["id"] ,
			 'title' => $array["title"] ,
			 "content" => $array["content"] ,
			 "type" => $array["type"] ,
			 "time" =>$array["time"]
		))){
			return $this->db->insert_id();
		}else{
			return -1;
		}
	}



	public function getClassListCourse($id , $type = "0"){
		$data_list = array();
		$this -> db -> order_by("time", "DESC");
		$temp_list = $this -> db -> get_where("classlistcourse" , array("form" => $id , "type" => $type));
		foreach ($temp_list->result_array() as $row)
		{
			$data_list[] = array(
				"id" => $row["id"],
				"title" => $row["title"],
				"time" => date("Y-m-d",$row["time"]),
				"content" => $row["content"],
			);
		}
		return ($data_list);
	}



	//>>>>>>>>>>>>>>>>>>>>>> 课程详情页设置

	public function getClassListData($id){
		$this -> db -> order_by("time", "DESC");
		$data_list = array();
		$temp_list = $this -> db -> get_where("classlist" , array("id" => $id))->result();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"id" => $temp_list[$index] -> id,
				"name" => $temp_list[$index] -> name,
				"link" => $temp_list[$index] -> link,
				"direction" => $temp_list[$index] -> direction,
				"url" => $temp_list[$index] -> url,
			));
		}
		return $data_list;
	}


	public function getClassListTag($id){
		$this -> db -> order_by("id", "DESC");
		$data_list = array();
		$temp_list = $this -> db -> get_where("tag" , array("form" => $id))->result();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"id" => $temp_list[$index] -> id,
				"name" => $temp_list[$index] -> tag,
				"url" => $temp_list[$index] -> url,
			));
		}
		return $data_list;
	}



	public function getClassListChapter($id){
		$data_list = array();
		$temp_list = $this -> db -> get_where("chapter" , array("form" => $id))->result();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"id" => $temp_list[$index] -> id,
				"title" => $temp_list[$index] -> title,
				"content" => $temp_list[$index] -> content,
			));
		}
		return $data_list;
	}

	public function setClassListLink($array){
		$this -> db -> where("id" , $array["id"]);
		$this -> db -> update("classlist",array("link" => $array["link"]  , "direction" =>  $array["direction"]));
		return true;
	}


	public function editClassContent($params){
		$this -> db -> where("id" , $params["id"]);
		$this -> db -> update("chapter",array( "title" => $params["title"]  , "content" => $params["content"]));
		return true;
	}
	public function editClassListTag($params){
		$this -> db -> where("id" , $params["id"]);
		$this -> db -> update("tag",array( "tag" => $params["className"]  , "url" => $params["classLink"]));
		return true;
	}



	public function deleteClassContent($id){
		$this->db->delete('chapter', array('id' => $id));
		return true;
	}

	public function deleteClassListTag($id){
		$this->db->delete('tag', array('id' => $id));
		return true;
	}
	public function deleteClassListTag_all($id){
		$this->db->delete('tag', array('form' => $id));
		return true;
	}
	public function deleteClassContent_all($id){
		$this->db->delete('chapter', array('form' => $id));
		return true;
	}



	public function addClassListLink($params){
		$this -> db -> where("id" , $params["id"]);
		$this -> db -> update("classlist",array("link" => $params["link"]  , "direction" => $params["direction"]));
		return true;
	}

	public function addClassListTag($params){
		$this -> db -> insert("tag" , array("form" => $params["id"] , "tag" => $params["className"]  , "url" => $params["classLink"]));
		return true;
	}

	public function addClassContent($params){
		$this -> db -> insert("chapter" , array("form" => $params["id"] , "title" => $params["title"]  , "content" => $params["content"]));
		return true;
	}

	public function addChapter($params){
		$this -> db -> where("id" , $params["id"]);
		$this -> db -> update("classlist",array("link" => $params["link"]  , "direction" => $params["direction"]));
		return true;
	}


	//<<<<<<<<<<<<<<<<<<<<<< 课程列表结束







	//>>>>>>>>>>>>>>>>>>>>>> 课程列表开始

	//获得课程列表
	public function getClassList(){
		$this -> db -> order_by("time", "DESC");
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

	//编辑课程列表
	public function editClassList($params){
		$this -> db -> where("id" , $params["id"]);
		$this -> db -> update("classlist",array("name" => $params["className"]  , "time" => time()  , "video" =>  $params["classVideo"], "text" =>  $params["text"]));
		return true;
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


	public function get_guide() {
		return $this->db->get('guide')->result_array();
	}



	// admin model
	public function login($username, $pwd) {
		$user = $this->db->select('id, pwd, salt')->where('name', $username)->get('admin')->row_array();
		if (empty($user) || $user['pwd'] !== md5($pwd . $user['salt'])) return false;

		$this->session->set_userdata('auid', $user['id']);
		return true;
	}

	public function logout() {
		$this->session->unset_userdata('auid');
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
		$this->db->where('id', $params['auid'])->update('admin', array(
			'nickname' => $params['nickname']
		));
	}
}

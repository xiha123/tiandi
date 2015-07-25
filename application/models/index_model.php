<?php

class Index_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	public function getClassList(){
		$data_list = array();
		$temp_list  =  $this -> db -> get("classlist") ->result();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"name" => $temp_list[$index] -> name,
				"link" => $temp_list[$index] -> link,
			));
		}
		return $data_list;
	}	

	public function getLefts(){
		$data_list = array();
		$this->db->order_by("time", "DESC"); 
		$this->db->where("type","1");
		$temp_list = $this -> db -> get_where("slide" , array() , 3 , 0);
		$temp_list = $temp_list->result();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"img" => $temp_list[$index] -> img,
				"link" => $temp_list[$index] -> link,
			));
		}
		return $data_list;
	}


	public function getClassListTag($id){
		$data_list = array();
		$this -> db -> get_where("classlist",array("id"));
		$temp_list = $this -> db -> get_where("tag" , array("form" => $id))->result();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"tag" => $temp_list[$index] -> tag,
				"url" => $temp_list[$index] -> url,
			));
		}
		return $data_list;
	}	
	public function getClassListChapter($id){
		$data_list = array();
		$temp_list = $this -> db -> get_where("chapter" , array("form" => $id))->result();
		for($index = 0;$index < count($temp_list);$index ++){
			$float = ($index % 2) == 0 ? "fl" : "fr";
			array_push($data_list , array(
				"title" => $temp_list[$index] -> title,
				"content" => $temp_list[$index] -> content,
				"float" => $float,
			));
		}
		return $data_list;
	}
	public function getClassListLink($id){
		$data_list = array();
		$temp_list = $this -> db -> get_where("classlist" , array("id" => $id))->result();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"link" => $temp_list[$index] -> link,
				"direction" => $temp_list[$index] -> direction,
			));
		}
		return $data_list;
	}
	public function getClassListViode($id){
		$data_list = array();
		$temp_list = $this -> db -> get_where("classlist" , array("id" => $id))->result();
		for($index = 0;$index < count($temp_list);$index ++){
			array_push($data_list , array(
				"name" => $temp_list[$index] -> name,
				"video" => $temp_list[$index] -> video,
			));
		}
		return $data_list;
	}
	
	public function getSlider($type = "0"){
		$time = strtotime(date("ymd"));
		$data_list = array();
		$this->db->order_by("time", "DESC"); 
		$temp_list = $this -> db -> get_where("classlist" , array() , 3 , 0);
		$temp_list = $temp_list->result();
		for($index = 0;$index < count($temp_list);$index ++){
			
			$this->db->where("time >=" ,$time - 86400);
			$this->db->where("time <" , $time);
			$this->db->where("form =" , $temp_list[$index] -> id);
			$this->db->where("type" , "0");
			$public = $this->db->get_where("classlistcourse")->result();

			$this->db->where("time >=" ,$time - 86400);
			$this->db->where("time <" , $time);
			$this->db->where("form =" , $temp_list[$index] -> id);			
			$this->db->where("type" , "1");
			$class = $this->db->get_where("classlistcourse")->result();

			array_push($data_list , array(
				"id" => $temp_list[$index] -> id,
				"url" => $temp_list[$index] -> url,
				"public" => $public,
				"class" => $class,
			));
		}
		return $data_list;
	}	
}
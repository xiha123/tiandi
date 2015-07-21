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
}
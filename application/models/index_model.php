<?php

class Index_model extends CI_Model {
	public function __construct(){
		parent::__construct();
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
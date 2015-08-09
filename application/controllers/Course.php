<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class course extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('index_model');
	}

	public function index($type = "home")
	{
		$id = $this->input->get("id", true);
		$data_chapter = $this -> index_model -> getClassListChapter($id);
		$data_tag = $this -> index_model -> getClassListTag($id);
		$data_Link = $this -> index_model -> getClassListLink($id);
		$data_Viode = $this -> index_model -> getClassListViode($id);
		$data_ClassList = $this -> index_model -> getClassList();

		$data = array(
			"name" => $data_Viode[0]["name"],
			"video" => $data_Viode[0]["video"],
			"data_list" => $data_chapter,
			"tag" => $data_tag,
			"link" => $data_Link[0]["link"],
			"ClassList" => $data_ClassList,
			"description" => $data_Link[0]["direction"],
		);
		$this->load->library('parser');
		$this->parser->parse('pages/course.php' , $data);
	}
}

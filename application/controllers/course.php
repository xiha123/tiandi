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
		
		$data = array(
			"data_list" => $data_chapter,
			"tag" => $data_tag,
		);
		$this->load->library('parser');
		$this->parser->parse('pages/course.php' , $data);
	}
}

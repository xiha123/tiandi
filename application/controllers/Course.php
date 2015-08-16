<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('course_model');
		$this->load->model('course_chapter_model');
		$this->load->model('index_model');
		$this->me = $this->user_model->check_login();
	}

	public function index($type = "home")
	{
		if(!isset($_GET['id'])) show_404();
		$id = $this->input->get("id", true);
		$data = $this->me;
		$data['courseData'] = $this->course_model->get_list($id,0,1)[0];
		$data['chapters'] = $this->course_chapter_model->get_lists(array("course_id" => $id));

		
		$this->load->library('parser');
		$this->parser->parse('pages/course.php' , $data);
	}
}

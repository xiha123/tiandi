<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Olclass extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('site_model');
		$this->load->model('slide_model');
		$this->load->model('guide_model');
		$this->load->model('course_model');
		$this->load->model('course_class_model');
	}

	public function index() {
		$courseType = array(
			'u3d' => 0,
			'Swift' => 1,
			'Web' => 2,
			'Cocos2d-x' => 3,
			'Android' => 4,
		);
		$type = $this->input->get('type');
		$userdata = $this->user_model->check_login();
		$userdata['guide_list'] = $this->guide_model->get_list();
		$userdata['types'] = isset($courseType[$type]) ? $courseType[$type] : 0;
		$userdata['course_list'] = $this->course_model->get_list_by_type($userdata['types']);
		$userdata['class'] = $this->course_step_model->get_list(array("course_id" => $userdata['types']) , 0 , 8);
		$userdata['slide_list'] = $this->slide_model->get_list(1);
		$userdata['schedule_course'] = $this->site_model->get_content('001');
		$userdata['schedule_date'] = $this->site_model->get_content('002');

		$this->parser->parse('pages/olClass.php', $userdata);
	}

}

<?php
include_once(APPPATH . 'controllers/api/Base_api.php');

class Upload extends base_api {
	function __construct() {
		parent::__construct();
		$this->load->moedl("course_class_model");
	}
	public function get(){
		$params = $this->get_params('POST', array('id'));extract($params);

	}



}

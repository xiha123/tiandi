<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/base_api.php');

class course_api extends base_api {
    public function __construct() {
		parent::__construct();
		$this->load->model('course_model');
    }
}

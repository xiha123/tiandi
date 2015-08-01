<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/base_api.php');

class slide_api extends base_api {
    public function __construct() {
		parent::__construct();
		$this->load->model('slide_model');
    }
}

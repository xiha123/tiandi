<?php
include_once(APPPATH . 'controllers/api/Base_api.php');

class Online_api extends Base_api {
	function __construct() {
		parent::__construct();
	}
	public function get(){
		$params = $this->get_params('POST', array('id'));extract($params);

	}

}

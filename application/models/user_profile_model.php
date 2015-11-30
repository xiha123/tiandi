<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/Base_model.php');

class User_profile_model extends Base_model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'user_profile';
	}

	public function getbyuserid($uid){
		return $this->get(array(
				'user_id' => $uid
		));
	}
}

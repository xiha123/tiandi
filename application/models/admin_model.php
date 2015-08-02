<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/user_model.php');

class admin_model extends user_model {

	public function __construct() {
		parent::__construct();

		$this->table_name = 'admin';
		$this->id_name = 'auid';
		$this->me = $this->check_login();
	}

	// name, nickname, pwd
	public function create($params) {
		if ($this->me === false) return '没有权限';
		return parent::create($params);
	}

}

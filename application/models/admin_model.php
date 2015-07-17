<?php

class admin_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	public function login($username, $pwd){
		$user = $this->db->select('id, pwd, salt')->where('name', $username)->get('admin')->row_array();
		if (empty($user) || $user['pwd'] !== md5($pwd . $user['salt'])) return false;

		$this->session->set_userdata('auid', $user['id']);
		return true;
	}

	public function check_login() {
		$auid = $this->session->userdata('auid');
		if (!isset($auid)) return false;
		return $this->getInfo($auid);
	}

	private function getInfo($auid) {
		return $this->db->where('id', $auid)->get('admin')->row_array();
	}

	public function create() {
		$uniqid = substr(uniqid(rand()), -32);
	}


	public function remove() {

	}
}

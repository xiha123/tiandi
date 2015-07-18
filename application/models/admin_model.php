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
		return $this->db->where('id', $auid)->get('admin')->row_array();
	}

	public function create($params) {
		if (!empty($this->db->where('name', $params['name'])->get('admin')->row_array())) return false;

		$salt = substr(uniqid(rand()), -10);
		$this->db->insert('admin', array(
			'nickname' => $params['nickname'],
			'name' => $params['name'],
			'salt' => $salt,
			'pwd' => md5($params['pwd'] . $salt)
		));
	}

	public function remove($params) {
		$query = $this->db->select('id')->where('name', $params['name'])->get('admin')->row_array();
		if (empty($query) || $query['id'] === $params['auid']) return false;

		$this->db->where('name', $params['name'])->delete('admin');
	}

	public function edit($params) {
		$this->db->where('id', $auid)->update('admin', array(
			'nickname' => $params['nickname']
		));
	}
}

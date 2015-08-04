<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/base_model.php');

class admin_model extends base_model {

	public function __construct() {
		parent::__construct();

		$this->table_name = 'admin';
		$this->id_name = 'auid';
		$this->me = $this->check_login();
	}

	public function login($username, $pwd) {
		$user = $this->db->select('id, pwd, salt')->where('name', $username)->get($this->table_name)->row_array();
		if (empty($user) || $user['pwd'] !== md5($pwd . $user['salt'])) return '用户名或密码错误';
		$this->session->set_userdata($this->id_name, $user['id']);
		return true;
	}

	public function logout() {
		$this->session->unset_userdata($this->id_name);
		return true;
	}

	public function check_login() {
		$id = $this->session->userdata($this->id_name);
		if (!isset($id)) return false;

		return $this->get(array(
			'id' => $id
		));
	}
	public function require_login() {
		$id = $this->session->userdata($this->id_name);
		if (!isset($id)) return false;

		return $this->get(array(
			'id' => $id
		));
	}



	// name, nickname, pwd
	public function create($params) {
		if ($this->require_login()) return '没权限';

		extract($params);

		if ($this->is_exist(array('name' => $name))) return '用户名已存在';

		$salt = substr(uniqid(rand()), -10);
		return parent::create(array(
			'nickname' => $nickname,
			'name' => $name,
			'salt' => $salt,
			'pwd' => md5($pwd . $salt)
		));
	}

	public function remove($id) {
		if (!$this->require_login()) return '没权限';
		return parent::remove($id);
	}
}

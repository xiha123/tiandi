<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/Base_model.php');

class Admin_model extends Base_model {

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
	public function create_admin($params) {
		if($this->require_login() == false) return false;
		extract($params);
		if($this->is_exist(array('name' => $name))) return false;
		$salt = substr(uniqid(rand()), -10);
		return parent::create(array(
			'nickname' => $nickname,
			'name' => $name,
			'salt' => $salt,
			'pwd' => md5($pwd . $salt)
		));
	}

	public function remove($name) {
		if($this->require_login() == false) return false;
		if($name == $this->me['name'])return false;
		return $this->db->delete($this->table_name, array("name" => $name));
	}
}

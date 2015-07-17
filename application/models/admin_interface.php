<?php
class Admin_interface extends CI_Model {

	function __construct(){
		parent::__construct();
	}


	function login($username , $password){
		$query = $this->db->select('id, pwd, salt')->where('name', $username)->get('admin')->row_array();
		if (empty($qeury) || $query['pwd'] !== md5($password . $query['salt'])) return false;

		$this->session->set_userdata('auid', $query['id']);
		return true;
	}


	function check_login() {
		return false;
		/*
		$auid = $this->session->userdata('auid');
		if(isset($_COOKIE['admin_name'])) {
			$cookie_name=$_COOKIE['admin_name'];
		}
		else
		{
			$cookie_name=null;
		}
		if ($session_name==$cookie_name)
		{
			$admin_info = $this->admin_model->get_info($session_name);
			return $admin_info;
		}
		return false;
		*/
	}


	function create() {
		$uniqid = substr(uniqid(rand()), -32);
	}


	function remove() {

	}
}

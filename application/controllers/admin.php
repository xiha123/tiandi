<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public function index(){
		$this->load->model('admin_interface' , "admin");
		$user_info = $this->admin->check_login();
		if (empty($user_info)) {
			$this->load->view('admin/login.php');
		} else {
			$this->load->view('admin/home.php', $user_info);
		}
	}

	public function slider(){
		$this->load->view('admin/slider.php');
	}

	public function onlineClassSlider(){
		$this->load->view('admin/onlineClassSlider.php');
	}

	public function onlineClass(){
		$this->load->view('admin/onlineClass.php');
	}

	public function login() {
		$this->load->model('admin_interface', "admin");
		$username = $this->input->post("username", true);
		$password = $this->input->post("password", true);

		if ($username === '' || $password === '') {
			$this->finish(-1, '用户名和密码不能为空');
			return;
		}

		if ($this->admin->login($username , $password) === false) {
			$this->finish(-1, '用户名或密码错误');
			return;
		}

		$this->finish(0);
	}

	private function finish($status, $error='', $data='') {
        echo json_encode(array(
	        'status' => $status,
			'error' => $error,
			'data' => $data
        ));
	}
}

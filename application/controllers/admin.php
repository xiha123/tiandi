<?php defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public function index(){
		$this->load->model('admin_model');
		$user_info = $this->admin_model->check_login();
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
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class admin extends CI_Controller {

	public function index(){
		$username = $this->input->post("username", true);
		$password = $this->input->post("password", true);
		
		$this -> load -> model('admin_interface' , "admin");
		$return_data = $this -> admin -> login($username , $password);
		$data = array(
			'blog_title' => 'My Blog Title',
			'blog_heading' => 'My Blog Heading'
		);
		$this->load->library('parser');
		$this->parser->parse('admin/login.php', $data);
	}
	
	
	public function home(){
		$this -> load -> model('admin_interface' , "admin");
		$data = array(
			'blog_title' => 'My Blog Title',
			'blog_heading' => 'My Blog Heading'
		);
		$this->load->library('parser');
		$this->parser->parse('admin/home.php', $data);
	}
	
	
	public function slider(){
		$this->load->view('admin/slider.php');
	}
}

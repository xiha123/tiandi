<?php


class seconds extends CI_Controller {

	function __construct() {
		parent::__construct();
	}


	public function index() {
		$this->load->view('seconds/home.php');
	}

	public function god() {
		$this->load->view('seconds/god.php');
	}
	public function search() {
		$this->load->view('seconds/search.php');
	}
	public function tag(){
		$this->load->view('seconds/tag.php');
	}

}
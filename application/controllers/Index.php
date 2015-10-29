<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    public $headTitle = '';
    public $headKeyWords = '';
    public $headDesc = '';
	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
	}

	public function index() {
		$this->load->model('index_model' , "model");
		$data_list = $this -> model -> getIndexSlider();
		$this->load->library('parser');
		$userdata = $this->user_model->check_login();
		$userdata['data_list'] = $data_list;


		$this->parser->parse('pages/home.php', $userdata);
	}

	public function mail() {
		$this->load->library('email');
		$this->email->from('tdmiaoda@yeah.net');
		$this->email->to('tdmiaoda@yeah.net');
		$this->email->subject('test title');
		$this->email->message('test content');
		$this->email->send();
		var_dump($this->email->print_debugger(array('headers')));
	}
}

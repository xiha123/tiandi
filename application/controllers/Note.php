<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Note extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("note_model");
	}

	public function index() {
		$this->load->library('parser');

		$this->parser->parse('note/index.php', array());
	}

}
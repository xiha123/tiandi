<?php defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	
	public function recruit() {
		$this->load->library('parser');
		$this->parser->parse('about/recruit.php', array('activeNav'=>5));
	}


}

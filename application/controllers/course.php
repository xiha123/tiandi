<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class course extends CI_Controller {

	public function index()
	{
		$this->load->view('pages/course.php');
	}
}

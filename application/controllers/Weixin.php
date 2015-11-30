<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class qq_cb extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('qq_cb');
    }
}

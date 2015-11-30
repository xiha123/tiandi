<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weixin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $AppID = 'wx1b5b6b342864bad6';
        $AppSecret = 'd4624c36b6795d1d99dcf0547af5443d';
        $this->load->view('qq_cb');
    }
}

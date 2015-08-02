<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/base_model.php');

class guide_model extends base_model {	public function __construct() {		parent::__construct();		$this->table_name = 'class_guide';	}	public function get_list($params = array(), $page = 0, $count = 3) {		return parent::get_list($params, $page, $count);	}}
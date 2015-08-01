<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/base_model.php');

class course_chapter_model extends CI_Model {	public function __construct() {		parent::__construct();		$this->table_name = 'course_chapter';	}}
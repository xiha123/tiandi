<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/base_model.php');

class note_model extends base_model {	public function __construct() {		parent::__construct();		$this->tableName = 'note';	}}
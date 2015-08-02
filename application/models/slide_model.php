<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/base_model.php');

class slide_model extends base_model {

	public function __construct() {		parent::__construct();		$this->table_name = 'slide';	}	public function getList($type, $count = 5) {		$list = parent::getList(array(			'status' => 1,			'type' => $type		), $count);		foreach($list as $slide) {			if (empty($slide['text'])) break;			$slide['text'] = json_decode($slide['text']);		}		return $list;	}}
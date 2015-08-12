<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/Base_model.php');

class Course_class_model extends Base_model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'course_class';
	}

	public function get_list($params, $page, $count) {
		$page = $page < 0 ? 0 : $page;
		$data = $this->db->where($params)->order_by('id', 'DESC')->limit($count, $page * $count)->get($this->table_name)->result_array();
		foreach ($data as $key => $value) {
			$data[$key]['time'] = date( "Y-m-d", $data[$key]['time']);
		}
		return $data;
	}
}

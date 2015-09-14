<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/Base_model.php');

class God_course_model extends Base_model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'god_course';
	}

	public function create($params) {
		$this->db->query('update user set god_course_count = god_course_count + 1 where id = ' . $params['god']);
		$id = parent::create($params);
		return $id;
	}

	public function remove($id) {
		$course = parent::get(array(
			'id' => $id
		));
		$this->db->query('update user set god_course_count = god_course_count - 1 where id = ' . $course['god']);
		parent::remove($id);
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function create($params) {
		$this->db->insert($this->table_name, $params);
		return $this->db->insert_id();
	}

	public function remove($id) {
		$this->db->delete($this->table_name, array(
			'id' => $id
		));
        return true;
	}

	public function edit($id, $params) {
		$this->db->where('id', $id)->update($this->table_name, $params);
		return true;
	}

	public function is_exist($params) {
		return $this->db->select('id')->where($params)->get($this->table_name)->num_rows() > 0;
	}

    public function get($params) {
        return $this->db->where($params)->get($this->table_name, 1)->row_array();
    }

	public function get_count($params) {
		return $this->db->where($params)->count_all_results($this->table_name);
	}

	public function get_list($params, $page, $count) {
		$page = $page < 0 ? 0 : $page;
		return $this->db->where($params)->order_by('id', 'DESC')->limit($count, $page * $count)->get($this->table_name)->result_array();
	}

    public function require_login() {
        return $this->me !== false;
    }
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class base_model extends CI_Model {

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
	}

	public function online($id) {
		$this->db->where('id', $id)->update($this->table_name, array(
			'status' => 1
		));
	}

	public function offline($id) {
		$this->db->where('id', $id)->update($this->table_name, array(
			'status' => 0
		));
	}

	public function edit($id, $params) {
		$this->db->where('id', $id)->update($this->table_name, $params);
		return;
	}

	public function is_exist($params) {
		return $this->db->select('id')->where($params)->get($this->table_name)->num_rows() > 0;
	}

    public function get($params) {
        return $this->db->where($params)->get($this->table_name, 1)->row_array();
    }

	public function getList($params, $count = 5) {
		return $this->db->where($params)->order_by('id', 'DESC')->limit($count)->get($this->table_name)->result_array();
	}
}

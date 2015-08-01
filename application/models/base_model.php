<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class base_model extends CI_Model {

    public $tableName = '';

    public function __construct() {
        parent::__construct();
    }

    public function create($params) {
		return $this->db->insert($this->tableName, $params);
    }

	public function remove($id) {
		$this->db->delete($this->tableName, array(
			'id' => $id
		));
	}

	public function online($id) {
		$this->db->where('id', $id)->update($this->tableName, array(
			'status' => 1
		));
	}

	public function offline($id) {
		$this->db->where('id', $id)->update($this->tableName, array(
			'status' => 0
		));
	}

	public function edit($params) {
		$this->db->where('id', $id)->update($this->tableName, $params);
	}

	public function isExist($params) {
		return $this->db->select('id')->where($params)->get($this->tableName)->num_rows() > 0;
	}

    public function get($params) {
        return $this->db->where($params).get('table', 1)->row_array();
    }
}

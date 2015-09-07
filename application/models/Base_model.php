<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class base_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function create($params) {
		$this->db->insert($this->table_name, $params);
		return $this->db->insert_id();
	}
	public function remove_where($where = array(0)){
		$this->db->delete($this->table_name,$where);
		return true;
	}

	public function remove($id) {
		$this->db->delete($this->table_name, array(
			'id' => $id
		));
    	return true;
	}
	public function edit_array($where , $params){
		$this->db->where($where)->update($this->table_name, $params);
		return true;
	}
	public function edit($id, $params) {
		$this->db->where('id', $id)->update($this->table_name, $params);
		return true;
	}

	public function is_exist($params) {
		return $this->db->select('id')->where($params)->get($this->table_name)->num_rows() > 0;
	}

    public function get($params, $select=array()) {
        return $this->db->select($select)->where($params)->get($this->table_name, 1)->row_array();
    }


	public function get_count($params) {
		return $this->db->where($params)->count_all_results($this->table_name);
	}

	public function get_list($params, $page, $count) {
		if($params != "all"){
			$this->db->where($params);
		}
		$page = $page < 0 ? 0 : $page;
		return $this->db->limit($count , $page)->order_by('id', 'DESC')->get($this->table_name)->result_array();
	}
	public function search_where($params , $page = 0 , $count = 20){
    		return $this->db->like($params)->limit($count , $page)->get($this->table_name)->result_array();
    	}

    public function require_login() {
        return $this->me !== false;
    }

}

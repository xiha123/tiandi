<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/base_model.php');

class tag_model extends base_model {	public function __construct() {		parent::__construct();		$this->tableName = 'tag';	}	    public function plus($id, $count = 1) {        $query = $this->db->select('count')->where('id', $id)->get('slide')->row_array();        $this->db->where('id', $id)->update('slide', array(            'count' => $query['count'] + $count        ));    }    public function minus($id, $count = 1) {        $query = $this->db->select('count')->where('id', $id)->get('slide')->row_array();        $this->db->where('id', $id)->update('slide', array(            'count' => $query['count'] - $count        ));    }}
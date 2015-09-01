<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/Base_model.php');

class Site_model extends Base_model {

	public function __construct() {
		parent::__construct();
		$this->table_name = 'site';
	}

    public function get_content($type) {
        return parent::get(array(
            'type' => $type
        ))['content'];
    }

    public function set_content($type, $content) {
		$this->db->where('type', $type)->update($this->table_name, array(
            'content' => $content
        ));
    }
}

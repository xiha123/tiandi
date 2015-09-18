<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class Site_api extends Base_api {

    public function __construct() {
		parent::__construct();
		$this->load->model('site_model');
        $this->load->model('admin_model');
        $this->me = $this->admin_model->check_login();
        parent::require_login();
    }

    public function update() {
        $params = parent::get_params('POST', array("type", "content"));
        extract($params);

        $this->site_model->set_content($type, $content);
        parent::finish(true);
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class god_course_api extends base_api {
	public function __construct() {
		parent::__construct();
		$this->load->model("god_course_model");
	}

	public function add() {
		$this->load->model("admin_model");
		$this->me = $this->admin_model->check_login();
		parent::require_login();
		$params = $this->get_params('POST', array( 'title', 'img', 'link', 'god' ));
		extract($params);


        $god = $this->user_model->get(array(
            'nickname' => $god,
            'type' => 1
        ));
        if (empty($god)) $this->finish(false, "大神昵称不存在");

        $this->finish(true, '', $this->god_course_model->create(array(
            'title' => $title,
            'img' => $img,
            'link' => $link,
            'god' => $god['id']
        )));
	}

	public function remove() {
		$this->load->model("admin_model");
		$this->me = $this->admin_model->check_login();
		parent::require_login();
		$params = $this->get_params('POST', array( 'id' ));
		extract($params);


        if ($this->god_course_model->is_exist(array(
            'id' => $id
        )) === false) {
	        $this->finish(false, "问题不存在");
		}

		$this->god_course_model->remove($id);
        $this->finish(true);
	}
}

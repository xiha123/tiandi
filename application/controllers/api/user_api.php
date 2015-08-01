<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/base_api.php');

class user_api extends base_api {
    public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
    }

    public function login() {
        $params = parent::getParams('POST', array('name', 'pwd'));
        if(empty($params)) return;
        extract($params);

		if ($this->user_model->login($name, $pwd) === false) {
			parent::finish(false, '用户名或密码错误');
			return;
		}

		parent::finish(true);
    }

    public function logout() {
		if ($this->user_model->logout() === false) {
			parent::finish(false, '注销失败');
			return;
		}
    }

    public function edit() {
        $params = parent::getParams('POST', array('nickname'));
        if (empty($params)) return;
        extract($params);

		$cur_id = $this->session->userdata('uid');
		if (!isset($cur_id)) {
			parent::finish(false, '没有权限');
			return;
        }

		$this->user_model->edit(array(
            'uid' => $cur_id,
            'nickname' => $nickname
        ));

		parent::finish(true);
    }

    public function create() {
        $params = parent::getParams('POST', array('name', 'nickname', 'pwd'));
        if (empty($params)) return;
        extract($params);

		if (false === $this->user_model->create(array(
            'name' => $name,
            'nickname' => $nickname,
            'pwd' => $pwd
        ))) {
			parent::finish(false, '用户名已存在');
			return;
        }

		parent::finish(true);
    }

    public function remove() {
        $params = parent::getParams('POST', array('name'));
        if (empty($params)) return;
        extract($params);

		$cur_id = $this->session->userdata('auid');
		if (!isset($cur_id)) {
			parent::finish(false, '没有权限');
			return;
        }

		if (false === $this->user_model->remove(array(
            'name' => $name,
            'auid' => $cur_id
        ))) {
			parent::finish(false, '目标是自己或不存在');
			return;
        }

		parent::finish(true);
    }
}

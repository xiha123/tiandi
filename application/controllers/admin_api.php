<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * admin_api
 * 和后台操作相关
 */
include_once(APPPATH . 'controllers/base_api.php');
class admin_api extends base_api {
    public function __construct() {
        parent::__construct();
		$this->load->model('admin_model');
    }

    public function login() {
        $params = parent::getParams('POST', array('username', 'pwd'));
        if (empty($params)) return;
        extract($params);

		if ($username === '' || $pwd === '') {
			parent::finish(false, '用户名和密码不能为空');
			return;
		}

		if ($this->admin_model->login($username, $pwd) === false) {
			parent::finish(false, '用户名或密码错误');
			return;
		}

		parent::finish(true);
    }

    public function edit() {
        $params = parent::getParams('POST', array('auid', 'nickname'));
        if (empty($params)) return;
        extract($params);

		if ($nickname === '') {
			parent::finish(false, '昵称不能为空');
			return;
		}

		if ($this->admin_model->edit(array(
                'auid' => $auid,
                'nickname' => $nickname
            )) === false) {
			parent::finish(false, '没有权限');
			return;
		}

		parent::finish(true);
    }
}

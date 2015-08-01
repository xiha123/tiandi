<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/base_api.php');

class problem_api extends base_api {
    public function __construct() {
		parent::__construct();
		$this->load->model('problem_model');
		$this->load->model('problem_comment_model');
        $this->load->model('user_model');
    }

    public function create() {
        $params = $this->getParams('POST', array(
            'title' => true,
            'detail' => true,
            'tags' => false
        ));
        extract($params);

		$me = $this->user_model->check_login();

        if ($me === false) $this->finish(false, '用户未登录');

        if ($this->problem_model->is_exist(array(
            'title' => $title
        ))) {
            $this->finish(false, '重复的标题');
        }

        $detail_id[] = $this->problem_detail_model->create(array(
            'owner_id' => $me['id'],
            'type' => 0,
            'content' => $detail
        ));

        $this->problem_model->create(array(
            'owner_id' => $me['id'],
            'title' => $title,
            'details' => json_encode($detail_id)
        ));
		$this->finish(true);
    }

    public function create_comment() {
        $params = $this->getParams('POST', array('content')));
        extract($params);

		$me = $this->user_model->check_login();

        if ($me === false) $this->finish(false, '用户未登录');

        $this->problem_comment_model->create(array(
            'owner_id' => $me['id'],
            'content' => $content
        ));

        $this->finish(true);
    }

    public function create_detail() {
        $params = $this->getParams('POST', array('content', 'type')));
        extract($params);

		$me = $this->user_model->check_login();

        if ($me === false) $this->finish(false, '用户未登录');

        $this->problem_detail_model->create(array(
            'owner_id' => $me['id'],
            'content' => $content,
            'type' => $type
        ));

        $this->finish(true);
    }
}

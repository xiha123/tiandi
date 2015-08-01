<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/base_api.php');

class problem_api extends base_api {
    public function __construct() {
		parent::__construct();
		$this->load->model('problem_model');
		$this->load->model('problem_comment_model');

		$this->me = $this->user_model->check_login();
    }

    public function create() {
        $params = $this->get_params('POST', array(
            'title' => true,
            'detail' => true,
            'tags' => false
        ));
        extract($params);

        if ($this->problem_model->is_exist(array(
            'title' => $title
        ))) {
            $this->finish(false, '重复的标题');
        }

        $detail_id[] = $this->problem_detail_model->create(array(
            'owner_id' => $this->me['id'],
            'type' => 0,
            'content' => $detail
        ));

        $this->problem_model->create(array(
            'owner_id' => $this->me['id'],
            'title' => $title,
            'details' => json_encode($detail_id)
        ));
		$this->finish(true);
    }

    public function create_comment() {
        $params = $this->get_params('POST', array('content', 'problem_id')));
        extract($params);

        if ($this->problem_model->is_exist(array(
            'id' => $problem_id
        ))) {
            $this->finish(false, '不存在的问题');
        }

        $this->problem_comment_model->create(array(
            'owner_id' => $this->me['id'],
            'problem_id' => $problem_id,
            'content' => $content
        ));

        $this->finish(true);
    }

    public function create_detail() {
        $params = $this->get_params('POST', array('content', 'type', 'problem_id')));
        extract($params);

        if ($this->problem_model->is_exist(array(
            'id' => $problem_id
        ))) {
            $this->finish(false, '不存在的问题');
        }

        $problem = $this->problem_model->get(array(
            'id' => $problem_id
        ));

        if ($this->me['id'] !== $problem['owner_id'] && $this->me['type'] !== 1) {
            $this->finish(false, '没有权限');
        }

        $this->problem_detail_model->create(array(
            'owner_id' => $this->me['id'],
            'content' => $content,
            'type' => $type
        ));

        $this->problem_model->done($problem_id);

        $this->finish(true);
    }

    public function request_problem() {
        $params = $this->get_params('POST', array('problem_id')));
        extract($params);

        if ($this->me['type'] !== 1) {
            $this->finish(false, '没有权限');
        }

        $problem = $this->problem_model->get(array(
            'id' => $problem_id
        ));

        if ($this->problem_model->request(array(
            'pid': $problem_id,
            'uid': $me['id']
        )) === false) {
            $this->finish(false, '问题不能认领');
        }

        $this->finish(true);
    }

    public function close_problem() {
        $params = $this->get_params('POST', array('problem_id')));
        extract($params);

        $problem = $this->problem_model->get(array(
            'id' => $problem_id
        ));

        if ($problem['owner_id'] !== $this->me['id']) {
            $this->finish(false, '没有权限');
        }

        if ($this->problem_model->close(array(
            'pid': $problem_id,
        )) === false) {
            $this->finish(false, '问题不能关闭');
        }

        $this->finish(true);
    }

    public function follow_problem() {
        $params = $this->get_params('POST', array('problem_id')));
        extract($params);
    }
}

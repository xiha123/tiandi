<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/base_api.php');

class problem_api extends base_api {

    public function __construct() {
    	parent::__construct();
    	$this->load->model('problem_model');
        $this->load->model('problem_detail_model');
    	$this->load->model('problem_comment_model');

    	$this->me = $this->user_model->check_login();
        if ($this->me === false) {
            $this->finish(false, '未登录');
        }
    }

    public function create() {
        $params = $this->get_params('POST', array(
            'title' => true,
            'detail' => true,
            'tags' => false,
            'code' => false
        ));
        extract($params);

        if ($this->problem_model->is_exist(array('title' => $title))){
            $this->finish(false, '重复的标题');
        }
        $detail_id[] = $this->problem_detail_model->create(array(
            'owner_id' => $this->me['id'],
            'type' => 0,
            'content' => $detail,
            'code' => $code
        ));

        $this->problem_model->create(array(
            'owner_id' => $this->me['id'],
            'title' => $title,
            'details' => json_encode($detail_id)
        ));
		$this->finish(true);
    }

    public function create_comment() {
        $params = $this->get_params('POST', array('content', 'problem_id'));
        extract($params);

        if ($this->problem_model->is_exist(array(
            'id' => $problem_id
        ))) {
            $this->finish(false, '不存在的问题');
        }

        $new_comment_id = $this->problem_comment_model->create(array(
            'owner_id' => $this->me['id'],
            'problem_id' => $problem_id,
            'content' => $content
        ));

        $problem = $this->problem_model->get(array(
            'id' => $problem_id
        ));

        $comments = json_decode($problem['comments']);
        $comments[] = $new_comment_id;

        $this->problem_model->edit($problem_id, array(
            'comments' => json_encode($comments)
        ));

        $this->finish(true);
    }

    public function create_detail() {
        $params = $this->get_params('POST', array(
            'content' => true,
            'type' => true,
            'problem_id' => true,
            'code' => false
        ));
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

        $new_detail_id = $this->problem_detail_model->create(array(
            'owner_id' => $this->me['id'],
            'content' => $content,
            'type' => $type
        ));

        $details = json_decode($problem['details']);
        $details[] = $new_detail_id;

        $this->problem_model->edit($problem_id, array(
            'details' => $details
        ));

        $this->problem_model->done($problem_id);

        $this->finish(true);
    }

    public function request_problem() {
        $params = $this->get_params('POST', array('problem_id'));
        extract($params);

        if ($this->me['type'] !== 1) {
            $this->finish(false, '没有权限');
        }

        $problem = $this->problem_model->get(array(
            'id' => $problem_id
        ));

        if ($this->problem_model->request(array(
            'pid' => $problem_id,
            'uid' => $me['id']
        )) === false) {
            $this->finish(false, '问题不能认领');
        }

        $this->finish(true);
    }

    public function close_problem() {
        $params = $this->get_params('POST', array('problem_id'));
        extract($params);

        $problem = $this->problem_model->get(array(
            'id' => $problem_id
        ));

        if ($problem['owner_id'] !== $this->me['id']) {
            $this->finish(false, '没有权限');
        }

        if ($this->problem_model->close(array(
            'pid' => $problem_id
        )) === false) {
            $this->finish(false, '问题不能关闭');
        }

        $this->finish(true);
    }

    public function follow_problem() {
        $params = $this->get_params('POST', array('problem_id'));
        extract($params);

        $this->problem_model->follow($problem_id);
    }

    public function unfollow_problem() {
        $params = $this->get_params('POST', array('problem_id'));
        extract($params);
    }

    public function collect_problem() {
        $params = $this->get_params('POST', array('problem_id'));
        extract($params);
    }

    public function uncollect_problem() {
        $params = $this->get_params('POST', array('problem_id'));
        extract($params);
    }

    public function up_problem() {
        $params = $this->get_params('POST', array('problem_id'));
        extract($params);
    }

    public function down_problem() {
        $params = $this->get_params('POST', array('problem_id'));
        extract($params);
    }
}

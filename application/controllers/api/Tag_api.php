<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class tag_api extends base_api {

    public function __construct() {
    	parent::__construct();
        $this->table_name = "tag";
        $this->load->model('tag_model');

    	$this->me = $this->user_model->check_login();
    }

    public function remove() {
        $this->load->model('admin_model');
        $this->me = $this->admin_model->check_login();
        parent::require_login();

        $params = $this->get_params('POST', array('id'));
        extract($params);

        if (!$this->tag_model->is_exist(array(
            'id' => $id
        ))) {
            $this->finish(false, '不存在的 id');
        }
        $this->tag_model->remove($id);
        $this->finish(true);
    }

    public function edit() {
        $this->load->model('admin_model');
        $this->me = $this->admin_model->check_login();
        parent::require_login();

        $params = $this->get_params('POST', array('id', 'name', 'content'));
        extract($params);

        if (!$this->tag_model->is_exist(array(
            'id' => $id
        ))) {
            $this->finish(false, '不存在的 id');
        }

        if (!$this->tag_model->is_exist(array(
            'name' => $name
        ))) {
            $this->finish(false, '重复的名字');
        }

        $this->tag_model->edit($id, $params);
        $this->finish(true);
    }

    public function add() {        $this->load->model('admin_model');        $this->me = $this->admin_model->check_login();        parent::require_login();        $params = $this->get_params('POST', array('name', 'content'));        extract($params);        if ($this->tag_model->is_exist(array(            'name' => $name        ))) {            $this->finish(false, '重复的名字');        }        $this->tag_model->add_tag($name, '0', $content);        $this->finish(true);    }}
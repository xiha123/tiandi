<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class tag_api extends base_api {

    public function __construct() {
    	parent::__construct();
        $this->table_name = "tag";
        $this->load->model('tag_model');
        $this->load->model('problem_model');

    	$this->me = $this->user_model->check_login();
    }

    public function remove() {
        $this->load->model('admin_model');
        $this->me = $this->admin_model->check_login();
        parent::require_login();
        $params = $this->get_params('POST', array('id'));
        extract($params);
        if(!$this->tag_model->is_exist(array('id' => $id))) $this->finish(false, "您尝试着删除一个不存在的标签，所以服务器无法处理您的请求");
        // 处理标签所对应问题的标签显示
        $tag_data = $this->tag_model->get(array("id" => $id));
        $problem_data = $this->problem_model->get_list_by_tag($tag_data['name'] , "ctime" , 0 , 0 , true , false);
        foreach (count($problem_data) > 1 ? $problem_data : array() as &$value) {
            // 处理标签下的问题数量显示问题
            foreach (json_decode($value['tags'],true) as $tag) {
                edit_tag_problem_count($tag['t'] , 1 , "-");
            }
            $problem_tags_json = parent::remove_json($value['tags'] , $tag_data['name']);
            $this->problem_model->edit($value['id'] , array("tags" => $problem_tags_json));
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

    public function add() {
        $this->load->model('admin_model');
        $this->me = $this->admin_model->check_login();
        parent::require_login();

        $params = $this->get_params('POST', array('name', 'content'));
        extract($params);

        if ($this->tag_model->is_exist(array(
            'name' => $name
        ))) {
            $this->finish(false, '重复的名字');
        }

        $this->tag_model->add_tag($name, '0', $content);
        $this->finish(true);
    }
}

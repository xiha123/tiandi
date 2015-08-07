<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH . 'controllers/api/base_api.php');

class user_api extends base_api {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }   

    public function login() {
        $params = parent::get_params('POST', array('name', 'pwd'));if(empty($params)) return; extract($params);
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

    // 编辑修改用户资料
    // public function edit() {
    //     $params = parent::getParams('POST', array('nickname')); if (empty($params)) return;extract($params);
    //     $cur_id = $this->session->userdata('uid');
    //     if (!isset($cur_id)) {
    //         parent::finish(false, '没有权限');
    //         return;
    //     }
    //     $this->user_model->edit(array(
    //         'uid' => $cur_id,
    //         'nickname' => $nickname
    //     ));
    //     parent::finish(true);
    // }



    // 创建、注册用户
    public function create() {
        $params = parent::get_params('POST', array('name', 'nickname', 'pwd'));if (empty($params)) return; extract($params);
        if (false === $this->user_model->create(array(
            'email' => $name,
            'nickname' => $nickname,
            'pwd' => $pwd
        ))) {
            parent::finish(false, '用户名已存在');
            return;
        }
        parent::finish(true);
    }

    // public function get_user_data(){
    //     $params = parent::getParams('POST', array('id'));if(empty($params)) return; extract($params);
    //     print_r($this->get_user_data($id));

    // } 


    public function get_collect_json($pid) {
        $temp_collect = array();
        $collect = json_decode($this->me['skilled_tags']);
        foreach ($collect as $key => $value) {
            if($value->t != $pid){
                array_push($temp_collect, array("t" => $value->t ));
            }
        }
        $temp_collect = json_encode($temp_collect);
        return $temp_collect == "" ? "[]" : $temp_collect;
    }

    // 删除用户
    public function remove() {
        $params = parent::getParams('POST', array('name'));if(empty($params)) return; extract($params);
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

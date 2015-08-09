<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH . 'controllers/api/base_api.php');

class user_api extends base_api {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('tag_model');
        $this->me = $this->user_model->check_login();
    }   
    public function collect_tag(){
        $params = parent::get_params('POST', array('id'));if(empty($params)) return; extract($params);
        if($this->tag_model->collect_tag($id)){
            $this->tag_model->plus($id);
            $this->tag_model->add_user_tag($id);

            $this->finish(true);
        }else{
            $this->finish(false,"操作失败！");
        }
    }
    public function uncollect_tag(){
        $params = parent::get_params('POST', array('id'));if(empty($params)) return; extract($params);
        if($this->tag_model->uncollect_tag($id)){
            $this->tag_model->minus($id);
            $this->tag_model->un_user_tag($id);
            $this->finish(true);
        }else{
            $this->finish(false,"操作失败！");
        }
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
    public function edits() {

        $params = parent::get_params('POST', array('nickname',"desk","email","phone")); if (empty($params)) return;extract($params);
        //,"pwd_lost","pwd_new"
        $pwd_lost = $this->input->post("pwd_lost");
        $pwd_new = $this->input->post("pwd_new");
        $cur_id = $this->session->userdata('uid');
        if (!isset($cur_id)) {
            parent::finish(false, '没有权限');
            return;
        }
        $edit_array = array(
            'nickname' => $nickname,
            'description' => $desk,
            'email' => $email,
            'cellphone' => $phone,
        );
        if($pwd_lost !="" && md5($pwd_lost.$this->me['salt']) != $this->me["pwd"]){
            parent::finish(false, '您输入的历史密码不正确');return;
        }else{
            $edit_array['pwd'] = md5($pwd_new . $this->me['salt']);
        }
        $this->user_model->edit($this->me['id'],$edit_array);
        parent::finish(true);
    }



    // 创建、注册用户
    public function create() {
        $params = parent::get_params('POST', array('name', 'nickname', 'pwd'));if (empty($params)) return; extract($params);
        if(!$this->isEmail($name)){
            parent::finish(false, '您输入的邮箱格式不太正确，请检查后再输入！');
            return;
        }
        if(strlen($pwd) < 6 || strlen($pwd) > 16){
            parent::finish(false, '密码长度不规范');
            return;
        }
        if(strlen($nickname) < 6 || strlen($nickname) > 16){
            parent::finish(false, '昵称不规范，太长或太短');
            return;
        }


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
    public function edit_god(){
        $params = parent::get_params('POST', array('alipay', 'goddesc'));if (empty($params)) return; extract($params);
        if($this->user_model->edit($this->me['id'],array(
            "description" => $goddesc,
            "alipay" => $alipay
        ))){
            $this->finish(true);
        }else{
            $this->finish(false,"服务器异常！");
        }
    }
    public function upload_pic(){
        
        if(isset($_FILES["userfile"])){
            $config['upload_path'] = './static/uploads/';
            $config['allowed_types'] = 'bmp|jpg|jpeg';

            $config['max_size'] = '2048';
            $config['file_name'] = $this->me["id"].".jpg";
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            if($this->upload->do_upload("userfile")){
                $config_img['image_library'] = 'gd2';
                $data = $this->upload->data();
                $config_img['source_image'] = './static/uploads/' . $data['file_name'];
                $config_img['maintain_ratio'] = false;
                $config_img['new_image'] =  './static/uploads/'.$this->me["id"].".jpg" ;
                $config_img['create_thumb'] = false;
                $config_img['width'] = 150;
                $config_img['height'] = 150;
                $this->load->library('image_lib', $config_img); 
                $this->image_lib->resize();

                if($this->user_model->updata_pic($this->me['id'])){

                     $this->finish(true,"ok");
                }else{
                    $this->finish(false,"服务器异常！");
                }
            }else{
                    $this->finish(false,$this->upload->display_errors("",""));
            }
        }else{
            $this->finish(false,"没有照片被上传请选择照片后再上传！");
        }

    }
  



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

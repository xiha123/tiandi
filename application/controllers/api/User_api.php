<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class user_api extends base_api {
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('tag_model');
        $this->load->model('problem_model');
        $this->load->model('problem_detail_model');
        $this->load->model('problem_comment_model');
        $this->me = $this->user_model->check_login();
    }

    /**
    * 关注用户与取消用户关注
    */
    public function eye(){
        parent::require_login();$params = parent::get_params('POST', array('user_id' , 'type'));if(empty($params)) return; extract($params);
        if($this->me['id'] == $user_id) parent::finish(false,"您无法关注自己！");
        if(!$this->user_model->is_exist(array("id" => $user_id))) parent::finish(false , "您尝试着关注不存的用户，所以您无法关注他");
        $follow_type = false;
        foreach (json_decode($this->me['follow_users']) as $key => $value) {
            if($value[0] == $user_id){
                $follow_type = true;
                break;
            }
        }
        $from_user = $this->user_model->get(array("id" => $user_id));
        $follow_users = !$follow_type ? $this->add_json($this->me['follow_users'] , array($user_id)) : $this->remove_json_v($this->me['follow_users'] , $user_id);
        if($this->user_model->edit($this->me['id'],array("follow_users" => $follow_users))){
             if($follow_type){
                $this->user_model->edit($user_id,array("follower_count" => $from_user['follower_count'] - 1));
            }else{
                $this->user_model->edit($user_id,array("follower_count" => $from_user['follower_count'] + 1));
            }
            $this->news_model->add_news($user_id , "用户:" . $this->me['nickname'] . ($follow_type ? "关注了您" : "取消了对您的关注"));
            parent::finish(true);
        }else{
            parent::finish(false,"服务器异常！");
        }
    }




    public function get_key(){
        $params = parent::get_params('POST', array('key'));if(empty($params)) return; extract($params);
        parent::finish(true , "" , $this->tag_model->get_tag_key($key));
    }


    // 抹杀掉一个用户
    public function remove_user(){
        $params = parent::get_params('POST', array('id'));if(empty($params)) return; extract($params);
        $this->user_model->remove($id);
        $this->problem_model->delete_user($id);
        $this->problem_detail_model->delete_all($id);
        $this->problem_comment_model->delete_all($id);

        
        $this->finish(true);
    }

    public function forget(){
        $params = parent::get_params('POST', array('email'));if(empty($params)) return; extract($params);
        if(!$this->user_model->is_exist(array("email" => $email))){
            parent::finish(false , "您输入的邮箱格式不存在，请检查后再输入！");
        }
        
        //以下设置Email参数
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.qq.com';
        $config['smtp_user'] = '1137716847@qq.com';
        $config['smtp_pass'] = '952467@Aa';
        $config['smtp_port'] = '25';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->load->library('email',$config);            //加载CI的email类
        
        //以下设置Email内容
        $this->email->from('1137716847@qq.com', 'fanteathy');
        $this->email->to('1137716847@qq.com');
        $this->email->subject('Email Test');
        $this->email->message('<font color=red>Testing the email class.</font>');
        // $this->email->attach('application\controllers\1.jpeg');         //相对于index.php的路径

        $this->email->send();

        echo $this->email->print_debugger();      //返回包含邮件内容的字符串，包括EMAIL头和EMAIL正文。用于调试。

        parent::finish(false , "调试中！");
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
        if($this->user_model->is_exist(array("email" => $email))){parent::finish(false, '该邮箱已经被人使用了');}
        if($this->user_model->is_exist(array("nickname" => $nickname))){parent::finish(false, '该昵称已经被人使用了');}
        if($this->user_model->is_exist(array("cellphone" => $phone))){parent::finish(false, '该手机已经被人使用了');}
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
        $this->load->helper('email');
        $params = parent::get_params('POST', array('email', 'nickname', 'pwd'));if (empty($params)) return; extract($params);

        if(!valid_email($email)){
            parent::finish(false, '您输入的邮箱格式不太正确，请检查后再输入！');
        }
        if(strlen($pwd) < 6 || strlen($pwd) > 16){
            parent::finish(false, '密码长度不规范');
        }
        if(strlen($nickname) < 6 || strlen($nickname) > 16){
            parent::finish(false, '昵称不规范，太长或太短');
        }
        if(strlen($pwd) < 6 || strlen($pwd) > 16){
            parent::finish(false, '密码长度不规范');
        }
        if(strlen($nickname) < 6 || strlen($nickname) > 16){
            parent::finish(false, '昵称不规范，太长或太短');
        }
        $result = $this->user_model->create(array(
            'email' => $email,
            'nickname' => $nickname,
            'pwd' => $pwd
        ));
        if (!is_bool($result)) {
            parent::finish(false, $result);
        }

        if (false === $this->user_model->create(array(
            'email' => $email,
            'nickname' => $nickname,
            'pwd' => $pwd
        ))) {
            parent::finish(false, '用户名已存在');
            return;
        }
        parent::finish(true);
    }


    public function edit_god(){
        $params = parent::get_params('POST', array('alipay', 'goddesc','tags'));if (empty($params)) return; extract($params);
        $temp_tags = json_decode($tags,true);
        if(count($temp_tags) < 0 || count($temp_tags)>5) parent::finish(false,"输入的标签太多或者太少");

        // 处理标签请求
        foreach ($temp_tags as $key => $value) {
            if(strlen($value) < 2 && strlen($value) > 12){
                parent::finish(false , "您输入的标签太长或者太短了！");
            }
            if(!$this->tag_model->is_exist(array("name" => $value ,"type" => "0"))){
                parent::finish(false,"您输入的标签：" . $value . "不存在！");
            }
        }

        if($this->user_model->edit($this->me['id'],array(
            "god_description" => $goddesc,
            "alipay" => $alipay,
            "god_skilled_tags" => json_encode($temp_tags)
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

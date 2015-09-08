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
        $this->server_error = "服务器繁忙，无法处理您的请求，请尝试重新操作！";
    }

    /**
    * 关注用户与取消用户关注
     * @param [user_id] [要搜索的标签索引值]
     * @param [key] [要搜索的标签索引值]
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
                $this->news_model->create(array(
                    'target' => $user_id,
                    'from_id' => $this->me['id'],
                    'type' => '500'
                ));
            }
            parent::finish(true);
        }else{
            parent::finish(false, "服务器异常！");
        }
    }




    /**
     * 返回给用户KEY值对应的10个TAG
     * @param [key] [要搜索的标签索引值]
     */
    public function get_key(){
        $params = parent::get_params('POST', array('key'));if(empty($params)) return; extract($params);
        parent::finish(true , "" , $this->tag_model->get_tag_key($key));
    }


    public function activa_email(){
        parent::require_login();
        $user_key = md5(rand(100000000,999999999));
        $user_key = $user_key . md5(rand(100000000,999999999));
        echo $user_key;
        $_SESSION['activa_email_time_out'] = time();
        $this->load->library('email');
        $this->email->from('tdmiaoda@yeah.net');
        $this->email->to($this->me['email']);
        $this->email->subject('账户邮箱激活邮件');
        $this->email->message('<table width="700" border="0" align="center" cellspacing="0" style="width:700px"><tbody><tr><td><div style="width:700px;margin:0 auto;border-bottom:1px solid #ccc;margin-bottom:30px"><table border="0" cellpadding="0" cellspacing="0" width="700" height="39" style="font:12px Tahoma,Arial,宋体"><tbody><tr><td width="210" style="background:#CC0000;color:#fff;text-align:center">天地培训激活账户邮箱邮件，请勿直接回复邮件!</td></tr></tbody></table></div><div style="width:680px;padding:0 10px;margin:0 auto"><div style="line-height:1.5;font-size:14px;margin-bottom:25px;color:#4d4d4d"><strong style="display:block;margin-bottom:15px">亲爱的会员： <span style="color:#f60;font-size:16px"></span>您好！</strong> <strong style="display:block;margin-bottom:15px">欢迎您注册天地秒答平台，点击下面的链接可以激活您的邮箱，如若无法点击，请复制链接到浏览器地址<br><br><a href="#" style="font-weight:100">http://test.tiandipeixun.com/god/?page=2&type=Web</a></strong></div><div style="margin-bottom:30px"><small style="display:block;margin-bottom:20px;font-size:12px"><p style="color:#747474">如果您并没有进行上述操作，请忽略该邮件。您不需要退订或进行其他进一步的操作。<br>此邮件为系统自动发出的邮件，请勿直接回复</p></small></div></div><div style="width:700px;margin:0 auto"><div style="padding:10px 10px 0;border-top:1px solid #ccc;color:#747474;margin-bottom:20px;line-height:1.3em;font-size:12px"><p>此为系统邮件，请勿回复<br>请保管好您的邮箱，避免账号被他人盗用</p><p>天地培训 <span style="border-bottom:1px dashed #ccc;z-index:1" t="7" onclick="return!1" data="1999-2014">' .date("Y-m-d H:i:s"). '</span></p></div></div></td></tr></tbody></table>');
        $this->email->send();

    }

    public function forget(){
        $params = parent::get_params('POST', array('email','verification'));if(empty($params)) return; extract($params);
        if($_SESSION['verification'] != md5($verification)) parent::finish(false , "验证码错误！");
        if(!$this->user_model->is_exist(array("email" => $email))) parent::finish(false , "您输入的邮箱格式不存在，请检查后再输入！");
        $new_password = rand(100000000,999999999); 

        $salt = $this->user_model->get(array("email" => $email) , array("salt" , "id"));
        if(!$this->user_model->edit_array(array("email" => $email) , array("pwd" => md5($new_password . $salt['salt'])))){
            parent::finish(false , $this->server_error);
        }else{
            $this->load->library('email');
            $this->email->from('tdmiaoda@yeah.net');
            $this->email->to($email);
            $this->email->subject('新密码重置通知');
            $this->email->message('<table width="700" border="0" align="center" cellspacing="0" style="width:700px"><tbody><tr><td><div style="width:700px;margin:0 auto;border-bottom:1px solid #ccc;margin-bottom:30px"><table border="0" cellpadding="0" cellspacing="0" width="700" height="39" style="font:12px Tahoma,Arial,宋体"><tbody><tr><td width="210"></td></tr></tbody></table></div><div style="width:680px;padding:0 10px;margin:0 auto"><div style="line-height:1.5;font-size:14px;margin-bottom:25px;color:#4d4d4d"><strong style="display:block;margin-bottom:15px">亲爱的会员： <span style="color:#f60;font-size:16px"></span>您好！</strong> <strong style="display:block;margin-bottom:15px">我们已经重置了您的密码，您的新密码为： <span style="color:#f60;font-size:24px"><span style="border-bottom:1px dashed #ccc;z-index:1" t="7" onclick="return!1" data="469899">'.$new_password.'</span></span></strong></div><div style="margin-bottom:30px"><small style="display:block;margin-bottom:20px;font-size:12px"><p style="color:#747474">注意：此操作可能已经修改您的密码。如非本人操作，请无视该邮件（该密码为随机密码请尽快进入网站修改）<br>（工作人员不会向你索取密码，请勿泄漏！)</p></small></div></div><div style="width:700px;margin:0 auto"><div style="padding:10px 10px 0;border-top:1px solid #ccc;color:#747474;margin-bottom:20px;line-height:1.3em;font-size:12px"><p>此为系统邮件，请勿回复<br>请保管好您的邮箱，避免账号被他人盗用</p><p>天地培训 <span style="border-bottom:1px dashed #ccc;z-index:1" t="7" onclick="return!1" data="1999-2014">' .date("Y-m-d H:i:s"). '</span></p></div></div></td></tr></tbody></table>');
            $this->email->send();
            $this->news_model->create(array(
                'target' => $salt['id'],
                'type' => '001'
            ));
            parent::finish(true);
        }
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
        $params = parent::get_params('POST', array('id'));
        extract($params);
        if($this->tag_model->uncollect_tag($id)){
            $this->tag_model->minus($id);
            $this->tag_model->un_user_tag($id);
            $this->finish(true);
        }else{
            $this->finish(false,"操作失败！");
        }
    }

    public function login() {
        $params = parent::get_params('POST', array('name', 'pwd'));
        extract($params);

        $result = $this->user_model->login($name, $pwd);
        if ($result === false) {
            parent::finish(false, '用户名或密码错误');
        }

        parent::finish(true, '', $result);
    }



    public function logout() {
        if ($this->user_model->logout() === false) {
            parent::finish(false, '注销失败');
            return;
        }
    }

    // 编辑修改用户资料
    public function edits() {

        $params = parent::get_params('POST', array('nickname',"desk","phone","id")); if (empty($params)) return;extract($params);

        if(preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$nickname)){
            parent::finish(false , "您的昵称中存在特殊字符，请检查后重新提交");
        }

        parent::is_length(array(
            array("name" => "昵称" , "value" => $nickname , "min" => 2 , "max" => 16),
            array("name" => "手机号" , "value" => $phone , "min" => 6 , "max" => 11),
        ));


        if($this->user_model->is_exist(array("nickname" => $nickname , "id !=" => $id))){parent::finish(false, '该昵称已经被人使用了');}
        if($this->user_model->is_exist(array("cellphone" => $phone , "id !=" => $id))){parent::finish(false, '该手机已经被人使用了');}
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
            'cellphone' => $phone,
        );
        if($pwd_lost !="" ){
            if(md5($pwd_lost.$this->me['salt']) != $this->me["pwd"]){
                parent::finish(false, '您输入的历史密码不正确');return;
            }else{
                $edit_array['pwd'] = md5($pwd_new . $this->me['salt']);
            }
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
        if(preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$nickname)){
            parent::finish(false , "您的昵称中存在特殊字符，请检查后重新提交");
        }
        parent::is_length(array(
            array("name" => "密码" , "value" => $pwd , "min" => 6 , "max" => 16),
            array("name" => "昵称" , "value" => $nickname , "min" => 4 , "max" => 16)
        ));


        $result = $this->user_model->create(array(
            'email' => $email,
            'nickname' => $nickname,
            'pwd' => $pwd
        ));
        if(!is_bool($result)) {
            parent::finish(false, $result);
        }

        if (false === $this->user_model->create(array(
            'email' => $email,
            'nickname' => $nickname,
            'pwd' => $pwd
        ))) {
            parent::finish(false, '用户名已存在');
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
    public function upload_pic() {
        if(!isset($_FILES["userfile"])) {
            $this->finish(false,"没有照片被上传请选择照片后再上传！");
        }

        $config['upload_path'] = './static/uploads/';
        $config['allowed_types'] = 'bmp|jpg|jpeg';
        $config['max_size'] = '2048';
        $config['file_name'] = $this->me["id"].".jpg";
        $config['overwrite'] = true;
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload("userfile")) {
            $this->finish(false, $this->upload->display_errors("",""));
        }

        $data = $this->upload->data();
        $config_img['image_library'] = 'gd2';
        $config_img['source_image'] = './static/uploads/' . $data['file_name'];
        $config_img['maintain_ratio'] = false;
        $config_img['new_image'] =  './static/uploads/'.$this->me["id"].".jpg" ;
        $config_img['create_thumb'] = false;
        $config_img['width'] = 150;
        $config_img['height'] = 150;
        $this->load->library('image_lib', $config_img);
        $this->image_lib->resize();

        if($this->user_model->updata_pic($this->me['id'])){
            $this->finish(true, "ok");
        } else {
            $this->finish(false, "服务器异常！");
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

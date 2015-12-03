<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class User_api extends Base_api {
    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');

        $this->load->model('user_model');
        $this->load->model('tag_model');
        $this->load->model('problem_model');
        $this->load->model('problem_detail_model');
        $this->load->model('problem_comment_model');
        $this->me = $this->user_model->check_login();
        $this->server_error = "服务器繁忙，无法处理您的请求，请尝试重新操作！";
    }

    public function check_oauth() {
        $params = parent::get_params('POST', array('key','avatar','nickname','source','source_id'));
        extract($params);

        $user = ModelFactory::User()->get_by_oauth($key);
        if ($user === false) {
            $parent_id = get_cookie('parent_id');

            while (1) {
                $params1 = array('nickname' => $params['nickname']);
                $true = ModelFactory::User()->is_exist($params1);
                if ($true) {
                    $params['nickname'] = $params['nickname'].mt_rand(400000,900000);
                }else{
                    break;
                }
            }

            $true = ModelFactory::User()->create([
                'email' => $params['nickname']."@91miaoda.com",
                'oauth_key' =>  $params['avatar'],
                'nickname' => $params['nickname'],
                'pwd' => '',
                'avatar' => $params['avatar'],
                'parent_id' => $parent_id,
            ]);
            if ($true === true) {
                $user = ModelFactory::User()->get_by_oauth($key);
                if ($user) {
                    ModelFactory::User()->login_by_oauth($user['id']);
                    parent::finish(true,'',['first'=>'yes']);
                }
            }else{
                parent::finish(false);
            }
            parent::finish(false);
        } else {
            ModelFactory::User()->login_by_oauth($user['id']);
            parent::finish(true,'',['first'=>'no']);
        }
    }

    /**
    * 关注用户与取消用户关注
     * @param [user_id] [要搜索的标签索引值]
     * @param [key] [要搜索的标签索引值]
    */
    public function eye() {
        parent::require_login();
        $params = parent::get_params('POST', array('user_id' , 'type'));
        extract($params);

        if($this->me['id'] == $user_id) parent::finish(false,"您无法关注自己！");
        if(!$this->user_model->is_exist(array("id" => $user_id))) parent::finish(false , "您尝试着关注不存的用户，所以您无法关注他");

        $target_user = $this->user_model->get(array(
            "id" => $user_id
        ));
        if ($type == 'true') {
            ModelFactory::User()->Integral($this->me['id'] , CONSTFILE::USER_ACTION_USER_WATCH_INTEGRAL_VALUE ,true,'Integral',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_USER_WATCH);
            ModelFactory::User()->coin($this->me['id'] , CONSTFILE::USER_ACTION_USER_WATCH_SILVER_VALUE ,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_USER_WATCH);
            $follow_users = parent::add_json($this->me['follow_users'], $user_id);
        } else {
            ModelFactory::User()->coin($this->me['id'] , CONSTFILE::USER_ACTION_USER_WATCH_SILVER_VALUE ,false,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_USER_WATCH);
            ModelFactory::User()->Integral($this->me['id'] , CONSTFILE::USER_ACTION_USER_WATCH_INTEGRAL_VALUE ,false,'Integral',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_USER_WATCH);
            $follow_users = parent::remove_json_v($this->me['follow_users'], $user_id);
        }
        if (!$this->user_model->edit($this->me['id'], array("follow_users" => $follow_users))) {
            parent::finish(false, "服务器异常！");
        }
        if ($type == 'false') {
            $this->user_model->edit($user_id, array("follower_count" => $target_user['follower_count'] - 1));
        } else {
            $this->user_model->edit($user_id, array("follower_count" => $target_user['follower_count'] + 1));
            $this->news_model->create(array(
                'target' => $user_id,
                'from_id' => $this->me['id'],
                'type' => '500'
            ));
        }
        parent::finish(true);
    }





    /**
     * 返回给用户KEY值对应的10个TAG
     * @param [key] [要搜索的标签索引值]
     */
    public function get_key(){
        $params = parent::get_params('POST', array('key'));if(empty($params)) return; extract($params);
        parent::finish(true , "" , $this->tag_model->get_tag_key($key));
    }


    public function active_email() {
        parent::require_login();
        $user_key = md5(rand(100000000,999999999));
        $user_key = $user_key . md5(rand(100000000,999999999));
        $url = base_url('home/active/' . $user_key);
        //$_SESSION['active_email_time_out'] = time();
        $this->load->library('email');
        $this->email->from('tdmiaoda@yeah.net');
        $this->email->to($this->me['email']);
        $this->email->subject('天地秒答平台账户邮箱激活邮件');
        $this->email->message('<table width="700" border="0" align="center" cellspacing="0" style="width:700px"><tbody><tr><td><div style="width:700px;margin:0 auto;border-bottom:1px solid #ccc;margin-bottom:30px"><table border="0" cellpadding="0" cellspacing="0" width="700" height="39" style="font:12px Tahoma,Arial,宋体"><tbody><tr><td width="210" style="background:#CC0000;color:#fff;text-align:center">天地培训激活账户邮箱邮件，请勿直接回复邮件!</td></tr></tbody></table></div><div style="width:680px;padding:0 10px;margin:0 auto"><div style="line-height:1.5;font-size:14px;margin-bottom:25px;color:#4d4d4d"><strong style="display:block;margin-bottom:15px">亲爱的会员： <span style="color:#f60;font-size:16px"></span>您好！</strong> <strong style="display:block;margin-bottom:15px">欢迎您注册天地秒答平台，点击下面的链接可以激活您的邮箱，如若无法点击，请复制链接到浏览器地址<br><br><a href="' . $url . '" style="font-weight:100">' . $url . '</a></strong></div><div style="margin-bottom:30px"><small style="display:block;margin-bottom:20px;font-size:12px"><p style="color:#747474">如果您并没有进行上述操作，请忽略该邮件。您不需要退订或进行其他进一步的操作。<br>此邮件为系统自动发出的邮件，请勿直接回复</p></small></div></div><div style="width:700px;margin:0 auto"><div style="padding:10px 10px 0;border-top:1px solid #ccc;color:#747474;margin-bottom:20px;line-height:1.3em;font-size:12px"><p>此为系统邮件，请勿回复<br>请保管好您的邮箱，避免账号被他人盗用</p><p>天地培训 <span style="border-bottom:1px dashed #ccc;z-index:1" t="7" onclick="return!1" data="1999-2014">' .date("Y-m-d H:i:s"). '</span></p></div></div></td></tr></tbody></table>');
        $this->email->send();
        $this->user_model->edit($this->me['id'] , array("key" => $user_key));
		//var_dump($this->email->print_debugger(array('headers')));
        parent::finish(true);
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
        parent::require_login();
        $params = parent::get_params('POST', array('id'));if(empty($params)) return; extract($params);
        $this->user_model->remove($id);
        $this->problem_model->delete_user($id);
        $this->problem_detail_model->delete_all($id);
        $this->problem_comment_model->delete_all($id);

        $this->finish(true);
    }



    public function collect_tag(){
        parent::require_login();
        $params = parent::get_params('POST', array('id'));if(empty($params)) return; extract($params);
        if($this->tag_model->collect_tag($id)){
            $this->tag_model->plus($id);
            $this->tag_model->add_user_tag($id);
            ModelFactory::User()->Integral($this->me['id'] , CONSTFILE::USER_ACTION_COLLECTION_PROBLEM_INTEGRAL_VALUE ,true,'Integral',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_COLLECTION);
            ModelFactory::User()->coin($this->me['id'] , CONSTFILE::USER_ACTION_COLLECTION_TAG_SILVER_VALUE ,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_COLLECTION);

            $this->finish(true);
        }else{
            $this->finish(false,"操作失败！");
        }
    }
    public function uncollect_tag(){
        parent::require_login();
        $params = parent::get_params('POST', array('id'));
        extract($params);
        if($this->tag_model->uncollect_tag($id)){
            $this->tag_model->minus($id);
            $this->tag_model->un_user_tag($id);
            ModelFactory::User()->Integral($this->me['id'] , CONSTFILE::USER_ACTION_COLLECTION_PROBLEM_INTEGRAL_VALUE ,false,'Integral',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_COLLECTION);
            ModelFactory::User()->coin($this->me['id'] , CONSTFILE::USER_ACTION_COLLECTION_TAG_SILVER_VALUE ,false,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_COLLECTION);

            $this->finish(true);
        }else{
            $this->finish(false,"操作失败！");
        }
    }

    public function login() {
        $params = parent::get_params('POST', array('name', 'pwd','vcode','remind'));
        extract($params);
        if (md5($params['vcode']) != $_SESSION["verification"]) {
            parent::finish(false, '验证码错误!');
        }
        if ($params['remindme'] == 'yes') {
            $this->load->helper('cookie');
            $cookie = $this->input->cookie('ci_session');
            $this->input->set_cookie('ci_session', $cookie, '35580000');
        }
        $result = ModelFactory::User()->login($name, $pwd);
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
        $params = parent::get_params('POST', array('nickname',"desk","phone","id"));
        extract($params);

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
        $parent_id = get_cookie('parent_id');
        $this->load->helper('email');
        $params = parent::get_params('POST', array('email', 'nickname', 'pwd', 'avatar','vcode_reg'));
        extract($params);
        if (md5($params['vcode_reg']) != $_SESSION["verification"]) {
            parent::finish(false, '验证码错误!');
        }
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
        if ($avatar === 'none') $avatar = '';

        $result = $this->user_model->create(array(
            'email' => $email,
            'nickname' => $nickname,
            'pwd' => $pwd,
            'avatar' => $avatar,
            'parent_id' => $parent_id,
        ));
        if(!is_bool($result)) {
            parent::finish(false, $result);
        }

        parent::finish(true);
    }


    public function edit_god(){
        $params = parent::get_params('POST', array('alipay', 'goddesc','tags'));
        extract($params);

        $temp_tags = json_decode($tags, true);
        if(count($temp_tags) < 0 || count($temp_tags)>5) {
            parent::finish(false,"输入的标签太多或者太少");
        }

        // 处理标签请求
        foreach ($temp_tags as $key => $value) {
            if(strlen($value) < 1 && strlen($value) > 20){
                parent::finish(false , "每个擅长标签请小于20字符");
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
            $this->finish(false, "服务器异常！");
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

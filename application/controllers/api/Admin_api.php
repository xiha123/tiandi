<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class admin_api extends base_api {

    public function __construct() {
        parent::__construct();
        $this->load->model('course_model');
        $this->load->model('admin_model');
        $this->load->model('course_model');
        $this->load->model('course_chapter_model');
        $this->load->model('course_class_model');
        $this->load->model('course_step_model');
        $this->load->model('news_model');
        $this->me = $this->admin_model->check_login();
    }

    /**
     * 检查管理的限制权限
     * @param nickname
     */
    public function check_admin(){
        parent::require_login();
        $params = parent::get_params('POST', array("nickname"));if(empty($params))return; extract($params);
        if($this->me['type'] != 0 ) parent::finish(false , "您没有权限修改或获取管理员限制权限");
        $admin_data = $this->admin_model->get(array("nickname" => $nickname) , array("limit"));
        if(!isset($admin_data['limit'])) parent::finish(false , "不存在的管理员，请检查后重新输入");
        $limit = array();
        foreach (json_decode($admin_data['limit']) as $key => $value) {
            switch ($value) {
                case 'slider': $limit[$key] = "1";break;
                case 'online': $limit[$key] = "2";break;
                case 'course': $limit[$key] = "3";break;
                case 'problem': $limit[$key] = "4";break;
                case 'tag': $limit[$key] = "5";break;
                case 'user': $limit[$key] = "6";break;
            }
        }
        parent::finish(true , "" , json_encode($limit));
    }


    /**
     * [set_admin_limit 设置管理员可以使用那些功能的限制]
     * @param nickname 管理员昵称
     * @param limit 限制列表，json
     */
    public function set_admin_limit(){
        parent::require_login();
        $params = parent::get_params('POST', array("nickname","limit"));if(empty($params))return; extract($params);
        if($this->me['type'] != 0 ) parent::finish(false , "您没有权限修改或获取管理员限制权限");
        $admin_data = $this->admin_model->get(array("nickname" => $nickname) , array("limit"));
        if(!isset($admin_data['limit'])) parent::finish(false , "不存在的管理员，请检查后重新输入");
        if(count($limit) > 6) parent::finish("错误，限制了太多");
        $shit = true;
        $limit = json_decode($limit);

        if(count($limit) > 1){
            foreach ($limit as $key => $value) {
                switch ($limit[$key]) {
                    case '1': $limit[$key] = "slider";break;
                    case '2': $limit[$key] = "online";break;
                    case '3': $limit[$key] = "course";break;
                    case '4': $limit[$key] = "problem";break;
                    case '5': $limit[$key] = "tag";break;
                    case '6': $limit[$key] = "user";break;
                    default: $shit = false;break;
                }
            }
        }else{
            $limit = array();
        }
        if($shit == false)  parent::finish("设置了错误的限制");
        $this->admin_model->edit_array(array("nickname" => $nickname) , array("limit" => json_encode($limit)));
        parent::finish(true);
    }


    /**
     * 设置成为大神
     * @return [type] [description]
     */
    public function apply_ok(){
        parent::require_login();
        $params = parent::get_params('POST', array("userid"));if(empty($params)) return; extract($params);
        if($this->user_model->edit($userid, array("type" => 1))){
            $this->news_model->create(array(
                'target' => $userid,
                'type' => '101'
            ));
            $this->finish(true, "Good!!");
        }else{
            $this->finish(false, "服务器异常!!");
        }
    }

    /**
     * 拒绝成为大神返还成普通用户
     * @return [type] [description]
     */
    public function apply_no(){
        parent::require_login();
        $params = parent::get_params('POST', array("userid"));if(empty($params)) return; extract($params);
        if($this->user_model->edit($userid,array("type" => 0))){
            $this->news_model->create(array(
                'target' => $userid,
                'type' => '102'
            ));
            $this->finish(true, "Good!!");
        }else{
            $this->finish(false, "服务器异常!!");
        }
    }


    /**
     * 编辑用户信息
     * @return [type] [description]
     */
   public function editData(){
        parent::require_login();
        $params = parent::get_params('POST', array(
            "nickname",
            "name",
            "email",
            "cellphone",
            "alipay",
            "gold_coin",
            "silver_coin",
            "idcar",
            "type",
        ));if(empty($params)) return; extract($params);
        $id = $this->input->post("id");
        /*
        $teacher = !isset($_POST['teacher']) ? false : true;
        if(isset($_POST['teacher'])){
            $params['teacher'] = 1;
        }else{
            $params['teacher'] = 0;
        }
        */
        $password = $this->input->post("password");
        if($password != ""){
            $userdata = $this->user_model->get(array("id" => $id));
            $params['pwd'] = md5($password . $userdata['salt']);
        }
        if($this->user_model->edit($id , $params)){
               $this->finish(true);
           }else{
               $this->finish(false,"无法修改用户资料");
           }
    }
    public function delect_steup(){
        $params = parent::get_params('POST', array('type','id'));if(empty($params))return;extract($params);
        $course_data = $this->course_model->get(array("id" => $type));

        $this->course_step_model->remove($id);
        $this->course_model->edit($type,array("steps" => $this->remove_json( $course_data['steps'], $id)));
        $this->finish(true,"Good!!");
    }


    public function add_steup(){
        $params = parent::get_params('POST', array("id","title" , "difficulty" , "description" ));if(empty($params))return;extract($params);
        if(isset($_FILES["userfile"])){
            $config['upload_path'] = './static/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['file_name'] =date("Ymd"). rand(100000000000,9999999999999);
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload("userfile")){
               $this->finish(false,"图片无法上传到服务器");
            }else{
                $data = $this->upload->data();
                $course_data = $this->course_model->get(array("id" => $id));
                $insert_id = $this->course_step_model->create(array(
                    "title"=>$title,
                    "img"=>$data['file_name'],
                    "description"=>$description,
                    "level"=>$difficulty,
                    "course_id"=>$id,
                ));

               $this->course_model->edit($id,array("steps"=>$this->add_json($course_data['steps'] , array("t"=> $insert_id)) ));
               $this->finish(true,"添加成功！");
            }
        }
    }

    public function edit_steup(){
        $params = parent::get_params('POST', array('id' , "title" , "difficulty" , "description" ));if(empty($params))return;extract($params);
        $type = $this->input->post('type');
        $steup_data = $this->course_step_model->get(array('id' => $id));
        $config['file_name'] = $steup_data['img'];

        if(isset($_FILES["userfile"])){
            $config['upload_path'] = './static/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload("userfile")){
                $this->finish(false,"图片无法上传到服务器");
            }
        }

        $this->course_step_model->edit($id,array(
            "title"=>$title,
            "img"=>$config['file_name'],
            "description"=>$description,
            "level"=>$difficulty,
            "course_id"=>$type,
        ));
        $this->finish(true);
    }




    public function editClassPublic() {
        $params = parent::get_params('POST', array('id' , "title" , "content" , "time" ));if(empty($params)) return;extract($params);
        if(time() >  strtotime($time) + 86400) {parent::finish(false, '不能填写小于今日的时间请检查后再保存');return;}
        if(!$this->course_class_model->edit($id,array(
            "title" => $title,
            "content" => $content,
            "time" => strtotime($time),
        ))){
            parent::finish(false,"未知的原因导致删除失败 error:deleteClassPublic");
        }else{
            parent::finish(true);
        }
    }


    public function deleteClassPublic(){
        $params = parent::get_params('POST', array('id'));if(empty($params)) return;extract($params);
        if(!$this->course_class_model->remove($id)){
            parent::finish(false,"未知的原因导致删除失败 error:deleteClassPublic");
        }else{
            parent::finish(true);
        }
    }

    public function addClassPublic(){
        $params = parent::get_params('POST', array('id' , 'title' , 'content' , 'time' ));if(empty($params)) return;extract($params);
        $time = strtotime($time);
        if($time + 86400 < time()){parent::finish(false, '不能填写小于今日的时间请检查后再保存');return;}

        if(!$data = $this->course_class_model->create(array(
            "title" =>$title,
            "time" =>$time,
            "content" => $content,
            "form" => $id
        ))){
            parent::finish(false, '无法插入该课程，请稍候再试');
        }else{
            parent::finish(true , $data);
        }
    }

    /**
     * 添加课程的标签
     * @param $[id] [<description>]
     * @param $[tagName] [<description>]
     * @param $[tagLink] [<description>]
     */
    public function addClassListTag(){
        $params = parent::get_params('POST', array('id' , 'TagName' , 'TagLink'));if(empty($params))return;extract($params);

        if($insertid = $this->tag_model ->create(array(
            "name" => $TagName,
            "link" => $TagLink,
            "type" => "1",
            "content" => "",
        ))){
            $course_data = $this->course_model->get(array("id" => $id));
            $course_data = $this->add_json($course_data['tags'] , array("t"=>$insertid));
            if($this->course_model->edit($id,array("tags" => $course_data))){
                $this->finish(true);
            }else{
                $this->finish(false,"未知的网络原因");
            }
        }else{
            $this->finish(false,"未知的网络原因");
        }
    }

    /**
     * 编辑课程连接和描述
     * @param  description $[name] [<description>]
     * @param  link $[name] [<description>]
     * @return [type] [description]
     */
    public function edit_link(){
        $params = parent::get_params('POST', array('id' , 'description' , 'link'));if(empty($params)) return;extract($params);
        $course_data = $this->course_model->get(array("id" => $id));
        $this->course_model->edit($id,array("site"=>$this->edit_json($course_data['site'],"link",$link)));
        $this->course_model->edit($id,array(
            "description" => $description
        ));
        parent::finish(true);
    }


	//添加新的课程列表
	public function addClassList(){
        	$params = parent::get_params('POST', array('className' , 'classVideo' , 'text'));if(empty($params)) return;extract($params);
        	$return = $this->course_model->addCourse(array(
			"title" => $className,
			"description" =>$text,
			"type" =>0,
			"video" => $classVideo
		));
        	switch ($return) {
        		case 0:
				parent::finish(true);
        			break;
        		case -1:
				parent::finish(false, '未知的原因导致失败');
        			break;
        		case -2:
				parent::finish(false, '填写的新课程名与其他课程重名了');
        			break;
        		default:
        			# code...
        			break;
        	}
	}
	public function deleteClassList(){
        	$params = parent::get_params('POST', array('id'));if(empty($params)) return;extract($params);
		$this -> admin_model -> deleteClassList($id);
		$this -> admin_model -> deleteClassListTag_all($id);
		$this -> admin_model -> deleteClassContent_all($id);

		parent::finish(true);
	}




	public function addClassContent(){
        	$params = parent::get_params('POST', array('id' , 'title' , 'content'));if(empty($params)) return;extract($params);
                $this ->course_chapter_model -> create(array(
                    "title" => $title,
                    "content" => $content,
                    "course_id" => $id
                ));
                parent::finish(true);
	}





            // 课程标签设置
	public function edit_tag(){
                $params = parent::get_params('POST', array('id' , 'className' , 'classLink'));if(empty($params)) return;extract($params);
                if($this ->tag_model -> edit($id,array(
                    "name" => $className,
                    "link" => $classLink
                ))){
                    parent::finish(true);
                }else{
                    parent::finish(false,"未知的网络原因");
                }
	}





	public function editClassContent(){
                $params = parent::get_params('POST', array('id' , 'title' , 'content'));if(empty($params)) return;extract($params);
                $this ->course_chapter_model -> edit($id,array(
                    "title" => $title,
                    "content" => $content
                ));
                parent::finish(true);
	}






	//删除课程列表
	public function deleteClassListTag(){
        	   $params = parent::get_params('POST', array("fid",'id'));if(empty($params)) return;extract($params);
               $course_data = $this->course_model->get(array("type"=>$fid));
               $this->course_model->edit_tag($fid,array("tags"=>$this->remove_json($course_data['tags'],$id)));
               $this->tag_model->remove($id);
	   parent::finish(true);
	}
	public function deleteClassContent(){
                $params = parent::get_params('POST', array('id'));if(empty($params)) return;extract($params);
                $this ->course_chapter_model -> remove($id);
                parent::finish(true);
	}
	public function deleteSlider(){
		$params = parent::get_params('POST', array('id'));
		if(empty($params))return;
		extract($params);
		$this->admin_model->deleteSlider($id);
		parent::finish(true);
	}


	//删除课程列表
	public function editClassList(){
        	$params = parent::get_params('POST', array('id' , "className" , "classVideo" , "text"));if(empty($params)) return;extract($params);
		if($this -> course_model -> edit($id,array(
			"title" => $className,
			"video" => $classVideo,
		))){
			parent::finish(true);
		}else{
			parent::finish(false , "填写的新课程名与其他课程重名了");
		}

	}





    public function login() {
    	$params = $this->get_params('POST', array('name', "pwd"));
        extract($params);
		$result = $this->admin_model->login($name, $pwd);
        if ($result === true) {
    		$this->finish(true);
        } else {
    		$this->finish(false);
        }
    }

    public function logout() {
		$this->admin_model->logout();
        $this->finish(true);
    }

    public function edit() {
        $params = $this->get_params('POST', array('nickname'));
        extract($params);

        $this->check_admin_login();

	$this->admin_model->edit($this->me['id'],array(
            'nickname' => $nickname
        ));

		parent::finish(true);
    }

    public function create() {
        $params = parent::get_params('POST', array('name', 'nickname', 'pwd'));
        extract($params);
        $this->check_admin_login();
        if (false === $this->admin_model->create_admin(array(
            'name' => $name,
            'nickname' => $nickname,
            'pwd' => $pwd
        ))) {
            $this->finish(false, '用户名已存在');
        }
        $this->finish(true);
    }

    public function remove() {
        $params = parent::get_params('POST', array('name'));
        extract($params);
        $this->check_admin_login();
        if (false === $this->admin_model->remove($name)) {
            parent::finish(false, '目标是自己或不存在');
        }
        parent::finish(true);
    }

    private function check_admin_login() {
        if ($this->me === false) {
            $this->finish(false, '未登录');
        }
    }
}

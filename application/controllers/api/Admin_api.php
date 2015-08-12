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
        $this->me = $this->admin_model->check_login();
    }

    public function delect_steup(){
        $params = parent::get_params('POST', array('type','id'));if(empty($params))return;extract($params);
        $this->course_step_model->remove($id);
        $course_data = $this->course_model->get(array("type" => $type));
        $this->course_model->edit_tag($type,array("steps" => $this->remove_json( $course_data['steps'], $id)));
         $this->finish(true,"Good!!");
    }
    public function add_steup(){
        $params = parent::get_params('POST', array('type' , "title" , "difficulty" , "description" ));if(empty($params))return;extract($params);
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
                $id = $this->course_step_model->create(array(
                    "title"=>$title,
                    "img"=>$data['file_name'],
                    "description"=>$description,
                    "level"=>$difficulty,
                    "course_id"=>$type,
                ));
               $course_data = $this->course_model->get(array("type" => $type));
               $this->course_model->edit_tag($type,array("steps"=>$this->add_json($course_data['steps'] , array("t"=> $id)) ));
               $this->finish(true,"添加成功！");
            }
        }
    }

    public function edit_steup(){
        $params = parent::get_params('POST', array('type' , 'id' , "title" , "difficulty" , "description" ));if(empty($params))return;extract($params);
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

        $id = $this->course_step_model->edit($id,array(
            "title"=>$title,
            "img"=>$config['file_name'],
            "description"=>$description,
            "level"=>$difficulty,
            "course_id"=>$type,
        ));
        $course_data = $this->course_model->get(array("type" => $type));
        $this->course_model->edit_tag($type,array("steps"=>$this->add_json($course_data['steps'] , array("t"=> $id)) ));
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

            public function edit_link(){
                $params = parent::get_params('POST', array('type' , 'direction' , 'link'));if(empty($params)) return;extract($params);
                $course_data = $this->course_model->get(array("type" => $type));
                $this->course_model->edit_tag($type,array("site"=>$this->edit_json($course_data['site'],"link",$link)));
                $this->course_model->edit_tag($type,array(
                    "description" => $direction
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

            public function addClassListTag(){
                $params = parent::get_params('POST', array('id' , 'className' , 'classLink'));if(empty($params)) return;extract($params);
                if($insertid = $this->tag_model ->create(array(
                    "name" => $className,
                    "link" => $classLink,
                    "type" => "1"
                ))){
                    $data = $this->course_model->get_list($id,0,5,true);
                    $data = $this->add_json($data[0]['tags'],array("t"=>$insertid));
                    if($this->course_model->edit_tag($id,array("tags" => $data))){
                        $this->finish(true);
                    }else{
                        $this->finish(false,"未知的网络原因");
                    }
                }else{
                    $this->finish(false,"未知的网络原因");
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

		$this->admin_model->edit(array(
            'auid' => $this->me['id'],
            'nickname' => $nickname
        ));

		parent::finish(true);
    }

    public function create() {
        $params = parent::get_params('POST', array('name', 'nickname', 'pwd'));
        extract($params);

        $this->check_admin_login();

		if (false === $this->admin_model->create(array(
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

		if (false === $this->admin_model->remove(array(
            'name' => $name,
            'auid' => $cur_id
        ))) {
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

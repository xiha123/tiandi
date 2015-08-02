<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/base_api.php');

class admin_api extends base_api {
    public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
    }

    public function editClassPublic(){
        $params = parent::get_params('POST', array('id' , "title" , "content" , "time" ));if(empty($params)) return;extract($params);
        if(time() >  strtotime($time) + 86400) {parent::finish(false, '不能填写小于今日的时间请检查后再保存');return;}
        if(!$this->admin_model->editClassPublic($params)){
            parent::finish(false,"未知的原因导致删除失败 error:deleteClassPublic");
        }else{
            parent::finish(true);
        }
    }


    public function deleteClassPublic(){
        $params = parent::get_params('POST', array('id'));if(empty($params)) return;extract($params);
        if(!$this->admin_model->deleteClassPublic($id)){
            parent::finish(false,"未知的原因导致删除失败 error:deleteClassPublic");
        }else{
            parent::finish(true);
        }
    }

    public function addClassPublic(){
        $params = parent::get_params('POST', array('id' , 'title' , 'content' , 'time' , 'type'));if(empty($params)) return;extract($params);
        $type = $type == 'false' ? "1" : '0';
        $time = strtotime($time);
        if(time() > strtotime($time)+ 86400){parent::finish(false, '不能填写小于今日的时间请检查后再保存');return;}
        if(!$data = $this->admin_model->addClassPublic(array(
            "id" => $id,
            "title" =>$title,
            "time" =>$time,
            "type" =>$type,
            "content" => $content
        ))){
            parent::finish(false, '无法插入该课程，请稍候再试');
        }else{
            parent::finish(true , $data);
        }
    }


	//添加新的课程列表
	public function addClassList(){
        	$params = parent::get_params('POST', array('className' , 'classVideo' , 'text'));if(empty($params)) return;extract($params);
		if(!$this->admin_model->addClassList(array(
			"className" => $className,
			"text" =>$text,
			"video" => $classVideo
		))){
			parent::finish(false, '填写的新课程名与其他课程重名了');
		}else{
			parent::finish(true);
		}
	}
	public function addClassContent(){
        	$params = parent::get_params('POST', array('id' , 'title' , 'content'));if(empty($params)) return;extract($params);
		$this -> admin_model -> addClassContent(array(
			"id" => $id,
			"title" => $title,
			"content" => $content
		));
		parent::finish(true);
	}
	public function addClassListTag(){
        	$params = parent::get_params('POST', array('id' , 'className' , 'classLink'));if(empty($params)) return;extract($params);
		$this -> admin_model -> addClassListTag(array(
			"id" => $id,
			"className" => $className,
			"classLink" => $classLink
		));
		parent::finish(true);
	}
	public function addClassListLink(){
        	$params = parent::get_params('POST', array('id' , 'direction' , 'link'));if(empty($params)) return;extract($params);
		$this -> admin_model -> addClassListLink(array(
			"id" => $id,
			"link" => $link,
			"direction" => $direction
		));
		parent::finish(true);
	}

	public function editClassListTag(){
        	$params = parent::get_params('POST', array('id' , 'className' , 'classLink'));if(empty($params)) return;extract($params);
		$this -> admin_model -> editClassListTag(array(
			"id" => $id,
			"className" => $className,
			"classLink" => $classLink
		));
		parent::finish(true);
	}

	public function editClassContent(){
        	$params = parent::get_params('POST', array('id' , 'title' , 'content'));if(empty($params)) return;extract($params);
		$this -> admin_model -> editClassContent(array(
			"id" => $id,
			"title" => $title,
			"content" => $content
		));
		parent::finish(true);
	}






	//删除课程列表
	public function deleteClassList(){
        	$params = parent::get_params('POST', array('id'));if(empty($params)) return;extract($params);
		$this -> admin_model -> deleteClassList($id);
		$this -> admin_model -> deleteClassListTag_all($id);
		$this -> admin_model -> deleteClassContent_all($id);


		parent::finish(true);
	}
	public function deleteClassListTag(){
        	$params = parent::get_params('POST', array('id'));if(empty($params)) return;extract($params);
		$this -> admin_model -> deleteClassListTag($id);
		parent::finish(true);
	}
	public function deleteClassContent(){
        	$params = parent::get_params('POST', array('id'));if(empty($params)) return;extract($params);
		$this -> admin_model -> deleteClassContent($id);
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
		if($this -> admin_model -> editClassList(array(
			"id" => $id,
			"className" => $className,
			"classVideo" => $classVideo,
			"text" => $text
		))){
			parent::finish(true);
		}else{
			parent::finish(false , "填写的新课程名与其他课程重名了");
		}

	}





    public function login() {
        	$params = parent::get_params('POST', array('name', "pwd"));if(empty($params)) return;extract($params);


		if ($this->admin_model->login($name, $pwd) === false) {
			parent::finish(false, '用户名或密码错误');
		}

		parent::finish(true);
    }

    public function logout() {
		if ($this->admin_model->logout() === false) {
			parent::finish(false, '注销失败');
		}
    }

    public function edit() {
        $params = parent::get_params('POST', array('nickname'));
        if (empty($params)) return;
        extract($params);

		$cur_id = $this->session->userdata('auid');
		if (!isset($cur_id)) {
			parent::finish(false, '没有权限');
        }

		$this->admin_model->edit(array(
            'auid' => $cur_id,
            'nickname' => $nickname
        ));

		parent::finish(true);
    }

    public function create() {
        $params = parent::get_params('POST', array('name', 'nickname', 'pwd'));
        if (empty($params)) return;
        extract($params);

		$cur_id= $this->session->userdata('auid');
		if (!isset($cur_id)) {
			parent::finish(false, '没有权限');
        }

		if (false === $this->admin_model->create(array(
            'name' => $name,
            'nickname' => $nickname,
            'pwd' => $pwd
        ))) {
			parent::finish(false, '用户名已存在');
        }

		parent::finish(true);
    }

    public function remove() {
        $params = parent::get_params('POST', array('name'));
        if (empty($params)) return;
        extract($params);

		$cur_id= $this->session->userdata('auid');
		if (!isset($cur_id)) {
			parent::finish(false, '没有权限');
        }

		if (false === $this->admin_model->remove(array(
            'name' => $name,
            'auid' => $cur_id
        ))) {
			parent::finish(false, '目标是自己或不存在');
        }

		parent::finish(true);
    }
}
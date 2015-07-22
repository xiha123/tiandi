<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * admin_api
 * 和后台操作相关
 */
include_once(APPPATH . 'controllers/base_api.php');

class admin_api extends base_api {
    public function __construct() {
		parent::__construct();
		$this->load->model('admin_model');
		$this->admin_model->check_login();
    }
    
    
    	public function deleteClassPublic(){
        	$params = parent::getParams('POST', array('id'));if(empty($params)) return;extract($params);
		if(!$this->admin_model->deleteClassPublic($id)){
			parent::finish(false,"未知的原因导致删除失败 error:deleteClassPublic");
		}else{
			parent::finish(true);
		}		
	}
    	public function addClassPublic(){
        	$params = parent::getParams('POST', array('id' , 'title' , 'content' , 'time'));if(empty($params)) return;extract($params);
		$time = (strtotime($time) + 86400);
		if(time() > $time) {parent::finish(false, '不能填写小于今日的时间请检查后再保存');return;}
		if(!$data = $this->admin_model->addClassPublic(array(
			"id" => $id,
			"title" =>$title,
			"time" =>$time,
			"content" => $content
		))){
			parent::finish(false, '无法插入该课程，请稍候再试');return;
		}else{
			parent::finish(true , $data);	
		}
	}
    
    
	//添加新的课程列表
	public function addClassList(){
        	$params = parent::getParams('POST', array('className' , 'classVideo' , 'text'));if(empty($params)) return;extract($params);
		if(!$this->admin_model->addClassList(array(
			"className" => $className,
			"text" =>$text,
			"video" => $classVideo
		))){
			parent::finish(false, '填写的新课程名与其他课程重名了');return;
		}else{
			parent::finish(true);	
		}
	}
	public function addClassContent(){
        	$params = parent::getParams('POST', array('id' , 'title' , 'content'));if(empty($params)) return;extract($params);
		$this -> admin_model -> addClassContent(array(
			"id" => $id,
			"title" => $title,
			"content" => $content
		));
		parent::finish(true);
	}
	public function addClassListTag(){
        	$params = parent::getParams('POST', array('id' , 'className' , 'classLink'));if(empty($params)) return;extract($params);
		$this -> admin_model -> addClassListTag(array(
			"id" => $id,
			"className" => $className,
			"classLink" => $classLink
		));
		parent::finish(true);
	}
	public function addClassListLink(){
        	$params = parent::getParams('POST', array('id' , 'direction' , 'link'));if(empty($params)) return;extract($params);
		$this -> admin_model -> addClassListLink(array(
			"id" => $id,
			"link" => $link,
			"direction" => $direction
		));
		parent::finish(true);
	}
	
	public function editClassListTag(){
        	$params = parent::getParams('POST', array('id' , 'className' , 'classLink'));if(empty($params)) return;extract($params);
		$this -> admin_model -> editClassListTag(array(
			"id" => $id,
			"className" => $className,
			"classLink" => $classLink
		));
		parent::finish(true);
	}
	
	public function editClassContent(){
        	$params = parent::getParams('POST', array('id' , 'title' , 'content'));if(empty($params)) return;extract($params);
		$this -> admin_model -> editClassContent(array(
			"id" => $id,
			"title" => $title,
			"content" => $content
		));
		parent::finish(true);
	}
	




	
	//删除课程列表
	public function deleteClassList(){
        	$params = parent::getParams('POST', array('id'));if(empty($params)) return;extract($params);
		$this -> admin_model -> deleteClassList($id);
		$this -> admin_model -> deleteClassListTag_all($id);
		$this -> admin_model -> deleteClassContent_all($id);
		
		
		parent::finish(true);
	}
	public function deleteClassListTag(){
        	$params = parent::getParams('POST', array('id'));if(empty($params)) return;extract($params);
		$this -> admin_model -> deleteClassListTag($id);
		parent::finish(true);
	}
	public function deleteClassContent(){
        	$params = parent::getParams('POST', array('id'));if(empty($params)) return;extract($params);
		$this -> admin_model -> deleteClassContent($id);
		parent::finish(true);
	}	
	public function deleteSlider(){
		$params = parent::getParams('POST', array('id'));
		if(empty($params))return;
		extract($params);
		$this->admin_model->deleteSlider($id);
		parent::finish(true);
	}
	
	
	//删除课程列表
	public function editClassList(){
        	$params = parent::getParams('POST', array('id' , "className" , "classVideo" , "text"));if(empty($params)) return;extract($params);
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
        $params = parent::getParams('POST', array('username', 'pwd'));
        if(empty($params)) return;
        extract($params);

		if ($this->admin_model->login($username, $pwd) === false) {
			parent::finish(false, '用户名或密码错误');
			return;
		}

		parent::finish(true);
    }

    public function edit() {
        $params = parent::getParams('POST', array('nickname'));
        if (empty($params)) return;
        extract($params);

		$cur_id= $this->session->userdata('auid');
		if (!isset($cur_id)) {
			parent::finish(false, '没有权限');
			return;
        }

		$this->admin_model->edit(array(
            'auid' => $cur_id,
            'nickname' => $nickname
        ));

		parent::finish(true);
    }

    public function create() {
        $params = parent::getParams('POST', array('name', 'nickname', 'pwd'));
        if (empty($params)) return;
        extract($params);

		$cur_id= $this->session->userdata('auid');
		if (!isset($cur_id)) {
			parent::finish(false, '没有权限');
			return;
        }

		if (false === $this->admin_model->create(array(
            'name' => $name,
            'nickname' => $nickname,
            'pwd' => $pwd
        ))) {
			parent::finish(false, '用户名已存在');
			return;
        }

		parent::finish(true);
    }

    public function remove() {
        $params = parent::getParams('POST', array('name'));
        if (empty($params)) return;
        extract($params);

		$cur_id= $this->session->userdata('auid');
		if (!isset($cur_id)) {
			parent::finish(false, '没有权限');
			return;
        }

		if (false === $this->admin_model->remove(array(
            'name' => $name,
            'auid' => $cur_id
        ))) {
			parent::finish(false, '目标是自己或不存在');
			return;
        }

		parent::finish(true);
    }
}

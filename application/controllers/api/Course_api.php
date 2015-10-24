<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class Course_api extends Base_api {
    public function __construct() {
        parent::__construct();
        $this->load->model('course_model');
        $this->load->model('course_step_model');
        $this->load->model('admin_model');
        $this->load->model('course_chapter_model');
        $this->me = $this->admin_model->check_login();
        if ($this->me === false) {
            $this->finish(false, '未登录');
        }
    }


    /**
     * 添加一个新的课程
     * @param title
     * @param type
     * @return  bool [<description>]
     */
    public function add_class(){
        $params = $this->get_params('POST', array("title" , "type"));extract($params);
        if($this->course_model->is_exist(array('title' => $title))) $this->finish(false, '您输入的课程已经存在了');
        if($type < 0 || $type > 4) $this->finish(false, '您输入的父类分类错误');
        $this->course_model->create(array(
            'title' => $title,
            'type' => $type,
        ));
        $this->finish(true);
    }

    

    public function create() {
        $params = $this->get_params('POST', array(
            'title' => true,
            'type' => true,
            'video' => true,
            'tag' => false,
            'description' => true
        ));
        extract($params);

        if ($this->course_model->is_exist(array('title' => $title))) {
            $this->finish(false, '重复的标题');
        }

        $this->course_model->create(array(
            'title' => $title,
            'type' => $type,
            'video' => $video,
            'description' => $description
        ));

		$this->finish(true);
    }

    public function remove() {
        $params = $this->get_params('POST', array(
            'course_id' => true
        ));
        extract($params);

        if ($this->course_model->is_exist(array('id' => $course_id))) {
            $this->finish(false, '该课程不存在');
        }

        $this->course_model->remove($course_id);
    }

    public function edit() {
    }

    public function create_chapter() {
    }

    public function create_step() {
    }
}

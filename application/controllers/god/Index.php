<?php
class index extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("user_model");
	}
	public function index() {
		$userdata = $this->user_model->check_login();

		// 课程处理通用Tab
		$userdata['type_name'] = $this->input->get('type');
		if(isset($_GET['type'])){
			switch ($userdata['type_name']) {
				case 'u3d':$type = 0;break;
				case 'Egret':$type = 1;break;
				case 'Web':$type = 2;break;
				case 'Cocos2d-x':$type = 3;break;
				case 'Android':$type = 4;break;
				default:$type = 0;$userdata['type_name'] = "u3d";break;
			}
			$userdata['types'] = $type;
		}else{
			$userdata['types'] = 0;
			$userdata['type_name'] = "u3d";
		}

		// 分页通用
		$userdata["page"] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$userdata['page_max'] = $this->user_model->get_count(array("type" => 1 , "father_tag" => $userdata['types']));
		$userdata['data'] =(array) $this->user_model->get_god_list(array("type" => 1 , "father_tag" => $userdata['types']) , $userdata["page"] - 1 , 10);
        foreach ($userdata['data'] as $key => $god) {
            $level_id = ModelFactory::User()->get_god_level(0,$god);
            $level_name = ModelFactory::User()->get_god_level_name($level_id);
            $god['level_name'] = $level_name;
            $userdata['data'][$key] = $god;
        }
        $this->load->view('miaoda/god/list.php' , $userdata);
	}

}

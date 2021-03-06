<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class God_api extends Base_api {
	public function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("news_model");
		$this->me = $this->user_model->check_login();
	}

	public function addGodApply(){
		parent::require_login();
		$params = $this->get_params('POST', array( 'name','tag' , 'cellphone','description'));
		extract($params);

		if(!$this->user_model->is_exist(array(
			"id" => $this->me["id"],
			"type" => "0"
		))){
			$this->finish(false , "无法添加大神审核，您可能已经提交了申请大神请求！");
		}

		$skilled_tags = array(
			'["unity-3d"]',
			'["Flash"]',
			'["web"]',
			'["cocos2d-x"]',
			'["android"]',
		);
		$tag = $tag > 4 || $tag < 0 ? 0 : $tag;
		if($this->user_model->edit($this->me["id"],array(
			"name" => $name,
			"cellphone" => $cellphone,
			"god_description" => $description,
			"type" => 2,
			"god_skilled_tags" => $skilled_tags[$tag],
			"father_tag" => $tag,
		))) {
			$this->news_model->create(array(
				'target' => $this->me['id'],
				'type' => '100'
			));
			$this->finish(true );
		}else{
			$this->finish(false , "无法添加大神审核");
		}
	}
}

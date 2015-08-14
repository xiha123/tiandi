<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class god_api extends base_api {
	public function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("news_model");
		$this->me = $this->user_model->check_login();
	}
	public function addGodApply(){
		parent::require_login();$params = $this->get_params('POST', array( 'name','tag' , 'cellphone','description' ,'alipay','idcar'));extract($params);
		if(!$this->user_model->is_exist(array(
			"id" => $this->me["id"],
			"type" => "0"
		))){
			$this->finish(false , "无法添加大神审核，您可能已经提交了申请大神请求！");
		}
		$tag = $tag > 4 || $tag < 0 ? 0 : $tag;
		if($this->user_model->edit($this->me["id"],array(
			"name" => $name,
			"cellphone" => $cellphone,
			"god_description" => $description,
			"alipay" => $alipay,
			"idcar" => $idcar,
			"type" => 2,
			"father_tag" => $tag
		))){
			$this->news_model->add_news($this->me['id'] , "您成功提交了大神申请请求，请等待审核通过！");
			$this->finish(true );
		}else{
			$this->finish(false , "无法添加大神审核");
		}
	}
}

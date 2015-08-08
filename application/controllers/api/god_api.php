<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH . 'controllers/api/base_api.php');
class god_api extends base_api {
	public function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->me = $this->user_model->check_login();
	}
	public function addGodApply(){
		parent::require_login();$params = $this->get_params('POST', array( 'name','cellphone','description' ,'alipay','idcar'));extract($params);
		if(!$this->user_model->is_exist(array(
			"id" => $this->me["id"],
			"type" => "0"
		))){
			$this->finish(false , "无法添加大神审核，因为没有找到符合条件的用户");
		}
		if($this->user_model->edit($this->me["id"],array(
			"name" => $name,
			"cellphone" => $cellphone,
			"description" => $description,
			"alipay" => $alipay,
			"idcar" => $idcar,
			"type" => 2,
		))){
			$this->finish(true );
		}else{
			$this->finish(false , "无法添加大神审核");
		}
	}
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSet extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("user_model");
		$this->me = $this->user_model->check_login();
	}
	public function index()
	{
		if(!isset($this->me['email'])){show_404();}
		$this->me['god_skilled_tags'] = json_decode($this->me['god_skilled_tags']);
		$this->load->view('miaoda/userSet.php', $this->me);
	}
	public function profile(){
		$profile['user_id'] = $this->me['id'];
		$avatar =  $this->input->post("avatar_url");
		$fav_tag =  $this->input->post("fav_tag");
		$profile['type'] =  $this->input->post("type");
		$profile['company'] =  $this->input->post("company");
		$profile['station'] =  $this->input->post("station");
		$profile['school'] =  $this->input->post("school");
		$profile['professional'] =  $this->input->post("professional");
		if ($avatar) {
			ModelFactory::User()->edit($this->me['id'],[
					'avatar' => $avatar
			]);
		}
		$tags = explode(' ',$fav_tag);
		foreach ($tags as $tag) {

			$tag = ModelFactory::Tag()->get_tag_withtype($tag);
			if (!$tag) {
				ModelFactory::Tag()->add_tag($tag);
				$tag = ModelFactory::Tag()->get_tag_withtype($tag);
			}
			$is_col = ModelFactory::Tag()->is_collect_tag($tag['id']);
			if (!$is_col) {
				ModelFactory::Tag()->collect_tag($tag['id']);
			}
		}
		if (!$pro = ModelFactory::UserProfile()->getbyuserid($this->me['id'])) {
			ModelFactory::UserProfile()->create($profile);
		}else{
			ModelFactory::UserProfile()->edit($pro['id'],$profile);
		}
		header("location: /home?home=index&uid=".$this->me['id']);
	}
}

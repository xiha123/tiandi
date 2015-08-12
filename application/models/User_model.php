<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');include_once(APPPATH . 'models/Base_model.php');class User_model extends Base_model {	public function __construct() {		parent::__construct();		$this->table_name = 'user';		$this->id_name = 'uid';		$this->me = $this->check_login();		$this->load->model("tag_model");	}	public function get_user_list($params){		$data = $this->db->query("select `nickname` ,`id`,`avatar` from `".$this->table_name."` where `id`='".$params['id']."' and `type`=0 or `type`=2")->row_array();		if(!isset($data[0])){			return array($data);		}else{			return $data;		}	}	public function login($username, $pwd) {		$user = $this->db->select('id, pwd, salt')->where('email', $username)->get($this->table_name)->row_array();		if(count($user) <= 0){			return false;		}		if (empty($user) || $user['pwd'] !== md5($pwd . $user['salt'])) return '用户名或密码错误';		$this->session->set_userdata($this->id_name, $user['id']);		return true;	}	public function logout() {		$this->session->unset_userdata($this->id_name);		return true;	}	public function check_login() {		$id = $this->session->userdata($this->id_name);		if (!isset($id)) return false;		$userdata = $this->get(array(			"id" => $id		));		if($userdata["avatar"] == NULL){			$userdata["avatar"] = "static/image/default.jpg";		}		return $userdata;	}	public function get_user_data($id){		$userdata = parent::get(array("id"=>$id ));		$userdata["skilled_tags"] = $this->tag_model->get_list_by_json($userdata['skilled_tags']);		if(count($userdata) <=0 )return false;		if(@$userdata["avatar"] == NULL){			@$userdata["avatar"] = "static/image/default.jpg";		}		return $userdata;	}	// email, nickname, pwd	public function create($params) {		extract($params);		if($this->is_exist(array('email' => $email))) return '该邮箱已被使用';		if($this->is_exist(array('nickname' => $nickname))) return '该昵称已被使用';		$salt = substr(uniqid(rand()), -10);		return parent::create(array(			'nickname' => $nickname,			'email' => $email,			'salt' => $salt,			'pwd' => md5($pwd . $salt)		));	}	public function updata_pic($id){		$this->edit($id , array(			"avatar" => "./static/uploads/".$id.".jpg",		));		return true;	}	public function follow_problem($pid) {		$collect = json_decode($this->me['follow_problems']);		array_push($collect ,array("t" => $pid));		$collect = json_encode($collect);		$this->db->where('id' , $this->me['id'])->update($this->table_name , array(			"follow_problems" => $collect		));		return $this->db->affected_rows() > 0;	}	public function unfollow_problem($pid) {		$collect = $this->get_problem_json($pid , "follow_problems");		$this->db->where('id' , $this->me['id'])->update($this->table_name , array(			"follow_problems" => $collect		));		return $this->db->affected_rows() > 0;	}	// 添加收藏	public function collect_problem($pid) {		if($this->is_problem($pid) == true)return false;		$collect = json_decode($this->me['collect_problems']);		array_push($collect ,array("t" => $pid));		$collect = json_encode($collect);		$this->db->where('id' , $this->me['id'])->update($this->table_name , array(			"collect_problems" => $collect		));		return $this->db->affected_rows() > 0;	}	public function uncollect_problem($pid) {		if($this->is_problem($pid) == false)return false;		$collect = $this->get_problem_json($pid);		$this->db->where('id' , $this->me['id'])->update($this->table_name , array(			"collect_problems" => $collect		));		return $this->db->affected_rows() > 0;	}	public function get_problem_json($pid , $type = 'collect_problems' ) {		$temp_collect = array();		$collect = json_decode($this->me[$type]);		foreach ($collect as $key => $value) {			if($value->t != $pid){				array_push($temp_collect, array("t" => $value->t ));			}		}		$temp_collect = json_encode($temp_collect);		return $temp_collect == "" ? "[]" : $temp_collect;	}	public function is_problem($pid ,$type = 'collect_problems') {		$temp_collect = array();		if(!isset($this->me[$type]))return false;		$collect = json_decode($this->me[$type]);		foreach ($collect as $key => $value) {			if($value->t == $pid){				return true;			}		}		return false;	}}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');include_once(APPPATH . 'models/Base_model.php');class News_model extends Base_model {	public function __construct() {		parent::__construct();		$this->table_name = 'news';	}/*	// 推送新的通知给用户	public function add_news($uid,$value,$form="system"){		if($uid == $form){return true;}		if($this->create(array(			"type" => "0",			"content" => $value,			"from" => $form,			"to" => $uid,			"time" => time()		))>=0){			return true;		}else{			return false;		}	}	public function get_news($uid,$page = 0,$count = 20){		$this->db->order_by("time",'DESC');		$this->db->limit(20 , ($page - 1) * $count);		return $this->db->get_where($this->table_name,array(			"to" => $uid		))->result_array();	}	public function get_news_count($uid){		return $this->db->select('from')->get_where($this->table_name,array(			"to" => $uid		))->num_rows();	}	*/}
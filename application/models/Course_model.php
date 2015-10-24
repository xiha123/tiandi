<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');include_once(APPPATH . 'models/Base_model.php');class Course_model extends Base_model {	public function __construct() {		parent::__construct();		$this->load->model('course_step_model');		$this->load->model('course_chapter_model');		$this->load->model('tag_model');		$this->table_name = 'course';	}	public function addCourse($params){		if(parent::is_exist(array("title" => $params["title"])) ){			return -2;		}		return parent::create($params) > 0 ? 0 : -1;	}	public function edit_tag($type,$params){		$this->db->where("type" , $type)->update($this->table_name,$params);		return true;	}	public function get_list($id, $page = 0, $count = 5,$isJson = false,$site=false) {		$where = $id == "all" ? array() : array('id' => $id);		$list = parent::get_list($where, $page, $count);		foreach ($list as $key => $item) {			if(!$isJson){				$list[$key]['tags'] = $this->tag_model->get_tag_list($item['tags']);				$list[$key]['site'] = $this->get_site_by_json($item['site']);				$list[$key]['steps'] = $this->get_step_by_json($item['steps']);				// $list[$key]['chapters'] = $this->get_chapter_by_json($item['chapters']);			}else{				if($site){					$list[$key]['site'] = $this->get_site_by_json($item['site']);				}			}		}		return $list;	}	private function get_chapter_by_json($json) {		$result = array();		foreach (json_decode($json) as $chapter) {			$result[] = $this->chapter_model->get(array(				'id' => $chapter			));		}		return $result;	}	public function get_site_by_json($json) {		$result = array();		foreach (json_decode($json) as $step) {			$result[$step->t] = $step->value;		}		return $result;	}	private function get_step_by_json($json) {		$result = array();		foreach (json_decode($json) as $chapter) {			$result[] = $this->course_step_model->get(array(				'id' => $chapter->t			));		}		return $result;	}	public function get_list_by_type($type) {		$res = $this->db->where('type', $type)->order_by('id', 'DESC')->get($this->table_name)->result_array();		foreach($res as &$item) {			$item['site'] = $this->get_site_by_json($item['site']);			$item['class'] = $this->course_step_model->get_list(array("course_id" => $item['id'],"s"=>"ok") ,0 , 8);		}		return $res;	}}
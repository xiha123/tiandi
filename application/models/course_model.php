<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'models/base_model.php');

class course_model extends base_model {	public function __construct() {		parent::__construct();		$this->load->model('course_step_model');		$this->load->model('course_chapter_model');		$this->load->model('tag_model');		$this->tableName = 'course';	}	public function getList($type, $count = 5) {		$query = $this->db->where(array(			'status' => 1,			'type' => $type		))->order_by('id', 'DESC')->limit($count)->get('course')->result_array();		foreach ($query as $item) {			$item['tags'] = $this->getTagByJSON($item['tags']);			$item['steps'] = $this->getStepByJSON($item['steps']);			$item['chapters'] = $this->getChapterByJSON($item['chapters']);		}		return $query;	}	private function getChapterByJSON($json) {		$result = array();		foreach (json_decode($json) as $chapter) {			$result[] = $this->chapter_model->getById($chapter)		}		return $result;	}	private function getStepByJSON($json) {		$result = array();		foreach (json_decode($chapterJSON) as $step) {			$result[] = $this->step_model->getById($step)		}		return $result;	}	private function getTagByJSON($json) {		$result = array();		foreach (json_decode($json) as $tag) {			$result[] = $this->tag_model->getById($tag)		}		return $result;	}}
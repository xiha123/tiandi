<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');include_once(APPPATH . 'models/Base_model.php');class Usertask_model extends Base_model {	public function __construct() {		parent::__construct();		$this->table_name = 'user_task';	}    function replace($id,$params){        if ($id) {            unset($params['created_at']);        }        return parent::replace($id,$params);    }    function replace_task_id($user_id,$task_id,$params){        $do_task = ModelFactory::Usertask()->get(['user_id'=>$user_id,'task_id'=>$task_id]);        $params['user_id'] = $user_id;        $params['task_id'] = $task_id;        return $this->replace(isset($do_task)?$do_task['id']:0,$params);    }    public function answer_sign($id,$date,$time){        return $this->replace_task_id($id,CONSTFILE::USER_TASK_GOD_ANSWER_QUESTION,array(            'created_at'=>time(),            'task_val'=>json_encode([                    'date'=>$date,                    'time'=>$time,            ])        ));    }    public function is_keep_answer($id,$data=[]){        $data =$data ?$data: (array)$this->get(['user_id'=>$id,'task_id'=>CONSTFILE::USER_TASK_GOD_ANSWER_QUESTION]);        $sign_info = @json_decode($data['task_val'],1);        $is_keep = isset($sign_info['date']) && $sign_info['date']?$sign_info['date'] == date('Y-m-d',time()-86400):false;        if ($is_keep) {            return isset($sign_info['time']) && $sign_info['time'] ? $sign_info['time']:0;        }else{            return 0;        }    }}
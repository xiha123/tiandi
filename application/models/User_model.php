<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');include_once(APPPATH . 'models/Base_model.php');class User_model extends Base_model {	public function __construct() {		parent::__construct();		$this->table_name = 'user';		$this->id_name = 'uid';		$this->load->model("tag_model");		$this->load->model("news_model");		$this->me = $this->check_login();	}	/**	* 获得大神列表以关注人数排序	* @param	* @param	* @param	* @return	*/	public function get_god_list($params, $page, $count){		$this->db->order_by('follower_count', 'DESC');		$page = $page < 0 ? 0 : $page;		return $this->db->where($params)->limit($count, $page * $count)->get($this->table_name)->result_array();	}	/**	 * 增加金币或银币	 * @param  formUser	 * @param  number	 * @param  type true 为增加false为减少	 * @param  gold_coin/silver_coin 金币与银币	 * @return bool	 */	public function coin($formUser , $number , $type = true , $coin = "silver_coin",$count_type=0){        $change_type = 0;        switch ($coin) {            case 'silver_coin':                $change_type = CONSTFILE::USER_SILVER_COIN;                break;            case 'gold_coin':                $change_type = CONSTFILE::USER_SILVER_COIN;                break;            case 'Integral':                $change_type = CONSTFILE::USER_INTEGRAL;                break;            case 'prestige':                $change_type = CONSTFILE::USER_PRESTIGE;                break;        }        if (!$change_type) {            throw new Exception("error change type");        }		if($type == false){			$coin_data = $this->db->select(array($coin))->get_where($this->table_name , array("id" => $formUser))->row_array();			if($coin_data[$coin] - $number < 0)return false;		}		$type = $type ? "+" : "-";		$this->db->query("update `" . $this->table_name ."` SET		`{$coin}` = `{$coin}` {$type} {$number}		WHERE `id` = {$formUser}");		$data = $this->db->affected_rows() > 0;        if ($data) {            $this->changelog(array(                'user_id'=>$formUser,                'type'=>$change_type,                'count_type'=>$count_type,                'count'=>$type=='+'?$number:-$number,                'created_at'=>time()            ));            if ($change_type == CONSTFILE::USER_PRESTIGE) {            }            if ($change_type == CONSTFILE::USER_SILVER_COIN) {                $user_data = $this->get_user($formUser);                    if ($user_data['silver_coin'] >= CONSTFILE::USER_SILVER_CHANGE_PRESTIGE_VALUE) {                        $god_level = $this->get_god_level($formUser,$user_data);                        $cg_value = 0;                        if ($god_level <= 2) {                            $cg_value = 5;                        }                        if ($god_level <= 7 && $god_level >= 3) {                            $cg_value = 8;                        }                        if ($god_level <= 10 && $god_level >= 8) {                            $cg_value = 15;                        }                        $do_task = ModelFactory::Usertask()->get(['user_id'=>$formUser,'task_id'=>CONSTFILE::USER_TASK_GOD_5000]);                        $task_val = isset($do_task['task_val'])?$do_task['task_val']:0;                        $silver_coin = floor($user_data['silver_coin']/CONSTFILE::USER_SILVER_CHANGE_PRESTIGE_VALUE) ;                        $diff = $silver_coin - $task_val;                        if ($diff > 0 && $cg_value) {                            $task_result = ModelFactory::Usertask()->replace($do_task?$do_task['id']:0,[                                'user_id'=>$formUser,                                'task_id'=>CONSTFILE::USER_TASK_GOD_5000,                                'task_val'=>$silver_coin,                                'created_at'=>time(),                            ]);                            if ($task_result) {                                $this->coin($formUser,$cg_value,true,'prestige',CONSTFILE::CHANGE_LOG_COUNT_TYPE_5000);                            }                        }                    }            }        }        return $data;	}    public function get_god_level($id,$user_data=[]){        $user_data = $user_data?$user_data:$this->get_user($id);        $config = array(            1=>51,            2=>151,            3=>301,            4=>501,            5=>901,            6=>1701,            7=>3301,            8=>5501,            9=>PHP_INT_MAX,        );        foreach ($config as $key=>$value) {            if ($user_data['prestige'] < $value) {                break;            }        }        return $key;    }    public function get_user_level($id,$user_data=[]){        $user_data = $user_data?$user_data:$this->get_user($id);        $config = array(            1=>200,            2=>500,            3=>1000,            4=>2000,            5=>3200,            6=>5000,            7=>7500,            8=>1000,            9=>13000,            10=>PHP_INT_MAX,        );        foreach ($config as $key=>$value) {            if ($user_data['Integral'] < $value) {                break;            }        }        return $key;    }    public function get_user_level_name($id){        $config = array(            1=>'编程入门',            2=>'初尝甜头',            3=>'渐入佳境',            4=>'茅塞顿开',            5=>'醍醐灌顶',            6=>'得心应手',            7=>'炉火纯青',            8=>'所向披靡',            9=>'攻城大湿',            10=>'独孤求败',        );        return isset($config[$id])?$config[$id]:'';    }    public function get_god_level_name($level_id){        $config = array(            1=>'初执教鞭',            2=>'教导有方',            3=>'孜孜不倦',            4=>'良工心苦',            5=>'耳提面命',            6=>'良师益友',            7=>'循循善诱',            8=>'春风化雨',            9=>'桃李天下',        );        return isset($config[$level_id])?$config[$level_id]:'';    }    public function changelog($param){        return ModelFactory::Changelog()->create($param);    }	/**	 * Integral 增加或减少用户积分	 * @param [type]  $formUser [description]	 * @param [type]  $number   [description]	 * @param boolean $type     [description]	 * @return bool     [description]	 */	public function Integral($formUser , $number , $type = true , $coin = "Integral",$count_type=0){		return $this->coin($formUser,$number,$type,'Integral',$count_type);	}	/**	 * [add_chou 添加一个众筹]	 * @param [type] $problem_id [description]	 * @return bool     [description]	 */	public function add_chou($problem_id){		$userData = json_decode($this->me['chou']);		array_push($userData,$problem_id);		return $this->edit($this->me['id'],array(			"chou" => json_encode($userData)		));	}    public function edit($id,$params){        $user_data = $this->get_user($id);        if ($user_data['type'] == 2 && $params['type'] == 1 && $user_data['parent_id']) {            $parent_id = $user_data['parent_id'];            $this->coin($parent_id,CONSTFILE::USER_PRESTIGE_VALUE,true,'prestige');        }        return parent::edit($id,$params);    }	/**	 * 获得用户资料（不处理各项json）	 * @param  [type] $uid [description]	 * @return [type]      [description]	 */	public function get_user($uid){		$get_user = $this->get(array("id" => $uid));		if(!isset($get_user['avatar'])) return false;		if($get_user['avatar'] == ""){			$get_user['avatar'] = "static/image/default.jpg";		}		$get_user['skilled_tags'] = $this->tag_model->get_list_by_json($get_user['skilled_tags'] , "id");		return count($get_user) <= 0 ? false : $get_user;	}	public function get_user_list($params){		$data = $this->db->query("select * from `".$this->table_name."` where `id`='".$params['id']."' and `type`=0 or `type`=2")->row_array();		if(!isset($data[0])){			return array($data);		}else{			return $data;		}	}	public function login($username, $pwd) {		$user = $this->db->select('id, pwd, salt, type')->where('email', $username)->get($this->table_name)->row_array();		if(count($user) <= 0){			return false;		}		if (empty($user) || $user['pwd'] !== md5($pwd . $user['salt'])){			return false;		}		$this->session->set_userdata($this->id_name, $user['id']);		parent::edit($user['id'], array(			'last_login_ip' => $this->input->ip_address()		));		return array(			'type' => $user['type'],			'id' => $user['id']		);	}	public function logout() {		$this->session->unset_userdata($this->id_name);		return true;	}	public function check_login() {		$id = $this->session->userdata($this->id_name);		if (!isset($id)) return false;		$userdata = $this->get(array(			"id" => $id		));		if ($userdata["avatar"] == NULL) {			$userdata["avatar"] = "static/image/default.jpg";		}		$this->load->model("news_model");		$userdata['news_nuw'] = $this->news_model->get_count(array("target" => $id , "status" => 0));		return $userdata;	}	public function get_user_data($id){		$userdata = parent::get(array("id"=>$id ));		$userdata["skilled_tags"] = $this->tag_model->get_list_by_json($userdata['skilled_tags']);		if(count($userdata) <=0 )return false;		if(@$userdata["avatar"] == NULL){			@$userdata["avatar"] = "static/image/default.jpg";		}		return $userdata;	}	// email, nickname, pwd	public function create($params) {		extract($params);		if($this->is_exist(array('email' => $email))) return '该邮箱已被使用';		if($this->is_exist(array('nickname' => $nickname))) return '该昵称已被使用';		$salt = substr(uniqid(rand()), -10);        try {            $this->begin();            $create_id = parent::create(array(                'nickname' => $nickname,                'email' => $email,                'salt' => $salt,                'pwd' => md5($pwd . $salt),                'avatar' => $avatar,                'oauth_key' => $avatar,                'parent_id' => $parent_id,				'register_ip' => $this->input->ip_address()            ));            if ($parent_id) {                ModelFactory::Invitehistory()->create([                   'parent_id'=> $parent_id,                   'user_id'=> $create_id,                   'created_ip'=> $this->input->ip_address(),                   'created_at'=> time(),                ]);                ModelFactory::Invitehistory()->clearCache( ModelFactory::Invitehistory()->getInviteKey(                   ['id'=>$parent_id]                ));            }            if ($create_id) {                $re = $this->user_model->coin($create_id , 200);                $re2 = $this->news_model->create(array(                    'target' => $create_id,                    'type' => '000'                ));                if ($re && $re2) {                    $this->commit();                    $this->login($email, $pwd);                    return true;                }else{                    throw new Exception('保存失败!');                }            }            $this->rollback();            return '保存失败!';        } catch (Exception $e ) {             $this->rollback();             return '保存失败!';        }	}	public function updata_pic($id){		$this->edit($id , array(			"avatar" => "./static/uploads/".$id.".jpg",		));		return true;	}	// 添加收藏	public function collect_problem($pid) {		if($this->is_problem($pid) == true)return false;		$collect = json_decode($this->me['collect_problems']);		array_push($collect ,array("t" => $pid));		$collect = json_encode($collect);		$this->db->where('id' , $this->me['id'])->update($this->table_name , array(			"collect_problems" => $collect		));		return $this->db->affected_rows() > 0;	}	public function uncollect_problem($pid) {		if($this->is_problem($pid) == false)return false;		$collect = $this->get_problem_json($pid);		$this->db->where('id' , $this->me['id'])->update($this->table_name , array(			"collect_problems" => $collect		));		return $this->db->affected_rows() > 0;	}	public function get_problem_json($pid , $type = 'collect_problems' ) {		$temp_collect = array();		$collect = json_decode($this->me[$type]);		foreach ($collect as $key => $value) {			if($value->t != $pid){				array_push($temp_collect, array("t" => $value->t ));			}		}		$temp_collect = json_encode($temp_collect);		return $temp_collect == "" ? "[]" : $temp_collect;	}	public function is_problem($pid ,$type = 'collect_problems') {		$temp_collect = array();		if(!isset($this->me[$type]))return false;		$collect = json_decode($this->me[$type]);		foreach ($collect as $key => $value) {			if($value->t == $pid){				return true;			}		}		return false;	}	public function get_by_oauth($key) {		$res = parent::get(array(			'oauth_key' => $key		));		if (empty($res)) return false;		return $res;	}	public function login_by_oauth($id) {		$this->session->set_userdata($this->id_name, $id);		return true;	}    public function is_sign($id,$data=[]){       $data =$data ?$data: (array)$this->get_user($id);       $sign_info = @json_decode($data['sign_info'],1);       $is_sign = isset($sign_info['date']) && $sign_info['date']?$sign_info['date'] == date('Y-m-d'):false;        if ($is_sign) {            return isset($sign_info['time']) && $sign_info['time'] ? $sign_info['time']:0;        }else{            return 0;        }    }    public function is_keep_sign($id,$data=[]){        $data =$data ?$data: (array)$this->get_user($id);        $sign_info = @json_decode($data['sign_info'],1);        $is_keep = isset($sign_info['date']) && $sign_info['date']?$sign_info['date'] == date('Y-m-d',time()-86400):false;        if ($is_keep) {            return isset($sign_info['time']) && $sign_info['time'] ? $sign_info['time']:0;        }else{            return 0;        }    }    public function sign($id,$date,$time){        return $this->db->where(['id'=>$id])->update($this->table_name,array('sign_info'=>json_encode([            'date'=>$date,            'time'=>$time,        ])));    }} 
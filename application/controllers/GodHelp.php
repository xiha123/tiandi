<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class godHelp extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->me = $this->user_model->check_login();
        $this->load->driver('cache', array('adapter' => 'file'));

    }

	public function index()
	{
		$this->load->view("help/godHelp.php", $this->me);
	}
	public function gift()
	{
		$this->load->view("help/gift.php", $this->me);
	}

    /**
     * @return CI_Cache_file;
     */
    public function cache(){
        return $this->cache;
    }
    public function get_silver(){

        $userdata = ModelFactory::User()->check_login();

        $silver_get = $this->getUserTask($userdata,CONSTFILE::USER_TASK_HUODONG_SILVER_CION);
        if (!$silver_get) {
            $number = mt_rand(100, 1000);
            ModelFactory::Pricelist()->create([
               'user_id'=>$userdata['id'],
               'type'=>1,
                'created_at'=>time(),
                'name'=>$userdata['nickname'],
                'price'=>$number,
            ]);
            ModelFactory::Usertask()->replace(0,[
                'user_id'=>$userdata['id'],
                'task_id'=>CONSTFILE::USER_TASK_HUODONG_SILVER_CION,
                'task_val'=>1,
                'created_at'=>time(),
            ]);
            ModelFactory::User()->coin($userdata['id'], $number,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_HUODONG_SILVER);
            echo json_encode(['result'=>true,'number'=>$number]);exit;
        }

        echo json_encode(['result'=>false]);

    }
    public function finish_invite(){

    }
    public function getUserTask($userdata,$task_id){
        $cache_key = 'huodong_'.$userdata['id'].'_'.$task_id;
        $silver_get = $this->cache()->get($cache_key);
        if (!$silver_get) {
            $do_task = ModelFactory::Usertask()->get(['user_id'=>$userdata['id'],'task_id'=>$task_id]);

            if ($do_task) {
                $this->cache()->save($cache_key,'1',86400);
                $silver_get = 1;
            }
        }
        return $silver_get;
    }
    public function get_invite(){


        $userdata = ModelFactory::User()->check_login();

        $where = [
            'parent_id'=>$userdata['id'],
        ];
        $id = ModelFactory::Invitehistory()->getInviteKey($userdata);
        $list = $this->cache()->get($id);
        if (!$list) {
            $list = (array) ModelFactory::Invitehistory()->get_list($where,0,10);
            foreach ($list as &$user) {
                    $get_user =  ModelFactory::User()->get(array("id" => $user['user_id']));
                    if(!isset($get_user['avatar'])) return false;
                    if($user['avatar'] == ""){
                        $user['avatar'] = "static/image/default.jpg";
                    }
            }
            if (count($list)==10) {
                $this->cache()->save($id,$list,86400);
            }else{
                $this->cache()->save($id,$list,10);
            }
        }
        echo json_encode(['list'=>$list]);

    }
	public function week()
	{

        $userdata = ModelFactory::User()->check_login();

        $silver_get = $this->getUserTask($userdata,CONSTFILE::USER_TASK_HUODONG_SILVER_CION);

        $price_list = $this->cache()->get('price_list');
        if (!$price_list) {
            $price_list = ModelFactory::Pricelist()->get_list([]);
            if ($price_list) {
                $this->cache()->save('price_list',$price_list,600);
            }else{
                $this->cache()->save('price_list',[],5);
            }
        }



        $id = $userdata['id'];
        if (!$id) {
            show_error("请先登录!",null,'提示');
        }
        $userdata['qqshare'] = site_url('share?'.http_build_query([
                'type'=>'qq',
                'from'=> 'invite',
            ]));
        $userdata['qqzshare'] = site_url('share?'.http_build_query([
                'type'=>'qqz',
                'from'=> 'invite',

            ]));
        $userdata['sinashare'] = site_url('share?'.http_build_query([
                'type'=>'sina',
                'from'=> 'invite',
            ]));
        $userdata['invate_url'] = base_url('/share/people?'.http_build_query([
                'trace'=>base64_encode($id),
                'from_invite'=>1
            ]));
        $userdata['silver_get'] = $silver_get;
        $userdata['price_list'] = $price_list;
        $userdata['me'] = $this->me;
		$this->load->view("help/week.php", $userdata);
	}
}

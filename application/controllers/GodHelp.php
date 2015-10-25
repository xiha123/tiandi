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
        if (!$userdata) {
            echo json_encode(['result'=>false]);
            return ;
        }
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

    public function get_video(){

        $userdata = ModelFactory::User()->check_login();
        if (!$userdata) {
            echo json_encode(['result'=>false]);
            return ;
        }
        $date  = 'get_video'.$userdata['id'];
        $conter =  $this->cache()->increment($date);
        $videos = [
          ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545188.mp4','name'=>'U3D公开课—喷气小飞鼠'],
          ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545187.mp4','name'=>'AS3游戏开发'],
          ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545186.mp4','name'=>'AS3—Starling教程'],
          ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545185.mp4','name'=>'WEB公开课—侧边栏效果'],
            ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545184.mp4','name'=>'U3D公开课—人物技能释放'],
            ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545183.mp4','name'=>'Swift公开课'],
          ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545182.mp4','name'=>'Cocos公开课—三消游戏'],
          ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545181.mp4','name'=>'Cocos公开课—跑酷游戏'],
          ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545179.mp4','name'=>'Android公开课—计算器项目'],
          ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545178.mp4','name'=>'Android公开课—分享组件'],
          ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545177.mp4','name'=>'WEB公开课—Html5前景介绍'],
          ['url'=>'http://cloud.video.taobao.com/play/u/529822091/p/1/e/6/t/1/31545176.mp4','name'=>'游戏策划公开课'],
        ];
        $ckey = $this->get_today_video_status_key($userdata);
        $is_get = $this->cache()->get($ckey);
        if (isset($videos[$conter]) && !$is_get) {
            $tommoday = strtotime(date('Y-m-d 00:00:00',time()+86400));
            $this->cache()->save($ckey,$tommoday-time());
            ModelFactory::Pricelist()->create([
                'user_id'=>$userdata['id'],
                'type'=>2,
                'created_at'=>time(),
                'name'=>$userdata['nickname'],
                'price'=>$videos[$conter]['name'],
            ]);
            echo json_encode(['result'=>true,'video'=>$videos[$conter]]);
        }else{
            echo json_encode(['result'=>false]);
        }
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
        if (!$userdata) {
            echo json_encode(['result'=>false]);
            return ;
        }
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
    protected function get_today_video_status_key($user){
        return 'video_'.date('Y-m-d').$user['id'];
    }
	public function week()
	{

        $userdata = ModelFactory::User()->check_login();
        $id = $userdata['id'];
        $price_list = $this->cache()->get('price_list');
        if (!$price_list) {
            $price_list = ModelFactory::Pricelist()->get_list([]);
            if ($price_list) {
                $this->cache()->save('price_list',$price_list,600);
            }else{
                $this->cache()->save('price_list',[],5);
            }
        }
        $silver_get = 0;
        if ($id) {
            $silver_get = $this->getUserTask($userdata,CONSTFILE::USER_TASK_HUODONG_SILVER_CION);
            $ckey = $this->get_today_video_status_key($userdata);
            $is_get_today_video = $this->cache()->get($ckey);
            $userdata['is_get_today_video'] = $is_get_today_video;
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

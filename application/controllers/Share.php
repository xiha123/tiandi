<?php

class Share extends CI_Controller {
    public $userdata ;
	public function __construct() {
		parent::__construct();
        $this->userdata = ModelFactory::User()->check_login();

    }
    public function index(){
        $userdata = ModelFactory::User()->check_login();

        $type = $this->input->get('type');
        $from = $this->input->get('from');

        $pid = $this->input->get('pid');
        if ($pid) {
            $problem = ModelFactory::Problem()->get_by_id($pid);
            $problem['url'] = site_url('/problem/?p='.$problem['id']);

        }elseif($from=='invite'){
            $problem['title'] = '来秒答答题，赢任性壕礼！';
            $problem['summary'] = '在秒答快乐分享，授人以渔，还能获得缤纷大礼！';
            $problem['desc'] = '你还没来秒答答题赢大奖？全新秒答，任性壕礼！回答问题获得威望点，集齐一定威望点就可以召唤神龙！哦，不对，就可以兑换机械键盘、kindle、魔声耳机、ipad mini 4！';
            $problem['pics'] = base_url('/static/image/share_image.jpg');
            $problem['url'] = base_url('/share/people?'.http_build_query([
                    'trace'=>base64_encode($userdata['id']),
                    'from_invite'=>1
                ]));
        }elseif($from=='xiaobai'){
            $problem['title'] = '编程有难题，秒答来帮你！';
            $problem['summary'] = '外事不决问谷歌，内事不懂问度娘，编程不会就来问秒小答吧！庆祝秒答内测第一个月，注册即送编程大神一对一答疑';
            $problem['desc'] = '外事不决问谷歌，内事不懂问度娘，编程不会就来问秒小答吧！庆祝秒答内测第一个月，注册即送编程大神一对一答疑机会，超有趣超好玩的游戏编程APP开发教程。还有抽iPhone 6s！你不来组成分母？
微博分享标题：外事不决问谷歌，内事不懂问度娘，编程不会就来问秒小答吧！庆祝秒答内测第一个月，注册即送编程大神一对一答疑机会，超有趣超好玩的游戏编程APP开发教程。还有抽iPhone 6s！你不来组成分母？';
            $problem['pics'] = base_url('/static/image/share_image.jpg');
            $problem['url'] = base_url('/share/people?'.http_build_query([
                    'trace'=>base64_encode($userdata['id']),
                    'from_invite'=>1
                ]));
        }
        $task_id = 0;
        switch ($type) {
            case 'qq':
                $url = $this->get_qq_url($problem);
                $task_id = CONSTFILE::USER_TASK_SHARE_QQ;
                break;
            case 'qqz':
                $url = $this->get_qqz_url($problem);
                $task_id = CONSTFILE::USER_TASK_SHARE_QQZ;

                break;
            case 'sina':
                $url = $this->get_sina_url($problem);
                $task_id = CONSTFILE::USER_TASK_SHARE_SINA;
                break;
            default:
                show_404();
        }
        if ($pid) {
            $do_taask = ModelFactory::Usertask()->get(['user_id'=>$userdata['id'],'task_id'=>$task_id]);
            if (!$do_taask) {
                ModelFactory::Usertask()->replace($do_taask?$do_taask['id']:0,['user_id'=>$userdata['id'],'task_id'=>$task_id,'created_at'=>time()]);
                ModelFactory::User()->Integral($userdata['id'],100,true,'Integral',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_USER_SHARE);
                ModelFactory::User()->coin($userdata['id'],80,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_USER_SHARE);
            }
        }
        redirect($url);
    }
    public function get_qq_url($problem){
            $share_param =
                array (
                    'p' => '27',
                    'desc' => ' 有意思的问题',
                    'title' => '',
                    'summary' => '',
                    'pics' => '',
                    'flash' => '',
                    'site' => '',
                    'style' => '102',
                    'width' => '63',
                    'height' => '24',
                    'showcount' => '',
                    'url'=>'',
                );
        $problem = array_intersect_key($problem,$share_param);

        $share_param = array_merge($share_param,$problem);

        return 'http://connect.qq.com/widget/shareqq/index.html?'.http_build_query($share_param);
    }
    public function get_qqz_url($problem){
        $share_param = array (
            'url' => 'http://tiandipeixun.com/problem/?p=339',
            'showcount' => '0',
            'desc' => '有意思的问题',
            'summary' => '有意思的问题',
            'title' => '新技能 GET',
            'site' => '',
            'pics' => '',
            'style' => '102',
            'width' => '63',
            'height' => '24',
            'otype' => 'share',
        );
        $problem = array_intersect_key($problem,$share_param);
        $share_param = array_merge($share_param,$problem);
        return 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?'.http_build_query($share_param);
    }
    public function get_sina_url($problem){

        $share_param = array (
            'url' => 'http://tiandipeixun.com/problem/?p=339',
            'type' => 'button',
            'language' => 'zh_cn',
            'appkey' => '1313382710',
            'searchPic' => 'false',
            'style' => 'number',
            'pic' => '',
            'title' => '',
        );
        $share_param['title'] = $problem['title'];
        $share_param['pic'] = $problem['pics'];

        $problem = array_intersect_key($problem,$share_param);
        $share_param = array_merge($share_param,$problem);
        return  'http://service.weibo.com/share/share.php?'.http_build_query($share_param);

    }
    public function people(){
        $id = $this->input->get('trace');
        $this->load->helper("cookie");
        set_cookie('parent_id',base64_decode($id),86400*30);
//        exit;
        redirect('/miaoda?'.http_build_query([
                'from_invite'=>1
            ]));
    }


    public function invite(){
        $userdata = ModelFactory::User()->check_login();

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
        $this->parser->parse("share/invite.php"  ,$userdata);

    }

}

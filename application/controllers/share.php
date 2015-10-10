<?php

class Share extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
    public function index(){
        $userdata = ModelFactory::User()->check_login();

        $type = $this->input->get('type');
        $pid = $this->input->get('pid');
        $problem = ModelFactory::Problem()->get_by_id($pid);
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
        $do_taask = ModelFactory::Usertask()->get(['user_id'=>$userdata['id'],'task_id'=>$task_id]);
        if (!$do_taask) {
            ModelFactory::Usertask()->replace($do_taask?$do_taask['id']:0,['user_id'=>$userdata['id'],'task_id'=>$task_id,'created_at'=>time()]);
            ModelFactory::User()->Integral($userdata['id'],100,true,'Integral',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_USER_SHARE);
            ModelFactory::User()->coin($userdata['id'],80,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_CLICK_USER_SHARE);
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
        $share_param['title'] = $problem['title'];
        $share_param['url'] = site_url('/problem/?p='.$problem['id']);

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
        $share_param['title'] = $problem['title'];
        $share_param['url'] = site_url('/problem/?p='.$problem['id']);

        return 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?'.http_build_query($share_param);
    }
    public function get_sina_url($problem){

        $share_param = array (
            'url' => 'http://tiandipeixun.com/problem/?p=339',
            'type' => 'button',
            'language' => 'zh_cn',
            'appkey' => '1313382710',
//            'searchPic' => 'true',
            'style' => 'number',
            'pic' => '',
            'title' => '',
        );
        $share_param['title'] = $problem['title'];
        $share_param['url'] = site_url('/problem/?p='.$problem['id']);
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
        $this->parser->parse("share/invite.php"  , [
            'invate_url' => base_url('/share/people?'.http_build_query([
                    'trace'=>base64_encode($id)
                ]))
        ]);

    }
}

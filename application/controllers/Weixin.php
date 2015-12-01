<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weixin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**

     */
    public function cb() {
        $AppID = 'wx1b5b6b342864bad6';
        $AppSecret = 'd4624c36b6795d1d99dcf0547af5443d';
        $stat = $_SESSION['stat_id'];
        $code = isset($_GET['code'])?$_GET['code']:'';
        $state = isset($_GET['state'])?$_GET['state']:'';
        $token = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$AppID."&secret=".$AppSecret."&code=".$code."&grant_type=authorization_code";
        $dd = file_get_contents($token);
        $tokeninfo = json_decode($dd,1);
        if (isset($tokeninfo['access_token'])) {
            $userinfourl = "https://api.weixin.qq.com/sns/userinfo?access_token=".$tokeninfo['access_token']."&openid=".$tokeninfo['openid'];
            $userinfostr = file_get_contents($userinfourl);
            $userinfo = json_decode($userinfostr,1);

            /*
             {
                openid: "oqxzrssbmhrcqYWFdS2bwN3epmQk",
                nickname: "xx",
                sex: 1,
                language: "zh_CN",
                city: "Hangzhou",
                province: "Zhejiang",
                country: "CN",
                headimgurl: "http://wx.qlogo.cn/mmopen/5ddthnKky8ocY4GQIric9qTCntaNoyvNeGf9n8W0iaHtK2z07zdicRL9XTibY7U55WW8K5hwUkKZa5c1kX3OzBLqhL6U0R9sRXY6/0",
                privilege: [ ],
                unionid: "oQrBswSYRdpUk61PIRZgtlycNXqY"
             }
             */
            $first = 'no';
            if (isset($userinfo['openid'])) {
                $this->load->helper('cookie');
                $parent_id = get_cookie('parent_id');
                $parent_id = $parent_id ? $parent_id:0;
                $key = 'weixin:' . $userinfo['openid'];
                $user = ModelFactory::User()->get_by_oauth($key);
                $first = 'no';
                if (!$user) {
                    $params1 = array('nickname' => $userinfo['nickname']);
                    $true = ModelFactory::User()->is_exist($params1);
                    if ($true) {
                        $userinfo['nickname'] =  $userinfo['nickname'].mt_rand(400000,900000);
                    }

                    $params = [
                        'email' =>$userinfo['openid'] . '@91miaoda.com',
                        'oauth_key' => $key,
                        'nickname' => $userinfo['nickname'],
                        'pwd' => $userinfo['openid'],
                        'avatar' => $userinfo['headimgurl'],
                        'parent_id' => $parent_id,
                    ];

                    $params['nickname'] = $userinfo['nickname'];

                    $true = ModelFactory::User()->create($params);
                    if ($true === true) {
                        $first = 'yes';
                        $user = ModelFactory::User()->get_by_oauth($key);
                    }else{
                        echo "<script>alert('{$true}!!')</script>";exit;
                    }

                }
                ModelFactory::User()->login_by_oauth($user['id']);

            }
            if ($first == 'yes') {
                echo "<script>window.opener.openprofile();window.close();</script>";
                exit;
            }else{
                echo "<script>window.opener.location.reload();window.close();</script>";
                exit;

            }
        }
        echo "<script>alert('授权失败!')</script>";
        exit;

    }
    public function login() {
        $AppID = 'wx1b5b6b342864bad6';
        $AppSecret = 'd4624c36b6795d1d99dcf0547af5443d';
        $red = urlencode(site_url('/weixin/cb'));
        $stat = $_SESSION['stat_id'] = uniqid();
        header('location: '."https://open.weixin.qq.com/connect/qrconnect?appid=".$AppID."&redirect_uri=".$red."&response_type=code&scope=snsapi_login,snsapi_userinfo&state=".$stat."#wechat_redirect");
    }
    public function debug(){
         $dd = '{"openid":"oqxzrssbmhrcqYWFdS2bwN3epmQk","nickname":"星火","sex":1,"language":"zh_CN","city":"Hangzhou","province":"Zhejiang","country":"CN","headimgurl":"123","privilege":[],"unionid":"oQrBswSYRdpUk61PIRZgtlycNXqY"}';
        $userinfo =  json_decode($dd,1);
        if (isset($userinfo['openid'])) {
            $this->load->helper('cookie');
            $parent_id = get_cookie('parent_id');
            $parent_id = $parent_id ? $parent_id:0;
            $key = 'weixin:' . $userinfo['openid'];
            $user = ModelFactory::User()->get_by_oauth($key);
            $first = 'yes';
            if (!$user) {
                $params = [
                    'email' => $userinfo['openid'],
                    'oauth_key' => $key,
                    'nickname' => $userinfo['nickname'],
                    'pwd' => $userinfo['openid'],
                    'avatar' => $userinfo['headimgurl'],
                    'parent_id' => $parent_id,
                ];

                $true = ModelFactory::User()->create($params);

                if ($true == "该邮箱已被使用") {
                    $params['nickname'] =  $userinfo['nickname'].mt_rand(40000,90000);
                    $params['email'] =  $userinfo['nickname'].mt_rand(40000,90000);

                    $true = ModelFactory::User()->create($params);
                }
                if ($true == "'该邮箱已被使用'") {
                    $params['nickname'] =  $userinfo['nickname'].mt_rand(40000,90000);
                    $params['email'] =  $userinfo['nickname'].mt_rand(40000,90000);

                    $true = ModelFactory::User()->create($params);

                }
                if ($true) {
                    $first = 'yes';
                    $user = $params;

                    $user['id'] = $true;
                }


            }
            ModelFactory::User()->login_by_oauth($user['id']);

        }
        if ($first == 'yes') {
            echo "<script>window.opener.openprofile();window.close();</script>";
            exit;
        }else{
            echo "<script>window.opener.location.reload();window.close();</script>";
            exit;

        }
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class Sign_api extends Base_api {
    public function __construct() {
		parent::__construct();
        $this->me = ModelFactory::User()->check_login();
    }

    public function sign() {
        parent::require_login();

        $id = $this->me['id'];
        $userdata = ModelFactory::User()->get_user($id);
        $sign =  ModelFactory::User()->is_sign($id,$userdata);
        if ($sign) {
            parent::finish(false,"今日已签到!");
        }
        $keep =  ModelFactory::User()->is_keep_sign($id,$userdata);


        try {
            ModelFactory::User()->begin();
            $result =  ModelFactory::User()->sign($id,date('Y-m-d'),$keep+1);
            if ($keep) {
                    $update_integral_result = ModelFactory::User()->Integral($id,20*($keep+1),true);
                    $silver_coin = 10 + $keep*5;
                    if ($silver_coin > 50) {
                        $silver_coin = 50;
                    }
                    $update_coin_result = ModelFactory::User()->coin($id,$silver_coin,true,'silver_coin');

            }else{
                $update_integral_result =   ModelFactory::User()->Integral($id,20,true);
                $update_coin_result =   ModelFactory::User()->coin($id,10,true,'silver_coin');
            }
            if ($result && $update_coin_result && $update_integral_result) {
                ModelFactory::User()->commit();
                parent::finish(true,'签到成功!');

            }else{
                ModelFactory::User()->rollback();
                parent::finish(false,"签到失败!");

            }
        } catch (Exception $e) {
            ModelFactory::User()->rollback();
            parent::finish(false,"数据库异常");
        }

    }
}

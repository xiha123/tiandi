<?php

class Test extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("tag_model");
		$this->load->model("problem_model");
	}
    public function index(){


        $date=date('Y-m-d');  //当前日期

        $first=1; //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期

        $w=date('w',strtotime($date));  //获取当前周的第几天 周日是 0 周一到周六是 1 - 6

        $now_start=date('Y-m-d',strtotime("$date -".($w ? $w - $first : 6).' days')); //获取本周开始日期，如果$w是0，则表示周日，减去 6 天

        $now_end=date('Y-m-d',strtotime("$now_start +6 days"));  //本周结束日期

        $last_start=date('Y-m-d',strtotime("$now_start - 7 days"));  //上周开始日期

        $last_end=date('Y-m-d',strtotime("$now_start - 1 days"));  //上周结束日期

        echo '本周开始日期：',$now_start,'<br />';
        echo '本周结束日期：',$now_end,'<br />';
        echo '上周开始日期：',$last_start,'<br />';
        echo '上周结束日期：',$last_end,'<br />';


        $peoples = ModelFactory::Changelog()->groupBy([
            'type'=>CONSTFILE::USER_INTEGRAL,
//            'created_at >='=>strtotime("$now_start - 7 days"),
//            'created_at <='=>strtotime("$now_start - 1 days"),
        ],20);
        if ($peoples) {
            foreach ($peoples as $key => $people) {
                $key = $key+1;
                if ($key == 1) {
                    ModelFactory::User()->coin($people['user_id'],200,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_INTEGRAL_TOP);
                }
                if ($key >= 2 && $key <= 5) {
                    ModelFactory::User()->coin($people['user_id'],100,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_INTEGRAL_TOP);
                }
                if ($key >= 6 && $key <= 20) {
                    ModelFactory::User()->coin($people['user_id'],50,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_INTEGRAL_TOP);
                }
            }
        } $date=date('Y-m-d');  //当前日期

        $first=1; //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期

        $w=date('w',strtotime($date));  //获取当前周的第几天 周日是 0 周一到周六是 1 - 6

        $now_start=date('Y-m-d',strtotime("$date -".($w ? $w - $first : 6).' days')); //获取本周开始日期，如果$w是0，则表示周日，减去 6 天

        $now_end=date('Y-m-d',strtotime("$now_start +6 days"));  //本周结束日期

        $last_start=date('Y-m-d',strtotime("$now_start - 7 days"));  //上周开始日期

        $last_end=date('Y-m-d',strtotime("$now_start - 1 days"));  //上周结束日期

        echo '本周开始日期：',$now_start,'<br />';
        echo '本周结束日期：',$now_end,'<br />';
        echo '上周开始日期：',$last_start,'<br />';
        echo '上周结束日期：',$last_end,'<br />';


        $peoples = ModelFactory::Changelog()->groupBy([
            'type'=>CONSTFILE::USER_INTEGRAL,
//            'created_at >='=>strtotime("$now_start - 7 days"),
//            'created_at <='=>strtotime("$now_start - 1 days"),
        ],20);
        if ($peoples) {
            foreach ($peoples as $key => $people) {
                $key = $key+1;
                if ($key == 1) {
                    ModelFactory::User()->coin($people['user_id'],200,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_INTEGRAL_TOP);
                }
                if ($key >= 2 && $key <= 5) {
                    ModelFactory::User()->coin($people['user_id'],100,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_INTEGRAL_TOP);
                }
                if ($key >= 6 && $key <= 20) {
                    ModelFactory::User()->coin($people['user_id'],50,true,'silver_coin',CONSTFILE::CHANGE_LOG_COUNT_TYPE_INTEGRAL_TOP);
                }
            }
        }
        $is_keep = ModelFactory::Usertask()->is_keep_answer($id);
        ModelFactory::Usertask()->answer_sign($id,date('Y-m-d'),$is_keep+1);exit;
        $sign =  ModelFactory::User()->coin($id,3000,true,'silver_coin');
        var_dump($sign);exit;

//        $sign =  ModelFactory::User()->is_sigin($id,['date'=>'2015-08-17','time'=>1]);
        $userdata = ModelFactory::User()->get_user($id);
        $sign =  ModelFactory::User()->is_sigin($id,$userdata);
        $keep =  ModelFactory::User()->is_keep_sign($id,$userdata);

        if ($keep) {
            ModelFactory::User()->sigin($id,date('Y-m-d'),$keep+1);
            echo "lx\n";exit;
        }else{
            ModelFactory::User()->sigin($id,date('Y-m-d'),1);
            echo "pm\n";
        }
        var_dump($sign);
    }

}

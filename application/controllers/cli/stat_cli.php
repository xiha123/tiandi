<?php
/**
 * Created by IntelliJ IDEA.
 * User: XingHuo
 * Date: 15/10/2
 * Time: 上午11:30
 */
//php index.php cli/stat_cli/week_integral_rank

class Stat_cli  extends CI_Controller  {
    function week_integral_rank(){
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
            'created_at >='=>strtotime("$now_start - 7 days"),
            'created_at <='=>strtotime("$now_start - 1 days"),
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
    }
}
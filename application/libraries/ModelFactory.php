<?php
/**
 * Created by IntelliJ IDEA.
 * User: XingHuo
 * Date: 15/10/1
 * Time: 上午8:02
 */

class ModelFactory {
    static $models=[];
    /**
     * @return User_model
     */
        static  function User(){
            return  self::load('User_model');
        }
    /**
     * @return Changelog_model
     */
        static  function Changelog(){
            return  self::load('Changelog_model');
        }
    /**
     * @return Usertask_model
     */
        static  function Usertask(){
            return  self::load('Usertask_model');
        }
    /**
     * @return Pricelist_model
     */
        static  function Pricelist(){
            return  self::load('Pricelist_model');
        }
    /**
     * @return Invitehistory_model
     */
        static  function Invitehistory(){
            return  self::load('Invitehistory_model');
        }

    /**
     * @return problem_model
     */
        static  function Problem(){
            return  self::load('problem_model');
        }
        static function load($model){
            if (!isset(self::$models[$model])) {
                CI_Controller::get_instance()->load->model($model);
                self::$models[$model] = CI_Controller::get_instance()->$model;
            }
            return self::$models[$model];
        }
}
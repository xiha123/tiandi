<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * base_api
 * 提供基本的检测和数据获取，返回的数据为JSON格式
 */
class base_api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // 非ajax请求拒绝
        if (!$this->input->is_ajax_request()) $this->finish(false, '非法请求');
    }


    // 统一json处理
    public function add_json($json,$data,$type = true){
        $json = $type ? json_decode($json) : $json;
        array_push($json, $data);
        return json_encode($json);
    }
    public function remove_json($json,$input,$type = true){
        $temp=array();
        $json = $type ? json_decode($json) : $json;
        foreach ($json as $key => $value) {
            if($value->t != $input){
                array_push($temp, array("t"=>$value->t));
            }
        }
        return json_encode($temp);
    }
    public function edit_json($json,$name,$content,$type = true){
        $temp=array();
        $json = $type ? json_decode($json) : $json;
        foreach ($json as $key => $value) {
            if($value->t != $name){
                array_push($temp, array("t"=>$value->t , "value" =>$value->value));
            }
        }
        array_push($temp, array("t"=>$name , "value" =>$content));
        return json_encode($temp);
    }


    /**
     * @method finish
     * @description 输出JSON数据
     * @param {Boolen} status 结果的状态
     * @param {Array} data 成功时返回的数据
     * @param {String} error 失败时的错误信息
     */
    public function finish($status = false, $error = '', $data = '') {
        exit(json_encode(array(
            'status' => $status,
            'data' => $data,
            'error' => $error
        )));
    }

 /**
 * 邮件的正则表达式  @author：lijianghai
 */
    function  isEmail($email = null){ 
        $preg = preg_match("/w+([-+.']w+)*@w+.w+([-.]w+)*/",trim($email));
        if(!$preg){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @method get_params
     * @description 获取参数
     * @param {String} method 获取参数的方法 GET | POST, default = 'GET'
     * @param {Array} keys 要获取的参数名字，true 表示不能为空，false 则可以为空，默认为 true
     */


    public function get_params($method = 'GET', $keys) {
        if (strtoupper($method) === 'GET') {
            $params = $this->input->get(NULL, true);
        } else {
            $params = $this->input->post(NULL, true);
        }

        foreach ($keys as $key => $val) {
            if (is_numeric($key)) {
                if (!isset($params[$val]) || empty($params[$val])) $this->finish(false, '数据不能为空');
                $result[$val] = $params[$val];
            } else {
                if (!isset($params[$key]) || empty($params[$key])) $this->finish(false, '数据不能为空');
                $result[$key] = $params[$key];
            }
        }

        return $result;
    }

    public function require_login() {
        if ($this->me === false) {
            $this->finish(false, '您还没有登录，请登录以后再进行操作。');
            exit;
        }
    }

}

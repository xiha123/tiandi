<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * base_api
 * 提供基本的检测和数据获取，返回的数据为JSON格式
 * 再加需求就活剥了你们 - 来自程序员们的怨念
 */
class base_api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // 非ajax请求拒绝
        if (!$this->input->is_ajax_request()) $this->finish(false, '非法请求');
    }

    // 处理用户提交的内容
    public function HTML($content){
        include_once(APPPATH . 'controllers/api/base_class_html.php');
        $HTML = new HtmlAttributeFilter();
        $HTML->setAllow(array('title', 'alt', "src", 'style'));
        $content = $HTML->strip($content);
        return strip_tags($content, "<span><em><i><strike><u><b><strong><p><li><ul><img><br>");
    }


    // 统一json处理
    public function add_json($json,$data,$type = true){
        $json = $type ? json_decode($json) : $json;
        $json = count($json) <= 0 ? array() : $json;
        array_push($json, $data);
        return json_encode($json);
    }
    public function remove_json_v($json,$content,$type = true){
        $temp=array();
        $json = $type ? json_decode($json) : $json;
        foreach ($json as $key => $value) {
            if($value[0] != $content){
                array_push($temp, $value);
            }
        }
        return json_encode($temp);
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
     * [is 用来检测用户传递过来的数据是否超出长度限制]
     * @param  [type]  $array [description]
     * @return boolean        [description]
     */
    public function is_length($array , $type = false){
        if($type == false){
            foreach ($array as $key => $value) {
                $value_length = strlen(trim($value['value']));
                if(isset($value['max']) && $value_length > $value['max']){
                    $this->finish(false, '您输入的'.$value['name'].'太长了，请检查后重新输入');
                }
                if(isset($value['min']) && $value_length < $value['min']){
                    $this->finish(false, '您输入的'.$value['name'].'太短了，请检查后重新输入');
                }
            }
        }else{

        }
        return true;
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
                if (!isset($params[$val])) $this->finish(false, '数据不能为空');// || empty($params[$val])
                $result[$val] = $params[$val];
            } else {
                if (!isset($params[$key]) || empty($params[$key])) $this->finish(false, '数据不能为空');
                $result[$key] = $params[$key];
            }
        }

        return $result;
    }

    public function require_login() {
        if ($this->me === false || !isset($this->me['id'])) {
            $this->finish(false, '您还没有登录，请登录以后再进行操作。');
        }
    }

}

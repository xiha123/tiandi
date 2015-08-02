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
        $this->load->model('user_model');
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
        foreach ($keys as $key) {
            if (!isset($params[$key]) || empty($params[$key])) {
                $this->finish(false, '数据不能为空');
                return false;
            }
           $result[$key] = $params[$key];
         }
        return $result;
    }

    public function check_login() {
	$me = $this->user_model->check_login();
        if ($me === false) {
            $this->finish(false, '用户未登录');
        }
        return $me;
    }

}

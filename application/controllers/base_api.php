<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * base_api
 * 提供基本的检测和数据获取，返回的数据为JSON格式
 */
class base_api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // 非ajax请求拒绝
        if(!$this->input->is_ajax_request()) $this->finish(false, '非法请求');
    }

    /**
     * @method finish
     * @description 输出JSON数据
     * @param {Boolen} status 结果的状态
     * @param {Array} data 成功时返回的数据
     * @param {String} error 失败时的错误信息
     */
    public function finish($status = false, $error = '', $data = '') {
        echo json_encode(array(
            'status' => $status,
            'data' => $data,
            'error' => $error
        ));
    }

    /**
     * @method getParams
     * @description 获取参数
     * @param {String} method 获取参数的方法 GET | POST, default = 'GET'
     * @param {Array} keys 要获取的参数名字
     */
    public function getParams($method = 'GET', $keys) {
        if (strtoupper($method) === 'GET') {
            $params = $this->input->get(NULL, true);
        } else {
            $params = $this->input->post(NULL, true);
        }

        foreach ($keys as $key) {
            if (!isset($params[$key])) {
                $this->finish(false, '参数不完整');
                return false;
            }
            $result[$key] = $params[$key];
        }

        return $result;
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class News_api extends base_api {

    public function __construct() {
		parent::__construct();
		$this->load->model('news_model');
		$this->load->model('user_model');
		$this->me = $this->user_model->check_login();
    }

    public function remove(){
    	 parent::require_login();
         $params = $this->get_params('POST', array('removeData' => true));
         extract($params);

    	 $data = json_decode($removeData);
    	 if(count($data) <= 0){$this->finish(false , "没有提交要删除的通知");}
    	 foreach ($data as $key => $value) {
             $this->news_model->remove($value->id);
    	 }
       	$this->finish(true);
    }

    public function get_news() {
    	 parent::require_login();
         parent::finish(true, "", $this->db->query('select type from news where target = ' . $this->me['id'] . ' AND ctime >= DATE_SUB(NOW(), INTERVAL 30 SECOND)')->result_array());
    }
}

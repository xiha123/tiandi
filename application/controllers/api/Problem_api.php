<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'controllers/api/Base_api.php');

class problem_api extends base_api {

    public function __construct() {
	parent::__construct();
            $this->table_name="problem_detail";
    	$this->load->model('problem_model');
            $this->load->model('problem_detail_model');
         $this->load->model('problem_comment_model');
        $this->load->model('tag_model');
    	$this->load->model('news_model');

    	$this->me = $this->user_model->check_login();
    }

    public function create() {
        parent::require_login();
        $params = $this->get_params('POST', array(
            'title' => true,
            'detail' => true,
            'tags' => false,
        ));
        extract($params);
       $code = isset($_POST['code']) ? $this->input->post("code") : "";
        if(!isset($this->me['id'])){
               $this->finish(false, '您还没有登陆！');
        }
        if ($this->problem_model->is_exist(array('title' => $title))) {
            $this->finish(false, '重复的标题');
        }
        $tag_return = $this->tag_model->add_tag_json($tags);
        switch ($tag_return) {
            case -1:
               $this->finish(false, '标签格式填写错误！');
                break;
            case -2:
               $this->finish(false, '您输入的标签太长或者太短了！');
                break;
            default:
                # code...
                break;
        }

           $detail_id = $this->problem_model->create(array(
            'owner_id' => $this->me['id'],
            'title' => $title,
            'tags' => $tags,
           // 'details' => json_encode($detail_id)
        ));
           $this->load->helper('security');
       $this->problem_detail_model->create(array(
            'owner_id' => $this->me['id'],
            'type' => 0,
            'content' =>xss_clean( $detail ),
            'code' => $code,
            'problem_id' => $detail_id
        ));

        $this->finish(true);
    }

    public function create_comment() {
        parent::require_login(); $params = $this->get_params('POST', array('content', 'problem_id'));extract($params);
        if (!$this->problem_model->is_exist(array(
            'id' => $problem_id
        ))) {
            $this->finish(false, '不存在的问题');
        }
        $new_comment_id = $this->problem_comment_model->add_comment($this->me['id'],$problem_id,$content);
        $problem = $this->problem_model->get(array(
            'id' => $problem_id
        ));
        $comments = json_decode($problem['comments']);
        $comments[] = $new_comment_id;
        $this->problem_model->edit($problem_id, array(
            'comments' => json_encode($comments)
        ));

        $this->finish(true);
    }

    public function create_detail() {
        parent::require_login();
        $params = $this->get_params('POST', array(
            'content' => true,
            'type' => true,
            'problem_id' => true,
        )); extract($params);
        $code = $this->input->post("code");
        if(!$this->problem_model->is_exist(array( 'id' => $problem_id)))$this->finish(false, '不存在的问题');

        $problem = $this->problem_model->get(array( 'id' => $problem_id));
        if($type == 1 && $problem["answer_time"] + 1200 < time()){
            $this->problem_model->def($problem_id);
            $this->finish(false, '问题已经过期，无法回答！');
        }
        if ($this->me['id'] !== $problem['answer_id'] && $this->me['type'] !== 1) {
            $this->finish(false, '没有权限');
        }
        $new_detail_id = $this->problem_detail_model->create(array(
            'owner_id' => $this->me['id'],
            'content' => $content,
            'problem_id' => $problem_id,
            'code' => $code,
            'type' => $type
        ));

        $details = json_decode($problem['details']);
        $details[] = $new_detail_id;
        $this->problem_model->done($problem_id);
        if($type == 1){
            $this->news_model->add_news($problem['owner_id'],"大神：" . $this->me['nickname'] . " 回答了您的问题，".$problem['title']."，快去看看吧！" );
        }

        $this->finish(true);
    }

    public function request_problem() {
        parent::require_login();$params = $this->get_params('POST', array('problem_id'));extract($params);
        if ($this->me['type'] != 1) {
            $this->finish(false, '没有权限');
        }

        $problem = $this->problem_model->get(array(
            'id' => $problem_id
        ));
        if($problem["owner_id"] == $this->me['id']){
            $this->finish(false, '你不能认领自己发布的问题！');
        }
        if ($this->problem_model->request(array(
            'pid' => $problem_id,
            'uid' => $this->me['id']
        )) === false) {
            $this->finish(false, '您现在不能认领该问题，这个问题已经被人认领了，或者已经完成了回答！');
        }
        $this->finish(true);
    }

    public function close_problem() {
        parent::require_login();$params = $this->get_params('POST', array('problem_id' , 'type'));extract($params);
        $problem = $this->problem_model->get(array('id' => $problem_id));
        if($problem['owner_id'] !== $this->me['id']){$this->finish(false, '您没有权利关闭这个问题！');}
        if($type == "false"){
            $this->problem_model->no($problem_id);
            $this->finish(true);
        }
        if ($this->problem_model->close(array(
            'pid' => $problem_id
        )) === false) {
            $this->finish(false, '问题不能关闭');
        }

        $this->finish(true);
    }

    public function follow_problem() {
        parent::require_login();$params = $this->get_params('POST', array('problem_id'));extract($params);

        // 通知消息给用户
        $problem_data = $this->problem_model->get_list_by_id($problem_id);
        $this->news_model->add_news($problem_data['owner_id'] , $this->me['nickname'] . " 关注了您的问题：".$problem_data['title'] , $this->me['id']);

        if($this->user_model->is_problem($problem_id , "follow_problems") == true)parent::finish(false , "您已经关注了该问题，请点击取消关注按钮");
        if(!$this->problem_model->follow($problem_id))parent::finish(false , "失败！无法预料到的意外错误，请您稍后再试！");
        if(!$this->user_model->follow_problem($problem_id)){
            parent::finish(false , "失败！无法预料到的意外错误，请您稍后再试！2");
        }else{
            parent::finish(true);
        }
    }
    public function unfollow_problem() {
        parent::require_login();$params = $this->get_params('POST', array('problem_id'));extract($params);

        // 通知消息给用户
        $problem_data = $this->problem_model->get_list_by_id($problem_id);
        $this->news_model->add_news($problem_data['owner_id'] , $this->me['nickname'] . " 取消关注了您的问题：".$problem_data['title'] , $this->me['id']);

        if($this->user_model->is_problem($problem_id , "follow_problems") == false)parent::finish(false , "您还没有关注该问题，不能取消关注！");
        if(!$this->problem_model->unfollow($problem_id))parent::finish(false , "失败！无法预料到的意外错误，请您稍后再试！");
        if(!$this->user_model->unfollow_problem($problem_id)){
            parent::finish(false , "失败！无法预料到的意外错误，请您稍后再试！2");
        }else{
            parent::finish(true);
        }

    }

    public function collect_problem() {
        parent::require_login();$params = $this->get_params('POST', array('problem_id'));extract($params);
        if($this->problem_model->collect($problem_id)){
            parent::finish(true , "");
        }else{
            parent::finish(false , "无法预料到的意外错误，请您稍后再试！");
        }
    }

    public function uncollect_problem() {
        parent::require_login(); $params = $this->get_params('POST', array('problem_id'));extract($params);
        if($this->problem_model->uncollect($problem_id)){
            parent::finish(true , "");
        }else{
            parent::finish(false , "无法预料到的意外错误，请您稍后再试！");
        }


    }



    public function up_problem() {
        $up_down_type = false;
        $temp = array();
        parent::require_login();$params = $this->get_params('POST', array('problem_id'));extract($params);
        $return_data = $this->problem_model->get_problem($problem_id);
        $up_users = json_decode($return_data[0]['up_users']);


        foreach ($up_users as $key => $value) {
            if($value->id != $this->me['id']){
                array_push($temp, array("id"=>$value->id));
            }else{
                $up_down_type = true;
            }
        }
        $up_users = $temp;
        if($up_down_type == true){
            if($this->problem_model->up(array(
                "id" => $problem_id ,
                "up_count" => $return_data[0]["up_count"] - 1 ,
                "hot" =>$return_data[0]["hot"] - 5,
                "up_users" => json_encode($up_users)
            ))){
                $this->finish(true , "","1");
            }else{
                $this->finish(false , "未知的网络原因导致操作失败");
            }
        }else{
            array_push($up_users , array("id"=>$this->me['id']));
            if($this->problem_model->up(array(
                    "id" => $problem_id ,
                    "up_count" => $return_data[0]["up_count"] + 1 ,
                    "hot" =>$return_data[0]["hot"] + 5,
                    "up_users" => json_encode($up_users)
                ))){
                    $this->finish(true , "","0");
                }else{
                    $this->finish(false , "未知的网络原因导致操作失败");
                }
            }
        }







    public function down_problem() {
        parent::require_login();
        $params = $this->get_params('POST', array('problem_id'));
        extract($params);
        if($this->problem_model->down($problem_id)){
            $this->finish(true);
        }else{
            $this->finish(false ,"可以因为某些网络原因导致操作失败，请尝试重试！");
        }
    }

}

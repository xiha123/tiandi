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

    /**
     * [chou 用户众筹]
     * 自己可以众筹自己的问题，每众筹一次获得50积分
     * 没有对每个用户每天众筹多少次做限制
     * @param [1、不存在，2、已经参加国，3、银币不足，4、插入异常会返回扣除的积分]
     */
    public function chou(){
        parent::require_login();$params = $this->get_params('POST', array('problem_id'));extract($params);
        $problem_data = $this->problem_model->get(array("id" => $problem_id));
        if(count($problem_data) <= 0) {
            $this->finish(false, '无法完成您的请求，您要尝试操作的是一个不存在的问题');
        }
        $problem_json = json_decode($problem_data['who']);
        foreach ($problem_json as $key => $value) {
            if($value==$this->me['id']){
                $this->finish(false, '您已经参加过该问题的众筹了。');
            }
        }
        $problem_json[] = $this->me['id'];
        $problem_json = json_encode($problem_json);
        if(false === $this->user_model->coin($this->me['id'] , 50 , false)){
            $this->finish(false, '您的银币不足，无法完成众筹');
        }
        if(false === $this->problem_model->edit($problem_id , array("silver_coin" => $problem_data['silver_coin'] + 50,"who" => $problem_json))){
            $this->user_model->coin($this->me['id'] , 50);
            $this->finish(false, '无法众筹！');
        }else{
            $this->user_model->add_chou($problem_id);
            $this->news_model->add_news($this->me['id'] , "众筹成功，当问题被解答时将会推送给您信息。问题【".$problem_data['title']."】");
            $this->user_model->Integral($this->me['id'] , 50);
            $this->finish(true);
        }
    }

    public function create() {
        parent::require_login();
        $params = $this->get_params('POST', array('coinType','title' => true,'detail' => true,'tags',"language"));extract($params);
        $code = isset($_POST['code']) ? $this->input->post("code") : "";
        switch ($language) {
            case '0':$language = "html";break;
            case '1':$language = "php";break;
            case '2':$language = "c";break;
            case '3':$language = "javascript";break;
            case '4':$language = "java";break;
            default: $language = "php";break;
        }
        if($this->problem_model->is_exist(array('title' => $title))) {
            $this->finish(false, '您的问题已经有人问过了，请不要再次提问咯！');
        }

        // 处理硬币需求
        $coinConfig = $coinType == "true" ? array(
            "name" => "金币",
            "type" =>"gold_coin",
            "value" => 1,
        ) : array(
            "name" => "银币",
            "type" =>"silver_coin",
            "value" => 100,
        );
        if(!$this->user_model->coin($this->me['id'] , $coinConfig['value'] , false , $coinConfig['type'])){
            $this->finish(false, '您的' . $coinConfig['name'] . '不足，所以并不能提问问题！');
        }

        // 积分需求
        $this->user_model->Integral($this->me['id'] , 100);



        // 处理标签请求
        $tagTemp = array();
        $tagArray = json_decode($tags);
        if(!isset($tagArray[0]))parent::finish(false , "您输入的标签不太正确");
        foreach ($tagArray as $key => $value) {
            if(strlen($value) < 2 && strlen($value) > 12){
                parent::finish(false , "您输入的标签太长或者太短了！");
            }else{
                if($this->tag_model->add_tag(htmlspecialchars($value))){
                   $tagTemp[] = array("t" => $value);
                }
            }
        }
        // 创建题主
        $detail_id = $this->problem_model->create(array(
            'owner_id' => $this->me['id'],
            'title' => htmlspecialchars($title),
            'tags' => json_encode($tagTemp),
            $coinConfig['type'] => $coinConfig['value']
        ));
        if($detail_id == false){parent::finish(false , "服务器异常，请尝试重新提交问题！problem");}

        // 首位答主创建
        $this->load->helper('security');
        if(!$this->problem_detail_model->create(array(
            'owner_id' => $this->me['id'],
            'type' => 0,
            'content' =>htmlspecialchars(xss_clean($detail)),
            'code' => htmlspecialchars($code),
            'problem_id' => $detail_id,
            'language' => $language
        ))){
            parent::finish(false , "服务器异常，请尝试重新提交问题！detail");
        }
        $this->finish(true,$detail_id,$detail_id);
    }

    /*
        创建一条评论
        - content
        - problem_id 
    */
    public function create_comment() {
        parent::require_login(); $params = $this->get_params('POST', array('content', 'problem_id'));extract($params);
        if (!$this->problem_model->is_exist(array(
            'id' => $problem_id
        ))) {
            $this->finish(false, '不存在的问题');
        }
        $new_comment_id = $this->problem_comment_model->add_comment($this->me['id'],$problem_id,htmlspecialchars($content));
        $problem = $this->problem_model->get(array(
            'id' => $problem_id
        ));
        $comments = json_decode($problem['comments']);
        $comments[] = $new_comment_id;
        $this->problem_model->edit($problem_id, array(
            'comments' => json_encode($comments)
        ));
        // 评论给用户积分
        $this->user_model->Integral($this->me['id'] , 50);
        $this->user_model->coin($this->me['id'] , 20);

        // 每次评论可获得一个火力值
        $this->problem_model->hot($problem_id , 1 , true);
        $this->finish(true);
    }

    /*创建一个新的回答*/
    public function create_detail() {
        parent::require_login();
        $params = $this->get_params('POST', array(
            'content' => true,
            'type' => true,
            'problem_id' => true,
            'language'
        )); extract($params);
        switch ($language) {
            case '0':$language = "html";break;
            case '1':$language = "php";break;
            case '2':$language = "c";break;
            case '3':$language = "javascript";break;
            case '4':$language = "java";break;
            default: $language = "php";break;
        }
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
            'content' => htmlspecialchars($content),
            'problem_id' => $problem_id,
            'code' => $code,
            'type' => $type,
            'language' => $language
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
        $this->news_model->add_news($problem['owner_id'],"大神：" . $this->me['nickname'] . " 认领了您的问题".$problem['title']."，快去看看吧！" );
        $this->finish(true);
    }

    public function close_problem() {
        parent::require_login();$params = $this->get_params('POST', array('problem_id' , 'type'));extract($params);
        $problem = $this->problem_model->get(array('id' => $problem_id));
        if($problem['owner_id'] !== $this->me['id']){$this->finish(false, '您没有权利关闭这个问题！');}
        if($type == "false"){
            $this->news_model->add_news($problem['answer_id'] , "" . $this->me['nickname'] . " 似乎并不满意您回答的问题：".$problem['title']."，再去帮下他吧" );
            $this->problem_model->no($problem_id);
            $this->finish(true);
        }
        if ($this->problem_model->close(array(
            'pid' => $problem_id
        )) === false) {
            $this->finish(false, '问题不能关闭');
        }
        foreach (json_decode($problem['who']) as $key => $value) {
            $this->news_model->add_news($value , " 您众筹的问题".$problem['title']."已经解决了，快去看看！" );
        }
        $this->news_model->add_news($problem['answer_id'] , "" . $this->me['nickname'] . " 满意了：".$problem['title'] );
        $this->finish(true);
    }

    public function follow_problem() {
        parent::require_login();$params = $this->get_params('POST', array('problem_id'));extract($params);

        // 推送消息给用户
        $problem_data = $this->problem_model->get_list_by_id($problem_id);
        $this->news_model->add_news($problem_data['owner_id'] , $this->me['nickname'] . " 关注了您的问题：".$problem_data['title'] , $this->me['id']);

        if($this->user_model->is_problem($problem_id , "follow_problems") == true)
         parent::finish(false , "您已经关注了该问题，请点击取消关注按钮");

        if(!$this->problem_model->follow($problem_id))
        parent::finish(false , "失败！无法预料到的意外错误，请您稍后再试！");

        if(!$this->user_model->follow_problem($problem_id)){
            parent::finish(false , "失败！无法预料到的意外错误，请您稍后再试！2");
        }else{
            // 每次关注获得火力值
            $this->problem_model->hot($problem_id , 3 , true);
           $this->user_model->Integral($this->me['id'] , 20 );
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
            // 取消关注则减少火力值
            $this->problem_model->hot($problem_id , 3 , false);
           $this->user_model->Integral($this->me['id'] , 20 ,false);
            parent::finish(true);
        }

    }

    public function collect_problem() {
        parent::require_login();$params = $this->get_params('POST', array('problem_id'));extract($params);
        if($this->problem_model->collect($problem_id)){
            // 取消关注则减少火力值
            $this->problem_model->hot($problem_id , 3 , true);
           $this->user_model->Integral($this->me['id'] , 20 ,false);
            parent::finish(true);
        }else{
            parent::finish(false , "无法预料到的意外错误，请您稍后再试！");
        }
    }

    public function uncollect_problem() {
        parent::require_login(); $params = $this->get_params('POST', array('problem_id'));extract($params);
        if($this->problem_model->uncollect($problem_id)){
             // 取消关注则减少火力值
            $this->problem_model->hot($problem_id , 3 , false);
           $this->user_model->Integral($this->me['id'] , 20 );
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
                // 积分需求
                $this->user_model->Integral($this->me['id'] , 20 , false);
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
                    $this->user_model->Integral($this->me['id'] , 20 );
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

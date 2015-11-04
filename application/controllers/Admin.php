<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("guide_model");
		$this->load->model('admin_model' );
		$this->load->model('slide_model');
		$this->load->model('course_model');
		$this->load->model('course_chapter_model');
		$this->load->model('user_model');
		$this->user_info = $this->admin_model->check_login();
	}

	public function updateFromGithub() {
		if($this->admin_model->require_login() === false) redirect('admin/login');

		var_dump(exec('git pull'));
	}

	public function videoAdministrator(){
		if($this->admin_model->require_login() === false) redirect('admin/login');
		$data['me'] = $this->user_info;

		$this->load->helper('file');
		$data['page'] = isset($_GET['page']) ? $this->input->get('page') : 1;

		// Get video max count
		$video_file = get_filenames(dirname(APPPATH)."/video/");
		$data['video_count'] = count($video_file);

		$video_list = array_slice($video_file , ($data['page'] - 1) * 10 , 10);
		$temp_video_list = array();
		foreach ($video_list as &$value) {
			array_push($temp_video_list , array("name" => $value));
		}
		arsort($temp_video_list);
		$data['video_list'] = $temp_video_list;
		$this->parser->parse("admin/videoAdministrator/index" , $data);
	}

	// 创建内部用户
	public function fake_users($start, $end) {
		if ($this->admin_model->require_login() === false) redirect('admin/login');
		if (!isset($start) || !isset($end)) return;
		for ($i = $start; $i < $end; $i++) {
			$this->user_model->create(array(
				"nickname" => $i,
				"email" => $i . '@kingcraft.cc',
				"pwd" => 'miaoda'
			));
		}
	}

	public function make_tag_lowercase() {
		if($this->admin_model->require_login() === false) redirect('admin/login');

		$tags = $this->db->query('select * from tag')->result_array();
		foreach ($tags as &$tag) {
			$tag['name'] = strtolower($tag['name']);
			$this->db->where('id', $tag['id'])->update('tag', $tag);
		}
	}

	public function clean_db_data() {
		if($this->admin_model->require_login() === false) redirect('admin/login');

		// 处理 user
		$users = $this->db->query('select * from user')->result_array();
		foreach ($users as &$user) {
			$is_update = false;

			// 处理收藏的问题
			$problems = json_decode($user['collect_problems']);
			foreach ($problems as $index => $problem) {
				if ($this->db->query('select id from problem where id=?', array( $problem->t ))->num_rows() === 0) {
					unset($problems[$index]);
					$user['collect_problem_count']--;
					$is_update = true;
				}
			}
			$user['collect_problems'] = json_encode($problems);

			// 处理众筹的问题
			$problems = json_decode($user['chou']);
			foreach ($problems as $problem_id) {
				if ($this->db->query('select id from problem where id=?', array( $problem_id ))->num_rows() === 0) {
					unset($problems[$problem_id]);
					$is_update = true;
				}
			}
			$user['chou'] = json_encode($problems);

			// 处理收藏的标签
			$tags = json_decode($user['skilled_tags']);
			foreach ($tags as $index => $tag) {
				if ($this->db->query('select id from tag where id=?', array( $tag->t ))->num_rows() === 0) {
					unset($tags[$index]);
					$is_update = true;
				}
			}
			$user['skilled_tags'] = json_encode($tags);

			// 处理大神擅长的标签
			$tags = json_decode($user['god_skilled_tags']);
			foreach ($tags as $tag_id) {
				if ($this->db->query('select id from tag where id=?', array( $tag_id ))->num_rows() === 0) {
					unset($tags[$tag_id]);
					$is_update = true;
				}
			}
			$user['god_skilled_tags'] = json_encode($tags);

			if ($is_update) {
				$this->db->where('id', $user['id'])->update('user', $user);
			}
		}

		// 处理 course
		$courses = $this->db->query('select * from course')->result_array();
		foreach ($courses as &$course) {
			$is_update = false;

			// 处理 tags
			$tags = json_decode($course['tags']);
			foreach ($tags as $index => $tag) {
				if ($this->db->query('select id from tag where id=?', array( $tag->t ))->num_rows() === 0) {
					unset($tags[$index]);
					$is_update = true;
				}
			}
			$course['tags'] = json_encode($tags);

			if ($is_update) {
				$this->db->where('id', $course['id'])->update('course', $course);
			}
		}
		echo '清理数据库成功';
	}

	public function clean_follow_user() {
		$users = $this->db->query('select * from user')->result_array();
		foreach ($users as $user) {
			$json = json_decode($user['follow_users']);
			$result = array();
			foreach ($json as $index => $data) {
				$data = is_array($data) ? $data[0] : $data;
				if (!in_array($data, $result)) $result[] = $data;
			}
			$this->db->where('id', $user['id'])->update('user', array(
				'follow_users' => json_encode($result),
				'follow_user_count' => count($result),
			));
		}

		echo '更新完成用户 follow 数据';
	}

	public function clean_followers() {
		$users = $this->db->query('select * from user where follower_count < 0')->result_array();
		foreach ($users as $user) {
			$json = json_decode($user['follow_users']);
			$result = array();
			foreach ($json as $index => $data) {
				$result[] = is_array($data) ? $data[0] : $data;
			}
			$this->db->where('id', $user['id'])->update('user', array(
				'follow_users' => json_encode($result),
				'follow_user_count' => count($result),
			));
		}

		echo '更新完成用户 follow 数据';
	}

	public function god_apply(){
		if($this->admin_model->require_login() === false) redirect('admin/login');
		$data['page'] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$data['me'] = $this->user_info;
		$data['user'] = $this->user_model->get_list(array("type" => 2) , ($data['page'] - 1) , 10);
		foreach ($data['user'] as $key => $value) {
			$data['user'][$key]['type'] = $data['user'][$key]['type'] == "2" ? "<font style='color:#c00;'>待审核</font>" : "";
		}
		$data['user_max'] = $this->user_model->get_count(array("type" => 2));
		$this->load->library('parser');
		$this->parser->parse('admin/god_apply.php', $data);
	}

	public function user(){
		if($this->admin_model->require_login() === false) redirect('admin/login');
		$page = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$data['page'] = $page < 1 ? '1' : $page;
		$data['me'] = $this->user_info;
		$where = !isset($_GET['search']) ? array() : array("nickname" => $this->input->get("search"));
		$data['user'] = count($where) <= 0 ? $this->user_model->get_list($where, $data['page'] - 1, 20) : $this->user_model->search_where($where , $data['page'] - 1, 20);

		foreach ($data['user'] as $key => $value) {
			if($data['user'][$key]['type']  == "0"){
				$data['user'][$key]['type'] = "学员";
			}else{
				$data['user'][$key]['type'] = $data['user'][$key]['type'] == "1" ? "大神" : "<font style='color:#cc0000;font-weight:700'>待审核</font>";
			}
		}
		$data['user_max'] = $this->user_model->get_count($where);

		$this->parser->parse('admin/user.php', $data);
	}
    function stats(){

        $page = !isset($_GET['page']) ? "1" : $this->input->get("page");

        $pid = $this->input->get('pid',1);
        $args = $this->uri->uri_to_assoc();
        if (!$pid) {
            if (isset($args['pid'])) {
                $pid = $args['pid'];
            }
        }
        $where = [];
        if ($pid) {

            $where = array(
                "nickname" => urldecode($pid)
            );
            $data = ModelFactory::User()->get($where);
            $where = array(
                "parent_id" => $data['id']
            );

        }
        $per_page = 40;
        $userdata["list"] = ModelFactory::Invitehistory()->get_list($where,$page-1, $per_page);
        foreach ( $userdata["list"] as &$user) {
            $user['user_info'] = ModelFactory::User()->get_user_data($user['user_id']);
            $user['pt_info'] = ModelFactory::User()->get_user_data($user['parent_id']);
        }
        $count = ModelFactory::Invitehistory()->get_count($where);
        $userdata['count'] = $count;
        $userdata['page_url'] = "/admin/stats";
        if ($pid) {
            $userdata['page_url'] .= '/pid/'.$pid;
        }
//        echo $count;exit;
        $this->parser->parse('admin/stats.php',$userdata);

    }
	public function index() {
		if ($this->admin_model->require_login() === false) redirect('admin/login');
		$data = array (
			'me' => $this->admin_model->me
		);
		$this->load->view('admin/home.php', $data);
	}

	public function slider(){
		if(empty($this->user_info)) redirect('admin/login');
		$data['page'] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$returnData = $this ->slide_model -> get_list(0,($data['page']-1)*5);

		$data = array(
			"data_count" => $this ->slide_model -> get_count(array("type" => 0)),
			"data_list" => $returnData,
			"me" => $this->user_info,
			"page" => $data["page"]
		);
		$this->load->library('parser');
		$this->parser->parse('admin/slider.php', $data);
	}

	public function tags() {
		if (empty($this->user_info)) redirect('admin/login');
		$this->load->model('tag_model');
		$page = !isset($_GET['page']) ? 1 : $this->input->get('page');
		$where = !isset($_GET['search']) ? array() : array("name" => $this->input->get("search"));
		$search_type = !isset($_GET['search']) ? false : true;

		$list = count($where) <= 0 ? $this->tag_model->get_list($where, $page - 1, 10) : $this->tag_model->search_where($where , $page - 1, 10);
		$tag_count = $this->tag_model->get_count($where);
		foreach ($list as &$item) {
			$item['type'] = $item['type'] === 0 ? '课程' : '秒答';
		}
		$data = array (
			'me' => $this->user_info,
			'tags' => $list,
			"page" => $page,
			"tag_count" => $tag_count
		);
		$this->parser->parse('admin/tags.php', $data);
	}

	public function problems() {
		if (empty($this->user_info)) redirect('admin/login');
		$this->load->model('problem_model');
		$page = !isset($_GET['page']) ? 1 : $this->input->get('page');
		$where = !isset($_GET['search']) ? array() : array("title" => $this->input->get("search"));
		$search_type = !isset($_GET['search']) ? false : true;
		$list = count($where) <= 0 ? $this->problem_model->get_list($where, $page - 1 , 10) : $this->problem_model->search_where($where, $page - 1, 10);
		$problem_count = $this->problem_model->get_count($where);


		foreach ($list as &$item) {
			switch($item['type']) {
				case '0':
					$item['type'] = '未认领';
					break;
				case '1':
					$item['type'] = '认领中';
					break;
				case '2':
					$item['type'] = '已回答';
					break;
				case '3':
					$item['type'] = '已关闭';
					break;
			}
			$item['owner'] = $this->user_model->get(array(
				'id' => $item['owner_id']
			))['nickname'];
			$item['answer'] = $this->user_model->get(array(
				'id' => $item['answer_id']
			))['nickname'];
		}
		$data = array (
			'me' => $this->user_info,
			'list' => $list,
			'page' => $page,
			'problem_count' => $problem_count,
			'search_type' => $search_type,
		);
		$this->parser->parse('admin/problems.php', $data);
	}

	public function users() {
		if (empty($this->user_info)) redirect('admin/login');
		$data = array (
			'me' => $this->user_info
		);
		$this->load->view('admin/users.php', $data);
	}

	public function login() {
		$this->load->view('admin/login.php');
	}


	//编辑首页图片
	public function eidtIndexSlider(){
		$title = $this->input->post("title", true);
		$link = $this->input->post("link", true);
		$description = $this->input->post("description", true);
		$color = $this->input->post("color", true);
		$id = $this->input->post("id", true);
		$type = $this->input->post("type", true);


		if(isset($_FILES["userfile"])){
			$config['upload_path'] = './static/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['file_name'] =date("Ymd"). rand(100000000000,9999999999999);
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload("userfile")){
				echo  '{"status" : "false" , "error" : "' . $this->upload->display_errors() . '"}';
			}else{
				$returnConfig = $this->upload->data();
				$data = array(
					'name' => $title,
					'type' => $type,
					'img' => $returnConfig['file_name'],
					'link' => $link,
					'color' => $color,
					'text' => $description,
				);
				$this->db->where('id', $id);
				$this->db->update('slide', $data);
				echo  '{"status" : "true"}';
			}
		}else{
			$data = array(
				'name' => $title,
				'type' => $type,
				'link' => $link,
				'color' => $color,
				'text' => $description,
			);
			$this->db->where('id', $id);
			$this->db->update('slide', $data);
			echo  '{"status" : "true"}';
		}
	}


	//添加首页轮播图片
	public function addIndexSlider(){
		$title = $this->input->post("title", true);
		$link = $this->input->post("link", true);
		$description = $this->input->post("description", true);
		$color = $this->input->post("color", true);
		$type = $this->input->post("type", true);

		$config['upload_path'] = './static/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '2048';

		$this->load->library('upload', $config);
		if(!$this->upload->do_upload("userfile")){
			echo  '{"status" : "false" , "error" : "' . $this->upload->display_errors() . '"}';
		}else{
			$returnConfig = $this->upload->data();
			$this->load->database();
			$data = array(
				'id' => "NULL",
				'name' => $title,
				'type' => $type,
				'img' => $returnConfig['file_name'],
				'link' => $link,
				'color' => $color,
				'text' => $description,
			);
			$this->db->insert('slide', $data);
			echo  '{"status" : "true"}';
		}
	}




	/*
	*	课程详情
	*	classList		首页 （课程设置，课程的添加删改）
	*	classListSite 	课程详细设置
	*/
	public function classList(){
		if (empty($this->user_info)) redirect('admin/login');
		$page = isset($_GET['page']) ? $this->input->get("page") : 1;
		$returnData = $this->course_model->get_list("all" , $page - 1 ,10);
		$courseType = array('u3d' , 'Swift' , 'Web' , 'Cocos2d-x' , 'Android');
		foreach ($returnData as &$value) {
			$value['type'] = $courseType[$value['type']];
		}
		$course_max = $this->course_model->get_count(array());
		$data = array(
			"page" => $page,
			"data_list" => $returnData,
			"me" => $this->user_info,
			"course_max" => $course_max,
		);

		$this->parser->parse('admin/classList/home.php' , $data);
	}

	public function classListTag(){
		if (empty($this->user_info)) redirect('admin/login');
		$returnData = $this -> admin_model -> getClassList();
		$data = array(
			"data_list" => $returnData,
			"me" => $this->user_info
		);
		$this->load->library('parser');
		$this->parser->parse('admin/classList/home.php' , $data);
	}

	public function classListSite($id = ""){
		if(empty($this->user_info)) redirect('admin/login');

		$data = $this->course_model->get_list($id , 0 , 1)[0];
		if(count($data) <= 0) show_404();

		$data['class_type'] = $this->input->get("type");
		$data['page'] = !isset($_GET['page']) ? "1" : $this->input->get("page");

		switch ($data['class_type']) {
			case 'tag':
				$data["tag_count"] = count($data['tags'] );
				$data['tags'] =  $data['page'] -1* 10 > $data["tag_count"] ? array_slice($data['tags'],($data['page'] -1)* 10 ) : $data['tags'] = array_slice($data['tags'],($data['page'] -1)* 10 , 10);
				break;

			case 'step':
				$data["steps_count"] = count($data['steps'] );
				$data['steps'] =  $data['page'] -1* 10 > $data["steps"] ? array_slice($data['steps'],($data['page'] -1)* 10 ) : $data['steps'] = array_slice($data['steps'],($data['page'] -1)* 10 , 10);
				break;

			case 'chapter':
				$data["chapter_count"] = $this->course_chapter_model->get_count(array('course_id' => $id));
				$data['chapter'] = array_reverse($this->course_chapter_model->get_list(array("course_id" => $id) ,$data['page'] - 1, 10));
				break;

			default:
				$data["tag_count"] = count($data['tags'] );
				$data['tags'] =  $data['page'] -1* 10 > $data["tag_count"] ? array_slice($data['tags'],($data['page'] -1)* 10 ) : $data['tags'] = array_slice($data['tags'],($data['page'] -1)* 10 , 10);
				break;
		}

		$data['me'] = $this->user_info;
		$data['type'] = $id;


		$this->parser->parse('admin/classList/classListSite.php', $data);
	}



	/*
	*	在线课堂
	*	onlineClass 首页 （新手引导）
	*	onlineSlider 轮播设置
	*	onlineGoTo 课程方向引导
	*/
	public function onlineClass(){
		if (empty($this->user_info)) redirect('admin/login');
		$data = array (
			'me' => $this->user_info,
			'guide' => $this->guide_model->get_guide()
		);
		$this->load->view('admin/onlineClass/home.php', $data);
	}

	public function onlineGoTo(){
		if (empty($this->user_info)) redirect('admin/login');
		$this->load->model('site_model');
		$this->parser->parse('admin/onlineClass/onlineGoTo.php', array(
			"me" => $this->user_info,
			'guide_list' => $this->guide_model->get_list(),
			'slide_list' => $this->slide_model->get_list(1),
			'schedule_course' => $this->site_model->get_content('001'),
			'schedule_date' => $this->site_model->get_content('002'),
		));
	}

	public function god_class() {
		if (empty($this->user_info)) redirect('admin/login');
		$this->load->model('god_course_model');

		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$page_count = 20;
		$course = $this->god_course_model->get_list('all');
		$course_count = count($course);
		$course = array_slice($course, ($page - 1) * $page_count, $page_count);
		foreach ($course as &$item) {
			$god = $this->user_model->get(array(
				'id' => $item['god']
			));
			$item['god_nickname'] = $god['nickname'];
			$item['god_id'] = $god['id'];
		}

		$data = array (
			'me' => $this->user_info,
			'page' => $page,
			'page_count' => $page_count,
			'course_count' => $course_count,
			'course' => $course,
		);
		$this->parser->parse('admin/god_class.php', $data);
	}

	public function comment() {
		if($this->admin_model->require_login() === false) redirect('admin/login');

		$this->load->model('problem_comment_model');
		$page = $this->input->get("page");
		$page = empty($page) || $page < 1 ? '1' : $page;
		$search = $this->input->get("search");
		if(empty($search)) {
			$comments = $this->problem_comment_model->get_list(array(), $page - 1, 20);
			$count = $this->problem_comment_model->get_count(array());
		} else {
			// TODO
		}

		$this->parser->parse('admin/comment.php', array(
			'me' => $this->user_info,
			'comments_count' => $count,
			'page' => $page,
			'comments' => $comments
		));
	}
}

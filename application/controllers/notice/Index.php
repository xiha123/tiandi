<?php

class index extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("news_model");
	}

	public function index() {
		$me = $this->user_model->check_login();
		if($me === false) show_404();

		// 用户查看通知页面后就将所有未读的消息设为已读
		$this->news_model->edit_array(array("target" => $me['id']), array("status" => 1));

		// 拉出通知列表以及页数相关
		$me['page'] = !isset($_GET['page']) ? "1" : $this->input->get("page");
		$me['news_count'] = $this->news_model->get_count(array(
			'target' => $me['id']
		));
		$me['news_list'] = $this->news_model->get_list(array(
			'target' => $me['id']
		), ($me['page'] - 1) * 20, 20);

		$contentArr = array(
			'000' => '欢迎您注册天地君道秒答平台，为表示感谢赠送您 200 银币！激活邮箱再送 300 银币哦！',
			'001' => '您的密码已被重置，请及时更换为新密码。',
			'002' => '恭喜您激活邮箱成功！赠送您 300 银币！',
			'100' => '您的大神申请表已经提交，请等待审核。',
			'101' => '您的大神申请表通过了审核，您正式成为天地君道秒答平台的大神账号。',
			'102' => '您的大神请求表未通过审核，您可以尝试多回答问题并提交更详细的审核表。',
			'200' => '您的问题: <a href="problem/?p={problem_id}">{problem_title}</a> 已被大神: <a href="home?uid={from_id}">{from_name}</a> 认领，欢迎前去围观。',
			'201' => '您的问题: <a href="problem/?p={problem_id}">{problem_title}</a> 已被大神: <a href="home?uid={from_id}">{from_name}</a> 回答，请注意查看。',
			'202' => '您的问题: <a href="problem/?p={problem_id}">{problem_title}</a> 收到来自: <a href="home?uid={from_id}">{from_name}</a> 评论，请注意查看。',
			'300' => '您成功参与了问题: <a href="problem/?p={problem_id}">{problem_title}</a> 的众筹，并将收到相关新消息，已推送给各路大神，等待回答。',
			'301' => '您参与众筹的问题: <a href="problem/?p={problem_id}">{problem_title}</a> 已被大神: <a href="home?uid={from_id}">{from_name}</a> 回答，请注意查看。',
			'400' => '恭喜您在问题: <a href="problem/?p={problem_id}">{problem_title}</a> 中的回答被提问者评为满意。',
			'401' => '您认领的问题: <a href="problem/?p={problem_id}">{problem_title}</a> 超过 20 分钟未作答，已被系统收回。',
			'402' => '您认领的问题: <a href="problem/?p={problem_id}">{problem_title}</a> 回答完毕，问题奖励 {from_id} 银币已经加入您的账号。',
			'500' => '用户: <a href="home?uid={from_id}">{from_name}</a>关注了您',
		);
		$this->load->model('problem_model');
		foreach ($me['news_list'] as &$item) {
			$problem_title = $item['problem_id'] != -1 ? $this->problem_model->get(array(
				'id' => $item['problem_id']
			))['title'] : '';
			$from_name = $item['from_id'] != -1 ? $this->user_model->get(array(
				'id' => $item['from_id']
			))['nickname'] : '';
			$item['content'] = $this->parser->parse_string($contentArr[$item['type']], array(
				'problem_id' => $item['problem_id'],
				'problem_title' => $problem_title,
				'from_id' => $item['from_id'],
				'from_name' => $from_name
			), true);
		}

		$this->parser->parse('notice/home.php', $me);
	}

}

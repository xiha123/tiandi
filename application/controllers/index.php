<?php
	//控制器文件
	class index extends CI_Controller {
	
		public function home($page = 'home')
		{
			
			if (!file_exists(APPPATH.'/views/home/'.$page.'.php'))
			{
				show_404();// 页面不存在
			}
			
			$data['title'] = ucfirst($page); // 将title中的第一个字符大写
			
			$this->load->view('templates/header', $data);
			$this->load->view('home/'.$page, $data);
			$this->load->view('templates/footer', $data);
		}
	}
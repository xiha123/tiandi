<?php
	//控制器文件
	class content extends CI_Controller {
	
		public function page($page = 'page')
		{
			
			if (!file_exists(APPPATH.'/views/page/'.$page.'.php'))
			{
				show_404();// 页面不存在
			}
			
			$data['title'] = "天地培训内页";
			
			$this->load->view('templates/header', $data);
			$this->load->view('page/'.$page, $data);
			$this->load->view('templates/footer', $data);
		}
	}
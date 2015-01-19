<?php
		
class Websiteset extends CI_Controller {
    
    private $data = array();
	private $father_name = 'websiteset';//管理分類名稱

	public function __construct()
	{
		parent::__construct();
        $this->data = $this->common_model->common();
        $data = $this->data;
        
		if($data['user']['uid'] == '')
		{
			$url = base_url('user/login');
			header('Location: '.$url);
		}
		
		$this->load->model('admin_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	
	public function set($input = '')
	{
		global $admin;
        $data = $this->data;
		
		if($input == 'title')
        {
			$this->form_validation->set_rules('website_title_name', '網站標題名稱', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $website_title_name = $this->input->post('website_title_name', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'website_title_name', 'value' => $website_title_name) );
				$this->setting_model->update();
                
                $website_title_introduction = $this->input->post('website_title_introduction', TRUE);
                $this->setting_model->construct( array('keyword' => 'website_title_introduction', 'value' => $website_title_introduction) );
				$this->setting_model->update();
				
				$message = '設定成功';
				$url = 'admin/websiteset/set';
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/websiteset/set';
					
			}
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else if($input == 'webname')
        {
			$this->form_validation->set_rules('website_name', '網站名稱', 'required');
			$this->form_validation->set_rules('website_logo', '網站LOGO', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $website_name = $this->input->post('website_name', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'website_name', 'value' => $website_name) );
				$this->setting_model->update();
                
                $website_logo = $this->input->post('website_logo', TRUE);
                $this->setting_model->construct( array('keyword' => 'website_logo', 'value' => $website_logo) );
				$this->setting_model->update();
				
				$message = '設定成功';
				$url = 'admin/websiteset/set';
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/websiteset/set';
			}
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else if($input == 'email')
        {
			$this->form_validation->set_rules('website_email', '網站電子郵件', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $website_email = $this->input->post('website_email', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'website_email', 'value' => $website_email) );
				$this->setting_model->update();
				
				$message = '設定成功';
				$url = 'admin/websiteset/set';
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/websiteset/set';
			}
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else
		{
			$child_name = 'set';//管理分類類別名稱
			
			//沒有這個頁面
			if ( ! file_exists('app/views/admin/'.$this->father_name.'_'.$child_name.'.php'))
			{
				show_404();
			}
				
			//view data設定
			$data['admin_sidebox'] = reset_admin_sidebox($this->father_name, $child_name);
			$data['child_name'] = $child_name;
        
            //global
            $data['global']['style'][] = 'admin';
			$data['global']['js'][] = 'script_common';
            
            //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
			$data['temp']['admin_header_down'] = $this->load->view('admin/admin_header_down', $data, TRUE);
			$data['temp']['admin_footer'] = $this->load->view('admin/admin_footer', $data, TRUE);
				
			//輸出模板
			$this->load->view('admin/'.$this->father_name.'_'.$child_name, $data);
		}
	}
	
	public function seometa($input = '')
	{
		global $admin;
        $data = $this->data;
		
		if($input == 'metatag'){
			$this->form_validation->set_rules('website_metatag', 'SEO標籤', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $website_metatag = $this->input->post('website_metatag', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'website_metatag', 'value' => $website_metatag) );
				$this->setting_model->update();
				
				$message = '設定成功';
				$url = 'admin/websiteset/seometa';
				
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/websiteset/seometa';
					
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
		}
		else
		{
			$child_name = 'seometa';//管理分類類別名稱
			
			//沒有這個頁面
			if ( ! file_exists('app/views/admin/'.$this->father_name.'_'.$child_name.'.php'))
			{
				show_404();
			}
				
			//view data設定
			$data['admin_sidebox'] = reset_admin_sidebox($this->father_name, $child_name);
			$data['child_name'] = $child_name;
        
            //global
            $data['global']['style'][] = 'style';
            $data['global']['style'][] = 'admin';
			$data['global']['js'][] = 'script_common';
            
            //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
			$data['temp']['admin_header_down'] = $this->load->view('admin/admin_header_down', $data, TRUE);
			$data['temp']['admin_footer'] = $this->load->view('admin/admin_footer', $data, TRUE);
				
			//輸出模板
			$this->load->view('admin/'.$this->father_name.'_'.$child_name, $data);
		}
	}
	
	public function plugin($input = '')
	{
		global $admin;
        $data = $this->data;
		
		if($input == 'ga'){
			$this->form_validation->set_rules('website_script_plugin_ga', 'GA Script Plugin');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $website_script_plugin_ga = $this->input->post('website_script_plugin_ga');
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'website_script_plugin_ga', 'value' => $website_script_plugin_ga) );
				$this->setting_model->update();
				
				$message = '設定成功';
				$url = 'admin/websiteset/plugin';
				
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/websiteset/plugin';
					
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
		}
		else if($input == 'fb'){
			$this->form_validation->set_rules('website_script_plugin_fb', 'FB Script Plugin');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $website_script_plugin_fb = $this->input->post('website_script_plugin_fb');
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'website_script_plugin_fb', 'value' => $website_script_plugin_fb) );
				$this->setting_model->update();
				
				$message = '設定成功';
				$url = 'admin/websiteset/plugin';
				
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/websiteset/plugin';
					
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
		}
		else if($input == 'custom'){
			$this->form_validation->set_rules('website_script_plugin_custom', 'Custom Script Plugin');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $website_script_plugin_custom = $this->input->post('website_script_plugin_custom');
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'website_script_plugin_custom', 'value' => $website_script_plugin_custom) );
				$this->setting_model->update();
				
				$message = '設定成功';
				$url = 'admin/websiteset/plugin';
				
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/websiteset/plugin';
					
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
		}
		else
		{
			$child_name = 'plugin';//管理分類類別名稱
			
			//沒有這個頁面
			if ( ! file_exists('app/views/admin/'.$this->father_name.'_'.$child_name.'.php'))
			{
				show_404();
			}
				
			//view data設定
			$data['admin_sidebox'] = reset_admin_sidebox($this->father_name, $child_name);
			$data['child_name'] = $child_name;
        
            //global
            $data['global']['style'][] = 'admin';
			$data['global']['js'][] = 'script_common';
            
            //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
			$data['temp']['admin_header_down'] = $this->load->view('admin/admin_header_down', $data, TRUE);
			$data['temp']['admin_footer'] = $this->load->view('admin/admin_footer', $data, TRUE);
				
			//輸出模板
			$this->load->view('admin/'.$this->father_name.'_'.$child_name, $data);
		}
	}
}

?>
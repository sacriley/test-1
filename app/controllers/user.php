<?php

class User extends CI_Controller
{

    private $data = array();
    
	public function __construct()
	{
		parent::__construct();
        $this->data = $this->common_model->common();
		$this->load->model('user_model');
	}
	
	public function index()
	{
		$url = base_url('user/login');
		header('Location: '.$url);
	}
	
	public function logout()
	{
		$this->session->unset_userdata('uid');
		$url = 'user/login';
		$message = '登出成功';
		
		$this->load->model('message_model');
		$this->message_model->show(array('message' => $message, 'url' => $url));
	}
	
	public function resetpsw()
	{
		//建立一個含有特殊碼的資料列，本資料列若48小時未使用將自動刪除，並將特殊碼含連結一併寄至使用者信箱，使用者可連結至密碼修改頁面進行密碼修改
	
	}
	
	//編輯基本資料
	public function edit()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//基本資料：uid、email、username、password、name、updatetime
		//其它資料：firstname、lastname、phone、address、sex
	}
	
	//忘記密碼
	public function forgetpsw()
	{
        $data = $this->data;
        
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//view data設定
		$data['validation_errors'] = validation_errors();
		$data['page'] = 'user';
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'user';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//PC/Mobile版本特別模組
		$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		
		//輸出模板
		$this->load->view('user/forgetpsw.php', $data);
	}
	
	//註冊會員
	public function register()
	{
        $data = $this->data;
        
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//view data設定
		$data['validation_errors'] = validation_errors();
		$data['page'] = 'user';
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'user';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//PC/Mobile版本特別模組
		$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		
		//輸出模板
		$this->load->view('user/register.php', $data);
	}
	
	public function login()
	{
        $data = $this->data;
        
		if(isset($data['global']['user']['uid']) && $data['global']['user']['uid'] != '')
		{
			$url = base_url('admin');
			header('Location: '.$url);
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', '密碼', 'required');
		
		$this->form_validation->set_error_delimiters('<p class="red">', '</p>');
		$this->form_validation->set_message('required', '您必須填寫%s欄位');
		
		if ($this->form_validation->run() === FALSE)
		{
			//view data設定
			$data['validation_errors'] = validation_errors();
			$data['page'] = 'user';
            
            //global
            $data['global']['style'][] = 'style';
            $data['global']['style'][] = 'user';
            
            //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
			$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
			$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
				
			//PC/Mobile版本特別模組
			$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
				
			//輸出模板
			$this->load->view('user/login.php', $data);
		}
		else
		{
			$login_status = $this->user_model->login();
			if($login_status == 'ok')
			{
				$url = base_url('admin');
				header("Location: $url");
			}
			else
			{
				//view data設定
				$data['validation_errors'] = '<p class="red">'.$login_status.'</p>';
				$data['page'] = 'user';
                
                //global
                $data['global']['style'][] = 'style';
                $data['global']['style'][] = 'user';
                
                //temp
				$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
				$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
				$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
					
				//PC/Mobile版本特別模組
				$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
					
				//輸出模板
				$this->load->view('user/login.php', $data);
			}
		}
	}
	
}

?>
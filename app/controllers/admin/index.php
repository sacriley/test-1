<?php

class Index extends CI_Controller {

    private $data = array();
    
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
	}
    
	public function index($page = 'index'){
		
		header("Location: admin/websiteset/set");
		
	}
}

?>
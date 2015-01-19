<?php

class Page extends CI_Controller {

    private $data = array();
    
	public function __construct(){
		parent::__construct();
        $this->data = $this->common_model->common();
	}
    
	public function _remap($page = 'index'){
        $data = $this->data;
        
        if(isset($page) == FALSE)
        {
            $page = 'index';
        }
		//沒有這個頁面
		if ( ! file_exists('app/views/page/'.$page.'.php')){
			show_404();
		}
		
		//判斷PC/Mobile瀏覽器
		if (isset($data['global']['browser_agent']['agent']) && $data['global']['browser_agent']['agent'] == 'm')
		{
			$agent = 'm';
			$agent_temp = '_m';
		}
		else if(isset($data['global']['browser_agent']['agent_ie']) && $data['global']['browser_agent']['agent_ie'] == 'ie8')
		{
			$agent = 'ie8';
			$agent_temp = '_ie8';
		}
		else
		{
			$agent = '';
			$agent_temp = '';
		}
		
		//如果沒有手機版本就連回PC版本
		if ( ! file_exists('app/views/page/'.$page.$agent_temp.'.php')){
			$agent = '';
			$agent_temp = '';
		}
        
        if($page == 'index')
        {
            $this->load->model('setting_list_model');
            $this->setting_list_model->db_construct( array('keyword' => array('index_showroom_image', 'index_showroom_content', 'index_activity_image', 'index_activity_content', 'index_news_image', 'index_news_content', 'index_brand_image', 'index_brand_content') ) );
            $data['setting_list_array'] = $this->setting_list_model->get_array();
            
            $this->load->model('ad_list_model');
            $this->ad_list_model->db_construct( array('db_where' => array('status' => 1) ) );
            $data['ad_list'] = $this->ad_list_model->get_array();
        }
        else if($page == 'story')
        {
            $this->load->model('setting_list_model');
            $this->setting_list_model->db_construct( array('db_construct' => array('modelname' => 'page_story') ) );
            $data['setting_list_array'] = $this->setting_list_model->get_array();
        }
		
		//view data設定
		$data['page'] = $page;
        
        //global
		$data['global']['style'][] = 'style'.$agent_temp;
		$data['global']['style'][] = $page.$agent_temp;
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up'.$agent_temp, $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down'.$agent_temp, $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer'.$agent_temp, $data, TRUE);
		
		//PC/Mobile版本特別模組
		if($agent !== 'm'){
			$data['temp']['topheader'] = $this->load->view('temp/topheader'.$agent_temp, $data, TRUE);
		}
		
		//輸出模板
		$this->load->view('page/'.$page.$agent_temp, $data);
	}
}

?>
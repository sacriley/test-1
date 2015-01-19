<?php

class Brand extends CI_Controller {

    private $data = array();
    
	public function __construct(){
		parent::__construct();
        $this->data = $this->common_model->common();
        $data = $this->data;
	}
    
	public function _remap($do = 'classid', $ids = 0){
        $data = $this->data;
        if(!empty($id))
        {
            $id = $ids[0];
        }
        else
        {
            $id = 0;
        }
        
		//沒有這個頁面
		if ( ! file_exists('app/views/brand.php')){
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
        
        $classid = $id;
        if($classid == 0)
        {
            $classid = 528528;
        }
            
        $modelname = 'brand_list_model'.rand(0,32767);
        $this->load->model('brand_list_model', $modelname);
        $this->$modelname->db_construct( array('classid' => $classid ) );
        $data['brand_list1'] = $this->$modelname->get_array();
        
        $modelname = 'brand_list_model'.rand(0,32767);
        $this->load->model('brand_list_model', $modelname);
        $this->$modelname->db_construct( array('classid' => $classid ) );
        $data['brand_list2'] = $this->$modelname->get_array();
        
        if(empty($data['brand_list1'][0]['brandid']))
        {
            $this->load->model('message_model');
            $this->message_model->show(array('message' => '這個分類是空的', 'url' => 'brand'));
        }
        
        $this->load->model('class_list_model');
        $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'brand') ) );
        $data['class_list'] = $this->class_list_model->get_array();
        
        //global
		$data['global']['style'][] = 'style';
		$data['global']['style'][] = 'brand';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//輸出模板
		$this->load->view('brand', $data);
	}
}

?>
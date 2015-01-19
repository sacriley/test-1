<?php

class Showroom extends CI_Controller {

    private $data = array();
    
	public function __construct(){
		parent::__construct();
        $this->data = $this->common_model->common();
        $data = $this->data;
	}
    
	public function _remap($do = 'showroomid', $ids = 0){
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
		if ( ! file_exists('app/views/showroom.php')){
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
        
        if($do == 'index')
        {
            $do = 'showroomid';
        }
        if($do == 'showroomid')
        {
            $showroomid = $id;
            if($showroomid == 0)
            {
                $showroomid = 528502;
            }
            $this->load->model('showroom_model');
            $this->showroom_model->db_construct( array('db_where' => array('showroomid' => $showroomid) ) );
            $data['showroom'] = $this->showroom_model->get_array();
        }
        else if($do == 'classid')
        {
            $roomclassid = $id;
            $styleclassid = $ids[1];
            
            $this->load->model('showroom_model');
            $this->showroom_model->db_construct( array('roomclassid' => $roomclassid, 'styleclassid' => $styleclassid) );
            $data['showroom'] = $this->showroom_model->get_array();
            if(empty($data['showroom']['showroomid']))
            {
                $this->load->model('message_model');
                $this->message_model->show(array('message' => '這個分類是空的', 'url' => 'showroom'));
            }
        }
        
        $this->load->model('showroom_list_model');
        $this->showroom_list_model->db_construct( array('styleclassid' => $data['showroom']['styleclassid'], 'roomclassid' => $data['showroom']['roomclassid'] ) );
        $data['showroom_list'] = $this->showroom_list_model->get_array();
        
        $this->load->model('class_list_model');
        $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'showroom_roomclass') ) );
        $data['roomclass_list_array'] = $this->class_list_model->get_array();
        $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'showroom_styleclass') ) );
        $data['styleclass_list_array'] = $this->class_list_model->get_array();
        
        //global
		$data['global']['style'][] = 'style';
		$data['global']['style'][] = 'showroom';
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		//輸出模板
		$this->load->view('showroom', $data);
	}
}

?>
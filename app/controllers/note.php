<?php

class Note extends CI_Controller {
    
    private $data = array();
    
	public function __construct(){
		parent::__construct();
        $this->data = $this->common_model->common();
	}

	public function index()
    {
        $data = $this->data;
        
        $limitstart = $this->input->get('limitstart');
        $limitcount = $this->input->get('limitcount');
        $limitcount = empty($limitcount) ? 20 : $limitcount;
        $limitcount = $limitcount > 100 ? 100 : $limitcount;
            
        $this->load->model('note_list_model');
        $this->note_list_model->set_db(array(
            'db_where' => array(
                'modelname' => 'note'
            ),
            'limitstart' => $limitstart,
            'limitcount' => $limitcount,
        ));
        $this->note_list_model->db_construct();
        $data['note_list_array'] = $this->note_list_model->get_array();
        $data['note_links'] = $this->note_list_model->create_links( array('base_url' => 'note') );
		
		//判斷PC/Mobile瀏覽器
		$this->load->library('user_agent');
		if ($this->agent->is_mobile())
		{
			$agent = 'm';
			$agent_temp = '_m';
		}
		else
		{
			$agent = '';
			$agent_temp = '';
		}
		
        //view
		$data['page'] = 'note';
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'note'.$agent_temp;
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up'.$agent_temp, $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down'.$agent_temp, $data, TRUE);
		if($agent !== 'm'){
			$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		}
		$data['temp']['footer'] = $this->load->view('temp/footer'.$agent_temp, $data, TRUE);
		
		$this->load->view('note/index'.$agent_temp, $data);
	}
	
	public function view($noteid = 0)
    {
        $data = $this->data;
		
        $this->load->model('note_model');
        $this->note_model->db_construct( array('db_where' => array('noteid' => $noteid) ) );
        $data['note_array'] = $this->note_model->get_array();
		
		//判斷PC/Mobile瀏覽器
		$this->load->library('user_agent');
		if ($this->agent->is_mobile())
		{
			$agent = 'm';
			$agent_temp = '_m';
		}
		else
		{
			$agent = '';
			$agent_temp = '';
		}
        
        //data
		$data['page'] = 'note';
        
        //global
        $data['global']['style'][] = 'style';
        $data['global']['style'][] = 'note'.$agent_temp;
        
        //temp
		$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
		$data['temp']['header_down'] = $this->load->view('temp/header_down', $data, TRUE);
		$data['temp']['topheader'] = $this->load->view('temp/topheader', $data, TRUE);
		$data['temp']['footer'] = $this->load->view('temp/footer', $data, TRUE);
		
		$this->load->view('note/view', $data);

	}
}

?>
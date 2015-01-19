<?php
		
class Ad extends CI_Controller {

    private $data = array();
	private $father_name = 'ad';//管理分類名稱
    
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
	
	public function postad($do = '', $adid = 0)
	{
		global $admin;
        $data = $this->data;
        $child_name = 'postad';//管理分類類別名稱
		
		if($do == 'post')
        {
            $this->form_validation->set_rules('title', '標題', 'required');
            $this->form_validation->set_rules('href', '連結', 'required');
            if ($this->form_validation->run() !== FALSE)
            {
                $adid = $this->input->post('adid', TRUE);
                $title = $this->input->post('title', TRUE);
                $href = $this->input->post('href', TRUE);
                $prioritynum = $this->input->post('prioritynum', TRUE);
                $picid_array = $this->input->post('picid_array', TRUE);
                $picid_file = !empty($_FILES['picid_file']) ? $_FILES['picid_file'] : array();
                if( !empty($picid_file['name'][0]) )
                {
                    $this->load->model('pic_list_model');
                    $this->pic_list_model->construct( array('file_array' => $picid_file, 'thumb' => 'w50h50,w300h300') );
                    $this->pic_list_model->upload();
                    if( !empty($picid_array) )
                    {
                        $picid_array = array_merge($picid_array, $this->pic_list_model->get_picid_array() );
                    }
                    else
                    {
                        $picid_array = $this->pic_list_model->get_picid_array();
                    }
                }
                
                $this->load->model('ad_model');
                $this->ad_model->construct( array('adid' => $adid, 'title' => $title, 'href' => $href, 'picid_array' => $picid_array, 'prioritynum' => $prioritynum) );
                
                $this->ad_model->update();

                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定成功',
                     'url' => 'admin/ad/adlist'
                ));
            }
            else
            {
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定失敗',
                    'url' => 'admin/ad/adlist'
                ));
            }
		}
		else
		{
			//沒有這個頁面
			if ( ! file_exists('app/views/admin/'.$this->father_name.'_'.$child_name.'.php'))
			{
				show_404();
			}
            
            $this->load->model('ad_model');
            if( !empty($adid) )
            {
                $this->ad_model->db_construct( array('db_where' => array('adid' => $adid) ) );
            }
            $data['ad'] = $this->ad_model->get_array();
            
            $this->load->model('class_list_model');
            $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'ad') ) );
            $data['class_list_array'] = $this->class_list_model->get_array();
				
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
	
	public function adlist($input = '')
	{
		global $admin;
        $data = $this->data;
        $child_name = 'adlist';//管理分類類別名稱
		
		if($input == 'post')
        {
			$this->form_validation->set_rules('classid', 'classid', 'required');
			$this->form_validation->set_rules('classname', 'classname', 'required');
			$this->form_validation->set_rules('slug', '標籤代號', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定成功',
                     'url' => 'admin/ad/adlist'
                ));
			}
			else
			{
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定失敗',
                     'url' => 'admin/ad/adlist'
                ));
			}
		}
		else
		{
			
			//沒有這個頁面
			if ( ! file_exists('app/views/admin/'.$this->father_name.'_'.$child_name.'.php'))
			{
				show_404();
			}
            
            $this->load->model('ad_list_model');
            $this->ad_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid']) ) );
            $data['ad_list'] = $this->ad_list_model->get_array();
				
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
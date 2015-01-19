<?php
		
class Brand extends CI_Controller {

    private $data = array();
	private $father_name = 'brand';//管理分類名稱
    
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
	
	public function postbrand($do = '', $brandid = 0)
	{
		global $admin;
        $data = $this->data;
        $child_name = 'postbrand';//管理分類類別名稱
		
		if($do == 'post')
        {
            $this->form_validation->set_rules('title', '文章標題', 'required');
            $this->form_validation->set_rules('content', '文章內容', 'required');
				
            if ($this->form_validation->run() !== FALSE)
            {
                $brandid = $this->input->post('brandid', TRUE);
                $title = $this->input->post('title', TRUE);
                $href = $this->input->post('href', TRUE);
                $classid_array = $this->input->post('classid_array', TRUE);
                $content = $this->input->post('content', TRUE);
                $prioritynum = $this->input->post('prioritynum', TRUE);
                
                $picid_array = $this->input->post('picid_array', TRUE);
                $picid_file = !empty($_FILES['picid_file']) ? $_FILES['picid_file'] : array();
                if( !empty($picid_file['name'][0]) )
                {
                    $this->load->model('pic_list_model');
                    $this->pic_list_model->construct( array('file_array' => $picid_file, 'thumb' => 'w50h50,w300h300') );
                    $this->pic_list_model->upload();
                    if(!empty($picid_array))
                    {
                        $picid_array = array_merge($picid_array, $this->pic_list_model->get_picid_array() );
                    }
                    else
                    {
                        $picid_array = $this->pic_list_model->get_picid_array();
                    }
                }
                
                $toppicid_array = $this->input->post('toppicid_array', TRUE);
                $toppicid_file = !empty($_FILES['toppicid_file']) ? $_FILES['toppicid_file'] : array();
                if( !empty($toppicid_file['name'][0]) )
                {
                    $this->load->model('pic_list_model');
                    $this->pic_list_model->construct( array('file_array' => $toppicid_file, 'thumb' => 'w50h50,w300h300') );
                    $this->pic_list_model->upload();
                    if(!empty($toppicid_array))
                    {
                        $toppicid_array = array_merge($toppicid_array, $this->pic_list_model->get_picid_array() );
                    }
                    else
                    {
                        $toppicid_array = $this->pic_list_model->get_picid_array();
                    }
                }
                
                $this->load->model('brand_model');
                $this->brand_model->construct( array('brandid' => $brandid, 'title' => $title, 'href' => $href, 'classid_array' => $classid_array, 'picid_array' => $picid_array, 'toppicid_array' => $toppicid_array, 'content' => $content, 'prioritynum' => $prioritynum) );
                
                $this->brand_model->update();

                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定成功',
                     'url' => 'admin/brand/brandlist'
                ));
            }
            else
            {
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定失敗',
                    'url' => 'admin/brand/brandlist'
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
            
            $this->load->model('brand_model');
            if( !empty($brandid) )
            {
                $this->brand_model->db_construct( array('db_where' => array('brandid' => $brandid) ) );
            }
            $data['brand'] = $this->brand_model->get_array();
            
            $this->load->model('class_list_model');
            $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'brand') ) );
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
	
	public function brandlist($input = '')
	{
		global $admin;
        $data = $this->data;
        $child_name = 'brandlist';//管理分類類別名稱
		
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
                     'url' => 'admin/brand/brandlist'
                ));
			}
			else
			{
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定失敗',
                     'url' => 'admin/brand/brandlist'
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
            
            $this->load->model('brand_list_model');
            $this->brand_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid']) ) );
            $data['brand_list'] = $this->brand_list_model->get_array();
				
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
    
	public function postclass($do = '', $classid = 0)
	{
		global $admin;
        $data = $this->data;
        $child_name = 'postclass';//管理分類類別名稱
        
		if($do == 'post')
        {
            $this->form_validation->set_rules('classname', 'classname', 'required');

            if ($this->form_validation->run() !== FALSE)
            {
                $classid = $this->input->post('classid', TRUE);
                $classname = $this->input->post('classname', TRUE);
                $slug = $this->input->post('slug', TRUE);
                
                $this->load->model('class_model');
                $this->class_model->construct( array('classid' => $classid, 'classname' => $classname, 'slug' => $slug, 'modelname' => 'brand') );
                $this->class_model->update();

                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定成功',
                    'url' => 'admin/brand/classlist'
                ));
            }
            else
            {
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定失敗',
                    'url' => 'admin/brand/classlist'
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
            
            $uid = $this->session->userdata('uid');
            
            if($do == 'edit' && $classid !== 0)
            {
                $this->load->model('class_model');
                $this->class_model->db_construct( array('db_where' => array('classid' => $classid) ) );
                $data['class'] = $this->class_model->get_array();
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
				
			//output
			$this->load->view('admin/'.$this->father_name.'_'.$child_name, $data);
		}
	}
    
	public function classlist($input = '')
	{
		global $admin;
        $data = $this->data;
        $child_name = 'classlist';//管理分類類別名稱
		
		if($input == 'post')
        {
			$this->form_validation->set_rules('classid', 'classid', 'required');
			$this->form_validation->set_rules('classname', 'classname', 'required');
			$this->form_validation->set_rules('slug', '標籤代號', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
				$this->admin_brand_model->addbrand_post();
				
				$message = '設定成功';
				$url = 'admin/brand/addbrand';
				
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/brand/addbrand';
					
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
		}
		else
		{
			
			//沒有這個頁面
			if ( ! file_exists('app/views/admin/'.$this->father_name.'_'.$child_name.'.php'))
			{
				show_404();
			}
            
            $uid = $this->session->userdata('uid');
            
            $this->load->model('class_list_model');
            $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'brand') ) );
            $data['class_list'] = $this->class_list_model->get_array();
				
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
	
    public function delete_brand($brandid = 0, $hash = '')
    {
        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $this->load->model('brand_model');
            $this->brand_model->construct( array('brandid' => $brandid) );
            $this->brand_model->hidden();

            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除成功',
                'url' => 'admin/brand/brandlist'
            ));
        }
        else
        {
            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除失敗',
                'url' => 'admin/brand/brandlist'
            ));
        }
    }
	
    public function delete_class($classid = 0, $hash = '')
    {
        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $this->load->model('class_model');
            $this->class_model->construct( array('classid' => $classid) );
            $this->class_model->hidden();

            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除成功',
                'url' => 'admin/brand/classlist'
            ));
        }
        else
        {
            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除失敗',
                'url' => 'admin/brand/classlist'
            ));
        }
    }
	
	public function set($input = '')
	{
		global $admin;
        $data = $this->data;
        $child_name = 'set';//管理分類類別名稱
		
		if($input == 'post')
        {
			$this->form_validation->set_rules('brand_order', '文章顯示排序', 'required');
			$this->form_validation->set_rules('brand_amount', '文章顯示數量', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $brand_order = $this->input->post('brand_order', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'brand_order', 'value' => $brand_order, 'status' => 2) );
				$this->setting_model->update();
                
                $brand_amount = $this->input->post('brand_amount', TRUE);
                $this->setting_model->construct( array('keyword' => 'brand_amount', 'value' => $brand_amount, 'status' => 2) );
				$this->setting_model->update();
                
				$message = '設定成功';
				$url = 'admin/brand/set';
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/brand/set';
			}
            $this->load->model('message_model');
            $this->message_model->show(array('message' => $message, 'url' => $url));
		}
		else
		{
			
			//沒有這個頁面
			if ( ! file_exists('app/views/admin/'.$this->father_name.'_'.$child_name.'.php'))
			{
				show_404();
			}
            
            $this->load->model('setting_list_model');
            $this->setting_list_model->db_construct( array('keyword' => array('brand_order', 'brand_amount') ) );
            $data['setting_list_array'] = $this->setting_list_model->get_array();
				
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
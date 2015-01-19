<?php
		
class Pic extends CI_Controller {

    private $data = array();
	private $father_name = 'pic';//管理分類名稱
    
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
        $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	
	public function postpic($do = '', $picid = 0)
	{
		global $admin;
        $data = $this->data;
        $child_name = 'postpic';//管理分類類別名稱
		
		if($do == 'post')
        {
            $userfile = !empty($_FILES['userfile']) ? $_FILES['userfile'] : array();
            if(!empty($userfile))
            {
                $this->load->model('pic_model');
                $this->pic_model->construct( array('file' => $userfile, 'thumb' => 'w50h50,w300h300') );
                $this->pic_model->upload();
                $picid = $this->pic_model->get_picid();
            }
            
            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '設定成功',
                'url' => 'admin/pic/piclist'
            ));
		}
		else
		{
			//沒有這個頁面
			if ( ! file_exists('app/views/admin/'.$this->father_name.'_'.$child_name.'.php'))
			{
				show_404();
			}
            
            if(empty($picid) === FALSE)
            {
                $this->load->model('pic_model');
                $this->pic_model->db_construct( array('db_where' => array('picid' => $picid) ) );
                $data['pic'] = $this->pic_model->get_array();
            }
            
            $data['error'] = '';
            
            $this->load->model('class_list_model');
            $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'pic') ) );
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
	
	public function piclist($input = '')
	{
		global $admin;
        $data = $this->data;
        $child_name = 'piclist';//管理分類類別名稱
		
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
                     'url' => 'admin/pic/piclist'
                ));
			}
			else
			{
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定失敗',
                     'url' => 'admin/pic/piclist'
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
            
            $this->load->model('pic_list_model');
            $this->pic_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid']) ) );
            $data['pic_list'] = $this->pic_list_model->get_array();
				
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
                $this->class_model->construct( array('classid' => $classid, 'classname' => $classname, 'slug' => $slug, 'modelname' => 'pic') );
                $this->class_model->update();

                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定成功',
                    'url' => 'admin/pic/classlist'
                ));
            }
            else
            {
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定失敗',
                    'url' => 'admin/pic/classlist'
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
				$this->admin_pic_model->addpic_post();
				
				$message = '設定成功';
				$url = 'admin/pic/classlist';
				
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/pic/classlist';
					
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
            $this->class_list_model->db_construct( array('db_where' => array('modelname' => 'pic') ) );
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
	
    public function delete_pic($picid = 0, $hash = '')
    {
        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $this->load->model('pic_model');
            $this->pic_model->construct( array('picid' => $picid) );
            $this->pic_model->hidden();

            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除成功',
                'url' => 'admin/pic/piclist'
            ));
        }
        else
        {
            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除失敗',
                'url' => 'admin/pic/piclist'
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
                'url' => 'admin/pic/classlist'
            ));
        }
        else
        {
            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除失敗',
                'url' => 'admin/pic/classlist'
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
			$this->form_validation->set_rules('pic_order', '文章顯示排序', 'required');
			$this->form_validation->set_rules('pic_amount', '文章顯示數量', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $pic_order = $this->input->post('pic_order', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'pic_order', 'value' => $pic_order, 'status' => 2) );
				$this->setting_model->update();
                
                $pic_amount = $this->input->post('pic_amount', TRUE);
                $this->setting_model->construct( array('keyword' => 'pic_amount', 'value' => $pic_amount, 'status' => 2) );
				$this->setting_model->update();
                
				$message = '設定成功';
				$url = 'admin/pic/set';
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/pic/set';
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
            $this->setting_list_model->db_construct( array('keyword' => array('pic_order', 'pic_amount') ) );
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
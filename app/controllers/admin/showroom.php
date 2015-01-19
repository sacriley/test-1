<?php
		
class Showroom extends CI_Controller {

    private $data = array();
	private $father_name = 'showroom';//管理分類名稱
    
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
	
	public function postshowroom($do = '', $showroomid = 0)
	{
		global $admin;
        $data = $this->data;
        $child_name = 'postshowroom';//管理分類類別名稱
		
		if($do == 'post')
        {
            $this->form_validation->set_rules('title', '文章標題', 'required');
            $this->form_validation->set_rules('content', '文章內容', 'required');
				
            if ($this->form_validation->run() !== FALSE)
            {
                $showroomid = $this->input->post('showroomid', TRUE);
                $title = $this->input->post('title', TRUE);
                $text = $this->input->post('text', TRUE);
                $styleclassid_array = $this->input->post('styleclassid_array', TRUE);
                $roomclassid_array = $this->input->post('roomclassid_array', TRUE);
                $content = $this->input->post('content', TRUE);
                $prioritynum = $this->input->post('prioritynum', TRUE);
                
                $picid_array = $this->input->post('picid_array', TRUE);
                $picid_file = !empty($_FILES['picid_file']) ? $_FILES['picid_file'] : array();
                if( !empty($picid_file['name'][0]) )
                {
                    $this->load->model('pic_list_model');
                    $this->pic_list_model->construct( array('file_array' => $picid_file, 'thumb' => 'w50h50,w300h300') );
                    $this->pic_list_model->upload();
                    $picid_array = array_merge($picid_array,$this->pic_list_model->get_picid_array() );
                }
                
                $this->load->model('showroom_model');
                $this->showroom_model->construct( array('showroomid' => $showroomid, 'uid' => $data['user']['uid'], 'title' => $title, 'text' => $text, 'picid_array' => $picid_array, 'styleclassid_array' => $styleclassid_array, 'roomclassid_array' => $roomclassid_array, 'content' => $content, 'prioritynum' => $prioritynum) );
                
                $this->showroom_model->update();

				$message = '設定成功';
            }
            else
            {
				$message = '設定失敗';
            }

            $url = 'admin/showroom/showroomlist';
				
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
            
            $this->load->model('showroom_model');
            if(isset($showroomid) === FALSE || $showroomid !== 0)
            {
                $this->showroom_model->db_construct( array('db_where' => array('showroomid' => $showroomid) ) );
            }
            $data['showroom'] = $this->showroom_model->get_array();
            
            $this->load->model('class_list_model');
            $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'showroom_roomclass') ) );
            $data['roomclass_list_array'] = $this->class_list_model->get_array();
            $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'showroom_styleclass') ) );
            $data['styleclass_list_array'] = $this->class_list_model->get_array();
				
			//view data設定
			$data['admin_sidebox'] = reset_admin_sidebox($this->father_name, $child_name);
			$data['child_name'] = $child_name;
            
            //global
			$data['global']['style'][] = 'admin';
			$data['global']['js'][] = 'script_common';
            $data['global']['script_meta'] = js_console_log($data);
            
            //temp
			$data['temp']['header_up'] = $this->load->view('temp/header_up', $data, TRUE);
			$data['temp']['admin_header_down'] = $this->load->view('admin/admin_header_down', $data, TRUE);
			$data['temp']['admin_footer'] = $this->load->view('admin/admin_footer', $data, TRUE);
				
			//輸出模板
			$this->load->view('admin/'.$this->father_name.'_'.$child_name, $data);
		}
	}
	
	public function showroomlist($input = '')
	{
		global $admin;
        $data = $this->data;
        $child_name = 'showroomlist';//管理分類類別名稱
		
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
                     'url' => 'admin/showroom/showroomlist'
                ));
			}
			else
			{
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定失敗',
                     'url' => 'admin/showroom/showroomlist'
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
            
            $this->load->model('showroom_list_model');
            $this->showroom_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid']) ) );
            $data['showroom_list'] = $this->showroom_list_model->get_array();
            
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
//            js_console_log($data);
		}
	}
    
	public function poststyleclass($do = '', $classid = 0)
	{
		global $admin;
        $data = $this->data;
        $child_name = 'poststyleclass';//管理分類類別名稱
        
		if($do == 'post')
        {
            $this->form_validation->set_rules('classname', 'classname', 'required');

            if ($this->form_validation->run() !== FALSE)
            {
                $classid = $this->input->post('classid', TRUE);
                $classname = $this->input->post('classname', TRUE);
                $slug = $this->input->post('slug', TRUE);
                
                $this->load->model('class_model');
                $this->class_model->construct( array('classid' => $classid, 'classname' => $classname, 'slug' => $slug, 'modelname' => 'showroom_styleclass') );
                $this->class_model->update();

                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定成功',
                    'url' => 'admin/showroom/styleclasslist'
                ));
            }
            else
            {
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定失敗',
                    'url' => 'admin/showroom/styleclasslist'
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
    
	public function styleclasslist($input = '')
	{
		global $admin;
        $data = $this->data;
        $child_name = 'styleclasslist';//管理分類類別名稱
		
		if($input == 'post')
        {
			$this->form_validation->set_rules('classid', 'classid', 'required');
			$this->form_validation->set_rules('classname', 'classname', 'required');
			$this->form_validation->set_rules('slug', '標籤代號', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
				$this->admin_note_model->addnote_post();
				
				$message = '設定成功';
				$url = 'admin/note/addnote';
				
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/note/addnote';
					
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
            $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'showroom_styleclass') ) );
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
    
	public function postroomclass($do = '', $classid = 0)
	{
		global $admin;
        $data = $this->data;
        $child_name = 'postroomclass';//管理分類類別名稱
        
		if($do == 'post')
        {
            $this->form_validation->set_rules('classname', 'classname', 'required');

            if ($this->form_validation->run() !== FALSE)
            {
                $classid = $this->input->post('classid', TRUE);
                $classname = $this->input->post('classname', TRUE);
                $slug = $this->input->post('slug', TRUE);
                
                $this->load->model('class_model');
                $this->class_model->construct( array('classid' => $classid, 'classname' => $classname, 'slug' => $slug, 'modelname' => 'showroom_roomclass') );
                $this->class_model->update();

                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定成功',
                    'url' => 'admin/showroom/roomclasslist'
                ));
            }
            else
            {
                $this->load->model('message_model');
                $this->message_model->show(array(
                    'message' => '設定失敗',
                    'url' => 'admin/showroom/roomclasslist'
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
                $this->class_model->db_construct( array('db_where' => array('classid' => $classid, 'modelname' => 'showroom_roomclass') ) );
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
    
	public function roomclasslist($input = '')
	{
		global $admin;
        $data = $this->data;
        $child_name = 'roomclasslist';//管理分類類別名稱
		
		if($input == 'post')
        {
			$this->form_validation->set_rules('classid', 'classid', 'required');
			$this->form_validation->set_rules('classname', 'classname', 'required');
			$this->form_validation->set_rules('slug', '標籤代號', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
				$this->admin_note_model->addnote_post();
				
				$message = '設定成功';
				$url = 'admin/note/addnote';
				
				$this->load->model('message_model');
				$this->message_model->show(array('message' => $message, 'url' => $url));
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/note/addnote';
					
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
            $this->class_list_model->db_construct( array('db_where' => array('uid' => $data['user']['uid'], 'modelname' => 'showroom_roomclass') ) );
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
	
    public function delete_showroom($showroomid = 0, $hash = '')
    {
        //CSRF過濾
        if($hash == $this->security->get_csrf_hash())
        {
            $this->load->model('showroom_model');
            $this->showroom_model->construct( array('showroomid' => $showroomid) );
            $this->showroom_model->hidden();

            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除成功',
                'url' => 'admin/showroom/showroomlist'
            ));
        }
        else
        {
            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除失敗',
                'url' => 'admin/showroom/showroomlist'
            ));
        }
    }
	
    public function delete_styleclass($classid = 0, $hash = '')
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
                'url' => 'admin/showroom/styleclasslist'
            ));
        }
        else
        {
            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除失敗',
                'url' => 'admin/showroom/styleclasslist'
            ));
        }
    }
	
    public function delete_roomclass($classid = 0, $hash = '')
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
                'url' => 'admin/showroom/roomclasslist'
            ));
        }
        else
        {
            $this->load->model('message_model');
            $this->message_model->show(array(
                'message' => '刪除失敗',
                'url' => 'admin/showroom/roomclasslist'
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
			$this->form_validation->set_rules('note_order', '文章顯示排序', 'required');
			$this->form_validation->set_rules('note_amount', '文章顯示數量', 'required');
				
			if ($this->form_validation->run() !== FALSE)
			{
                $note_order = $this->input->post('note_order', TRUE);
                $this->load->model('setting_model');
                $this->setting_model->construct( array('keyword' => 'note_order', 'value' => $note_order, 'status' => 2) );
				$this->setting_model->update();
                
                $note_amount = $this->input->post('note_amount', TRUE);
                $this->setting_model->construct( array('keyword' => 'note_amount', 'value' => $note_amount, 'status' => 2) );
				$this->setting_model->update();
                
				$message = '設定成功';
				$url = 'admin/note/set';
			}
			else
			{
				$message = '設定失敗';
				$url = 'admin/note/set';
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
            $this->setting_list_model->db_construct( array('keyword' => array('note_order', 'note_amount') ) );
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
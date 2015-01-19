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
	
	public function delete_pic($do, $picid = 0)
	{
		global $admin;
        $data = $this->data;
        $child_name = 'postpic';//管理分類類別名稱
		
		if( !empty($picid) )
        {
            $this->load->model('Pic_model');
            $this->Pic_model->construct(array('picid' => $picid));
            $this->Pic_model->hidden();
            return TRUE;
		}
        else
        {
            return FALSE;
        }
	}
    
}

?>
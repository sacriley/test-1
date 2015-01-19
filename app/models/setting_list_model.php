<?php
class Setting_list_model extends CI_Model {

    private $setting_list = array();
    private $setting_list_array = array();
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('setting_array' => array() ) )
	{
        $setting_list = array();
        $setting_list_array = array();
        
        $setting_array = $arg['setting_array'];
        foreach($setting_array as $key => $value)
        {
            $Setting = new CI_Model();
            $Setting->load->model('setting_model');
            $Setting->setting_model->construct(array(
                'keyword' => $value['keyword'],
                'value' => $value['value'],
                'modelname' => $value['modelname'],
                'status' => $value['status']
            ));
            $setting_array = $Setting->setting_model->get_array();
            $this->setting_list[] = $Setting;
            $this->setting_list_array[$value['keyword']] = $value['value'];
        }
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array(), 'keyword' => array() ) )
    {
        $db_where = empty($arg['db_where']) ? array() : $arg['db_where'];
        $keyword = empty($arg['keyword']) ? array() : $arg['keyword'];
        if( empty($db_where['status']) )
        {
            $db_where['status'] = 1;
        }
        
		$this->db->from('setting');
        if(empty($keyword))
        {
            $this->db->where($db_where);
        }
        else if(empty($keyword) == FALSE && is_array($keyword))
        {
            foreach($keyword as $key => $value)
            {
                $this->db->or_where( array('keyword' => $value) );
            }
        }
		$query = $this->db->get();
		$setting_list = $query->result_array();
        
        $this->construct(array(
            'setting_array' => $setting_list
        ));
    }
    
	public function get_array()
	{
        $setting_list_array = $this->setting_list_array;
		return $setting_list_array;
	}
	
}
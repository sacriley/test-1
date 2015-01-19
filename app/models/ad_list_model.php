<?php
class Ad_list_model extends CI_Model {

    private $ad_list_model = array();
    private $ad_list_array = array();
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('ad_array' => array() ) )
	{
        $ad_list_model = array();
        $ad_list_array = array();
        
        $ad_array = $arg['ad_array'];
        foreach($ad_array as $key => $value)
        {
            $ad = new CI_Model();
            $model_name = 'ad_model'.$key;
            $ad->load->model('ad_model', $model_name);
            $ad->$model_name->construct(array(
                'adid' => $value['adid'],
                'uid' => $value['uid'],
                'title' => $value['title'],
                'href' => $value['href'],
                'picid' => $value['picid'],
                'content' => $value['content'],
                'classid' => $value['classid'],
                'prioritynum' => $value['prioritynum'],
                'status' => $value['status']
            ));
            $ad_array = $ad->$model_name->get_array();
            $this->ad_list_model[] = $ad->$model_name;
            $this->ad_list_array[] = $ad_array;
        }
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array() ) )
    {
        $db_where = !empty($arg['db_where']) ? $arg['db_where'] : array();
        if(empty($db_where['status']) == TRUE)
        {
            $db_where['status'] = 1;
        }
        
		$this->db->from('ad');
		$this->db->where($db_where);
		$query = $this->db->get();
		$ad_list_model = $query->result_array();
        
        $this->construct(array(
            'ad_array' => $ad_list_model
        ));
    }
    
	public function get_array()
	{
        $ad_list_array = $this->ad_list_array;
		return $ad_list_array;
	}
	
}
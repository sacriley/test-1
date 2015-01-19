<?php
class Brand_list_model extends CI_Model {

    private $brand_list = array();
    private $brand_list_array = array();
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('brand_array' => array() ) )
	{
        $brand_list = array();
        $brand_list_array = array();
        
        $brand_array = $arg['brand_array'];
        foreach($brand_array as $key => $value)
        {
            $Brand = new CI_Model();
            $Brand->load->model('brand_model');
            $Brand->brand_model->construct(array(
                'brandid' => $value['brandid'],
                'uid' => $value['uid'],
                'title' => $value['title'],
                'href' => $value['href'],
                'picid' => $value['picid'],
                'toppicid' => $value['toppicid'],
                'content' => $value['content'],
                'classid' => $value['classid'],
                'prioritynum' => $value['prioritynum'],
                'status' => $value['status']
            ));
            $brand_array = $Brand->brand_model->get_array();
            $this->brand_list[] = $Brand;
            $this->brand_list_array[] = $brand_array;
        }
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array() ) )
    {
        $db_where2 = isset($arg['db_where']) ? $arg['db_where'] : array();
        if(empty($db_where2['status']) == TRUE)
        {
            $db_where['status'] = 1;
        }
        
		$this->db->from('brand');
		$this->db->where($db_where);
		$query = $this->db->get();
		$brand_list = $query->result_array();
        
        $this->construct(array(
            'brand_array' => $brand_list
        ));
    }
    
	public function get_array()
	{
        $brand_list_array = $this->brand_list_array;
		return $brand_list_array;
	}
	
}
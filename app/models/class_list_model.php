<?php
class Class_list_model extends CI_Model {

    private $class_list = array();
    private $class_list_array = array();
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('class_array' => array() ) )
	{
        $this->class_list = array();
        $this->class_list_array = array();
        $class_list = array();
        $class_list_array = array();
        
        $class_array = $arg['class_array'];
        foreach($class_array as $key => $value)
        {
            $Class = new CI_Model();
            $Class->load->model('class_model');
            $Class->class_model->construct(array(
                'classid' => $value['classid'],
                'uid' => $value['uid'],
                'classname' => $value['classname'],
                'slug' => $value['slug'],
                'modelname' => $value['modelname'],
                'amountnum' => $value['amountnum'],
                'updatetime' => $value['updatetime'],
                'status' => $value['status']
            ));
            $class_array = $Class->class_model->get_array();
            $this->class_list[] = $Class;
            $this->class_list_array[] = $class_array;
        }
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array() ) )
    {
        $db_where = isset($arg['db_where']) ? $arg['db_where'] : array();
        if(isset($db_where['status']) == FALSE )
        {
            $db_where['status'] = 1;
        }
        
		$this->db->from('class');
		$this->db->where($db_where);
		$query = $this->db->get();
		$class_list = $query->result_array();
        
        $this->construct(array(
            'class_array' => $class_list
        ));
    }
    
	public function get_array()
	{
        $class_list_array = $this->class_list_array;
		return $class_list_array;
	}
	
}
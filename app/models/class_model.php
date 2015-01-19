<?php
class Class_model extends CI_Model {

    private $classid = 0;
    private $classname = '';
    private $slug = '';
    private $uid = 0;
    private $modelname = '';
    private $amountnum = 0;
    private $updatetime = 0;
    private $status = 1;
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('classid' => 0, 'uid' => 0, 'classname' => '', 'slug' => '', 'amountnum' => 0, 'updatetime' => 0, 'modelname' => '', 'status' => 0))
	{
        $data = $this->data;
            
        $classid = isset($arg['classid']) ? $arg['classid'] : 0;
        $uid = isset($arg['uid']) ? $arg['uid'] : 0;
        $classname = isset($arg['classname']) ? $arg['classname'] : '';
        $slug = isset($arg['slug']) ? $arg['slug'] : '';
        $modelname = empty($arg['modelname']) ? '' : $arg['modelname'];
        $amountnum = isset($arg['amountnum']) && $arg['amountnum'] != 0 ? $arg['amountnum'] : 0;
        $updatetime = isset($arg['updatetime']) ? $arg['updatetime'] : 0;
        $status = isset($arg['status']) ? $arg['status'] : 1;
        
        //uid
        if(empty($uid))
        {
            $uid = $data['user']['uid'];
        }
        
        if(empty($slug))
        {
            $slug = $classid;
        }
        
        //set
        $this->classid = $classid;
        $this->uid = $uid;
        $this->classname = $classname;
        $this->slug = $slug;
        $this->amountnum = $amountnum;
        $this->modelname = $modelname;
        $this->updatetime = $updatetime;
        $this->status = $status;
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array() ) )
    {
        $db_where = isset($arg['db_where']) ? $arg['db_where'] : array();
        
		$this->db->from('class');
		$this->db->where($db_where);
		$query = $this->db->get();
		$class_array = $query->row_array();
        
        $this->construct(array(
            'classid' => $class_array['classid'],
            'uid' => $class_array['uid'],
            'classname' => $class_array['classname'],
            'slug' => $class_array['slug'],
            'modelname' => $class_array['modelname'],
            'amountnum' => $class_array['amountnum'],
            'updatetime' => $class_array['updatetime'],
            'status' => $class_array['status']
        ));
    }
    
	public function get_array()
	{
        $class['classid'] = $this->classid;
        $class['uid'] = $this->uid;
        $class['classname'] = $this->classname;
        $class['slug'] = $this->slug;
        $class['modelname'] = $this->modelname;
        $class['amountnum'] = $this->amountnum;
        $class['updatetime'] = $this->updatetime;
        $class['status'] = $this->status;
        
		return $class;
	}
    
	public function update()
	{
        $class_array2 = $this->get_array();
        
        if( isset($class_array2['classid']) && $class_array2['classid'] == 0 )
        {
            $class_array2['classid'] = $this->common_model->db_search_max( array('table_name' => 'class', 'id_name' => 'classid') ) + 1;
            $class_array = array(
                'classid' => $class_array2['classid'],
                'uid' => $class_array2['uid'],
                'classname' => $class_array2['classname'],
                'slug' => $class_array2['slug'],
                'modelname' => $class_array2['modelname'],
                'amountnum' => $class_array2['amountnum'],
                'updatetime' => $class_array2['updatetime'],
                'status' => $class_array2['status']
            );
            
            $this->db->insert('class', $class_array); 
        }
        else
        {
            $class_array = array(
                'classid' => $class_array2['classid'],
                'uid' => $class_array2['uid'],
                'classname' => $class_array2['classname'],
                'slug' => $class_array2['slug'],
                'modelname' => $class_array2['modelname'],
                'amountnum' => $class_array2['amountnum'],
                'updatetime' => $class_array2['updatetime'],
                'status' => $class_array2['status']
            );
            
            $this->db->where(array('classid' => $class_array['classid']));
            $this->db->update('class', $class_array);
        }
    }
    
    public function hidden()
    {
        $class_array = $this->get_array();

        $this->db->where( array('classid' => $class_array['classid'] ) );
        $this->db->update('class', array('status' => 0) ); 
    }
	
}
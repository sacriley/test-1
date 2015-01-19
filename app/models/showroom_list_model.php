<?php
class Showroom_list_model extends CI_Model {

    private $showroom_list = array();
    private $showroom_list_array = array();
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('showroom_array' => array() ) )
	{
        $showroom_list = array();
        $showroom_list_array = array();
        
        $showroom_array = $arg['showroom_array'];
        foreach($showroom_array as $key => $value)
        {
            $Showroom = new CI_Model();
            $model_name = 'showroom_model'.rand(0,32767);
            $Showroom->load->model('showroom_model', $model_name);
            $this->showroom_list[] = $Showroom->$model_name;
            $this->showroom_list[$key]->construct(array(
                'showroomid' => $value['showroomid'],
                'uid' => $value['uid'],
                'title' => $value['title'],
                'text' => $value['text'],
                'picid' => $value['picid'],
                'content' => $value['content'],
                'styleclassid' => $value['styleclassid'],
                'roomclassid' => $value['roomclassid'],
                'prioritynum' => $value['prioritynum'],
                'status' => $value['status']
            ));
            $showroom_array = $this->showroom_list[$key]->get_array();
            $this->showroom_list_array[] = $showroom_array;
        }
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array(), 'styleclassid' => 0, 'roomclassid' => 0 ) )
    {
        $db_where = !empty($arg['db_where']) ? $arg['db_where'] : array();
        $styleclassid = !empty($arg['styleclassid']) ? $arg['styleclassid'] : 0;
        $roomclassid = !empty($arg['roomclassid']) ? $arg['roomclassid'] : 0;
        
        if(empty($db_where['status']) == TRUE)
        {
            $db_where['status'] = 1;
        }
        
        $this->db->from('showroom');
        if(!empty($styleclassid) || !empty($roomclassid))
        {
            if(!empty($styleclassid))
            {
                $this->db->where("FIND_IN_SET('$styleclassid', styleclassid) !=", 0);
            }
            if(!empty($roomclassid))
            {
                $this->db->where("FIND_IN_SET('$roomclassid', roomclassid) !=", 0);
            }
        }
        else
        {
            $this->db->where($db_where);
        }
        $query = $this->db->get();
        $showroom_list = $query->result_array();
        
        $this->construct(array(
            'showroom_array' => $showroom_list
        ));
    }
    
	public function get_array()
	{
        $showroom_list_array = $this->showroom_list_array;
		return $showroom_list_array;
	}
	
}
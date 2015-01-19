<?php
class Showroom_model extends CI_Model {

    private $showroomid = 0;
    private $uid = 0;
    private $title = '';
    private $text = '';
    private $content = '';
    private $content_html = '';
    private $styleclassid = '';
    private $styleclassid_array = array();
    private $roomclassid = '';
    private $roomclassid_array = array();
    private $picid = '';
    private $piclist_array = array();
    private $prioritynum = 0;
    private $status = 1;
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('showroomid' => 0, 'text' => '', 'title' => '', 'picid' => '', 'picid_array' => array(), 'content' => '', 'styleclassid' => '', 'styleclassid_array' => array(), 'roomclassid' => '', 'roomclassid_array' => array(), 'prioritynum' => 0, 'status' => 1))
	{
        $data = $this->data;
        
        $showroomid = empty($arg['showroomid']) ? 0 : $arg['showroomid'];
        $title = empty($arg['title']) ? '' : $arg['title'];
        $text = empty($arg['text']) ? '' : $arg['text'];
        $uid = empty($arg['uid']) ? '' : $arg['uid'];
        $picid = empty($arg['picid']) ? '' : $arg['picid'];
        $picid_array = empty($arg['picid_array']) ? array() : $arg['picid_array'];
        $content = empty($arg['content']) ? '' : $arg['content'];
        $styleclassid = empty($arg['styleclassid']) ? '' : $arg['styleclassid'];
        $styleclassid_array = empty($arg['styleclassid_array']) ? array() : $arg['styleclassid_array'];
        $roomclassid = empty($arg['roomclassid']) ? '' : $arg['roomclassid'];
        $roomclassid_array = empty($arg['roomclassid_array']) ? array() : $arg['roomclassid_array'];
        $prioritynum = empty($arg['prioritynum']) ? 0 : $arg['prioritynum'];
        $status = empty($arg['status']) ? 1 : $arg['status'];
        
        //classid運算
        if(empty($styleclassid) == FALSE)
        {
            $styleclassid_array = explode(',', $styleclassid);
        }
        
        $styleclassid_array2 = $styleclassid_array;
        $styleclassid_set_array = array();
        foreach($styleclassid_array2 as $key => $value)
        {
            if($value == 0 || in_array($value, $styleclassid_set_array) )
            {
                unset($styleclassid_array[$key]);
            }
            $styleclassid_set_array[] = $value;
        }
        $styleclassid = implode(',', $styleclassid_array);
        $styleclassid_array = explode(',', $styleclassid);
        
        //過濾重複id
        if(empty($roomclassid) == FALSE)
        {
            $roomclassid_array = explode(',', $roomclassid);
        }
        
        $roomclassid_array2 = $roomclassid_array;
        $roomclassid_set_array = array();
        foreach($roomclassid_array2 as $key => $value)
        {
            if($value == 0 || in_array($value, $roomclassid_set_array))
            {
                unset($roomclassid_array[$key]);
            }
            $roomclassid_set_array[] = $value;
        }
        $roomclassid = implode(',', $roomclassid_array);
        $roomclassid_array = explode(',', $roomclassid);
        
        //picid運算
        if(!empty($picid))
        {
            $picid_array = explode(',', $picid);
        }
        
        $picid_array2 = $picid_array;
        $picid_set_array = array();
        foreach($picid_array2 as $key => $value)//運算重複的ID
        {
            if($value == 0 || in_array($value, $picid_set_array) )
            {
                unset($picid_array[$key]);
            }
            $picid_set_array[] = $value;
        }
        if(is_array($picid_array))
        {
            $picid = implode(',', $picid_array);
        }
        
        //picid
        $model_name = 'pic_list_model'.rand(0,32767);
        $this->load->model('pic_list_model', $model_name);
        $this->$model_name->db_construct( array('picid' => $picid ) );
        $piclist_array = $this->$model_name->get_array();
        
        //content_html
        $content_html = html_code_replace(array('text' => $content, 'nl2br' => TRUE));
        
        //set
        $this->showroomid = $showroomid;
        $this->title = $title;
        $this->text = $text;
        $this->picid = $picid;
        $this->piclist_array = $piclist_array;
        $this->uid = $uid;
        $this->content = $content;
        $this->content_html = $content_html;
        $this->styleclassid = $styleclassid;
        $this->styleclassid_array = $styleclassid_array;
        $this->roomclassid = $roomclassid;
        $this->roomclassid_array = $roomclassid_array;
        $this->prioritynum = $prioritynum;
        $this->status = $status;
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array(), 'roomclassid' => 0, 'styleclassid' => 0 ) )
    {
        $db_where = !empty($arg['db_where']) ? $arg['db_where'] : array();
        $roomclassid = !empty($arg['roomclassid']) ? $arg['roomclassid'] : 0;
        $styleclassid = !empty($arg['styleclassid']) ? $arg['styleclassid'] : 0;
        
		$this->db->from('showroom');
        if(!empty($roomclassid) || !empty($styleclassid))
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
		$showroom = $query->row_array();
        
        if(!empty($showroom))
        {
            $this->construct(array(
                'showroomid' => $showroom['showroomid'],
                'uid' => $showroom['uid'],
                'title' => $showroom['title'],
                'text' => $showroom['text'],
                'picid' => $showroom['picid'],
                'content' => $showroom['content'],
                'styleclassid' => $showroom['styleclassid'],
                'roomclassid' => $showroom['roomclassid'],
                'prioritynum' => $showroom['prioritynum'],
                'status' => $showroom['status']
            ));
        }
        else
        {
            return FALSE;
        }
    }
    
	public function get_array()
	{
        $showroom['showroomid'] = $this->showroomid;
        $showroom['title'] = $this->title;
        $showroom['text'] = $this->text;
        $showroom['picid'] = $this->picid;
        $showroom['piclist_array'] = $this->piclist_array;
        $showroom['uid'] = $this->uid;
        $showroom['content'] = $this->content;
        $showroom['content_html'] = $this->content_html;
        $showroom['styleclassid'] = $this->styleclassid;
        $showroom['styleclassid_array'] = $this->styleclassid_array;
        $showroom['roomclassid'] = $this->roomclassid;
        $showroom['roomclassid_array'] = $this->roomclassid_array;
        $showroom['prioritynum'] = $this->prioritynum;
        $showroom['status'] = $this->status;
        
		return $showroom;
	}
    
	public function update()
	{
        $showroom2 = $this->get_array();
        
        if( empty($showroom2['showroomid']) )
        {
            $showroom2['showroomid'] = $this->common_model->db_search_max( array('table_name' => 'showroom', 'id_name' => 'showroomid') ) + 1;
            $showroom = array(
                'showroomid' => $showroom2['showroomid'],
                'title' => $showroom2['title'],
                'text' => $showroom2['text'],
                'content' => $showroom2['content'],
                'picid' => $showroom2['picid'],
                'uid' => $showroom2['uid'],
                'styleclassid' => $showroom2['styleclassid'],
                'roomclassid' => $showroom2['roomclassid'],
                'prioritynum' => $showroom2['prioritynum'],
                'status' => $showroom2['status']
            );
            
            $this->db->insert('showroom', $showroom);
        }
        else
        {
            $showroom = array(
                'showroomid' => $showroom2['showroomid'],
                'title' => $showroom2['title'],
                'text' => $showroom2['text'],
                'content' => $showroom2['content'],
                'picid' => $showroom2['picid'],
                'uid' => $showroom2['uid'],
                'styleclassid' => $showroom2['styleclassid'],
                'roomclassid' => $showroom2['roomclassid'],
                'prioritynum' => $showroom2['prioritynum'],
                'status' => $showroom2['status']
            );
            
            $this->db->where(array('showroomid' => $showroom['showroomid']));
            $this->db->update('showroom', $showroom);
        }
    }
    
    public function hidden()
    {
        $showroom_array = $this->get_array();

        $this->db->where( array('showroomid' => $showroom_array['showroomid'] ) );
        $this->db->update('showroom', array('status' => 0) ); 
    }
	
}
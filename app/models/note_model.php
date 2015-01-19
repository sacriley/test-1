<?php
class Note_model extends CI_Model {

    private $noteid = 0;
    private $username = '';
    private $title = '';
    private $uid = 0;
    private $pic = '';
    private $content = '';
    private $content_html = '';
    private $classid = '';
    private $classid_array = array();
    private $modelname = '';
    private $viewnum = 0;
    private $replynum = 0;
    private $prioritynum = 0;
    private $updatetime = 0;
    private $status = 1;
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('noteid' => 0, 'uid' => 0, 'username' => '', 'title' => '', 'modelname' => '', 'pic' => '', 'content' => '', 'classid' => '', 'classid_array' => array(), 'viewnum' => 0, 'replynum' => 0, 'prioritynum' => 0, 'updatetime' => 0, 'status' => 0))
	{
        $data = $this->data;
        
        $noteid = isset($arg['noteid']) ? $arg['noteid'] : 0;
        $uid = isset($arg['uid']) ? $arg['uid'] : 0;
        $username = isset($arg['username']) ? $arg['username'] : '';
        $title = isset($arg['title']) ? $arg['title'] : '';
        $modelname = isset($arg['modelname']) ? $arg['modelname'] : '';
        $pic = isset($arg['pic']) ? $arg['pic'] : '';
        $content = empty($arg['content']) ? '' : $arg['content'];
        $classid = isset($arg['classid']) ? $arg['classid'] : '';
        $classid_array = isset($arg['classid_array']) ? $arg['classid_array'] : array();
        $viewnum = isset($arg['viewnum']) && $arg['viewnum'] != 0 ? $arg['viewnum'] : 0;
        $replynum = isset($arg['replynum']) && $arg['replynum'] != 0 ? $arg['replynum'] : 0;
        $prioritynum = isset($arg['prioritynum']) && $arg['prioritynum'] != 0 ? $arg['prioritynum'] : 0;
        $updatetime = isset($arg['updatetime']) ? $arg['updatetime'] : 0;
        $status = isset($arg['status']) ? $arg['status'] : 1;
        
        //uid
        if(isset($uid) == FALSE || $uid == 0)
        {
            $uid = $data['user']['uid'];
        }
        
        //classid運算
        if(isset($classid) == TRUE && $classid != '' && count($classid_array) == 0)
        {
            $classid_array = explode(',', $classid);
        }
        
        $classid_array2 = $classid_array;
        $classid_set_array = array();
        foreach($classid_array2 as $key => $value)
        {
            if($value == 0 || in_array($value, $classid_set_array))
            {
                unset($classid_array[$key]);
            }
            $classid_set_array[] = $value;
        }
        $classid = implode(',', $classid_array);
        $classid_array = explode(',', $classid);
        
        //content_html
        $content_html = html_code_replace(array('text' => $content, 'nl2br' => TRUE, 'meta_img' => TRUE));
        
        //set
        $this->noteid = $noteid;
        $this->username = $username;
        $this->title = $title;
        $this->modelname = $modelname;
        $this->pic = $pic;
        $this->uid = $uid;
        $this->content = $content;
        $this->content_html = $content_html;
        $this->classid = $classid;
        $this->classid_array = $classid_array;
        $this->viewnum = $viewnum;
        $this->replynum = $replynum;
        $this->prioritynum = $prioritynum;
        $this->updatetime = $updatetime;
        $this->status = $status;
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array() ) )
    {
        $db_where2 = isset($arg['db_where']) ? $arg['db_where'] : array();
        $db_where['note.noteid'] = $db_where2['noteid'];
        
		$this->db->from('note');
		$this->db->join('note_field', 'note.noteid = note_field.noteid', 'left');
		$this->db->where($db_where);
		$query = $this->db->get();
		$note = $query->row_array();
        
        $this->construct(array(
            'noteid' => $note['noteid'],
            'uid' => $note['uid'],
            'username' => $note['username'],
            'title' => $note['title'],
            'modelname' => $note['modelname'],
            'pic' => $note['pic'],
            'content' => $note['content'],
            'classid' => $note['classid'],
            'viewnum' => $note['viewnum'],
            'replynum' => $note['replynum'],
            'prioritynum' => $note['prioritynum'],
            'updatetime' => $note['updatetime'],
            'status' => $note['status']
        ));
    }
    
	public function get_array()
	{
        $note['noteid'] = $this->noteid;
        $note['username'] = $this->username;
        $note['title'] = $this->title;
        $note['modelname'] = $this->modelname;
        $note['pic'] = $this->pic;
        $note['uid'] = $this->uid;
        $note['content'] = $this->content;
        $note['content_html'] = $this->content_html;
        $note['classid'] = $this->classid;
        $note['classid_array'] = $this->classid_array;
        $note['viewnum'] = $this->viewnum;
        $note['replynum'] = $this->replynum;
        $note['prioritynum'] = $this->prioritynum;
        $note['updatetime'] = $this->updatetime;
        $note['status'] = $this->status;
        
		return $note;
	}
    
	public function update()
	{
        $note2 = $this->get_array();
        
        if( isset($note2['noteid']) && $note2['noteid'] == 0 )
        {
            $note2['noteid'] = $this->common_model->db_search_max( array('table_name' => 'note', 'id_name' => 'noteid') ) + 1;
            $note = array(
                'noteid' => $note2['noteid'],
                'username' => $note2['username'],
                'title' => $note2['title'],
                'modelname' => $note2['modelname'],
                'pic' => $note2['pic'],
                'uid' => $note2['uid'],
                'classid' => $note2['classid'],
                'viewnum' => $note2['viewnum'],
                'replynum' => $note2['replynum'],
                'prioritynum' => $note2['prioritynum'],
                'updatetime' => $note2['updatetime'],
                'status' => $note2['status']
            );
            
            $this->db->insert('note', $note); 
            
            $note_field['noteid'] = $note2['noteid'];
            $note_field['content'] = $note2['content'];
            
            $this->db->insert('note_field', $note_field);
        }
        else
        {
            $note = array(
                'noteid' => $note2['noteid'],
                'username' => $note2['username'],
                'title' => $note2['title'],
                'modelname' => $note2['modelname'],
                'pic' => $note2['pic'],
                'uid' => $note2['uid'],
                'classid' => $note2['classid'],
                'viewnum' => $note2['viewnum'],
                'replynum' => $note2['replynum'],
                'prioritynum' => $note2['prioritynum'],
                'updatetime' => $note2['updatetime'],
                'status' => $note2['status']
            );
            
            $this->db->where(array('noteid' => $note['noteid']));
            $this->db->update('note', $note);
            
            $note_field['noteid'] = $note2['noteid'];
            $note_field['content'] = $note2['content'];
            
            $this->db->where(array('noteid' => $note_field['noteid']));
            $this->db->update('note_field', $note_field);
        }
    }
    
    public function hidden()
    {
        $note_array = $this->get_array();

        $this->db->where( array('noteid' => $note_array['noteid'] ) );
        $this->db->update('note', array('status' => 0) ); 
    }
	
}
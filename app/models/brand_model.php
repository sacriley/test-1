<?php
class Brand_model extends CI_Model {

    private $brandid = 0;
    private $title = '';
    private $href = '';
    private $uid = 0;
    private $picid = '';
    private $piclist_array = array();
    private $toppicid = '';
    private $toppiclist_array = array();
    private $content = '';
    private $content_html = '';
    private $classid = '';
    private $classid_array = array();
    private $prioritynum = 0;
    private $status = 1;
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('brandid' => 0, 'uid' => 0, 'title' => '', 'href' => '', 'picid' => '', 'picid_array' => array(), 'toppicid' => '', 'toppicid_array' => array(), 'content' => '', 'classid' => '', 'classid_array' => array(), 'prioritynum' => 0, 'status' => 0))
	{
        $data = $this->data;
        
        $brandid = !empty($arg['brandid']) ? $arg['brandid'] : 0;
        $uid = !empty($arg['uid']) ? $arg['uid'] : 0;
        $title = !empty($arg['title']) ? $arg['title'] : '';
        $href = !empty($arg['href']) ? $arg['href'] : '';
        $picid = !empty($arg['picid']) ? $arg['picid'] : '';
        $picid_array = !empty($arg['picid_array']) ? $arg['picid_array'] : array();
        $toppicid = !empty($arg['toppicid']) ? $arg['toppicid'] : '';
        $toppicid_array = !empty($arg['toppicid_array']) ? $arg['toppicid_array'] : array();
        $content = empty($arg['content']) ? '' : $arg['content'];
        $classid = !empty($arg['classid']) ? $arg['classid'] : '';
        $classid_array = !empty($arg['classid_array']) ? $arg['classid_array'] : array();
        $prioritynum = !empty($arg['prioritynum']) && $arg['prioritynum'] != 0 ? $arg['prioritynum'] : 0;
        $status = !empty($arg['status']) ? $arg['status'] : 1;
        
        //uid
        if(!empty($uid) == FALSE || $uid == 0)
        {
            $uid = $data['user']['uid'];
        }
        
        //classid運算
        if( !empty($classid) && count($classid_array) == 0)
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
        $modelname = 'pic_list_model'.rand(0,32767);
        $this->load->model('pic_list_model', $modelname);
        $this->$modelname->db_construct( array('picid' => $picid ) );
        $piclist_array = $this->$modelname->get_array();
        
        //toppicid運算
        if(!empty($toppicid))
        {
            $toppicid_array = explode(',', $toppicid);
        }
        
        $toppicid_array2 = $toppicid_array;
        $toppicid_set_array = array();
        foreach($toppicid_array2 as $key => $value)//運算重複的ID
        {
            if($value == 0 || in_array($value, $toppicid_set_array) )
            {
                unset($toppicid_array[$key]);
            }
            $toppicid_set_array[] = $value;
        }
        if(is_array($toppicid_array))
        {
            $toppicid = implode(',', $toppicid_array);
        }
        
        //toppicid
        $modelname = 'pic_list_model'.rand(0,32767);
        $this->load->model('pic_list_model', $modelname);
        $this->$modelname->db_construct( array('picid' => $toppicid ) );
        $toppiclist_array = $this->$modelname->get_array();
        
        //content_html
        $content_html = html_code_replace(array('text' => $content, 'nl2br' => TRUE, 'meta_img' => TRUE));
        
        //set
        $this->brandid = $brandid;
        $this->title = $title;
        $this->href = $href;
        $this->picid = $picid;
        $this->piclist_array = $piclist_array;
        $this->toppicid = $toppicid;
        $this->toppiclist_array = $toppiclist_array;
        $this->uid = $uid;
        $this->content = $content;
        $this->content_html = $content_html;
        $this->classid = $classid;
        $this->classid_array = $classid_array;
        $this->prioritynum = $prioritynum;
        $this->status = $status;
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array() ) )
    {
        $db_where = !empty($arg['db_where']) ? $arg['db_where'] : array();
        
		$this->db->from('brand');
		$this->db->where($db_where);
		$query = $this->db->get();
		$brand = $query->row_array();
        
        $this->construct(array(
            'brandid' => $brand['brandid'],
            'uid' => $brand['uid'],
            'title' => $brand['title'],
            'href' => $brand['href'],
            'picid' => $brand['picid'],
            'toppicid' => $brand['toppicid'],
            'content' => $brand['content'],
            'classid' => $brand['classid'],
            'prioritynum' => $brand['prioritynum'],
            'status' => $brand['status']
        ));
    }
    
	public function get_array()
	{
        $brand['brandid'] = $this->brandid;
        $brand['title'] = $this->title;
        $brand['href'] = $this->href;
        $brand['picid'] = $this->picid;
        $brand['toppicid'] = $this->toppicid;
        $brand['piclist_array'] = $this->piclist_array;
        $brand['toppiclist_array'] = $this->toppiclist_array;
        $brand['uid'] = $this->uid;
        $brand['content'] = $this->content;
        $brand['content_html'] = $this->content_html;
        $brand['classid'] = $this->classid;
        $brand['classid_array'] = $this->classid_array;
        $brand['prioritynum'] = $this->prioritynum;
        $brand['status'] = $this->status;
        
		return $brand;
	}
    
	public function update()
	{
        $brand2 = $this->get_array();
        
        if( empty($brand2['brandid']) )
        {
            $brand2['brandid'] = $this->common_model->db_search_max( array('table_name' => 'brand', 'id_name' => 'brandid') ) + 1;
            $brand = array(
                'brandid' => $brand2['brandid'],
                'title' => $brand2['title'],
                'href' => $brand2['href'],
                'picid' => $brand2['picid'],
                'toppicid' => $brand2['toppicid'],
                'uid' => $brand2['uid'],
                'classid' => $brand2['classid'],
                'content' => $brand2['content'],
                'prioritynum' => $brand2['prioritynum'],
                'status' => $brand2['status']
            );
            
            $this->db->insert('brand', $brand);
        }
        else
        {
            $brand = array(
                'brandid' => $brand2['brandid'],
                'title' => $brand2['title'],
                'href' => $brand2['href'],
                'picid' => $brand2['picid'],
                'toppicid' => $brand2['toppicid'],
                'uid' => $brand2['uid'],
                'classid' => $brand2['classid'],
                'content' => $brand2['content'],
                'prioritynum' => $brand2['prioritynum'],
                'status' => $brand2['status']
            );
            
            $this->db->where(array('brandid' => $brand['brandid']));
            $this->db->update('brand', $brand);
        }
    }
    
    public function hidden()
    {
        $brand_array = $this->get_array();

        $this->db->where( array('brandid' => $brand_array['brandid'] ) );
        $this->db->update('brand', array('status' => 0) ); 
    }
	
}
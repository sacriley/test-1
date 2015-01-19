<?php
class Setting_model extends CI_Model {

    private $keyword = '';
    private $value = '';
    private $modelname = '';
    private $status = 1;
    private $data = array();
    
	public function __construct()
	{
        $this->data = $this->common_model->common();
	}
	
	public function construct($arg = array('keyword' => '', 'value' => '', 'modelname', 'status' => 1))
	{
        $data = $this->data;
            
        $keyword = empty($arg['keyword']) ? 0 : $arg['keyword'] ;
        $value = empty($arg['value']) ? '' : $arg['value'];
        $modelname = empty($arg['modelname']) ? '' : $arg['modelname'];
        $status = empty($arg['status']) ? 1 : $arg['status'];
        
        //set
        $this->keyword = $keyword;
        $this->value = $value;
        $this->modelname = $modelname;
        $this->status = $status;
        
        return TRUE;
    }
    
	public function db_construct($arg = array('db_where' => array() ) )
    {
        $db_where = isset($arg['db_where']) ? $arg['db_where'] : array();
        
		$this->db->from('setting');
		$this->db->where($db_where);
		$query = $this->db->get();
		$setting_array = $query->row_array();
        
        $this->construct(array(
            'keyword' => $setting_array['keyword'],
            'value' => $setting_array['value'],
            'modelname' => $setting_array['modelname'],
            'status' => $setting_array['status']
        ));
    }
    
	public function get_array()
	{
        $setting['keyword'] = $this->keyword;
        $setting['value'] = $this->value;
        $setting['modelname'] = $this->modelname;
        $setting['status'] = $this->status;
        
		return $setting;
	}
    
	public function update()
	{
        $setting_array2 = $this->get_array();
        
        $this->db->from('setting');
        $this->db->where( array('keyword' => $setting_array2['keyword']) );
        $count = $this->db->count_all_results();
        if( $count == 0 )
        {
            $setting_array = array(
                'keyword' => $setting_array2['keyword'],
                'value' => $setting_array2['value'],
                'modelname' => $setting_array2['modelname'],
                'status' => $setting_array2['status']
            );
            
            $this->db->insert('setting', $setting_array); 
        }
        else
        {
            $setting_array = array(
                'keyword' => $setting_array2['keyword'],
                'value' => $setting_array2['value'],
                'modelname' => $setting_array2['modelname'],
                'status' => $setting_array2['status']
            );
            
            $this->db->where(array('keyword' => $setting_array['keyword']));
            $this->db->update('setting', $setting_array);
        }
    }
    
    public function hidden()
    {
        $setting_array = $this->get_array();

        $this->db->where( array('settingid' => $setting_array['settingid'] ) );
        $this->db->update('setting', array('status' => 0) ); 
    }
	
}
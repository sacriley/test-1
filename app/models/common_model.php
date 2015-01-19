<?php

class Common_model extends CI_Model {

	public function __construct()
	{
	}
    
    //網站必執行之自訂程式
    function common()
    {
        $this->db->from('setting');
        $this->db->where(array('status' => 1));
        $query = $this->db->get();
        $global_setting_array = $query->result_array();
        foreach($global_setting_array as $key => $value)
        {
            $data['global'][$value['keyword']] = $value['value'];
        }
        $data['global']['website_metatag_array'] = explode(PHP_EOL, $data['global']['website_metatag']);

        $data['global']['browser_agent'] = $this->browser_agent();

        $data['user'] = $this->get_user();

        return $data;
    }

    function get_user()
    {
        $uid = $this->session->userdata('uid');
        
        $this->db->from('user_member');
        $this->db->where(array('uid' => $uid));
        $query = $this->db->get();
        $user2 = $query->row_array();
        
        if(!empty($user2))
        {
            $user = array('uid' => $user2['uid'], 'email' => $user2['email']);
            return $user;
        }
        else
        {
            return FALSE;
        }
        
    }
    
    //搜尋資料庫最大的ID
    function db_search_max($_array = array('table_name' => '', 'id_name' => '', 'where_sql_array' => array(), 'return_name' => '') )
    {

        $table_name = $_array['table_name'];
        $id_name = $_array['id_name'];
        $where_sql_array = isset($_array['where_sql_array']) ? $_array['where_sql_array'] : array();
        $return_name = isset($_array['return_name']) ? $_array['return_name'] : '';

        $this->db->select_max($id_name);

        if($where_sql_array)
        {
            $this->db->where($where_sql_array);
        }

        $query = $this->db->get($table_name);

        $value = $query->row_array();

        if(isset($return_name) && $return_name != '')
        {
            return $value[$return_name];
        }
        else
        {
            return $value[$id_name];
        }
    }
    
    //取得瀏覽器版本
    function browser_agent()
    {
        $this->load->library('user_agent');
        $browser = $this->agent->browser();
        if ($this->agent->is_mobile())
        {
            $browser_agent['agent'] = 'm';
        }
        else if($browser == 'Internet Explorer')
        {
            $browser_agent['agent'] = 'ie';
            $version = $this->agent->version();
            if($version == '8.0')
            {
                $browser_agent['agent_ie'] = 'ie8';
            }
            else if($version == '9.0')
            {
                $browser_agent['agent_ie'] = 'ie9';
            }
            else if($version == '10.0')
            {
                $browser_agent['agent_ie'] = 'ie10';
            }
            else if($version == '11.0')
            {
                $browser_agent['agent_ie'] = 'ie11';
            }
            $browser_agent['browser_ie'] = 'agent-'.$browser_agent['agent_ie'];
        }
        else if(stripos($_SERVER['HTTP_USER_AGENT'],'rv:')>0 && stripos($_SERVER['HTTP_USER_AGENT'],'Gecko')>0)
        {
            $browser_agent['agent'] = 'ie';
            $browser_agent['agent_ie'] = 'ie11';
            $browser_agent['browser_ie'] = 'agent-'.$browser_agent['agent_ie'];
        }
        else if($browser == 'Chrome')
        {
            $browser_agent['agent'] = 'chrome';
        }
        else if($browser == 'Firefox')
        {
            $browser_agent['agent'] = 'firefox';
        }
        else
        {
            $browser_agent['agent'] = 'other';
        }

        $browser_agent['browser'] = 'agent-'.$browser_agent['agent'];
        $browser_agent['agent_temp'] = '_'.$browser_agent['agent'];

        return $browser_agent;
    }
}
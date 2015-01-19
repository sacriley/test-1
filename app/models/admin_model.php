<?php

class Admin_model extends CI_Model {

	public function __construct()
	{
	}
	
}

function reset_admin_sidebox($father_name, $child_name)
{
	global $admin;
	include_once('app/config/admin.php');
	$admin_sidebox = $admin['admin_sidebox'];
	foreach($admin['admin_sidebox'] as $key => $value)
	{
        if( in_array($value['name'], $admin['sidebox_display_array']) )
        {
            foreach($value['ac_father'] as $key2 => $ac_father)
            {
                foreach($ac_father['ac_child'] as $key3 => $ac_child)
                {
                    if($ac_father['name'] == $father_name && $ac_child['name'] == $child_name)
                    {
                        $admin_sidebox[$key]['ac_father'][$key2]['ac_child'][$key3]['select'] = TRUE;
                        $admin_sidebox[$key]['ac_father'][$key2]['select'] = TRUE;
                        $admin_sidebox[$key]['select'] = TRUE;
                    }
                }
                if(in_array($ac_father['name'], $admin['ac_father_online']) == FALSE)
                {
                    if($admin['ac_father_display'] == 'display')
                    {
                        $admin_sidebox[$key]['ac_father'][$key2]['display'] = TRUE;
                    }
                    else
                    {
                        unset($admin_sidebox[$key]['ac_father'][$key2]);
                    }
                }
            }
        }
        else
        {
            unset($admin_sidebox[$key]);
        }
	}
	return $admin_sidebox;
}
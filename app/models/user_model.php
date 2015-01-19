<?php
class User_model extends CI_Model {
	
	public function login(){
	
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		
		$this->db->from('user_member');
		$this->db->where(array('email' => $email, 'password' => $password));
		$query = $this->db->get();
			
		if($query->num_rows() > 0)
		{
			$user = $query->result_array();
			$newdata = array(
				'uid'  => $user[0]['uid']
			);
			$this->session->set_userdata($newdata);
			return 'ok';
		}
		
		$query = $this->db->get_where('user_member', array('email' => $email));
		if($query->num_rows() > 0)
		{
			return '密碼輸入錯誤';
		}
		else
		{
			return '您輸入的電子郵件不存在';
		}
		
	}
	
}
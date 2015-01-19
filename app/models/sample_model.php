<?php
class Sample_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function get_sample_list($slug = FALSE)
	{
		if ($slug === FALSE){
			$query = $this->db->get('sample');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('sample', array('slug' => $slug));
		return $query->row_array();
	}
	
	public function add_sample()
	{
		$this->load->helper('url');
		
		$slug = url_title($this->input->post('title'), 'dash', TRUE);
		
		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'text' => $this->input->post('text')
		);
		
		return $this->db->insert('sample', $data);
	}
}
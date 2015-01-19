<?php
class Contact_model extends CI_Model {

	public function __construct(){
		$this->load->database();
	}
	
	public function sendmail()
	{
		$name = $this->input->post('name');
		$company = $this->input->post('company');
		$telphone = $this->input->post('telphone');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$need = $this->input->post('need');
		$need_child = $this->input->post('need_child');
		$money = $this->input->post('money');
		$text = $this->input->post('text');
			
		$message = "
		<p>客戶姓名： $name </p>
		<p>公司名稱： $company </p>
		<p>聯繫電話： $telphone </p>
		<p>電子郵件： $email </p>
		<p>聯繫地址： $address </p>
		<p>詢問項目： $need </p>
		<p>項目細節： $need_child </p>
		<p>客戶預算： $money </p>
		<p>需求內容： $text </p>
		";

        $this->load->library('mailer');
        $this->mailer->sendmail(
            $email,
            $name,
            "$company 的 $name 有一封瘋沃科技的需求單".date('Y-m-d H:i:s'),
            $message
        );
	}
}
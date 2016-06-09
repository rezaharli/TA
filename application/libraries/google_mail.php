<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Google_mail {

	private $ci;

	function __construct(){
		$this->ci = get_instance();
		$this->ci->load->library('email');
		$config['protocol']		= "smtp";
		$config['smtp_host'] 	= "ssl://smtp.gmail.com";
		$config['smtp_port'] 	= "465";
		$config['smtp_user'] 	= APP_EMAIL; 
		$config['smtp_pass'] 	= APP_EMAIL_PASSWORD;
		$config['charset'] 		= "utf-8";
		$config['mailtype'] 	= "html";
		$config['newline'] 		= "\r\n";
		$config['validation'] 	= TRUE;

		$this->ci->email->initialize($config);
	}

	function send_mail($email, $name, $to, $subject, $message){
		$this->ci->email->from($email, $name);
		$this->ci->email->to($to);
		$this->ci->email->subject($subject);
		$this->ci->email->message($message);
		return $this->ci->email->send();
    }

}
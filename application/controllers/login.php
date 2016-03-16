<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	    
	    $this->load->model('user');
	}
	
	function index() {
	    $username 	= $this->security->xss_clean($this->input->post('username'));
        $password 	= $this->security->xss_clean($this->input->post('password'));
	    if($username && $password) {
	    	$this->user->validate_user($username, $password);
	        	echo json_encode($this->session->userdata('is_logged_in'));
	        	// $this->show_login_page("<div id=\"alert\" class=\"alert alert-error\">Username atau password tidak cocok</div>");
	    } else {
	        $this->show_login_page("<div id=\"alert\" class=\"alert alert-error\">Silahkan Login</div>");
	    }
	}

	function show_login_page($error) {
	    $data['error'] = $error;
	    $this->load->view('login', $data);
	}
}
/* End of file login.php */
/* Location: ./application/controllers/login.php */
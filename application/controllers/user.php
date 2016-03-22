<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	}
	
	function login() {
	    $username 	= $this->security->xss_clean($this->input->post('username'));
        $password 	= $this->security->xss_clean($this->input->post('password'));

        $user = $this->user_model->get_by(array('username' => $username, 'password' => sha1($password)));

        if($user) {
	       	$this->session->set_userdata('logged_in_user', array(
	       		'id'			=> $user->id,
           		'username'      => $user->username
           		));
	    }

	    echo isset($user);
	}

	function logout(){
	    if($this->session->userdata('logged_in_user')) {
        	$this->session->sess_destroy();
	    }
	    redirect('');
    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
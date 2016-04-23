<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('page/public/login');
    }
	
	public function login() {
	    $username 	= $this->security->xss_clean($this->input->post('username'));
        $password 	= $this->security->xss_clean($this->input->post('password'));

        $this->load->model('user_model');
        $user = $this->user_model->get_by(array('username' => $username, 'password' => sha1($password)));

        if($user) {
            $this->load->model($user->role.'_model', 'roled_user_model');
            $roled_user = $this->roled_user_model->get_by(array('id_user' => $user->id));
	       	$this->session->set_userdata('logged_in_user', array(
	       		'user_data'			=> $user,
	       		'roled_user_data'	=> $roled_user
           		));
	    }
	    echo isset($user);
	}

}
 
/* End of file guest.php */
/* Location: ./application/controllers/guest.php */
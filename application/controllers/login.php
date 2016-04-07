<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('login');
    }
	
	public function autentikasi() {
	    $username 	= $this->security->xss_clean($this->input->post('username'));
        $password 	= $this->security->xss_clean($this->input->post('password'));

        $this->load->model('user_model');
        $user = $this->user_model->get_by(array('username' => $username, 'password' => sha1($password)));

        if($user) {
	       	$this->session->set_userdata('logged_in_user', array(
	       		'id'			=> $user->id,
           		'username'      => $user->username,
           		'nama'      	=> $user->nama,
           		'email'      	=> $user->email,
           		'telp'      	=> $user->telp,
           		'alamat'      	=> $user->alamat,
           		));
	    }
	    echo isset($user);
	}

}
 
/* End of file login.php */
/* Location: ./application/controllers/login.php */
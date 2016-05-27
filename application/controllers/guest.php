<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load_page('page/public/index');
    }

    public function login() {
        $this->load->view('page/public/login');
    }

    public function events() {
        $this->load_page('page/public/temukan-event');
    }
	
    public function detail_event() {
        $this->load_page('page/public/detail-event');
    }

	public function do_login() {
	    $username 	= $this->security->xss_clean($this->input->post('username'));
        $password 	= $this->security->xss_clean($this->input->post('password'));

        $this->load->model('user_model');
        $user = $this->user_model->get_by(array('username' => $username, 'password' => sha1($password)));

        if($user) {
	       	$this->session->set_userdata('id', $user->id);
	    }
	    echo isset($user);
	}

}
 
/* End of file guest.php */
/* Location: ./application/controllers/guest.php */
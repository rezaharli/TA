<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	}

	function do_username_check(){
		$username = $this->input->post('username');
		if($username == $this->session->userdata('logged_in_user')['user_data']->username){ //jika username sama seperti sebelumnya
			echo '3';
		} else {
			$user = $this->user_model->get_by(array('username' => $username));
			echo isset($user);
		}
	}

    function do_password_edit(){
    	$password = $this->input->post('password');
    	$this->user_model->update($this->session->userdata('logged_in_user')['user_data']->id, array('password' => sha1($password)));
    	$this->logout();
    }

    function do_username_edit(){
    	$username = $this->input->post('username');
    	$this->user_model->update($this->session->userdata('logged_in_user')['user_data']->id, array('username' => $username));
    	$this->logout();
    }

    function edit(){
    	if ($this->session->userdata('logged_in_user')['user_data']->role == 'staff') {
    		$this->load_page('page/private/staff/edit_profile');
    	} else if ($this->session->userdata('logged_in_user')['user_data']->role == 'mahasiswa') {
    		
    	}
    }

	function logout(){
	    if($this->session->userdata('logged_in_user')) {
        	$this->session->sess_destroy();
	    }
	    redirect('');
    }

    function show_profile($username){
    	$this->load_page('');
    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
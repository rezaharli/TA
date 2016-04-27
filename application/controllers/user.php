<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	}

	function do_username_check(){
		$username = $this->input->post('username');
        $user = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
		if($username == $user->username){ //jika username sama seperti sebelumnya (tidak berubah)
			echo '3';
		} else {
			$user = $this->user_model->get_by(array('username' => $username));
			echo isset($user);
		}
	}

    function do_password_edit(){
    	$password = $this->input->post('password');
    	$this->user_model->update($this->session->userdata('id'), array('password' => sha1($password)));
    	$this->logout();
    }

    function do_username_edit(){
    	$username = $this->input->post('username');
    	$this->user_model->update($this->session->userdata('id'), array('username' => $username));
    	$this->logout();
    }

    function edit(){
        $user = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
        $view_data['user_data'] = $user;
    	if ($user->role == 'staff') {
    		$this->load_page('page/private/staff/edit_profile');
    	} else if ($user->role == 'mahasiswa') {
    		
    	}
    }

	function logout(){
	    if($this->session->userdata('id')) {
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
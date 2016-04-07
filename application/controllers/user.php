<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index(){
	    if($this->session->userdata('is_logged_in')) {
        	$this->session->sess_destroy();
	    }
	    redirect('');
    }

}
/* End of file logout.php */
/* Location: ./application/controllers/logout.php */
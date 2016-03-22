<?php
class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function is_logged_in() {
    	$user = $this->session->userdata('logged_in_user');
        return isset($user);
    }

}

class Public_Controller extends MY_Controller {
    public function __construct() {
       	parent::__construct();

       	if ($this->is_logged_in()) {
            redirect('home');
        }
    }
}

class Private_Controller extends MY_Controller {
    public function __construct() {
    	parent::__construct();

    	if ( ! $this->is_logged_in()) {
            redirect('');
        }
    }
}

/* End of file my_controller.php */
/* Location: ./application/core/my_controller.php */
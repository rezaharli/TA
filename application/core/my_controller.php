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

	public $view_data;

    public function __construct() {
    	parent::__construct();

    	if ( ! $this->is_logged_in()) {
            redirect('');
        }
    }

    public function load_page($page = ''){
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view($page, $this->view_data);
        $this->load->view('template/footer');
    }
}

/* End of file my_controller.php */
/* Location: ./application/core/my_controller.php */
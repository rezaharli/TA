<?php
class MY_Controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function is_logged_in() {
    	$user = $this->session->userdata('id');
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
        $this->load->model('user_model');
        $data['user_data'] = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
       
        $this->load->model($data['user_data']->role.'_model', 'roled_user_model');
        $data['roled_user_data'] = $this->roled_user_model->get_by(array('id_user' => $data['user_data']->id));
        
        $this->load->view('template/header', $data);
        
        $this->load->view('template/sidebar', $data);
        $this->load->view($page, $this->view_data);
        $this->load->view('template/footer');
    }
}

/* End of file my_controller.php */
/* Location: ./application/core/my_controller.php */
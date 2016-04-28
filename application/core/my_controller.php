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

    public function __construct() {
    	parent::__construct();

    	if ( ! $this->is_logged_in()) {
            redirect('');
        }
    }

    public function load_page($page = '', $content_data){
        $this->load->model('user_model');
        $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
       
        $this->load->model($user_data->role.'_model', 'roled_user_model');
        $roled_user_data = $this->roled_user_model->get_by(array('id_user' => $user_data->id));

        $header_data['username']    = $user_data->username;
        $header_data['nama']        = $user_data->nama;
        $header_data['email']       = $user_data->email;
        $header_data['jenis']       = $roled_user_data->jenis;

        $sidebar_data['jenis']  = $roled_user_data->jenis;

        $this->load->view('template/header', $header_data);
        $this->load->view('template/sidebar', $sidebar_data);
        $this->load->view($page, $content_data);
        $this->load->view('template/footer');
    }
}

/* End of file my_controller.php */
/* Location: ./application/core/my_controller.php */
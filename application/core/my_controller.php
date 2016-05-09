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

    public function get_user_dan_role(){
        $this->load->model('user_model');
        $user = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
       
        $this->load->model($user->role.'_model', 'roled_user_model');
        $user->roled_data = $this->roled_user_model->get_by(array('id_user' => $user->id));

        return $user;
    }

    public function load_page($page = '', $content_data = null){
        $user = $this->get_user_dan_role();

        $header_data['username']    = $user->username;
        $header_data['nama']        = $user->nama;
        $header_data['email']       = $user->email;
        $header_data['jenis']       = $user->roled_data->jenis;

        $sidebar_data['role']   = $user->role;
        $sidebar_data['jenis']  = $user->roled_data->jenis;

        $this->load->view('template/header', $header_data);
        $this->load->view('template/sidebar', $sidebar_data);
        $this->load->view($page, $content_data);
        $this->load->view('template/footer');
    }
}

/* End of file my_controller.php */
/* Location: ./application/core/my_controller.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class My_error extends MY_Controller {
	
	function __construct() {
        parent::__construct(); 
    } 

    function index() { 
    	if($this->session->userdata('id')){
	        $this->load_private_page('errors/404_private', null);
	    } else {
	        $this->load_public_page('errors/404_public', null);
	    }
    } 

    private function load_private_page($page = '', $content_data = null){
        $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $header_data['username']    = $user->username;
        $header_data['nama']        = $user->nama;
        $header_data['email']       = $user->email;
        $header_data['foto_profil'] = ($user->foto_profil) ? $user->foto_profil : 'default.png' ;
        $header_data['jenis']       = $user->roled_data->jenis;

        $sidebar_data['role']   = $user->role;
        $sidebar_data['jenis']  = $user->roled_data->jenis;

        $content_data['breadcrumb'] = $this->load->view('page/private/template/breadcrumb', NULL, TRUE);

        $this->load->view('page/private/template/header', $header_data);
        $this->load->view('page/private/template/sidebar', $sidebar_data);
        $this->load->view($page, $content_data);
        $this->load->view('page/private/template/footer');
    }

    public function load_public_page($page = '', $content_data = null){
        $this->load->view('page/public/template/header');
        $this->load->view($page, $content_data);
        $this->load->view('page/public/template/footer');
    }
}
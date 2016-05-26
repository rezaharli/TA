<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	}

    function index (){
        $this->load->model('user_model');
        $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
        $this->load_page('page/private/'.$user_data->role.'/lihat_laporan', null);
    }

}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifikasi extends Private_Controller {
	
	function __construct() {
		parent::__construct();
        $this->load->model('notifikasi_model');
	}

    public function get() {
        $notifikasi = $this->notifikasi_model->get_many_by(array('tujuan' => $this->session->userdata('id')));
        foreach ($notifikasi as $n) {
        	echo '<li><a href="#"><i class="fa fa-users text-aqua">'.$n->asal.'</i> '.$n->pesan.'</a></li>';
        }
    }

    public function hitung() {
        echo $this->notifikasi_model->count_by(array('tujuan' => $this->session->userdata('id')));
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
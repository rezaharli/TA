<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

    function do_reset_password($id){
        $nim = $this->input->get('nim');

        $this->user_model->update($id, array('password' => sha1($nim)));
        redirect('mahasiswa/list');
    }

}

/* End of file himpunan.php */
/* Location: ./application/controllers/himpunan.php */
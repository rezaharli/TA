<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Staff extends Private_Controller {
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
        $this->load->model('staff_model');
	}

	function add(){
		$this->load_page('page/private/staff/tambah_staff', null);
	}

    function do_delete($id){
        $nip = $this->input->get('nip');

        $this->staff_model->delete_by(array('nip' => $nip));
        $this->user_model->delete($id);

        redirect('lists/staff');
    }

    function do_reset_password($id){
        $nip = $this->input->get('nip');

        $this->user_model->update($id, array('password' => sha1($nip)));
        redirect('lists/staff');
    }

    function do_nip_check(){
        $nip        = $this->input->post('nip');
        $aksi       = $this->input->post('aksi');
        $nip_lama   = $this->input->post('nip_lama');

        $staff = $this->staff_model->get_by(array('nip' => $nip));
            echo isset($staff);
        
    }
}

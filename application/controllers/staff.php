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

	function do_add(){
		$jenisstaff = $this->input->post('jenisstaff');
		$nip        = $this->input->post('nip');
		$nama       = $this->input->post('nama');
		$email      = $this->input->post('email');
        $role       = $this->input->post('role');

        $this->user_model->insert(
            array(
                'username'  => $nip, 
                'password'  => sha1($nip), 
                'nama'      => $nama, 
                'email'     => $email, 
                'role'      => $role), 
            FALSE);

        $this->staff_model->insert(
            array(
                'nip'       => $nip, 
                'id_user'   => $this->db->insert_id(), 
                'jenis'     => $jenisstaff), 
            FALSE);

        redirect('staff/list');		
	}

    function do_delete($id){
        $nip = $this->input->get('nip');

        $this->staff_model->delete_by(array('nip' => $nip));
        $this->user_model->delete($id);

        redirect('staff/list');
    }

    function do_reset_password($id){
        $nip = $this->input->get('nip');

        $this->user_model->update($id, array('password' => sha1($nip)));
        redirect('staff/list');
    }

    function do_nip_check(){
        $nip        = $this->input->post('nip');
        $aksi       = $this->input->post('aksi');
        $nip_lama   = $this->input->post('nip_lama');

        $staff = $this->staff_model->get_by(array('nip' => $nip));
            echo isset($staff);
        
    }
}

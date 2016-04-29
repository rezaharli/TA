<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Staff extends Private_Controller {
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	}

	function list_staff(){
        $staffs = $this->user_model->get_many_by(array('role' => 'staff'));
        $data['staffs'] = array();
        foreach ($staffs as $staff) {
            $this->load->model($staff->role.'_model', 'roled_user_model');
            $roled_user_data = $this->roled_user_model->get_by(array('id_user' => $staff->id));

            array_push($data['staffs'], array(
                'nip'       => $roled_user_data->nip,
                'username'  => $staff->username,
                'nama'      => $staff->nama,
                'email'     => $staff->email,
                'alamat'    => $staff->alamat,
                'telp'      => $staff->telp
                ));
        }

        $this->load_page('page/private/staff/list_staff', $data);
    }

	function add(){
		$staffs = $this->load->model('staff_model');
        $data['staffs'] = $staffs;
		$this->load_page('page/private/staff/add_new_staff', '');
	}

	function do_add(){
		$this->load->model('staff_model');
		$nip = $this->input->post('nama');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
	}
}

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
		$this->load_page('page/private/staff/add_new_staff', null);
	}

	function do_add(){
		$this->load->model('staff_model');

		$jenisstaff = $this->input->post('jenisstaff');
		$nip = $this->input->post('nip');

		$username = $this->input->post('username');
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $role = $this->input->post('role');

        $this->user_model->insert(array('username' => $username, 'password' => sha1($username), 'nama' => $nama, 'email' => $email, 'alamat' => $alamat, 'telp' => $telp, 'role' => $role), FALSE);

        $this->staff_model->insert(array('nip' => $nip, 'id_user' => $this->db->insert_id(), 'jenis' => $jenisstaff), FALSE);

 		
	}
}

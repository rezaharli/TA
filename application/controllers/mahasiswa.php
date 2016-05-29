<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	function list(){
        $mahasiswas = $this->user_model->get_many_by(array('role' => 'mahasiswa'));
        $data['mahasiswas'] = array();

        foreach ($mahasiswas as $mahasiswa) {
            $this->load->model($mahasiswa->role.'_model', 'roled_user_model');
            $roled_user_data = $this->roled_user_model->get_by(array('id_user' => $mahasiswa->id));

            array_push($data['mahasiswas'], array(
                'id'        => $mahasiswa->id,
                'nim'       => $roled_user_data->nim,
                'prodi'       => $roled_user_data->prodi,
                'kelas'       => $roled_user_data->kelas,
                'username'  => $mahasiswa->username,
                'nama'      => $mahasiswa->nama,
                'email'     => $mahasiswa->email,
                'alamat'    => $mahasiswa->alamat,
                'telp'      => $mahasiswa->telp
                ));
        }

        $this->load_page('page/private/staff/list_mahasiswa', $data);
    }

    function do_reset_password($id){
        $nim = $this->input->get('nim');

        $this->user_model->update($id, array('password' => sha1($nim)));
        redirect('mahasiswa/list');
    }

}

/* End of file himpunan.php */
/* Location: ./application/controllers/himpunan.php */
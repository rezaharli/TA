<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
        $this->load->model('himpunan_model');
		$this->load->model('mahasiswa_model');
		$this->load->library('csvimport');
	}

    function do_reset_password($id){
        $nim = $this->input->get('nim');

        $this->user_model->update($id, array('password' => sha1($nim)));
        redirect('lists/mahasiswa');
    }

    function add(){
    	$this->load_page('page/private/staff/tambah_mahasiswa', null);
    }

    function do_nim_check(){
        $nim        = $this->input->post('nim');
        $aksi       = $this->input->post('aksi');
        $nim_lama   = $this->input->post('nim_lama');

        $mahasiswa = $this->mahasiswa_model->get_by(array('nim' => $nim));
            echo isset($mahasiswa);
    }

    function detail(){
        $nim = $this->input->get('nim');

        $mahasiswa  = $this->mahasiswa_model->get_by(array('nim' => $nim));
        $user       = $this->user_model->get_by(array('id' => $mahasiswa->id_user));
        $himpunan   = $this->himpunan_model->get_by(array('id_penanggungjawab' => $mahasiswa->nim));

        // echo print_r($himpunan);
        // die();

        $data['nim']     = $mahasiswa->nim;
        $data['nama']    = $user->nama;
        $data['email']   = $user->email;
        $data['alamat']  = $user->alamat;
        $data['telp']    = $user->telp;
        $data['jenis']   = $mahasiswa->jenis;
        $data['namahim'] = ($himpunan == null) ? '-' :$himpunan->nama;

        $this->load_page('page/private/staff/detail_mahasiswa', $data);
    }

    function do_tambah_pj(){
        $nim = $this->input->get('nim');

        $pj_baru = $this->mahasiswa_model->get_by(array('nim' => $nim));

        $himpunan = 0;
        if($pj_baru->prodi == 'S1 Sistem Informasi'){
            $himpunan   = 1;
            $namahim    = 'S1 Sistem Informasi';
        }else if($pj_baru->prodi == 'S1 Teknik Industri'){
            $himpunan   = 2;
            $namahim    = 'S1 Teknik Industri';
        }
        
        $pj_lama = $this->mahasiswa_model->get_by(array('jenis' => 'himpunan', 'prodi' => $namahim));

        $this->mahasiswa_model->update_by(array('nim' => $pj_lama->nim), array('jenis' => 'n'));
        $this->mahasiswa_model->update_by(array('nim' => $nim), array('jenis' => 'himpunan'));
        $this->himpunan_model->update($himpunan, array('id_penanggungjawab' => $nim));

        redirect('mahasiswa/detail?nim='.$nim);
    }

}

/* End of file himpunan.php */
/* Location: ./application/controllers/himpunan.php */
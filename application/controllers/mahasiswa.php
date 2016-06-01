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

    function do_import_csv(){
    	$data['error'] = '';    //initialize image upload error array to empty

    	$config['upload_path'] = './assets/upload/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '10000';

        $this->load->library('upload', $config);

        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();

            $this->load_page('page/private/staff/list_mahasiswa', $data);
        } else {
            $file_data = $this->upload->data();
            $file_path =  './assets/upload/csv/'.$file_data['file_name'];
            
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);

                foreach ($csv_array as $row) {
                	$data_user = array(array(
                		'username'	=> $row['NIM'],
                    	'password'	=> sha1($row['NIM']),
                    	'nama'		=> $row['NAMA'],
                    	'email'		=> $row['WEBMAIL'],
                    	'role'		=> 'mahasiswa'
                	));

                    $this->user_model->insert_many($data_user, FALSE);

                    $data_mahasiswa = array(array(
                		'nim'		=> $row['NIM'],
                    	'kelas'		=> $row['KELAS'],
                    	'prodi'		=> $row['PROGRAM_STUDI'],
                    	'id_user'	=> $this->db->insert_id()
                	));
                	
                    $this->mahasiswa_model->insert_many($data_mahasiswa, FALSE);

                }

                $files = glob($file_path);
                foreach ($files as $file) {
                	if(is_file($file))
                		unlink($file);
                }

                redirect('lists/mahasiswa');
            } else 
                $data['error'] = "Error occured";
                $this->load_page('page/private/staff/list_mahasiswa', $data);
            } 

    }

    function add(){
    	$this->load_page('page/private/staff/tambah_mahasiswa', null);
    }

    function do_add(){
        $nim    = $this->input->post('nim');
        $nama   = $this->input->post('nama');
        $prodi  = $this->input->post('prodi'); 
        $kelas  = $this->input->post('kelas');
        $email  = $this->input->post('email');
        $role   = $this->input->post('role');

        $this->user_model->insert(
            array(
                'username'  => $nim, 
                'password'  => sha1($nim), 
                'nama'      => $nama, 
                'email'     => $email, 
                'role'      => $role), 
            FALSE);

        $this->mahasiswa_model->insert(
            array(
                'nim'       => $nim, 
                'kelas'     => $kelas,
                'prodi'     => $prodi,
                'id_user'   => $this->db->insert_id()),
            FALSE);

        redirect('lists/mahasiswa');
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
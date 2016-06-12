<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
        $this->load->library('datatables');
	}

	function mahasiswa(){
		$this->load_page('page/private/staff/list_mahasiswa');
	}

	function get_list_mahasiswa(){
        $kolom = array('nim', 'prodi', 'kelas', 'username', 'nama', 'email');

        $table = $this->datatables->make_table(
            array('user', 'mahasiswa'),		//tabel
            'user.id', 						//primary key
            $kolom,							//kolom yg dibutuhkan
            'user.id = mahasiswa.id_user'	//where clause
            );

        // echo "<pre>";
        // var_dump($table);
        // die();
	    for ($i = 0; $i < count($table['data']); $i++) {
        	array_push($table['data'][$i], 
                '<a href="'.base_url('mahasiswa/detail/').'?nim='.$table['data'][$i][0].'">
                    <button class="btn btn-info btn-sm pull-left">
                        <i class="fa fa-list"></i> &nbsp;Lihat Detail
                    </button>
                </a> 
                <a href="'.base_url('mahasiswa/do_reset_password/').'?nim='.$table['data'][$i][0].'">
                    <button class="btn btn-warning btn-sm pull-right">
                        <i class="fa fa-refresh"></i> &nbsp;Reset Password
                    </button>
                </a>
                ');
        }
        echo json_encode($table);
    }

    function staff(){
        $this->get_list_staff();
    }

    function get_list_staff(){
        $this->load->model('staff_model');
        $staffs = $this->user_model->get_many_by(array('role' => 'staff'));
        $data['staffs'] = array();

        foreach ($staffs as $staff) {
            $this->load->model($staff->role.'_model', 'roled_user_model');
            $roled_user_data = $this->roled_user_model->get_by(array('id_user' => $staff->id));

            array_push($data['staffs'], array(
                'id'        => $staff->id,
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

    function himpunan(){
        $this->get_list_himpunan();
    }

    function get_list_himpunan(){
        $this->load->model('himpunan_model');
        $this->load->model('mahasiswa_model');
        $himpunans = $this->himpunan_model->get_all();

        $data['himpunans'] = array();
        foreach ($himpunans as $himpunan) {
            if($himpunan->id_penanggungjawab != NULL){
                $get_nim        = $this->mahasiswa_model->get_by(array('nim' => $himpunan->id_penanggungjawab));
                $get_username   = $this->user_model->get_by(array('id' => $get_nim->id_user));

                array_push($data['himpunans'], array(
                    'username'      => $get_username->username,
                    'id'            => $himpunan->id,
                    'nama_himpunan' => $himpunan->nama,
                    'prodi'         => $himpunan->prodi,
                    'nim_pj'        => $himpunan->id_penanggungjawab
                ));
            }
        }

        $this->load_page('page/private/staff/list_himpunan', $data);
    }

}
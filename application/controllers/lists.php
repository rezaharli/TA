<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	function mahasiswa(){
		$this->load_page('page/private/staff/list_mahasiswa');
	}

	function get_list_mahasiswa(){
        $this->load->library('datatables');

        $kolom = array('nim', 'prodi', 'kelas', 'username', 'nama', 'email', 'alamat', 'telp');

        $table = $this->datatables->make_table(
            array('user', 'mahasiswa'),		//tabel
            'user.id', 						//primary key
            $kolom,							//kolom yg dibutuhkan
            'user.id = mahasiswa.id_user'	//where clause
            );

	    for ($i = 0; $i < count($table['data']); $i++) {
        	array_push($table['data'][$i], 
        		'<a href="'.base_url('mahasiswa/do_reset_password/').'?nim='.$table['data'][$i][1].'">
					<button class="btn btn-warning btn-sm pull-left"><i class="fa fa-refresh"></i> &nbsp;Reset Password</button>
				</a>');
        }
        echo json_encode($table);
    }
}
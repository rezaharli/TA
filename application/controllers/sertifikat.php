<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sertifikat extends Private_Controller {
	
	function __construct() {
		parent::__construct();
        $this->load->model('bukti_lomba_model');
        $this->load->model('user_model');

	}

    function index (){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $result = $this->bukti_lomba_model->get_many_by(array('pengupload' => $user->username));

        $data['result']=$result;
        $this->load_page('page/private/mahasiswa/logbook_sertifikat', $data);
    }

    function add (){
        $this->load->model('user_model');
        $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
    	$this->load_page('page/private/mahasiswa/upload_sertifikat', null);
    }

    function upload_process(){
        $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $data = array(
            'pengupload'             => $user->username,
            'nama_lomba'             => $this->input->post('tema'),
            'penyelenggara_lomba'    => $this->input->post('penyelenggara_lomba'),
            'waktu_lomba'            => $this->input->post('tanggal_sertifikat')
        );

        $tmp        = explode(".", $_FILES['sertifikat1']['name']);
        $ext        = end($tmp);
        $filename   = sha1($_FILES['sertifikat1']['name']).'.'.$ext;

        $data['sertifikat'] = $filename;

        for ($i=1; $i <= 4; $i++) { 
            $tmp        = explode(".", $_FILES['kegiatan'.$i]['name']);
            $ext        = end($tmp);
            $filename   = sha1($_FILES['kegiatan'.$i]['name']).'.'.$ext;

            $data['foto_pelaksanaan'.$i] = $filename;
        }

        $id_upload_sertifikat = $this->bukti_lomba_model->insert($data);

        $this->session->set_flashdata(array('status' => true));

        redirect('sertifikat'); 
    
    }
}
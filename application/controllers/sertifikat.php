<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sertifikat extends Private_Controller {
	
	function __construct() {
		parent::__construct();
        $this->load->model('sertifikat_model');
        $this->load->model('user_model');

	}

    function index (){
        $this->load->model('user_model');
        $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
        $this->load_page('page/private/'.$user_data->role.'/logbook_sertifikat', null);
    }

    function add (){
        $this->load->model('user_model');
        $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
    	$this->load_page('page/private/'.$user_data->role.'/upload_sertifikat', null);
    }


    function upload_process(){
        $id_upload_sertifikat = $this->input->post('id');
        $nama_input_file = 'file_lpj';

        $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $this->load->model('sertifikat_model');
        $last_id_sertifikat = $this->pengajuan_sertifikat_model->insert(array('nim' => $nim));

        $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
        $ext        = end($tmp);
        $filename   = $last_id_sertifikat.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;

        $path = './assets/upload/sertifikat/pengajuan-'.$last_id_sertifikat.'/';
        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path']      = $path;
        $config['allowed_types']    = '*';
        $config['file_name']        = $filename;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($nama_input_file)) {

            rmdir($path);
            $this->sertifikat_model->delete($last_id_sertifikat);
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {

            date_default_timezone_set("Asia/Jakarta");
            $data = array(
                'nim' => $last_id_pengajuan_proposal,
                'tema_lomba'            => $this->input->post('tema_lomba'),
                'penyelenggara_lomba'   => $this->input->post('tujuan_kegiatan'),
                'waktu_lomba'           => date('Y-n-j h:i:s'),
                'sertifikat'            => $this->upload->data()['file_name']
            );

            $id_upload_sertifikat = $this->sertifikat_model->insert($data);
            if ($this->input->post('drive_upload') == 1) {
                $this->session->set_userdata('upload_data', $upload_data);
                $this->get_google_client();
            }

            $this->session->set_flashdata(array('status' => true));

        }

        redirect('sertifikat'); 

    }
}
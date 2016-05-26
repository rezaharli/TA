<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sertifikat extends Private_Controller {
	
	function __construct() {
		parent::__construct();
        $this->load->model('upload_sertifikat_model');
        $this->load->model('user_model');

	}

    function index (){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $this->db->select('*');
        $this->db->from('upload_sertifikat');
        $this->db->where('nim', $user->username);
        $result = $this->db->get()->result();
        $data['result']=$result;
        // print_r($data);die();
        $this->load_page('page/private/mahasiswa/logbook_sertifikat', $data);
    }

    function add (){
        $this->load->model('user_model');
        $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
    	$this->load_page('page/private/'.$user_data->role.'/upload_sertifikat', null);
    }


    function upload_process(){
        $id_upload_sertifikat = $this->input->post('id');
        $sertifikat_input_file = 'upload_sertifikat';
        $kegiatan1_input_file = 'upload_kegiatan1';
        $kegiatan2_input_file = 'upload_kegiatan2';
        $kegiatan3_input_file = 'upload_kegiatan3';
        $kegiatan4_input_file = 'upload_kegiatan4';


        //var_dump($_FILES);
        // echo $_FILES[$sertifikat_input_file]['name'];
        // echo pathinfo($_FILES[$sertifikat_input_file]['name'], PATHINFO_EXTENSION);
        // echo basename($_FILES[$sertifikat_input_file]['name'],".". pathinfo($_FILES[$sertifikat_input_file]['name'], PATHINFO_EXTENSION));
        // echo $_FILES[$kegiatan1_input_file]['name'];
        // die();


        $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        // print_r($user);
        // die();



        // $tmp        = explode(".", $_FILES[$sertifikat_input_file]['name']);
        // $ext        = end($tmp);
        // $filename   = sha1($_FILES[$sertifikat_input_file]['name']).'.'.$ext;

        $path = './assets/upload/sertifikat/';
        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path']      = $path;
        $config['allowed_types']    = '*';
        // $config['file_name']        = $filename;

        $this->load->library('upload', $config);

        // if ( ! $this->upload->do_upload($sertifikat_input_file)) {

        //     rmdir($path);
        //     $this->sertifikat_model->delete($last_id_sertifikat);
        //     $this->session->set_flashdata('error', $this->upload->display_errors());
        // } else {

        // print_r($_FILES[$sertifikat_input_file]);
        // die();

            date_default_timezone_set("Asia/Jakarta");
            $data = array(
                'nim'                   => $user->username,
                'tema_lomba'            => $this->input->post('tema'),
                'penyelenggara_lomba'   => $this->input->post('penyelenggara_lomba'),
                'waktu_lomba'           => date('Y-n-j h:i:s'),
                'sertifikat'             => $_FILES[$sertifikat_input_file]['name'],
                'foto_pelaksanaan1'      => $_FILES[$kegiatan1_input_file]['name'],
                'foto_pelaksanaan2'      => $_FILES[$kegiatan2_input_file]['name'],
                'foto_pelaksanaan3'      => $_FILES[$kegiatan3_input_file]['name'],
                'foto_pelaksanaan4'      => $_FILES[$kegiatan4_input_file]['name']
            );

            $id_upload_sertifikat = $this->upload_sertifikat_model->insert($data);
            if ($this->input->post('drive_upload') == 1) {
                $this->session->set_userdata('upload_data', $upload_data);
                $this->get_google_client();
            }

            $this->session->set_flashdata(array('status' => true));

        // }

        redirect('sertifikat'); 

    }
    
}
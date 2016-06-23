<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sertifikat extends Private_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('bukti_lomba_model');
        $this->load->model('user_model');

        $this->config_upload['upload_path']     = './assets/upload/sertifikat';
        $this->config_upload['allowed_types']   = 'rar|zip';
        $this->config_upload['max_size']        = '100000';
    }

    function index (){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        if($user->role == 'staff') {
            $sertifikat = $this->bukti_lomba_model->get_many_by(array('rekomendasi' => '0'));

            $this->load->model('mahasiswa_model');
            foreach ($sertifikat as $s) {
                if($s != null) 
                    $s->pengupload = $this->mahasiswa_model->get_mahasiswa_dan_user_by_nim($s->pengupload);
            }
            $data['result'] = $sertifikat;
            $this->load_page('page/private/staff/logbook_sertifikat', $data);
        } else {
            $data['result'] = $this->bukti_lomba_model->get_many_by(array('pengupload' => $user->roled_data->nim));
            $this->load_page('page/private/mahasiswa/logbook_sertifikat', $data);
        }
    }

    function add (){
        $this->load->model('user_model');
        $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
        $this->load_page('page/private/mahasiswa/upload_sertifikat', null);
    }

    function upload_process(){
        $this->load->model('user_model');
        $nama_input_file = 'sertifikat1';

        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
        $ext        = end($tmp);
        $filename   = sha1($_FILES[$nama_input_file]['name']).'.'.$ext;

        $data['sertifikat'] = $filename;

        if ( ! file_exists($this->config_upload['upload_path'])) {
           mkdir($this->config_upload['upload_path'], 0777, true);
        }

        $this->load->library('upload', $this->config_upload);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if ($this->upload->do_upload($nama_input_file)) {
                
                $upload_data = $this->upload->data();
                $upload_data['orig_name'] = $filename;
                
                $created_file = $this->upload_sertifikat_to_drive($upload_data);

                unlink($upload_data['full_path']);

                $data = array(
                    'pengupload'            => $user->roled_data->nim,
                    'nama_lomba'            => $this->input->post('nama_lomba'),
                    'kategori_lomba'        => $this->input->post('kategori_lomba'),
                    'tingkat_kompetisi'     => $this->input->post('tingkat_kompetisi'),
                    'penyelenggara_lomba'   => $this->input->post('penyelenggara_lomba'),
                    'waktu_lomba'           => $this->input->post('tanggal_sertifikat'),
                    'drive_id'              => $created_file->id
                );
                $id_upload_sertifikat = $this->bukti_lomba_model->insert($data);
                $this->session->set_userdata('notif_upload', true);
            }else{
                echo $this->upload->display_errors();
                $this->session->set_userdata('notif_upload', false);    
            }
        }

        redirect('sertifikat'); 
    
    }

    function upload_sertifikat_to_drive($upload_data){

        $this->load->library('google_drive');
        $this->config->load('google_drive');

        return $this->google_drive->insertFile(
            $upload_data['orig_name'], 
            $upload_data['file_type'], 
            $this->config->item('sertifikat_folder_id'), 
            $upload_data['full_path']
            );
    }

    function download($drive_id){

        $this->load->library('google_drive');
        $this->config->load('google_drive');
        $this->load->helper('download');

        $this->google_drive->downloadFile($drive_id);
    }
}
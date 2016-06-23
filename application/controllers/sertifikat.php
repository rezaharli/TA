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

        $data = array(
            'pengupload'            => $user->roled_data->nim,
            'nama_lomba'            => $this->input->post('nama_lomba'),
            'kategori_lomba'        => $this->input->post('kategori_lomba'),
            'tingkat_kompetisi'     => $this->input->post('tingkat_kompetisi'),
            'penyelenggara_lomba'   => $this->input->post('penyelenggara_lomba'),
            'waktu_lomba'           => $this->input->post('tanggal_sertifikat')
        );

        $tmp        = explode(".", $_FILES['sertifikat1']['name']);
        $ext        = end($tmp);
        $filename   = sha1($_FILES['sertifikat1']['name']).'.'.$ext;

        $data['sertifikat'] = $filename;

        $id_upload_sertifikat = $this->bukti_lomba_model->insert($data);

        $this->load->library('upload', $this->config_upload);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->upload->do_upload($nama_input_file)) {
                $upload_data = $this->upload->data();
                $upload_data['orig_name'] = $filename;
                $this->upload_sertifikat_to_drive($upload_data);
                unlink($upload_data['full_path']);
                $this->session->set_userdata('notif_upload', true);
            }else{
                $this->session->set_userdata('notif_upload', false);    
            }
        }
        $this->session->set_flashdata(array('status' => true));

        redirect('sertifikat'); 
    
    }

    function upload_sertifikat_to_drive($upload_data){
        $this->load->library('google_drive');
        $client = new Google_Client();
        $client_email = 'hmmmm-359@noted-fact-127906.iam.gserviceaccount.com';
        $private_key = file_get_contents(APPPATH.'libraries/hmmmm-4c2bd9a777d8.p12');
        $scopes = array('https://www.googleapis.com/auth/drive');
        $credentials = new Google_Auth_AssertionCredentials(
            $client_email,
            $scopes,
            $private_key
        );
        $client->setAssertionCredentials($credentials);
        $service = new Google_Service_Drive($client);

        $file = new Google_Service_Drive_DriveFile();
        $folderId = '0B38ZX0d3LMfBQ21haGJCa3ZwQTQ';
        $file->name = $upload_data['orig_name'];
        $file->parents = array($folderId);
        $data = file_get_contents($upload_data['full_path']);
        $createdFile = $service->files->create($file, array(
            'data' => $data,
            'mimeType' => $upload_data['file_type'],
            'uploadType' => 'media'
        ));

        $this->session->set_userdata('notif_upload', true);
    }
}
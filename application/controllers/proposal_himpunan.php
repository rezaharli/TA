<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal_himpunan extends Private_Controller{

    protected $user;

    public function __construct(){
        parent::__construct();
        // assign variable user from session
        $this->user = $this->session->userdata('logged_in_user');
        // load models
        $this->load->model('user_model');
        $this->load->model('himpunan_model');
        $this->load->model('proposal_himpunan_model');
        $this->load->model('pengajuan_proposal_himpunan_model');
    }

    function index(){
        $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));

        $data['himpunan'] = $himpunan;
        $data['user'] = $user;
        $this->load_page('page/private/himpunan/upload_prop_himpunan', $data);
    }

    function upload_process(){
        $id_proposal = $this->input->post('id');
        $nama_input_file = 'file_proposal';

        $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $id_himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim))->id;

        $this->load->model('pengajuan_proposal_himpunan_model');
        $last_id_pengajuan_proposal = $this->pengajuan_proposal_himpunan_model->insert(array('pengaju_proposal' => $id_himpunan));

        $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
        $ext        = end($tmp);
        $filename   = $last_id_pengajuan_proposal.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;

        $path = './assets/upload/proposal/pengajuan-'.$last_id_pengajuan_proposal.'/';
        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path']      = $path;
        $config['allowed_types']    = '*';
        $config['file_name']        = $filename;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($nama_input_file)) {

            rmdir($path);
            $this->pengajuan_proposal_himpunan_model->delete($last_id_pengajuan_proposal);
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {

            date_default_timezone_set("Asia/Jakarta");
            $data = array(
                'id_pengajuan_proposal' => $last_id_pengajuan_proposal,
                'judul'                 => $this->input->post('judul'),
                'tema_kegiatan'         => $this->input->post('tema_kegiatan'),
                'tujuan_kegiatan'       => $this->input->post('tujuan_kegiatan'),
                'sasaran_kegiatan'      => $this->input->post('sasaran_kegiatan'),
                'tanggal_kegiatan'      => $this->input->post('tanggal_kegiatan'),
                'tempat_kegiatan'       => $this->input->post('tempat_kegiatan'),
                'bentuk_kegiatan'       => $this->input->post('bentuk_kegiatan'),
                'anggaran'              => $this->input->post('anggaran'),
                'penutup'               => $this->input->post('penutup'),
                'waktu_upload'          => date('Y-n-j h:i:s'),
                'file'                  => $this->upload->data()['file_name']
            );

            $id_proposal = $this->proposal_himpunan_model->insert($data);
            if ($this->input->post('drive_upload') == 1) {
                $this->session->set_userdata('upload_data', $upload_data);
                $this->get_google_client();
            }

            $this->session->set_flashdata(array('status' => true));

        }

        redirect('proposal_himpunan'); 

    }

    function get_google_client(){
        $this->load->library('google_drive');
        $google_token = $this->session->userdata('google_token');
        $upload_data = $this->session->userdata('upload_data');

        if (empty($google_token)) {
            if (empty($this->input->get('code'))) {
                $this->google_drive->getAuthCode();
            }
            $authCode = $this->input->get('code');
            $client = $this->google_drive->getClient($authCode);
        }else{
            $client = new Google_Client();
            $google_token = json_encode($google_token);
            $client->setAccessToken($google_token);
        }

        $service = new Google_Service_Drive($client);

        $file = new Google_Service_Drive_DriveFile();
        $file->name = $upload_data['raw_name'];
        $data = file_get_contents($upload_data['full_path']);
        $createdFile = $service->files->create($file, array(
            'data' => $data,
            'mimeType' => $upload_data['file_type'],
            'uploadType' => 'media'
        ));

        $this->session->set_flashdata(array('status' => true));
        redirect('proposal_himpunan');
    }
    function list_proposal(){
        $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));

        $data['himpunan'] = $himpunan;
        $data['user'] = $user;
        $this->load_page('page/private/himpunan/logbook_proposal', $data);
    }
}
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
        $this->load->model('staff_model');
        $this->load->model('proposal_himpunan_model');
        $this->load->model('pengajuan_proposal_himpunan_model');
        $this->load->model('logbook_proposal_himpunan_model');
        $this->load->model('lpj_himpunan_model');
    }

    function index(){
        $this->logbook_pengajuan();
    }

    function upload_pengajuan(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));

        $data['himpunan'] = $himpunan;
        $data['user'] = $user;
        $this->load_page('page/private/himpunan/upload_pengajuan_himpunan', $data);
    }

    function do_upload_pengajuan(){
        $nama_input_file = 'file_pengajuan';

        // $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $id_himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim))->id;

        // $this->load->model('pengajuan_proposal_himpunan_model');
        $last_id_pengajuan_proposal = $this->pengajuan_proposal_himpunan_model->insert(array('pengaju_proposal' => $id_himpunan));

        $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
        $ext        = end($tmp);
        $filename   = $last_id_pengajuan_proposal.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;

        $path = './assets/upload/proposal_himpunan/pengajuan-'.$last_id_pengajuan_proposal.'/';
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
            $upload_data = $this->upload->data();
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
            $this->upload_to_drive($upload_data);

            $this->session->set_flashdata(array('status' => true));

        }

        redirect('proposal_himpunan/logbook_pengajuan'); 

    }

    function upload_proposal(){
        $id_pengajuan = $this->input->get('id_pengajuan');

        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        // $pengajuan = $this->pengajuan_proposal_himpunan_model->get_by(array('' => , );
        $data['himpunan'] = $himpunan;
        $data['user'] = $user;
        $data['id_pengajuan'] = $id_pengajuan;


        $this->load_page('page/private/himpunan/upload_prop_himpunan', $data);
    }

    function do_upload_proposal(){
        $id_pengajuan = $this->input->get('id_pengajuan');

        // echo ($id_pengajuan);
        // die;
        
        $nama_input_file = 'file_proposal';

        // $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $id_himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim))->id;

        // $this->load->model('pengajuan_proposal_himpunan_model');
        // $last_id_pengajuan_proposal = $this->pengajuan_proposal_himpunan_model->insert(array('pengaju_proposal' => $id_himpunan));

        $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
        $ext        = end($tmp);
        $filename   = $id_pengajuan.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;

        $path = './assets/upload/proposal_himpunan/pengajuan-'.$last_id_pengajuan_proposal.'/';
        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path']      = $path;
        $config['allowed_types']    = '*';
        $config['file_name']        = $filename;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($nama_input_file)) {

            rmdir($path);
            // $this->pengajuan_proposal_himpunan_model->delete($last_id_pengajuan_proposal);
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {
            $upload_data = $this->upload->data();
            date_default_timezone_set("Asia/Jakarta");
            $data = array(
                'id_pengajuan_proposal' => $id_pengajuan,
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
            $this->upload_to_drive($upload_data);
            $this->session->set_flashdata(array('status' => true));

        }


        redirect('proposal_himpunan/detail_pengajuan?id_pengajuan='.$id_pengajuan); 

    }

    // function get_google_client(){
    //     $this->load->library('google_drive');
    //     $google_token = $this->session->userdata('google_token');
    //     $upload_data = $this->session->userdata('upload_data');

    //     if (empty($google_token)) {
    //         if (empty($this->input->get('code'))) {
    //             $this->google_drive->getAuthCode();
    //         }
    //         $authCode = $this->input->get('code');
    //         $client = $this->google_drive->getClient($authCode);
    //     }else{
    //         $client = new Google_Client();
    //         $google_token = json_encode($google_token);
    //         $client->setAccessToken($google_token);
    //     }

    //     $service = new Google_Service_Drive($client);

    //     $file = new Google_Service_Drive_DriveFile();
    //     $file->name = $upload_data['raw_name'];
    //     $data = file_get_contents($upload_data['full_path']);
    //     $createdFile = $service->files->create($file, array(
    //         'data' => $data,
    //         'mimeType' => $upload_data['file_type'],
    //         'uploadType' => 'media'
    //     ));

    //     $this->session->set_flashdata(array('status' => true));
    //     redirect('proposal_himpunan/logbook_pengajuan');
    // }

    function upload_to_drive($upload_data){
        $this->load->library('google_drive');
        $client = new Google_Client();
        $client_email = 'hmmmm-359@noted-fact-127906.iam.gserviceaccount.com';
        $private_key = file_get_contents(FCPATH.'/hmmmm-4c2bd9a777d8.p12');
        $scopes = array('https://www.googleapis.com/auth/drive');
        $credentials = new Google_Auth_AssertionCredentials(
            $client_email,
            $scopes,
            $private_key
        );
        $client->setAssertionCredentials($credentials);
        $service = new Google_Service_Drive($client);

        $file = new Google_Service_Drive_DriveFile();
        $folderId = '0B38ZX0d3LMfBVHgydlRQanRCWXM';
        $file->name = $upload_data['orig_name'];
        $file->parents = array($folderId);
        $data = file_get_contents($upload_data['full_path']);
        $createdFile = $service->files->create($file, array(
            'data' => $data,
            'mimeType' => $upload_data['file_type'],
            'uploadType' => 'media'
        ));

        $this->session->set_flashdata(array('status' => true));
    }
    
    function logbook_pengajuan(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        

        if ($user->role == 'staff') {
            $proposals  = $this->logbook_proposal_himpunan_model->get_all();
        }else if($user->role == 'mahasiswa') {
            $himpunan   = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
            $proposals  = $this->logbook_proposal_himpunan_model->get_many_by(array('pengaju' => $himpunan->id));
        }
        
        $data['proposals'] = array();
        foreach ($proposals as $proposal) {
            $pengaju            = $this->himpunan_model->get_by(array('id' => $proposal->pengaju));
            $get_id_staff       = $this->staff_model->get_by(array('nip' => $proposal->penanggungjawab));
            $penanggungjawab    = ($get_id_staff == null) ? null : $this->user_model->get($get_id_staff->id_user);

            array_push($data['proposals'], array(
                'id'                        => $proposal->id,
                'pengaju'                   => $pengaju->nama,
                'tanggal_pengajuan'         => $proposal->tanggal_pengajuan,
                'judul'                     => $proposal->judul,
                'tanggal_proposal_terakhir' => $proposal->tanggal_proposal_terakhir,
                'status_approve'            => $proposal->status_approve,
                'penanggungjawab'           => ($penanggungjawab == null) ? '-' : $penanggungjawab->nama
                ));
        }

       
        if ($user->role == 'staff') {
            $this->load_page('page/private/staff/logbook_proposal_himpunan', $data);
        }else if($user->role == 'mahasiswa'){
            $data['himpunan'] = $himpunan;
            $this->load_page('page/private/himpunan/logbook_proposal', $data);
        }
    }

    function detail_pengajuan(){
        $id_pengajuan = $this->input->get('id_pengajuan');

        $user       = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $proposals  = $this->proposal_himpunan_model->get_many_by(array('id_pengajuan_proposal' => $id_pengajuan));

        if ($user->role == 'mahasiswa') {
            $himpunan   = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        }

        $data['proposals'] = array();
        $status_approve;
        foreach ($proposals as $proposal) {

            array_push($data['proposals'], array(
                'id_proposal'       => $proposal->id,
                'judul'             => $proposal->judul,
                'tanggal_upload'    => $proposal->waktu_upload,
                'status_approve'    => ($proposal->status_approve == null) ? '-' :$proposal->status_approve
            ));
            $status_approve = $proposal->status_approve;
        }

        $data['id_pengajuan']   = $id_pengajuan;
        $data['status_approve'] = $status_approve;

        if ($user->role == 'staff') {
            $this->load_page('page/private/staff/logbook_proposal_himpunan_detail', $data);
        }else if($user->role == 'mahasiswa'){
            $data['himpunan']       = $himpunan;
            $this->load_page('page/private/himpunan/logbook_proposal_detail', $data);
        }
        
    }

    function detail_proposal(){
        $id_proposal = $this->input->get('id_proposal');

        $user       = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $proposal   = $this->proposal_himpunan_model->get_by(array('id' => $id_proposal));

        $data['id']                 = $proposal->id;
        $data['judul_detail']       = $proposal->judul;
        $data['tema_kegiatan']      = $proposal->tema_kegiatan;
        $data['tujuan_kegiatan']    = $proposal->tujuan_kegiatan;
        $data['sasaran_kegiatan']   = $proposal->sasaran_kegiatan;
        $data['tanggal_kegiatan']   = $proposal->tanggal_kegiatan;
        $data['tempat_kegiatan']    = $proposal->tempat_kegiatan;
        $data['bentuk_kegiatan']    = $proposal->bentuk_kegiatan;
        $data['anggaran']           = $proposal->anggaran;
        $data['penutup']            = $proposal->penutup;
        $data['status']             = $proposal->status_approve;

        if ($user->role == 'staff') {
            $this->load_page('page/private/staff/detail_proposal_himpunan', $data);
        }else if($user->role == 'mahasiswa'){
            $this->load_page('page/private/himpunan/logbook_proposal_detail', $data);
        }
        
    }

    function do_edit_status($id){
        $user       = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $penyetuju  = $this->staff_model->get_by(array('id_user' => $user->id));

        $status = null;
        if ($this->input->get('s') == 't') {
            $status = 'y';
        } else if ($this->input->get('s') == 'f') {
            $status = 'n';
        }

        $this->proposal_himpunan_model->update($id, array('status_approve' => $status, 'penyetuju' => $penyetuju->nip));

        redirect('proposal_himpunan/detail_proposal?id_proposal='.$id);
    }

    function upload_lpj(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        // $pengajuan = $this->pengajuan_proposal_himpunan_model->get_by(array('' => , );

        $data['himpunan'] = $himpunan;
        $data['user'] = $user;
        $this->load_page('page/private/himpunan/upload_lpj_himpunan', $data);
    }

    function do_upload_lpj(){
        $id_pengajuan = $this->input->get('id');
        
        $nama_input_file = 'file_lpj';

        // $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $id_himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim))->id;

        // $this->load->model('pengajuan_proposal_himpunan_model');
        // $last_id_pengajuan_proposal = $this->pengajuan_proposal_himpunan_model->insert(array('pengaju_proposal' => $id_himpunan));

        $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
        $ext        = end($tmp);
        $filename   = $last_id_pengajuan_proposal.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;

        $path = './assets/upload/lpj_himpunan/pengajuan-'.$last_id_pengajuan_proposal.'/';
        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path']      = $path;
        $config['allowed_types']    = '*';
        $config['file_name']        = $filename;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($nama_input_file)) {

            rmdir($path);
            // $this->pengajuan_proposal_himpunan_model->delete($last_id_pengajuan_proposal);
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {

            date_default_timezone_set("Asia/Jakarta");
            $data = array(
                // 'id_pengajuan_proposal' => $last_id_pengajuan_proposal,
                'judul_laporan'              => $this->input->post('judul_laporan'),
                'deskripsi_laporan'          => $this->input->post('deskripsi_laporan'),
                'ketercapaian_tujuan'        => $this->input->post('ketercapaian_tujuan'),
                'realisasi_sasaran_kegiatan' => $this->input->post('realisasi_sasaran_kegiatan'),
                'tanggal_pelaksanaan'        => $this->input->post('tanggal_pelaksanaan'),
                'tempat_pelaksanaan'         => $this->input->post('tempat_pelaksanaan'),
                'realisasi_kegiatan'         => $this->input->post('realisasi_kegiatan'),
                'realisasi_total_anggaran'   => $this->input->post('realisasi_total_anggaran'),
                'evaluasi_kegiatan'          => $this->input->post('evaluasi_kegiatan'),
                'rekomendasi'                    => $this->input->post('rekomendasi'),
                'penutup'                    => $this->input->post('penutup'),
                'waktu_upload'               => date('Y-n-j h:i:s'),
                'file'                       => $this->upload->data()['file_name']
            );

            $id_lpj = $this->lpj_himpunan_model->insert($data);
            $this->upload_to_drive($upload_data);

            $this->session->set_flashdata(array('status' => true));

        }

        redirect('proposal_himpunan/logbook_pengajuan'); 
    }   
}
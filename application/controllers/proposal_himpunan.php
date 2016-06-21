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
        $this->load->model('acara_himpunan_model');

        // config upload
        $this->config_upload['upload_path']     = './assets/upload/proposal_himpunan';
        $this->config_upload['allowed_types']   = 'pdf|doc|docx';
        $this->config_upload['max_size']        = '100000';

        // form validasi
        $this->load->library('form_validation');
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

        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $id_himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim))->id;

        // rule
        $this->form_validation->set_rules('judul', 'Judul Proposal', 'required');
        $this->form_validation->set_rules('tema_kegiatan', 'Tema Kegiatan', 'required');
        $this->form_validation->set_rules('tujuan_kegiatan', 'Tujuan Kegiatan', 'required');
        $this->form_validation->set_rules('sasaran_kegiatan', 'Sasaran Kegiatan', 'required');
        $this->form_validation->set_rules('tanggal_kegiatan', 'Tanggal Kegiatan', 'required');
        $this->form_validation->set_rules('tempat_kegiatan', 'Tempat Kegiatan', 'required');
        $this->form_validation->set_rules('bentuk_kegiatan', 'Bentuk Kegiatan', 'required');
        $this->form_validation->set_rules('anggaran', 'Anggaran Biaya', 'required|integer|max_length[10]');
        $this->form_validation->set_rules('penutup', 'Penutup', 'required');
        // $this->form_validation->set_rules('file_pengajuan', 'File Pengajuan Proposal', 'required');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if ($this->form_validation->run() != FALSE) {
                $last_id_pengajuan_proposal = $this->pengajuan_proposal_himpunan_model->insert(array('pengaju_proposal' => $id_himpunan));

                $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
                $ext        = end($tmp);
                $filename   = $last_id_pengajuan_proposal.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;
        
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
                    'file'                  => $filename
                );
        
                $id_proposal = $this->proposal_himpunan_model->insert($data);
                $this->load->library('upload', $this->config_upload);

                if ( ! file_exists($this->config_upload['upload_path'])) {
                   mkdir($this->config_upload['upload_path'], 0777, true);
                }

                if ($this->upload->do_upload($nama_input_file)) {
                    $upload_data = $this->upload->data();
                    $upload_data['orig_name'] = $filename;
                    $this->upload_proposal_to_drive($upload_data);
                    unlink($upload_data['full_path']);
                    $this->session->set_userdata("notif_upload", true);
                }else{
                    $this->session->set_userdata("notif_upload", false);
                }
                redirect('proposal_himpunan/logbook_pengajuan');
            } else {
                $this->upload_pengajuan();
            }
        } else {
            redirect('proposal_himpunan/logbook_pengajuan');
        }
    }

    function upload_proposal(){
        $id_pengajuan = $this->input->get('id_pengajuan');

        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        
        $data['himpunan'] = $himpunan;
        $data['user'] = $user;
        $data['id_pengajuan'] = $id_pengajuan;

        $this->load_page('page/private/himpunan/upload_prop_himpunan', $data);
    }

    function do_upload_proposal(){
        $id_pengajuan = $this->input->get('id_pengajuan');

        $nama_input_file = 'file_proposal';

        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $id_himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim))->id;

        // rule
        $this->form_validation->set_rules('judul', 'Judul Proposal', 'required');
        $this->form_validation->set_rules('tema_kegiatan', 'Tema Kegiatan', 'required');
        $this->form_validation->set_rules('tujuan_kegiatan', 'Tujuan Kegiatan', 'required');
        $this->form_validation->set_rules('sasaran_kegiatan', 'Sasaran Kegiatan', 'required');
        $this->form_validation->set_rules('tanggal_kegiatan', 'Tanggal Kegiatan', 'required');
        $this->form_validation->set_rules('tempat_kegiatan', 'Tempat Kegiatan', 'required');
        $this->form_validation->set_rules('bentuk_kegiatan', 'Bentuk Kegiatan', 'required');
        $this->form_validation->set_rules('anggaran', 'Anggaran Biaya', 'required|integer|max_length[10]');
        $this->form_validation->set_rules('penutup', 'Penutup', 'required');      
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->form_validation->run() != FALSE) {
                $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
                $ext        = end($tmp);
                $filename   = $id_pengajuan.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;
        
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
                    'file'                  => $filename
                );
            
                $id_proposal = $this->proposal_himpunan_model->insert($data);
                
                $this->load->library('upload', $this->config_upload);
    
                if ($this->upload->do_upload($nama_input_file)) {
                    $upload_data = $this->upload->data();
                    $upload_data['orig_name'] = $filename;
                    $this->upload_proposal_to_drive($upload_data);
                    unlink($upload_data['full_path']);
                    $this->session->set_userdata('notif_upload', true);
                }else{
                    $this->session->set_userdata('notif_upload', false);    
                }
                redirect('proposal_himpunan/detail_pengajuan?id_pengajuan='.$id_pengajuan);
            } else {
                $this->upload_proposal();
            }
        } else {   
            redirect('proposal_himpunan/detail_pengajuan?id_pengajuan='.$id_pengajuan);
        } 
    }

    function upload_proposal_to_drive($upload_data){
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
        $folderId = '0B38ZX0d3LMfBVHgydlRQanRCWXM';
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

    function tambah_acara(){
        $this->load->model('panitia_model');
        $id_pengajuan = $this->input->get('id_pengajuan');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));

        $acara = $this->acara_himpunan_model->get_by(array('id_pengajuan_proposal' => $id_pengajuan));

        $panitia = ($acara) ? $this->panitia_model->get_many_by(array('id_acara' => $acara->id)) : null;

        if($panitia) {
            foreach ($panitia as $p) {
                $p->user = $this->mahasiswa_model->get_mahasiswa_dan_user_by_nim($p->nim);
            }
        }

        $data['himpunan'] = $himpunan;
        $data['user'] = $user;
        $data['id_pengajuan'] = $id_pengajuan;
        $data['acara'] = $acara;
        $data['all_panitia'] = ($panitia) ? $panitia : null;

        $this->load_page('page/private/himpunan/tambah_acara_himpunan', $data);
    }

    function do_tambah_acara(){
        // die('1');
        $id_pengajuan = $this->input->get('id_pengajuan');
        $nama_input_file = 'poster_acara';

        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $id_himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim))->id;

        // rule
        $this->form_validation->set_rules('nama_acara', 'Nama Acara', 'required');
        $this->form_validation->set_rules('tempat_acara', 'Tempat Acara', 'required');
        $this->form_validation->set_rules('tanggal_acara', 'Tanggal Acara', 'required');
        $this->form_validation->set_rules('deskripsi_acara', 'Deskripsi Acara', 'required');

        if ($this->form_validation->run() != FALSE) {
            $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
            $ext        = end($tmp);
            $filename   = $id_pengajuan.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;
    
            $data = array(
                'id'                    => $id_pengajuan,
                'id_pengajuan_proposal' => $id_pengajuan,
                'nama_acara'            => $this->input->post('nama_acara'),
                'tempat_acara'          => $this->input->post('tempat_acara'),
                'tanggal_acara'         => $this->input->post('tanggal_acara'),
                'deskripsi_acara'       => $this->input->post('deskripsi_acara'),
                'waktu_upload'          => date('Y-n-j h:i:s'),
                'poster_acara'          => $filename
            );
    
            $acara = $this->acara_himpunan_model->get_by(array('id_pengajuan_proposal' => $id_pengajuan));
    
            if (!empty($acara)) {
                $this->acara_himpunan_model->update($acara->id, $data);
                $id_acara = $acara->id;
            } else {
                $id_acara = $this->acara_himpunan_model->insert($data);
            }
    
            if($_FILES[$nama_input_file]["name"] != ""){
                $folder_name = "acara_".$id_acara;
                rmdir('./assets/upload/acara/'.$folder_name);
                mkdir('./assets/upload/acara/'.$folder_name);
                $config['upload_path']     = './assets/upload/acara/'.$folder_name."/";
                $config['allowed_types']   = 'jpg|png';
                $config['max_size']        = '1000000';
                $config['file_name']       = $filename;
    
                $this->load->library('upload' , $config);
                if( ! $this->upload->do_upload($nama_input_file)){
                    die($this->upload->display_errors);
                }
            }
            $this->session->set_flashdata(array('status' => true));
            redirect('proposal_himpunan/tambah_acara?id_pengajuan='.$id_pengajuan);
        } else {
            $this->tambah_acara();
        } 
    }

    function tambah_panitia(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        $id_pengajuan = $this->input->get('id_pengajuan');
        $acara = $this->acara_himpunan_model->get_by(array('id_acara' => $id_pengajuan));
        
        $data['acara']          = $acara ? $acara : null;
        $data['himpunan']       = $himpunan;
        $data['user']           = $user;
        $data['id_pengajuan']   = $id_pengajuan;
        $this->load_page('page/private/himpunan/tambah_acara_himpunan', $data);
    }

    function ambil_data(){
        $this->load->model('mahasiswa_model');
        $mahasiswa = $this->mahasiswa_model
            ->like('nim', $this->input->get('q')['term'])
            ->get_all();

        $data['mahasiswa'] = array();
        if (count($mahasiswa) > 0) {
            foreach ($mahasiswa as $mhs) {
                $user = $this->user_model->get_by(array('id' => $mhs->id_user));

                array_push($data['mahasiswa'], array(
                    'id'    => $mhs->nim,
                    'text'  => $mhs->nim.' - '.$user->nama
                ));
            }
        }
        
        echo json_encode($data);
    }

    function do_tambah_panitia(){
        $this->load->model('panitia_model');
        $this->form_validation->set_rules('id_acara', 'ID Acara', 'required');

        $id_acara = $this->input->get('id_acara');

        if ($this->form_validation->run() != FALSE) {
            $arr_id = $this->input->post('id_panitia');
            $arr_nim = $this->input->post('nim');
            // $arr_nama = $this->input->post('nama');
            $id_pengajuan = $this->input->post('id_pengajuan');

            $data['arr_nim'] = array();
            foreach ($arr_nim as $key => $nim) {
                // IF id panitia exist then update, nor insert, either or delete
                if ($nim[$key] != "") {
                    $data = array(
                        "nim" => $nim,
                        // "nama" => $arr_nama[$key],
                        "id_acara" => $this->input->post('id_acara')
                    );
                    if (empty($arr_id[$key])) {
                        $this->panitia_model->insert($data);
                    }else{
                        $this->panitia_model->update($arr_id[$key], $data);
                    }
                }else{
                    $this->panitia_model->delete($arr_id[$key]);
                }
            }
        }
        
        redirect('proposal_himpunan/tambah_acara?id_pengajuan='.$id_pengajuan); 
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
            $count              = $this->lpj_himpunan_model->count_by('id_pengajuan_proposal', $proposal->id);
            
            array_push($data['proposals'], array(
                'count'                     => $count,
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
            
            $this->load_page('page/private/staff/list_pengajuan_himpunan', $data);
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
            $this->load_page('page/private/staff/list_proposal_himpunan', $data);
        }else if($user->role == 'mahasiswa'){
            $data['himpunan'] = $himpunan;
            $this->load_page('page/private/himpunan/logbook_proposal_detail', $data);
        }
        
    }

    function detail_proposal(){
        $this->load->model('mahasiswa_model');
        $id_proposal = $this->input->get('id_proposal');
        $id_pengajuan = $this->input->get('id_pengajuan');

        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $proposal   = $this->proposal_himpunan_model->get_by(array('id' => $id_proposal));

        if ($user->role == 'mahasiswa') {
            $himpunan   = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        }elseif ($user->role == 'staff') {
            $pengajuan  = $this->pengajuan_proposal_himpunan_model->get_by(array('id' => $proposal->id_pengajuan_proposal));
            $pengaju    = $this->himpunan_model->get_by(array('id' => $pengajuan->pengaju_proposal));
            $pjhimpunan = $this->mahasiswa_model->get_by(array('nim' => $pengaju->id_penanggungjawab));
            $get_nama   = $this->user_model->get_by(array('id' => $pjhimpunan->id_user));

            $data['id_kepada']          = $pengaju->id;
            $data['kepada']             = $pengaju->nama;
            $data['pj']                 = $pjhimpunan->nim;
            $data['namapj']             = $get_nama->nama;
            $data['usernamepj']         = $get_nama->username;

            $data['id_pengajuan']       = $pengajuan->id;
        }
        
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
            $data['himpunan']     = $himpunan;
            $data['id_pengajuan'] = $id_pengajuan;

            $this->load_page('page/private/himpunan/detail_proposal', $data);
        }
        
    }

    //edit status pengajuan proposal untuk kaur
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
        $id_pengajuan = $this->input->get('id_pengajuan');

        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        
        $data['himpunan'] = $himpunan;
        $data['user'] = $user;
        $data['id_pengajuan'] = $id_pengajuan;

        $this->load_page('page/private/himpunan/upload_lpj_himpunan', $data);
    }

    function do_upload_lpj(){
        $id_pengajuan = $this->input->get('id_pengajuan');

        $nama_input_file = 'file_lpj';

        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $id_himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim))->id;

        // rule
        $this->form_validation->set_rules('judul_laporan', 'Judul Laporan', 'required');
        $this->form_validation->set_rules('deskripsi_laporan', 'Deskripsi Laporan', 'required');
        $this->form_validation->set_rules('ketercapaian_tujuan', 'Ketercapaian Tujuan', 'required');
        $this->form_validation->set_rules('realisasi_sasaran_kegiatan', 'Realisasi Sasaran Kegiatan', 'required');
        $this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal Pelaksanaan', 'required');
        $this->form_validation->set_rules('tempat_pelaksanaan', 'Tempat Pelaksanaan', 'required');
        $this->form_validation->set_rules('realisasi_kegiatan', 'Realisasi Kegiatan', 'required');
        $this->form_validation->set_rules('realisasi_total_anggaran', 'Realisasi Total Anggaran', 'required|integer|max_length[10]');
        $this->form_validation->set_rules('evaluasi_kegiatan', 'Evaluasi Kegiatan', 'required');
        $this->form_validation->set_rules('rekomendasi', 'Rekomendasi', 'required');
        $this->form_validation->set_rules('penutup', 'Penutup', 'required');

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->form_validation->run() != FALSE) {
                $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
                $ext        = end($tmp);
                $filename   = $id_pengajuan.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;
    
            
                $data = array(
                    'id_pengajuan_proposal'      => $id_pengajuan,
                    'judul_laporan'              => $this->input->post('judul_laporan'),
                    'deskripsi_laporan'          => $this->input->post('deskripsi_laporan'),
                    'ketercapaian_tujuan'        => $this->input->post('ketercapaian_tujuan'),
                    'realisasi_sasaran_kegiatan' => $this->input->post('realisasi_sasaran_kegiatan'),
                    'tanggal_pelaksanaan'        => $this->input->post('tanggal_pelaksanaan'),
                    'tempat_pelaksanaan'         => $this->input->post('tempat_pelaksanaan'),
                    'realisasi_kegiatan'         => $this->input->post('realisasi_kegiatan'),
                    'realisasi_total_anggaran'   => $this->input->post('realisasi_total_anggaran'),
                    'evaluasi_kegiatan'          => $this->input->post('evaluasi_kegiatan'),
                    'rekomendasi'                => $this->input->post('rekomendasi'),
                    'penutup'                    => $this->input->post('penutup'),
                    'waktu_upload'               => date('Y-n-j h:i:s'),
                    'file'                       => $filename
                );
    
                $id_lpj = $this->lpj_himpunan_model->insert($data);
            
                $this->load->library('upload', $this->config_upload);

                if ($this->upload->do_upload($nama_input_file)) {
                    $upload_data = $this->upload->data();
                    $upload_data['orig_name'] = $filename;
                    $this->upload_lpj_to_drive($upload_data);
                    unlink($upload_data['full_path']);
                    $this->session->set_userdata('notif_upload', true);
                }else{
                    $this->session->set_userdata('notif_upload', false);
                }
                redirect('proposal_himpunan/logbook_lpj');
            } else {
                $this->upload_lpj();
            }
        } else {
            redirect('proposal_himpunan/logbook_lpj'); 
        }
    }

    function upload_lpj_to_drive($upload_data){
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
        $folderId = '0B38ZX0d3LMfBU0pnSXFuZTIzQTg';
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

    function logbook_lpj(){
        $id_pengajuan = $this->input->get('id_pengajuan');

        $user      = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        if ($user->role == 'mahasiswa') {
            $himpunan  = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
            $proposal  = $this->logbook_proposal_himpunan_model->get_by(array('pengaju' => $himpunan->id, 'status_approve' => 'y'));
            $pengaju   = $this->himpunan_model->get_by(array('id' => $proposal->pengaju));
            $lpjs      = $this->lpj_himpunan_model->get_all();

            $data['lpjs'] = array();
            foreach ($lpjs as $lpj) { 

                array_push($data['lpjs'], array(
                    'id'                => $lpj->id,
                    'pengaju'           => $pengaju->nama,
                    'judul_laporan'     => $lpj->judul_laporan,
                    'tanggal_upload'    => $lpj->waktu_upload
                    ));
            }

            $data['himpunan'] = $himpunan;
            $this->load_page('page/private/himpunan/logbook_lpj', $data);

        }elseif ($user->role == 'staff') {
            $lpjs      = $this->lpj_himpunan_model->get_many_by(array('id_pengajuan_proposal' => $id_pengajuan));
            $proposal  = $this->logbook_proposal_himpunan_model->get_by(array('id' => $id_pengajuan));
            $himpunan  = $this->himpunan_model->get_by(array('id' => $proposal->pengaju));

            $data['lpjs'] = array();
            foreach ($lpjs as $lpj) { 
                $proposal  = $this->logbook_proposal_himpunan_model->get_by(array('id' => $lpj->id_pengajuan_proposal));
                $himpunan  = $this->himpunan_model->get_by(array('id' => $proposal->pengaju));

                array_push($data['lpjs'], array(
                    'id'                => $lpj->id,
                    'pengaju'           => $himpunan->nama,
                    'judul_pengajuan'   => $proposal->judul,
                    'judul_laporan'     => $lpj->judul_laporan,
                    'tanggal'           => $lpj->waktu_upload
                    ));
            }

            $this->load_page('page/private/staff/list_lpj_himpunan', $data);
        }       

    }

    function detail_lpj(){
        $id_lpj = $this->input->get('id_lpj');
        
        $user       = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        if ($user->role == 'mahasiswa') {
            $himpunan   = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        }

        $lpj        = $this->lpj_himpunan_model->get_by(array('id' => $id_lpj));
        
        $data['id']                         = $lpj->id;
        $data['judul_laporan']              = $lpj->judul_laporan;
        $data['deskripsi_laporan']          = $lpj->deskripsi_laporan;
        $data['ketercapaian_tujuan']        = $lpj->ketercapaian_tujuan;
        $data['realisasi_sasaran_kegiatan'] = $lpj->realisasi_sasaran_kegiatan;
        $data['tanggal_pelaksanaan']        = $lpj->tanggal_pelaksanaan;
        $data['tempat_pelaksanaan']         = $lpj->tempat_pelaksanaan;
        $data['realisasi_kegiatan']         = $lpj->realisasi_kegiatan;
        $data['realisasi_total_anggaran']   = $lpj->realisasi_total_anggaran;
        $data['evaluasi_kegiatan']          = $lpj->evaluasi_kegiatan;
        $data['rekomendasi']                = $lpj->rekomendasi;
        $data['penutup']                    = $lpj->penutup;

        
        
        if ($user->role == 'staff') {
            $this->load_page('page/private/staff/detail_lpj_himpunan', $data);
        }else{
            $data['himpunan'] = $himpunan;
            $this->load_page('page/private/himpunan/logbook_lpj_detail', $data);  
        }     
    }   
}
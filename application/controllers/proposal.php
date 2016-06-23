<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposal extends Private_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('proposal_lomba_model');
        $this->load->model('pengajuan_proposal_mahasiswa_model');
        $this->load->model('staff_model');
        $this->load->model('event_model');
        $this->load->model('detail_tim_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('logbook_detail_tim_model');

        //config upload
        $this->config_upload['upload_path']     = './assets/upload/proposal_lomba';
        $this->config_upload['allowed_types']   = 'pdf|doc|docx';
        $this->config_upload['max_size']        = '30000';

        //form validasi
        $this->load->library('form_validation');
    }

    function cetak() {
        $this->load_page('page/private/staff/surattugas_detail_cetak', $this->get_cetak_data());
    }

    function do_cetak(){
        $this->load->view('page/private/staff/surattugas_cetak', $this->get_cetak_data());
    }

    private function get_cetak_data(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        if($user->roled_data->jenis != 'staff_admin' || null == $this->input->get('id')) show_404();

        $id_pengajuan = $this->input->get('id');

        $this->load->model('logbook_proposal_mhs_model');
        $proposal                   = $this->logbook_proposal_mhs_model->get_by(array('id_pengajuan' => $id_pengajuan));
        $proposal->lengkap          = $this->proposal_lomba_model->get($proposal->id_proposal);
        $proposal->detail_pengaju   = $this->mahasiswa_model->get_mahasiswa_dan_user_by_nim($proposal->pengaju);
        $proposal->tim              = $this->detail_tim_model->get_many_by(array('id_proposal_lomba' => $proposal->id_proposal));
        foreach ($proposal->tim as $t) {
            $t->mahasiswa = $this->mahasiswa_model->get_mahasiswa_dan_user_by_nim($t->nim_anggota);
        }
        $proposal->pengajuan        = $this->pengajuan_proposal_mahasiswa_model->get($proposal->id_pengajuan);
        $proposal->pengajuan->event = $this->event_model->get($proposal->pengajuan->id_event);

        $proposal->tanggal_kompetisi_display = $this->get_tanggal_formatted($proposal->tanggal_kompetisi);

        $data['proposal']           = $proposal;
        $data['tanggal_display']    = $this->get_tanggal_formatted(date('Y-m-d'));

        return $data;
    }

    function upload_pengajuan (){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $data['events'] = $this->event_model->order_by('tanggal_mulai')->get_many_by(array('status' => 'disetujui'));

        $this->load_page('page/private/mahasiswa/upload_pengajuan_proposal', $data);
    }

    function do_upload_pengajuan(){
        $nama_input_file = 'file_pengajuan';
        //user yg login
        $user           = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
            // rule
        $this->form_validation->set_rules('kategori_kompetisi', 'Kategori Kompetisi', 'required');
        $this->form_validation->set_rules('tujuan_kompetisi', 'Tujuan Kompetisi', 'required');
        $this->form_validation->set_rules('tanggal_kompetisi', 'Tanggal Kompetisi', 'required');
        $this->form_validation->set_rules('sasaran_kompetisi', 'Sasaran Kompetisi', 'required');
        $this->form_validation->set_rules('anggaran_biaya', 'Anggaran Biaya', 'required|integer|max_length[11]');
        $this->form_validation->set_rules('tempat_kompetisi', 'Tempat Kompetisi', 'required');
        $this->form_validation->set_rules('nama_tim', 'Nama Tim', 'required');

        $data = array(
            'id_event'          => $this->input->post('event'),
            'pengaju_proposal'  => $user->roled_data->nim
            );

        if ($data['id_event']!=null){
            $pengaju = $this->pengajuan_proposal_mahasiswa_model->insert($data);
            $this->session->set_userdata('id_pengajuan', $pengaju);
            
            $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
            $ext        = end($tmp);
            $filename   = $pengaju.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;

            if ( ! file_exists($this->config_upload['upload_path'])) {
               mkdir($this->config_upload['upload_path'], 0777, true);
            }

            $this->load->library('upload', $this->config_upload);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($this->form_validation->run() !== FALSE) {
                                        
                    if ($this->upload->do_upload($nama_input_file)) {
                        $upload_data = $this->upload->data();
                        $upload_data['orig_name'] = $filename;

                        $created_file = $this->upload_proposal_to_drive($upload_data);
                        unlink($upload_data['full_path']);
                        
                        $data = array(
                            'id_pengajuan_proposal_mahasiswa' => $pengaju,
                            'kategori_kompetisi'    => $this->input->post('kategori_kompetisi'),
                            'tujuan_kompetisi'      => $this->input->post('tujuan_kompetisi'),
                            'sasaran_kompetisi'     => $this->input->post('sasaran_kompetisi'),
                            'tanggal_kompetisi'     => $this->input->post('tanggal_kompetisi'),
                            'tempat_kompetisi'      => $this->input->post('tempat_kompetisi'),
                            'anggaran_biaya'        => $this->input->post('anggaran_biaya'),
                            'nama_tim'              => $this->input->post('nama_tim'),
                            'pembimbing'            => $this->input->post('pembimbing'),
                            'waktu_upload'          => date('Y-n-j h:i:s'),
                            'file'                  => $filename,
                            'drive_id'              => $created_file->id
                        );
                    
                        $id_upload_proposal = $this->proposal_lomba_model->insert($data);
                        $this->session->set_userdata('id_proposal', $id_upload_proposal);

                        $this->session->set_userdata('notif_upload', true);
                    }else{
                        echo $this->upload->display_errors();
                        $this->session->set_userdata('notif_upload', false);    
                    }
                    $this->load_page('page/private/mahasiswa/upload_tim', $data); 
                } else {
                    $this->upload_pengajuan();
                }
                $this->session->set_flashdata(array('status' => true));
                
            } else{
                $data['user'] = $user;
            }
        } else {
           $this->load_page('page/private/mahasiswa/upload_tim');
        }
    }

    function upload_proposal_to_drive($upload_data){
        $this->load->library('google_drive');
        $this->config->load('google_drive');

        return $this->google_drive->insertFile(
            $upload_data['orig_name'], 
            $upload_data['file_type'], 
            $this->config->item('proposal_lomba_folder_id'), 
            $upload_data['full_path']
            );

        $this->session->set_userdata('notif_upload', true);
    }

    function upload_proposal (){
        $id_pengajuan           = $this->input->get('id_pengajuan');
        $user                   = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $data['user']           = $user;
        $data['id_pengajuan']   = $id_pengajuan;
        $this->load_page('page/private/mahasiswa/upload_proposal',  $data);
    }

    function do_upload_proposal(){
        $nama_input_file = 'file_pengajuan';

        $id_pengajuan = $this->input->get('id_pengajuan');
        $user         = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        
        $this->load->library('upload', $this->config_upload);
        $data = array(
            'id_pengajuan_proposal_mahasiswa'   => $this->session->userdata('id_pengajuan'),
            'kategori_kompetisi'                => $this->input->post('kategori_kompetisi'),
            'pembimbing'                        => $this->input->post('pembimbing'),
            'tujuan_kompetisi'                  => $this->input->post('tujuan_kompetisi'),
            'sasaran_kompetisi'                 => $this->input->post('sasaran_kompetisi'),
            'tanggal_kompetisi'                 => $this->input->post('tanggal_kompetisi'),
            'tempat_kompetisi'                  => $this->input->post('tempat_kompetisi'),
            'anggaran_biaya'                    => $this->input->post('anggaran_biaya'),
            'nama_tim'                          => $this->input->post('nama_tim'),
            'waktu_upload'                      => date('Y-n-j h:i:s')
        );

        if($data['kategori_kompetisi'] != null){
            $tmp        = explode(".", $_FILES['file_pengajuan']['name']);
            $ext        = end($tmp);
            $filename   = sha1($_FILES['file_pengajuan']['name']).'.'.$ext; 

            if ( ! file_exists($this->config_upload['upload_path'])) {
               mkdir($this->config_upload['upload_path'], 0777, true);
            }

            $data['file'] = $filename;

            $this->session->set_userdata('id_pengajuan', $id_pengajuan);
            $data['file'] = $filename;

            if ($this->upload->do_upload($nama_input_file)) {
                $upload_data = $this->upload->data();
                $upload_data['orig_name'] = $filename;

                $created_file = $this->upload_proposal_to_drive($upload_data);
                unlink($upload_data['full_path']);

                $data['drive_id'] = $created_file->id;
                $id_upload_proposal = $this->proposal_lomba_model->insert($data);
                $this->session->set_userdata('id_proposal', $id_upload_proposal);

                $this->session->set_userdata('notif_upload', true);
            } else{
                die($this->upload->display_errors()); 
            }

            //gawe nampilno status
            $this->session->set_flashdata(array('status' => true));
            $this->load_page('page/private/mahasiswa/upload_tim', $data);  
        } else {
            $this->load_page('page/private/mahasiswa/upload_tim', $data); 
        }
        
    }

    function logbook_pengajuan_proposal_lomba(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $this->load->model('logbook_proposal_mhs_model');

        if ($user->role == 'staff') {
            $proposals  = $this->logbook_proposal_mhs_model->get_many_by(array('status' => 'y', 'tanggal_kompetisi >=' => date('Y-m-d')));
        }else if($user->role == 'mahasiswa') {
            $proposals  = $this->logbook_proposal_mhs_model->get_many_by(array('pengaju' => $user->roled_data->nim));
        }

        $data['user']       = $user;
        $data['proposals']  = array();
        foreach ($proposals as $proposal) {
            $pengaju            = $this->mahasiswa_model->get_by(array('nim' => $proposal->pengaju));
            $staff              = $this->staff_model->get_by(array('nip' => $proposal->penanggungjawab));
            $penanggungjawab    = ($staff == null) ? null : $this->user_model->get($staff->id_user);

            array_push($data['proposals'], $proposal);
        }

        $this->load_page('page/private/mahasiswa/logbook_pengajuan_proposal_lomba', $data);
    }

    function detail_pengajuan(){
        $id_pengajuan = $this->input->get('id_pengajuan');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $this->load->model('logbook_proposal_mhs_model');

        $proposals  = $this->proposal_lomba_model->get_many_by(array('id_pengajuan_proposal_mahasiswa' => $id_pengajuan));

        $data['proposals'] = array();
        $status;
        foreach ($proposals as $proposal) {

            array_push($data['proposals'], array(
                'id_proposal'               => $proposal->id,
                'waktu_upload'              => $proposal->waktu_upload,
                'nama_tim'                  => $proposal->nama_tim,
                'status'                    => ($proposal->status == null) ? '-' :$proposal->status
            ));
            $status = $proposal->status;
        }

        $data['id_pengajuan_proposal_mahasiswa']   = $id_pengajuan;
        $data['status'] = $status;

        if ($user->role == 'staff') {
            $this->load_page('page/private/staff/logbook_detail_pengajuan', $data);
        }else if($user->role == 'mahasiswa'){
            $data['user'] = $user;
            $this->load_page('page/private/mahasiswa/logbook_detail_pengajuan', $data);
        }
    }

    function detail_proposal(){
        $id_proposal        = $this->input->get('id_proposal');
        $data['proposal']   = $id_proposal;
        $user               = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $proposal           = $this->proposal_lomba_model->get_by(array('id' => $id_proposal));

        $id_pengajuan_proposal_mahasiswa = $this->input->get('id_pengajuan');
        $id_event = $this->pengajuan_proposal_mahasiswa_model->get_by(array('id' => $id_pengajuan_proposal_mahasiswa));
        $event      = $this->event_model->get_by(array('id' => $id_event->id_event));


        $data['id_pengajuan_proposal_mahasiswa']    = $proposal->id_pengajuan_proposal_mahasiswa;
        $data['id']                 = $proposal->id;
        $data['penyelenggara']      = $event->penyelenggara;
        $data['tingkat_kompetisi']  = $event->tingkat_kompetisi;            
        $data['kategori_kompetisi'] = $proposal->kategori_kompetisi;
        $data['tujuan_kompetisi']   = $proposal->tujuan_kompetisi;
        $data['tanggal_kompetisi']  = $proposal->tanggal_kompetisi;
        $data['tempat_kompetisi']   = $proposal->tempat_kompetisi;
        $data['anggaran_biaya']     = $proposal->anggaran_biaya;
        $data['nama_tim']           = $proposal->nama_tim;
        $data['sasaran_kompetisi']  = $proposal->sasaran_kompetisi;
        $data['pembimbing']         = $proposal->pembimbing;

        $data['user']       = $user;
        $this->load_page('page/private/mahasiswa/logbook_detail_proposal', $data);
    }

    function detail_tim(){
        $id_proposal        = $this->input->get('id_proposal');
        $user               = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $data['tims']       = $this->logbook_detail_tim_model->get_many_by(array('id' => $id_proposal));
        
        $this->load_page('page/private/mahasiswa/logbook_detail_tim', $data);
    }



    function upload_tim(){ 
        $arr_nim = $this->input->post('nim');
        $data['arr_nim'] = array();

        foreach ($arr_nim as $key => $nim) {
            // IF id panitia exist then update, nor insert, either or delete
            if ($nim[$key] != "") {
                $data = array(
                    "nim" => $nim,
                );
            }
             $data = array(
                        'id_proposal_lomba'         => $this->session->userdata('id_proposal'),
                        'nim_anggota'               => $data['nim']
                    ); 
              $id_detail_tim = $this->detail_tim_model->insert($data);
             echo $data['nim_anggota'];
        }
        redirect('proposal/logbook_pengajuan_proposal_lomba');
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
}

/* End of file proposal.php */
/* Location: ./application/controllers/proposal.php */ 
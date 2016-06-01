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
	}

    function upload_pengajuan (){
        // $this->load->model('user_model');
        // $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
        // $this->load_page('page/private/'.$user_data->role.'/pengajuan_proposal', null);
    	$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $data['events'] = $this->event_model->order_by('tanggal_event')->get_many_by(array('status' => 'disetujui'));

        $this->load_page('page/private/mahasiswa/upload_pengajuan_proposal', $data);
    }


    function do_upload_pengajuan(){
        //user yg login
        $user           = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $data = array(
            'id_event'          => $this->input->post('event'),
            'pengaju_proposal'  => $user->roled_data->nim
            );

        $pengaju = $this->pengajuan_proposal_mahasiswa_model->insert($data);
        
        $data = array(
            'id_pengajuan_proposal_mahasiswa' => $pengaju,
            'penyelenggara'         => $this->input->post('penyelenggara'),
            'tingkat_kompetisi'     => $this->input->post('tingkat_kompetisi'),
            'tema_kompetisi'        => $this->input->post('tema_kompetisi'),
            'tujuan_kompetisi'      => $this->input->post('tujuan_kompetisi'),
            'sasaran_kompetisi'     => $this->input->post('sasaran_kompetisi'),
            'tanggal_kompetisi'     => $this->input->post('tanggal_kompetisi'),
            'tempat_kompetisi'      => $this->input->post('tempat_kompetisi'),
            'anggaran_biaya'        => $this->input->post('anggaran_biaya'),
            'nama_tim'              => $this->input->post('nama_tim'),
            'waktu_upload'          => date('Y-n-j h:i:s')
        );

        $tmp        = explode(".", $_FILES['file_pengajuan']['name']);
        $ext        = end($tmp);
        $filename   = sha1($_FILES['file_pengajuan']['name']).'.'.$ext;
        $data['file'] = $filename;
        $id_upload_proposal = $this->proposal_lomba_model->insert($data);
        for($i=1; $i <= 5; $i++){
            if ($this->input->post('nim_anggota'.$i) == "") {
                continue;
            }else{
                $data = array(
                    'id_proposal_lomba'     => $id_upload_proposal,
                    'nim_anggota'               => $this->input->post('nim_anggota'.$i)
                ); 
                $id_detail_tim = $this->detail_tim_model->insert($data);  
              
            }
            
        }

        $this->session->set_flashdata(array('status' => true));
        redirect('proposal/logbook_pengajuan_proposal_lomba');
    
    	// $nama_input_file = 'file_pengajuan';

     //    $this->load->model('user_model');
     //    $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
     //    $get_id_staff = $this->staff_model->get_all();
     //    $penanggungjawab = $this->event_model->get_by(array('penanggungjawab' => $get_id_staff->nip));
     //    $pengaju = $this->pengajuan_proposal_mahasiswa_model->get_by(array('pengaju_proposal' => $user->roled_data->nim));


     //    //$id_himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim))->id;

     //    // $this->load->model('pengajuan_proposal_himpunan_model');
     //    $last_id_pengajuan_proposal = $this->pengajuan_proposal_mahasiswa_model->insert(array('pengaju_proposal' => $pengaju));

     //    $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
     //    $ext        = end($tmp);
     //    $filename   = $last_id_pengajuan_proposal.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;

     //    $path = './assets/upload/proposal_mahasiswa/pengajuan-'.$last_id_pengajuan_proposal.'/';
     //    if(!is_dir($path)) {
     //        mkdir($path, 0777, true);
     //    }

     //    $config['upload_path']      = $path;
     //    $config['allowed_types']    = '*';
     //    $config['file_name']        = $filename;

     //    $this->load->library('upload', $config);

     //    if ( ! $this->upload->do_upload($nama_input_file)) {
     //        rmdir($path);
     //        $this->pengajuan_proposal_himpunan_model->delete($last_id_pengajuan_proposal);
     //        $this->session->set_flashdata('error', $this->upload->display_errors());
     //    } else {
     //        date_default_timezone_set("Asia/Jakarta");
     //        $data = array(
     //            'id_pengajuan_proposal' => $last_id_pengajuan_proposal,
     //            'nama_kompetisi'        => $this->input->post('nama_kompetisi'),
     //            'penyelenggara'         => $this->input->post('penyelenggara'),
     //            'tingkat_kompetisi'     => $this->input->post('tingkat_kompetisi'),
     //            'tema_kompetisi'        => $this->input->post('tema_kompetisi'),
     //            'tujuan_kompetisi'      => $this->input->post('tujuan_kompetisi'),
     //            'sasaran_kompetisi'     => $this->input->post('sasaran_kompetisi'),
     //            'tanggal_kompetisi'     => $this->input->post('tanggal_kompetisi'),
     //            'tempat_kompetisi'      => $this->input->post('tempat_kompetisi'),
     //            'anggaran'              => $this->input->post('anggaran'),
     //            'file'                  => $this->upload->data()['file_name']
     //        );

     //        $id_proposal = $this->proposal_lomba_model->insert($data);
     //        if ($this->input->post('drive_upload') == 1) {
     //            $this->session->set_userdata('upload_data', $upload_data);
     //            $this->get_google_client();
     //        }

     //        $this->session->set_flashdata(array('status' => true));

     //    }

     //    redirect('proposal'); 

    }


    function logbook_pengajuan_proposal_lomba(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $this->load->model('logbook_proposal_mhs_model');

        if ($user->role == 'staff') {
            $proposals  = $this->logbook_proposal_mhs_model->get_all();
        }else if($user->role == 'mahasiswa') {
            $proposals  = $this->logbook_proposal_mhs_model->get_many_by(array('pengaju' => $user->roled_data->nim));
        }

        $data['proposals'] = array();
        foreach ($proposals as $proposal) {
            $pengaju            = $this->mahasiswa_model->get_by(array('nim' => $proposal->pengaju));
            $staff              = $this->staff_model->get_by(array('nip' => $proposal->penanggungjawab));
            $penanggungjawab    = ($staff == null) ? null : $this->user_model->get($staff->id_user);

            array_push($data['proposals'], array(
                'nama_event'                => $proposal->nama_event,
                'tanggal_pengajuan'         => $proposal->tanggal_pengajuan,
                'tanggal_proposal_terakhir' => $proposal->tanggal_proposal_terakhir,
                'status'            => $proposal->status,
                // 'nama_tim'                  => $proposal->nama_tim
                'penanggungjawab'           => ($penanggungjawab == null) ? '-' : $penanggungjawab->nama
                ));
        }

       
        if ($user->role == 'staff') {
            $this->load_page('page/private/staff/logbook_proposal_himpunan', $data);
        }else if($user->role == 'mahasiswa'){
            $data['user'] = $user;
            $this->load_page('page/private/mahasiswa/logbook_pengajuan_proposal_lomba', $data);
        }

        
    }

    function upload_proposal(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $data['user'] = $user;
        $this->load_page('page/private/mahasiswa/upload_proposal', $data);
    }

    function detail_pengajuan(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $data['user'] = $user;
        $this->load_page('page/private/mahasiswa/logbook_detail_pengajuan', $data);
    }

    function detail_tim(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $data['user'] = $user;
        $this->load_page('page/private/mahasiswa/logbook_detail_tim', $data);
    }
}

/* End of file proposal.php */
/* Location: ./application/controllers/proposal.php */
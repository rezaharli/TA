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
        $this->session->set_userdata('id_pengajuan', $pengaju);
        
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
        $this->session->set_userdata('id_proposal', $id_upload_proposal);
        //gawe nampilno status
        $this->session->set_flashdata(array('status' => true));
        $data['user'] = $user;
        $this->load_page('page/private/mahasiswa/upload_tim', $data);;
    }


    function upload_proposal (){
        $id_pengajuan           = $this->input->get('id_pengajuan');
        $user                   = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $data['user']           = $user;
        $data['id_pengajuan']   = $id_pengajuan;
        $this->load_page('page/private/mahasiswa/upload_proposal',  $data);
    }


    function do_upload_proposal(){

        $id_pengajuan = $this->input->get('id_pengajuan');
        $user         = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $data = array(
            'id_pengajuan_proposal_mahasiswa'   => $this->session->userdata('id_pengajuan'),
            'penyelenggara'                     => $this->input->post('penyelenggara'),
            'tingkat_kompetisi'                 => $this->input->post('tingkat_kompetisi'),
            'tema_kompetisi'                    => $this->input->post('tema_kompetisi'),
            'tujuan_kompetisi'                  => $this->input->post('tujuan_kompetisi'),
            'sasaran_kompetisi'                 => $this->input->post('sasaran_kompetisi'),
            'tanggal_kompetisi'                 => $this->input->post('tanggal_kompetisi'),
            'tempat_kompetisi'                  => $this->input->post('tempat_kompetisi'),
            'anggaran_biaya'                    => $this->input->post('anggaran_biaya'),
            'nama_tim'                          => $this->input->post('nama_tim'),
            'waktu_upload'                      => date('Y-n-j h:i:s')
        );
        $this->session->set_userdata('id_pengajuan', $id_pengajuan);

        $tmp        = explode(".", $_FILES['file_pengajuan']['name']);
        $ext        = end($tmp);
        $filename   = sha1($_FILES['file_pengajuan']['name']).'.'.$ext;
        $data['file'] = $filename;
        $id_upload_proposal = $this->proposal_lomba_model->insert($data);
        $this->session->set_userdata('id_proposal', $id_upload_proposal);

        //gawe nampilno status
        $this->session->set_flashdata(array('status' => true));
        $this->load_page('page/private/mahasiswa/upload_tim', $data);
    }

    function upload_tim(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
            for($i=1; $i <= 6; $i++){
                    if ($this->input->post('nim_anggota'.$i) == "") {
                        continue;
                    }else{
                        $data = array(
                            'id_proposal_lomba'         => $this->session->userdata('id_proposal'),
                            'nim_anggota'               => $this->input->post('nim_anggota'.$i)
                        ); 
                        $id_detail_tim = $this->detail_tim_model->insert($data);
                    }            
            }
        redirect('proposal/logbook_pengajuan_proposal_lomba');
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
                'id_pengajuan'              => $proposal->id_pengajuan,
                'nama_event'                => $proposal->nama_event,
                'tanggal_pengajuan'         => $proposal->tanggal_pengajuan,
                'tanggal_proposal_terakhir' => $proposal->tanggal_proposal_terakhir,
                'status'                    => $proposal->status,
                'nama_tim'                  => $proposal->nama_tim,
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

        $data['id_pengajuan_proposal_mahasiswa']    = $proposal->id_pengajuan_proposal_mahasiswa;
        $data['id']                 = $proposal->id;
        $data['penyelenggara']      = $proposal->penyelenggara;
        $data['tingkat_kompetisi']  = $proposal->tingkat_kompetisi;
        $data['tema_kompetisi']     = $proposal->tema_kompetisi;
        $data['tujuan_kompetisi']   = $proposal->tujuan_kompetisi;
        $data['tanggal_kompetisi']  = $proposal->tanggal_kompetisi;
        $data['tempat_kompetisi']   = $proposal->tempat_kompetisi;
        $data['anggaran_biaya']     = $proposal->anggaran_biaya;
        $data['nama_tim']           = $proposal->nama_tim;
        $data['sasaran_kompetisi']  = $proposal->sasaran_kompetisi;

        $data['user']       = $user;
        $this->load_page('page/private/mahasiswa/logbook_detail_proposal', $data);
    }

    function detail_tim(){
        $id_proposal        = $this->input->get('id_proposal');
        $user               = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $data['tims']       = $this->logbook_detail_tim_model->get_many_by(array('id' => $id_proposal));
        
        $this->load_page('page/private/mahasiswa/logbook_detail_tim', $data);
    }
}

/* End of file proposal.php */
/* Location: ./application/controllers/proposal.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proposal_mahasiswa extends Private_Controller{
	protected $user;

    public function __construct(){
        parent::__construct();
        // assign variable user from session
        $this->user = $this->session->userdata('logged_in_user');
        // load models
        $this->load->model('user_model');
        $this->load->model('event_model');
        $this->load->model('staff_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('proposal_lomba_model');
        $this->load->model('logbook_proposal_mhs_model');
        $this->load->model('pengajuan_proposal_mahasiswa_model');
    }

    function index(){
    	$this->logbook_pengajuan();
    }

    function logbook_pengajuan(){
    	$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $proposals  = $this->logbook_proposal_mhs_model->get_all();
        $data['proposals'] = array();
        foreach ($proposals as $proposal) {
        	$pengajuan 		= $this->pengajuan_proposal_mahasiswa_model->get($proposal->id_pengajuan);
        	$get_event 			= $this->event_model->get($pengajuan->id_event);
            $get_id_mhs         = $this->mahasiswa_model->get_by(array('nim' => $proposal->pengaju));
            $pengaju 			= $this->user_model->get_by(array('id' => $get_id_mhs->id_user));
            $get_id_staff       = $this->staff_model->get_by(array('nip' => $proposal->penanggungjawab));
            $penanggungjawab    = ($get_id_staff == null) ? null : $this->user_model->get($get_id_staff->id_user);

            //$count              = $this->lpj_himpunan_model->count_by('id_pengajuan_proposal', $proposal->id);
            
            array_push($data['proposals'], array(
                'id'                        => $proposal->id_pengajuan,
                'id_event'					=> $get_event->id,
                'event'						=> $get_event->nama_event,
                'username'					=> $pengaju->username,
                'pengaju'                   => $pengaju->nama,
                'tanggal_pengajuan'         => $proposal->tanggal_pengajuan,
                'tanggal_proposal_terakhir' => $proposal->tanggal_proposal_terakhir,
                'status_approve'            => $proposal->status,
                'penanggungjawab'           => ($penanggungjawab == null) ? '-' : $penanggungjawab->nama
                ));
        }

        $this->load_page('page/private/staff/list_pengajuan_mahasiswa', $data);
        
    }

    function logbook_proposal(){
    	$id_pengajuan = $this->input->get('id_pengajuan');

        $user       = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $proposals  = $this->proposal_lomba_model->get_many_by(array('id_pengajuan_proposal_mahasiswa' => $id_pengajuan));

        $data['proposals'] = array();
        foreach ($proposals as $proposal) {

            array_push($data['proposals'], array(
                'id'		        => $proposal->id,
                'waktu_upload'		=> $proposal->waktu_upload,
                'kategori'          => $proposal->kategori_kompetisi,
                'tanggal_kompetisi' => $proposal->tanggal_kompetisi,
                'nama_tim'			=> $proposal->nama_tim,
                'pembimbing'		=> $proposal->pembimbing,
                'status_approve'    => ($proposal->status == null) ? '-' :$proposal->status
            ));
        }        

        if ($user->role == 'staff') {
            $this->load_page('page/private/staff/list_proposal_mahasiswa', $data);
        }
    }

    function detail_proposal(){
        $id_proposal = $this->input->get('id_proposal');

        $user 	   = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $proposal  = $this->proposal_lomba_model->get_by(array('id' => $id_proposal));
        $pengajuan = $this->pengajuan_proposal_mahasiswa_model->get($proposal->id_pengajuan_proposal_mahasiswa);
        $event 	   = $this->event_model->get($pengajuan->id_event);

        $data['id']                = $proposal->id;
        $data['event']			   = $event->nama_event;
        $data['tujuan_kompetisi']  = $proposal->tujuan_kompetisi;
        $data['sasaran_kompetisi'] = $proposal->sasaran_kompetisi;
        $data['tempat_kompetisi']  = $proposal->tempat_kompetisi;
        $data['biaya']			   = $proposal->anggaran_biaya;
        $data['status'] 		   = ($proposal->status == null) ? '-' :$proposal->status;

        if ($user->role == 'staff') {
            $this->load_page('page/private/staff/detail_proposal_mahasiswa', $data);
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

        $this->proposal_lomba_model->update($id, array('status' => $status, 'penyetuju' => $penyetuju->nip));

        redirect(base_url('proposal_mahasiswa/detail_proposal?id_proposal='.$id));
    }
}
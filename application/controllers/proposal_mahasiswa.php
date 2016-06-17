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
        $this->load->model('staff_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('logbook_proposal_mhs_model');
    }

    function index(){
    	$this->logbook_pengajuan();
    }

    function logbook_pengajuan(){
    	$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $proposals  = $this->logbook_proposal_mhs_model->get_all();
        $data['proposals'] = array();
        foreach ($proposals as $proposal) {
            $get_id_mhs         = $this->mahasiswa_model->get_by(array('nim' => $proposal->pengaju));
            $pengaju 			= $this->user_model->get_by(array('id' => $get_id_mhs->id_user));
            $get_id_staff       = $this->staff_model->get_by(array('nip' => $proposal->penanggungjawab));
            $penanggungjawab    = ($get_id_staff == null) ? null : $this->user_model->get($get_id_staff->id_user);

            //$count              = $this->lpj_himpunan_model->count_by('id_pengajuan_proposal', $proposal->id);
            
            array_push($data['proposals'], array(
                'id'                        => $proposal->id_pengajuan,
                'pengaju'                   => $pengaju->nama,
                'tanggal_pengajuan'         => $proposal->tanggal_pengajuan,
                'judul'                     => $proposal->judul,
                'tanggal_proposal_terakhir' => $proposal->tanggal_proposal_terakhir,
                'status_approve'            => $proposal->status_approve,
                'penanggungjawab'           => ($penanggungjawab == null) ? '-' : $penanggungjawab->nama
                ));
        }

        $this->load_page('page/private/staff/list_pengajuan_mahasiswa', $data);
        
    }
}
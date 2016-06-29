<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends Private_Controller {
	
	function __construct() {
		parent::__construct();
        // assign variable user from session
        $this->user = $this->session->userdata('logged_in_user');
        // load models
        $this->load->model('user_model');
        $this->load->model('event_model');
        $this->load->model('detail_tim_model');
        $this->load->model('staff_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('proposal_lomba_model');
        $this->load->model('logbook_proposal_mhs_model');
        $this->load->model('pengajuan_proposal_mahasiswa_model');
	}

    function index (){
        $this->mahasiswalomba();
    }

    function mahasiswalomba(){
    	$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $mahasiswa  = $this->detail_tim_model->get_all();
        $data['mahasiswa'] = array();
        foreach ($mahasiswa as $mhs) {
            $getevent = $this->event_model->get_by(array('id' => $pengajuan->id_event));
        	$proposal = $this->proposal_lomba_model->get_by(array('id' => $mhs->id_proposal_lomba));
        	$getnim	  = $this->mahasiswa_model->get_by(array('nim' => $mhs->nim_anggota));
        	$getnama  = $this->user_model->get_by(array('id' => $getnim->id_user));

        	$pengajuan = $this->pengajuan_proposal_mahasiswa_model->get_by(array('id' => $proposal->id_pengajuan_proposal_mahasiswa));
        	
            
            if ($proposal->status == 'y'){
            	array_push($data['mahasiswa'], array(
            		'nim'		=> $mhs->nim_anggota,
                	'namamhs'	=> $getnama->nama,
                	'lomba'		=> $getevent->nama_event
                ));
            }
            
        }

        $this->load_page('page/private/staff/report_mahasiswa_lomba', $data);
    }

    function hitung(){
        $jumlah = $this->pengajuan_proposal_mahasiswa_model->get_jumlah_proposal();
        $data['jumlah'] = array();

        foreach ($jumlah as $j) {
            array_push($data['jumlah'], array(
                    'id_event'   => $j->id_event,
                    'nama_event' => $j->nama_event,
                    'jumlah'     => $j->jumlah
                ));
        }

        $this->load_page('page/private/staff/report_jumlah_per_event', $data);
    }

    function detail($id){
        $pengajuan = $this->pengajuan_proposal_mahasiswa_model->get_detail_tim();

        $data['pengajuan'] = array();
        foreach ($pengajuan as $p) {
            $getnim   = $this->mahasiswa_model->get_by(array('nim' => $p->nim_anggota));
            $getnama  = $this->user_model->get_by(array('id' => $getnim->id_user));

            if ($p->id_event == $id) {
                array_push($data['pengajuan'], array(
                    'nim'       => $p->nim_anggota,
                    'nama'      => $getnama->nama,
                ));
            }
            
        }
        $this->load_page('page/private/staff/report_mahasiswa_lomba', $data);
    }

}
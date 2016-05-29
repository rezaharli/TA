<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log extends Private_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('pengajuan_proposal_himpunan_model');
		$this->load->model('logbook_proposal_himpunan_model');
		$this->load->model('proposal_himpunan_model');
		$this->load->model('himpunan_model');
		$this->load->model('staff_model');
		$this->load->model('user_model');
	}

	function pengajuan(){
		$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
		
		if ($user->role == 'staff') {
			$proposals	= $this->logbook_proposal_himpunan_model->get_all();
		}else {
			$himpunan 	= $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
			$proposals 	= $this->logbook_proposal_himpunan_model->get_many_by(array('pengaju' => $himpunan->id));
		}
		
		$data['proposals'] = array();
		foreach ($proposals as $proposal) {
			$pengaju 			= $this->himpunan_model->get_by(array('id' => $proposal->pengaju));
			$get_id_staff 		= $this->staff_model->get_by(array('nip' => $proposal->penanggungjawab));
			$get_nama_user 		= ($get_id_staff == null) ? null : $this->user_model->get($get_id_staff->id_user);

			array_push($data['proposals'], array(
				'id'						=> $proposal->id,
				'pengaju' 					=> $pengaju->nama,
				'tanggal_pengajuan' 		=> $proposal->tanggal_pengajuan,
				'judul' 					=> $proposal->judul,
				'tanggal_proposal_terakhir' => $proposal->tanggal_proposal_terakhir,
				'status_approve' 			=> $proposal->status_approve,
				'penanggungjawab'			=> ($get_nama_user == null) ? '-' :$get_nama_user->nama
			));
		}

		if ($user->role == 'staff') {
			$this->load_page('page/private/staff/logbook_proposal_himpunan', $data);
		}else{
			$this->load_page('page/private/himpunan/logbook_proposal', $data);
		}
		
	}

	function proposal(){
		$id_pengajuan = $this->input->get('id');

		$proposals = $this->proposal_himpunan_model->get_many_by(array('id_pengajuan_proposal' => $id_pengajuan));

		$data['proposals'] = array();
		foreach ($proposals as $proposal) {

			array_push($data['proposals'], array(
				'id_proposal'		=> $proposal->id,
				'judul'				=> $proposal->judul,
				'tanggal_upload'	=> $proposal->waktu_upload,
				'status'			=> $proposal->status_approve
			));
			
		}
		echo print_r($data);
		die();
		$this->load_page('page/private/staff/logbook_proposal_himpunan_detail', $data);
	}

	function detail(){
		$id_proposal = $this->input->get('id_proposal');

		$proposal = $this->proposal_himpunan_model->get_by(array('id' => $id_proposal));

		$data['judul_detail'] 		= $proposal->judul;
		$data['tema_kegiatan'] 		= $proposal->tema_kegiatan;
		$data['tujuan_kegiatan'] 	= $proposal->tujuan_kegiatan;
		$data['sasaran_kegiatan'] 	= $proposal->sasaran_kegiatan;
		$data['tanggal_kegiatan'] 	= $proposal->tanggal_kegiatan;
		$data['tempat_kegiatan'] 	= $proposal->tempat_kegiatan;
		$data['bentuk_kegiatan'] 	= $proposal->bentuk_kegiatan;
		$data['anggaran'] 			= $proposal->anggaran;
		$data['penutup'] 			= $proposal->penutup;
		$data['status']				= $proposal->status_approve;

		$this->load_page('page/private/staff/detail_proposal_himpunan', $data);
	}

	function tes(){
		$this->load_page('page/private/staff/detail_proposal_him', null);
	}
}
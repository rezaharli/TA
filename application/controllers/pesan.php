<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Pesan extends Private_Controller {
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	    $this->load->model('pesan_model');
	}

	//kirim pesan dari staff kemahasiswaan ke himpunan
    function do_kirim_pesan(){
        $asal       = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $kepada     = $this->input->post('kepada');
        $isi_pesan  = $this->input->post('isipesan');
        $waktu      = date('Y-n-j h:i:s');
        $id_pengajuan = $this->input->post('id_pengajuan');
        $id_proposal = $this->input->post('id_proposal');

        $this->pesan_model->insert(
            array(
                'id_pengajuan_proposal' => $id_pengajuan,
                'id_proposal'			=> $id_proposal,
                'pesan'                 => $isi_pesan,
                'waktu'                 => $waktu,
                'asal'                  => $asal->id,
                'tujuan'                => $kepada),
        FALSE);

        redirect('proposal_himpunan/detail_proposal?id='.$id_proposal);
    }

    public function get() {
    	$this->load->model('mahasiswa_model');
    	$this->load->model('himpunan_model');
    	$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

    	if($user->role == 'mahasiswa'){
    		$mahasiswa 	= $this->mahasiswa_model->get_by(array('id_user' => $user->id));
    		$himpunan 	= $this->himpunan_model->get_by(array('id_penanggungjawab' => $mahasiswa->nim));
    		$pesan 		= $this->pesan_model->get_many_by(array('tujuan' => $himpunan->id));

    		$data['himpunan'] = $mahasiswa->jenis;

    		$data['pesan'] = array();
    		foreach ($pesan as $p) {
        		echo '<li><a href="'.base_url('proposal_himpunan/detail_proposal?id='.$p->id_proposal).'"><i class="fa fa-users text-aqua">'.$p->asal.'</i> '.$p->pesan.'</a></li>';
        	}
    	}

    }

    public function hitung() {
    	$this->load->model('mahasiswa_model');
    	$this->load->model('himpunan_model');
    	$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

    	if($user->role == 'mahasiswa'){
    		$mahasiswa 	= $this->mahasiswa_model->get_by(array('id_user' => $user->id));
    		$himpunan 	= $this->himpunan_model->get_by(array('id_penanggungjawab' => $mahasiswa->nim));
    		$pesan 		= $this->pesan_model->get_many_by(array('tujuan' => $himpunan->id));

    		echo $this->pesan_model->count_by(array('tujuan' => $himpunan->id));
    	}
        
    }
}
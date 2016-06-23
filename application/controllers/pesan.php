<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Pesan extends Private_Controller {
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	    $this->load->model('pesan_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('himpunan_model');
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
    	$this->load->library('time_ago');
    	$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

    	if($user->role == 'mahasiswa'){
    		$mahasiswa 	= $this->mahasiswa_model->get_by(array('id_user' => $user->id));
    		$himpunan 	= $this->himpunan_model->get_by(array('id_penanggungjawab' => $mahasiswa->nim));
    		$pesan 		= $this->pesan_model->get_many_by(array('tujuan' => $himpunan->id));

    		$data['himpunan'] = $mahasiswa->jenis;

    		$data['pesan'] = array();
    		foreach ($pesan as $p) {
                $profil = $this->user_model->get_by(array('id' => $p->asal));
                ?>

                <li class="pesan" id="<?php echo $p->id ?>">
                    <a data-toggle="modal" href="#" data-target="#tampilkanPesanModal<?php echo $p->id ?>">
                        <div class="pull-left">
                            <img src="<?php echo base_url('assets/img/foto-profil/'.$profil->foto_profil)?>" class="img-circle" alt="User Image">
                        </div>
                        <h5>
                            <?php echo $profil->nama ?>
                            <small class="pull-right"><i class="fa fa-clock-o"></i>&nbsp;<?php echo $this->time_ago->timeAgo($p->waktu) ?>
                            </small>
                        </h5>
                        <p style="width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                            <?php echo $p->pesan ?>
                        </p>
                    </a>
                </li>

                <?php
        	}
    	}

    }

    public function get_modal() {
        $this->load->library('time_ago');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        if($user->role == 'mahasiswa'){
            $mahasiswa  = $this->mahasiswa_model->get_by(array('id_user' => $user->id));
            $himpunan   = $this->himpunan_model->get_by(array('id_penanggungjawab' => $mahasiswa->nim));
            $pesan      = $this->pesan_model->get_many_by(array('tujuan' => $himpunan->id));

            $data['himpunan'] = $mahasiswa->jenis;

            $data['pesan'] = array();
            foreach ($pesan as $p) {
                $profil = $this->user_model->get_by(array('id' => $p->asal));

                $this->load->view('page/private/template/message', array('pesan' => $p, 'profil' => $profil));
            } 
        }

    }

    public function hitung() {
    	$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

    	if($user->role == 'mahasiswa'){
    		$mahasiswa 	= $this->mahasiswa_model->get_by(array('id_user' => $user->id));
    		$himpunan 	= $this->himpunan_model->get_by(array('id_penanggungjawab' => $mahasiswa->nim));
    		$pesan 		= $this->pesan_model->get_many_by(array('tujuan' => $himpunan->id, 'terbaca' => 'n'));

    		echo $this->pesan_model->count_by(array('tujuan' => $himpunan->id));
    	}
        
    }
}
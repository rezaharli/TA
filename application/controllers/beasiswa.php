<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beasiswa extends Private_Controller {
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	}

	function kirim_rekomendasi($id){
	    $this->load->model('bukti_lomba_model');
		$sertifikat = $this->bukti_lomba_model->get($id);

        $this->load->model('mahasiswa_model');
        if($sertifikat != null) {
        	$sertifikat->pengupload = $this->mahasiswa_model->get_mahasiswa_dan_user_by_nim($sertifikat->pengupload);
        }

		$data = array(
			'nama' 	=> $sertifikat->pengupload->nama,
			'link'	=> base_url('beasiswa/cetak?id=1')
			);

		$message = $this->load->view('email/rekomendasi_beasiswa', $data, true);
		
		$this->load->library('google_mail');
		$email = $this->google_mail->send_mail(
			APP_EMAIL, 
			APP_NAME,
			$sertifikat->pengupload->email,
			APP_NAME . ' - ' . 'Rekomendasi Beasiswa',
			$message
			);

		if ($email) {
			$this->bukti_lomba_model->update($id, array('rekomendasi' => '1'));
		}

		redirect(base_url('sertifikat'));
	}

    function cetak() {
        $this->load_page('page/private/staff/rekomendasi_detail_cetak', $this->get_cetak_data());
    }

    function do_cetak(){
        $this->load->view('page/private/staff/rekomendasi_cetak', $this->get_cetak_data());
    }

    private function get_cetak_data(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        // if($user->role != 'staff' || null == $this->input->get('id')) show_404();

        $id = $this->input->get('id');
	    $this->load->model('bukti_lomba_model');
		$sertifikat = $this->bukti_lomba_model->get($id);

        $this->load->model('mahasiswa_model');
        if($sertifikat != null) {
        	$sertifikat->pengupload = $this->mahasiswa_model->get_mahasiswa_dan_user_by_nim($sertifikat->pengupload);
        }

        $data['sertifikat']			= $sertifikat;
        $data['tanggal_display']    = $this->get_tanggal_formatted(date('Y-m-d'));

        return $data;
    }
}
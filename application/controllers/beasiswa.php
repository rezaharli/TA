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

		$data = array('nama' => $sertifikat->pengupload->nama);

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
}
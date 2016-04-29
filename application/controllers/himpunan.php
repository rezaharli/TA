<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Himpunan extends Private_Controller {

	protected $client;

	function __construct() {
		parent::__construct();
		$this->load->model('himpunan_model');
	}

	function index(){
		$this->load->model('user_model');
		// load model
		$himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $this->session->userdata['logged_in_user']['roled_user_data']->nim));
		// var_dump($himpunan);
		// die();
		$user = $this->session->userdata('logged_in_user');
		$this->view_data['title'] = $himpunan->nama;
		$this->view_data['himpunan'] = $himpunan;
		$this->view_data['user'] = $this->user_model->get_by(array('id' => $this->session->userdata['logged_in_user']['user_data']->id));
		$this->load_page('page/private/himpunan/edit_himpunan');
	}


	function getIdMahasiswa(){
		$this->load->model('mahasiswa_model');
		$mahasiswa = $this->mahasiswa_model->get_by(array('id_user' => $this->session->userdata['logged_in_user']['user_data']->id));
		return $mahasiswa->nim;
	}


	function do_update(){
		$himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $this->getIdMahasiswa()));

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$post = $this->input->post();
			array_pop($post);
			$status = $this->himpunan_model->update($himpunan->id, $post);
			$n = ($status != 0) ? true : false;
			$this->session->set_flashdata(array('status' => $n));
			$this->index();
		}
	}

	function logout(){
		if($this->session->userdata('logged_in_user')) {
			$this->session->sess_destroy();
		}
		redirect('');
	}
}

/* End of file himpunan.php */
/* Location: ./application/controllers/himpunan.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Himpunan extends Private_Controller {

	protected $client;

	function __construct() {
		parent::__construct();
		$this->load->model('himpunan_model');
	}

	function index(){
		// get id user
		$this->load->model('user_model');	
		$user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));

        $this->load->model($user_data->role.'_model', 'roled_user_model');
        $roled_user_data = $this->roled_user_model->get_by(array('id_user' => $user_data->id));
		
		// get nim
		$himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $roled_user_data->nim));

		$view_data['title'] 		= $himpunan->nama;
		$view_data['himpunan'] 	= $himpunan;
		$view_data['user'] 		= $user_data;
		$this->load_page('page/private/himpunan/edit_himpunan', $view_data);
	}

	function do_update(){
		$this->load->model('user_model');	
		$user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));

        $this->load->model($user_data->role.'_model', 'roled_user_model');
        $roled_user_data = $this->roled_user_model->get_by(array('id_user' => $user_data->id));
		
		// load model
		$himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $roled_user_data->nim));

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
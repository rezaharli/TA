<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Himpunan extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('himpunan_model');
	}

	function index(){
        $user = $this->get_user_dan_role();
		
		$himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));

		$view_data['title'] 	= $himpunan->nama;
		$view_data['himpunan'] 	= $himpunan;
		$view_data['user'] 		= $user;

		$this->load_page('page/private/himpunan/edit_himpunan', $view_data);
	}

	function do_update(){
        $user = $this->get_user_dan_role();
		
		$himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$post = $this->input->post();
			array_pop($post);
			$status = $this->himpunan_model->update($himpunan->id, $post);
			$this->session->set_flashdata(array('status' => ($status != 0) ? true : false));
			redirect('himpunan');
		}
	}
}

/* End of file himpunan.php */
/* Location: ./application/controllers/himpunan.php */
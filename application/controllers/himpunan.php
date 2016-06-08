<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Himpunan extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('himpunan_model');
		$this->load->model('user_model');
	}

	function update_himpunan(){
		$this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
		
		$himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));

		$view_data['title'] 	= $himpunan->nama;
		$view_data['himpunan'] 	= $himpunan;
		$view_data['user'] 		= $user;

		$this->load_page('page/private/himpunan/edit_himpunan', $view_data);
	}

	function do_update(){
		$this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
		
		$himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$data = array(
				'nama' 	=> $this->input->post('nama'),
				'prodi' => $this->input->post('prodi')
			);
			$status = $this->himpunan_model->update($himpunan->id, $data);

			$this->session->set_flashdata(array('status' => ($status != 0) ? true : false));
			redirect('himpunan/update_himpunan');
		}
	}

	function edit(){
		$this->load->model('mahasiswa_model');

		$id = $this->input->get('id');
		$himpunan = $this->himpunan_model->get_by(array('id' => $id));
		$mahasiswas = $this->mahasiswa_model->get_all();
		
		$data['mahasiswas'] = array();
		foreach ($mahasiswas as $mahasiswa) {
			$user = $this->user_model->get_by(array('id' => $mahasiswa->id_user));
			//echo print_r($user); die();
			
			array_push($data['mahasiswas'], array(
                'nim'	=> $mahasiswa->nim,
                'nama'	=> $user->nama
                ));
		}
		$data['himpunan'] = $himpunan;

		$this->load_page('page/private/staff/edit_himpunan', $data);
	}

	function asd(){
        $this->load->model('mahasiswa_model');
        $mahasiswas = $this->mahasiswa_model
            ->like('nim', $this->input->get('term')['term'])
            ->get_all();

        $data['mahasiswas'] = array();
        if (count($mahasiswas) > 0) {
        	foreach ($mahasiswas as $mahasiswa) {

        		array_push($data['mahasiswas'], array(
        			'id'	=> $mahasiswa->nim,
        			'text'	=> $mahasiswa->nim
        		));
        	}
        }else {
        	$data[] = array('id' => '0', 'text' => 'not found');
        }
        
        echo json_encode($data);
    }

	// function do_edit(){

	// }
}

/* End of file himpunan.php */
/* Location: ./application/controllers/himpunan.php */
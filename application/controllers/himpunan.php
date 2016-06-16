<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Himpunan extends Private_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mahasiswa_model');
		$this->load->model('himpunan_model');
		$this->load->model('user_model');
		$this->load->library('form_validation');
	}

	function index(){
		redirect('lists/himpunan');
	}

	function add(){
		$this->load_page('page/private/staff/tambah_himpunan');
	}

	function do_add(){
		$nama_him 	= $this->input->post('nama');
		$prodi 		= $this->input->post('prodi');
		$pj 		= $this->input->post('penanggungjawab');

		$this->himpunan_model->insert(
            array(
                'nama'      			=> $nama_him,
                'prodi'     			=> $prodi,
                'id_penanggungjawab'   	=> $pj),
            FALSE);

		redirect('lists/himpunan');
	}

	//menampilkan halaman edit himpunan MAHASISWA
	function update_himpunan(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
		
		$himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));

		$view_data['title'] 	= $himpunan->nama;
		$view_data['himpunan'] 	= $himpunan;
		$view_data['user'] 		= $user;

		$this->load_page('page/private/himpunan/edit_himpunan', $view_data);
	}

	//menampilkan halaman edit himpunan KAUR
	function edit(){
		$id 		= $this->input->get('id');
		$himpunan 	= $this->himpunan_model->get_by(array('id' => $id));
		$mahasiswa 	= $this->mahasiswa_model->get_by(array('nim' => $himpunan->id_penanggungjawab));
		$user 		= $this->user_model->get_by(array('id' => $mahasiswa->id_user));

		$data['id_him']		= $himpunan->id;
		$data['id_pj']		= $himpunan->id_penanggungjawab;
		$data['nama_him'] 	= $himpunan->nama;
		$data['prodi_him']	= $himpunan->prodi;
		$data['nama_mhs'] 	= $user->nama;

		$this->load_page('page/private/staff/edit_himpunan', $data);
	}

	//update data himpunan dari sisi himpunan dan kaur
	function do_update(){
		$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
		
		$himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
		// rule
		$this->form_validation->set_rules('nama', 'Nama Himpunan', 'required');
		$this->form_validation->set_rules('prodi', 'Program Studi', 'required');
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if ($this->form_validation->run() !== FALSE) {
				$data = array(
					'nama' 	=> $this->input->post('nama'),
					'prodi' => $this->input->post('prodi')
				);
				$status = $this->himpunan_model->update($himpunan->id, $data);
	
				$this->session->set_flashdata(array('status' => ($status != 0) ? true : false));
				redirect('himpunan/update_himpunan');
			} else {
				$this->update_himpunan();
			}
		} else {
			redirect('himpunan/update_himpunan');
		}
	}

	function do_edit(){
		$nim 		= $this->input->post('penanggungjawab');
		$id_him		= $this->input->get('id');
		$pj 		= $this->himpunan_model->get_by(array('id' => $id_him));
		$pj_lama 	= $this->mahasiswa_model->get_by(array('nim' => $pj->id_penanggungjawab));

		$this->mahasiswa_model->update_by(array('nim' => $pj_lama->nim), array('jenis' => 'n'));
		$this->mahasiswa_model->update_by(array('nim' => $nim), array('jenis' => 'himpunan'));
		$this->himpunan_model->update($id_him, array('id_penanggungjawab' => $nim));

		redirect('lists/himpunan');
	}

	function select2(){
        $this->load->model('mahasiswa_model');
        $mahasiswa = $this->mahasiswa_model
            ->like('nim', $this->input->get('q')['term'])
            ->get_all();

        $data['total_count'] = count($mahasiswa);
        $data['mahasiswa'] = array();
        if (count($mahasiswa) > 0) {
        	foreach ($mahasiswa as $mhs) {
        		$user = $this->user_model->get_by(array('id' => $mhs->id_user));

        		array_push($data['mahasiswa'], array(
        			'id'	=> $mhs->nim,
        			'text'	=> $mhs->nim.' - '.$user->nama
        		));
        	}
        }
        echo json_encode($data);
    }

	// function do_edit(){

	// }
}

/* End of file himpunan.php */
/* Location: ./application/controllers/himpunan.php */
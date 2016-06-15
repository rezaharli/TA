<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('event_model');
        
        $this->load->library('google_calendar');

        $google_events = $this->google_calendar->get();
        $this->event_model->soft_delete = TRUE;
        $this->event_model->delete_by(array('id !=' => ''));
        $this->event_model->soft_delete = FALSE;
        foreach ($google_events as $google_event) {
        	$event = $this->event_model->get_by(array('id' => $google_event->id));
    		$data = array(
    			'nama_event'	=> $google_event->nama,
    			'tanggal_event'	=> $google_event->tanggal,
    			'google_url'	=> $google_event->google_url
    			);

        	if ($event) {
        		$this->event_model->update($event->id, $data);
        	} else {
        		$data['id'] = $google_event->id;
        		$this->event_model->insert($data);
        	}
        }
	}

	function index(){

	}

    function lomba(){
        $id_event = $this->input->get('id');

        $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
    	
    	$data['role_user']	= $user->role;
    	$data['jenis_user']	= $user->roled_data->jenis;

    	if($this->uri->segment(3) == '') {

    		if($id_event){
			
				$event 		= $this->event_model->get($id_event);
				$pengaju 	= $this->user_model->get($event->pengaju_event);

				if($event->penanggungjawab){
					$this->load->model('staff_model');
					$penanggungjawab = $this->staff_model->get_staff_dan_user_by_nip($event->penanggungjawab);
				}

				$data['id']					= $event->id;
				$data['nama_event']			= $event->nama_event;
				$data['tanggal']			= $event->tanggal_event;
				$data['username_pengaju']	= $pengaju->username;
				$data['nama_pengaju']		= $pengaju->nama;
				$data['status']				= $event->status;

				if (isset($penanggungjawab)) {
					$data['username_penanggungjawab']	= $penanggungjawab->username;
					$data['nama_penanggungjawab']		= $penanggungjawab->nama;
				}
				
				$data['google_url']					= $event->google_url;
				$data['url']						= base_url('event?id='.$event->id);

				$this->load_page('page/private/detail_event', $data);
			
			} else {

				$ordered_event = $this->event_model->order_by('tanggal_event');
				$data['events'] = $ordered_event->get_many_by(array('status' => 'disetujui'));
				$this->load_page('page/private/list_pengajuan_event', $data);
			}

		} else if($this->uri->segment(3) == 'pengajuan') {

			$ordered_event = $this->event_model->order_by('tanggal_event');
			if($user->role == 'mahasiswa' || $user->roled_data->jenis == 'staff_admin'){
				$data['events'] = $ordered_event->get_many_by(array('pengaju_event' => $user->id));
			} else if($user->role == 'staff'){
				$data['events'] = $ordered_event->get_all();
			}
			$this->load_page('page/private/list_pengajuan_event', $data);

		} else if($this->uri->segment(3) == 'tambah') {
			$this->load_page('page/private/staff/tambah_event');

		} else show_404();
    }

    function kegiatanhimpunan(){

    	if($this->uri->segment(3) == '') {

	        $id_event = $this->input->get('id');

	        $this->load->model('user_model');
	        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

	    	$data['role_user']	= $user->role;
	    	$data['jenis_user']	= $user->roled_data->jenis;

			$this->load->model('acara_himpunan_model');
    		
    		if($id_event){
    			$event = $this->acara_himpunan_model->get($id_event);

    			if ($event) {
    				$this->load->model('pengajuan_proposal_himpunan_model');
    				$event->pengajuan = $this->pengajuan_proposal_himpunan_model->get($event->id_pengajuan_proposal);

    				if($event->pengajuan) {
    					$this->load->model('himpunan_model');
    					$event->pengajuan->himpunan = $this->himpunan_model->get($event->pengajuan->pengaju_proposal);

    					if ($event->pengajuan->himpunan) {
							$this->load->model('mahasiswa_model');
							$event->pengajuan->himpunan->penanggungjawab = $this->mahasiswa_model->get_by(array('nim' => $event->pengajuan->himpunan->id_penanggungjawab));
    					}
    				}
    			}

    			$data['isowner']	= ($this->session->userdata('id') == $event->pengajuan->himpunan->penanggungjawab->id_user);
				$data['event'] 		= $event;
				$this->load_page('page/private/detail_kegiatan_himpunan', $data);
			} else {
				$ordered_event = $this->acara_himpunan_model->order_by('tanggal_acara');
				$data['events'] = $ordered_event->get_all();
				$this->load_page('page/private/list_kegiatan_himpunan', $data);
			}

		} else show_404();
    }

    function do_tambah(){
    	$config['upload_path'] = './assets/upload/event_lomba';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			var_dump($error);
			}
		else
		{
			$nama 				= $this->input->post('nama');
			$tingkat_kompetisi	= $this->input->post('tingkat_kompetisi');
    		$tanggal 			= $this->input->post('tanggal');
    		$keterangan			= $this->input->post('keterangan');
			$event 				= $this->google_calendar->insert($nama, $tanggal);
			$datafile 			= array('upload_data' => $this->upload->data());

			if ($event) {
	        $this->load->model('user_model');
	        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
	        $jenis_user = $user->roled_data->jenis;
			// echo $datafile['upload_data']['file_name'];
			// die(); 
		        $data = array(
		        	'id'					=> $event->id,
		        	'pengaju_event'			=> $user->id,
		        	'tingkat_kompetisi'		=> $this->input->post('tingkat_kompetisi'),
		        	'keterangan'			=> $this->input->post('keterangan'),
		            'nama_event'            => $this->input->post('nama'),
		            'tanggal_event'         => $this->input->post('tanggal'),
		            'bukti_event'			=> $datafile['upload_data']['file_name'],
		            'status'			=> 'disetujui',
					'penanggungjawab'	=> ($jenis_user == 'kaur' || $jenis_user == 'staff_kemahasiswaan') ? $user->roled_data->nip : null,
					'google_url'		=> $event->htmlLink
		        );
		    	$id_upload_event = $this->event_model->insert($data);
			}
		}	
        $this->session->set_flashdata(array('status' => true));
        redirect('home');
    }

    function do_edit($id, $nama, $tanggal){
    	$event = $this->google_calendar->update($id, $nama, $tanggal);
        redirect('event?id='.$id);
    }

    function do_edit_event($id){
    	$nama 		= $this->input->post('nama-event');
    	$tanggal 	= $this->input->post('tanggal-event');

    	$this->do_edit($id, $nama, $tanggal);
        redirect('event/lomba?id='.$id);
    }

    function do_edit_kegiatan($id){
    	$data = array(
	    	'nama_acara' 		=> $this->input->post('nama-acara'),
	    	'tempat_acara' 		=> $this->input->post('tempat-acara'),
	    	'tanggal_acara' 	=> $this->input->post('tanggal-acara'),
	    	'deskripsi_acara' 	=> $this->input->post('deskripsi-acara')
	    	);

    	$this->load->model('acara_himpunan_model');
    	$this->acara_himpunan_model->update($id, $data);

    	// $this->do_edit($id);
        redirect('event/kegiatanhimpunan?id='.$id);
    }

    function do_edit_status($id){
    	$status = null;
    	if ($this->input->get('s') == 't') {
    		$status = 'disetujui';
    	} else if ($this->input->get('s') == 'f') {
    		$status = 'ditolak';
    	}

    	$this->event_model->update($id, array('status' => $status));
    	redirect('event?id='.$id);
    }

    function edit(){
        $id_event = $this->input->get('id');

        if($id_event){
			$event = $this->event_model->get_by(array('id' => $id_event));
			$data['id']					= $event->id;
			$data['nama_event']			= $event->nama_event;
			$data['tanggal']			= $event->tanggal_event;
			$data['pengaju']			= $event->pengaju_event;
			$data['status']				= $event->status;
			$data['penanggungjawab']	= $event->penanggungjawab;
			$data['google_url']			= $event->google_url;
			$data['url']				= base_url('event?id='.$event->id);

			$this->load_page('page/private/detail_event', $data);
		} else {
			redirect('event');
		}
    }

	function get_calendar() {
		$events = $this->event_model->get_all();
		$results = array();
		foreach ($events as $event) {
			$result = array(
	 			'id'			=> $event->id,
	 			'title'			=> $event->nama_event,
	 			'start'			=> $event->tanggal_event,
	 			'url'			=> base_url('event?id='.$event->id)
 			);
			array_push($results, $result);
		}
        echo json_encode($results);
	}

	function hapus(){
		$id = $this->input->get('id');
		$event = $this->google_calendar->delete($id);

		$this->event_model->soft_delete = FALSE;
    	$this->event_model->delete($id);
		redirect('event');
	}

	function pengajuan() {
		$this->load_page('page/private/mahasiswa/ajukan_event');
	}

	function do_pengajuan(){
		$config['upload_path'] = './assets/upload/event_lomba';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']	= '5000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			var_dump($error);
			}
		else
		{
			$nama 		= $this->input->post('nama_event');
    		$tanggal 	= $this->input->post('tanggal_event');
    		$event = $this->google_calendar->insert($nama, $tanggal);
			$datafile = array('upload_data' => $this->upload->data());
			$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
			// echo $datafile['upload_data']['file_name'];
			// die(); 
		        $data = array(
		        	'id'					=> $event->id,
		        	'pengaju_event'			=> $user->id,
		            'nama_event'            => $this->input->post('nama_event'),
		            'tanggal_event'         => $this->input->post('tanggal_event'),
		            'bukti_event'			=> $datafile['upload_data']['file_name']
		        );
		    $id_upload_event = $this->event_model->insert($data);
		}
        $this->session->set_flashdata(array('status' => true));
        redirect('event');
	}

	function tambah() {
		$this->load_page('page/private/staff/tambah_event');
	}

}

/* End of file event */
/* Location: ./application/controllers/event */	
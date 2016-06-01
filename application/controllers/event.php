<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('event_model');
        
        $this->awal();
	}

    function index() {
        $id_event = $this->input->get('id');

        $this->load->model('user_model');
        $user 	= $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
    	$data['role_user']					= $user->role;
    	$data['jenis_user']					= $user->roled_data->jenis;
        
        if($id_event){
			
			$event 		= $this->event_model->get_by(array('id' => $id_event));
			$pengaju 	= $this->user_model->get($event->pengaju_event);

			if($event->penanggungjawab){
				$this->load->model('staff_model');
				$penanggungjawab = $this->staff_model->get_staff_dan_user_by_nip($event->penanggungjawab);
			}

			$data['id']							= $event->id;
			$data['nama_event']					= $event->nama_event;
			$data['tanggal']					= $event->tanggal_event;
			$data['username_pengaju']			= $pengaju->username;
			$data['nama_pengaju']				= $pengaju->nama;
			$data['status']						= $event->status;

			if (isset($penanggungjawab)) {
				$data['username_penanggungjawab']	= $penanggungjawab->username;
				$data['nama_penanggungjawab']		= $penanggungjawab->nama;
			}
			
			$data['google_url']					= $event->google_url;
			$data['url']						= base_url('event?id='.$event->id);

			$this->load_page('page/private/detail_event.php', $data);
		} else {
			$user = $this->user_model->get_by(array('id' => $this->session->userdata('id')));

			$ordered_event = $this->event_model->order_by('tanggal_event');
			if($user->role == 'mahasiswa'){
				$data['events'] = $ordered_event->get_many_by(array('status' => 'disetujui'));
			} else if($user->role == 'staff'){
				$data['events'] = $ordered_event->get_all();
			}

			$this->load_page('page/private/list_pengajuan_event.php', $data);
		}
    }

    private function awal(){
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

    function do_tambah(){
    	$nama 		= $this->input->post('nama');
    	$tanggal 	= $this->input->post('tanggal');

    	$event = $this->google_calendar->insert($nama, $tanggal);
    	
    	if ($event) {
	        $this->load->model('user_model');
	        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
	        $jenis_user = $user->roled_data->jenis;
	    	
	    	$data = array(
	    		'id'				=> $event->id,
				'nama_event' 		=> $nama,
				'tanggal_event' 	=> $tanggal,
				'pengaju_event'		=> $this->session->userdata('id'),
				// karena pengaju adalah staff kemahasiswaan, maka langsung dianggap disetujui, tidak ada proses approval
				'status'			=> 'disetujui',
				'penanggungjawab'	=> ($jenis_user == 'kaur' || $jenis_user == 'staff_kemahasiswaan') ? $user->roled_data->nip : null,
				'google_url'		=> $event->htmlLink
				);
	        $insert_id = $this->event_model->insert($data);
	    }
        redirect('event');
    }

    function do_edit($id){
    	$nama 		= $this->input->post('nama-event');
    	$tanggal 	= $this->input->post('tanggal-event');

    	$event = $this->google_calendar->update($id, $nama, $tanggal);
        redirect('event?id='.$id);
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

			$this->load_page('page/private/detail_event.php', $data);
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
		$this->load_page('page/private/pengajuan_event.php');
	}

	function tambah() {
		$this->load_page('page/private/staff/tambah_event.php');
	}

}

/* End of file event.php */
/* Location: ./application/controllers/event.php */
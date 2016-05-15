<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('event_model');
        
        $this->awal();
	}

    function index() {
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
			$this->load->model('user_model');
			$user = $this->user_model->get_by(array('id' => $this->session->userdata('id')));

			if($user->role == 'mahasiswa'){
				$data['events'] = $this->event_model->order_by('tanggal_event')->get_many_by(array('status' => 'disetujui'));
			} else if($user->role == 'staff'){
				$data['events'] = $this->event_model->order_by('tanggal_event')->get_all();
			}
			$this->load_page('page/private/event.php', $data);
		}
    }

    private function awal(){
    	$this->load->library('google_calendar');

        $google_events = $this->google_calendar->get();
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

	function pengajuan() {
		$this->load_page('page/private/pengajuan_event.php');
	}

	function tambah() {
		$this->load_page('page/private/staff/tambah_event.php');
	}


}

/* End of file event.php */
/* Location: ./application/controllers/event.php */
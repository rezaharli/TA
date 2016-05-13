<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
        $this->load->library('google_calendar');
	}

	function get_calendar() {
        echo json_encode($this->google_calendar->get());
	}

	function pengajuan(){
		$this->load_page('page/private/pengajuan_event.php');
	}

	function detail($id){
		$data['event'] = $this->google_calendar->get_by_id($id);
		$this->load_page('page/private/detail_event.php', $data);
	}

}

/* End of file event.php */
/* Location: ./application/controllers/event.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
        $this->load->library('google_calendar');
	}

    function index() {
        $id_event = $this->input->get('id');

		$event = $this->google_calendar->get_by_id($id_event);
		$data['id']			= $event['id'];
		$data['title']		= $event['title'];
		$data['start']		= $event['start'];
		$data['google_url']	= $event['google_url'];
		$data['url']		= $event['url'];

		$this->load_page('page/private/detail_event.php', $data);
    }

	function get_calendar() {
        echo json_encode($this->google_calendar->get());
	}

	function pengajuan(){
		$this->load_page('page/private/pengajuan_event.php');
	}

}

/* End of file event.php */
/* Location: ./application/controllers/event.php */
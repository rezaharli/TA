<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load_page('page/public/index');
    }

    public function events() {
        $this->load_page('page/public/temukan-event');
    }
	
    public function detail_event() {
        $this->load_page('page/public/detail-event');
    }

}
 
/* End of file guest.php */
/* Location: ./application/controllers/guest.php */
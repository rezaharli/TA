<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Root extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('login');
    }

}
 
/* End of file root.php */
/* Location: ./application/controllers/root.php */

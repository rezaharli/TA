<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_404 extends Private_Controller{
    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->output->set_status_header('404');

        // Make sure you actually have some view file named 404.php
        $this->load_page('errors/404.php');
    }
}
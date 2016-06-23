<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends Private_Controller {
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	}

	function download(){
		
	}
}
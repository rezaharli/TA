<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$this->load_page('home');
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
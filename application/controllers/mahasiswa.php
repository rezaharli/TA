<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends User {

	function __construct() {
		parent::__construct();
		$this->load->model('himpunan_model');
	}

}

/* End of file himpunan.php */
/* Location: ./application/controllers/himpunan.php */
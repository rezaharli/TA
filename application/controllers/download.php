<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends Private_Controller {
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	}

	function download(){
		$this->load->library('google_drive');

        $client = $this->google_drive->getclient();
        $service = new Google_Service_Drive($client);

        $fileId = '0B_mIc-chnSGMaTdkZjNYWjNUMTA';
        $file = $this->google_drive->printFile($service, $fileId);
        
        echo "<br/><pre>";
        print_r($file);
        echo "</pre><hr/>";
	}
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends Private_Controller {
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	}

	function download(){
		$this->load->library('google_drive');
		$client = new Google_Client();
        $client_email = 'hmmmm-359@noted-fact-127906.iam.gserviceaccount.com';
        $private_key = file_get_contents(FCPATH.'/hmmmm-4c2bd9a777d8.p12');
        $scopes = array('https://www.googleapis.com/auth/drive');
        $credentials = new Google_Auth_AssertionCredentials(
            $client_email,
            $scopes,
            $private_key
        );
        $client->setAssertionCredentials($credentials);
        $service = new Google_Service_Drive($client);
	}
}
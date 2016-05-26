<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposal extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	}

    function pengajuan (){
        $this->load->model('user_model');
        $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
        $this->load_page('page/private/'.$user_data->role.'/pengajuan_proposal', null);
    }

}

/* End of file proposal.php */
/* Location: ./application/controllers/proposal.php */
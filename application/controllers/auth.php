<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();

		$this->load->library('form_validation');
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters(
			$this->config->item('error_start_delimiter', 'ion_auth'), 
			$this->config->item('error_end_delimiter', 'ion_auth')
			);

		$this->lang->load('auth');
	}

	function index() {
		header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		
		if ( ! $this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		} else {
			redirect('home');
		}
	}

	function login(){
		if ($this->ion_auth->logged_in()) {
			redirect('home');
		}
		$this->data['title'] = $this->lang->line('login_heading');

		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$remember = (bool) $this->input->post('remember');

				if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					$this->session->set_userdata('id', $this->ion_auth->user()->row()->id);
					redirect('/', 'refresh');
				} else {
					echo $this->ion_auth->errors();
				}
			} else {
				echo (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			}
		} else {
			$this->data['identity'] = array(
				'name' 			=> 'identity',
				'id'    		=> 'identity',
				'type'  		=> 'text',
				'placeholder'	=> 'Username',
				'value' 		=> $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array(
				'name' 			=> 'password',
				'id'   			=> 'password',
				'type' 			=> 'password',
				'placeholder'	=> 'Password'
			);

			$this->load_page('page/public/login', $this->data);
		}

	}

	function logout() {
		$this->data['title'] = "Logout";

		$logout = $this->ion_auth->logout();

		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('', 'refresh');
	}

	function load_page($view, $data=null, $returnhtml=false) {
		
		$this->viewdata = (empty($data)) ? $this->data: $data;
		
		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);
		
		if ($returnhtml) return $view_html;
	}

}
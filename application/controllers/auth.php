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

		header("cache-Control: no-store, no-cache, must-revalidate");
		header("cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	}

	function index() {
		if ( ! $this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		} else {
			redirect('home');
		}
	}

	function activate($id, $activation_code, $activate = false){
		if ($activate == 'false') {
			$user = $this->ion_auth_model->user($id)->row();
			if ($activation_code == $user->activation_code) {
				$identity = $this->config->item('identity', 'ion_auth');

				$view = $this->config->item('email_templates', 'ion_auth').$this->config->item('email_activate', 'ion_auth');
				$data = array(
					'identity'   => $user->{$identity},
					'id'         => $user->id,
					'email'      => $user->email,
					'activation' => $user->activation_code,
				);
				$message = $this->load->view($view, $data, true);
				
				$this->load->library('google_mail');
				$email = $this->google_mail->send_mail(
					$this->config->item('admin_email', 'ion_auth'), 
					$this->config->item('site_title', 'ion_auth'),
					$user->email,
					$this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_activation_subject'),
					$message
					);
				$this->session->set_flashdata('message', 'Email aktivasi sudah dikirim ke email anda: '.$user->email. '.');
			} else {
				$this->session->set_flashdata('message', 'Pengiriman email aktivasi gagal.');
			}
			redirect('auth/login', 'refresh');
		} else {
			$activation = $this->ion_auth->activate($id, $activation_code);

			if ($activation) {
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh');
			} else {
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/login", 'refresh');
			}
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

				$username = $this->input->post('identity');

				if ($this->ion_auth->login($username, $this->input->post('password'), $remember)) {
					
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					$this->session->set_userdata('id', $this->ion_auth->user()->row()->id);
					
					redirect('/', 'refresh');

				} else {

					foreach ($this->ion_auth->errors_array() as $error) {
						$replaced_error = preg_replace(array('/<p>/', '/<\/p>/'), '', $error);
						if ($replaced_error == $this->lang->line('login_unsuccessful_not_active')) {
							
							$this->load->model('user_model');

							$user = $this->user_model->get_by(array('username' => $username));
							echo '<p>'
								.$replaced_error.', klik 
								<a href="activate/'.$user->id.'/'.$user->activation_code.'/false" 
									style="text-decoration: underline">
									di sini
								</a> untuk aktivasi akun</p>';
						} else {
							echo $error;
						}
					}

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
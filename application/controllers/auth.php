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

	function aktivasi(){
		if($this->input->post()){
			$id 				= $this->input->post('id');
			$activation_code 	= $this->input->post('code');

			$user = $this->ion_auth_model->user($id)->row();
			
			//kirim email aktivasi
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
				echo json_encode(array('message' => 'Email aktivasi telah dikirim ke email anda: '.$user->email. '.'));
			} else {
				echo json_encode(array('message' => 'Pengiriman email aktivasi gagal.'));
			}
		} else {

			//setelah klik link dari email
			//ke halaman reset password
			$id 				= $this->uri->segment(3);
			$activation_code 	= $this->uri->segment(4);
			
			if(isset($id) || isset($activation_code)) { 
				$user = $this->ion_auth_model->user($id)->row();
				if($user && $activation_code == $user->activation_code){
					$this->session->set_flashdata('halaman', $this->lang->line('reset_password_heading'));
					$this->session->set_flashdata('id', $id);
					$this->session->set_flashdata('code', $activation_code);
					redirect("auth/login", 'refresh');
				}
			}
			show_404();
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
				$identity = $this->input->post('identity');

				if ($this->ion_auth->login($identity, $this->input->post('password'), $remember)) {
					
					$this->session->set_userdata('id', $this->ion_auth->user()->row()->id);
					$this->session->set_flashdata('message', $this->ion_auth->messages());

				} else {

					$data = array();
					$data['message'] = '';
					
					foreach ($this->ion_auth->errors_array() as $error) {
						$replaced_error = preg_replace(array('/<p>/', '/<\/p>/'), '', $error);
						
						if ($replaced_error == $this->lang->line('login_unsuccessful_not_active')) {
							
							$this->load->model('user_model');

							$user = $this->user_model->get_by(array($this->config->item('identity','ion_auth') => $identity));
							$data['id']			= $user->id;
							$data['code']		= $user->activation_code; 
							$data['message']	.= $this->ion_auth_model->message_start_delimiter;
							$data['message']	.= $replaced_error.', klik <a href="javascript:void(0);" id="a-aktivasi" onClick="aktivasi()" style="text-decoration: underline">di sini</a> untuk aktivasi akun';
							$data['message']	.= $this->ion_auth_model->message_end_delimiter;
						} else if ($replaced_error == $this->lang->line('login_timeout')) {

							$this->load->model('user_model');

							$user = $this->user_model->get_by(array($this->config->item('identity','ion_auth') => $identity));
							$data['message']	.= $this->ion_auth_model->message_start_delimiter;
							$data['message']	.= $replaced_error.' Coba lagi dalam: '.$this->ion_auth_model->get_remaining_attempt_time($identity).' detik';
							$data['message']	.= $this->ion_auth_model->message_end_delimiter;
						} else {
							$data['message'] .= $error;
						}
					}
					echo json_encode($data);
				}

			} else {
				echo json_encode(array('message' => (validation_errors()) ? validation_errors() : $this->session->flashdata('message')));
			}
		} else {
			$this->load_page('page/public/login', $this->data);
		}

	}

	function logout() {
		$this->data['title'] = "Logout";

		$logout = $this->ion_auth->logout();

		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('', 'refresh');
	}

	function lupa_password() {

		if($this->input->post()){
		
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');

			if ($this->form_validation->run() == false) {
				echo json_encode(array('message' => (validation_errors()) ? validation_errors() : $this->session->flashdata('message')));
			} else {
				$identity_column = $this->config->item('identity','ion_auth');
				$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

				if(empty($identity)) {

		            $this->ion_auth->set_error('forgot_password_identity_not_found');
	                
	                echo json_encode(array('message' => $this->ion_auth->errors()));

	    		} else {

					$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

					if ($forgotten) {

						$view = $this->config->item('email_templates', 'ion_auth').$this->config->item('email_forgot_password', 'ion_auth');

						$message = $this->load->view($view, $forgotten, true);
						
						$this->load->library('google_mail');
						$email = $this->google_mail->send_mail(
							$this->config->item('admin_email', 'ion_auth'), 
							$this->config->item('site_title', 'ion_auth'),
							$identity->email,
							$this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_forgotten_password_subject'),
							$message
							);

						if ($email) {
							echo json_encode(array('message' => 'Email untuk set ulang kata sandi telah dikirim ke email anda: '.$identity->email. '.'));
						} else {
							$this->ion_auth_model->set_error('forgot_password_unsuccessful');
							echo json_encode(array('message' => $this->ion_auth->errors()));
						}
						// redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
					} else {
						echo json_encode(array('message' => $this->ion_auth->errors()));
					}
				}
			}
		} else {

			//setelah klik link dari email
			//ke halaman reset password
			$code = $this->uri->segment(3);
			
			if(isset($code)) { 
				$user = $this->ion_auth->forgotten_password_check($code);
				if($user && $code == $user->forgotten_password_code){
					$this->session->set_flashdata('halaman', $this->lang->line('reset_password_heading'));
					$this->session->set_flashdata('code', $code);
					redirect("auth/login", 'refresh');
				}
			}
			show_404();
		}
	}

	function reset_password($halaman){

		$code = $this->input->post('code');

		if($halaman == 'aktivasi'){
			$id = $this->input->post('id');
			$user = $this->ion_auth_model->user($id)->row();
		} else if ($halaman == 'lupa_password') {
			$user = $this->ion_auth->forgotten_password_check($code);
		} else {
			show_404();
		}

		//ganti password
		if ($user) {

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false){
				$message = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			} else {

				$identity 	= $user->{$this->config->item('identity', 'ion_auth')};
				$change 	= $this->ion_auth->reset_password($identity, $this->input->post('new'));

				if ( ! $change) {
					$message = $this->ion_auth->errors();
				} else {

					if($halaman == 'aktivasi'){
						$activation = $this->ion_auth->activate($id, $code);

						if ( ! $activation) {
							$message = $this->ion_auth->errors();
						}
					}
				}
			}
		
		} else {
			$message = $this->ion_auth->errors();
		}

		if(isset($message)) echo json_encode(array('message' => $message));
	}

	function _get_csrf_nonce() {
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce() {
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function load_page($view, $data=null, $returnhtml=false) {
		
		$this->viewdata = (empty($data)) ? $this->data: $data;
		
		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);
		
		if ($returnhtml) return $view_html;
	}

}
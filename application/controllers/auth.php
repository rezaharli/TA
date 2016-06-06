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
			$activate 			= $this->input->post('a');

			$user = $this->ion_auth_model->user($id)->row();
			
			if( ! $activate) {

				//ganti password
				if ($user && $user->activation_code  == $activation_code) {

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
							$activation = $this->ion_auth->activate($id, $activation_code);

							if ( ! $activation) {
								$message = $this->ion_auth->errors();
							}
						}
					}
				
				} else {
					$message = $this->ion_auth->errors();
				}

				if(isset($message)) echo json_encode(array('message' => $message));

			} else if ($activate == 'false') {

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
					echo json_encode(array('message' => 'Email aktivasi sudah dikirim ke email anda: '.$user->email. '.'));
				} else {
					echo json_encode(array('message' => 'Pengiriman email aktivasi gagal.'));
				}
			}
		} else {

			//setelah klik link dari email
			//ke halaman reset password
			$id 				= $this->uri->segment(3);
			$activation_code 	= $this->uri->segment(4);
			$activate 			= $this->uri->segment(5);
			
			if(isset($id) || isset($activation_code) || $activate == 'true') { 
				$user = $this->ion_auth_model->user($id)->row();
				if($user && $activation_code == $user->activation_code){
					$this->session->set_flashdata('halaman', $this->lang->line('login_heading'));
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	}

	function do_username_check(){
		$username = $this->input->post('username');
        $user = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
		if($username == $user->username){ //jika username sama seperti sebelumnya (tidak berubah)
			echo '3';
		} else {
			$user = $this->user_model->get_by(array('username' => $username));
			echo isset($user);
		}
	}

    function do_password_edit(){
    	$password = $this->input->post('password');
    	$this->user_model->update($this->session->userdata('id'), array('password' => sha1($password)));
    	$this->logout();
    }

    function do_username_edit(){
    	$username = $this->input->post('username');
    	$this->user_model->update($this->session->userdata('id'), array('username' => $username));
    	$this->logout();
    }

    function edit(){
        $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));

        $this->load->model($user_data->role.'_model', 'roled_user_model');
        $roled_user_data = $this->roled_user_model->get_by(array('id_user' => $user_data->id));

        $data['nama']       = $user_data->nama;
        $data['username']   = $user_data->username;
        $data['alamat']     = $user_data->alamat;
        $data['telp']       = $user_data->telp;
        $data['nip'] = $roled_user_data->nip;

    	$this->load_page('page/private/'.$user_data->role.'/edit_profile', $data);
    }

    function do_edit(){
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');

        $this->user_model->update($this->session->userdata('id'), array('nama' => $nama, 'email' => $email, 'alamat' => $alamat, 'telp' => $telp ));

        redirect('user/edit');
    }

	function logout(){
	    if($this->session->userdata('id')) {
        	$this->session->sess_destroy();
	    }
	    redirect('');
    }

    function show_profile($username){
    	$this->load_page('');
    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
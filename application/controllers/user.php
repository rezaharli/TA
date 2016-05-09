<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('user_model');
	}

	function do_username_check(){
		$username = $this->input->post('username');
        $user = $this->user_model->get_by(array('id' => $this->session->userdata('id')));

        //jika username sama seperti sebelumnya (tidak berubah)
        //hanya untuk edit profil user
		if($username == $user->username && $this->uri->segment(3) == 'user' && $this->uri->segment(4) == 'edit'){ 
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

    function do_datadiri_edit(){
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');

        $this->user_model->update($this->session->userdata('id'), array('email' => $email, 'alamat' => $alamat, 'telp' => $telp ));

        redirect('user/edit');
    }

    function edit(){
        $user = $this->get_user_dan_role();

        $data['role']       = $user->role;
        $data['nama']       = $user->nama;
        $data['username']   = $user->username;
        $data['alamat']     = $user->alamat;
        $data['telp']       = $user->telp;

        if ($user->role == 'staff'){
            $data['nip'] = $user->roled_data->nip;    
        } elseif ($user->role == 'mahasiswa') {
            $data['nim'] = $user->roled_data->nim;  
        }

    	$this->load_page('page/private/edit_profile', $data);
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
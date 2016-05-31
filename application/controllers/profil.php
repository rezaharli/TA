<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends Private_Controller {
	
	function __construct() {
		parent::__construct();

        $this->load->model('user_model');
	}

    public function _remap($method, $params = array()) {
        if (method_exists(__CLASS__, $method)) {
            $this->$method($params);
        } else {
            $this->index();
        }
    }

    function index() {
        $username = $this->uri->segment(2);

        if($username){
            $user = $this->user_model->get_user_dan_role_by(array('username' => $username));

            if ($user) {
                $data['id_user']        = $user->id;
                $data['role']           = $user->role;
                $data['nama']           = $user->nama;
                $data['username']       = $user->username;
                $data['alamat']         = $user->alamat;
                $data['email']          = $user->email;
                $data['telp']           = $user->telp;
                $data['foto_profil']    = ($user->foto_profil) ? $user->foto_profil : 'default.png' ;
                $data['jenis']          = $user->roled_data->jenis;

                if ($user->role == 'staff'){
                    $data['nip'] = $user->roled_data->nip;    
                } elseif ($user->role == 'mahasiswa') {
                    $data['nim'] = $user->roled_data->nim;  
                }

                $this->load_page('page/private/profil.php', $data);
            } else {
                $this->load_page('errors/404.php');
            }
        } else {
            $this->load->model('user_model');
            $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
            redirect('profil/'.$user->username);
        }
    }

    function do_foto_profil_edit(){
        $id = $this->session->userdata('id');
        $input_file_name = 'foto-profil';

        $tmp        = explode(".", $_FILES[$input_file_name]['name']);
        $ext        = end($tmp);
        $filename   = $this->session->userdata('id').'_'.sha1($_FILES[$input_file_name]['name']).'.'.$ext;

        $config['upload_path']      = './assets/img/foto-profil/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['file_name']        = $filename;

        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload($input_file_name)) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {
            $user = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
            $file = "./assets/img/foto-profil/".$user->foto_profil;
            if(is_file($file)){
                if(unlink($file)){
                    $this->user_model->update($this->session->userdata('id'), array('foto_profil' => $this->upload->data()['file_name']));
                }
            }
        }
        redirect('user');
    }

	function do_username_check(){
		$username       = $this->input->post('username');
        $aksi           = $this->input->post('aksi');
        $username_lama  = $this->input->post('username_lama');
        
        $user = $this->user_model->get_by(array('id' => $this->session->userdata('id')));

        //jika username sama seperti sebelumnya (tidak berubah)
        //hanya untuk edit profil user
		if($username == $user->username && $aksi == 'edit'){ 
			echo 'sama seperti sebelumnya';
		} else {
			$user = $this->user_model->get_by(array('username' => $username));
			echo isset($user);
		}
	}

    function do_password_edit(){
    	$password = $this->input->post('password');
    	$this->user_model->update($this->session->userdata('id'), array('password' => sha1($password)));
    	redirect('auth/logout');
    }

    function do_username_edit(){
    	$username = $this->input->post('username');
    	$this->user_model->update($this->session->userdata('id'), array('username' => $username));
    	redirect('auth/logout');
    }

    function do_datadiri_edit(){
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');

        $this->user_model->update($this->session->userdata('id'), array('email' => $email, 'alamat' => $alamat, 'telp' => $telp ));

        redirect('user');
    }

    function show_profile($username){
    	$this->load_page('');
    }

}
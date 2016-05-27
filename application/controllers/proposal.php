<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposal extends Private_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('proposal_lomba_model');
		$this->load->model('pengajuan_proposal_mahasiswa_model');
		$this->load->model('staff_model');
		$this->load->model('event_model');
	}

    function upload_pengajuan (){
        // $this->load->model('user_model');
        // $user_data = $this->user_model->get_by(array('id' => $this->session->userdata('id')));
        // $this->load_page('page/private/'.$user_data->role.'/pengajuan_proposal', null);
    	$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $data['user'] = $user;
        $this->load_page('page/private/mahasiswa/upload_pengajuan_proposal', $data);
    }


    function do_upload_pengajuan(){
    	$nama_input_file = 'file_pengajuan';

        // // $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $get_id_staff = $this->staff_model->get_all();
        $penanggungjawab = $this->event_model->get_by(array('penanggungjawab' => $get_id_staff->nip));
        $pengaju = $this->pengajuan_proposal_mahasiswa_model->get_by(array('pengaju_proposal' => $user->roled_data->nim));


        //$id_himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim))->id;

        // $this->load->model('pengajuan_proposal_himpunan_model');
        $last_id_pengajuan_proposal = $this->pengajuan_proposal_mahasiswa_model->insert(array('pengaju_proposal' => $pengaju));

        $tmp        = explode(".", $_FILES[$nama_input_file]['name']);
        $ext        = end($tmp);
        $filename   = $last_id_pengajuan_proposal.'_'.sha1($_FILES[$nama_input_file]['name']).'.'.$ext;

        $path = './assets/upload/proposal_mahasiswa/pengajuan-'.$last_id_pengajuan_proposal.'/';
        if(!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path']      = $path;
        $config['allowed_types']    = '*';
        $config['file_name']        = $filename;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($nama_input_file)) {
            rmdir($path);
            $this->pengajuan_proposal_himpunan_model->delete($last_id_pengajuan_proposal);
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {
            date_default_timezone_set("Asia/Jakarta");
            $data = array(
                'id_pengajuan_proposal' => $last_id_pengajuan_proposal,
                'nama_kompetisi'        => $this->input->post('nama_kompetisi'),
                'penyelenggara'         => $this->input->post('penyelenggara'),
                'tingkat_kompetisi'     => $this->input->post('tingkat_kompetisi'),
                'tema_kompetisi'        => $this->input->post('tema_kompetisi'),
                'tujuan_kompetisi'      => $this->input->post('tujuan_kompetisi'),
                'sasaran_kompetisi'     => $this->input->post('sasaran_kompetisi'),
                'tanggal_kompetisi'     => $this->input->post('tanggal_kompetisi'),
                'tempat_kompetisi'      => $this->input->post('tempat_kompetisi'),
                'anggaran'              => $this->input->post('anggaran'),
                'file'                  => $this->upload->data()['file_name']
            );

            $id_proposal = $this->proposal_lomba_model->insert($data);
            if ($this->input->post('drive_upload') == 1) {
                $this->session->set_userdata('upload_data', $upload_data);
                $this->get_google_client();
            }

            $this->session->set_flashdata(array('status' => true));

        }

        redirect('proposal'); 

    }

}

/* End of file proposal.php */
/* Location: ./application/controllers/proposal.php */
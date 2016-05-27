<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan_himpunan extends Private_Controller{

    protected $user;

    public function __construct(){
        parent::__construct();
        // assign variable user from session
        $this->user = $this->session->userdata('logged_in_user');
        // load models
        $this->load->model('user_model');
        $this->load->model('himpunan_model');
        $this->load->model('kegiatan_himpunan_model');
        $this->load->model('proposal_himpunan_model');
        $this->load->model('peserta_model');
    }
    
    function list_kegiatan(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        $kegiatans = $this->kegiatan_himpunan_model->get_all();
        
                
        $data['kegiatans'] = array();
        foreach ($kegiatans as $kegiatan) {
            $proposal = $this->proposal_himpunan_model->get_by(array('id_pengajuan_proposal' => $kegiatan->id));

            array_push($data['kegiatans'], array(
                'id_pengajuan_proposal' => $proposal->id_pengajuan_proposal,
                'nama_kegiatan'         => $kegiatan->nama_kegiatan,
                'tanggal_pelaksanaan'   => $kegiatan->tanggal_pelaksanaan,
                'tempat_kegiatan'       => $kegiatan->tempat_kegiatan
            ));
        }
        $data['himpunan'] = $himpunan;

        $this->load_page('page/private/himpunan/list_kegiatan_himpunan', $data); 
    }

    function detail_kegiatan(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        $id_acara = $this->input->get('id_acara');

        $proposal = $this->proposal_himpunan_model->get_by(array('id_pengajuan_proposal' => $id_acara));
        // die($this->db->last_query());

        $data['id_pengajuan_proposal']  = $proposal->id_pengajuan_proposal;
        $data['judul']                  = $proposal->judul;
        $data['tema_kegiatan']          = $proposal->tema_kegiatan;
        $data['tujuan_kegiatan']        = $proposal->tujuan_kegiatan;
        $data['tanggal_kegiatan']       = $proposal->tanggal_kegiatan;
        $data['tempat_kegiatan']        = $proposal->tempat_kegiatan;
        $data['bentuk_kegiatan']        = $proposal->bentuk_kegiatan;
        $data['id_acara'] = $id_acara;

        $data['himpunan'] = $himpunan;

        $this->load_page('page/private/himpunan/list_kegiatan_himpunan_detail', $data);
    }

    function detail_peserta(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        $id_acara = $this->input->get('id_acara');
      
        // $proposal = $this->proposal_himpunan_model->get_by(array('id_pengajuan_proposal' => $id_acara));
        $pesertas = $this->peserta_model->get_many_by(array('id_acara' => $id_acara));
        // die($this->db->last_query());      
                
        $data['pesertas'] = array();
        foreach ($pesertas as $peserta) {
        $proposal = $this->proposal_himpunan_model->get_by(array('id_pengajuan_proposal' => $kegiatan->id));

            array_push($data['pesertas'], array(
                'nama'         => $peserta->nama
            ));
        }
        $data['judul']    = $proposal->judul;
        $data['himpunan'] = $himpunan;

        $this->load_page('page/private/himpunan/list_peserta', $data);
    }
}
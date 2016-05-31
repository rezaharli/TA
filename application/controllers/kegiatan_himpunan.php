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
        $this->load->model('acara_himpunan_model');
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

        //menampilkan detail acara
        $acara = $this->acara_himpunan_model->get_by(array('id_pengajuan_proposal' => $id_acara));
        // die($this->db->last_query());

        $data['id']                     = $acara->id;    
        $data['id_pengajuan_proposal']  = $acara->id_pengajuan_proposal;
        $data['nama_acara']             = $acara->nama_acara;
        $data['tempat_acara']           = $acara->tempat_acara;
        $data['tanggal_acara']          = $acara->tanggal_acara;
        $data['deskripsi_acara']        = $acara->deskripsi_acara;

        // var_dump($data);
        // die;

        //menampilkan daftar peserta
        $pesertas = $this->peserta_model->get_many_by(array('id_acara' => $data['id']));

        $data['pesertas'] = array();
        foreach ($pesertas as $peserta) {
            array_push($data['pesertas'], array(
                'nama' => $peserta->nama
            ));
        }
        
        $data['himpunan'] = $himpunan;

        $this->load_page('page/private/himpunan/list_kegiatan_himpunan_detail', $data);
    }

    function detail_peserta(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        $id_acara = $this->input->get('id_acara');

        $pesertas = $this->peserta_model->get_many_by(array('id_acara' => $id_acara));
        
        $proposal = $this->proposal_himpunan_model->get_by(array('id_pengajuan_proposal' => $id_acara));

        $data['pesertas'] = array();
        foreach ($pesertas as $peserta) {

            array_push($data['pesertas'], array(
                'nama' => $peserta->nama
            ));
        }

        $data['judul']    = $proposal->judul;
        $data['himpunan'] = $himpunan;

        $this->load_page('page/private/himpunan/list_kegiatan_himpunan_detail', $data);
    }

    function cetak_sertifikat(){
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

        $this->load_page('page/private/himpunan/cetak_sertifikat_himpunan', $data);
    }

    function do_cetak_sertifikat(){
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

        $this->load_page('page/private/himpunan/cetak_sertifikat_himpunan', $data);
    }
}

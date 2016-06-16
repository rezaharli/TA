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
        $this->load->model('pengajuan_proposal_himpunan_model');
        $this->load->model('acara_himpunan_model');
        $this->load->model('peserta_model');
        $this->load->model('panitia_model');
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
        $id_acara = $this->input->get('id_acara');

        //menampilkan detail acara
        $acara = $this->acara_himpunan_model->get($id_acara);

        $pengajuan = $this->pengajuan_proposal_himpunan_model->get($acara->id_pengajuan_proposal);

        $himpunan = $this->himpunan_model->get($pengajuan->pengaju_proposal);

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

        $panitias = $this->panitia_model->get_panitia_with_user($data['id']);
        $data['panitias'] = array();
        foreach ($panitias as $panitia) {
            array_push($data['panitias'], array(
                'nim'   => $panitia->nim,
                'nama'  => $panitia->nama
            ));
        }

        $data['himpunan'] = $himpunan;

        $this->load_page('page/private/himpunan/list_kegiatan_himpunan_detail', $data);
    }

    function cetak_sertifikat(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));

        $proposal = $this->pengajuan_proposal_himpunan_model->get_by(array('pengaju_proposal' => $himpunan->id));
        $acaras = $this->acara_himpunan_model->get_all();
        
        $data['acaras'] = array();
        foreach ($acaras as $acara) {
            array_push($data['acaras'], array(
                'id_acara'              => $acara->id,
                'id_pengajuan_proposal' => $proposal->id,
                'nama_acara'            => $acara->nama_acara,
                'tempat_acara'          => $acara->tempat_acara,
                'tanggal_acara'         => $acara->tanggal_acara,
                'deskripsi_acara'       => $acara->deskripsi_acara
            ));
        }

        $data['himpunan'] = $himpunan;

        $this->load_page('page/private/himpunan/cetak_sertifikat_himpunan', $data);
    }

    function do_cetak_sertifikat($id_acara){
        $this->load->library('phpword');

        $pesertas = $this->peserta_model->get_many_by(array('id_acara' => $id_acara));
        // var_dump($this->db->last_query()); die();
        $acara = $this->acara_himpunan_model->get_by('id', $id_acara);

        $files = array();

        foreach ($pesertas as $peserta) {
            $data = array(
                'nama' => $peserta->nama,
                'nama_acara' => $acara->nama_acara,
                'id_acara' => $acara->id,
                'tanggal_acara' => $acara->tanggal_acara
            );
            $files[] = $this->phpword->generateSertifikat('assets/doc_template/sertifikat.docx', $data);
        }
        // echo "<pre>";
        // var_dump($data['peserta']); die();

        // create zip file
        $zipname = $acara->nama_acara."_".$acara->id.'.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $zip->addFile($file);
        }
        $zip->close();

        // Stream zip
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);

    }
}

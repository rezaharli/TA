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
        $this->load->model('mahasiswa_model');
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

        //menampilkan daftar peserta
        $pesertas = $this->peserta_model->get_many_by(array('id_acara' => $data['id']));

        $data['pesertas'] = array();
        foreach ($pesertas as $peserta) {
            array_push($data['pesertas'], array(
                'nama'  => $peserta->nama,
                'email' => $peserta->email
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

    // function do_cetak_sertifikat_peserta($id_acara){
    //     $this->load->library('phpword');
    //
    //     $pesertas = $this->peserta_model->get_many_by(array('id_acara' => $id_acara));
    //
    //     $acara = $this->acara_himpunan_model->get_acara_with_pengaju($id_acara);
    //
    //     $files = array();
    //     $template_name = strtolower($acara->nama).".docx";
    //     foreach ($pesertas as $peserta) {
    //         $data = array(
    //             'nama' => $peserta->nama,
    //             'nama_acara' => $acara->nama_acara,
    //             'id_acara' => $acara->id,
    //             'tanggal_acara' => $acara->tanggal_acara,
    //             'sebagai' => 'PESERTA'
    //         );
    //
    //     }
    //     $files[] = $this->phpword->generateSertifikat('assets/doc_template/'.$template_name, $data);
    //     $this->load->library('zip');
    //     $this->zip->read_dir('assets/sertifikat/'.$acara->nama_acara."_".$acara->id, FALSE);
    //     $this->zip->download($acara->nama_acara."_".$acara->id);
    //
    // }

    // function do_cetak_sertifikat_panitia($id_acara){
    //     $this->load->library('phpword');
    //
    //     $panitias = $this->panitia_model->get_many_by(array('id_acara' => $id_acara));
    //
    //     $acara = $this->acara_himpunan_model->get_acara_with_pengaju($id_acara);
    //
    //     $files = array();
    //     $template_name = strtolower($acara->nama).".docx";
    //     foreach ($panitias as $panitia) {
    //         $mahasiswa = $this->mahasiswa_model->get_by(array('nim' => $panitia->nim));
    //         $user = $this->user_model->get_by(array('id' => $mahasiswa->id_user));
    //
    //         $data = array(
    //             'nama'          => $user->nama,
    //             'nama_acara'    => $acara->nama_acara,
    //             'id_acara'      => $acara->id,
    //             'tanggal_acara' => $acara->tanggal_acara,
    //             'sebagai'       => 'PANITIA'
    //         );
    //
    //     }
    //
    //     $files[] = $this->phpword->generateSertifikat('assets/doc_template/'.$template_name, $data);
    //
    //     $this->load->library('zip');
    //     $this->zip->read_dir('assets/sertifikat/'.$acara->nama_acara."_".$acara->id, FALSE);
    //     $this->zip->download($acara->nama_acara."_".$acara->id);
    // }

    function do_cetak_sertifikat_panitia($id_acara){
        $panitias = $this->panitia_model->get_many_by(array('id_acara' => $id_acara));

        $acara = $this->acara_himpunan_model->get_acara_with_pengaju($id_acara);

        $files = array();
        $template_name = strtolower($acara->nama).".docx";

        $data[0] = array("nama", "sebagai", "nama_acara", "bulan", "tanggal", "tahun");

        foreach ($panitias as $key => $panitia) {
            $mahasiswa = $this->mahasiswa_model->get_by(array('nim' => $panitia->nim));
            $user = $this->user_model->get_by(array('id' => $mahasiswa->id_user));

            $data[++$key] = array(
                'nama'          => $user->nama,
                'sebagai'       => 'PANITIA',
                'nama_acara'    => $acara->nama_acara,
                'bulan'         => strftime("%B", strtotime($acara->tanggal_acara)),
                'tanggal'       => strftime("%d", strtotime($acara->tanggal_acara)),
                'tahun'         => strftime("%Y", strtotime($acara->tanggal_acara))
            );
        }

        $file_template = fopen('assets/doc_template/data_source.csv', 'w');

        foreach ($data as $fields) {
            fputcsv($file_template, $fields);
        }

        fclose($file_template);

        $zip = new ZipArchive;
        if ($zip->open('assets/doc_template/'.$acara->nama.'.zip') === TRUE) {
            $zip->addFile('assets/doc_template/'.$acara->nama.'.docx', 'sertifikat_panitia.docx');
            $zip->addFile('assets/doc_template/data_source.csv', 'data_source.csv');
            $zip->close();
        }

        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=Sertifikat Panitia.zip");
        header("Content-length: " . filesize('assets/doc_template/'.$acara->nama.'.zip'));
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile('assets/doc_template/'.$acara->nama.'.zip');

    }

    function do_cetak_sertifikat_peserta($id_acara){
        $pesertas = $this->peserta_model->get_many_by(array('id_acara' => $id_acara));

        $acara = $this->acara_himpunan_model->get_acara_with_pengaju($id_acara);

        $files = array();
        $template_name = strtolower($acara->nama).".docx";

        $data[0] = array("nama", "sebagai", "nama_acara", "bulan", "tanggal", "tahun");

        foreach ($pesertas as $key => $peserta) {
            $data[++$key] = array(
                'nama'          => $peserta->nama,
                'sebagai'       => 'PESERTA',
                'nama_acara'    => $acara->nama_acara,
                'bulan'         => strftime("%B", strtotime($acara->tanggal_acara)),
                'tanggal'       => strftime("%d", strtotime($acara->tanggal_acara)),
                'tahun'         => strftime("%Y", strtotime($acara->tanggal_acara))
            );
        }

        $file_template = fopen('assets/doc_template/data_source.csv', 'w');
        
        foreach ($data as $fields) {
            fputcsv($file_template, $fields);
        }

        fclose($file_template);

        $zip = new ZipArchive;
        if ($zip->open('assets/doc_template/'.$acara->nama.'.zip') === TRUE) {
            $zip->addFile('assets/doc_template/'.$acara->nama.'.docx', 'sertifikat_panitia.docx');
            $zip->addFile('assets/doc_template/data_source.csv', 'data_source.csv');
            $zip->close();
        }

        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=Sertifikat Peserta.zip");
        header("Content-length: " . filesize('assets/doc_template/'.$acara->nama.'.zip'));
        header("Pragma: no-cache");
        header("Expires: 0");
        readfile('assets/doc_template/'.$acara->nama.'.zip');

    }
}
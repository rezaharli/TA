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
        // $this->load->model('staff_model');
        $this->load->model('kegiatan_himpunan_model');
    }
    
    function list_kegiatan(){
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
        
        $himpunan = $this->himpunan_model->get_by(array('id_penanggungjawab' => $user->roled_data->nim));
        $kegiatans = $this->kegiatan_himpunan_model->get_all();

        $data['kegiatans'] = array();
        foreach ($kegiatans as $kegiatan) {
            array_push($data['kegiatans'], array(
                'nama_kegiatan'         => $kegiatan->nama_kegiatan,
                'tanggal_pelaksanaan'   => $kegiatan->tanggal_pelaksanaan,
                'tempat_kegiatan'       => $kegiatan->tempat_kegiatan
                ));
        }
        $data['himpunan'] = $himpunan;
    $this->load_page('page/private/himpunan/list_kegiatan_himpunan', $data); 
    }

    function detail_kegiatan(){
        $id_pengajuan = $this->input->get('id');

        $data['proposals'] = array();
        foreach ($proposals as $proposal) {

            array_push($data['proposals'], array(
                'judul'             => $proposal->judul,
                'tanggal_upload'    => $proposal->waktu_upload,
                'status'            => $proposal->status_approve
            ));
            
        }
        // $results = array();
        // foreach ($proposals as $proposal) {
        //  $result = array(
        //      'judul'             => $proposal->judul,
        //      'tanggal_upload'    => $proposal->waktu_upload,
        //      'status'            => $proposal->status_approve
        //  );
        //  array_push($results, $result);
        // }
        // json_encode($results);
        $this->load_page('page/private/staff/logbook_proposal_himpunan_detail', $data);

        if($id_pengajuan){
            $proposals = $this->logbook_pengajuan_proposal_himpunan_model->get_many_by(array('pengaju' => $himpunan->id, 'status_approve' => 'y'));
            $data['judul']              = $event->id;
            $data['tanggal_upload']     = $event->nama_event;
            $data['status']             = $event->status;
            $data['penanggungjawab']    = $event->penanggungjawab;

            $this->load_page('page/private/detail_event.php', $data);
        } else {
            $this->load->model('user_model');
            $user = $this->user_model->get_by(array('id' => $this->session->userdata('id')));

            if($user->role == 'mahasiswa'){
                $data['events'] = $this->event_model->order_by('tanggal_event')->get_many_by(array('status' => 'disetujui'));
            } else if($user->role == 'staff'){
                $data['events'] = $this->event_model->order_by('tanggal_event')->get_all();
            }
            $this->load_page('page/private/event.php', $data);
        }
    }
}
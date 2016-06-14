<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends Public_Controller {

    private $list_gabungan_event = array();

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('event_model');
        $this->load->model('acara_himpunan_model');
        $this->load->model('detail_tim_model');
        $this->load->model('peserta_model');

        $where          = array('status' => 'disetujui');
        $total_event    = $this->event_model->count_by($where);
        
        $where = array_merge($where, array('tanggal_event >=' => date('Y-n-j')));
        $list_event                 = $this->event_model->order_by('tanggal_event')->limit(12, 0)->get_many_by($where);
        $this->set_list_gabungan_event($list_event, 'lomba');

        $total_acara_himpunan   = $this->acara_himpunan_model->count_all();
        $list_acara_himpunan    = $this->acara_himpunan_model
                                        ->order_by('tanggal_acara')
                                        ->limit(12, 0)
                                        ->get_many_by(array('tanggal_acara >= ' => date('Y-n-j')));
        $this->set_list_gabungan_event($list_acara_himpunan, 'kegiatan');

        $total_peserta = $this->detail_tim_model->count_all() + $this->peserta_model->count_all();

        $data['total_event']            = $total_event;
        $data['total_acara_himpunan']   = $total_acara_himpunan;
        $data['event_mendatang']        = array_slice($this->list_gabungan_event, 0, 12);
        $data['total_peserta']          = $total_peserta;

        $this->load_page('page/public/index', $data);
    }

    public function events() {
        $this->load->model('event_model');
        $this->load->model('acara_himpunan_model');
        $kategori = $this->uri->segment(3);

        $key        = $this->input->get('cari');
        $rentang    = $this->input->get('rentang');

        if (isset($kategori)) {
            if (! ($kategori == 'lomba' || $kategori == 'kegiatan')) show_404();
        }

        if( ! isset($kategori) || $kategori == 'lomba'){
            $event = $this->event_model;

            if (isset($key) && $key != '') {
                $event = $event->like('nama_event', $key);
            }

            $where = array('status' => 'disetujui');
            if (isset($rentang) && $rentang != '') {
                $where = array_merge($where, array('tanggal_event >=' => date('Y-n-j')));
                $where = array_merge($where, array('tanggal_event <=' => date('Y-n-j', strtotime(date('Y-n-j') . ' +'.$rentang.' day'))));
            }

            $list_event = $event->order_by('tanggal_event')->get_many_by($where);
            $this->set_list_gabungan_event($list_event, 'lomba');
        }

        if ( ! isset($kategori) || $kategori == 'kegiatan') {
            $acara_himpunan = $this->acara_himpunan_model;
            
            if (isset($key) && $key != '') {
                $acara_himpunan = $acara_himpunan->like('nama_acara', $key);
            }

            $where = array();
            if (isset($rentang) && $rentang != '') {
                $where = array('tanggal_acara >=' => date('Y-n-j'));
                $where = array_merge($where, array('tanggal_acara <=' => date('Y-n-j', strtotime(date('Y-n-j') . ' +'.$rentang.' day'))));
            }

            $list_acara_himpunan = $acara_himpunan->order_by('tanggal_acara')->get_many_by($where);
            $this->set_list_gabungan_event($list_acara_himpunan, 'kegiatan');
        }

        $data['events']                 = $this->list_gabungan_event;
        $data['total_event']            = $this->event_model->count_by(array('status' => 'disetujui'));
        $data['total_acara_himpunan']   = $this->acara_himpunan_model->count_all();

        $this->load_page('page/public/temukan-event', $data);
    }
	
    function lomba() {
        $this->load->model('event_model');

        $event = $this->event_model->get_by(array('id' => $this->uri->segment(3), 'status' => 'disetujui'));
            
        $data['event'] = $this->make_lomba_array($event);

        $this->load_page('page/public/detail-event', $data);
    }
    
    function kegiatan() {
        $this->load->model('acara_himpunan_model');
        $event = $this->acara_himpunan_model->get_by(array('id' => $this->uri->segment(3)));
            
        $data['event'] = $this->make_kegiatan_array($event);

        if($this->uri->segment(4)){
            if ($this->uri->segment(4) == 'daftar') {
                if($data['event']['daftarable'] == true){
                    $this->load_page('page/public/daftar_event', $data);
                } else show_404();
            } else show_404();
        } else {
            $this->load_page('page/public/detail-event', $data);
        }
    }
    
    function daftar() {
        $this->load->model('acara_himpunan_model');
        $this->load->model('peserta_model');

        if( ! $this->input->post()) show_404();

        $acara      = $this->acara_himpunan_model->get($this->uri->segment(3));
        $daftarable = $acara->tanggal_acara >= date('Y-m-j');
        if( ! $acara && ! $daftarable) show_404();

        $nama   = $this->input->post('nama');
        $email  = $this->input->post('email');

        $peserta = $this->peserta_model->get_by(array('email' => $email));

        if( ! $peserta) {
            $last_inserted_id_peserta = $this->peserta_model->insert(array('nama' => $nama, 'email' => $email, 'id_acara' => $acara->id));
            if ( ! $last_inserted_id_peserta) {
                $this->session->set_flashdata('message', 'Pendaftaran gagal');
            } else {
                $this->session->set_flashdata('message', 'Pendaftaran berhasil');
            }
        } else {
            $this->session->set_flashdata('message', 'Pendaftaran gagal, email telah terdaftar.');
        }
        redirect('guest/kegiatan/'.$acara->id.'/daftar');
    }

    private function set_list_gabungan_event($events, $jenis){
        if($jenis == 'lomba') {
            foreach ($events as $event) {
                array_push($this->list_gabungan_event, $this->make_lomba_array($event));
            }
        } else if ($jenis == 'kegiatan') {
            foreach ($events as $event) {
                array_push($this->list_gabungan_event, $this->make_kegiatan_array($event));
            }
        }

        usort($this->list_gabungan_event, function($a, $b) { 
            return strnatcmp($a['tanggal'], $b['tanggal']); 
        });
    }

    private function make_lomba_array($event) {
        return array(
            'id'                => $event->id,
            'nama'              => $event->nama_event,
            'tanggal'           => $event->tanggal_event,
            'tanggal_display'   => $this->get_tanggal_formatted($event->tanggal_event),
            'gambar'            => ($event->bukti_event) ? 'assets/upload/event_lomba/'.$event->bukti_event : 'assets/universal/img/default-lomba.jpg',
            'jenis'             => 'lomba'
            );
    }

    private function make_kegiatan_array($event) {
        return array(
            'id'                => $event->id,
            'nama'              => $event->nama_acara,
            'deskripsi'         => $event->deskripsi_acara,
            'tempat'            => $event->tempat_acara,
            'tanggal'           => $event->tanggal_acara,
            'tanggal_display'   => $this->get_tanggal_formatted($event->tanggal_acara),
            'gambar'            => ($event->poster_acara) ? 'assets/upload/acara/acara_'.$event->id.'/'.$event->poster_acara : 'assets/universal/img/default-kegiatan.jpg',
            'jenis'             => 'kegiatan',
            'daftarable'        => $event->tanggal_acara >= date('Y-m-j')
            );
    }

    private function get_tanggal_formatted($tanggal){
        return strftime('%A, %e %B %Y', strtotime($tanggal));
    }

}

/* End of file guest.php */
/* Location: ./application/controllers/guest.php */
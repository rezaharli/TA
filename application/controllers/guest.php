<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guest extends Public_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('event_model');
        $this->load->model('acara_himpunan_model');
        $this->load->model('detail_tim_model');
        $this->load->model('peserta_model');

        $list_gabungan_event = array();

        $where = array('status' => 'disetujui');
        $total_event = $this->event_model->count_by($where);
        $where['tanggal_event >='] = date('Y-n-j');
        $list_event = $this->event_model->order_by('tanggal_event')->limit(12, 0)->get_many_by($where);

        foreach ($list_event as $event) {
            array_push($list_gabungan_event, array(
                'id'                => $event->id,
                'nama'              => $event->nama_event,
                'tanggal'           => $event->tanggal_event,
                'tanggal_display'   => strftime('%A, %e %B %Y', strtotime($event->tanggal_event)),
                'gambar'            => $event->bukti_event,
                'jenis'             => 'Lomba'
                ));
        }

        $total_acara_himpunan = $this->acara_himpunan_model->count_all();
        $list_acara_himpunan = $this->acara_himpunan_model
                                            ->order_by('tanggal_acara')
                                            ->limit(12, 0)
                                            ->get_many_by(array('tanggal_acara >= ' => date('Y-n-j')));

        foreach ($list_acara_himpunan as $event) {
            array_push($list_gabungan_event, array(
                'id'        => $event->id,
                'nama'      => $event->nama_acara,
                'tanggal'   => $event->tanggal_acara,
                'tanggal_display'   => strftime('%A, %e %B %Y', strtotime($event->tanggal_acara)),
                'gambar'    => $event->poster_acara,
                'jenis'     => 'Kegiatan himpunan'
                ));
        }

        usort($list_gabungan_event, function($a, $b) { 
            return strnatcmp($a['tanggal'], $b['tanggal']); 
        });

        $total_peserta = $this->detail_tim_model->count_all() + $this->peserta_model->count_all();

        $data['total_event']            = $total_event;
        $data['total_acara_himpunan']   = $total_acara_himpunan;
        $data['event_mendatang']        = array_slice($list_gabungan_event, 0, 12);
        $data['total_peserta']          = $total_peserta;

        $this->load_page('page/public/index', $data);
    }

    public function events() {
        $this->load_page('page/public/temukan-event');
    }
	
    public function detail_event() {
        $this->load_page('page/public/detail-event');
    }

}

/* End of file guest.php */
/* Location: ./application/controllers/guest.php */
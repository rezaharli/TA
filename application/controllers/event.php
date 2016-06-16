<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends Private_Controller {
	
	function __construct() {
		parent::__construct();
	    $this->load->model('event_model');
        
        $this->load->library('google_calendar');

        $this->sync_kalender();
	}

	function index(){
		show_404();
	}

    function lomba(){
        $id_event = $this->input->get('id');

        $this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
    	
    	$data['role_user']	= $user->role;
    	$data['jenis_user']	= $user->roled_data->jenis;

    	if($this->uri->segment(3) == '') {

    		if($id_event){
			
				$event = $this->event_model->get($id_event);
				if ( ! $event) {
					show_404();
				}

				$event->tanggal_mulai_display 	= $this->get_tanggal_formatted($event->tanggal_mulai);
				$event->tanggal_selesai_display = $this->get_tanggal_formatted($event->tanggal_selesai);
				$data['event'] 		= $event;
				$data['pengaju'] 	= $this->user_model->get($event->pengaju_event);
				
				if($event->penanggungjawab){
					$this->load->model('staff_model');
					$data['penanggungjawab'] = $this->staff_model->get_staff_dan_user_by_nip($event->penanggungjawab);
				}
				
				$data['google_url']	= $event->google_url;
				$data['url']		= base_url('event/lomba?id='.$event->id);

				$this->load_page('page/private/detail_event', $data);
			
			} else {

				$ordered_event 	= $this->event_model->order_by_tanggal_mulai();
				$events 		= $ordered_event->get_many_by(array('status' => 'disetujui'));

				foreach ($events as $event) {
					$event->tanggal_mulai_display 	= $this->get_tanggal_formatted($event->tanggal_mulai);
					$event->tanggal_selesai_display = $this->get_tanggal_formatted($event->tanggal_selesai);
				}
				$data['events'] = $events;
				$this->load_page('page/private/list_event', $data);
			}

		} else if($this->uri->segment(3) == 'pengajuan') {

			$ordered_event = $this->event_model->order_by_tanggal_mulai();
			if($user->role == 'mahasiswa' || $user->roled_data->jenis == 'staff_admin'){
				$events = $ordered_event->get_many_by(array('pengaju_event' => $user->id));
			} else if($user->role == 'staff'){
				$events = $ordered_event->get_all();
			}

			foreach ($events as $event) {
				$event->tanggal_mulai_display 	= $this->get_tanggal_formatted($event->tanggal_mulai);
				$event->tanggal_selesai_display = $this->get_tanggal_formatted($event->tanggal_selesai);
			}
			$data['events'] = $events;
			$this->load_page('page/private/list_event', $data);

		} else if($this->uri->segment(3) == 'tambah') {
			$this->load_page('page/private/staff/tambah_event');

		} else show_404();
    }

    function kegiatanhimpunan(){
    	$this->load->model('user_model');
        $user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

    	$data['role_user']	= $user->role;
    	$data['jenis_user']	= $user->roled_data->jenis;

		$this->load->model('acara_himpunan_model');
		
		$ordered_event = $this->acara_himpunan_model->order_by('tanggal_acara');
		$data['events'] = $ordered_event->get_all();
		$this->load_page('page/private/list_kegiatan_himpunan', $data);
    }

    function do_tambah(){
        $this->load->library('upload', $this->get_upload_config($_FILES['bukti_event']));
		if ( ! $this->upload->do_upload('bukti_event')) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$event 	= $this->google_calendar->insert(
				$this->input->post('nama'), 
				$this->input->post('tanggal_mulai'), 
				$this->input->post('tanggal_selesai'),
				5 //kuning, pending
				);

			if ($event) {
				$upload_data = $this->upload->data();
		        $this->load->model('user_model');
		        $pengaju = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
		        $jenis_user = $user->roled_data->jenis;
		        
		        $data = array(
		        	'id'				=> $event->id,
		        	'nama_event'		=> $this->input->post('nama'),
		        	'penyelenggara'		=> $this->input->post('penyelenggara'),
		        	'tingkat_kompetisi'	=> $this->input->post('tingkat_kompetisi'),
		            'tanggal_mulai'     => $this->input->post('tanggal_mulai'),
		            'tanggal_selesai'   => $this->input->post('tanggal_selesai'),
		            'keterangan' 		=> $this->input->post('keterangan'),
		            'bukti_event'		=> $upload_data['file_name'],
		        	'pengaju_event'		=> $pengaju->id,
		            'status'			=> ($pengaju->roled_data->jenis == 'kaur' || $pengaju->roled_data->jenis == 'staff_kemahasiswaan') ? 'disetujui' : null,
					'penanggungjawab'	=> ($pengaju->roled_data->jenis == 'kaur' || $pengaju->roled_data->jenis == 'staff_kemahasiswaan') ? $pengaju->roled_data->nip : null,
					'google_url'		=> $event->htmlLink
		        );
		    	$id_upload_event = $this->event_model->insert($data);
		        $this->session->set_flashdata(array('status' => true));
		        redirect('event/lomba/pengajuan');
			}
		}
    }

    function do_edit_event($id){
    	$config = $this->get_upload_config($_FILES['bukti_event']);
        $this->load->library('upload', $config);
    	
    	$data = array(
	    	'keterangan' 		=> $this->input->post('keterangan'),
	    	'tingkat_kompetisi' => $this->input->post('tingkat_kompetisi'),
	    	'penyelenggara' 	=> $this->input->post('penyelenggara'),
    	);
		
		if ($this->upload->do_upload('bukti_event')) {
	    	$event = $this->event_model->get($id);
	    	$file = $config['upload_path'].'/'.$event->bukti_event;
            
            if (is_file($file)){
                unlink($file);
            }

			$upload_data = $this->upload->data();
			$data['bukti_event'] = $upload_data['file_name'];
		}

    	if($this->event_model->update($id, $data)){

	    	if($this->google_calendar->update(
	    		$id, 
	    		$this->input->post('nama'), 
	    		$this->input->post('tanggal_mulai'), 
	    		$this->input->post('tanggal_selesai')
	    		)){
	        	redirect('event/lomba?id='.$id);
	    	}
	    }
    }

    function do_edit_status($id){
    	$status = null;
    	if ($this->input->get('s') == 't') {
    		$status = 'disetujui';
    	} else if ($this->input->get('s') == 'f') {
    		$status = 'ditolak';
    	}

    	$this->load->model('user_model');
    	$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));
    	$this->event_model->update($id, array('status' => $status, 'penanggungjawab' => $user->roled_data->nip));
    	redirect('event/lomba?id='.$id);
    }

	function get_calendar() {
		$this->load->model('user_model');
		$this->load->model('acara_himpunan_model');

		$results = array();

		$user = $this->user_model->get_user_dan_role_by_id($this->session->userdata('id'));

		if($user->roled_data->jenis == 'kaur' || $user->roled_data->jenis == 'staff_kemahasiswaan'){
			
			$events = $this->event_model->get_all();
			foreach ($events as $event) {
				array_push($results, $this->get_fullcalendar_content($event));
			}

		} else {
			
			$events = $this->event_model->get_many_by(array('pengaju_event' => $user->id, 'status' => NULL));
			foreach ($events as $event) {
				array_push($results, $this->get_fullcalendar_content($event));
			}
			
			$events = $this->event_model->get_many_by(array('pengaju_event' => $user->id, 'status' => 'ditolak'));
			foreach ($events as $event) {
				array_push($results, $this->get_fullcalendar_content($event));
			}
			
			$events = $this->event_model->get_many_by(array('status' => 'disetujui'));
			foreach ($events as $event) {
				array_push($results, $this->get_fullcalendar_content($event));
			}
		}

		$list_kegiatanhimpunan = $this->acara_himpunan_model->get_all();
		foreach ($list_kegiatanhimpunan as $kegiatanhimpunan) {
			$result = array(
	 			'id'			=> $kegiatanhimpunan->id,
	 			'title'			=> $kegiatanhimpunan->nama_acara,
	 			'start'			=> $kegiatanhimpunan->tanggal_acara,
	 			'end'			=> ((new DateTime($kegiatanhimpunan->tanggal_acara))->modify('+1 day'))->format('Y-m-d'),
	 			'url'			=> base_url('kegiatan_himpunan/detail_kegiatan?id_acara='.$kegiatanhimpunan->id),
 			);
			array_push($results, $result);
		}
        echo json_encode($results);
	}

	function hapus(){
		$id = $this->input->get('id');
		$event = $this->event_model->get($id);
		$file = './assets/upload/bukti_event/'.$event->bukti_event;
            
        if (is_file($file)){
            unlink($file);
        }

		$event = $this->google_calendar->delete($id);

		$this->event_model->soft_delete = FALSE;
    	$this->event_model->delete($id);
		redirect('event/lomba/pengajuan');
	}

	function tambah() {
		$this->load_page('page/private/staff/tambah_event');
	}

	private function get_fullcalendar_content($event){
		return array(
			'id'	=> $event->id,
 			'title'	=> $event->nama_event,
 			'start'	=> $event->tanggal_mulai,
 			'end'	=> ((new DateTime($event->tanggal_selesai))->modify('+1 day'))->format('Y-m-d'),
 			'url'	=> base_url('event/lomba?id='.$event->id),
 			'color'	=> ($event->status == 'disetujui') ? '#00a65a' : (($event->status == 'ditolak') ? '#dd4b39' : '#f39c12')
 			);
	}

    private function get_upload_config($files){
    	$input_file_name = 'bukti_event';

        $tmp        = explode(".", $files['name']);
        $ext        = end($tmp);
        $filename   = sha1($files['name']).'.'.$ext;

        $config['upload_path'] 		= './assets/upload/bukti_event';
		$config['allowed_types'] 	= 'jpg|png';
		$config['max_size']			= '5000';
		$config['max_width']  		= '2000';
		$config['max_height']  		= '2000';
        $config['file_name']        = $filename;

        if ( ! file_exists($config['upload_path'])) {
		   mkdir($config['upload_path'], 0777, true);
		}

		return $config;
    }

	private function sync_kalender(){
        $this->event_model->soft_delete = TRUE;
        $this->event_model->delete_by(array('id !=' => ''));
        $this->event_model->soft_delete = FALSE;

        $google_events = $this->google_calendar->get();
        foreach ($google_events as $google_event) {
        	$event = $this->event_model->get_by(array('id' => $google_event->id));
    		$data = array(
    			'nama_event'		=> $google_event->nama,
    			'tanggal_mulai'		=> $google_event->tanggal_mulai,
    			'tanggal_selesai'	=> $google_event->tanggal_selesai,
    			'google_url'		=> $google_event->google_url,
    			'deleted'			=> '0'
    			);

        	if ($event) {
        		$this->event_model->update($event->id, $data);
        	} else {
        		$data['id'] = $google_event->id;
        		$this->event_model->insert($data);
        	}
        }
        $this->event_model->delete_by(array('deleted' => '1'));
	}

}

/* End of file event */
/* Location: ./application/controllers/event */	
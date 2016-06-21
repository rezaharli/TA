<?php
class Mahasiswa_model extends MY_Model {

	public function get_mahasiswa_dan_user_by_nim($nim){
		$mahasiswa = $this->get_by(array('nim' => $nim));
		
		if($mahasiswa) {
			$this->load->model('user_model');
			$user = $this->user_model->get($mahasiswa->id_user);
			$user->roled_data = $mahasiswa;
			return $user;
		} else {
			return FALSE;
		}
	}

	function like($kolom, $term, $w = 'both'){
		$this->db->like($kolom, $term, $w);
		return $this;
	}
	
}

/* End of file mahasiswa_model.php */
/* Location: ./application/models/mahasiswa_model.php */
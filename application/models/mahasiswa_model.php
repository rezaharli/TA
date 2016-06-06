<?php
class Mahasiswa_model extends MY_Model {

	function like($kolom, $term, $w = 'both'){
		$this->db->like($kolom, $term, $w);
		return $this;
	}
	
}

/* End of file mahasiswa_model.php */
/* Location: ./application/models/mahasiswa_model.php */
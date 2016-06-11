<?php
class Acara_himpunan_model extends MY_Model {

	function like($kolom, $term, $w = 'both'){
		$this->db->like($kolom, $term, $w);
		return $this;
	}
	
}

/* End of file acara_himpunan_model.php */
/* Location: ./application/models/acara_himpunan_model.php */
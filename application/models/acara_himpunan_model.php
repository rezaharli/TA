<?php
class Acara_himpunan_model extends MY_Model {

	function like($kolom, $term, $w = 'both'){
		$this->db->like($kolom, $term, $w);
		return $this;
	}

	function get_acara_with_pengaju($id_acara){
		$sql = "SELECT * FROM acara_himpunan a JOIN pengajuan_proposal_himpunan b ON a.id_pengajuan_proposal = b.id JOIN himpunan c ON b.pengaju_proposal = c.id WHERE a.id = ?";
		$query = $this->db->query($sql, $id_acara);
		if ($query->num_rows() > 0) {
			$result = $query->row();
			$query->free_result();
			return $result;
		}else{
			return null;
		}
	}

}

/* End of file acara_himpunan_model.php */
/* Location: ./application/models/acara_himpunan_model.php */
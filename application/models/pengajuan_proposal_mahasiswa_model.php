<?php
class Pengajuan_proposal_mahasiswa_model extends MY_Model {
	public function get_jumlah_proposal(){

	    $sql = "SELECT *, COUNT(nim_anggota) as jumlah FROM event JOIN pengajuan_proposal_mahasiswa ON `event`.id = `pengajuan_proposal_mahasiswa`.`id_event` JOIN proposal_lomba ON `pengajuan_proposal_mahasiswa`.id = `proposal_lomba`.`id_pengajuan_proposal_mahasiswa` JOIN detail_tim ON `proposal_lomba`.`id` = `detail_tim`.`id_proposal_lomba` GROUP BY `event`.id";

	    $query = $this->db->query($sql);

	    if ($query->num_rows() > 0) {
	      $result = $query->result();
	      $query->free_result();
	      return $result;
	    }else{
	      return array();
	    }
    }

    public function get_detail_tim(){

	    $sql = "SELECT id_event, `pengajuan_proposal_mahasiswa`.id, nim_anggota FROM pengajuan_proposal_mahasiswa
				JOIN proposal_lomba ON `pengajuan_proposal_mahasiswa`.id = `proposal_lomba`.`id_pengajuan_proposal_mahasiswa` 
				JOIN detail_tim ON `proposal_lomba`.`id` = `detail_tim`.`id_proposal_lomba`";

	    $query = $this->db->query($sql);

	    if ($query->num_rows() > 0) {
	      $result = $query->result();
	      $query->free_result();
	      return $result;
	    }else{
	      return array();
	    }
    }
}
<?php
class Panitia_model extends MY_Model {

  public function get_panitia_with_user($id_acara){

    $sql = "SELECT * FROM panitia a JOIN mahasiswa b ON a.nim = b.nim  JOIN user c ON b.id_user = c.id WHERE id_acara = ?";

    $query = $this->db->query($sql, $id_acara);

    if ($query->num_rows() > 0) {
      $result = $query->result();
      $query->free_result();
      return $result;
    }else{
      return array();
    }
    }

}

/* End of file panitia_model.php */
/* Location: ./application/models/panitia_model.php */
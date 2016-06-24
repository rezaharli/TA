<?php
class Proposal_himpunan_model extends MY_Model {
	public function order_by($field, $order = 'asc') {
        $this->db->order_by($field, $order);
        return $this;
    }
}

/* End of file Proposal_himpunan_model.php */
/* Location: ./application/models/proposal_himpunan_model.php */
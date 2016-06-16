<?php
class Event_model extends MY_Model {

	public $soft_delete = FALSE;

	function like($kolom, $term, $w = 'both'){
		$this->db->like($kolom, $term, $w);
		return $this;
	}
	
	public function order_by($field, $order = 'asc') {
        $this->db->order_by($field, $order);
        return $this;
    }

    public function order_by_tanggal_mulai(){
    	return $this->order_by('tanggal_mulai');
    }
}

/* End of file event_model.php */
/* Location: ./application/models/event_model.php */
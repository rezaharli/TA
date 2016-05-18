<?php
class Event_model extends MY_Model {
	
	public function order_by($field, $order = 'asc') {
        $this->db->order_by($field, $order);
        return $this;
    }
}

/* End of file event_model.php */
/* Location: ./application/models/event_model.php */
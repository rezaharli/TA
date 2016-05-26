<?php
class Staff_model extends MY_Model {

	public function get_staff_dan_user_by_nip($nip){
		$staff = $this->get_by(array('nip' => $nip));
		
		$this->load->model('user_model');
		$user = $this->user_model->get($staff->id_user);
		$user->roled_data = $staff;
		return $user;
	}
}

/* End of file staff_model.php */
/* Location: ./application/models/staff_model.php */
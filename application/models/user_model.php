<?php
class User_model extends MY_Model {

	public function get_logged_in_id(){
		$user = $this->ion_auth->user()->row();
		return $user->id;
	}

    public function get_user_dan_role_by($syarat){
        $user = $this->get_by($syarat);
        
        if($user) {
	        $user->roled_data = $this->get_roled_data_by_id_user($user->role, $user->id);
	        return $user;
	    }
    }

    public function get_user_dan_role_by_id($id){
        $user = $this->get($id);
        
        if($user) {
	        $user->roled_data = $this->get_roled_data_by_id_user($user->role, $user->id);
	        return $user;
	    }
    }

    public function get_roled_data_by_id_user($role, $id){
		$model = $role.'_model';

	    $this->load->model($model);
	    return $this->$model->get_by(array('id_user' => $id));
    }

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */
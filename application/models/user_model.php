<?php
class User_model extends MY_Model {

    public function get_user_dan_role_by($syarat){
        $user = $this->get_by($syarat);
        
        if($user) {
	        $model = $user->role.'_model';
	        $this->load->model($model);
	        $user->roled_data = $this->$model->get_by(array('id_user' => $user->id));
	        return $user;
	    }
    }

    public function get_user_dan_role_by_id($id){
        $user = $this->get($id);
        
        if($user) {
	        $model = $user->role.'_model';
	        $this->load->model($model);
	        $user->roled_data = $this->$model->get_by(array('id_user' => $user->id));
	        return $user;
	    }
    }

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */
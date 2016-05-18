<?php
class User_model extends MY_Model {

    public function get_user_dan_role_by_id($id){
        $this->load->model('user_model');
        $user = $this->user_model->get_by(array('id' => $id));
        
        $model = $user->role.'_model';
        $this->load->model($model);
        $user->roled_data = $this->$model->get_by(array('id_user' => $user->id));
        return $user;
    }

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */
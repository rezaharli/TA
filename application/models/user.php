<?php
class User extends CI_Model {

    var $table = 'user';
    var $row;

    function set_session() {
        $this->session->set_userdata(array(
            'username'      => $this->row->username,
            'is_logged_in'  => TRUE
            ));
    }
    
    function validate_user($username, $password) {
        $this->db->from($this->table);
        $this->db->where('username', $username );
        $this->db->where('password', sha1($password));
        $result = $this->db->get()->result(); 
        if (is_array($result) && count($result) == 1) {
            $this->row = $result[0];
            $this->set_session();
            return TRUE;
        }
        return FALSE;
    }

}
/* End of file user.php */
/* Location: ./application/models/user.php */
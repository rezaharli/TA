<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Datatables {

	public function make_table($tables, $primary_key, $column_list, $where = '') {

		$columns = array();
		for ($i = 0; $i < count($column_list); $i++) { 
			array_push($columns, array('db' => $column_list[$i], 'dt' => $i));
		}

		$primary_keys = explode('.', $primary_key);
		if (count($primary_keys) > 1) {
			$primary_key = '';
			foreach ($primary_keys as $pk) {
				if ($pk !== reset($primary_keys)) $primary_key .= '`';
				$primary_key .= $pk;
				if ($pk !== end($primary_keys)) $primary_key .= '`.';
			}
		} else {
			$primary_key = $primary_keys[0];
		}

		if (count($tables) > 1) {
			$table = '';
			foreach ($tables as $t) {
				if ($t !== reset($tables)) $table .= '`';
				$table .= $t;
				if ($t !== end($tables)) $table .= '`, ';
			}
		} else {
			$table = $tables[0];
		}

		$CI =& get_instance();
        $CI->load->database();
		$sql_details = array(
		    'user' => $CI->db->username,
		    'pass' => $CI->db->password,
		    'db'   => $CI->db->database,
		    'host' => $CI->db->hostname
		);
		 
		require(APPPATH.'third_party/DataTables/ssp.class.php');
		return SSP::complex($_GET, $sql_details, $table, $primary_key, $columns, $where, $where);
    }

}
<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_data_utility extends CI_Model {

	function check_password_db($userid) {
		$query = $this->db->query("select * from zsys_users where user_id='".$userid."' limit 1");
	    return $query->result(); 
	}

	
}
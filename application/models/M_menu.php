<?php if (! defined('BASEPATH') ) exit('No direct script access allowed');

Class M_menu extends CI_model {
	public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');

        $this->load->model('m_menu');

        $logged_in = $this->session->userdata('user_login');
        if(!$logged_in){
            header("location: ".base_url());
        }
    }

	public function show_menu_utility($userid){
	    	$sqltext = 
	    	" select a.* ,c.groups,c.expire,c.kdunit              ".
			" from zsys_listmenu a, zsys_otoritas b,zsys_users c  ".
			" where a.noitem = b.noitem                           ".
			" and b.groups   = c.groups                           ".
			" and c.user_id  = '".$userid."'                      ";
			//" and  menu like '%tilit%' ".
			//" and LENGTH(a.noitem) > 3";
			
			$query = $this->db->query($sqltext);
			//$jml   = $query->num_rows();
	        return $query;
	    } 
	}

} 
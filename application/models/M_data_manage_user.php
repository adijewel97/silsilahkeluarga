<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_data_manage_user extends CI_Model {

// ------------------------------------------------------------------------------------------------
// 1) User manage
	function data_user($vuser) {
		$sqltext =  " select * from zsys_users                       		       ".
		            " where user_id = '".$vuser."'  limit 1                        ";

		$hasil    = $this->db->query( $sqltext );
        return $hasil;
	}

	function check_password_db($userid) {
		$query = $this->db->query("select * from zsys_users where user_id='".$userid."' limit 1");
	    return $query; 
	}

	function check_useridkode_db($useridkode) {
		$query = $this->db->query("select * from zsys_users where useridkode='".$useridkode."' limit 1");
	    return $query->result(); 
	}

	function data_group_user() {
		$sqltext =  " select DISTINCT groups from zsys_otoritas      		       ".
		            " order by groups asc                                          ";

		$datainfo    = $this->db->query( $sqltext );
        return $datainfo;
	}

	function insert_user_log($userid){
		$sqltext =  " insert into zsys_users_log (
						select
						SYSDATE() as tgl_log,
						user_id,  
						appmobile,
						kodeuser,
						password,
						groups,
						statuslogin, 
						tgllogin,
						expire,
						tglexpire,
						komputer,
						host,
						kdunit,
						nama,
						kdjabatan,
						jabatan,
						statusblock,
						tglblock,
						useridkode,
						foto_path,
						tglcreate,
						tglapprove,
						serial
						from zsys_users
						where user_id = '".$userid."')";

		$qexec    = $this->db->query( $sqltext );
		return true;
	}

	function update_password_db($userid,$data) {
		$this->db->where('user_id', $userid);
		$this->db->update('zsys_users' ,$data);
		$this->insert_user_log($userid);
		return true;
	}

	function insert_password_db($data) {
		$this->db->insert('zsys_users' ,$data);
		return true;
	}

	function get_info_user(){
	    $data = array();
		$myid	 = $notrans."/".$tgltrans."/".$kdunit;
		$sqltext = 	" SELECT a.*                                                          ".
			        " FROM zsys_users a                                                   ".
			        " ORDER BY a.kdunit, a.nama                                           ";
			
		$query    = $this->db->query( $sqltext );
	    
	    $data['hasil'] = $query->result_array();
		return $data['hasil'];
	}

// ------------------------------------------------------------------------------------------------
// 2) User Group manage
	function data_master_listmenu($vgroup) {
		$sqltext = 	" SELECT a.*                                                          ".
			        " FROM zsys_listmenu a                                                ".
			        " where a.noitem not in												  ".
  					"    (select noitem from zsys_otoritas where groups = '".$vgroup."')  ";
			
		$query    = $this->db->query( $sqltext );
	    return $query;
	}

	function data_master_listmenu_groups($vgroup) {
		$sqltext = 	" SELECT a.*,                                                               ".
		            "  (select item from zsys_listmenu where noitem = a.noitem limit 1) as item ".
			        " FROM zsys_otoritas a                                                      ".
			        " where  groups = '".$vgroup."'										        ";

	    $query    = $this->db->query( $sqltext );
	    return $query;
	}

	function chek_data_groups($noitem,$vgroup) {
		$sqltext = 	" SELECT a.*                                                                ".
		            " FROM zsys_otoritas a                                                      ".
			        " where  a.noitem = '".$noitem."'	and   a.groups = '".$vgroup."'          ";

	    $query    = $this->db->query( $sqltext );
	    return $query;
	}

	function insert_data_groups($vnoitem,$vgroup)  {
		$query = $this->M_data_manage_user->chek_data_groups($vnoitem,$vgroup);
		if ( $query->num_rows() == 0 ) {
			$data = array (
				'noitem' => $vnoitem,
				'groups' => strtoupper($vgroup)	 
			);
			$this->db->insert('zsys_otoritas' ,$data);
		}
		return true;
	}
    
	function delete_data_groups($vnoitem,$vgroup) {
        $query = $this->M_data_manage_user->chek_data_groups($vnoitem,$vgroup);
		if ( $query->num_rows() == 1 ) {
			$data = array (
				'noitem' => $vnoitem,
				'groups' => $vgroup	 
			);
			$this->db->delete('zsys_otoritas' ,$data);
		}
		return true;
	}

}
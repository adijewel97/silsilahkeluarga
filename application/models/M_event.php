<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_event extends CI_Model {
// --------------------------------------------------------------------------------------------------
// 1) Event Master
// --------------------------------------------------------------------------------------------------

	function get_data_event() {
		$query = $this->db->query(
			      	" select a.*, ".
					"	 (select pathfoto from trs_event_detail_foto".
					"	 where idevent = a.idevent ".
					"	 and tglevent = a.tglevent limit 1) pathfoto".
					" from trs_event a". 
					/*" where idevent = '".$idevent."'".
					" and tglevent =  '".$tglevent."'".*/
	                " order by tglevent desc "
			      );
	    return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function get_data_event_byid($idevent,$tglevent) {
		$query = $this->db->query(
	        	" select a.*, ".
			"	 (select pathfoto from trs_event_detail_foto".
			"	 where idevent = a.idevent ".
			"	 and tglevent = a.tglevent limit 1) pathfoto".
			" from trs_event a". 
			" where idevent = '".$idevent."'".
			" and tglevent =  '".$tglevent."'".
	        " order by tglevent desc ");
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function get_event_last_data(){
		$query = $this->db->query(
	        		" select tglevent, idevent".
					" from trs_event".
					" where tglevent in (".
					" select max(a.tglevent) from trs_event a".
					" ) limit 1 "
	       		 );
        return $query;
	}
	// 1--------------------------------------------------------------------------------------------------
	function get_event_form_data($idevent,$tglevent){
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $query = $this->db->get('trs_event');
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function update_event_form_data($idevent,$tglevent,$data){
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $query = $this->db->update('trs_event',$data);
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function delete_event_form_data($idevent,$tglevent){
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $query = $this->db->delete('trs_event');
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function insert_event_form_data($data){
		$query = $this->db->insert('trs_event',$data);
        return $query;
	}

// --------------------------------------------------------------------------------------------------
// 2) Event foto
// --------------------------------------------------------------------------------------------------
	function get_data_event_byid_foto($idevent,$tglevent) {
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $query = $this->db->get('trs_event_detail_foto');
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function get_event_fotoall_data($idevent,$tglevent){
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $query = $this->db->get('trs_event_detail_foto');
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function get_event_foto_data($idevent,$tglevent,$urutfoto){
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $this->db->where('urutfoto',$urutfoto);
        $query = $this->db->get('trs_event_detail_foto');
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function update_event_form_data_foto($idevent,$tglevent,$urutfoto,$data){
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $this->db->where('urutfoto',$urutfoto);
        $query = $this->db->update('trs_event_detail_foto',$data);
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function delete_event_form_data_foto($idevent,$tglevent,$urutfoto){
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $this->db->where('urutfoto',$urutfoto);
        $query = $this->db->delete('trs_event_detail_foto');
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function delete_event_all_data_foto($idevent,$tglevent){
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $query = $this->db->delete('trs_event_detail_foto');
        return $query;
	}


	// --------------------------------------------------------------------------------------------------
	function insert_event_form_data_foto($data){
		$query = $this->db->insert('trs_event_detail_foto',$data);
        return $query;
	}

// --------------------------------------------------------------------------------------------------
// 3) Chat table
// --------------------------------------------------------------------------------------------------
	// --------------------------------------------------------------------------------------------------
	function get_event_chat_data_id($idevent,$tglevent){
        $query = $this->db->query(
			      	" select a.*,
				      (select foto_path from zsys_users 
				       where user_id = a.userchat limit 1) as foto_path 
				      from trs_event_detail_chat a 
				      where idevent = '".$idevent."'
				      and tglevent= '".$tglevent."'"
			      );
	    return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function get_event_chat_data_id_user($idevent,$tglevent,$userchat){
        $query = $this->db->query(
			      	" select a.*,
				      (select foto_path from zsys_users 
				       where user_id = a.userchat limit 1) as foto_path 
				      from trs_event_detail_chat a 
				      where a.idevent = '".$idevent."'
				      and a.tglevent= '".$tglevent."'
				      and a.userchat= '".$userchat."'"
			      );
	    return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function delete_event_all_data_chat($idevent,$tglevent){
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $query = $this->db->delete('trs_event_detail_chat');
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function insert_event_data_chat($data){
		$query = $this->db->insert('trs_event_detail_chat',$data);
        return $query;
	}
	// --------------------------------------------------------------------------------------------------
	function delete_event_data_chat($idevent, $tglevent, $user, $tgljam){
		$this->db->where('idevent',$idevent);
        $this->db->where('tglevent',$tglevent);
        $this->db->where('userchat',$user);
        $this->db->where('tgljamchat',$tgljam);
        $query = $this->db->delete('trs_event_detail_chat');
        return $query;
	}

// --------------------------------------------------------------------------------------------------
// 4) Sequent
// --------------------------------------------------------------------------------------------------
    public function getseqidevent(){
          //update next seq + 1
          //$key_kdunit	= "110101";
          $qry_seq    = $this->db->query("select FU_SeqNext('110101-noevent') limit 1");
          //tampilkan max seq 
          $noseq1     = $this->db->query("select seq_next from zsys_sequent where seq_name = '110101-noevent' limit 1");
          $hasil      = $noseq1->row();
          return $hasil;
    }
    // --------------------------------------------------------------------------------------------------
}
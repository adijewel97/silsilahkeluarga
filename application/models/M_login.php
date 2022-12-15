<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_model {
    public function getlogin($u,$p)
    {
    	$psw = md5($p);
    	$this->db->where('user_id',$u);
    	$this->db->where('password',$psw);
    	$query = $this->db->get('zsys_users');
    	if ($query->num_rows()>0) {
		    $query2      = $this->m_menu_mobile->getdata_menu($u,'1|0');  
        	if ($query2->num_rows()>0) {	
		    	foreach ($query->result() as $row) {
		    		if ( ($row->tglapprove == '') || ($row->tglapprove = '0000-00-00') ) {
		    		    $this->session->set_flashdata('info','Chek Email di Alamat Saat Daftar, Dan Masukan Registrasi kode Dari Administrtor.');
	    	   			redirect('login'); 	
		    		} else {
		    			$sess  = array('user_id'        => $row->user_id,
		    					   'user_password'  => $row->password,
		                           'user_kdunit'    => $row->kdunit,
		                           'user_group'     => $row->groups,
		                           'user_name'  	=> $row->nama,
		                           //'user_path'      => $row->foto_path,
		                           'user_login'     => ture
		    		              );
			    		$this->session->set_userdata($sess);
			    		redirect('home');
		    		}
		    		
		    	}
		    } else {
			   $this->session->set_flashdata('info','User Tidak memiliki Role (Hub. admin) !');
	    	   redirect('login');    	
		    }
	    } else {
	    	   $this->session->set_flashdata('info','User atau Password Anda Salah !');
	    	   redirect('login');
	    }
    }

    public function getlogin_web($u,$p,$serial){
    	$psw = md5($p);
    	$this->db->where('user_id',$u);
    	$this->db->where('password',$psw);
    	$query = $this->db->get('zsys_users');
    	if ($query->num_rows()>0) {
	    	foreach ($query->result() as $row) ;
    		//ambil nama unit user
	    	$query = $this->db->query(" select namaunit,alamatunit from mst_cabang where kdunit = '".$row->kdunit."' ");
	    	if ($query->num_rows()>0) {
	    		foreach ($query->result() as $row_nm);
	    		$namaunit 	= $row_nm->namaunit;
	    		$alamatunit	= $row_nm->alamatunit;
	    	} else {
	    		$namaunit 	= " ";
	    		$alamatunit	= " ";
	    	}
    		
    		$sess  = array('user_id'        => $row->user_id,
    					   'user_password'  => $row->password,
                           'user_kdunit'    => $row->kdunit,
                           'user_group'     => $row->groups,
                           'user_name'  	=> $row->nama,
                           'user_expire'    => $row->expire,
                           'user_login'     => '1',
                           'user_namaunit'  => $namaunit,
                           'alamatunit'		=> $alamatunit,
                           'user_path'      => $row->foto_path
    		              );
    		if ($row->expire == 0) {
	    		if ($this->M_login->chek_menu($u) > 0 ) {
		    		if ( ($row->tglapprove == '') || ($row->tglapprove == '0000-00-00') ) {
		    		    if ( $serial != '' && $row->serial != $serial) {
		    		    	$this->session->set_flashdata('info','02 - Registrasi kode Tidak Cocok, Chek  di Alamat Email Saat Daftar.x'.$serial.'x' );
			   			    redirect('login');
		    		    } else if ( $row->serial == $serial ) {
		    		     	//update tgluprovel
		    		     	$sqltext = 
					    	" update zsys_users                   ".
					    	" set tglapprove = '".date("Y-m-d")."',".
					    	"     tgllogin   = '".date("Y-m-d H:i:s")."',".
					    	"     statuslogin= '1'".
							" where user_id  = '".$u."'      ";
							$query = $this->db->query($sqltext);

		    		     	$this->session->set_userdata($sess);
			    			redirect('home/menu');
		    		    }else {
		    		    	$this->session->set_flashdata('info','01 - Chek  di Alamat Email Saat Daftar, Dan Masukan Registrasi kode Dari Administrtor. User Anda ( '.$row->user_id.' )');
			   			    redirect('login');
		    		    }
		    		     	
		    		} else {
			    		$this->session->set_userdata($sess);
			    		$sqltext = 
					    	" update zsys_users                   ".
					    	" set tgllogin   = '".date("Y-m-d H:i:s")."',".
					    	"     statuslogin= '1'".
							" where user_id  = '".$u."'      ";
							$query = $this->db->query($sqltext);
			    		redirect('home/menu');
			    	}
		    		// $this->session->set_flashdata('info',' ini password in : '.$psw); redirect('login');
		    	} else {
		    	   $this->session->set_flashdata('info','03 - Chek Group pada Ref. User Salah, (Hub. Admin) !');
	    	       redirect('login');	
		    	}
		    }  else     {
		    	$this->session->set_flashdata('info','04 - User Tidak Atif/Expire, (Hub. Admin) !');
	    	    redirect('login');
		    }    	
	    } else {
	    	   $this->session->set_flashdata('info','05 - User atau Password Anda Salah !');
	    	   redirect('login');
	    }
    }

    public function chek_menu($userid){
    	$sqltext = 
    	" select a.* ,c.groups,c.expire,c.kdunit              ".
		" from zsys_listmenu a, zsys_otoritas b,zsys_users c  ".
		" where a.noitem = b.noitem                           ".
		" and b.groups   = c.groups                           ".
		" and c.user_id  = '".$userid."'                      ".
		" and  menu like '%tilit%' ".
		" and LENGTH(a.noitem) > 3";
		
		$query = $this->db->query($sqltext);
		$jml   = $query->num_rows();
        return $jml;
    } 
}
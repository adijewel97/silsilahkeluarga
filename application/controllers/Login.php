<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
        //$this->load->library('upload');
        $this->load->helper(array('form', 'url','file'));

        $this->load->model('M_data_manage_user');
    } 

	public function index()
	{
		//$this->load->view('desain/header');
		$this->load->view('access/v_login');
		//$this->load->view('desain/footer');
	}

	 public function getlogin_web(){
        $u 		= $this->input->post('username');
        $p 		= $this->input->post('password');
        $s		= $this->input->post('serial');
        $this->load->model('M_login');
        $this->M_login->getlogin_web($u,$p,$s);
    }

    public function logout() {      
        $sqltext = 
	    	$sqltext = 
		    	" update zsys_users                   ".
		    	" set statuslogin= '0'".
				" where user_id  = '".$this->session->userdata('user_id')."'      ";
			$query = $this->db->query($sqltext);
        $this->session->sess_destroy();
        redirect('Login');
    }

    public function send_email_registrasi(){
    	//get parameter variable
    	$n_proses  		= $this->input->post('n_proses');
    	$serial 		= $this->input->post('vserial');
    	$email 			= $this->input->post('email');
    	$username 		= $this->input->post('username');
    	$password 		= $this->input->post('password');

	    $status_email = '1';
    	
    	if ( $status_email == '1' ) {
	    	//email send
	    	$ci = get_instance();
			$ci->load->library('email');
			
			
			$config['protocol'] 	= "smtp";
			$config['SMTPSecure']   = "tls";
			$config['SMTPAuth']     = true;
			$config['smtp_host'] 	= "smtp.gmail.com";
			$config['smtp_port'] 	= "587";
			$config['smtp_timeout'] = '7';
            $config['smtp_user'] 	= "adijewel97@gmail.com";
			$config['smtp_pass'] 	= "adis2007";
			$config['charset'] 		= "utf-8";
			$config['mailtype'] 	= "html";
			$config['newline'] 		= "\r\n";		
			
			
			/*
			$config['protocol'] 	= "smtp";
			$config['smtp_host'] 	= "srv23.niagahoster.com";
			$config['smtp_port'] 	= "465";
			$config['smtp_timeout'] = '7';
            $config['smtp_user'] 	= "adisadmin@keluarga-kumpul.codeitworld.com";
			$config['smtp_pass'] 	= "rahasia321";
			$config['charset'] 		= "utf-8";
			$config['mailtype'] 	= "html";
			$config['newline'] 		= "\r\n";		
			*/
			
			$ci->email->initialize($config); 
			$ci->email->from('adijewel97@gmail.com', 'Administrator');
			//$list = $kirimemail->email;
			$ci->email->to($email);
			$ci->email->subject("Registrasi User Aplikasi Silsilah/Keturunan Keluarga.");
			$ci->email->message(
				   "Berikut Registrasi Kode untuk masuk ke Aplikasi Silsilah/Keturunan Keluarga 
				    </br> </br>
				    
				    <table border='0'>
				    	<tbody>
				    	<tr>
				    	   <td width='200'> User id  			</td><td width='20'>:</td><td width='200'> ".$username."</td>
				    	</tr>
				    	<tr>
				    	   <td width='200'> Password  			</td><td width='20'>:</td><td width='200'> ".$password."</td>
				    	</tr>
				    	<tr>
				    	   <td width='200'> Registrasi kode  	</td><td width='20'>:</td><td width='200'> ".$serial."</td>
				    	</tr>
				    	</tbody>
				    </table>			    			   
	                </br>
	                Terimakasih Anda sudah mendaftarkan diri anda dan silahkan login di alamat ".base_url()
				     );
			if ($this->email->send()) {
				//redirect("front","location");
				//insert ke database user dan chek email yg difatrkan
				$inset_db_user = $this->create_new_user_reg($n_proses);
			} else {
				//show_error($this->email->print_debugger());
				$response['status'] = "1";
			    $response['pesan']  = "Error: ".$this->email->print_debugger();
			    echo json_encode($response);
			}
			
		} else {
			$this->create_new_user_reg($n_proses);
		}	   
    }

    public function create_new_user_reg($n_proses){
    	$n_proses  			= $this->input->post('n_proses');
    	$serial 			= $this->input->post('vserial');
    	$email 				= $this->input->post('email');
    	$username 			= $this->input->post('username');
    	$nama 				= $this->input->post('nama');
    	$password 			= $this->input->post('password'); 
    	$password_confrim 	= $this->input->post('password_confrim');

        $userid         = $username;
        $groups_user    = 'KELUARGA';
        $kdunit_user    = '110101';
        $password_l     = md5($password);
        $password_b     = md5($password);
        $password_bc    = md5($password_confrim);
        $useridkode     = $this->input->post('useridkode');

        $query  = $this->M_data_manage_user->check_password_db($userid);
        //print_r($query->num_rows() );
        //die();
        if ($query->num_rows() > 0) {
        	foreach ($query->result() as $data_user);
	        $user_id_db        = $data_user->user_id;
	        $email_db          = $data_user->email;
	        $password_db       = $data_user->password;
	        $groups_db         = $data_user->groups;
	        $kdunit_db         = $data_user->kdunit;
	        $nama_db           = $data_user->nama;
        } else {
        	$user_id_db        = '';
	        $password_db       = '';
	        $groups_db         = '';
	        $kdunit_db         = '';
	        $nama_db           = '';
	        $email_db          = '';
        }       

        $userid_in = $username;

	    if ($n_proses == 1 ) {
	        if ($user_id_db != '' ){
	                $response['status'] = "1";
	                $response['pesan']  = "Error: User Tersebut Tudah Terdaftar Atas Nama : ".$nama_db;
	                echo json_encode($response);
	        } else {
	            if ( empty($userid_in) ) {
	                $response['status'] = "1";
	                $response['pesan']  = "Error: User Id Masih Kosong ! ";
	                echo json_encode($response);
	            } else {
	                $myuserid_user = $username;
	                $mykdunit_user = "110101"; //$this->input->post('kdunit_user');
	                $mygroups_user = 'KELUARGA';
	                $mynama_user   = $nama;
	                $validasi = 0;

	                $data       = array (
	                    'user_id'       => $myuserid_user,
	                    'password'      => $password_b,
	                    'kdunit'        => $mykdunit_user,
	                    'groups'        => $mygroups_user,
	                    'expire'        => $validasi,
	                    'nama'          => $mynama_user,
	                    'useridkode'    =>  "1",
	                    'serial'		=> $serial,
	                    'tglcreate'     => date('Y-m-d'),
	                    'email'			=> $email  
	                );               

	                if ( $mykdunit_user == '') {
	                    $response['status'] = "1";
	                    $response['pesan']  = "Error: Master Kantor Cabang User Bekerja, Masih Kosong.";
	                    echo json_encode($response);
	                }  else  if ( $mynama_user == '' ){
	                    $response['status'] = "1";
	                    $response['pesan']  = "Error: Nama Lengkap Pemohon User, Masih Kosong.";
	                    echo json_encode($response);
	                } else if ($password_b  == 'd41d8cd98f00b204e9800998ecf8427e' || $password_bc == 'd41d8cd98f00b204e9800998ecf8427e') {
	                    $response['status'] = "1";
	                    $response['pesan']  = "Error: Password Baru dan Password Baru (ulang), Masih kosong !";
	                    echo json_encode($response);
	                } else {                    
	                    $hasil  = $this->M_data_manage_user->insert_password_db($data);
	                    if ($hasil) {
	                        $response['status'] = "2";
	                        $response['pesan']  = "Sukses: Kirim Email, Chek di Alamat Email Yang ada Daftarkan dan ID Baru anda atas nama : ".$mynama_user;
	                        echo json_encode($response);
	                    } else {
	                        $response['status'] = "1";
	                        $response['pesan']  = "Error: Buat User ID Baru atas nama : ".$mynama_user;
	                        echo json_encode($response);
	                    }
	                } 
	            }
	        }
	    } else {
	    	if ( ($username == $user_id_db ) && ( $email == $email_db) && ($email != '') && ($username != '')) {
                $data       = array (
	                    'password'      => $password_b,
	                    'serial'		=> $serial,
	                    'tglapprove'    => null
	                );
                $hasil  = $this->M_data_manage_user->update_password_db($username, $data);
                if ($hasil) {
                    $response['status'] = "2";
	                $response['pesan']  = "Sukses: Reset Passsword, Chek Email Untuk Bisa Login User : ".$username;
	                echo json_encode($response);
                } else {
                    $response['status'] = "1";
                    $response['pesan']  = "Error:Reset Passsword   Login User : ".$username;
                    echo json_encode($response);
                }
	        } else {
        		$response['status'] = "1";
                $response['pesan']  = "Error: Tidak ditemukan user atau email ".$email;
                echo json_encode($response);
	        }

	    }
    } 
}

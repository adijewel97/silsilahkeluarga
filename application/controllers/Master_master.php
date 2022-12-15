<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
class Master_master extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        //$this->load->library('upload');
        $this->load->helper(array('form', 'url','file'));

        $this->load->model('M_data_master');

        $logged_in = $this->session->userdata('user_login');
        if(!$logged_in){
            header("location: ".base_url());
        }
    }   

/*--------------------------------------------------------------------------------------------------------------------*/
// (1)Panggil Form view Master Perusahaan
	public function master_perusahaan(){
		$this->load->view('desain/v_header');

		$this->load->view('master/v_master_perusahaan');

		$this->load->view('desain/v_footer');
	}

	public function data_master_perusahaan() {
		//if ($_SERVER['REQUEST_METHOD']==='POST') {
			$query = $this->M_data_master->data_master_perusahaan();
			foreach ($query->result() as $data);
			$logo=$data->logo;
			if (empty ($logo)) {
				$logo="";
			}
			else {
				$logo="<img class='img-responsive' src='".$data->logo."' width='150px' height='150px'>";
			}
			$response['kdktrpusat']		=$data->kdktrpusat;
			$response['namaktrpusat']	=$data->namaktrpusat;
			$response['alamatktrpusat']	=$data->alamatktrpusat;
			$response['managerktrpusat']=$data->managerktrpusat;
			$response['tlppusat']		=$data->tlppusat;
			$response['faxktrpusat']	=$data->faxktrpusat;
			$response['email']			=$data->email;
			$response['kota']			=$data->kota;
			$response['http']			=$data->http;
			$response['logo']			=$logo;
			$response['logodb']			=$data->logo;
			echo json_encode($response);
		//}
	}

	public function simpan_data_master_perusahaan() {
		if ($_SERVER['REQUEST_METHOD']==='POST') {			
			$nama 			=$_FILES['n_logo']['name'];
			$tipe 			=$_FILES['n_logo']['type'];
			$tmp 			=$_FILES['n_logo']['tmp_name'];
			
			$n_email		=$this->input->post('n_email');
			$n_http			=$this->input->post('n_http');
			$polaemail 		= "/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i";
			$polaurl 		= "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
			if ((!empty($n_email)) and (!preg_match ($polaemail, $n_email))) {
				$gagal="Format email salah";
			}
			elseif ((!empty($n_http)) and (!preg_match ($polaurl, $n_http))) {
				$gagal="Format alamat web salah contoh: www.namawebsite.com / http://www.namawebsite.com";
			}
			elseif ((!empty ($nama)) and (($tipe!='image/jpeg') and ($tipe!='image/jpg') and ($tipe!='image/png') and ($tipe!='image/gif'))) {
				$gagal="Logo harus berformat JPEG / JPG / PNG / GIF";
			}
			$hitung=count($gagal);
			if ($hitung>0) {
				$response['status']="1";
				$response['pesan']=$gagal;
				echo json_encode($response);
			}
			else {
				if (! empty ($nama)) {
			        $tmp = file_get_contents($tmp);
			        $base64 		= 'data:image/' . $tipe . ';base64,' . base64_encode($tmp);
			        $logo	= $base64;
		    	} else {
		    		$logo	= $this->input->post('n_logodb');
		    	}

		    	$data=array (
		            'kdktrpusat'		=>$this->input->post('kdktrpusat'),
		            'namaktrpusat'		=>$this->input->post('n_nama'),
		            'alamatktrpusat'	=>$this->input->post('n_alamat'),
		            'managerktrpusat'	=>$this->input->post('n_manager'),
		            'tlppusat'			=>$this->input->post('n_tlp'),
		            'faxktrpusat'		=>$this->input->post('n_fax'),
		            'kota'				=>$this->input->post('n_kota'),

		            'email'				=>$n_email,
		            'http'				=>$n_http,
		            'logo'				=>$logo
		        );
		    	//console.log(" informasi data :",$this->input->post('kdktrpusat'));
				$this->M_data_master->simpan_data_master_perusahaan($data);
				$response['status']="2";
				$response['pesan']="Data sukses disimpan";
				echo json_encode($response);
			}
		}
	}

/*--------------------------------------------------------------------------------------------------------------------*/
// (2)Panggil Form view Master Cabang
	public function master_cabang(){
		$this->load->view('desain/v_header');
		$this->load->view('master/v_master_cabang');
		$this->load->view('desain/v_footer');
	}

	public function data_master_cabang() {
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			$query = $this->M_data_master->data_master_cabang_all();
			$query=$query->result();
			if (empty($query)) {
                 $output = array(
                    "data" => [],
                );
                echo json_encode($output);
            }
            else {
                $no=1;
                foreach ($query as $data) {
                	$logo=$data->logo;
					if (empty ($logo)) {
						$logo="";
					}
					else {
						$logo="<img class='img-responsive' src='".$logo."' width='100px' height='100px'>";
					}
					$level=$data->kdlevel;
					
					//Tampilkan data di Grid
                    $row=array();
                    $row[]=$data->kdunit;
                    $row[]=$data->namaunit;
                    $row[]=$data->kdktrpusat;
                    $row[]=$data->alamatunit;
                    $row[]=$data->managerunit;
                    $row[]=$data->kota;
                    $row[]="<a href='javascript:void(0)' class='btn btn-xs btn-primary' title='Edit' onclick='show_master_cabang(2,this)' id='".$data->kdunit."'><i class='fa fa-edit fa-fw'></i> </a> <a href='javascript:void(0)' class='btn btn-xs btn-danger' title='Hapus' onclick='hapus_master_cabang(this)' id='".$data->kdunit."'><i class='fa fa-trash-o fa-fw'></i></a>";
                    $dataarray[] = $row;
                $no++;}
                $output = array(
                    "data" => $dataarray,
                );
                echo json_encode($output);
            }
		}
	}

	public function simpan_data_master_cabang() {
		//if ($_SERVER['REQUEST_METHOD']==='POST') {	
        $vproses = $this->input->post('v_proses');
        $vkdunit = $this->input->post('v_kdunit');

		$nama 	= $_FILES['logoedit']['name'];
		$tipe 	= $_FILES['logoedit']['type'];
		//$tmp 	= $_FILES['logoedit']['tmp_name'];

		$path   = $_FILES['logoedit']['tmp_name'];
		$type 	= pathinfo($path, PATHINFO_EXTENSION);
        $data 	= file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

		if ($vproses == 1 ) {
			$chek_mst_cabangme = $this->M_data_master->data_master_cabang_all();
			$chek_mst_cabang 	= $this->M_data_master->cek_data_master_cabang($vkdunit);
			if ($chek_mst_cabangme->num_rows() > 6){
				$response['status']	= "1";
				$response['pesan']	= "Error : Kode Master Kantor Cabang (Reg..).";
				echo json_encode($response);
			} elseif ( $chek_mst_cabang->num_rows() > 0) {
					$response['status']	= "1";
					$response['pesan']	= "Error : Kode Master Kantor Cabang Sudah Ada.";
					echo json_encode($response);
			} else {
				$data  = array(
	    		        'kdunit'		=>$this->input->post('kdunitedit'),
	    		        'namaunit'		=>$this->input->post('namaunitedit'),
						'kdktrpusat'	=>$this->input->post('kdktrpusatedit'),
						'kdbi'		    =>$this->input->post('kdbiedit'),
						'alamatunit'	=>$this->input->post('alamatunitedit'),
						'managerunit'	=>$this->input->post('managerunitedit'),
						'tlp'			=>$this->input->post('tlpedit'),
						'fax'			=>$this->input->post('faxedit'),
						'email'			=>$this->input->post('emailedit'),
						'kota'			=>$this->input->post('kotaedit'),
						'http'			=>$this->input->post('httpedit'),
						'kdlevel'	    =>$this->input->post('leveledit')
					);
				    if ( $nama <> ''  ) {
						$data['logo'] 	= $base64;
				    }
				    
					if ($this->input->post('kdunitedit') == '') {
						$response['status']	= "1";
						$response['pesan']	= "Error : Kode Kantor Cabang/Unit Belum Terisi.";
						echo json_encode($response);
					} elseif ($this->input->post('kdktrpusatedit') == '') {
						$response['status']	= "1";
						$response['pesan']	= "Error : Kode Kantor Pusat Belum Terisi.";
						echo json_encode($response);
					} elseif ((!empty ($nama)) and (($tipe!='image/jpeg') and ($tipe!='image/jpg')) ) {
						$response['status']	= "1";
						$response['pesan']	= "Error : Logo harus berformat JPG .";
						echo json_encode($response);
					} else {
						$hasil = $this->M_data_master->insert_data_master_cabang($data);
						if ($hasil) {
							$response['status']	= "2";
							$response['pesan']	= "sukses : Tambah Data Master Kantor Cabang.";
							echo json_encode($response);
						} else {
							$response['status']	= "1";
							$response['pesan']	= "Error : Tambah Data Master Kantor Cabang.";
							echo json_encode($response);
						}
					}
			}
		} elseif ($vproses == 2 ) {
			$chek_mst_cabang = $this->M_data_master->cek_data_master_cabang($vkdunit);
			if ( $chek_mst_cabang->num_rows() > 0) {
				$data  = array(
    		        'namaunit'		=>$this->input->post('namaunitedit'),
					'kdktrpusat'	=>$this->input->post('kdktrpusatedit'),
					'kdbi'		    =>$this->input->post('kdbiedit'),
					'alamatunit'	=>$this->input->post('alamatunitedit'),
					'managerunit'	=>$this->input->post('managerunitedit'),
					'tlp'			=>$this->input->post('tlpedit'),
					'fax'			=>$this->input->post('faxedit'),
					'email'			=>$this->input->post('emailedit'),
					'kota'			=>$this->input->post('kotaedit'),
					'http'			=>$this->input->post('httpedit'),
					'kdlevel'	    =>$this->input->post('leveledit'),
					'logo' 			=>$base64 
				);
				if ((!empty ($nama)) and (($tipe!='image/jpeg') and ($tipe!='image/jpg')) ) {
					$response['status']	= "1";
					$response['pesan']	= "Error : Logo harus berformat JPG .";
					echo json_encode($response);
				} else {
					$hasil = $this->M_data_master->update_data_master_cabang($vkdunit,$data);
					if ($hasil) {
						$response['status']	= "2";
						$response['pesan']	= "Sukses : Rubah Data Master Kantor Cabang.";
						echo json_encode($response);
					} else {
						$response['status']	= "1";
						$response['pesan']	= "Error : Rubah Data Master Kantor Cabang.";
						echo json_encode($response);
					}
				}
			} else {
				$response['status']	= "1";
				$response['pesan']	= "Error : Rubah Data Kode Unit Tidak ditemukan.";
				echo json_encode($response);
			}				
		} elseif ($vproses == 0 ) {
			$vproses_h    = $this->input->post('v_prosesh');
		    $vkdunit_h    = $this->input->post('v_kdunith');
			$chek_mst_cabang = $this->M_data_master->cek_data_master_cabang($vkdunit_h);
			if ( $chek_mst_cabang->num_rows() > 0) {
				$hasil_m_cabang	= $this->M_data_master->hapus_data_master_cabang($vkdunit_h);
				if ($hasil_m_cabang) { 
					$response['status']	= "2";
					$response['pesan']	= "Sukses : Hapus Data Master Kantor Cabang.";
					echo json_encode($response);
				} else {
					$response['status']	= "1";
					$response['pesan']	= "Error : Hapus Data Master Kantor Cabang.";
					echo json_encode($response);
				}
			} else {
				$response['status']	= "1";
				$response['pesan']	= "Error : Tidak Ditemukan Kode Master Kantor Cabang....";
				echo json_encode($response);
			}
		}		
	}

	public function show_data_master_cabang() {
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			$myode 	=$this->input->post('kode_mstcabang');
			$query 	=$this->M_data_master->show_data_master_cabang($myode);
			foreach ($query->result() as $data);
			$logo=$data->logo;
			if (empty ($logo)) {
				$logo="";
			}
			else {
				$logo="<img class='img-responsive' src='".$logo."' width='100px' height='100px'>";
			}
			//tampilan edit
			$level=$data->kdlevel;
			$response['kdunit']		=$data->kdunit;
			$response['namaunit']	=$data->namaunit;
			$response['kdktrpusat']	=$data->kdktrpusat;
			$response['jenisKtr']	=$data->jenisKtr;
			$response['alamatunit']	=$data->alamatunit;
			$response['managerunit']=$data->managerunit;
			$response['tlp']		=$data->tlp;
			$response['fax']		=$data->fax;
			$response['email']		=$data->email;
			$response['kota']		=$data->kota;
			$response['http']		=$data->http;
			$response['level']		=$data->kdlevel;
			$response['logo']		=$logo;
			echo json_encode($response);
		}
	}

// ----------------------------------------------------------------------

	public function combo_data_kdktrpusat() {
		//if ($_SERVER['REQUEST_METHOD']==='POST') {
			$query = $this->M_data_master->data_master_perusahaan();
			foreach ($query->result() as $data) {
				$row=array();
				$row="<option value='".$data->kdktrpusat."'>".$data->kdktrpusat." - ".$data->namaktrpusat."</option>";
				$hasilrow[]=$row;
			}
			$response['data']  ="<option value=''>--- Pilih Kantor Pusat ---</option>";
			$response['data1'] =$hasilrow;
			echo json_encode($response);
		//}
	}

	public function combo_data_kdktrpusat_val() {
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			$query = $this->M_data_master->data_master_perusahaan();
			foreach ($query->result() as $data) {
				$row=array();
				$row="<option value='".$data->kdktrpusat."'>".$data->kdktrpusat." - ".$data->namaktrpusat. "</option>";
				$hasilrow[]=$row;
			}
			$response['data1'] =$hasilrow;
			echo json_encode($response);
		}
	}

	public function combo_data_kdunit_idktrpst() {
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			$my_kdktrpusat = $this->input->post('v_kdktrpusat');
			$query = $this->M_data_master->data_master_cabang_idktrpst($my_kdktrpusat);
			foreach ($query->result() as $data) {
				$row=array();
				$row="<option value='".$data->kdunit."'>".$data->kdunit." - ".$data->namaunit."</option>";
				$hasilrow[]=$row;
			}
			$response['data']  = "<option value=''>--- Pilih Kantor Cabang ---</option>";
			$response['data1'] = $hasilrow;
			echo json_encode($response);
		}
	}

	public function combo_data_kdunit_idktrpst_all() {
		//if ($_SERVER['REQUEST_METHOD']==='POST') {
			$my_kdktrpusat = $this->input->post('v_kdktrpusat');
			$query = $this->M_data_master->data_master_cabang_idktrpst($my_kdktrpusat);
			foreach ($query->result() as $data) {
				$row=array();
				$row="<option value='".$data->kdunit."'>".$data->kdunit." - ".$data->namaunit."</option>";
				$hasilrow[]=$row;
			}
			$response['data']  = "<option value='all'>--- Semua ---</option>";
			$response['data1'] = $hasilrow;
			echo json_encode($response);
		//}
	}

	public function combo_data_kdprovinsi_all() {
		$query = $this->M_data_master->combo_data_kdprovinsi_all();
		foreach ($query->result() as $data) {
			$v_noprov = substr("00".$data->kdprovinsi,-2);
			$row=array();
			$row="<option value='".$v_noprov." - ".$data->namaprovinsi."'>".$v_noprov." - ".$data->namaprovinsi."</option>";
			$hasilrow_prov[]=$row;
		}
		$response['data']  = "<option value=''>--- Pilih ---</option>";
		$response['data1'] = $hasilrow_prov;
		echo json_encode($response);
	}

	public function combo_data_kdkabupaten(){
		$v_kdprovinsi = $this->input->post('v_kdprovinsi');
		$query = $this->M_data_master->combo_data_kdkabupaten_id($v_kdprovinsi);
		foreach ($query->result() as $data) {
			$v_nokab = substr("00".$data->kdkabupaten,-2);
			$row=array();
			$row="<option value='".$v_nokab." - ".$data->namakabupaten."'>".$v_nokab." - ".$data->namakabupaten."</option>";
			$hasilrow[]=$row;
		}
		$response['data']  = "<option value=''>--- Pilih ---</option>";
		$response['data1'] = $hasilrow;
		echo json_encode($response);
	}  

	public function combo_data_kdkecamatan(){
		$v_kdprovinsi 	= $this->input->post('v_kdprovinsi');
		$v_kdkabupaten 	= $this->input->post('v_kdkabupaten');
		$query = $this->M_data_master->combo_data_kdkecamatan_id($v_kdprovinsi,$v_kdkabupaten );
		foreach ($query->result() as $data) {
			$v_nokab = substr("00".$data->kdkecamatan,-2);
			$row=array();
			$row="<option value='".$v_nokab." - ".$data->namakecamatan."'>".$v_nokab." - ".$data->namakecamatan."</option>";
			$hasilrow[]=$row;
		}
		$response['data']  = "<option value=''>--- Pilih ---</option>";
		$response['data1'] = $hasilrow;
		echo json_encode($response);
	}

	public function combo_data_kddesa(){
		$v_kdprovinsi 	= $this->input->post('v_kdprovinsi');
		$v_kdkabupaten 	= $this->input->post('v_kdkabupaten');
		$v_kdkecamatan 	= $this->input->post('v_kdkecamatan');
		/*echo " tessss ".$v_kdkecamatan; exit;*/
		
		$query = $this->M_data_master->combo_data_kddesa_id($v_kdprovinsi,$v_kdkabupaten,$v_kdkecamatan );
		foreach ($query->result() as $data) {
			$v_nodes = substr("00".$data->kddesa,-2);
			$row=array();
			$row="<option value='".$v_nodes." - ".$data->namadesa."'>".$v_nodes." - ".$data->namadesa."</option>";
			$hasilrow[]=$row;
		}
		$response['data']  = "<option value=''>--- Pilih ---</option>";
		$response['data1'] = $hasilrow;
		echo json_encode($response);
	}
	

/*--------------------------------------------------------------------------------------------------------------------*/
// (3) Panggil Form view Master Pejabat
	public function master_pejabat(){
		$this->load->view('web/desain/header');
		$this->load->view('web/master/vw_master_pejabat');
		$this->load->view('web/desain/footer');
	}

	public function data_master_pejabat() {
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			$query = $this->M_data_master->data_master_jabatan_all();
			$query=$query->result();
			if (empty($query)) {
                 $output = array(
                    "data" => [],
                );
                echo json_encode($output);
            }
            else {
                $no=1;
                foreach ($query as $data) {
                	$logo=$data->logo;
					if (empty ($logo)) {
						$logo="";
					}
					else {
						$logo="<img class='img-responsive' src='".$logo."' width='100px' height='100px'>";
					}
					$level=$data->kdlevel;
					
					//Tampilkan data di Grid
                    $row=array();
                    $row[]=$data->kdunit;
                    $row[]=$data->ket."-".$data->nip;
                    $row[]=$data->kode."".$data->kdsubbidang;
                    $row[]=$data->kdatasan;
                    $row[]=$data->namasubbidang;
                    $row[]=$data->nama;
                    $row[]=$data->useridkode;
                    $row[]="<a href='javascript:void(0)' class='btn btn-xs btn-primary' title='Edit' onclick='show_master_jabatan(2,this)' id='".$data->kdunit." ".$data->nip."'><i class='fa fa-edit fa-fw'></i> </a> <a href='javascript:void(0)' class='btn btn-xs btn-danger' title='Hapus' onclick='proses_simpan_mst_pejabat(0,this)' id='".$data->kdunit." ".$data->nip." ".$data->ket."'><i class='fa fa-trash-o fa-fw'></i></a>";
                    $dataarray[] = $row;
                $no++;}
                $output = array(
                    "data" => $dataarray,
                );
                echo json_encode($output);
            }
		}
	}

	function show_data_master_jabatan_id(){
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			$myode 	=$this->input->post('nip');
			$query 	=$this->M_data_master->show_data_master_jabatan_id($myode);
			foreach ($query->result() as $data);
			//tampilan edit
			$level=$data->kdlevel;
			$response['kdunit']			=$data->kdunit;
			$response['nip']			=$data->nip;
			$response['kode']			=$data->kode;
			$response['kdsubbidang']	=$data->kdsubbidang;
			$response['kdatasan']		=$data->kdatasan;
			$response['namasubbidang']	=$data->namasubbidang;
			$response['nama']			=$data->nama;
			$response['alamat']			=$data->alamat;
			$response['validasi']		=$data->validasi;
			$response['useridkode']		=$data->useridkode;
			$response['aktif']			=$data->aktif;
			$response['ket']			=$data->ket; 
			$response['useridkode']	    =$data->useridkode;
			echo json_encode($response);
		}
	}

	public function combo_useridkode(){
		$kdunit_user = $this->input->post('mykdunit');
		$query = $this->M_data_master->combo_useridkode($kdunit_user);
		foreach ($query->result() as $data) {
			$row=array();
			$row="<option value='".$data->useridkode."'>".$data->user_id."</option>";
			$hasilrow[]=$row;
		}
		$response['data']="<option value='0'>--- Pilih ---</option>";
		$response['data1']=$hasilrow;
		echo json_encode($response);
	}

	public function simpan_data_master_pejabat(){
        $vproses 			= $this->input->post('v_proses');
        $vkdunitnip 		= $this->input->post('v_kdunitnip'); 
        $v_namasubbidang 	= $this->input->post('v_jabatan');
        
        //input data 1 dan 2
		$v_nip    			= $this->input->post('nip_mspejabat');	
		$v_kdunit    		= $this->input->post('kdunit_mspejabat');	
		$v_kode    			= substr($this->input->post('kdjabatan_mspejabat'),0,3);	
		$v_kdsubbidang    	= substr($this->input->post('kdjabatan_mspejabat'),3,3);
		$v_kdatasan    		= $this->input->post('kdjabatan_atn_mspejabat');
		
		$v_nama    			= $this->input->post('nama_mspejabat');
		$v_alamat    		= $this->input->post('alamat_mspejabat');
		$v_validasi    		= $this->input->post('validasi_mspejabat');
		$v_ket    			= $this->input->post('ket_jabatan');
		$v_useridkode		= $this->input->post('useridkode_mspejabat');
		
		if ( isset($_POST['aktif_mspejabat']) ) { $v_aktif		= 1; } else { $v_aktif		= 0;}
		
		if ( (empty($v_nip)) || (empty($v_kdunit)) || (empty($v_nama)) ) 
		   { $adaerror = 1;} else { $adaerror = 0;}

		if ($vproses == 1){
			$chek_mst_pejabat 	= $this->M_data_master->show_data_master_jabatan_id($v_nip);
			if ( $chek_mst_pejabat->num_rows() > 0) {
					$response['status']	= "1";
					$response['pesan']	= "Error : Master Pejabat NIP Sudah Terdaftar.";
					echo json_encode($response);
			} else {
				$data  = array(
	    		        'nip'			=> $v_nip,
	    		        'kdunit' 		=> $v_kdunit, 
						'kode' 			=> $v_kode, 
						'kdsubbidang' 	=> $v_kdsubbidang, 
						'kdatasan' 		=> $v_kdatasan, 
						'namasubbidang' => $v_namasubbidang, 
						'nama' 			=> $v_nama, 
						'alamat' 		=> $v_alamat,
						'validasi' 		=> $v_validasi,
						'useridkode' 	=> $v_useridkode,
						'aktif' 		=> $v_aktif, 
					);
					if ($adaerror == 1) {
						$response['status']	= "1";
						$response['pesan']	= "Error : Data Belum Lengkap Terisi.";
						echo json_encode($response);
					} else {
						$chek_mst_pejabat 	= $this->M_data_master->show_data_master_jabatan_id($vkdunitnip);
						if ( $chek_mst_pejabat->num_rows() > 0) {
							$response['status']	= "1";
							$response['pesan']	= "Error : NIP Master Pejabat Sudah Ada.";
							echo json_encode($response);
						} else {
							if ($v_ket == 'P'){
								$hasil = $this->M_data_master->insert_master_pejabat($data);
							} elseif ($v_ket == 'S') {
			                    $hasil = $this->M_data_master->insert_mst_pejabat_petugas($data);
							}

							if ($hasil) {
								$response['status']	= "2";
								$response['pesan']	= "Sukses : Tambah Data Master Pejabat.";
								echo json_encode($response);
							} else {
								$response['status']	= "1";
								$response['pesan']	= "Error : Tambah Data Master Pejabat.";
								echo json_encode($response);
							}
						}
					}
			}
		} elseif ($vproses == 2){
			$chek_mst_pejabat 	= $this->M_data_master->show_data_master_jabatan_id($vkdunitnip);
			if ( $chek_mst_pejabat->num_rows() > 0) {
				$data  = array(
							'kode' 			=> $v_kode, 
							'kdsubbidang' 	=> $v_kdsubbidang, 
							'kdatasan' 		=> $v_kdatasan, 
							'namasubbidang' => $v_namasubbidang, 
							'nama' 			=> $v_nama, 
							'alamat' 		=> $v_alamat,
							'validasi' 		=> $v_validasi,
							'useridkode' 	=> $v_useridkode,
							'aktif' 		=> $v_aktif,
				);
				
				if ($adaerror == 1) {
						$response['status']	= "1";
						$response['pesan']	= "Error : Data Belum Lengkap Terisi.";
						echo json_encode($response);
				} else {
					if ($v_ket == 'P'){
						$hasil = $this->M_data_master->update_master_pejabat($v_kdunit,$v_nip,$data);
					} elseif ($v_ket == 'S') {
	                    $hasil = $this->M_data_master->update_mst_pejabat_petugas($v_kdunit,$v_nip,$data);
					}

					if ($hasil) {
						$response['status']	= "2";
						$response['pesan']	= "Sukses : Rubah Data Master Pejabat. ( ".$v_ket." )";
						echo json_encode($response);
					} else {
						$response['status']	= "1";
						$response['pesan']	= "Error : Rubah Data Master Pejabat. ( ".$v_ket." )";
						echo json_encode($response);
					}
				}				
			} else {
				$response['status']	= "1";
				$response['pesan']	= "Error : Master Pejabat NIP Sudah Terdaftar.";
				echo json_encode($response);
			}
		} elseif ($vproses == 0){
			$vkode 			= explode(' ', $vkdunitnip);
			$vkdunit 		= $vkode[0];
			$vnip 			= $vkode[1];
			$v_ket 			= $this->input->post('ket_jbt');
			
			$chek_mst_pejabat 	= $this->M_data_master->show_data_master_jabatan_id($vkdunitnip);
			if ( $chek_mst_pejabat->num_rows() > 0) {	
				if ($v_ket == 'P') {
					$hasil = $this->M_data_master->hapus_master_pejabat($vkdunit,$vnip);
				} elseif ($v_ket == 'S') {
					$hasil = $this->M_data_master->hapus_mst_pejabat_petugas($vkdunit,$vnip);
				}

				if ($hasil) {
					$response['status']	= "2";
					$response['pesan']	= "Sukses : Hapus Data Master Pejabat."; //.$vkdunit."--".$vnip."--".$v_ket;
					echo json_encode($response);
				} else {
					$response['status']	= "1";
					$response['pesan']	= "Error : Hapus Data Master Pejabat.";
					echo json_encode($response);
				}
			} else {
				$response['status']	= "1";
				$response['pesan']	= "Error : Hapus Data Master Pejabat Tidak Ditemukan.";
				echo json_encode($response);
			}
		}
	}



//--------------------------------------------------------------------------------------------------------------------
// (4) Panggil Form view Master Laba-Rugi
	public function master_labarugi(){
		$this->load->view('web/desain/header');
		$this->load->view('web/master/vw_master_labarugi');
		$this->load->view('web/desain/footer');
	}

	public function data_master_labarugi() {
		if ($_SERVER['REQUEST_METHOD']==='POST') {

			$vktrpusat = $this->input->post('v_ktrpusat');
			$vkdproduk = $this->input->post('v_kdproduk');

            $querylb = 	" SELECT * FROM mst_kredit_biaya_labarugi             ".
                     	" where kdktrpusat = '".$vktrpusat."'                 ".
                     	" and kodeproduk   = '".$vkdproduk."'                 ";
                                                                                                                                                          
			$resultlb = mysql_query($querylb);    
			$no = 1;                                
			while ($buff = mysql_fetch_array($resultlb)){

	            if (($buff['plusminus'] == '+') or  ($buff['plusminus'] == '-')) {      
	              $cal_uraian =
	              '   <th width =10% style="text-align: left;  text-indent: 0.2in;">'.$buff['uraian'].
	              '   </th> ';                           
	            } else {                                    
	              $cal_uraian =
	              '   <td width =10% style="text-align: left; font-weight:bold"> '.$buff['uraian'].' '.$buff['rumuslabel'];
	            }
	            
	            if (($buff['plusminus'] == '+') or  ($buff['plusminus'] == '-')) {     
				   $nilai = "nilai".$buff["kodebiaya"];
				
					$cal_nilai =
					' <th align="right" width =10%> <input type="text" id="'.$nilai.'" name="'.$nilai.'"'.
					'  value="0"; style="text-align:right" background-color="990000"                    '.
					'  readonly="readonly">                                                             '.
					'  </th>                                                                            ';
				} else { 
				    if ( $buff['plusminus'] == 'S') { 
				    	$cal_nilai = ' <th> </th>'; 
				    } else {
				    	$cal_nilai =
				        ' <th style="font-weight:bold" align="right" width =10%> </th>'; 
				    }
				} 


	            $cal_aksi =
				"   <th> ".
				"   <a href='javascript:void(0)' class='btn btn-xs btn-primary' title='Edit' 	".
				"		onclick= 'show_master_labarugi(2,this)' id='".$buff["kdktrpusat"].
				" ".$buff["kodeproduk"]." ".$buff["kodebiaya"]."'>   				            ".
				"		<i class='fa fa-edit fa-fw'></i> </a>								 	".
				"   <a href='javascript:void(0)' class='btn btn-xs btn-danger' title='Hapus' 	".
				"      	onclick='proses_simpan_mst_labarugi(0,this)'id='".$buff["kdktrpusat"].
				" ".$buff["kodeproduk"]." ".$buff["kodebiaya"]."'>   				            ".
				" 		<i class='fa fa-trash-o fa-fw'></i></a>                              	".
				"	</th>";


	            $row=array();
				$row= 	'<tr bgcolor="#99CDFF">'.

							//cal 1
							'   <th width =2% style="text-align: left; text-indent: 0.2in; font-weight:bold" > '. $buff['urutlabel'].'</th>'.

							//cal 2
							'   <th width =7% style="text-align: center; text-indent: 0.2in; font-weight:bold" >'.$buff['kodebiaya'].'</th> '.

							//cal 3
							$cal_uraian.

							//cal 4
							$cal_nilai.

							//cal 5
							$cal_aksi.

						'</tr>';
	            $hasilrow[]=$row;
	        }

			$response['data'] =$hasilrow;
			echo json_encode($response);

		}
	}

	public function show_data_master_labarugi_id(){
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			$myode 	=$this->input->post('kode_mstlr');
			$query 	=$this->M_data_master->show_data_master_labarugi_id($myode);
			foreach ($query->result() as $data);
			//tampilan edit
			$response['kdktrpusat']		=$data->kdktrpusat;
			$response['kodeproduk']		=$data->kodeproduk;
			$response['kodebiaya']		=$data->kodebiaya;
			$response['kodebiayainduk']	=$data->kodebiayainduk;
			$response['urutlabel']		=$data->urutlabel;
			$response['uraian']			=$data->uraian;
			$response['group1']			=$data->group1;
			$response['group2']			=$data->group2;
			$response['plusminus']		=$data->plusminus;
			$response['keterangan']		=$data->keterangan;
			$response['constanta']		=$data->constanta;
			$response['rumuslabel']		=$data->rumuslabel; 
			$response['aktif']	    	=$data->aktif;
			echo json_encode($response);
		}
	}

	public function simpan_data_master_labarugi(){
        $vproses 			= $this->input->post('v_proses');
        $vid 				= $this->input->post('v_kdlb');
    	$vkode 				= explode(' ', $vid);
		$v_kdktrpusat   	= $vkode[0];	
		$v_kodeproduk 		= $vkode[1];	
		$v_kodebiaya    	= $vkode[2];
                
        //input data 1 dan 2
		if ($vproses == 1 || $vproses == 2){
				

			$v_keterangan    	= $this->input->post('keterangan_lr');
			$v_kodebiayainduk   = $this->input->post('kodebiayainduk_lr');
			
			$v_urutlabel    	= $this->input->post('urutlabel_lr');
			$v_uraian    		= $this->input->post('uraian_lr');
			$v_rumuslabel    	= $this->input->post('rumuslabel_lr');
			$v_constanta    	= $this->input->post('constanta_lr');
			$v_plusminus		= $this->input->post('plusminus_lr');

			$v_group1    		= $this->input->post('group1_lr');
			$v_group2    		= $this->input->post('group2_lr');
			$v_aktif			= $this->input->post('aktif_lr');
			
			if ( isset($_POST['aktif_lr']) ) { $v_aktif		= 1; } else { $v_aktif		= 0;}
			
			if ( (empty($v_kdktrpusat)) || (empty($v_kodeproduk)) || (empty($v_kodebiaya)) ) 
			   { $adaerror = 1;} else { $adaerror = 0;}
		}

		if ($vproses == 1){
			$chek_mst_Labarugi 	= $this->M_data_master->show_data_master_labarugi_id($vid);
			if ( $chek_mst_Labarugi->num_rows() > 0) {
					$response['status']	= "1";
					$response['pesan']	= "Error : Master Laba Rugi Sudah Terdaftar.";
					echo json_encode($response);
			} else {
				$data  = array(
	    		        'kdktrpusat'	=> $v_kdktrpusat, 
						'kodeproduk' 	=> $v_kodeproduk, 
						'kodebiaya'		=> $v_kodebiaya, 
						'kodebiayainduk'=> $v_kodebiayainduk, 
						'urutlabel' 	=> $v_urutlabel, 
						'uraian' 		=> $v_uraian,
						'group1' 		=> $v_group1,
						'group2' 		=> $v_group2,
						'plusminus' 	=> $v_plusminus,
						'keterangan' 	=> $v_keterangan,
						'constanta'		=> $v_constanta,
						'rumuslabel' 	=> $v_rumuslabel,
						'aktif' 		=> $v_aktif
					);
					
					if ($adaerror == 1) {
						$response['status']	= "1";
						$response['pesan']	= "Error : Data Kantor Pusat, Kode Produk dan atau Kode Biaya Ada Yang Kosong !";
						echo json_encode($response);
					} else {
						$chek_mst_Labarugi 	= $this->M_data_master->show_data_master_labarugi_id($vkdunitnip);
						if ( $chek_mst_Labarugi->num_rows() > 0) {
							$response['status']	= "1";
							$response['pesan']	= "Error : Master Laba Rugi Sudah Ada.";
							echo json_encode($response);
						} else {
							$hasil = $this->M_data_master->insert_mst_labarugi($data);
							if ($hasil) {
								$response['status']	= "2";
								$response['pesan']	= "Sukses : Tambah Data Master Laba Rugi.";
								echo json_encode($response);
							} else {
								$response['status']	= "1";
								$response['pesan']	= "Error : Tambah Data Master Laba Rugi.";
								echo json_encode($response);
							}
						}
					}
			}
		} elseif ($vproses == 2){
			$chek_mst_Labarugi 	= $this->M_data_master->show_data_master_labarugi_id($vid);
			if ( $chek_mst_Labarugi->num_rows() > 0) {
				$data  = array(
							'kdktrpusat'	=> $v_kdktrpusat, 
							'kodeproduk' 	=> $v_kodeproduk, 
							'kodebiaya'		=> $v_kodebiaya, 
							'kodebiayainduk'=> $v_kodebiayainduk, 
							'urutlabel' 	=> $v_urutlabel, 
							'uraian' 		=> $v_uraian,
							'group1' 		=> $v_group1,
							'group2' 		=> $v_group2,
							'plusminus' 	=> $v_plusminus,
							'keterangan' 	=> $v_keterangan,
							'constanta'		=> $v_constanta,
							'rumuslabel' 	=> $v_rumuslabel,
							'aktif' 		=> $v_aktif
				);
				
				if ($adaerror == 1) {
						$response['status']	= "1";
						$response['pesan']	= "Error : Data Kantor Pusat, Kode Produk dan atau Kode Biaya Ada Yang Kosong !";
						echo json_encode($response);
				} else {
					$hasil = $this->M_data_master->update_mst_labarugi($v_kdktrpusat,$v_kodeproduk,$v_kodebiaya,$data);
					if ($hasil) {
						$response['status']	= "2";
						$response['pesan']	= "Sukses : Rubah Data Master Laba Rugi.";
						echo json_encode($response);
					} else {
						$response['status']	= "1";
						$response['pesan']	= "Error : Rubah Data Master Laba Rugi.";
						echo json_encode($response);
					}
				}				
			} else {
				$response['status']	= "1";
				$response['pesan']	= "Error : Master Laba Rugi Tidak Ditemukan.";
				echo json_encode($response);
			}
		} elseif ($vproses == 0){
			$chek_mst_Labarugi 	= $this->M_data_master->show_data_master_labarugi_id($vid);
			if ( $chek_mst_Labarugi->num_rows() > 0) {	
				$hasil = $this->M_data_master->hapus_mst_labarugi($v_kdktrpusat,$v_kodeproduk,$v_kodebiaya);
				if ($hasil) {
					$response['status']	= "2";
					$response['pesan']	= "Sukses : Hapus Data Master Laba Rugi."; //.$vkdunit."--".$vnip."--".$v_ket;
					echo json_encode($response);
				} else {
					$response['status']	= "1";
					$response['pesan']	= "Error : Hapus Data Master Laba Rugi.";
					echo json_encode($response);
				}
			} else {
				$response['status']	= "1";
				$response['pesan']	= "Error : Hapus Data Master Laba Rugi Tidak Ditemukan.";
				echo json_encode($response);
			}
		}
	}


//--------------------------------------------------------------------------------------------------------------------
// (5) Panggil Form view Master Neraca
	public function master_neraca(){
		$this->load->view('web/desain/header');
		$this->load->view('web/master/vw_master_neraca');
		$this->load->view('web/desain/footer');
	}

	public function data_master_neraca() {
		if ($_SERVER['REQUEST_METHOD']==='POST') {

			$vktrpusat = $this->input->post('v_ktrpusat');
			$vkdproduk = $this->input->post('v_kdproduk');

            $querylb = 	" SELECT * FROM mst_kredit_biaya_neraca               ".
                     	" where kdktrpusat = '".$vktrpusat."'                 ".
                     	" and kodeproduk   = '".$vkdproduk."'                 ";
                                                                                                                                                          
			$resultlb = mysql_query($querylb);    
			$no = 1;                                
			while ($buff = mysql_fetch_array($resultlb)){

	            if (($buff['plusminus'] == '+') or  ($buff['plusminus'] == '-')) {      
	              $cal_uraian =
	              '   <th width =10% style="text-align: left;  text-indent: 0.2in;">'.$buff['uraian'].
	              '   </th> ';                           
	            } else {                                    
	              $cal_uraian =
	              '   <td width =10% style="text-align: left; font-weight:bold"> '.$buff['uraian'].' '.$buff['rumuslabel'];
	            }
	            
	            if (($buff['plusminus'] == '+') or  ($buff['plusminus'] == '-')) {     
				   $nilai = "nilai".$buff["kodebiaya"];
				
					$cal_nilai =
					' <th align="right" width =10%> <input type="text" id="'.$nilai.'" name="'.$nilai.'"'.
					'  value="0"; style="text-align:right" background-color="990000"                    '.
					'  readonly="readonly">                                                             '.
					'  </th>                                                                            ';
				} else { 
				    if ( $buff['plusminus'] == 'S') { 
				    	$cal_nilai = ' <th> </th>'; 
				    } else {
				    	$cal_nilai =
				        ' <th style="font-weight:bold" align="right" width =10%> </th>'; 
				    }
				} 


	            $cal_aksi =
				"   <th> ".
				"   <a href='javascript:void(0)' class='btn btn-xs btn-primary' title='Edit' 	".
				"		onclick= 'show_master_neraca(2,this)' id='".$buff["kdktrpusat"].
				" ".$buff["kodeproduk"]." ".$buff["kodebiaya"]."'>   				            ".
				"		<i class='fa fa-edit fa-fw'></i> </a>								 	".
				"   <a href='javascript:void(0)' class='btn btn-xs btn-danger' title='Hapus' 	".
				"      	onclick='proses_simpan_mst_neraca(0,this)'id='".$buff["kdktrpusat"].
				" ".$buff["kodeproduk"]." ".$buff["kodebiaya"]."'>   				            ".
				" 		<i class='fa fa-trash-o fa-fw'></i></a>                              	".
				"	</th>";


	            $row=array();
				$row= 	'<tr bgcolor="#99CDFF">'.

							//cal 1
							'   <th width =2% style="text-align: left; text-indent: 0.2in; font-weight:bold" > '. $buff['urutlabel'].'</th>'.

							//cal 2
							'   <th width =7% style="text-align: center; text-indent: 0.2in; font-weight:bold" >'.$buff['kodebiaya'].'</th> '.

							//cal 3
							$cal_uraian.

							//cal 4
							$cal_nilai.

							//cal 5
							$cal_aksi.

						'</tr>';
	            $hasilrow[]=$row;
	        }

			$response['data'] =$hasilrow;
			echo json_encode($response);

		}
	}

	public function show_data_master_neraca_id(){
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			$myode 	=$this->input->post('kode_mstnr');
			$query 	=$this->M_data_master->show_data_master_neraca_id($myode);
			foreach ($query->result() as $data);
			//tampilan edit
			$response['kdktrpusat']		=$data->kdktrpusat;
			$response['kodeproduk']		=$data->kodeproduk;
			$response['kodebiaya']		=$data->kodebiaya;
			$response['kodebiayainduk']	=$data->kodebiayainduk;
			$response['urutlabel']		=$data->urutlabel;
			$response['uraian']			=$data->uraian;
			$response['group1']			=$data->group1;
			$response['group2']			=$data->group2;
			$response['plusminus']		=$data->plusminus;
			$response['keterangan']		=$data->keterangan;
			$response['constanta']		=$data->constanta;
			$response['rumuslabel']		=$data->rumuslabel; 
			$response['aktif']	    	=$data->aktif;
			echo json_encode($response);
		}
	}

	public function simpan_data_master_neraca(){
        $vproses 			= $this->input->post('v_proses');
        $vid 				= $this->input->post('v_kdnr');
    	$vkode 				= explode(' ', $vid);
		$v_kdktrpusat   	= $vkode[0];	
		$v_kodeproduk 		= $vkode[1];	
		$v_kodebiaya    	= $vkode[2];
                
        //input data 1 dan 2
		if ($vproses == 1 || $vproses == 2){
				

			$v_keterangan    	= $this->input->post('keterangan_nr');
			$v_kodebiayainduk   = $this->input->post('kodebiayainduk_nr');
			
			$v_urutlabel    	= $this->input->post('urutlabel_nr');
			$v_uraian    		= $this->input->post('uraian_nr');
			$v_rumuslabel    	= $this->input->post('rumuslabel_nr');
			$v_constanta    	= $this->input->post('constanta_nr');
			$v_plusminus		= $this->input->post('plusminus_nr');

			$v_group1    		= $this->input->post('group1_nr');
			$v_group2    		= $this->input->post('group2_nr');
			$v_aktif			= $this->input->post('aktif_nr');
			
			if ( isset($_POST['aktif_lr']) ) { $v_aktif		= 1; } else { $v_aktif		= 0;}
			
			if ( (empty($v_kdktrpusat)) || (empty($v_kodeproduk)) || (empty($v_kodebiaya)) ) 
			   { $adaerror = 1;} else { $adaerror = 0;}
		}

		if ($vproses == 1){
			$chek_mst_Labarugi 	= $this->M_data_master->show_data_master_neraca_id($vid);
			if ( $chek_mst_Labarugi->num_rows() > 0) {
					$response['status']	= "1";
					$response['pesan']	= "Error : Master Neraca Sudah Terdaftar.";
					echo json_encode($response);
			} else {
				$data  = array(
	    		        'kdktrpusat'	=> $v_kdktrpusat, 
						'kodeproduk' 	=> $v_kodeproduk, 
						'kodebiaya'		=> $v_kodebiaya, 
						'kodebiayainduk'=> $v_kodebiayainduk, 
						'urutlabel' 	=> $v_urutlabel, 
						'uraian' 		=> $v_uraian,
						'group1' 		=> $v_group1,
						'group2' 		=> $v_group2,
						'plusminus' 	=> $v_plusminus,
						'keterangan' 	=> $v_keterangan,
						'constanta'		=> $v_constanta,
						'rumuslabel' 	=> $v_rumuslabel,
						'aktif' 		=> $v_aktif
					);
					
					if ($adaerror == 1) {
						$response['status']	= "1";
						$response['pesan']	= "Error : Data Kantor Pusat, Kode Produk dan atau Kode Biaya Ada Yang Kosong !";
						echo json_encode($response);
					} else {
						$chek_mst_Labarugi 	= $this->M_data_master->show_data_master_neraca_id($vkdunitnip);
						if ( $chek_mst_Labarugi->num_rows() > 0) {
							$response['status']	= "1";
							$response['pesan']	= "Error : Master Neraca Sudah Ada.";
							echo json_encode($response);
						} else {
							$hasil = $this->M_data_master->insert_mst_neraca($data);
							if ($hasil) {
								$response['status']	= "2";
								$response['pesan']	= "Sukses : Tambah Data Master Neraca.";
								echo json_encode($response);
							} else {
								$response['status']	= "1";
								$response['pesan']	= "Error : Tambah Data Master Neracai.";
								echo json_encode($response);
							}
						}
					}
			}
		} elseif ($vproses == 2){
			$chek_mst_Labarugi 	= $this->M_data_master->show_data_master_neraca_id($vid);
			if ( $chek_mst_Labarugi->num_rows() > 0) {
				$data  = array(
							'kdktrpusat'	=> $v_kdktrpusat, 
							'kodeproduk' 	=> $v_kodeproduk, 
							'kodebiaya'		=> $v_kodebiaya, 
							'kodebiayainduk'=> $v_kodebiayainduk, 
							'urutlabel' 	=> $v_urutlabel, 
							'uraian' 		=> $v_uraian,
							'group1' 		=> $v_group1,
							'group2' 		=> $v_group2,
							'plusminus' 	=> $v_plusminus,
							'keterangan' 	=> $v_keterangan,
							'constanta'		=> $v_constanta,
							'rumuslabel' 	=> $v_rumuslabel,
							'aktif' 		=> $v_aktif
				);
				
				if ($adaerror == 1) {
						$response['status']	= "1";
						$response['pesan']	= "Error : Data Kantor Pusat, Kode Produk dan atau Kode Biaya Ada Yang Kosong !";
						echo json_encode($response);
				} else {
					$hasil = $this->M_data_master->update_mst_neraca($v_kdktrpusat,$v_kodeproduk,$v_kodebiaya,$data);
					if ($hasil) {
						$response['status']	= "2";
						$response['pesan']	= "Sukses : Rubah Data Master Neraca.";
						echo json_encode($response);
					} else {
						$response['status']	= "1";
						$response['pesan']	= "Error : Rubah Data Master Neraca.";
						echo json_encode($response);
					}
				}				
			} else {
				$response['status']	= "1";
				$response['pesan']	= "Error : Master Neraca Tidak Ditemukan.";
				echo json_encode($response);
			}
		} elseif ($vproses == 0){
			$chek_mst_Labarugi 	= $this->M_data_master->show_data_master_neraca_id($vid);
			if ( $chek_mst_Labarugi->num_rows() > 0) {	
				$hasil = $this->M_data_master->hapus_mst_neraca($v_kdktrpusat,$v_kodeproduk,$v_kodebiaya);
				if ($hasil) {
					$response['status']	= "2";
					$response['pesan']	= "Sukses : Hapus Data Master Neraca."; //.$vkdunit."--".$vnip."--".$v_ket;
					echo json_encode($response);
				} else {
					$response['status']	= "1";
					$response['pesan']	= "Error : Hapus Data Master Neraca.";
					echo json_encode($response);
				}
			} else {
				$response['status']	= "1";
				$response['pesan']	= "Error : Hapus Data Master Neraca Tidak Ditemukan.";
				echo json_encode($response);
			}
		}
	}



//--------------------------------------------------------------------------------------------------------------------
// (6) Panggil Form view Master Scoring
	public function master_scoring(){
		$this->load->view('web/desain/header');
		$this->load->view('web/master/vw_master_scoring');
		$this->load->view('web/desain/footer');
	}

	public function test(){

		$data = $this->M_data_master->combo_mst_perusahaan();
		
		echo json_encode($data);
	}

	public function data_master_scoring() {
		if ($_SERVER['REQUEST_METHOD']==='POST') {

			$vktrpusat = $this->input->post('v_ktrpusat');
			$vkdproduk = $this->input->post('v_kdproduk');

            $querylb = 	" SELECT * FROM mst_kredit_scorcard                   ".
                     	" where kdktrpusat = '".$vktrpusat."'                 ".
                     	" and kodeproduk   = '".$vkdproduk."'                 ".
                     	" and type	  <> '2'                                  ";
                                                                                                                                                          
			$resultlb = mysql_query($querylb);    
			$no = 1;                                
			while ($buff = mysql_fetch_array($resultlb)){

	            // call 1 nomor urut
	            if (!empty($buff['urutlabel'])) {
	            	$cal_urut	= '   <th width =2% style="text-align: left; text-indent: 0.2in; font-weight:bold" > '. $buff['urutlabel'].'. </th>';
	            } else {
	               $cal_urut 	= '   <th width =2% style="text-align: right; text-indent: 0.2in; font-weight:bold" > '. $buff['urutlabel'].'</th>';
	            }

	            $cal_id	= '   <th width =2% style="text-align: left; text-indent: 0.2in; font-weight:bold" > '. $buff['idscorcard'].' </th>';

	            //call 2 nosub no dan uraian
	            if (!empty($buff['urutlabelsub'])) {
	            	$cal_urutsuburaian = '   <th width =7% style="text-align: left; text-indent: 0.2in; font-weight:bold" >   '. $buff['urutlabelsub'].'). '.$buff['subkriteria'].'</th> ';
	            } else {
	            	$cal_urutsuburaian = '   <th width =7% style="text-align: left; text-indent: 0.2in; font-weight:bold" >'.$buff['subkriteria'].'</th> ';
	            }

	            //call 3
	            if ($buff['sb_score'] == 0 ){
		            $cal_nilai_SB =
		              '   <th width =10% style="text-align: center;  text-indent: 0.2in;"> </th> ';
		        } else {
		        	$cal_nilai_SB =
		              '   <th width =10% style="text-align: center;  text-indent: 0.2in;">'. $buff['sb_score'].
		              '   </th> ';
		        }                          
	           
	           //call  4
	            if ($buff['sb_score'] == 0 ){
		            $cal_nilai_B =
		              '   <th width =10% style="text-align: center;  text-indent: 0.2in;"> </th> ';
		        } else {
		        	$cal_nilai_B =
		              '   <th width =10% style="text-align: center;  text-indent: 0.2in;">'. $buff['b_score'].
		              '   </th> ';
		        }   

		        //call  5
	            if ($buff['sb_score'] == 0 ){
		            $cal_nilai_CB =
		              '   <th width =10% style="text-align: center;  text-indent: 0.2in;"> </th> ';
		        } else {
		        	$cal_nilai_CB =
		              '   <th width =10% style="text-align: center;  text-indent: 0.2in;">'. $buff['cb_score'].
		              '   </th> ';
		        } 

		        //call  6
	            if ($buff['sb_score'] == 0 ){
		            $cal_nilai_TB =
		              '   <th width =10% style="text-align: center;  text-indent: 0.2in;"> </th> ';
		        } else {
		        	$cal_nilai_TB =
		              '   <th width =10% style="text-align: center;  text-indent: 0.2in;">'. $buff['tb_score'].
		              '   </th> ';
		        }       


	            $cal_aksi =
				"   <th> ".
				"   <a href='javascript:void(0)' class='btn btn-xs btn-primary' title='Edit' 	".
				"		onclick= 'show_master_scoreing(2,this)' id='".$buff["kdktrpusat"].
				" ".$buff["kodeproduk"]." ".$buff["idscorcard"]."'>   				            ".
				"		<i class='fa fa-edit fa-fw'></i> </a>								 	".
				"   <a href='javascript:void(0)' class='btn btn-xs btn-danger' title='Hapus' 	".
				"      	onclick='proses_simpan_mst_scoreing(0,this)'id='".$buff["kdktrpusat"].
				" ".$buff["kodeproduk"]." ".$buff["idscorcard"]."'>   				            ".
				" 		<i class='fa fa-trash-o fa-fw'></i></a>                              	".
				"	</th>";


	            $row=array();
				$row= 	'<tr bgcolor="#99CDFF">'.

							//cal 1
							$cal_urut.
							$cal_id.							
							//cal 2
							$cal_urutsuburaian.
							//cal 3
							$cal_nilai_SB.
							//cal 4
							$cal_nilai_B.							
							//cal 4
							$cal_nilai_CB.
							//cal 4
							$cal_nilai_TB.
							//cal 5
							$cal_aksi.

						'</tr>';
	            $hasilrow[]=$row;
	        }

			$response['data'] =$hasilrow;
			echo json_encode($response);

		}
	}

	public function data_master_scoring_syarat(){
		if ($_SERVER['REQUEST_METHOD']==='POST') {

			$vktrpusat = $this->input->post('v_ktrpusat');
			$vkdproduk = $this->input->post('v_kdproduk');

            $querylb = 	" SELECT * FROM mst_kredit_scorcard                   ".
                     	" where kdktrpusat = '".$vktrpusat."'                 ".
                     	" and kodeproduk   = '".$vkdproduk."'                 ".
                     	" and type	  = '2'                                  ";
                                                                                                                                                          
			$resultlb = mysql_query($querylb);    
			$no = 1;                                
			while ($buff = mysql_fetch_array($resultlb)){

	            // call 1 nomor urut
	            $cal_urut	= '<th width =2% style="text-align: left; text-indent: 0.2in; font-weight:bold" > '. $no++.'. </th>';

	            $cal_id	= '   <th width =2% style="text-align: left; text-indent: 0.2in; font-weight:bold" > '. $buff['idscorcard'].' </th>';

	            //call 2 nosub no dan uraian
	            if (!empty($buff['urutlabelsub'])) {
	            	$cal_urutsuburaian = '   <th width =7% style="text-align: left; text-indent: 0.2in; font-weight:bold" >   '. $buff['subkriteria'].'</th> ';
	            } else {
	            	$cal_urutsuburaian = '   <th width =7% style="text-align: left; text-indent: 0.2in; font-weight:bold" >'.$buff['subkriteria'].'</th> ';
	            }

	            //call 3
	            if ($buff['syarat'] == 1 ){
	            	$cal_wajib =  '<th width =7% style="text-align: center; text-indent: 0.2in; font-weight:bold" > Ya </th> '; 
	            } else { 
                    $cal_wajib = '<th width =7% style="text-align: center; text-indent: 0.2in; font-weight:bold" > Tidak </th> '; 
                }
	           
	            $cal_aksi =
				"   <th> ".
				"   <a href='javascript:void(0)' class='btn btn-xs btn-primary' title='Edit' 	".
				"		onclick= 'show_master_scoreing(2,this)' id='".$buff["kdktrpusat"].
				" ".$buff["kodeproduk"]." ".$buff["idscorcard"]."'>   				            ".
				"		<i class='fa fa-edit fa-fw'></i> </a>								 	".
				"   <a href='javascript:void(0)' class='btn btn-xs btn-danger' title='Hapus' 	".
				"      	onclick='proses_simpan_mst_scoreing(0,this)'id='".$buff["kdktrpusat"].
				" ".$buff["kodeproduk"]." ".$buff["idscorcard"]."'>   				            ".
				" 		<i class='fa fa-trash-o fa-fw'></i></a>                              	".
				"	</th>";


	            $row=array();
				$row= 	'<tr bgcolor="#99CDFF">'.

							//cal 1
							$cal_urut.
							$cal_id.					
							//cal 2
							$cal_urutsuburaian.
							//cal 3
							$cal_wajib.
							//cal 4
							$cal_aksi.

						'</tr>';
	            $hasilrow[]=$row;
	            //$no++;
	        }

			$response['data'] =$hasilrow;
			echo json_encode($response);

		}

	}

	public function show_data_master_scoreing_id() {
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			/*$vktrpusat = $this->input->post('v_ktrpusat');
			$vkdproduk = $this->input->post('v_kdproduk');*/

            $myode 		= $this->input->post('kode_mstnr');
            $vkode 	   	= explode(' ', $myode);
			$vkdproduk 	= $vkode[1];
			$vidscorcard= $vkode[2];
			$query 		= $this->M_data_master->show_data_master_scoring_id($vkdproduk, $vidscorcard);
			foreach ($query->result() as $data);
			//tampilan edit
			$response['kdktrpusat']		=$data->kdktrpusat;
			$response['idscorcard']		=$data->idscorcard;
			$response['kodeproduk']		=$data->kodeproduk;

			$response['urutlabel']		=$data->urutlabel;
			$response['urutlabelsub']	=$data->urutlabelsub;
			$response['kriteria']		=$data->kriteria;
			$response['subkriteria']	=$data->subkriteria;
			$response['oprator']		=$data->oprator;
			$response['type']			=$data->type;
			$response['syarat']			=$data->syarat;

			$response['image_size_w']	=$data->image_size_w;
			$response['image_size_h']	=$data->image_size_h;

			$response['sb_item']		=$data->sb_item;
			$response['b_item']			=$data->b_item;
			$response['cb_item']		=$data->cb_item; 
			$response['tb_item']		=$data->tb_item;


			$response['sb_min']		= number_format($data->sb_min,2,',','');
			$response['b_min']		= number_format($data->b_min,2,',','');
			$response['cb_min']		= number_format($data->cb_min,2,',','');
			$response['tb_min']		= number_format($data->tb_min,2,',','');

			$response['sb_max']		= number_format($data->sb_max,2,',','');
			$response['b_max']		= number_format($data->b_max,2,',','');
			$response['cb_max']		= number_format($data->cb_max,2,',',''); 
			$response['tb_max']		= number_format($data->tb_max,2,',','');
			
			echo json_encode($response);

		}
	}

	public function simpan_data_master_scoreing(){
		$vproses 	= $this->input->post('v_proses');
		$vkdid 		= $this->input->post('v_kdid');

		$vidarray 		= explode(" ", $vkdid);
		$vkdktrpusat 	= $vidarray[0];
		$vkdproduk 		= $vidarray[1];
		$vkdidscore		= $vidarray[2];

		if ($vproses == 0) {
			$ChekAda = $this->M_data_master->show_data_master_scoring_id($vkdproduk,$vkdidscore);
			if ($ChekAda->num_rows() > 0) {
				$hasil = $this->M_data_master->hapus_mst_scoring($vkdktrpusat,$vkdproduk,$vkdidscore);;
	            if ($hasil) {
					$response['status']	= "2";
					$response['pesan']	= "Sukses : Hapus Data Master Scorecard.".$vkdktrpusat;
					echo json_encode($response);
				} else {
					$response['status']	= "1";
					$response['pesan']	= "Error : Hapus Data Master Scorecard.";
					echo json_encode($response);
				}
			} else {
				$response['status']	= "1";
				$response['pesan']	= "Error : Hapus Data Master Scorecard Tidak Ditemukan. ";
				echo json_encode($response);
			}
		} else if ($vproses == 1) {
			$verror = '0';
			if ($this->input->post('subkriteria_sc') == '') { $verror = 'Error: Label Sub Uraian Score  Masih Kosong !';}
			if ($this->input->post('kriteria_sc') == '') { $verror = 'Error: Label Uraian Score Masih Kosong !';}
			if ($vkdidscore == '') { $verror = 'Error: Kode Idscorecard Masih Kosong !';}
			
			$ChekAda = $this->M_data_master->show_data_master_scoring_id($vkdproduk,$vkdidscore);
			if ( $verror != '0') {
				$response['status']	= "1";
				$response['pesan']	= $verror;
				echo json_encode($response);
			} else if ($ChekAda->num_rows() > 0) {
				$response['status']	= "1";
				$response['pesan']	= "Error : Tambah Data Master Scorecard Sudah. ";
				echo json_encode($response);
			} else {
				if ( isset($_POST['syarat_wajib']) ) { $v_syarat		= 1; } else { $v_syarat		= 0;}
				$data 	= array(
							'kdktrpusat' 	=> $vkdktrpusat, 
							'kodeproduk' 	=> $vkdproduk, 
							'idscorcard' 	=> $vkdidscore, 

							'urutlabel' 	=> $this->input->post('urutlabel_sc'), 
							'urutlabelsub' 	=> $this->input->post('urutlabelsub_sc'), 
							'kriteria' 		=> $this->input->post('kriteria_sc'), 
							'subkriteria' 	=> $this->input->post('subkriteria_sc'), 
							'oprator' 		=> $this->input->post('oprator_sc'), 
							'type' 			=> $this->input->post('type_sc'), 
							'variable' 		=> $this->input->post('variable_sc'), 

							'sb_item' 		=> $this->input->post('sb_item_sc'), 
							'b_item' 		=> $this->input->post('b_item_sc'), 
							'cb_item' 		=> $this->input->post('cb_item_sc'), 
							'tb_item' 		=> $this->input->post('tb_item_sc'), 
							
							'sb_min' 		=> str_replace(",", ".", $this->input->post('sb_min_sc')), 
							'sb_max' 		=> str_replace(",", ".",$this->input->post('sb_max_sc')), 
							'b_min' 		=> str_replace(",", ".",$this->input->post('b_min_sc')), 
							'b_max' 		=> str_replace(",", ".",$this->input->post('b_max_sc')), 
							'cb_min' 		=> str_replace(",", ".",$this->input->post('cb_min_sc')), 
							'cb_max' 		=> str_replace(",", ".",$this->input->post('cb_max_sc')), 
							'tb_min' 		=> str_replace(",", ".",$this->input->post('tb_min_sc')), 
							'tb_max'		=> str_replace(",", ".",$this->input->post('tb_max_sc')), 
							
							'sb_score' 		=> $this->input->post('out_sb'), 
							'b_score' 		=> $this->input->post('out_b'), 
							'cb_score' 		=> $this->input->post('out_cb'), 
							'tb_score' 		=> $this->input->post('out_tb'), 
							'syarat' 		=> $v_syarat, 
							'image_size_w' 	=> $this->input->post('image_size_w_sc'), 
							'image_size_h' 	=> $this->input->post('image_size_h_sc') 
					);
	            $hasil = $this->M_data_master->insert_mst_scoring($data);
	            if ($hasil) {
					$response['status']	= "2";
					$response['pesan']	= "Sukses : Tambah Data Master Scorecard.";
					echo json_encode($response);
				} else {
					$response['status']	= "1";
					$response['pesan']	= "Error : Tambah Data Master Scorecard.";
					echo json_encode($response);
				}
			}
		}
		if ($vproses == 2) {
			$ChekAda = $this->M_data_master->show_data_master_scoring_id($vkdproduk,$vkdidscore);
			if ($ChekAda->num_rows() > 0) {
				if ( isset($_POST['syarat_wajib']) ) { $v_syarat		= 1; } else { $v_syarat		= 0;}
				$data 	= array(
							'urutlabel' 	=> $this->input->post('urutlabel_sc'), 
							'urutlabelsub' 	=> $this->input->post('urutlabelsub_sc'), 
							'kriteria' 		=> $this->input->post('kriteria_sc'), 
							'subkriteria' 	=> $this->input->post('subkriteria_sc'), 
							'oprator' 		=> $this->input->post('oprator_sc'), 
							'type' 			=> $this->input->post('type_sc'), 
							'variable' 		=> $this->input->post('variable_sc'), 
							'sb_item' 		=> $this->input->post('sb_item_sc'), 
							'b_item' 		=> $this->input->post('b_item_sc'), 
							'cb_item' 		=> $this->input->post('cb_item_sc'), 
							'tb_item' 		=> $this->input->post('tb_item_sc'), 
							
							'sb_min' 		=> str_replace(",", ".", $this->input->post('sb_min_sc')), 
							'sb_max' 		=> str_replace(",", ".",$this->input->post('sb_max_sc')), 
							'b_min' 		=> str_replace(",", ".",$this->input->post('b_min_sc')), 
							'b_max' 		=> str_replace(",", ".",$this->input->post('b_max_sc')), 
							'cb_min' 		=> str_replace(",", ".",$this->input->post('cb_min_sc')), 
							'cb_max' 		=> str_replace(",", ".",$this->input->post('cb_max_sc')), 
							'tb_min' 		=> str_replace(",", ".",$this->input->post('tb_min_sc')), 
							'tb_max'		=> str_replace(",", ".",$this->input->post('tb_max_sc')), 
							
							'sb_score' 		=> $this->input->post('out_sb'), 
							'b_score' 		=> $this->input->post('out_b'), 
							'cb_score' 		=> $this->input->post('out_cb'), 
							'tb_score' 		=> $this->input->post('out_tb'), 
							'syarat' 		=> $v_syarat, 
							'image_size_w' 	=> $this->input->post('image_size_w_sc'), 
							'image_size_h' 	=> $this->input->post('image_size_h_sc') 
					);
	            $hasil = $this->M_data_master->update_mst_scoring($vkdktrpusat,$vkdproduk,$vkdidscore,$data);
	            if ($hasil) {
					$response['status']	= "2";
					$response['pesan']	= "Sukses : Rubah Data Master Scorecard.";
					echo json_encode($response);
				} else {
					$response['status']	= "1";
					$response['pesan']	= "Error : Rubah Data Master Scorecard.";
					echo json_encode($response);
				}
			} else {
				$response['status']	= "1";
				$response['pesan']	= "Error : Rubah Data Master Scorecard.";
				echo json_encode($response);
			}
		}
	}

// master lokasi di indonesia
	public function combo_data_kabupaten() {
		//if ($_SERVER['REQUEST_METHOD']==='POST') {
			$kdprovinsi = $this->input->post('kdprovinsi');
			$query = $this->M_data_master->data_master_kabupaten($kdprovinsi);
			foreach ($query->result() as $data) {
				$row=array();
				$row="<option value='".$data->kdkabupaten." - ".$data->namakabupaten."'>".$data->kdkabupaten." - ".$data->namakabupaten."</option>";
				$hasilrow[]=$row;
			}
			$response['data']="<option value=''>--- Pilih ---</option>";
			$response['data1']=$hasilrow;
			echo json_encode($response);
		//}
	}

}

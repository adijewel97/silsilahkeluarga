<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Silsilah extends CI_Controller{
	
    public function __construct(){
        parent::__construct();
        $this->load->helper('form');

        //lib pdf
       /* $this->load->library('fpdf17/fpdf');
        $this->load->library('map/googlemaps');*/
        
        $this->load->model('M_silsilah');
        $this->load->model('M_function_global');
        
        $logged_in = $this->session->userdata('user_login');
        if(!$logged_in){
            header("location: ".base_url());
        }
    }   

    function test(){
    	$master = $this->M_silsilah->get_master_parent();

    	print_r($master);
    	echo "<br/><br/><br/>";

    	$detail = $this->M_silsilah->get_master_child('1');
    	print_r($detail);
    	echo "/n";
    }
/*===================================================================================================================== */
    function get_parent(){
    	$master = $this->M_silsilah->get_master_parent();

    	echo json_encode($master);
    }

    function get_child(){
    	$id_parent = $this->uri->segment(3);

    	$detail = $this->M_silsilah->get_master_child($id_parent);

    	echo json_encode($detail);
    }
/*===================================================================================================================== */
    public function show_silislah_tree() {
        /*$response['status'] ="1";
    	$response['pesan']  ="Gagal : Tambah Data Silsilah.";
    	echo json_encode($response);*/
        if ($_SERVER['REQUEST_METHOD']==='POST') { 
            $query = $this->M_silsilah->get_silsilah_tree();
            $myarray['kelurga'] = $query;
        	echo json_encode($myarray);
        }
    }
/*===================================================================================================================== */
    public function data_show_table_keluarga() {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $query = $this->M_silsilah->get_silsilah_table_all();
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
                    //Tampilkan data di Grid
                    $id_vs_relasi = $data->id_child."|".$data->id_relasi;
                    $row=array();
                    if ($data->kelamin == 'L') {
                    	$kelamin = '<div class="text-center"><i stlye="width:9px; heigth:10px" class="fa fa-male"></i></div>';
                    } else {
                    	$kelamin = '<div class="text-center"><i class="fa fa-female"></i></div>';
                    }
                    $proc_sow = 'show_data_proses(2,"'.$id_vs_relasi.'")';
                    $row[]= " <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$kelamin." </a>";
	                $row[]= " <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$data->nama_view." </a>";
                    $row[]= " <div class='text-center'> <a href='javascript:void(0)' ".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$data->hidup." </a> </div>";
	                $row[]= " <div class='text-center'> <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".substr($data->tgl_lahir,0,4)." </a> </div>";
                    $dataarray[] = $row;
                	$no++;
            	}
                $output = array(
                    "data" => $dataarray,
                );
                echo json_encode($output);
            }
        }
    }

/*===================================================================================================================== */
    public function data_show_table_keluarga_all() {
        if ($_SERVER['REQUEST_METHOD']==='POST') {
            $query = $this->M_silsilah->get_silsilah_table_all();
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
                    //Tampilkan data di Grid
                    $id_vs_relasi = $data->id_child."|".$data->id_relasi;
                    $row=array();
                    //tampilkan foto
                    if ($data->foto_path != '') {
                    	$foto = '<div class="text-center"><img height="20" width="22" src="'.base_url().'arsip/images/fotoindvidu/'.$data->foto_path.'"></div>';
                    } else {
                    	$foto = ' <canvas id="myCanvas" width="20" height="22" style="border:1px solid #d3d3d3;"> </canvas>';
                    }
                    // jenis kelamin
                    if ($data->kelamin == 'L') {
                    	$kelamin = '<div class="text-center"><i class="fa fa-male"> (Laki-Laki)</i>   </div>';
                    } else {
                    	$kelamin = '<div class="text-center"><i class="fa fa-female"> (Perempuan)</i></div>';
                    }
                    // hidup atau meninggal dan 
                    // umur jika hidup sysdate - tgllahir else tgl meninggal - tgllahir
                    $thl	= date("Y",strtotime($data->tgl_lahir));
                    $thw	= date("Y",strtotime($data->tgl_wafat));
            		$thc	= date("Y");
                    if ($data->hidup == 1) {
                     	$hidup = '<input disabled="disabled" type="radio"  checked="checked" />'; 
                     	$umur  = $thc-$thl;
                    } else {
                    	$hidup = '<input disabled="disabled" type="radio"  />'; 
                    	if ( empty($thw) ) {
		                    $umur = $thc-$thl;
		            	} else {
		            		$umur = $thw-$thl;
		            	}
                    }
                    
                    $proc_sow = 'show_data_proses(2,"'.$id_vs_relasi.'")';
                    $row[]= " <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$foto." </a>";
	                $row[]= " <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$data->nama_view." </a>";
                    $row[]= " <div class='text-center'> <a href='javascript:void(0)' ".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$data->nama_depan." </a> </div>";
	                $row[]= " <div class='text-center'> <a href='javascript:void(0)' ".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$data->nama_belakang." </a> </div>";
	                $row[]= " <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$kelamin." </a>";
	                $row[]= " <div class='text-center'> <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$umur." </a> </div>";
	                $row[]= " <div class='text-center'> <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$data->tempat_lahir." </a> </div>";
	                $row[]= " <div class='text-center'> <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$data->tgl_lahir." </a> </div>";
	                $row[]= " <div class='text-center'> <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$data->tempat_wafat." </a> </div>";
	                $row[]= " <div class='text-center'> <a href='javascript:void(0)'".
	                        " onclick='".$proc_sow."' id='".$id_vs_relasi."'>".$data->tgl_wafat." </a> </div>";
	                $row[]= " <div class='text-center'> <a href='javascript:void(0)'".
	                        " id='".$id_vs_relasi."'>".$hidup." </a> </div>";
                    $dataarray[] = $row;
                	$no++;
            	}
                $output = array(
                    "data" => $dataarray,
                );
                echo json_encode($output);
            }
        }
    }

/*===================================================================================================================== */
    //buat label di kanan
    public function show_silislah_label_id() {
       /* $response['status'] ="1";
    	$response['pesan']  ="Gagal : Tambah Data Silsilah.";
    	echo json_encode($response);*/
        if ($_SERVER['REQUEST_METHOD']==='POST') { 
            $id_vs_relasi   = $this->input->post('id_vs_relasi');
            $query = $this->M_silsilah->get_silsilah_label_id($id_vs_relasi);
            foreach ($query->result() as $rows);
            $thl	= date("Y",strtotime($rows->tgl_lahir));
            $thw	= date("Y",strtotime($rows->tgl_wafat));
            $thc	= date("Y");
            if ($rows->hidup == 1) {
            	$umur = $thc-$thl;
            } else {
            	if ( empty($thw) ) {
                    $umur = $thc-$thl;
            	} else {
            		$umur = $thw-$thl;
            	}
            }

			$data =  array(
				'id_child'   		=> $rows->id_child,
				'id_parent'   		=> $rows->id_parent,
				'nama_view'   		=> $rows->nama_view,
				'id_relasi'   		=> $rows->id_relasi,
				'tgl_lahir'   		=> $this->M_function_global->sqltotgl($rows->tgl_lahir),
				'kelamin'   		=> $rows->kelamin,
				'foto_path'   		=> $rows->foto_path,
				'tempat_lahir'		=> $rows->tempat_lahir,
				'hidup'   			=> $rows->hidup,
				'tempat_wafat'		=> $rows->tempat_wafat,
				'tgl_wafat'   		=> $rows->tgl_wafat,
				'keterangan'   		=> $rows->keterangan,
				'tgl_wafat'   		=> $this->M_function_global->sqltotgl($rows->tgl_wafat),
				'nama_depan'   		=> $rows->nama_depan,
				'nama_belakang'     => $rows->nama_belakang,
				'umur'				=> $umur,
				'tgl_lahir_f'   	=> date("d/m/Y",strtotime($rows->tgl_lahir)),
				'foto_path'			=> $rows->foto_path,
				'kota_tinggal'		=> $rows->kota_tinggal
			);
			      
			echo json_encode($data);
        }
    }
/*===================================================================================================================== */
    public function show_silislah_detail_id() {
       /* $response['status'] ="1";
    	$response['pesan']  ="Gagal : Tambah Data Silsilah.";
    	echo json_encode($response);*/
        if ($_SERVER['REQUEST_METHOD']==='POST') { 
            $nikename   = $this->input->post('nikename');
            $query = $this->M_silsilah->get_silsilah_label_id($nikename);
            foreach ($query->result() as $rows);
			$data =  array(
				'id_child'   	=> $rows->id_child,
				'id_parent'   	=> $rows->id_parent,
				'nama_view'   	=> $rows->nama_view,
				'id_relasi'   	=> $rows->id_relasi,
				'tgl_lahir'   	=> $rows->tgl_lahir,
				'kelamin'   	=> $rows->kelamin,
				'foto_path'   	=> $rows->foto_path,
				'tempat_lahir'	=> $rows->tempat_lahir,
				'hidup'   		=> $rows->hidup,
				'tempat_meninggal'	=> $rows->tempat_meninggal,
				'tgl_meninggal'   	=> $rows->tgl_meninggal,
				'keterangan'   		=> $rows->keterangan
			);
			      
			echo json_encode($data);
        }
    }
/*===================================================================================================================== */
    public function simpan_silislah(){
    	
    	if ($_SERVER['REQUEST_METHOD']==='POST') {	
    		$n_proses  		= $this->input->post('n_proses');
    		$id 			= $this->input->post('v_id');
	    	$id_relasi    	= $this->input->post('v_id_relasi');
    		$my_id_parent	= $this->input->post('v_id_parent');
    		$v_parent       = $this->input->post('v_parent');
    		$id_vs_relasi	= $id."|".$id_relasi;
	    	$myerror = 'Sukses';

	    	$nama_view 		= $this->input->post('v_nama_view');
	    	$nama_depan 	= $this->input->post('v_nama_depan');
	    	$nama_belakang 	= $this->input->post('v_nama_belakang');
	    	$tempat_lahir 	= $this->input->post('v_tempat_lahir');
	    	$tgl_lahir 		= $this->M_function_global->tgltosql($this->input->post('v_tgl_lahir'));
	    	$tempat_wafat 	= $this->input->post('v_tempat_wafat');
	    	$tgl_wafat 		= $this->M_function_global->tgltosql($this->input->post('v_tgl_wafat'));
	    	$kelamin 		= $this->input->post('v_kelamin');
	    	$kota_tinggal 	= $this->input->post('v_kota_tinggal');
	    	//

	    	//ambil ttl lahir ortu
	    	$queryQ = $this->db->query(
                    			" 
	                    			select * from
										(
								          select nama_view, tgl_lahir,kelamin from trs_silsilah_detail where id_child = '$v_parent'
										  union
										  select nama_view, tgl_lahir,kelamin from trs_silsilah_detail where id_parent = '$v_parent' and id_relasi = '3'
										) a
									where kelamin = 'P' limit 1
                    			"
                 			);
	    	
	    	if ($queryQ->num_rows()>0) {
	    		foreach ($queryQ->result() as $rowsQ);
            	$ttl_ibu = $rowsQ->tgl_lahir;
	    		$th_lahir_ortu = substr($ttl_ibu,0,4);
	    		$th_lahir_anak = substr($tgl_lahir,0,4);
	    	} else {
	    		$ttl_ibu = '';
	    		$th_lahir_anak = substr($tgl_lahir,0,4);
	    	}
	    	
	    	/*var_dump("heloo : ".$ttl_ibu);
	    	die();*/   	


	    	if ( ( $n_proses == '2') || ( $n_proses == '1') ) {
		    	if ($nama_depan == '')  {
		    		$myerror = 'Error : Nama Depan, Tidak Boleh Kosong (Harus memiliki Nama).';
		    	}

		    	if ($nama_view == '')  {
		    		$myerror = 'Error : Nama Tampilan, Tidak Boleh Kosong.';
		    	}

		    	if ( $kota_tinggal == '' ){
		    		$myerror = 'Error : Nama kota Tinggal, Tidak Boleh Kosong.';
		    	}

		    	if ( ($ttl_ibu == '')  and (($id_relasi == 4) or ($id_relasi == 5) or ($id_relasi == 6)) ){
		    		$myerror = 'Error : Tidak Ditemukan ibu/Jenis Kelamin Ibu Salah Entry menjadi (P = Perempuan).';
		    	}

		    	if ( 
		    		 ($ttl_ibu != '')  
		    		 and (($id_relasi == 4) or ($id_relasi == 5) or ($id_relasi == 6)) 
		    		 and ($th_lahir_ortu > $th_lahir_anak)
		    		) {
		    		$myerror = 'Error : Tanggal Lahir Anak Tidak lebih Kecil dari Orang tua/Ibu.';
		    	}

		    } 

	    	if ( strtoupper(substr($myerror,0,5)) == 'ERROR'){
	    		$response['status'] ="1";
			    $response['pesan']  = $myerror;
			    echo json_encode($response);		
	    	} else {
// =========================================
	    		if ( $n_proses == '2') {
	    			if (isset($_POST['v_hidup'])) {
					    $hidup = 0;
					} else {
						$hidup = 1;
					}
		    		$data 	= array(
								'nama_view'		=> $nama_view,
								'nama_depan' 	=> $nama_depan, 
								'nama_belakang' => $nama_belakang,
								'tempat_lahir' 	=> $tempat_lahir, 
								'tgl_lahir' 	=> $tgl_lahir,
								'kelamin' 		=> $kelamin,
								'tempat_lahir' 	=> $tempat_lahir, 
								'tgl_lahir' 	=> $tgl_lahir,
								'tempat_wafat' 	=> $tempat_wafat, 
								'tgl_wafat' 	=> $tgl_wafat,
								'hidup' 		=> $hidup,
								'id_parent' 	=> $v_parent,
								'kota_tinggal'  => $kota_tinggal
							);

		    		$query  = $this->M_silsilah->get_silsilah_label_id($id_vs_relasi);
    				if ($query->num_rows()>0) {
			            $hasil = $this->M_silsilah->update_silsilah($id, $id_relasi, $data);
			            if ($hasil) {
							$response['status']	= "2";
							$response['pesan']	= "Sukses : Rubah Data Silsilah.";
						} else {
							$response['status'] ="1";
					    	$response['pesan']  ="Gagal : Rubah Data Silsilah.";
						}
					} else {
						$response['status'] ="1";
					    $response['pesan']  ="Gagal : Rubah Data Silsilah (Data Tidak ditemukan). ".$id_vs_relasi;
					}
					echo json_encode($response);
// =========================================
				} else if ( $n_proses == '1') {
					$data 	= [];
					if (isset($_POST['v_hidup'])) {
					    $hidup = 0;
					} else {
						$hidup = 1;
					}
					/*if ($id_relasi == '1') {*/
						$data 	= array(
							'id_parent'     => $v_parent,
							'id_relasi'     => $id_relasi,
							'nama_view'		=> $nama_view,
							'nama_depan' 	=> $nama_depan, 
							'nama_belakang' => $nama_belakang,
							'tempat_lahir' 	=> $tempat_lahir, 
							'tgl_lahir' 	=> $tgl_lahir,
							'kelamin' 		=> $kelamin,
							'tempat_lahir' 	=> $tempat_lahir, 
							'tgl_lahir' 	=> $tgl_lahir,
							'tempat_wafat' 	=> $tempat_wafat, 
							'tgl_wafat' 	=> $tgl_wafat,
							'hidup' 		=> $hidup,
							'kota_tinggal'  => $kota_tinggal
						);				
					/*} else {

					}*/

		    		$query  = $this->M_silsilah->get_silsilah_label_id($id_vs_relasi);
    				if ($query->num_rows()>0) {
    					$response['status'] ="1";
					    $response['pesan']  ="Gagal : Tambah Data Silsilah. (Data Sudah ada )";
					} else {
    					$hasil = $this->M_silsilah->insert_silsilah($data);
			            if ($hasil) {
							$response['status']	= "2";
							$response['pesan']	= "Sukses : Tambah Data Silsilah.";
						} else {
							$response['status'] ="1";
					    	$response['pesan']  ="Gagal : Tambah Data Silsilah.";
						}
					}
				    echo json_encode($response);
// =========================================
				} else if ( $n_proses == '3') {  				
    				$query  = $this->M_silsilah->get_silsilah_label_id($id_vs_relasi);
    				if ($query->num_rows()>0) {
    					$hasil = $this->M_silsilah->delete_silsilah($id, $id_relasi);
			            if ($hasil) {
							$response['status']	= "2";
							$response['pesan']	= "Sukses : Hapus Data Silsilah.";
						} else {
							$response['status'] ="1";
					    	$response['pesan']  ="Gagal : Hapus Data Silsilah.";
						}
					} else {
							$response['status'] ="1";
					    	$response['pesan']  ="Gagal : Hapus Data Silsilah (Data Tidak Ada).";
					}
					echo json_encode($response);
				}
			}
		}
    }
 /*===================================================================================================================== */
    public function simpan_silislah_foto(){    	
    	if ($_SERVER['REQUEST_METHOD']==='POST') {	
    		$n_proses  		= $this->input->post('n_proses');
    		$id 			= $this->input->post('v_id_f');
	    	$id_relasi    	= $this->input->post('v_id_relasi_f');
    		$my_id_parent	= $this->input->post('v_id_parent_f');
    		$id_vs_relasi	= $id."|".$id_relasi;
    		$foto_path      = '';
	    	$myerror = 'Sukses';

    		if ( $n_proses == '2') {
	    		$url = './'.$this->config->item("path_image_indivdu");
	            if (is_dir($url)<>'1') {
	                mkdir($url);
	            }

	    		$query = $this->M_silsilah->get_silsilah_label_id($id_vs_relasi);
                foreach ($query->result() as $row) { 
                      $nama_file_db    = $row->foto_path;
                }

                $nama_file       =  $id ."_".$id_relasi."_".date("His").'.jpg';               
                if ($_FILES['fileberkas']['name']) {
                    //Prosses upload file foto nasabah
                    $info = $this->upload_image_wh_syarat($url,$nama_file);
                    if ( strtoupper(substr($info,0,5)) == 'ERROR') {
                        $response['status'] ="1";
                        $response['pesan']  ="Gagal : Upload Foto Identitas : ".$info;
                        echo json_encode($response);
                        $data['foto_path'] = $nama_file_db;
                    } else {
                        if ((is_file($url.$nama_file_db) === true) || (is_link($url.$nama_file_db) === true)) {
		                      return unlink($url.$nama_file_db);
		                }
                        //unlink($url.$nama_file_db);
                        //unlink($url.'big/bg_'.$nama_file_db);
                        $hasil = $this->upload->data();
                        if ($hasil['client_name']) {
                            $data['foto_path'] = $nama_file;
                        }
                    }
                } else {
                    $data['foto_path'] = $nama_file_db;
                }

	    		$query  = $this->M_silsilah->get_silsilah_label_id($id_vs_relasi);
				if ($query->num_rows()>0) {
		            $hasil = $this->M_silsilah->update_silsilah($id, $id_relasi, $data);
		            if ($hasil) {
						$response['status']	= "2";
						$response['pesan']	= "Sukses : Rubah Data Foto.";
					} else {
						$response['status'] ="1";
				    	$response['pesan']  ="Gagal : Rubah Data Foto.";
					}
				} else {
					$response['status'] ="1";
				    $response['pesan']  ="Gagal : Rubah Data Foto (Data Tidak ditemukan). ";
				}
				echo json_encode($response);
			}
		}
	}

// ===================================================================================================================
    //Function untuk upload file ke server
    public function upload_image_wh_syarat($foldername, $nama_file) {
        //proses upload gambar
        $_FILES['userFile']['name']     = $_FILES['fileberkas']['name'];
        $_FILES['userFile']['type']     = $_FILES['fileberkas']['type'];
        $_FILES['userFile']['tmp_name'] = $_FILES['fileberkas']['tmp_name'];
        $_FILES['userFile']['error']    = $_FILES['fileberkas']['error'];
        $_FILES['userFile']['size']     = $_FILES['fileberkas']['size'];
        
        $url = './'.$foldername;
        if (is_dir($url)<>'1') {
            mkdir($url);
        }

        $path_image_foto = './'.$url;
        $config['file_name']       = $nama_file;
        $config['upload_path']     = $path_image_foto;
        //$config['allowed_types']   = 'gif|jpg|jpeg|png|zip|rar|doc|docx|xls|xlsx|csv|txt|pdf';
        $config['allowed_types']   = '*';
        //$config['overwrite']       = TRUE;
        $config['remove_spaces']   = FALSE;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        //$config['max_size'] = 2000;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->load->helper(array('form', 'url','file'));
       	
        //var_dump($this->upload->data());

       if ( ! $this->upload->do_upload('userFile')){
           // $this->session->set_flashdata('msg',$this->upload->display_errors());
            $info = 'Error  :'. $this->upload->display_errors();
        }
        else{        
            $hasil = $this->upload->data();
            if ($hasil['client_name']) {
                //$lokasi_file = $nama_file ;
                /*$lokasi_file = $url.$nama_file ;
                $im_src = imagecreatefromjpeg($lokasi_file);
                $src_width = imageSX($im_src);
                $src_height = imageSY($im_src);   

                //set ukuran gambar hasil perubahan
                $dst_width  = 64; //2480
                $dst_height = 66;
                $im = imagecreatetruecolor($dst_width,$dst_height);
                imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
                //Simpan gambar
                imagejpeg($im,$lokasi_file);
                imagedestroy($im);
                */

                //lokasi file besar
                $lokasi_file 	= $url.$nama_file ;
                $im_src 		= imagecreatefromjpeg($lokasi_file);
                $src_width 		= imageSX($im_src);
                $src_height 	= imageSY($im_src);
                $dst_width2  	= 300; //2480
                $dst_height2 	= 310;
                $im2 			= imagecreatetruecolor($dst_width2,$dst_height2);
                imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);
                //Simpan gambar
                imagejpeg($im2,$lokasi_file);

                imagedestroy($im_src);
                $info  = 'Sukses : Image Diupload ';
            }
        }
        return $info;
    }  

    public function combo_data_parent() {
		//if ($_SERVER['REQUEST_METHOD']==='POST') {
			$query = $this->M_silsilah->get_silsilah_detail_all();
			foreach ($query->result() as $data) {
				$row=array();
				$row="<option value='".$data->id_child."'>".$data->nama_view."</option>";
				$hasilrow[]=$row;
			}
			$response['data']  ="<option value=''>--- Pilih Ayah/Ibu ---</option>";
			$response['data1'] =$hasilrow;
			echo json_encode($response);
		//}
	}


}
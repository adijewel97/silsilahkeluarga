<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
class Manage_user extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        //$this->load->library('upload');
        $this->load->helper(array('form', 'url','file'));

        $this->load->model('M_data_manage_user');

        $logged_in = $this->session->userdata('user_login');
        if(!$logged_in){
            header("location: ".base_url());
        }
    } 

/*--------------------------------------------------------------------------------------------------------------------*/
// (1) User management
    public function show_data_user(){
        $userid     = $this->input->post('v_user');

        $query = $this->M_data_manage_user->data_user($userid); 
            foreach ($query->result() as $row);
            $data = array(
                    'user_id'   => $userid ,
                    'password'  => $row->password,
                    'kdunit'    => $row->kdunit,
                    'groups'    => $row->groups,
                    'nama'      => $row->nama,
                    'expire'    => $row->expire,
                    'useridkode'=> $row->useridkode
                );
            echo json_encode($data);        
    }

// ===================================================================================================================
	public function combo_groups_user(){
        $query = $this->M_data_manage_user->data_group_user();
        foreach ($query->result() as $data) {
            $row=array();
            $row="<option value='".$data->groups."'>".$data->groups."</option>";
            $hasilrow[]=$row;
        }
        $response['data1']=$hasilrow;
        echo json_encode($response);
    }

// ===================================================================================================================
    public function show_info_user(){
        $data['hasil'] = $this->M_data_manage_user->get_info_user(); 

        echo json_encode($data);
    }

// ===================================================================================================================
    public function update_user_password(){

        $groups_user        = $this->input->post('groups_user');
        if ( $groups_user == 'ADMIN') {
            $userid             = $this->input->post('userid');
        } else {
            $userid             = $this->input->post('userid_2');
        }        
        $kdunit_user        = $this->session->userdata('user_kdunit');
        $exist_groups_user  = $this->session->userdata('user_group');
        $vnama              = $this->input->post('nama_user');

        $password_l     = md5($this->input->post('password_lama'));
        $password_b     = md5($this->input->post('password_baru'));
        $password_bc    = md5($this->input->post('password_baru_cnf'));

        $my_namafoto    ='';
        $query  = $this->M_data_manage_user->check_password_db($userid);        
        foreach ($query->result() as $data_user);
        $userid_db      = $data_user->user_id;
        $password_db    = $data_user->password;
        $groups_db      = $data_user->groups;
        $kdunit_db      = $data_user->kdunit;
        $nama_file_db   = $data_user->foto_path;        

        if ($this->input->post('expire_user') == 'on') {
            $validasi = 0;
        } else { $validasi = 1; }

        if ( trim($exist_groups_user) == '' ) { $v_groups_user = $groups; }

        if ( trim($exist_groups_user) != "ADMIN") {
            $mygroups_user =  $groups;
            $mykdunit_user =  $kdunit_db;
            $validasi = 0;
        } else {
            $mygroups_user = $this->input->post('groups_user');
            $mykdunit_user = "110101";//$this->input->post('kdunit_user');
        }       
        

//---------------------------------------------------------
        //begin upload foto user
        $url = './'.$this->config->item("path_image_users");
        if (is_dir($url)<>'1') {
            mkdir($url);
        }

        $nama_file       =  trim($userid).'_'.date("His").'.jpg';               
        if ($_FILES['fileberkas']['name']) {
            //Prosses upload file foto nasabah
            $info = $this->upload_image_user($url,$nama_file);
            if ( strtoupper(substr($info,0,5)) == 'ERROR') {
                $response['status'] ="1";
                $response['pesan']  ="Gagal : Upload Foto Identitas : ".$info;
                echo json_encode($response);
                $my_namafoto = $nama_file_db;
            } else {
                if ((is_file($url.$nama_file_db) === true) || (is_link($url.$nama_file_db) === true)) {
                      return unlink($url.$nama_file_db);
                }
                $hasil = $this->upload->data();
                if ($hasil['client_name']) {
                    $my_namafoto = $nama_file;
                }
            }
        } else {
                 $my_namafoto = $nama_file_db;
        }
//---------------------------------------------------------
        //end upload foto user

                             
        if ( trim($exist_groups_user) != "ADMIN") {
            if ($password_db != $password_l) {
                $response['status'] = "1";
                $response['pesan']  = "Error: Group User ".$exist_groups_user.", Masukan Password Lama Salah.".$password_db."--".$password_l."--".$userid ;
                echo json_encode($response);  
            } else {
                if ($password_b != $password_bc) {
                    $response['status'] = "1";
                    $response['pesan']  = "Error: chek Password Baru dengan Password Baru (ulang), Tidak Sama.";
                    echo json_encode($response); 
                } else {
                    if ($password_b == 'd41d8cd98f00b204e9800998ecf8427e' || $password_bc == 'd41d8cd98f00b204e9800998ecf8427e') {
                        $response['status'] = "1";
                        $response['pesan']  = "Error: chek Password Baru dengan Password Baru (ulang), Tidak Sama.";
                        echo json_encode($response);
                    } else {
                        if ( $mykdunit_user == '') {
                            $response['status'] = "1";
                            $response['pesan']  = "Error: Master Kantor Cabang User Bekerja, Masih Kosong (Hub. Admin) !";
                            echo json_encode($response);
                        }  else {
                            $data['foto_path'] = $my_namafoto;
                            $hasil  = $this->M_data_manage_user->update_password_db($userid, $data);
                            if ($hasil) {
                                $sess  = array('user_id'        => $userid,
                                               'user_password'  => $password_b ,
                                               'user_kdunit'    => $mykdunit_user,
                                               'user_group'     => $mygroups_user,
                                               'user_name'      => $this->input->post('nama_user'),
                                               'user_expire'    => $validasi,
                                               'user_path'      => $my_namafoto,
                                               'user_login'     => ture
                                        );
                                $this->session->set_userdata($sess);
                                $response['status'] = "2";
                                $response['pesan']  = "Sukses: Berhasil Reset Password, Silahkan coba Login.";
                                echo json_encode($response);
                            } else {
                                $response['status'] = "1";
                                $response['pesan']  = "Error: Reset Password ! ";
                            }
                        }
                    }                            
                }
            }
        } else { 
            if ($password_b  == 'd41d8cd98f00b204e9800998ecf8427e' || $password_bc == 'd41d8cd98f00b204e9800998ecf8427e') {
                    $response['status'] = "1";
                    $response['pesan']  = "Error: Password Baru dan Password Baru (ulang), Masih kosong !";
                    echo json_encode($response);
            } else { 
                if ( $mykdunit_user == '') {
                    $response['status'] = "1";
                    $response['pesan']  = "Error: Master Kantor Cabang User Bekerja, Masih Kosong.";
                    echo json_encode($response);
                }  else {
                    $data       = array (
                                    'password'      => $password_b,
                                    'kdunit'        => $mykdunit_user,
                                    'groups'        => $mygroups_user,
                                    'expire'        => $validasi,
                                    'nama'          => $vnama,
                                    'useridkode'    => "1",
                                    'foto_path'     => $my_namafoto
                                );
                    /*print_r($data);
                    die();*/
                    $hasil  = $this->M_data_manage_user->update_password_db($userid, $data);
                    if ($hasil) {                        
                        $sess  = array('user_id'        => $userid,
                                       'user_password'  => $password_b ,
                                       'user_kdunit'    => $mykdunit_user,
                                       'user_group'     => $mygroups_user,
                                       'user_name'      => $this->input->post('nama_user'),
                                       'user_expire'    => $validasi,
                                       'user_path'      => $my_namafoto,
                                       'user_login'     => ture
                                );
                        $this->session->set_userdata($sess);
                        $response['status'] = "2";
                        $response['pesan']  = "Sukses: Berhasil Reset Password, Silahkan coba Login.";
                        echo json_encode($response);
                    } else {
                        $response['status'] = "1";
                        $response['pesan']  = "Error: Reset Password ! ";
                        echo json_encode($response);
                    }
                }
            }                        
        }
    }

// ===================================================================================================================
     public function create_new_user(){
        $userid         = $this->input->post('v_user');
        $groups_user    = $this->input->post('groups_user');
        $kdunit_user    = $this->input->post('kdunit_user');
        $password_l     = md5($this->input->post('password_l'));
        $password_b     = md5($this->input->post('password_b'));
        $password_bc    = md5($this->input->post('password_bc'));
        $useridkode     = $this->input->post('useridkode');

        $query  = $this->M_data_manage_user->check_password_db($userid);
        foreach ($query as $data);
        $user_id_db        = $data->user_id;
        $password_db       = $data->password;
        $groups_db         = $data->groups;
        $kdunit_db         = $data->kdunit;
        $nama_db           = $data->nama;


        $query_kduser  = $this->M_data_manage_user->check_useridkode_db($useridkode);
        foreach ($query_kduser as $data_kduser);
        $useridkode_db        = $data_kduser->useridkode;
        $namauseridkode_db    = $data_kduser->nama;

        $userid_in = $this->input->post('userid');
        /*if ( $useridkode_db != '') {
                $response['status'] = "2";
                $response['pesan']  = "Error: Kode User Tersebut Tudah Terdaftar  : ( ".$namauseridkode_db." - ".$useridkode." ). ";
                echo json_encode($response);
        }
        else*/
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
                $myuserid_user = $this->input->post('userid');
                $mykdunit_user = "110101"; //$this->input->post('kdunit_user');
                $mygroups_user = $this->input->post('groups_user');
                $mynama_user   = $this->input->post('nama_user');
                if ($this->input->post('expire_user') == 'on') {
                    $validasi = 0;
                } else { $validasi = 1; }

                $data       = array (
                    'user_id'       => $myuserid_user,
                    'password'      => $password_b,
                    'kdunit'        => $mykdunit_user,
                    'groups'        => $mygroups_user,
                    'expire'        => $validasi,
                    'nama'          => $mynama_user,
                    'useridkode'    =>  "1" //$useridkode
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
                        $response['pesan']  = "Sukses: Buat User ID Baru atas nama : ".$mynama_user;
                        echo json_encode($response);
                    } else {
                        $response['status'] = "1";
                        $response['pesan']  = "Error: Buat User ID Baru atas nama : ".$mynama_user;
                        echo json_encode($response);
                    }
                } 
            }
        }     
    } 

/*--------------------------------------------------------------------------------------------------------------------*/
// (2) User Group
    public function show_data_list_menu(){
        $v_groups = $this->input->post('v_groups');

        $query = $this->M_data_manage_user->data_master_listmenu($v_groups);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $row=array();
                $row[]          = $data->noitem;
                $row[]          = $data->item;
                $dataarray_list[]    = $row;
            }
        } else {
            $row=array();
            $row[]          = "";
            $row[]          = "";
            $dataarray_list[]    = $row;
        }      
        $output_list = array(
            "data" => $dataarray_list,
        );
        echo json_encode($output_list);
    }   

// ===================================================================================================================
    public function show_data_list_menu_groups(){
        $v_groups = $this->input->post('v_groups');

        $query = $this->M_data_manage_user->data_master_listmenu_groups($v_groups);
         if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $row=array();
                $row[]          = $data->noitem;
                $row[]          = $data->item;
                $dataarray_group[]    = $row;
            }
        } else {
            $row=array();
            $row[]          = "";
            $row[]          = "";
            $dataarray_group[]    = $row;
        }      
        $output_group = array(
            "data" => $dataarray_group,
        );
        echo json_encode($output_group);
    } 

// ===================================================================================================================
    public function insert_user_groups(){
        $vnoitem = $this->input->post('vnoitem');
        $vgroups = $this->input->post('vgroups');

        $hasil = $this->M_data_manage_user->insert_data_groups($vnoitem, $vgroups);
        if ($hasil) {
            $response['status'] = "2";
            $response['pesan']  = "Sukses: Tambah Item Groups !";
            echo json_encode($response);
        } else {
            $response['status'] = "1";
            $response['pesan']  = "Error: Tambah Item Groups !";
            echo json_encode($response);
        }
    }

// ===================================================================================================================
    public function hapus_user_groups(){
        $vnoitem = $this->input->post('vnoitem');
        $vgroups = $this->input->post('vgroups');

        $hasil = $this->M_data_manage_user->delete_data_groups($vnoitem, $vgroups);
        if ($hasil) {
            $response['status'] = "2";
            $response['pesan']  = "Sukses: Hapus Item Groups !";
            echo json_encode($response);
        } else {
            $response['status'] = "1";
            $response['pesan']  = "Error: Hapus Item Groups !";
            echo json_encode($response);
        }
    }
// ===================================================================================================================
    //Function untuk upload file ke server
    public function upload_image_user($foldername, $nama_file) {
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
                $lokasi_file    = $url.$nama_file ;
                $im_src         = imagecreatefromjpeg($lokasi_file);
                $src_width      = imageSX($im_src);
                $src_height     = imageSY($im_src);
                $dst_width2     = 300; //2480
                $dst_height2    = 310;
                $im2            = imagecreatetruecolor($dst_width2,$dst_height2);
                imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);
                //Simpan gambar
                imagejpeg($im2,$lokasi_file);

                imagedestroy($im_src);
                $info  = 'Sukses : Image Diupload ';
            }
        }
        return $info;
    } 

}
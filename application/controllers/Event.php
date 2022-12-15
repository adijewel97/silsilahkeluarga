<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
/* ====================================================================================================================== */	
	public function __construct(){
        parent::__construct();
        $this->load->helper('form');

        //lib pdf
       /* $this->load->library('fpdf17/fpdf');
        $this->load->library('map/googlemaps');*/
        
        $this->load->model('M_event');
        $this->load->model('M_function_global');
        
        $logged_in = $this->session->userdata('user_login');
        if(!$logged_in){
            header("location: ".base_url());
        }
    }  

// --------------------------------------------------------------------------------------------------
//  Show foto event table
// --------------------------------------------------------------------------------------------------
	public function event_list(){	
        $query      = $this->M_event->get_data_event() ;
        $query      = $query->result();
        if (empty($query)) {
             $output = array(
                "data" => [],
            );
            echo json_encode($output);
        } else {
            $no=1;
            foreach ($query as $data) {                                     
                /*if ($no == 1) {
                    show_data_event_detail("'.$data->idevent.'","'.$data->tglevent.'");
                }*/

                $myproc_edit     = 'show_data_event_detail("'.$data->idevent.'","'.$data->tglevent.'")';
                $row=array();                 
                $row[]= "<a href='javascript:void(0)' onclick='". $myproc_edit."' > ".
                        "<div class='mail_list'>".
                        "  <div class='left'>".
                        "    <i class='fa fa-circle'></i> <i class='fa fa-edit'></i>".
                        "  </div>".
                        "  <div class='right'>".
                        "    <h3>".$data->judulevent." </h3>". //<small> (".$data->lokasi.") </small>
                        "<img src='".base_url("arsip/images/event/".$data->tglkejadian."_".$data->idevent."/".
                            $data->pathfoto)."' alt='...' style='width: 180px; height: 100px'> <br/>".
                        "    <p align='justify' >".$data->uraian."</p>".
                        "  </div>".
                        "</div>".
                        "</a> <br/>";  
                $dataarray[] = $row;
                $no++;
            }
            $output = array(
                "data" => $dataarray,
            );
            echo json_encode($output);
        }
        /*$response['status'] ="1";
        $response['pesan']  ="Gagal : Edit Data Nasabah.";
        echo json_encode($response);*/
    }

// --------------------------------------------------------------------------------------------------
//  Show foto event form
// --------------------------------------------------------------------------------------------------
    public function event_list_detail_data_show(){
        $idevent     = $this->input->post('idevent');
        $tglevent    = $this->input->post('tglevent');

        
        //data event foto id
        $code_foto1a  = '';       $code_foto1b = '';
        $code_foto2a  = '';       $code_foto2b = '';

        $query_foto = $this->M_event->get_data_event_byid_foto($idevent,$tglevent);
        if ($query_foto->num_rows() > 0) {
            $no = 1;
            /*$code_foto1a  = '';       $code_foto1b = '';
            $code_foto2a  = '';       $code_foto2b = '';*/

            foreach ($query_foto->result() as $rows_foto) {
                //echo $rows_foto->pathfoto;
                if ($no == 1) {
                    $code_foto1a= 
                        '              <div class="product-image" id="fotoutama">'.
                        '                <img src="'. base_url('arsip/images/event/'.$tglevent.'_'.$idevent.
                        '/'.$rows_foto->pathfoto).'"  alt="..."/>'.
                        '              </div>';
                    $code_foto1b .= $code_foto1a;
                }

                $pathpoto_all = base_url('arsip/images/event/'.$tglevent.'_'.$idevent.
                    '/'.$rows_foto->pathfoto);
                $pathpoto_all_click = "show_data_event_detail_foto_utama('".$pathpoto_all."')";
                $code_foto2a =
                    '                <a href="javascript:void(0)" onclick="'. $pathpoto_all_click.'" >'.
                    '                  <img src="'. $pathpoto_all .'"  alt="..." style="width: 98px; height: 74px" />'.
                    '                </a>';
                $code_foto2b .= $code_foto2a;

                $no++;
            }


        }
       
       //data All event
        $query = $this->M_event->get_data_event_byid($idevent,$tglevent);
        $response  = [];
        $temp_html = '';
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                /*$data = array(
                    'judulevent'       => $rows->judulevent,
                    'tglkejadian'      => date('d M Y',strtotime($rows->tglkejadian)),
                    'lokasi'           => $rows->lokasi,
                    'peserta'          => $rows->peserta,
                    'uraian'           => $rows->uraian,
                    'pathfoto'         => $rows->pathfoto,
                );*/
                // Ulasan Event Keluarga yg di klik
                $temp_html    =
                      '    <div class="inbox-body">'.
                      '      <div class="mail_heading row">'.
                      '        <div class="col-md-12">'.
                      '          <h4>'. $rows->judulevent .'</h4>'.
                      '        </div>'.
                      '      </div>'.
                      '      <div class="view-mail">'.
                      '          <div class="x_content">'.
                      '            <div class="col-md-7 col-sm-7 col-xs-12">'.
                      //fote begin
                      //$code_foto1b.
                      '              <div class="product-image">'.$code_foto1b.
                      '              </div>'.
                      '              <div class="product_gallery">'.$code_foto2b.
                      // foto end
                      '              </div>'.
                      '            </div>'.
                      '             <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">'.
                      '              <h3 class="prod_title">Ulasan Event Keluarga</h3>'.
                      '              <br/>'.
                      '              <h4><i class="fa fa-bug"> </i> '. $rows->judulevent.'</h4>'.                
                      '              <p><p align="justify" style="margin-left: 20px;">'. $rows->uraian.'</p>'.
                      '              <br />'.
                      '              </p>'.                
                      '               <div class="">'.
                      '                <h4><i class="fa fa-bug"> </i> Lokasi Event </h4>'.
                      '                 <p style="margin-left: 20px;"> '.$rows->lokasi.'</p>'.
                      '              </div>'.
                      '              <br />'.                
                      '              <div class="">'.
                      '                <h4><i class="fa fa-bug"> </i> Tanggal Event </h4>'.
                      '                 <p style="margin-left: 20px;">'. date('d M Y',strtotime($rows->tglkejadian)).'</p>'.
                      '              <br />'.
                      '              </div>'.
                      '              <div class="">'.
                      '                <h2><i class="fa fa-bug"> </i> Peserta </h2>'.
                      '                 <p style="margin-left: 20px;">'.$rows->peserta.'</p>'.
                      '                 <p> </p>'.
                      '              </div>'.
                      '              <br />'.
                      '          </div>'.
                      '      </div>'.                
                      '      <br/>'.
                      '      Event Command : '.
                      '      <br/>';
//----------------------------------------------------------------------
// begin chat
             $temp_html .= 
                        '      <ul class="messages">';
                      
                      $my_chat = $this->M_event->get_event_chat_data_id($idevent,$tglevent);
                      foreach ($my_chat->result() as $rows_chat) {
                        # code...
                        //$pathpoto_all_click = "show_data_event_detail_foto_utama('".$pathpoto_all."')";

                        $myproc_proses   = "proses_data_event_detail_chat('3','".$rows_chat->idevent."','".$rows_chat->tglevent.
                                            "','".$rows_chat->userchat."','".$rows_chat->tgljamchat."')";

                        $temp_html .= 
                        '        <li>'.
                        '          <img src="'. base_url('arsip/images/users/'.$rows_chat->foto_path) .'" class="avatar" alt="Avatar">'.
                        '          <div class="message_date">'.
                        '            <h3 class="date text-info">'.date('d',strtotime($rows_chat->tgljamchat)).'</h3>'.
                        '            <p class="month">'.date('M',strtotime($rows_chat->tgljamchat)).'</p>'.
                        '          </div>'.
                        '          <div class="message_wrapper">'.
                        '              <h2 class="heading" > <b>'.
                                        $rows_chat->userchat .
                        '             </b><a href="javascript:void(0)" onclick ="'.$myproc_proses.'"> <small> Delete </small> </a> </h2> '.
                        //<a href='javascript:void(0)' class='btn btn-xs btn-primary' title='Edit' onclick='".$myproc_show."'>
                        '             <span>'. $rows_chat->uraianchat .'</span>'.
                        '            <br />'.
                        '        </li>';
                      }
            
            $temp_html .= 
                       '      </ul>';
// end chat
//----------------------------------------------------------------------                                    
            $myproc_proses_ins   = "proses_data_event_detail_chat('1','".$idevent."','".$tglevent.
                                            "','".$this->session->userdata('user_id')."','".date('Y-m-d H:i:s')."')";
            $temp_html  .= 
                      '      <div class="col-md-10">'.
                      '          <textarea rows = "4" id="chat_message" name="chat_message" class="resizable_textarea form-control" placeholder="Send Command"></textarea>'.
                      '      </div>'.
                      '      <div class="col-md-2">'.
                      '        <span class="input-group-btn">'.
                      '          <button class="btn btn-primary" onclick = "'.$myproc_proses_ins.';" >Send</button>'.
                      '        </span>'.
                      '      </div>';
            }
        }

        //$response['code_html'] = "<div> hello </div>";
        $response['code_html'] = $temp_html;
        echo json_encode($response);
    }

// --------------------------------------------------------------------------------------------------
//  Show foto event data sysdate / event terakhir
// --------------------------------------------------------------------------------------------------
    public function show_event_last_data(){
        $query = $this->M_event->get_event_last_data();
        $data = [];
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data = array(
                    'tglevent'          => $rows->tglevent,
                    'idevent'           => $rows->idevent
                );
            }
        }         
        echo json_encode($data);        
    }

// --------------------------------------------------------------------------------------------------
//  Show event ke form
// --------------------------------------------------------------------------------------------------
    public function show_event_form_data(){
        $idevent     = $this->input->post('idevent');
        $tglevent    = $this->input->post('tglevent');

        $query = $this->M_event->get_event_form_data($idevent,$tglevent);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data = array(
                    'tglevent'          => $this->M_function_global->sqltotgl($rows->tglevent),
                    'idevent'           => $rows->idevent,
                    'judulevent'        => $rows->judulevent,
                    'tglkejadian'       =>  $this->M_function_global->sqltotgl($rows->tglkejadian),
                    'lokasi'            => $rows->lokasi,
                    'peserta'           => $rows->peserta,
                    'uraian'            => $rows->uraian
                );
            }
        } else { $data = [];}        
        echo json_encode($data);        
    }

// --------------------------------------------------------------------------------------------------
//  Show foto detail event ke table
// --------------------------------------------------------------------------------------------------
  public function event_list_foto_all(){ 
        $idevent     = $this->input->post('idevent');
        $tglevent    = $this->input->post('tglevent');

        $query      = $this->M_event->get_event_fotoall_data($idevent,$tglevent) ;
        $query      = $query->result();
        if (empty($query)) {
             $output = array(
                "data" => [],
            );
            echo json_encode($output);
        } else {
            $no=1;
            foreach ($query as $data) {                                     
               

                $myproc_show     = 'show_data_event_detail_foto("'.$data->idevent.'","'.$data->tglevent.
                                   '","'.$data->urutfoto.'")';
                $myproc_proses   = 'hapus_data_event_detail_foto("3","'.$data->idevent.'","'.$data->tglevent.
                                   '","'.$data->urutfoto.'")';
                if ($data->pathfoto != '') {
                  $foto = '<div class="text-center"><img height="20" width="22" src="'.base_url().'arsip/images/event/'.
                          $data->tglevent."_".$data->idevent."/".$data->pathfoto.'" ></div>';
                } else {
                  $foto = ' <canvas id="myCanvas" width="20" height="22" style="border:1px solid #d3d3d3;"> </canvas>';
                }

                $row=array();                 
                $row[] = " <a href='javascript:void(0)'".
                          " onclick='".$myproc_show."' id='".$data->idevent.'","'.$data->tglevent.
                                   '","'.$data->urutfoto."'>".$foto." </a>";
                $row[] = '<div class="text-center">'. $no .'</div>';
                $row[] = $data->pathfoto;
                /*$row[] = $data->uraianfoto;*/
                $row[] = "<center> <a href='javascript:void(0)' class='btn btn-xs btn-primary' title='Edit' onclick='".
                           $myproc_show."'><i class='fa fa-edit fa-fw'></i> </a> <a href='javascript:void(0)'' class='btn btn-xs btn-danger' title='Hapus' onclick='".
                           $myproc_proses."' id='110101'><i class='fa fa-trash-o fa-fw'></i></a> </center>";
                $dataarray[] = $row;
                $no++;
            }
            $output = array(
                "data" => $dataarray,
            );
            echo json_encode($output);
        }
        /*$response['status'] ="1";
        $response['pesan']  ="Gagal : Edit Data Nasabah.";
        echo json_encode($response);*/
    }

// --------------------------------------------------------------------------------------------------
// membuat Numbur urut / seqwent
// --------------------------------------------------------------------------------------------------
    public function show_seq_idevent_data(){
        $notran   = $this->M_event->getseqidevent();
        $idevent  = $notran->seq_next;         
        $data     = array(
                    'idevent_new' => $idevent 
                  );
        echo json_encode($data);        
    }

// --------------------------------------------------------------------------------------------------
//  Show foto detail event ke form curent click
// --------------------------------------------------------------------------------------------------
    public function show_event_form_data_foto(){
        $idevent     = $this->input->post('idevent');
        $tglevent    = $this->input->post('tglevent');
        $urutfoto    = $this->input->post('urutfoto');
     
        $query = $this->M_event->get_event_foto_data($idevent,$tglevent,$urutfoto);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data = array(
                    'tglevent'          => $rows->tglevent,
                    'idevent'           => $rows->idevent,
                    'urutfoto'          => $rows->urutfoto,
                    'pathfoto'          => $rows->pathfoto,
                    'uraianfoto'        => $rows->uraianfoto
                );
            }
        }         
        echo json_encode($data);        
    }

// --------------------------------------------------------------------------------------------------
//  Proses foto event
// --------------------------------------------------------------------------------------------------
    public function simpan_event(){
      $vproses        = $this->input->post('n_proses');
      $videvent       = $this->input->post('idevent');
      $vtglevent      = $this->M_function_global->tgltosql($this->input->post('tglevent'));
      if ( ($vproses == 1) ||  ($vproses == 2) ) {
        $vjudulevent    = $this->input->post('judulevent');
        $vtglkejadian   = $this->M_function_global->tgltosql($this->input->post('tglkejadian'));  
        $vlokasi        = $this->input->post('lokasi');
        $vpeserta       = $this->input->post('peserta');
        $vuraianevent   = $this->input->post('uraianevent'); 
      }   

      $query =  $this->M_event->get_event_form_data($videvent,$vtglevent);    
      if ($vproses == 1) {
         if ($query->num_rows() > 0){
              $data   = array (
                                'judulevent'  => $vjudulevent,
                                'tglkejadian' => $vtglkejadian, 
                                'lokasi'      => $vlokasi, 
                                'peserta'     => $vpeserta, 
                                'uraian'      => $vuraianevent
                        );
              $hasil  = $this->M_event->update_event_form_data($videvent,$vtglevent,$data);
              if ($hasil) {
                  $response['status'] = "2";
                  $response['pesan']  = "Sukses : Enrty Data Event.";  
                } else {
                  $response['status'] = "1";
                  $response['pesan']  = "Gagal : Enrty Data Event.";
                }
          } else {
             $data   = array (
                              'tglevent'    =>  date("Y-m-d"),
                              'judulevent'  => $vjudulevent,
                              'tglkejadian' => $vtglkejadian, 
                              'lokasi'      => $vlokasi, 
                              'peserta'     => $vpeserta, 
                              'uraian'      => $vuraianevent
                      );
              $hasil  = $this->M_event->insert_event_form_data($data);
              if ($hasil) {
                $response['status'] = "2";
                $response['pesan']  = "Sukses : Tambah Data Event.";  
              } else {
                $response['status'] = "1";
                $response['pesan']  = "Gagal : Tambah Data Event.";
              }
          }          
      } else if ($vproses == 2) {
          if ($query->num_rows()>0) {
              $data   = array (
                                'judulevent'  => $vjudulevent,
                                'tglkejadian' => $vtglkejadian, 
                                'lokasi'      => $vlokasi, 
                                'peserta'     => $vpeserta, 
                                'uraian'      => $vuraianevent
                        );
              $hasil  = $this->M_event->update_event_form_data($videvent,$vtglevent,$data);
              if ($hasil) {
                  $response['status'] = "2";
                  $response['pesan']  = "Sukses : Rubah Data Event.";  
                } else {
                  $response['status'] = "1";
                  $response['pesan']  = "Gagal : Rubah Data Event.";
                }
          } else {
              $response['status'] = "1";
              $response['pesan']  = "Gagal : Rubah Data Event, (Data Tidak Ditemukan).";
          }          
      } else if ($vproses == 3) {
        // 1) delete folder foto
          $path_id    = $vtglevent."_".$videvent;
          $url        = './'.$this->config->item("path_image_event").$path_id;
          $this->delete_pathfile($url);
        // 2) delete database table foto event all by id
          $hasilfoto  = $this->M_event->delete_event_all_data_foto($videvent,$vtglevent);
        // 3) hapus all chating table            
          $hasilchat  = $this->M_event->delete_event_all_data_chat($videvent,$vtglevent);
        // 4) hapus event main
          $hasilmain  = $this->M_event->delete_event_form_data($videvent,$vtglevent);
          if ($hasilmain) {
            $response['status'] = "2";
            $response['pesan']  = "Sukses : Hapus Data Event Utama.";  
          } else {
            $response['status'] = "1";
            $response['pesan']  = "Gagal : Hapus Data Event Utama.";
          }          
      }
      echo json_encode($response);
    }

// --------------------------------------------------------------------------------------------------
//  Proses foto detail event
// --------------------------------------------------------------------------------------------------
    public function simpan_event_foto(){
      $vproses        = $this->input->post('n_proses');
      $videvent       = $this->input->post('n_idevent');
      $vtglevent      = $this->M_function_global->tgltosql($this->input->post('n_tglevent'));

      $vurutfoto      = $this->input->post('urutfoto');
      $vuraianfoto    = $this->input->post('uraianfoto');
      //chek trs_event
      $query =  $this->M_event->get_event_form_data($videvent,$vtglevent);    
      if ($vproses == 1) {
          if ($query->num_rows() == 0){
            $data   = array (
                          'idevent'     => $videvent,
                          'tglevent'    => $vtglevent
                        );
            $hasil = $this->M_event->insert_event_form_data($data);
          } 
          //chek foto detail
          $query_foto  = $this->M_event->get_event_foto_data($videvent,$vtglevent,$vurutfoto);
          if ( $query_foto->num_rows() > 0) {
              $response['status'] ="1";
              $response['pesan']  ="Gagal : Tambah Foto (No Urut Foto Sudah Ada).";
          } else {
              // upload file foto event
              $path_id = $vtglevent."_".$videvent."/";
              $url = './'.$this->config->item("path_image_event").$path_id;
              if (is_dir($url)<>'1') {
                  mkdir($url);
              }

              $nama_file       =   $vtglevent."_".$videvent."_".$vurutfoto."_".date("His").'.jpg';               
              if ($_FILES['file_fotoevent']['name']) {
                  //Prosses upload file foto nasabah
                  $info = $this->upload_image_wh_foto_event($url,$nama_file);
                  if ( strtoupper(substr($info,0,5)) == 'ERROR') {
                      $response['status'] ="1";
                      $response['pesan']  ="Gagal : Upload Foto Identitas : ".$info;
                      $myfoto_path = $nama_file_db;
                  } else {                        
                      $hasil = $this->upload->data();
                      if ($hasil['client_name']) {
                          $myfoto_path = $nama_file;
                      }
                  }
              } 

              //update db
              $data_foto   = array (
                              'idevent'       => $videvent,
                              'tglevent'      => $vtglevent,
                              'urutfoto'      => $vurutfoto,
                              'uraianfoto'    => $vuraianfoto,
                              'pathfoto'      => $myfoto_path
                            );
              $hasil_foto = $this->M_event->insert_event_form_data_foto($data_foto);
              if ($hasil_foto) {
                  $response['status'] = "2";
                  $response['pesan']  = "Sukses : Tambah Data Event Foto.";
              } else {
                  $response['status'] = "1";
                  $response['pesan']  = "Gagal : Tambah Data Event Foto.";
              }          
          }
      } else if ($vproses == 2) {
          // upload file foto event
          $path_id = $vtglevent."_".$videvent."/";
          $url = './'.$this->config->item("path_image_event").$path_id;
          if (is_dir($url)<>'1') {
              mkdir($url);
          }

          $query = $this->M_event->get_event_foto_data($videvent,$vtglevent,$vurutfoto);
          foreach ($query->result() as $row) { 
                $nama_file_db    = $row->pathfoto;
          }

          $nama_file       =   $vtglevent."_".$videvent."_".$vurutfoto."_".date("His").'.jpg';               
          if ($_FILES['file_fotoevent']['name']) {
              //Prosses upload file foto nasabah
              $info = $this->upload_image_wh_foto_event($url,$nama_file);
              if ( strtoupper(substr($info,0,5)) == 'ERROR') {
                  $response['status'] ="1";
                  $response['pesan']  ="Gagal : Upload Foto Identitas : ".$info;
                  $myfoto_path = $nama_file_db;
              } else {                  
                  if ((is_file($url.$nama_file_db) === true) || (is_link($url.$nama_file_db) === true)) {
                      return unlink($url.$nama_file_db);
                  }
                  $hasil = $this->upload->data();
                  if ($hasil['client_name']) {
                      $myfoto_path = $nama_file;
                  }
              }
          } else {
              $myfoto_path = $nama_file_db;
          }

          //update db
          $data_foto   = array (
                          'uraianfoto'    => $vuraianfoto,
                          'pathfoto'      => $myfoto_path
                        );
          $hasil_foto = $this->M_event->update_event_form_data_foto($videvent,$vtglevent,$vurutfoto,$data_foto);
          if ($hasil_foto) {
              $response['status'] = "2";
              $response['pesan']  = "Sukses : Rubah Data Event Foto.";
          } else {
              $response['status'] = "1";
              $response['pesan']  = "Gagal : Rubah Data Event Foto.";
          }  
      } else if ($vproses == 3) {
          $nama_file_db    = '';
          $query = $this->M_event->get_event_foto_data($videvent,$vtglevent,$vurutfoto);
          foreach ($query->result() as $row) { 
                $nama_file_db    = $row->pathfoto;
          }

          $path_id = $vtglevent."_".$videvent."/";
          $url = './'.$this->config->item("path_image_event").$path_id;  
          if ($nama_file_db != '') {
            if (is_dir($url) == '1') {
                if ((is_file($url.$nama_file_db) === true) || (is_link($url.$nama_file_db) === true)) {
                    unlink($url.$nama_file_db); 
                }
            }            
          }
          
          $hasil_foto = $this->M_event->delete_event_form_data_foto($videvent,$vtglevent,$vurutfoto);
          if ($hasil_foto) {
              $response['status'] = "2";
              $response['pesan']  = "Sukses : Hapus Data Event Foto.";//.$videvent."-".$vtglevent."-".$vurutfoto."-".$url.$nama_file_db;
          } else {
              $response['status'] = "1";
              $response['pesan']  = "Gagal : Hapus Data Event Foto.";
          }  
      }
      echo json_encode($response);
    }
// --------------------------------------------------------------------------------------------------
//  Function untuk upload file ke server
// --------------------------------------------------------------------------------------------------
    public function upload_image_wh_foto_event($foldername, $nama_file) {
        //proses upload gambar
        $_FILES['userFile']['name']     = $_FILES['file_fotoevent']['name'];
        $_FILES['userFile']['type']     = $_FILES['file_fotoevent']['type'];
        $_FILES['userFile']['tmp_name'] = $_FILES['file_fotoevent']['tmp_name'];
        $_FILES['userFile']['error']    = $_FILES['file_fotoevent']['error'];
        $_FILES['userFile']['size']     = $_FILES['file_fotoevent']['size'];
        
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
                $lokasi_file  = $url.$nama_file ;
                $im_src       = imagecreatefromjpeg($lokasi_file);
                $src_width    = imageSX($im_src);
                $src_height   = imageSY($im_src);   

                //lokasi file besar
                $dst_width    = 372; //2480
                $dst_height   = 372;
                $im           = imagecreatetruecolor($dst_width,$dst_height);
                imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
                //Simpan gambar
                imagejpeg($im,$nama_file);

                imagedestroy($im_src);
                imagedestroy($im);
                $info  = 'Sukses : Image Diupload ';
            }
        }
        return $info;
    }  
// --------------------------------------------------------------------------------------------------
//  Delete folder dan filenya
// --------------------------------------------------------------------------------------------------
  public function delete_pathfile($path){
    if (is_dir($path) === true){
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file){
            if (in_array($file->getBasename(), array('.', '..')) !== true)
            {
                if ($file->isDir() === true) {
                    rmdir($file->getPathName());
                } else if (($file->isFile() === true) || ($file->isLink() === true)) {
                    unlink($file->getPathname());
                }
            }
        }
        return rmdir($path);
    } else if ((is_file($path) === true) || (is_link($path) === true)) {
        return unlink($path);
    }
    return false;
  }


// --------------------------------------------------------------------------------------------------
//  Proses foto event
// --------------------------------------------------------------------------------------------------
    public function proses_event_chating(){
      $vproses        = $this->input->post('n_proses');
      $videvent       = $this->input->post('idevent');
      $vtglevent      = $this->M_function_global->tgltosql($this->input->post('tglevent'));
      $vuserchat      = $this->input->post('usercahat');
      $vtgljamchat    =  $this->input->post('tgljamchat');
      $vmessage       =  $this->input->post('my_message');

      $q_chek_chat    = $this->M_event->get_event_chat_data_id_user($videvent, $vtglevent, $vuserchat);

      if ($q_chek_chat->num_rows() > 0 ) { $ada = 1;} else { $ada = 0;}
      
      if ( $vproses == '3' ) {
        if ( $ada == 1 ) {
            if ( ($this->session->userdata('user_id') ==  $vuserchat) || ($this->session->userdata('user_group') == 'ADMIN') )  {
                $q_delete_chat  = $this->M_event->delete_event_data_chat($videvent,$vtglevent,$vuserchat,$vtgljamchat);
                if ($q_delete_chat) {
                  $response['status'] = "2";
                  $response['pesan']  = "Sukses : Hapus Data Event Chating.";  
                  echo json_encode($response);
                } else {
                  $response['status'] = "1";
                  $response['pesan']  = "Error : Hapus Data Event Chating.";  
                  echo json_encode($response);
                }
            } else {
                $response['status'] = "1";
                $response['pesan']  = "Error : Hapus Data Event Chating (User Anda Tidak Memeiliki access).";  
                echo json_encode($response);
            }
            
        } else {
            $response['status'] = "1";
            $response['pesan']  = "Error : Hapus Data Event Chating Tidak Ditemukan.";  
            echo json_encode($response);
        }
      } else if ( $vproses == '1' ) {
        $data =   array(
                      'idevent'     => $videvent, 
                      'tglevent'    => $vtglevent, 
                      'tgljamchat'  => $vtgljamchat, 
                      'userchat'    => $vuserchat, 
                      'uraianchat'  => $vmessage 
                  );
        $q_insert_chat  = $this->M_event->insert_event_data_chat($data);
        if ($q_insert_chat) {
            $response['status'] = "2";
            $response['pesan']  = "Sukses : Tambah Data Event Chating.";  
            echo json_encode($response);
        } else {
            $response['status'] = "1";
            $response['pesan']  = "Error : Tambah Data Event Chating.";  
            echo json_encode($response);
        }
      }
    }
}
<!-- ====================================================================================================================== -->
  <?php 
      $user_kdunit   = $this->session->userdata('user_kdunit');
      $user_namaunit = $this->session->userdata('user_namaunit'); 
      $alamatunit    = $this->session->userdata('alamatunit');
      $user_id       = $this->session->userdata('user_id'); 
      $user_name     = $this->session->userdata('user_name');
      $user_group    = $this->session->userdata('user_group');
      $user_path     = $this->session->userdata('user_path');
      $userid        = $user_id;
      $mylogoshow    = 0;
      $mysysdate     = date("d/m/Y");

      $this->load->model('M_function_global');
  ?> 
<!-- ====================================================================================================================== -->

<div class="container body">
      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="page-title">
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Event Keluarga <small>(Happy Family)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">   
                      <?php if($user_group == 'ADMIN')  {?>
                        <li><a id="btntambahid"><i class="fa fa-plus"></i></a></li>
                        <li><a id="btneditid"><i class="fa fa-edit" data-toggle="modal" data-target=".bs-example-modal-lg"></i></a></li>
                        <li><a id="btnhapuseventall"><i class="fa fa-trash"></i></a></li>
                      <?php } ?>
                      <li><a class="collapse-link"><i class="fa fa-thumb-tack"></i></a></li>
                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      
                      <div class="col-sm-3 mail_list_column">
                        <!-- <button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button> -->
                        <!-- <spanid id="chekme"></span> -->                        
                        <div class="table-responsive">
                          <table style="font-size:9px; width:200px;" id="table">
                              <thead>
                                  <tr>
                                      <th> 
                                        <div class="col-xs-1" style="text-align: center;">
                                          <div class="dataTable_wrapper">   
                                            <div>                                            
                                            </div>
                                          </div>
                                        </div>
                                      </th>
                                  </tr>
                              </thead>
                          </table>
                      </div>
                     
                      </div>
                      <!-- /MAIL LIST -->
                      
                      <!-- CONTENT MAIL -->
                      <div id="view_event_detail" class="col-sm-9 mail_view">
                      </div>
                      <!-- /CONTENT MAIL -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

      </div>
    </div>
    <!-- /page content -->

<!-- ===================================================================================================================== -->
<!-- Begin Form Tambah Event Keluarga  -->
      <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="mylabelproses">Tambah/Edit Event</h4>
            </div>
            <div class="modal-body">
              <div class="row">
              <!-- form input mask -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Input Event</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="form-event" class="form-horizontal form-label-left">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Id Event (Auto)</label>
                        <div class="col-md-9 col-sm-9 col-xs-9" >
                          <input disabled="disabled" type="text" class="form-control" id="videvent">
                          <input type="text" class="form-control" id="idevent" name="idevent">
                          <!-- <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span> -->
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Tgl Entry (sysdate)</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input disabled="disabled" type="text" class="form-control" id="vtglevent">
                          <input type="text" class="form-control" id="tglevent" name="tglevent">
                          <!-- <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span> -->
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Judul Event</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" id="judulevent" name="judulevent">
                          <!-- <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span> -->
                        </div>
                      </div>
                      <div class="form-group"> 
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Tgl Kejadian</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <fieldset>    
                            <div class="xdisplay_inputx form-group has-feedback">
                              <input class="col-md-8 form-control has-feedback-left" id="tglkejadian" name="tglkejadian" placeholder=" Tgl Kejadian" aria-describedby="inputSuccess2Status3" type="text">
                              <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                              <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                            </div>
                          </fieldset>
                        </div>

                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Lokasi</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" id="lokasi" name="lokasi">
                          <!-- <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span> -->
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Peserta</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" id="peserta" name="peserta">
                          <!-- <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span> -->
                        </div>
                      </div>  
                      <!-- Uraian Ecen end -->        
                      <div class="x_content">
                        <div id="alerts"></div>
                        <div class="container-fluid">
                            <div class="row">
                              <div class="container">
                                <div class="row">
                                  <div class="col-lg-12 nopadding">
                                    <textarea id="txtEditor" name="txtEditor"></textarea> 
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>                
                      </div>
                      <!-- Uraian Ecen end -->                 
                    </form>
                  </div>
                </div>
              </div>
              <!-- /form input mask -->
<!-- ============================================================================================================ --> 
              <!-- form color picker -->
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Upload Foto Event</h2>                  
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="input-group"> 
                            <input id="filter_all" type="text" class="form-control" placeholder="Cari Foto Event"
                              style="padding-left: 2px;padding-top: 2px;padding-bottom: 2px;padding-right: 2px; height: 24px">
                            <span class="input-group-addon" style="padding-left: 12px;padding-top: 2px;padding-bottom: 2px;"><i class="fa fa-search"></i></span>
                        </div>
                       <!--  <div class="col-md-12">   -->
                           <div class="table-responsive">
                              <table style="font-size:9px; width:380px;" class="table table-striped" id="table_all">
                                  <thead>
                                      <tr>
                                          <th style="text-align:center;"><i class="fa fa-meh-o"></i></th>
                                          <th style="text-align:center;">Urut</th>
                                          <th style="text-align:center;">Nama File</th>
                                          <!-- <th style="text-align:center;">Uraian</th> -->
                                          <th style="text-align:center;">Proses</th>
                                      </tr>
                                  </thead>
                              </table>
                           </div>
                       <!--  <div> -->
                      </div>
                    </div>
  
                    <br/>  <div class="ln_solid"></div>
                    <form class="form-horizontal form-label-left" id="form-event-foto"  method="post" enctype="multipart/form-data" >

                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"> id </div>
                            <div class="col-xs-8">
                              <input type="text" class="form-control" name="urutfoto" id="urutfoto">
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"> Uraian </div>
                            <div class="col-xs-8">
                              <input type="text" class="form-control" name="uraianfoto" id="uraianfoto">
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-4"> Foto (JPG)</div>
                            <div class="col-xs-8">
                              <input type="file" class="form-control" name="file_fotoevent" id="file_fotoevent">
                            </div>
                        </div>
                      </div>
                      <br/>
                      <div class="row">
                          <div class="col-md-4"> </div>
                          <div class="col-xs-8"> </div>
                      </div>
                      <div class="row">
                          <!-- <div class="col-md-4"> </div> -->
                          <div class="col-xs-12">
                            <!-- <canvas id="myCanvas" width="130" height="135" style="border:1px solid #d3d3d3;"></canvas> -->
                            <center id="n_myfoto_edit"> </center>
                          </div>
                      </div>
                    </form>
                    <br/><div class="ln_solid"></div>
                        <button type="submit" class="btn btn-success btn-xs" id="btnbaru" 
                                onclick="proses_data_event_detail_foto_clear(1)">Tambah</button>
                        <button type="submit" disabled="disabled" class="btn btn-success btn-xs" id="btnsetuju" 
                                onclick="simpan_data_event_detail_foto_setuju()">Setuju</button>
                  </div>
                </div>
              </div>
              <!-- /form color picker -->
<!-- ============================================================================================================= --> 

            </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" id="btn_simpan_event" onclick="simpan_data_event_detail()">Simpan</button>
              <button type="submit" class="btn btn-primary" data-dismiss="modal">Keluar</button>
            </div>

          </div>
        </div>
      </div>    
<!-- End Form Tambah Event Keluarga  -->
<!-- =============================================================================================================== --> 

  <script type="text/javascript">
    var mytable, mytable_all, html_foto_ut, myproses, myproses_foto;
    var myidevent, myidevent_new, mytglevent;
    $(document).ready(function(){
        myproses = 0;
        myproses_foto = 0;
        $("#txtEditor").Editor();
        
        mytable=$('#table').DataTable ({
            "language": {
              "emptyTable": "Tidak ada data",
              "zeroRecords": "Pencarian tidak ada",
              "search": "Cari : ",
              "paginate": {
                  "previous": '<i class="fa fa-arrow-circle-left"> </i>',
                  "next": '<i class="fa fa-arrow-circle-right"> </i>'
               },
            },
            "ajax": {
               "type" : "POST",
                "url" : "<?php echo base_url(); ?>index.php/Event/event_list",
                //"data":{"v_userid": userid, "v_usergroup": usergroup},
            },
            "paging": true,
            "pageLength": 4,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false
        });

        (function ($) {
          $('#filter_all').keyup(function () {
              var rex = new RegExp($(this).val(), 'i');
              $('.table tr').hide();
              $('.table tr').filter(function () {
                  return rex.test($(this).text());
              }).show();
            })
        }(jQuery));

        $('#tglkejadian').daterangepicker({
              singleDatePicker: true,
              singleClasses: "picker_3",
              locale: {
                  format: 'DD/MM/YYYY'
              }
            }, function(start, end, label) {
              console.log(start.toISOString(), end.toISOString(), label);
        });

        show_event_last(); 
        
    });

// ================================================================================================================= 
    function show_data_event_detail(idevent,tglevent){
      //alert('helloo : '+tglevent+'----'+idevent);      
      myidevent     = idevent;
      mytglevent    = tglevent;

      $.ajax({
          url     :"<?php echo base_url(); ?>index.php/Event/event_list_detail_data_show",
          type    :"POST",
          data    :{"idevent":idevent,"tglevent":tglevent},
          dataType:"JSON",
          success : function(data){
              my_proc_hapus =   "show_event_form(3,'"+myidevent+"','"+mytglevent+"')";
              my_proc       =   "show_event_form(2,'"+myidevent+"','"+mytglevent+"')";
              my_proc_clear =   "show_event_form(1,'','')";
              vbtntambahid  =   ' <a><i class="fa fa-plus" data-toggle="modal" '+
                                ' data-target=".bs-example-modal-lg" onclick="'+my_proc_clear+'"></i></a>';
              vbtneditid    =   ' <a><i class="fa fa-edit" data-toggle="modal" '+
                                ' data-target=".bs-example-modal-lg" '+
                                ' onclick="'+my_proc+'"></i></a>';
              vbtnhapuseventall   
                            =   ' <a><i class="fa fa-trash" '+ 
                                ' onclick="'+my_proc_hapus+'"></i></a>';

              //alert('helloo : '+tglevent+'----'+idevent);              
              $('#btntambahid').html(vbtntambahid); 
              $('#btneditid').html(vbtneditid);
              $('#btnhapuseventall').html(vbtnhapuseventall);
              $('#view_event_detail').html(data.code_html);
          }
      });
    }

// ================================================================================================================= 
    function show_data_event_detail_foto_utama(pathfoto){
      //alert('hello men --> '+pathfoto);
      $('#fotoutama').html(
        '                <img src="'+pathfoto+'"  alt="..."/>'
      );
    }

// ================================================================================================================= 
    function show_event_last (){
        $.ajax({
            url     :"<?php echo base_url(); ?>index.php/Event/show_event_last_data",
            type    :"POST",
            dataType:"JSON",
            success : function(data){
                //alert('helloo : '+data.idevent+'----'+data.tglevent);
                show_data_event_detail(data.idevent,data.tglevent);
            }
        });
    }

// ================================================================================================================= 
    function show_seq_idevent(){
       $.ajax({
              url     :"<?php echo base_url(); ?>index.php/Event/show_seq_idevent_data",
              type    :"POST",
              dataType:"JSON",
              success : function(data){
                $('#idevent').val(data.idevent_new);
                $('#videvent').val(data.idevent_new);
              }
          });
    }

// ================================================================================================================= 
     function show_event_form(proses,idevent,tglevent){
        var my_sysdate = "<?php echo $mysysdate; ?>";
            myproses = proses;

        //alert('chek '+myproses);
        if (myproses == 1) {
            //proses_data_event_detail_foto_clear(myproses);
            $("#mylabelproses").html('Tambah Data Event');
            show_seq_idevent();
            $("#vtglevent").val(my_sysdate); 
            $("#tglevent").val(my_sysdate);
            $('#judulevent').val(''); 
            $('#tglkejadian').val('');
            $('#lokasi').val(''); 
            $('#peserta').val('');
            $("#txtEditor").Editor("setText", '');
            //khusus tanbah data foto
            proses_data_event_detail_foto_clear(myproses);
            show_event_all_foto( '', '');
            myidevent   = '';
            mytglevent  = '';
        } else if (myproses == 2) {
            $("#mylabelproses").html('Rubah Data Event');
             $.ajax({
                url     :"<?php echo base_url(); ?>index.php/Event/show_event_form_data",
                type    :"POST",
                data    :{"idevent":idevent,"tglevent":tglevent},
                dataType:"JSON",
                success : function(data){
                    //salert('helloo : '+idevent+'----'+tglevent);
                    show_event_all_foto( idevent,tglevent)
                    $('#idevent').val(data.idevent);
                    $('#videvent').val(data.idevent);
                    $('#tglevent').val(data.tglevent);
                    $('#vtglevent').val(data.tglevent);
                    $('#judulevent').val(data.judulevent); 
                    $('#tglkejadian').val(data.tglkejadian);
                    $('#lokasi').val(data.lokasi); 
                    $('#peserta').val(data.peserta);

                    $("#txtEditor").Editor("setText", data.uraian);               
                    //$("#txtEditor").val(data.uraian);
                    //$("#placeHolder").Editor("getText");
                }
            });
        } else if (myproses == 3) {
          tanya = confirm("Anda Yakin Akan Menghapus Data  Event Ini ?");
          if (tanya == true) {
              //alert('Sukses : Hapus Data Event.');
              hapus_data_event(myproses,idevent,tglevent);
            }
        }
    }

// ================================================================================================================= 
    function proses_data_event_detail_foto_clear(proses){
      myproses_foto = proses;
      //alert('helloo : '+myproses_foto);
      $('#btnsetuju').removeAttr('disabled');
      $('#btnbaru').attr('disabled','disabled');
      $('#urutfoto').val('');
      $('#uraianfoto').val('');
      $('#file_fotoevent').val('');
      $('#n_myfoto_edit').html('');
    }

// ================================================================================================================= 
    function show_event_all_foto( idevent,tglevent){
        $('#table_all').removeAttr();
        
        mytable_all=$('#table_all').DataTable ({
          "language": {
            "emptyTable": "Tidak ada data",
            "zeroRecords": "Pencarian tidak ada",
            "search": "Cari : ",
            "paginate": {
                "previous": '<i class="fa fa-arrow-circle-left"> </i>',
                "next": '<i class="fa fa-arrow-circle-right"> </i>'
             },
          },
          "ajax": {
              "url"   : "<?php echo base_url(); ?>index.php/Event/event_list_foto_all",
              "type"  : "POST",
              "data"  :{"idevent":idevent,"tglevent":tglevent},
          },
          "paging": true,
          "pageLength": 20,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": true,
          "bDestroy": true
      });
    }

// ================================================================================================================= 
    function show_data_event_detail_foto(idevent,tglevent,urutfoto){
        //alert('helloo1 : '+idevent+'----'+tglevent+'----'+urutfoto);
        $.ajax({
            url     :"<?php echo base_url(); ?>index.php/Event/show_event_form_data_foto",
            type    :"POST",
            data    :{"idevent":idevent,"tglevent":tglevent, "urutfoto":urutfoto},
            dataType:"JSON",
            success : function(data){
                //alert('helloo : '+data.idevent+'----'+data.tglevent);
                myproses_foto = 2;
                $('#urutfoto').val(data.urutfoto);
                $('#uraianfoto').val(data.uraianfoto); 
                var mypath = "<?php echo base_url() ?>/arsip/images/event/"+data.tglevent+"_"+data.idevent+"/"+data.pathfoto;
                myimage = '<img width="350" height="250"  src="'+mypath+'" >';
                $('#n_myfoto_edit').html(myimage);
                $('#btnsetuju').removeAttr('disabled');
                $('#btnbaru').attr('disabled','disabled');
                //$('#urutfoto').attr('disabled','disabled');
            }
        });
    }


     function show_data_event_detail_foto_2(idevent,tglevent,urutfoto){
        //alert('helloo1 : '+idevent+'----'+tglevent+'----'+urutfoto);
        $.ajax({
            url     :"<?php echo base_url(); ?>index.php/Event/show_event_form_data_foto",
            type    :"POST",
            data    :{"idevent":idevent,"tglevent":tglevent, "urutfoto":urutfoto},
            dataType:"JSON",
            success : function(data){
                //alert('helloo : '+data.idevent+'----'+data.tglevent);
                myproses_foto = 2;
                $('#urutfoto').val(data.urutfoto);
                $('#uraianfoto').val(data.uraianfoto); 
                var mypath = "<?php echo base_url() ?>/arsip/images/event/"+data.tglevent+"_"+data.idevent+"/"+data.pathfoto;
                myimage = '<img width="350" height="250"  src="'+mypath+'" >';
                $('#n_myfoto_edit').html(myimage);
            }
        });
    }


// ================================================================================================================= 
    function hapus_data_event_detail_foto(proses,idevent,tglevent,urut){
       //alert('helloo : '+proses+'---'+idevent+'----'+tglevent+'----'+urut);
       $.ajax ({
            url: "<?php echo base_url(); ?>index.php/Event/simpan_event_foto",
            type: "POST",
            data: {"n_proses":proses, "n_idevent":idevent, "n_tglevent":tglevent, "urutfoto":urut}, 
            dataType: "JSON",
            success: function(msg) {
                if (msg.status=='1') {
                   alert(msg.pesan);
                } else if (msg.status=='2') {                  
                   mytable_all.ajax.reload(null,false);
                   show_data_event_detail(myidevent, mytglevent);
                   alert(msg.pesan);
                }
            }
        });
    }

// ================================================================================================================= 
    function simpan_data_event_detail_foto_setuju(){
      var mydata;
          mydata = new FormData($('#form-event-foto')[0]);
          mydata.append('n_proses', myproses_foto);
          mydata.append('n_idevent', $("#idevent").val());
          mydata.append('n_tglevent', $("#tglevent").val());

       //alert('helloo : '+myproses); 
       $.ajax ({
            url: "<?php echo base_url(); ?>index.php/Event/simpan_event_foto",
            type: "POST",
            data: mydata, 
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            beforeSubmit: function() {
               /* $('#btnsetuju').attr('disabled', 'disabled');
                $('#btnsetuju').button('loading');*/
            },
            success: function(msg) {
                if (msg.status=='1') {
                   alert(msg.pesan);
                } else if (msg.status=='2') {                  
                    alert(msg.pesan); //+"==="+mytglevent);
                    mytable.ajax.reload(null,false);
                    mytable_all.ajax.reload(null,false);
                    show_data_event_detail(myidevent,mytglevent);
                    show_data_event_detail_foto_2(myidevent,mytglevent,$('#urutfoto').val());                    
                    
                    $('#btnsetuju').attr('disabled','disabled');
                    $('#btnbaru').removeAttr('disabled');
                    //event.preventDefault();
                }
            }
        });
    }

  // ================================================================================================================= 
    function simpan_data_event_detail(){
       var mydata;
       var meuraian =  $("#txtEditor").Editor("getText");
        mydata = new FormData($('#form-event')[0]);
        mydata.append('n_proses', myproses);
        //mydata.append('n_proses', myproses);
        mydata.append('uraianevent',meuraian);

       //alert('helloo : '+myproses); 
      $.ajax ({
            url: "<?php echo base_url(); ?>index.php/Event/simpan_event",
            type: "POST",
            data: mydata, 
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            beforeSubmit: function() {
                $('#btn_simpan_event').attr('disabled', 'disabled');
                $('#btn_simpan_event').button('loading');
                //event.preventDefault();
            },
            success: function(msg) {
                //console.log(msg.status);
                $('#btn_simpan_event').removeAttr('disabled');
                $('#btn_simpan_event').button('reset');

                if (msg.status=='1') {
                   alert(msg.pesan);
                } else if (msg.status=='2') {                  
                   mytable.ajax.reload(null,false);
                   show_data_event_detail(myidevent,mytglevent);
                   alert(msg.pesan);
                }
            }
      });
    }
    // ================================================================================================================= 
    function hapus_data_event(myproses,idevent,tglevent){
       //alert('helloo : '+idevent+'-'+tglevent); 
       $.ajax ({
            url: "<?php echo base_url(); ?>index.php/Event/simpan_event",
            type: "POST",
            data: {'n_proses' : myproses,"idevent":idevent, "tglevent":tglevent}, 
            dataType: "JSON",
            success: function(msg) {
                if (msg.status=='1') {
                  alert(msg.pesan);
                } else if (msg.status=='2') {                  
                  alert(msg.pesan);
                  show_event_last();
                  mytable.ajax.reload(null,false);
                }
            }
        });
    }

  // ================================================================================================================= 
    function proses_data_event_detail_chat(myproses,idevent,tglevent,users,tgljamchat){
      //alert('hello'.tgljamchat);
      if ( myproses == 3) {
          tanya = confirm("Anda Yakin Akan Menghapus Data  Event Chating Ini ?");
          if (tanya == true) {
              //alert('Sukses : Hapus Data Event.');
              $.ajax ({
                url: "<?php echo base_url(); ?>index.php/Event/proses_event_chating",
                type: "POST",
                data: {'n_proses' : myproses,"idevent":idevent, "tglevent":tglevent, 'usercahat' :users, 'tgljamchat': tgljamchat, 'my_message':'' }, 
                dataType: "JSON",
                success: function(msg) {
                    if (msg.status=='1') {
                      alert(msg.pesan);
                    } else if (msg.status=='2') {                  
                      alert(msg.pesan);
                      show_data_event_detail(idevent,tglevent);
                    }
                }
              });
            }
      } else  if ( myproses == 1) {
          var my_message = $('#chat_message').val();
          if ( my_message != '') {
              //alert(my_message);
              $.ajax ({
                  url: "<?php echo base_url(); ?>index.php/Event/proses_event_chating",
                  type: "POST",
                  data: {'n_proses' : myproses,"idevent":idevent, "tglevent":tglevent, 'usercahat' :users, 'tgljamchat': tgljamchat, 'my_message': my_message }, 
                  dataType: "JSON",
                  success: function(msg) {
                      if (msg.status=='1') {
                        alert(msg.pesan);
                      } else if (msg.status=='2') {                  
                        //alert(msg.pesan);
                        show_data_event_detail(idevent,tglevent);
                      }
                  }
                });
          } else {
            alert ('Error : Masukan Pesan Berupa Tanggapan untuk Event, Pesan Masih Kosong !');
            $('#chat_message').focus();
          }
      }  
    }
  // ================================================================================================================= 
  

  </script>

  <!-- bootstrap-wysiwyg -->
  <script type="text/javascript" src="<?php echo base_url('assets/0myjs/wys/editor.js'); ?>" ></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/0myjs/wys/editor.css'); ?>">
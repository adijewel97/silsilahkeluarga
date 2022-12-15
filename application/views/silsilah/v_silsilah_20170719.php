<!-- ====================================================================================================================== -->
  <?php 
      $user_kdunit   = $this->session->userdata('user_kdunit');
      $user_namaunit = $this->session->userdata('user_namaunit'); 
      $alamatunit    = $this->session->userdata('alamatunit');
      $user_id       = $this->session->userdata('user_id'); 
      $user_name     = $this->session->userdata('user_name');
      $user_group    = $this->session->userdata('user_group');
      $userid        = $user_id;
      $mylogoshow    = 0;
  ?> 
<!-- ====================================================================================================================== -->


<div class="container body">
      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="page-title">
            </div>

            <div class="clearfix"></div>
<!-- ================================================================================================================================ -->
            <!-- begin -->
            <div class="col-md-8">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Silsilah Keluarga</h2>
                    <ul class="nav navbar-right panel_toolbox">   
                      <li><a class="collapse-link"><i class="fa fa-sitemap"></i></a>
                      </li>
                      <li><a class="collapse-link"><i class="fa fa-female"></i></a>
                      </li>
                      <li><a class="collapse-link"><i class="fa fa-male"></i></a>
                      </li>
                      <li><a class="collapse-link"><i class="fa fa-child"></i></a>
                      </li>
                      <li><a class="collapse-link"><i class="fa fa-group"></i></a>
                      </li>
                      <li><a class=""><i class="fa fa-search-minus"></i></a>
                      </li>
                      <li><a class=""><i class="fa fa-search-plus"></i></a>
                      </li>
                      <li><a class=""><i class="fa fa-home"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="chart" id="custom-colored"> </div>
                    <script src="<?php echo base_url('assets/0myjs/js/silsilah/raphael.js'); ?>"></script>
                    <script src="<?php echo base_url('assets/0myjs/js/silsilah/Treant.js'); ?>"></script>                  
                  </div>
                </div>
            </div>
<!-- ================================================================================================================================ -->            <div class="col-md-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Isi Data Keluarga</h2>
                    <ul class="nav navbar-right panel_toolbox">
                     <!--  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                     </li> -->
                        </li>
                        <li><a class=""><i class=""></i></a><li><a class=""><i class=""></i></a>
                        <li><a class=""><i class=""></i></a><li><a class=""><i class=""></i></a>
                        <li><a class=""><i class=""></i></a><li><a class=""><i class=""></i></a>
                        <li><a class=""><i class=""></i></a><li><a class=""><i class=""></i></a>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-gear"></i></a>
                        <ul class="dropdown-menu" role="menu">                                    
                            <li><a class="list-group-item disabled" href="#/arrow-circle-o-right"><i class="fa fa-arrow-circle-o-right"></i> Orang Berikutnya</a>
                            </li>
                            <li><a class="list-group-item disabled" href="#/arrow-circle-o-left"><i class="fa fa-arrow-circle-o-left"></i> Orang Sebelumnya</a>
                            </li>
                            <div class="x_title"> </div>
                            <li><a onclick="javascript:show_data_proses_from('3',this)"><i class="fa fa-trash"></i> Hapus Exist</a>
                            </li>
                            <li><a class="list-group-item disabled" href="#/arrow-circle-o-left"><i class="fa fa-times-circle-o"></i> Hapus dengan Tree Bawahnya</a>
                            </li>
                        </ul>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="buttons">
                      <!-- Standard button -->                              
<!-- ================================================================================================================================ -->
                        <div class="x_title"> 
                            <li class="media event">
                                <div class="col-md-6">   
                                    <!-- <canvas id="myCanvas" width="130" height="135" style="border:1px solid #d3d3d3;"> -->
                                      <center id="n_myfoto"> </center>              
                                </div>
                                <div class="col-md-6">
                                    <div class="media-body">
                                        <p style="font-size: 11px"><small>Nama dan Umur</small></p>
                                        <a class="title">
                                            <p id="n_id_child"></p>
                                            <p><label style="font-size: 11px" id="n_nama_view"></label></p>
                                            <p style="font-size: 11px" id="n_umur"></p>
                                            <p style="font-size: 11px;   display: none;" id="n_id_vs_relasi"></p>
                                        </a><br/>
                                        <p style="font-size: 11px"><small>Lahir</small></p>
                                        <a class="title">
                                            <p style="font-size: 11px"  id="n_tgl_lahir"></p>
                                            <p style="font-size: 11px"  id="n_tempat_lahir"></p>
                                        </a>
                                    </div>
                                </div>
                            </li>                                    
                        </div>
 <!-- ========================================================================================================= -->                       <div class="x_title"> 
                            <li class="media event">
                                <div class="media-body">
                                    <a class="title">
                                      <p style="font-size: 11px">Edit Data Identitas</p>
                                    </a><br/>
                                    <div class="col-md-6"> 
                                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" 
                                          data-target="#ymodalform" onclick="show_data_proses_from('2',this)" 
                                          id="edit_silsilah" >Detail Edit
                                        </button>
                                    </div>
                                    <div class="col-md-6"> </div>
                                        <button type="button" class="btn btn-success btn-xs" data-toggle="mymodalformUpload" 
                                          data-target="#mymodalformUpload" onclick="show_data_proses_from_upload('2',this)" 
                                          id="edit_foto_silsilah" >Foto
                                        </button>
                                       <!--  <button type="button" class="btn btn-success btn-xs" data-toggle="modal" 
                                         onclick="show_data_proses_from_upload('2',this)" data-target="#mymodalformUpload" id="edit_foto_silsilah" >Foto</button> -->
                                    <div>

                                </div>
                            </li> 
<!-- =========================================================================================================== -->
                        </div>
                        <div class="media-body">
                            <a class="title">
                              <p style="font-size: 11px">Tambah Hubungan Keluarga</p>
                            </a><br/>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-6">
                            <div class="btn-group">
                               <button id="datebox" data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button" aria-expanded="false">Ayah <span class="caret"></span>
                               </button>
                               <ul id="demolist" role="menu" class="dropdown-menu">
                                 <li><a data-toggle="modal" data-target="#mymodalform" id="1"
                                        onclick="javascript:show_data_proses_from('1',this)">Ayah</a>
                                 </li>
                                 <li><a data-toggle="modal" data-target="#mymodalform" id="2"
                                        onclick="javascript:show_data_proses_from('1',this)">Ibu</a>
                                 </li>
                                 <li><a data-toggle="modal" data-target="#mymodalform" id="3"
                                        onclick="javascript:show_data_proses_from('1',this)">Suami/Istri</a>
                                 </li>
                                 <li class="divider"></li>
                                 <li><a data-toggle="modal" data-target="#mymodalform" id="4"
                                        onclick="javascript:show_data_proses_from('1',this)">Anak Laki</a>
                                 </li>
                                 <li><a data-toggle="modal" data-target="#mymodalform" id="5"
                                        onclick="javascript:show_data_proses_from('1',this)">Anak Perempuan</a>
                                 </li>
                                 <li><a data-toggle="modal" data-target="#mymodalform" id="6"
                                        onclick="javascript:show_data_proses_from('1',this)">Tidak Ada Hubungan</a>
                                 </li>
                               </ul>
                            </div>
                        </div> <br/> 
                        <div class="x_title">                             
                        </div>
                        <div class="x_title"> 
                            <li class="media event">
                                <div class="media-body">
                                    <a class="title">
                                      <p style="font-size: 11px">Keluarga</p>
                                    </a><br/>
                                    <div class="col-md-6"> 
                                      <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="show_table_keluarga_all();">Detail Keluarga
                                      </button>
                                      <!-- <button type="button" class="btn btn-success btn-xs" data-toggle="mymodalformUpload_2" 
                                          data-target="#mymodalformUpload_2" id="detail_silsilah" >Detail Keluarga
                                      </button> -->
                                    <!--   onclick="show_data_proses_from_upload('2',this)"  -->
                                    </div>
                                    <div class="col-md-6"> </div>
                                    <div>

                                    <div class="row"><br/>
                                      <div class="col-md-12">
                                        <div class="input-group"> 
                                            <input id="filter" type="text" class="form-control" placeholder="Cari Data Keluarga"
                                              style="padding-left: 2px;padding-top: 2px;padding-bottom: 2px;padding-right: 2px; height: 24px">
                                            <span class="input-group-addon" style="padding-left: 12px;padding-top: 2px;padding-bottom: 2px;"><i class="fa fa-search"></i></span>
                                        </div>
                                         <div class="table-responsive">
                                            <table style="font-size:9px; width:250px;" class="table table-striped" id="table">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align:center;"><i class="fa fa-meh-o"></i></th>
                                                        <th style="text-align:center;">Nama</th>
                                                        <th style="text-align:center;"><i class="fa fa-tree"></i></th>
                                                        <th style="text-align:center;">Lahir</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                      <div>
                                    </div>

                                </div>
                            </li>                                    
                        </div>
                                                                             
                    </div>
                  </div>
                </div>
            </div>
            <!-- end -->
<!-- ================================================================================================================================ -->
          </div>
        </div>
        <!-- /page content -->

      </div>
    </div>
    <!-- /page content -->

<!-- ================================================================================================================================ -->
<!-- Small modal edit detail identitas-->
<!--  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button> -->
    <div class="modal fade"  id="mymodalform" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="mymodallabel2">Edit Data Identitas</h4>
            </div>
            <div class="modal-body">
                <form id="form-Silsilah">
                    <div class="form-body"> 
                        <div class="row">
                            <div class="col-md-12 col-sm-2 col-xs-12" style="font-size: 10px">
                                <div class="form-group">
                                    <div class="radio">
                                        <div class="col-md-12 col-sm-4 col-xs-12">
                                             <label>
                                              <input type="radio" checked="" value="L" id="v_kelamin" name="v_kelamin"> Laki-laki
                                            </label>
                                        </div>
                                        <div class="col-md-12 col-sm-4 col-xs-12">
                                            <label>
                                              <input type="radio" value="P" id="v_kelamin" name="v_kelamin"> Perempuan
                                            </label>
                                        </div>
                                        <div class="col-md-12 col-sm-4 col-xs-12">
                                            <label>
                                              <input type="radio" value="U" id="v_kelamin" name="v_kelamin"> Tidak dikenal
                                            </label>
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label for="nikename">Nama Tampilan * :</label>
                                    <input type="text" id="v_nama_view" class="form-control" name="v_nama_view" required />
                                </div>
                                <div class="form-group">
                                    <label for="fullname">Nama Depan * :</label>
                                    <input type="text" id="v_nama_depan" class="form-control" name="v_nama_depan" required />
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Nama Belakang :</label>
                                    <input type="text" id="v_nama_belakang" class="form-control" name="v_nama_belakang" required />
                                </div>
                                <label>Tempat, Tgl Lahir * :</label>
                                <div class="form-group">
                                    <input type="text" id="v_tempat_lahir" class="form-control" name="v_tempat_lahir" required placeholder="Tempat Lahir"/>
                                </div>
                                <fieldset>    
                                  <div class="form-group">
                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                      <input class="form-control has-feedback-left" id="v_tgl_lahir" name="v_tgl_lahir" placeholder="Tgl Lahir" aria-describedby="inputSuccess2Status3" type="text">
                                      <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                      <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                    </div>
                                  </div>
                                </fieldset>
                                <div class="col-md-12 col-sm-12 col-xs-12"> </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                    <label>
                                      <input type="checkbox" name="v_hidup" id="v_hidup"> Hidup / Meninggal
                                    </label>
                                  </div>
                                </div>
                                <label for="fullname">Tempat, Tgl Meninggal :</label>
                                    <div class="form-group">
                                      <div class="form-group">
                                          <input type="text" id="v_tempat_wafat" class="form-control" name="v_tempat_wafat" disabled="disabled" placeholder="Lokasi Wafat/Pusara"/>
                                      </div>
                                      <fieldset>    
                                        <div class="form-group">
                                          <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                            <input class="form-control has-feedback-left" id="v_tgl_wafat" name="v_tgl_wafat" placeholder="Tgl Wafat" aria-describedby="inputSuccess2Status3" type="text" disabled>
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status3" class="sr-only">(success)</span>
                                          </div>
                                        </div>
                                      </fieldset>
                                <div class="form-group">
                                    <label for="message">Keterangan :</label>
                                    <textarea id="v_keterangan" required="required" class="form-control" name="v_keterangan" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="50" data-parsley-minlength-message=" max 20 Karakter"
                                    data-parsley-validation-threshold="10"  rows="1"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                              <input type="hidden" id="v_id" class="form-control" name="v_id" required />
                            </div>
                            <div class="col-md-4">
                              <input type="hidden" id="v_id_relasi" class="form-control" name="v_id_relasi" required />
                            </div>
                            <div class="col-md-4">
                             <input type="hidden" id="v_id_parent" class="form-control" name="v_id_parent" required />
                           </div>
                        </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary btn-xs" id="btn_simpan_silsilah" onclick="simpan_silsilah()" >Simpan</button>
                          <button id="closemodal" type="button" class="btn btn-default btn-xs" data-dismiss="modal">Keluar</button>
                        </div>
                    </div>
                </form>
            </div>

          </div>
        </div>
    </div>
<!-- ===================================================================================================================== -->    
<!-- Small modal edit detail identitas foto-->
    <div class="modal fade mymodalformUpload"  id="mymodalformUpload" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <h4 class="modal-title" id="mymodallabel_upl">Upload Identitas</h4>
            </div>
            <div class="modal-body">
                <form id="form-Silsilah-foto"  method="post" enctype="multipart/form-data" >
                    <h4 class="modal-title" id="mymodallabel_upl_name">Upload Identitas</h4>
                    <div class="form-body"> 
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4"> Foto (JPG)</div>
                                <div class="col-xs-8">
                                  <input type="file" class="form-control" name="fileberkas" id="fileberkas">
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-4"> </div>
                                <div class="col-xs-8"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"> </div>
                                <div class="col-xs-8">
                                  <!-- <canvas id="myCanvas" width="130" height="135" style="border:1px solid #d3d3d3;"></canvas> -->
                                  <center id="n_myfoto_edit"> </center>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4">
                              <input type="hidden" id="v_id_f" class="form-control" name="v_id_f" required />
                            </div>
                            <div class="col-md-4">
                              <input type="hidden" id="v_id_relasi_f" class="form-control" name="v_id_relasi_f" required />
                            </div>
                            <div class="col-md-4">
                             <input type="hidden" id="v_id_parent_f" class="form-control" name="v_id_parent_f" required />
                           </div>
                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary btn-xs" id="btn_simpan_silsilah" onclick="simpan_silsilah_foto()" >Simpan</button>
                          <button id="closemodal" type="button" class="btn btn-default btn-xs" data-dismiss="modal">Keluar</button>
                        </div>
                    </div>
                </form>
            </div>

          </div>
        </div>
    </div>
<!-- ===================================================================================================================== -->    

<!-- Small modal edit detail identitas keluarga all-->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Data Keluarga</h4>
        </div>
        <div class="modal-body">
          
          <div class="row">
            <div class="col-md-4">
              <div class="input-group"> 
                  <input id="filter_all" type="text" class="form-control" placeholder="Cari Data Keluarga"
                    style="padding-left: 2px;padding-top: 2px;padding-bottom: 2px;padding-right: 2px; height: 24px">
                  <span class="input-group-addon" style="padding-left: 12px;padding-top: 2px;padding-bottom: 2px;"><i class="fa fa-search"></i></span>
              </div>
            </div>
          </div>
          <div class="x_title"> </div>
          <!-- <div class="col-md-1"></div> -->
            <div class="row">
             <!--  <div class="col-sm-1"></div> -->
              <!-- <div class="col-md-4"> -->
                <div class="table-responsive">
                    <table style="font-size:9px; width:250px;" class="table table-striped" id="table_all">
                        <thead>
                            <tr>
                                <th style="text-align:center;"><i class="fa fa-star-half-o"></i></th>
                                <th style="text-align:center;">Nama</th>
                                <th style="text-align:center;">Nama Depan</th>
                                <th style="text-align:center;">Nama Belakang</th>
                                <th style="text-align:center;"><i class="fa fa-tree"></i></th>
                                <th style="text-align:center;">Umur</th>
                                <th style="text-align:center;">Tempat Lahir</th>
                                <th style="text-align:center;">Tanggal Lahir</th>
                                <th style="text-align:center;">Tempat Wapat</th>
                                <th style="text-align:center;">Tanggal Wapat</th>
                                <th style="text-align:center;">Hidup</th>
                            </tr>
                        </thead>
                    </table>
                </div>
              <!-- <div> -->
            </div>
          <div class="x_title"> </div>
        </div>
        <div class="row"></div>
        
      </div>
    </div>
  </div>
<!-- /modals -->  
<!-- ===================================================================================================================== -->  

<script type="text/javascript">
    var chart_config;
    var myproses;
    var tableme, tableme_all;
    var master_response;
    var my_id_parent;

    $(document).ready(function(){
        showsilsilah();
        show_table_keluarga();
        $('#tglmeninggal').val('');

        document.getElementById("v_hidup").onclick = function() {
            // access properties using this keyword
            if ( this.checked ) {
                $("#v_tempat_wafat").removeAttr('disabled');
                $("#v_tgl_wafat").removeAttr('disabled');
            } else {
                $('#v_tempat_wafat').attr('disabled', 'disabled');
                $('#v_tempat_wafat').val('');
                $('#v_tgl_wafat').attr('disabled', 'disabled');
                $('#v_tgl_wafat').val('');
            }
        };

        (function ($) {
          $('#filter').keyup(function () {

              var rex = new RegExp($(this).val(), 'i');
              $('.table tr').hide();
              $('.table tr').filter(function () {
                  return rex.test($(this).text());
              }).show();
            })
        }(jQuery));

        (function ($) {
          $('#filter_all').keyup(function () {
              var rex = new RegExp($(this).val(), 'i');
              $('.table tr').hide();
              $('.table tr').filter(function () {
                  return rex.test($(this).text());
              }).show();
            })
        }(jQuery));
        
        // alert("master_response : "+ master_response)
    });
/*===================================================================================================================== */
   $('#v_tgl_lahir,#v_tgl_wafat').daterangepicker({
          singleDatePicker: true,
          singleClasses: "picker_3",
          locale: {
              format: 'DD/MM/YYYY'
          }
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
    });    

    $('#demolist li a').on('click', function(){
        $('#datebox').val($(this).html());
    });

/*===================================================================================================================== */
function show_table_keluarga(){
    //alert(nilicombo);
    $('#table').removeAttr();
    tableme=$('#table').DataTable ({
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
            "url": "<?php echo base_url(); ?>index.php/Silsilah/data_show_table_keluarga",
            "type": "POST"
        },
        "paging": true,
        "pageLength": 20,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "bDestroy": true
    });
}

/*===================================================================================================================== */
function show_table_keluarga_all(){
    //alert(nilicombo);
    $('#table_all').removeAttr();
    tableme_all=$('#table_all').DataTable ({
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
            "url": "<?php echo base_url(); ?>index.php/Silsilah/data_show_table_keluarga_all",
            "type": "POST"
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

//erzan 
/*===================================================================================================================== */
function get_child(){

  var id = 1;

  $.extend({
    xResponse: function () {
        // local var
        var json_master = null;
        // jQuery ajax
        $.ajax({
            url: "<?php echo base_url()?>index.php/silsilah/get_child/"+id,
            type: "GET",
            async: false,
            success: function (json) {
                //console.log(json);
                json_master = json;
            }
        });
        // Return the response text
        return json_master;
    }
  });

}
/*===================================================================================================================== */
function get_master(){

  var temp_ibu = [];
  var temp_anak = [];
  var main = [];
  var temp_mother;

  $.ajax({
      url: "<?php echo base_url()?>index.php/silsilah/get_parent",
      type: "GET",
      success: function (json) {
          //console.log(json);
          var obj = JSON.parse(json);
          //alert("json : " + obj[0].id_parent);

           get_child();
           var xData = $.xResponse();
           var obj_child = JSON.parse(xData);

            //looping child
              $.each(obj_child, function(index, val) {

                //console.log(val.id_relasi);
                  //jika ibu
                  if(val.id_relasi == 2){
                       temp_mother = {
                        text: { 
                                name: val.nama_view,
                                title: "Chief Business Development Officer"
                              },
                        link: {
                            href: "javascript:show_data_proses_detail('2','"+val.nama_view+"')",
                        },
                        image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>"
                      }
                      temp_ibu.push(temp_mother);
                  }
                  else{
                      var temp_child = {
                            HTMLclass: 'blue',
                            text:{
                                name: val.nama_view,
                                title: val.id_relasi
                            },
                            link: {
                                href: "javascript:show_data_proses_detail('2','"+val.nama_view+"')",
                            },
                            image:  "<?php echo base_url('arsip/images/headshots/10.jpg'); ?> "
                        }
                        temp_anak.push(temp_child);
                  }

                  
              });

              console.log("temp_ibu : ", temp_ibu);
              console.log("temp_anak : ", temp_anak);

          var config = {
            container: "#custom-colored",

            nodeAlign: "BOTTOM",
            animateOnInit: true,
            levelSeparation:    70,
            siblingSeparation:  60,            
            
            connectors: {
                type: "step",
                style: {
                    "stroke-width": 2,
                    "stroke": "#ccc",
                    "stroke-dasharray": "--", //"", "-", ".", "-.", "-..", ". ", "- ", "--", "- .", "--.", "--.."
                    "arrow-end": "classic-wide-long"
                }
            },
            node: {
                HTMLclass: 'nodeExample1',
                collapsable: true
            },
            animation: {
                nodeAnimation: "easeOutBounce",
                nodeSpeed: 700,
                connectorsAnimation: "bounce",
                connectorsSpeed: 700
            }
        },
        ciso_test = {
            connectors: {
                    type: "curve",
                    style: {
                        stroke: "#ED0505"
                    }
                },
            text: { 
                    name: obj[0].nama_view ,
                    title: obj[0].id_relasi
                  },
                  
            link: {
                href: "javascript:show_data_proses('2','"+obj[0].nama_view+"')",
            },
            HTMLclass: "the-parent",
            children: [
                temp_mother,
                {
                    pseudo: true,
                    children: temp_anak,
                },

            ],
            image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> "
        },
        
        chart_config = [
            config,
            ciso_test
        ];

        //create sililah
        new Treant( chart_config );

          //json_master = json;
      }
  });

}
//end erzan

/*===================================================================================================================== */
    function show_data_proses_from(vproses,vid){
        var mykode = vid.id;
        myproses = vproses;
        var namaview = $('#n_nama_view').text();
        var id_vs_relasi = $('#n_id_vs_relasi').text();
        //var myid = explode ("|",$id_vs_relasi)
        my_id_parent = id_vs_relasi.split("|", 1);
        //$('#id_parent') = my_id_parent;
        //alert("vid " + myid);        

        if ( myproses == '2' ) {
           //alert(myproses);
            if ( namaview.length == 0) {
                alert("Pilih Nama Keluarga Pada Grid Keluarga atau Kotak Nama keluarga pada Diagram Silsilah.");
                $('#mymodalform').modal('hide');
            } else {
                $('#mymodalform').modal('show');
                $('#mymodallabel2').html('Edit Data Identitas');
            }
            $.ajax ({
                url: "<?php echo base_url(); ?>index.php/Silsilah/show_silislah_label_id",
                type: "POST",
                data: {"id_vs_relasi":id_vs_relasi},
                dataType: "JSON",
                success: function(data) {
                    //alert('hello '+data.hidup);
                    $('#v_id').val(data.id_child); 
                    $('#v_id_relasi').val(data.id_relasi); 

                    $('#v_nama_view').val(data.nama_view);
                    $('#v_nama_depan').val(data.nama_depan);
                    $('#v_nama_belakang').val(data.nama_belakang);
                    $('#v_tempat_lahir').val(data.tempat_lahir);
                    $('#v_tgl_lahir').val(data.tgl_lahir);
                    $('#v_tempat_wafat').val(data.tempat_wafat);
                    $('#v_tgl_wafat').val(data.tgl_wafat);
                    $('#v_keterangan').val(data.keterangan);

                    if (data.hidup == 0) {
                        $("#v_hidup").prop("checked", true);
                        $("#v_tempat_wafat").removeAttr('disabled');
                        $("#v_tgl_wafat").removeAttr('disabled');
                    } else {
                        $("#v_hidup").prop("checked", false);
                        $('#v_tempat_wafat').attr('disabled', 'disabled');
                        $('#v_tempat_wafat').val('');
                        $('#v_tgl_wafat').attr('disabled', 'disabled');
                        $('#v_tgl_wafat').val('');
                    }
                                       
                }
            });
        } else if ( myproses == '1' ) {
            //alert(myproses);
            $('#v_id').val(''); 
            $('#v_id_relasi').val(mykode); 
            $('#v_id_parent').val(my_id_parent); 

            $('#v_nama_view').val('');
            $('#v_nama_depan').val('');
            $('#v_nama_belakang').val('');
            $('#v_tempat_lahir').val('');
            $('#v_tgl_lahir').val('');
            $('#v_tempat_wafat').val('');
            $('#v_tgl_wafat').val('');
            $('#v_keterangan').val('');
            $('#mymodallabel2').html('<h4 class="modal-title">Tambah Data Identitas</h4>');
        } else {
           //alert(myproses);
          $.ajax ({
                url: "<?php echo base_url(); ?>index.php/Silsilah/show_silislah_label_id",
                type: "POST",
                data: {"id_vs_relasi":id_vs_relasi},
                dataType: "JSON",
                success: function(data) {
                    //alert('hello '+data.nama_view);
                    $('#v_id').val(data.id_child); 
                    $('#v_id_relasi').val(data.id_relasi); 

                    $('#v_nama_view').val(data.nama_view);
                    $('#v_nama_depan').val(data.nama_depan);
                    $('#v_nama_belakang').val(data.nama_belakang);
                    $('#v_tempat_lahir').val(data.tempat_lahir);
                    $('#v_tgl_lahir').val(data.tgl_lahir);
                    $('#v_tempat_wafat').val(data.tempat_wafat);
                    $('#v_tgl_wafat').val(data.tgl_wafat);
                    $('#v_keterangan').val(data.keterangan);
                    simpan_silsilah();                                       
                }
            }); 
           
        }
    }
/*===================================================================================================================== */
    function show_data_proses_from_upload(vproses,vid){
        var mykode = vid.id;
        myproses = vproses;
        var namaview = $('#n_nama_view').text();
        var id_vs_relasi = $('#n_id_vs_relasi').text();
        //var myid = explode ("|",$id_vs_relasi)
        my_id_parent = id_vs_relasi.split("|", 1);
        //$('#id_parent') = my_id_parent;
        //alert("vid " + myid);        

        if ( myproses == '2' ) {
           //alert(myproses);
            if ( namaview.length == 0) {
                alert("Pilih Nama Keluarga Pada Grid Keluarga atau Kotak Nama keluarga pada Diagram Silsilah.");
                $('#mymodalformUpload').modal('hide');
            } else {
                $('#mymodalformUpload').modal('show');
                $('#mymodallabel_upl').html('Edit Data Identitas');
            }
            $.ajax ({
                url: "<?php echo base_url(); ?>index.php/Silsilah/show_silislah_label_id",
                type: "POST",
                data: {"id_vs_relasi":id_vs_relasi},
                dataType: "JSON",
                success: function(data) {
                    //alert('hello '+data.nama_view);
                    $('#v_id_f').val(data.id_child); 
                    $('#v_id_relasi_f').val(data.id_relasi);

                    $('#mymodallabel_upl').html('Edit Upload Identitas ');
                    $('#mymodallabel_upl_name').html('<p style="font-weight: bold;">('+data.nama_view+') </P><br/>');



                   //foto_path
                    //$('#n_myfoto_edit').html(data.foto_path);
                    var link_page  =  '<?php echo base_url()?>'+'arsip/images/fotoindvidu/big/bg_'+data.foto_path; 
                    $('<img src="'+ link_page +'">').load(function() {
                        $('#n_myfoto_edit').html(
                           '<img width="120" height="120" style="border:1px" src="'+link_page+'" >'
                        );
                    }).bind('error', function() {
                        $('#n_myfoto_edit').html(
                         ' <canvas id="myCanvas" width="120" height="120" style="border:1px solid #d3d3d3;">'+
                         ' </canvas>'
                        );
                    });                                      
                }
            });
        } 
    }
//================================================================================================================== 
    function show_data_proses(vproses,vid){
        var mykode = vid;
        myproses = vproses;
        /*alert("vproses " + vproses);*/
        /*alert("vid " + mykode);*/

        if ( myproses == '2' ) {
           //alert(myproses);
            $.ajax ({
                url: "<?php echo base_url(); ?>index.php/Silsilah/show_silislah_label_id",
                type: "POST",
                data: {"id_vs_relasi":mykode},
                dataType: "JSON",
                success: function(data) {
                    //alert('hello');
                      //$('#n_id_child').val(data.id_child);
                      $('#n_nama_view').html(data.nama_view);
                      $('#n_umur').html(data.umur);
                      $('#n_tempat_lahir').html(data.tempat_lahir);
                      $('#n_tgl_lahir').html(data.tgl_lahir_f);
                      $('#n_id_vs_relasi').html(data.id_child+"|"+data.id_relasi);
                      
                      //foto_path
                      var link_page  =  '<?php echo base_url()?>'+'arsip/images/fotoindvidu/big/bg_'+data.foto_path; 
                      $('<img src="'+ link_page +'">').load(function() {
                          $('#n_myfoto').html(
                             '<img width="120" height="120" style="border:1px" src="'+link_page+'" >'
                          );
                      }).bind('error', function() {
                          $('#n_myfoto').html(
                           ' <canvas id="myCanvas" width="120" height="120" style="border:1px solid #d3d3d3;">'+
                           ' </canvas>'
                          );
                      });
                }
            });
       } 
    }
//================================================================================================================== 
    function show_data_proses_detail(vproses,vid){
        var mykode = vid;
        myproses = vproses;
        /*alert("vproses " + vproses);
        alert("vid " + vid);*/
        if ( vproses == '2' ) {
           //alert(myproses);
            $.ajax ({
                url: "<?php echo base_url(); ?>index.php/Silsilah/show_silislah_detail_id",
                type: "POST",
                data: {"nikename":vid},
                dataType: "JSON",
                success: function(data) {
                    //$('#n_nama_view').val(data.nama_view);
                    //$('#nikename').val(data.nikename);
                      $('#n_nama_view').html(data.nama_view);
                }
            });
        } else {
            alert(myproses);
        }
    }
// ================================================================================================================= 
    function simpan_silsilah(){
     //fnmoalert("hello ....."+myproses);
     var mydata;
        mydata = new FormData($('#form-Silsilah')[0]);
        mydata.append( 'n_proses', myproses);
        //alert(myproses);

        $.ajax ({
            url: "<?php echo base_url(); ?>index.php/Silsilah/simpan_silislah",
            type: "POST",
            data: mydata, 
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            beforeSubmit: function() {
                $('#btn_simpan_silsilah').attr('disabled', 'disabled');
                $('#btn_simpan_silsilah').button('loading');
            },
            success: function(msg) {
                //console.log(msg.status);
                $('#btn_simpan_silsilah').removeAttr('disabled');
                $('#btn_simpan_silsilah').button('reset');

                if (msg.status=='1') {
                   alert(msg.pesan);
                } else if (msg.status=='2') {                  
                    show_table_keluarga();
                   alert(msg.pesan);
                }
            }
        });
    }
// ================================================================================================================= 
    function simpan_silsilah_foto(){
     //fnmoalert("hello ....."+myproses);
     var mydata;
        mydata = new FormData($('#form-Silsilah-foto')[0]);
        mydata.append( 'n_proses', myproses);
        //alert(myproses);

        $.ajax ({
            url: "<?php echo base_url(); ?>index.php/Silsilah/simpan_silislah_foto",
            type: "POST",
            data: mydata, 
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            beforeSubmit: function() {
                $('#btn_simpan_silsilah').attr('disabled', 'disabled');
                $('#btn_simpan_silsilah').button('loading');
            },
            success: function(msg) {
                //console.log(msg.status);
                var mykey = $('#v_id_f').val()+"|"+$('#v_id_relasi_f').val();
                $('#btn_simpan_silsilah').removeAttr('disabled');
                $('#btn_simpan_silsilah').button('reset');

                if (msg.status=='1') {
                    alert(msg.pesan);
                } else if (msg.status=='2') {                  
                    show_data_proses_from_upload('2', 'xx');
                    show_data_proses('2', mykey);
                    $('#fileberkas').val('');
                    alert(msg.pesan);
                }
            }
        });
    }
    
// ================================================================================================================= 
    function showsilsilah_db(){
      $.ajax ({
          url: "<?php echo base_url(); ?>index.php/Silsilah/show_silislah_tree",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            console.log(data);
            var config = {
                container: "#custom-colored",
                //rootOrientation:  'NORTH', // NORTH || EAST || WEST || SOUTH
                hideRootNode: true,
                siblingSeparation:   40,
                subTeeSeparation:    30,
                
                // animasi ngak bisa ?
                nodeAlign: "BOTTOM",
                //animateOnInit: true,
                levelSeparation:    70,
                onnectors: {
                    type: "step",
                    style: {
                      "stroke-width": 2,
                      "stroke-linecap": "round",
                      "stroke": "0001EA",//"#ccc",
                      "arrow-end": "classic-wide-long",
                    },
                },
                node: {
                    HTMLclass: 'nodeExample1',
                    //collapsable: true
                },
                animation: {
                    nodeAnimation: "easeOutBounce",
                    nodeSpeed: 700,
                    connectorsAnimation: "bounce",
                    connectorsSpeed: 700
                }
            },
            root = {};

            chart_config = [config,root];

            for (var key in data.kelurga) {   
                //alert(data.kelurga[key].nama_view) //alert Anushka, Shreya, Kajal
                //buat ayah
                var myparent
                ttl = data.kelurga[key].tgl_lahir;
                ttl = ttl.substr(0, 4);
                var today = new Date();
                var ths    = today.getFullYear();
                var umur = 0;
                if ( data.kelurga[key].status == 1) {
                   umur = (ths-ttl);
                } else {
                   umur = 0;
                };
                //var link_foto  =  '<?php echo base_url()?>'+'arsip/images/fotoindvidu/'+ data.kelurga[key].foto_path; 
                var link_foto  = '<?php echo base_url()?>'+'arsip/images/fotoindvidu/big/bg_'+data.kelurga[key].foto_path;
                
                var mynode = [];
                //var myparent = [];
                
                var id_key          = data.kelurga[key].id_child;
                var id_key_parent   = data.kelurga[key].id_parent;
                 a = 'varname'+id_key;
                 str = a+' = "varname'+ id_key +'"';
                 eval(str);
                 mynode_name = eval(('varname').concat(id_key));
                 alert( 'node = '+ mynode_name );

                if ( data.kelurga[key].id_parent == '') {
                   myparent = root;
                } else { 
                 ax = 'varname'+id_key_parent;
                 strx = ax+' = "varname'+ id_key_parent +'"';
                 eval(strx);
                 mynode_namex = eval(('varname').concat(id_key_parent));
                 //alert( 'node = '+ mynode_name );
                 myparent = mynode_namex;
                };

                mynode_name = {
                    parent: myparent,
                    connectors: {
                            type: "curve",
                            style: {
                                stroke: "#ED0505"
                            }
                        },
                    text: { 
                            name  : data.kelurga[key].nama_view+'--'+data.kelurga[key].id_child+"==",
                            title : ttl +" | "+ umur,
                            class : "cuk"
                          },                        
                    link: {
                        href: "javascript:show_data_proses('2','"+data.kelurga[key].id_child+"|"+data.kelurga[key].id_relasi+"')",
                    },
                    HTMLclass: "the-parent",
                    HTMLid: mynode_name,
                    image:  link_foto,
                };

                /*if ( data.kelurga[key].id_parent == '') {
                   myparent = mynode_name;
                } */

                console.log(mynode_name);

                //myparent = mynode_name;
                
                console.log("aaaa "+myparent);
                chart_config.push(mynode_name);
          }
          console.log("hello"+mynode.toString());
            new Treant( chart_config );
          },
          error: function () {
            alert("Error : Menampilkan Diagram Silsilah.");
          }  
      });
    }
    function showsilsilah(){
      $.ajax ({
          url: "<?php echo base_url(); ?>index.php/Silsilah/show_silislah_tree",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            console.log(data);
            var str;
            var config = {
                container: "#custom-colored",

                nodeAlign: "BOTTOM",
                animateOnInit: true,
                levelSeparation:    70,
                siblingSeparation:  60,          
                
                connectors: {
                    type: "step",
                    /*style: {
                        "stroke-width": 2,
                        "stroke": "#ccc",
                        "stroke-dasharray": "--", //"", "-", ".", "-.", "-..", ". ", "- ", "--", "- .", "--.", "--.."
                        "arrow-end": "classic-wide-long"
                    }*/
                    style: {
                      "stroke-width": 2,
                      "stroke-linecap": "round",
                      "stroke": "0001EA",//"#ccc",
                      "arrow-end": "classic-wide-long",
                    },
                },
                node: {
                    HTMLclass: 'nodeExample1',
                    //collapsable: true
                },
                animation: {
                    nodeAnimation: "easeOutBounce",
                    nodeSpeed: 700,
                    connectorsAnimation: "bounce",
                    connectorsSpeed: 700
                }
            },

            chart_config = [config];

            ayah = {
              connectors: {
                      type: "curve",
                      style: {
                          stroke: "#ED0505"
                      }
                  },
              text: { 
                      name: "Peri Ahmad Permana" ,
                      title: "Suami",
                      class: "cuk"
                    },
                    
              link: {
                  href: "javascript:show_data_proses('2','Peri Ahmad Permana')",
              },
              HTMLclass: "the-parent",
              image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ",
          };
          chart_config.push(ayah);
          for (var key in data.kelurga) {   
                //alert(data.kelurga[key].nama_view) //alert Anushka, Shreya, Kajal
                //buat ayah
                var ttl = data.kelurga[key].tgl_lahir;
                ttl = ttl.substr(0, 4);
                var today = new Date();
                var ths    = today.getFullYear();
                var umur = 0;
                if ( data.kelurga[key].status == 1) {
                   umur = (ths-ttl);
                } else {
                   umur = 0;
                };

                ayah2 = {
                  connectors: {
                          type: "curve",
                          style: {
                              stroke: "#ED0505"
                          }
                      },
                  text: { 
                          name: "Peri Ahmad Permana" ,
                          title: "Suami",
                          class: "cuk"
                        },
                        
                  link: {
                      href: "javascript:show_data_proses('2','Peri Ahmad Permana')",
                  },
                  HTMLclass: "the-parent",
                  image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ",
              };
              chart_config.push(ayah2);
          }
           /* for (var key in data.kelurga) {   
                //alert(data.kelurga[key].nama_view) //alert Anushka, Shreya, Kajal
                //buat ayah
                ttl = data.kelurga[key].tgl_lahir;
                ttl = ttl.substr(0, 4);
                var today = new Date();
                var ths    = today.getFullYear();
                var umur = 0;
                if ( data.kelurga[key].status == 1) {
                   umur = (ths-ttl);
                } else {
                   umur = 0;
                };

                ayah = {
                    connectors: {
                            type: "curve",
                            style: {
                                stroke: "#ED0505"
                            }
                        },
                    text: { 
                            name  : data.kelurga[key].nama_view ,
                            title : ttl +" | "+ umur,
                            class : "cuk"
                          },
                          
                    link: {
                        href: "javascript:show_data_proses('2','Peri Ahmad Permana')",
                    },
                    HTMLclass: "the-parent",
                    image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> "
                };
                chart_config.push(ayah);

                if ( (data.kelurga[key].relasi_info == 'Suami/Istri') && (data.kelurga[key].kelamin == 'L') ) {
                    //alert(data.kelurga[key].nama_view);
                    ayah = {
                        connectors: {
                                type: "curve",
                                style: {
                                    stroke: "#ED0505"
                                }
                            },
                        text: { 
                                name  : data.kelurga[key].nama_view ,
                                title : ttl +" | "+ umur,
                                class : "cuk"
                              },
                        link: {
                            href: "javascript:show_data_proses('2','"+data.kelurga[key].nama_view+"' )",
                        },
                        image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> "
                    };
                     chart_config.push(ayah);
                } else if ( (data.kelurga[key].relasi_info == 'Suami/Istri') && (data.kelurga[key].kelamin == 'P') ) {
                    //alert(data.kelurga[key].nama_view);
                    ibu =  {
                        HTMLclass: "the-parent",
                        parent: ayah,
                        text: { 
                                name  : data.kelurga[key].nama_view ,
                                title : ttl +" | "+ umur,
                              },
                        link: {
                            href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                        },
                        image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>"
                  };
                  chart_config.push(ibu);
                } else  if ( (data.kelurga[key].relasi_info == 'Anak Perempuan') || (data.kelurga[key].relasi_info == 'Anak Laki') ){
                    //alert(data.kelurga[key].nama_view);
                    anak =  {
                        //pseudo: true,
                        parent: ayah,
                        HTMLclass: 'blue',
                        text:{
                            name  : data.kelurga[key].nama_view ,
                            title : ttl +" | "+ umur,
                        },
                        link: {
                            href: "javascript:show_data_proses('2','Salma Tufahati')",
                        },
                        image:  "<?php echo base_url('arsip/images/headshots/10.jpg'); ?> "
                    };

                    chart_config.push(anak);
                    anak2 =  {
                        //pseudo: true,
                        parent: ibu,
                        HTMLclass: 'blue',
                        text:{
                            name  : data.kelurga[key].nama_view ,
                            title : ttl +" | "+ umur,
                        },
                        link: {
                            href: "javascript:show_data_proses('2','Salma Tufahati')",
                        },
                        image:  "<?php echo base_url('arsip/images/headshots/10.jpg'); ?> "
                    };

                    chart_config.push(anak);
                }               
            },*/

            //create sililah
            new Treant( chart_config );

          },
          error: function () {
            alert("Error : Menampilkan Diagram Silsilah.");
          }  
      });
    }

  // ================================================================================================================= 
    function showsilsilah_mm(){
       var data = [
        { "id" : "root", "view" : "Adis root", "title" : "23 | 3333", "image"  :  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ", "contact" : "Bandung"   },
        { "id" : "a1",   "parentId" : "root", "view" : "Adis a1", "title" : "23 | 3333","image"  :  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ",},
        { "id" : "a2",   "parentId" : "a1", "view" : "Adis a2", "title" : "23 | 3333", "image"  :  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ",},
        { "id" : "a3",   "parentId" : "a2", "view" : "Adis a3", "title" : "23 | 3333", "image"  :  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ", },
        { "id" : "b1",   "parentId" : "root", "view" : "Adis b1", "title" : "23 | 3333","image"  :  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ", },
        { "id" : "b2",   "parentId" : "b1",   "view" : "Adis b2", "title" : "23 | 3333","image"  :  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ", },
        { "id" : "b3",   "parentId" : "b1",   "view" : "Adis b3", "title" : "23 | 3333","image"  :  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ", "pseudo" : "true",},
        { "id" : "b31",   "parentId" : "b3",   "view" : "Adis b31", "title" : "23 | 3333","image"  :  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ", },
        { "id" : "b32",   "parentId" : "b3",   "view" : "Adis b32", "title" : "23 | 3333","image"  :  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ", },
        { "id" : "b33",   "parentId" : "b3",   "view" : "Adis b33", "title" : "23 | 3333","image"  :  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ", }
      ];

      var options = {
        childKey  : 'id',
        parentKey : 'parentId',
        viewkey   : 'view',
        titlekey  : 'title',
        imagekey  : 'image',
        pseudokey : 'pseudo'
      };
      var tree = walkTree(listToTree(data, options), pruneChildren);
       
      //document.body.innerHTML = '<pre>' + JSON.stringify(tree, null, 4) + '</pre>';
      var mytree =  /*'<pre>' +*/ JSON.stringify(tree, null, 4);
      console.log(mytree);

      var myobj = JSON.parse(mytree);

      var simple_chart_config = {
          chart: {
              container: "#custom-colored",
              //hideRootNode: true,
              siblingSeparation:   40,
              subTeeSeparation:    30,
              nodeAlign: "BOTTOM",
              animateOnInit: true,
              levelSeparation:    70,

              connectors: {
                  type: "curve",
                  style: {
                    "stroke-width": 2,
                    "stroke-linecap": "round",
                    "stroke": "#ED0505",
                  },
              },
              node: {
                  HTMLclass: 'nodeExample1',
                  collapsable: true
              },
              animation: {
                  nodeAnimation: "easeOutBounce",
                  nodeSpeed: 700,
                  connectorsAnimation: "bounce",
                  connectorsSpeed: 700
              }
          }, 
          nodeStructure: myobj
      };

      new Treant( simple_chart_config);
    }
    
// ================================================================================================================= 
    function showsilsilah_erzan(){
        var config = {
            container: "#custom-colored",

            nodeAlign: "BOTTOM",
            animateOnInit: true,
            levelSeparation:    70,
            siblingSeparation:  60,            
            
            connectors: {
                type: "step",
                style: {
                    "stroke-width": 2,
                    "stroke": "#ccc",
                    "stroke-dasharray": "--", //"", "-", ".", "-.", "-..", ". ", "- ", "--", "- .", "--.", "--.."
                    "arrow-end": "classic-wide-long"
                }
            },
            node: {
                HTMLclass: 'nodeExample1',
                collapsable: true
            },
            animation: {
                nodeAnimation: "easeOutBounce",
                nodeSpeed: 700,
                connectorsAnimation: "bounce",
                connectorsSpeed: 700
            }
        },
        ciso_test = {
            connectors: {
                    type: "curve",
                    style: {
                        stroke: "#ED0505"
                    }
                },
            text: { 
                    name: "Peri Ahmad Permana" ,
                    title: "Suami",
                    class: "cuk"
                  },
                  
            link: {
                href: "javascript:show_data_proses('2','Peri Ahmad Permana')",
            },
            HTMLclass: "the-parent",
            children: [
                {   
                    text: { 
                            name: "Siti Nurhafidah 123",
                            title: "Chief Business Development Officer"
                          },
                    link: {
                        href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                    },
                    image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>"
                },
                {
                    pseudo: true,
                    children: [
                        {
                            //HTMLclass: 'blue',
                            
                            connectors: {
                                type: "curve",
                                style: {
                                    stroke: "#ED0505"
                                }
                            },
                            text:{
                                name: "Salma Tufahati",
                                title: "Kakak ",
                            },
                            link: {
                                href: "javascript:show_data_proses('2','Salma Tufahati')",
                            },                            
                            HTMLclass: "the-parent",
                            children: [
                              {
                                  text: { 
                                          name: "Suami Salma",
                                          title: "Chief "
                                        },
                                  link: {
                                      href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                                  },
                                  image: "<?php echo base_url('arsip/images/headshots/9.jpg'); ?>"
                              },
                              {
                                pseudo : true,
                                children : [
                                          {
                                              HTMLclass: 'light-gray',
                                              text:{
                                                  name: "Anak Salma",
                                                  title: "Anak"
                                              },
                                              link: {
                                                  href: "javascript:show_data_proses('2','M.Farhan Muttaqin')",
                                              },
                                              image:  "<?php echo base_url('arsip/images/headshots/7.jpg'); ?> "
                                          },

                                ]

                              }


                            ],
                            image:  "<?php echo base_url('arsip/images/headshots/10.jpg'); ?> "

                        },

                        {
                            HTMLclass: 'light-gray',
                            text:{
                                name: "M.Farhan Muttaqin",
                                title: "Saudara Ke-2"
                            },
                            link: {
                                href: "javascript:show_data_proses('2','M.Farhan Muttaqin')",
                            },
                            image:  "<?php echo base_url('arsip/images/headshots/1.jpg'); ?> "
                        },
                        {
                            HTMLclass: 'light-gray',
                            text:{
                                name: "Luqman Hakim",
                                title: "Saudara Ke-3"
                            },
                            link: {
                                href: "javascript:show_data_proses('2','Luqman Hakim')",
                            },
                            image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> "
                        }
                    ],
                },
            ],
            image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> "
        },
        
        chart_config = [
            config,
            ciso_test
        ];

        //create sililah
        new Treant( chart_config );
    }
// ================================================================================================================= 
    function showsilsilah_manual(){
        var config = {
            container: "#custom-colored",

            nodeAlign: "BOTTOM",
            animateOnInit: true,
            levelSeparation:    70,
            siblingSeparation:  60,          
            
            connectors: {
                type: "step",
                /*style: {
                    "stroke-width": 2,
                    "stroke": "#ccc",
                    "stroke-dasharray": "--", //"", "-", ".", "-.", "-..", ". ", "- ", "--", "- .", "--.", "--.."
                    "arrow-end": "classic-wide-long"
                }*/
                style: {
                  "stroke-width": 2,
                  "stroke-linecap": "round",
                  "stroke": "#ccc",
                },
            },
            node: {
                HTMLclass: 'nodeExample1',
                //collapsable: true
            },
            animation: {
                nodeAnimation: "easeOutBounce",
                nodeSpeed: 700,
                connectorsAnimation: "bounce",
                connectorsSpeed: 700
            }
        },
        ayah = {
            connectors: {
                    type: "curve",
                    style: {
                        stroke: "#ED0505"
                    }
                },
            text: { 
                    name: "Peri Ahmad Permana" ,
                    title: "Suami",
                    class: "cuk"
                  },
                  
            link: {
                href: "javascript:show_data_proses('2','Peri Ahmad Permana')",
            },
            HTMLclass: "the-parent",
            image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> ",
        },
        ibu = {   
                parent: ayah,
                text: { 
                        name: "Siti Nurhafidah 123",
                        title: "Chief Business Development Officer"
                      },
                link: {
                    href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                },
                image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>"
                },
        ayah_ibu = {   
                parent: ayah,
                text: { 
                        name: "anak-anak",
                        title: "Chief Business Development Officer"
                      },
                link: {
                    href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                },
                image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>",
                pseudo: true,
        },
        anak1 = {   
                parent: ayah_ibu,
                text: { 
                        name: "anak-anak 1",
                        title: "Chief Business Development Officer"
                      },
                link: {
                    href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                },
                image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>",
        },
        anak2 = {   
                parent: ayah_ibu,
                connectors: {
                    type: "curve",
                    style: {
                        stroke: "#ED0505"
                    }
                },
                text: { 
                        name: "anak-anak 2",
                        title: "Chief Business Development Officer"
                      },
                link: {
                    href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                },
                image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>",
        },
        ayah2 = {
            parent: anak2,
            text: { 
                    name: "Peri Ahmad Permana" ,
                    title: "Suami",
                    class: "cuk"
                  },
                  
            link: {
                href: "javascript:show_data_proses('2','Peri Ahmad Permana')",
            },
            HTMLclass: "the-parent",
            image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> "
        },
        ayah_ibu2 = {   
                parent: anak2,
                text: { 
                        name: "anak-anak 21",
                        title: "Chief Business Development Officer"
                      },
                link: {
                    href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                },
                image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>",
                pseudo: true,
        },
        
        
        chart_config = [
            config,
            ayah,ibu,ayah_ibu,anak2,anak1,ayah2,ayah_ibu2
        ];


        //create sililah
        new Treant( chart_config );
    }
// ================================================================================================================= 
    function showsilsilah_xx(){
        var config = {
            container: "#custom-colored",

            nodeAlign: "BOTTOM",
            animateOnInit: true,
            levelSeparation:    70,
            siblingSeparation:  60,          
            
            connectors: {
                type: "step",
                /*style: {
                    "stroke-width": 2,
                    "stroke": "#ccc",
                    "stroke-dasharray": "--", //"", "-", ".", "-.", "-..", ". ", "- ", "--", "- .", "--.", "--.."
                    "arrow-end": "classic-wide-long"
                }*/
                style: {
                  "stroke-width": 2,
                  "stroke-linecap": "round",
                  "stroke": "0001EA",//"#ccc",
                  "arrow-end": "classic-wide-long",
                },
            },
            node: {
                HTMLclass: 'nodeExample1',
                //collapsable: true
            },
            animation: {
                nodeAnimation: "easeOutBounce",
                nodeSpeed: 700,
                connectorsAnimation: "bounce",
                connectorsSpeed: 700
            }
        },
        ayah = {
            connectors: {
                    type: "curve",
                    style: {
                        stroke: "#ED0505"
                    }
                },
            text: { 
                    name: "Peri Ahmad Permana" ,
                    title: "Suami",
                    class: "cuk"
                  },
                  
            link: {
                href: "javascript:show_data_proses('2','Peri Ahmad Permana')",
            },
            HTMLclass: "the-parent",
            image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> "
        },
        ibu = {   
                parent: ayah,
                text: { 
                        name: "Siti Nurhafidah 123",
                        title: "Chief Business Development Officer"
                      },
                link: {
                    href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                },
                image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>"
                },
        ayah_ibu = {   
                parent: ayah,
                text: { 
                        name: "anak-anak",
                        title: "Chief Business Development Officer"
                      },
                link: {
                    href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                },
                image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>",
                pseudo: true,
        },
        anak1 = {   
                parent: ayah_ibu,
                text: { 
                        name: "anak-anak 1",
                        title: "Chief Business Development Officer"
                      },
                link: {
                    href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                },
                image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>",
        },
        anak2 = {   
                parent: ayah_ibu,
                connectors: {
                    type: "curve",
                    style: {
                        stroke: "#ED0505"
                    }
                },
                text: { 
                        name: "anak-anak 2",
                        title: "Chief Business Development Officer"
                      },
                link: {
                    href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                },
                image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>",
        },
        ayah2 = {
            parent: anak2,
            text: { 
                    name: "Peri Ahmad Permana" ,
                    title: "Suami",
                    class: "cuk"
                  },
                  
            link: {
                href: "javascript:show_data_proses('2','Peri Ahmad Permana')",
            },
            HTMLclass: "the-parent",
            image:  "<?php echo base_url('arsip/images/headshots/11.jpg'); ?> "
        },
        ayah_ibu2 = {   
                parent: anak2,
                text: { 
                        name: "anak-anak 21",
                        title: "Chief Business Development Officer"
                      },
                link: {
                    href: "javascript:show_data_proses('2','Siti Nurhafidah')",
                },
                image: "<?php echo base_url('arsip/images/headshots/5.jpg'); ?>",
                pseudo: true,
        },
        
        
        chart_config = [
            config,
            ayah,ibu,ayah_ibu,anak2,anak1,ayah2,ayah_ibu2
        ];


        //create sililah
        new Treant( chart_config );
    }
// ================================================================================================================= 
        /*data = {"employees":[
            { "firstName":"Anushka", "lastName":"shetty" },
            { "firstName":"Shreya", "lastName":"Saran" },
            { "firstName":"Kajal", "lastName":"Agarwal" }
        ]};

        for (var key in data.employees) {   
            alert(data.employees[key].firstName) //alert Anushka, Shreya, Kajal
        }*/

</script>



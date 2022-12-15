<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
      </div>

      <div class="title_right">
      </div>
    </div>

    <div class="clearfix"></div>
    
    <!-- Awal page wrapper Table -->
    <div id="page-wrapper">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Master Kantor Cabang</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p></p>

                    <div class="dataTable_wrapper">
                        <a href="javascript:void(0);" class="btn btn-primary" onclick="show_master_cabang('1','')"><i class="fa fa-plus"></i> Tambah Data</a><br><br>
                        <div class="table-responsive">
                            <table style="font-size:9px; width:900px;" class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                    <tr>
                                       <!--  <th>NO</th> -->
                                        <th>KD UNIT</th>
                                        <th>NAMA UNIT</th>
                                        <th>KD KTRPUSAT</th>
                                        <th>ALAMAT UNIT</th>
                                        <th>MANAGER UNIT</th>
                                        <th>KOTA</th>         
                                        <th style="text-align:center;">AKSI</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- Akhir page wrapper Table-->

    <!-- Awal page wrapper Table -->
    <div id="form-master-cabang" style="display:none;">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Master Kantor Cabang</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <p></p>
                    
                    <form id="form-cabang-edit" enctype="multipart/form-data">
                        <div class="panel panel-info">
                            <div class="panel-body">
                                <div class="col-lg-4">      
                                    <div class="form-group">
                                        <label>Kode Unit</label>
                                        <input class="form-control numbersOnly" name="kdunitedit" id="kdunitedit" maxlength="6" readonly="">
                                    </div>                                     
                                    <div class="form-group">
                                        <label>Nama Unit</label>
                                        <input class="form-control" name="namaunitedit" id="namaunitedit" maxlength="30">
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Kantor Pusat</label>
                                        <select name="kdktrpusatedit" id="kdktrpusatedit" class="form-control">
                                        </select>
                                    </div>   

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Logo</label>
                                         </div>
                                         <center id="t_logo">
                                             
                                         </center>    
                                    </div>                                                                                                   
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Kode Bank Indonesia</label>
                                        <input class="form-control numbersOnly" name="kdbiedit" id="kdbiedit" maxlength="7">
                                    </div>      
                                    <div class="form-group">
                                        <label>Alamat Unit</label>
                                        <input class="form-control" name="alamatunitedit" id="alamatunitedit" maxlength="30">
                                    </div>
                                    <div class="form-group">
                                        <label>Manager Unit</label>
                                        <input class="form-control" name="managerunitedit" id="managerunitedit" maxlength="25">
                                    </div>
                                    <div class="form-group">
                                        <label>Tlp</label>
                                        <input class="form-control" name="tlpedit" id="tlpedit" maxlength="12" onkeypress="return angka(event)">
                                    </div>
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <input class="form-control" name="faxedit" id="faxedit" maxlength="12" onkeypress="return angka(event)">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="emailedit" id="emailedit" maxlength="30">
                                    </div>      
                                    <div class="form-group">
                                        <label>Kota</label>
                                        <input class="form-control" name="kotaedit" id="kotaedit" maxlength="30">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Web Hosting</label>
                                        <input class="form-control" name="httpedit" id="httpedit" maxlength="25">
                                    </div>
                                    <div class="form-group">
                                        <label>Logo File Path</label>
                                        <input type="file" class="form-control" name="logoedit" id="logoedit">
                                    </div>
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select name="leveledit" id="leveledit" class="form-control">
                                            <option value="0">Kantor Pusat</option>
                                            <option value="1">Cabang Pembantu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br/>

                            <div class="panel-footer">
                                <button class="btn btn-primary" id="btn_mstcab_simpan"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Harap Tunggu"><i class="fa fa-edit fa-fw"></i> Simpan </button>
                                <button class="btn btn-primary" id="btn_mscb_batal"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Harap Tunggu"><i class="fa fa-edit fa-fw"></i> Batal</button>
                            </div>
                        </div>
                    </form> 

              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- Akhir page wrapper Table-->


  </div>
</div>
<!-- /page content -->


<script type="text/javascript">
    var table_mst_cabang, v_proses, mykodeunit;

    v_proses = '';
    
    $(document).ready(function(){
        table_mst_cabang=$('#table').DataTable ({
            "language": {
              "emptyTable": "Tidak ada data",
              "zeroRecords": "Pencarian tidak ada",
            },
            "ajax": {
                "url": "<?php echo base_url(); ?>index.php/master_master/data_master_cabang",
                "type": "POST",
            },
            "paging": false,
            "pageLength": 10,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
        });

        combo_mst_perusahaan();

        $('#btn_mstcab_simpan').click(function(event) {
            //alert('tombol simpan');
            proses_simpan_mst_cabang()
        });

        $('#btn_mscb_batal').click(function(event) {
            event.preventDefault();
            tableshow();
        });

        $('.numbersOnly').keypress(function(event) {
            var charCode = (event.which) ? event.which : event.keyCode
            if ((charCode >= 48 && charCode <= 57)
                || charCode == 46 || charCode == 44 || charCode == 8
                || charCode == 37 || charCode == 39 || charCode == 9 || charCode == 13)
                return true;
            return false;
        }); 
    });

    function combo_mst_perusahaan() {
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/master_master/combo_data_kdktrpusat",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $("#kdktrpusatedit").html(data.data + data.data1);
            }
        });
    }

    function combo_data_kdktrpusat(kdktrpusat) {
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/master_master/combo_data_kdktrpusat",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $("#kdktrpusatedit").html(data.data1);
                $('#kdktrpusatedit option[value='+kdktrpusat+']').attr('selected', 'selected'); 
            }
        });
    }

    function tableshow(){
        $('#form-master-cabang').hide();
        $('#page-wrapper').show(); 
    }

    function show_master_cabang(vproses,kode){
        if (kode == '') {var mykode=''; } else { 
            var mykode=kode.id; 
                if (mykode == '') { mykode = kode;}
        }
        
        $('#page-wrapper').hide();
        $('#form-master-cabang').show();
        $('html, body').animate({
            scrollTop: $("#form-master-cabang").offset().top
        }, 1500);
        
        //alert("ccccc : "+vproses+" "+mykode);
        v_proses =  vproses;
        if (v_proses == 1) {
            var labelinfo = 'Tambah Master Kantor Cabang';
            $('#labelproses').html('<label>' + labelinfo + ' </label>');
           
            $('#kdunitedit').val(''); 
            $('#kdunitedit').removeAttr('readonly');
            $('#namaunitedit').val('');
            $('#kdktrpusatedit').val('');
            $('#jenisktredit').val('');
            $('#alamatunitedit').val('');
            $('#managerunitedit').val('');
            $('#tlpedit').val('');
            $('#faxedit').val('');
            $('#emailedit').val('');
            $('#kotaedit').val('');
            $('#httpedit').val('');
            $('#logoedit').val('');
            $('#t_logo').html('<label></label>');
            $('#leveledit option[value='+data.level+']').prop('selected', 'selected');  
            combo_mst_perusahaan();
        } else if (v_proses == 2) {
            var labelinfo = 'Edit Master Kantor Cabang';
            $('#labelproses').html('<label>' + labelinfo + ' </label>');

            $('#kdunitedit').attr("disable","disable");
            //$('#kdunitedit').val(mykode);
            $.ajax ({
                url: "<?php echo base_url(); ?>index.php/master_master/show_data_master_cabang",
                type: "POST",
                data: {"kode_mstcabang":mykode},
                dataType: "JSON",
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    $('#kdunitedit').val(data.kdunit);
                    $('#namaunitedit').val(data.namaunit);
                    $('#kdktrpusatedit').val(data.kdktrpusat);
                    $('#jenisktredit').val(data.jenisKtr);
                    $('#alamatunitedit').val(data.alamatunit);
                    $('#managerunitedit').val(data.managerunit);
                    $('#tlpedit').val(data.tlp);
                    $('#faxedit').val(data.fax);
                    $('#emailedit').val(data.email);
                    $('#kotaedit').val(data.kota);
                    $('#httpedit').val(data.http);
                    $('#leveledit option[value='+data.level+']').prop('selected', 'selected'); 
                    $('#t_logo').html( '<center class="bulat">'+data.logo+' </center>');

                    var kdktrpusat=data.kdktrpusat;
                    combo_data_kdktrpusat(kdktrpusat);
                }
            });
        }
    }

    function show_master_cabang2(vproses,mykode){
        var labelinfo = 'Edit Master Kantor Cabang';
        $('#labelproses').html('<label>' + labelinfo + ' </label>');

        $('#kdunitedit').attr("disable","disable");
        $.ajax ({
            url: "<?php echo base_url(); ?>index.php/master_master/show_data_master_cabang",
            type: "POST",
            data: {"kode_mstcabang":mykode},
            dataType: "JSON",
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                $('#kdunitedit').val(data.kdunit);
                $('#namaunitedit').val(data.namaunit);
                $('#kdktrpusatedit').val(data.kdktrpusat);
                $('#jenisktredit').val(data.jenisKtr);
                $('#alamatunitedit').val(data.alamatunit);
                $('#managerunitedit').val(data.managerunit);
                $('#tlpedit').val(data.tlp);
                $('#faxedit').val(data.fax);
                $('#emailedit').val(data.email);
                $('#kotaedit').val(data.kota);
                $('#httpedit').val(data.http);
                $('#leveledit option[value='+data.level+']').prop('selected', 'selected'); 
                $('#t_logo').html(data.logo);
                var kdktrpusat=data.kdktrpusat;
                combo_data_kdktrpusat(kdktrpusat);
            }
        });
    }

    function proses_simpan_mst_cabang() {
        //alert("test "+v_proses);
        var v_kdunit = $('#kdunitedit').val();

        $('#form-master-cabang').ajaxForm ({
                url: "<?php echo base_url(); ?>index.php/master_master/simpan_data_master_cabang",
                type        : "POST",
                data        : {"v_proses":v_proses,"v_kdunit":v_kdunit}, 
                mimeType    : "multipart/form-data",
                contentType : false,
                cache       : false,
                processData : false,
                dataType    : "JSON",
                beforeSubmit: function() {
                    $('#btn_mstcabang').attr('disabled', 'disabled');
                    $('#btn_mstcabang').button('loading');
                },
                success: function(msg) {
                    //console.log(msg.status);
                    $('#btn_mstcabang').removeAttr('disabled');
                    $('#btn_mstcabang').button('reset');

                    if (msg.status=='1') {
                       alert(msg.pesan);
                    } else if (msg.status=='2') { 
                       table_mst_cabang.ajax.reload(null,false);
                       show_master_cabang2("2",v_kdunit);
                       alert(msg.pesan);
                    }
                }
        });
    }

    function hapus_master_cabang(kode){
        v_proses = '0';
        if (kode == '') {var mykode=''; } else { 
            var mykode=kode.id; 
                if (mykode == '') { mykode = kode;}
        }
        v_kdunit = mykode;
         
        tanya = confirm("Anda Yakin Akan Menghapus Data Kantor Cabang ?");
        if (tanya == true) {
            $.ajax ({
                url: "<?php echo base_url(); ?>index.php/master_master/simpan_data_master_cabang",
                type        : "POST",
                data        : {"v_prosesh":v_proses,"v_kdunith":v_kdunit}, 
                dataType    : "JSON",
                success: function(msg) {
                    //console.log(msg.status);
                    if (msg.status=='1') {
                       alert(msg.pesan);
                    } else if (msg.status=='2') { 
                       table_mst_cabang.ajax.reload(null,false);
                       show_master_cabang2("2",v_kdunit);
                       alert(msg.pesan);
                    }
                }
            });
        }
        //alert("hello"+v_kdunit);
    }   
</script>
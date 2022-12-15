<?php

?>
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div class="title_left">
            <!-- <h3>Form Elements</h3> -->
          </div>
        
          <!-- <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Go!</button>
                </span>
              </div>
            </div> -->
          <!-- </div> -->
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Master Perusahaan <small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li> -->
                 <!--  <li><a class="close-link"><i class="fa fa-close"></i></a>
                 </li> -->
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <form id="form-perusahaan" enctype="multipart/form-data" class="form-horizontal form-label-left">

                    <div class="col-lg-4">      
                         <div class="form-group">
                             <label>Kode Kantor Pusat</label>
                            <input class="form-control" name="kdktrpusat" id="kdktrpusat" maxlength="2">
                         </div>                                     
                         <div class="form-group">
                             <label>Nama Kantor Pusat</label>
                                <input class="form-control" name="n_nama" id="n_nama" maxlength="30">
                         </div>
                          <div class="form-group">
                             <label>Alamat Kantor Pusat</label>
                                <input class="form-control" name="n_alamat" id="n_alamat" maxlength="50">
                         </div>                                                                                                      
                         <div class="form-group">
                             <label>Manager</label>
                                <input class="form-control" name="n_manager" id="n_manager" maxlength="25">
                         </div>         
                         <div class="form-group">
                            <label>Tlp</label>
                            <input class="form-control" name="n_tlp" id="n_tlp" maxlength="12" onkeypress="return angka(event)">
                         </div>
                         <div class="form-group">
                            <label>Fax</label>
                            <input class="form-control" name="n_fax" id="n_fax" maxlength="12" onkeypress="return angka(event)">
                         </div>
                    </div>
                    <div class="col-lg-4">                                      
                         <div class="form-group">
                                <label>Email </label>
                                <input class="form-control" name="n_email" id="n_email" maxlength="30">
                         </div>                                         
                         <div class="form-group">
                             <label>Kota</label>
                                <input class="form-control" name="n_kota" id="n_kota" maxlength="30">
                         </div>                                     
                         <div class="form-group">
                             <label>Alamat Web Hosting</label>
                             <input class="form-control" name="n_http" id="n_http" maxlength="30">
                         </div>                                     
                                                                                                                                                                                                                                                  
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="n_logo" id="n_logo" >
                         </div>
                         </br>
                         <center id="t_logo">
                         </center>    
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" name="n_logodb" id="n_logodb" maxlength="30" type="hidden">
                         </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <button class="btn btn-primary" id="button_simpan" onclick="simpan()" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Harap Tunggu"><i class="fa fa-save fa-fw"></i> Simpan</button>
                         </div>
                    </div>    

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->


<script type="text/javascript">
    $(document).ready(function(){
        //console.log('testttt ....');
        data_perushaan();
        //alert('hello...');
    });
    function angka(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }
    
    function data_perushaan() {
        //var JSON_adi = {logodb:'adiputra'};
        $.ajax ({
            url: "<?php echo base_url(); ?>index.php/master_master/data_master_perusahaan",
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('#kdktrpusat').val(data.kdktrpusat);
                $('#n_nama').val(data.namaktrpusat);
                $('#n_alamat').val(data.alamatktrpusat);
                $('#n_manager').val(data.managerktrpusat);
                $('#n_tlp').val(data.tlppusat);
                $('#n_fax').val(data.faxktrpusat);
                $('#n_email').val(data.email);
                $('#n_kota').val(data.kota);
                $('#n_http').val(data.http);
                $('#t_logo').html(data.logo);
                $('#n_logodb').val(data.logodb);
            }
        });
    }

    function simpan() {
        var kdktrpusat  =$('#kdktrpusat').val();
        var n_nama      =$('#n_nama').val();
        var n_alamat    =$('#n_alamat').val();
        var n_manager   =$('#n_manager').val();
        var n_tlp       =$('#n_tlp').val();
        var n_fax       =$('#n_fax').val();
        var n_email     =$('#n_email').val();
        var n_kota      =$('#n_kota').val();
        var n_http      =$('#n_http').val();
        $('#form-perusahaan').ajaxForm ({
            url: "<?php echo base_url(); ?>index.php/master_master/simpan_data_master_perusahaan",
            type: "POST",
            data: {"kdktrpusat":kdktrpusat, "n_nama":n_nama, "n_alamat":n_alamat, "n_manager":n_manager, "n_tlp":n_tlp, "n_fax":n_fax, "n_email":n_email, "n_kota":n_kota, "n_http":n_http},
            dataType: "JSON",
            beforeSubmit: function() {
                $('#button_simpan').attr('disabled', 'disabled');
                $('#button_simpan').button('loading');
            },
            success: function(msg) {
                $('#button_simpan').removeAttr('disabled');
                $('#button_simpan').button('reset');
                if (msg.status=='1') {
                    alert(msg.pesan);
                }
                else if (msg.status=='2') {
                    alert(msg.pesan);
                    var n_logo=$('#n_logo').val('');
                    data_perushaan();
                }
            }
        });
    }

</script>

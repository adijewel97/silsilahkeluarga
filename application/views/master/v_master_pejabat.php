<style type="text/css">
    .bulat{ 
        border-radius: 4em;
        width: 90px;
        height: 90px;
    }
</style>
  
<!-- start halaman --> 
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Master Pejabat</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Master Pejabat
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="show_master_jabatan('1','')"><i class="fa fa-plus" id="tambah"></i> Tambah Data</a><br><br>
                        
                        <div class="table-responsive">
                        <table style="font-size:12px;" class="table table-striped table-bordered table-hover" id="table-mst-jabatan">
                            <thead>
                                
                                <tr>
                                    <th>KDUNIT</th>
                                    <th>NIP</th>
                                    <th>KD JBT</th>
                                    <th>KD ATASAN</th>
                                    <th>JABATAN</th>
                                    <th>NAMA</th>
                                    <th>KDUSER</th>
                                    <th style="text-align:center;">AKSI</th>
                                </tr>
                            </thead>                            
                        </table>
                        </div>
                    </div>
                </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
</div>
<!-- /#wrapper -->
<!-- end halaman -->

<!-- End From Tambah -->
<div id="form-master-pejabat" style="display:none;">
    <div id="page-wrapper">      
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><label id="labelproses">Master Pejabat</label> </h1>
            </div>
            
        </div>  
         <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <form id="form-master-pejabat" enctype="multipart/form-data">
                        <div class="panel panel-info">
                            <div class="panel-body">
                                <div class="col-lg-4">      
                                    <div class="form-group">
                                        <label>Kode Unit *</label>
                                        <select name="kdunit_mspejabat" id="kdunit_mspejabat" class="form-control">
                                           <?php
                                                $sql = " select * from mst_cabang order by round(kdunit) ";
                                                $result = mysql_query($sql);
                                                while ($row = mysql_fetch_array($result)){
                                                  echo '<option value ="'.$row['kdunit'].'" >'.$row['namaunit'].'</option>';   
                                                }
                                            ?>  
                                        </select>
                                    </div>                                     
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select name="kdjabatan_mspejabat" id="kdjabatan_mspejabat" class="form-control">
                                            <?php
                                                $sql = " select * from mst_pejabat_kode ";
                                                $result = mysql_query($sql);
                                                while ($row = mysql_fetch_array($result)){
                                                  echo '<option value ="'.$row['kode'].'" >'.$row['namajabatan'].'</option>';   
                                                }
                                            ?> 
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan Atasan</label>
                                        <select name="kdjabatan_atn_mspejabat" id="kdjabatan_atn_mspejabat" class="form-control">
                                            <?php
                                                $sql = " select * from mst_pejabat_kode ";
                                                $result = mysql_query($sql);
                                                while ($row = mysql_fetch_array($result)){
                                                  echo '<option value ="'.$row['kode'].'" >'.$row['namajabatan'].'</option>';   
                                                }
                                            ?> 
                                        </select>
                                    </div>                                     
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Nama Pejabat / Petugas *</label>
                                        <input class="form-control" name="nama_mspejabat" id="nama_mspejabat">
                                    </div>      
                                    <div class="form-group">
                                        <label>Alamat Pejabat</label>
                                        <input class="form-control" name="alamat_mspejabat" id="alamat_mspejabat">
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Induk Pegawai (NIP) *</label>
                                        <input class="form-control" name="nip_mspejabat" id="nip_mspejabat" maxlength="12">
                                    </div>                                   
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Validasi</label>
                                        <input class="form-control" type="password"  name="validasi_mspejabat" id="validasi_mspejabat">
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Jabatan</label>
                                        <select name="ket_jabatan" id="ket_jabatan" class="form-control">
                                            <option value="P">Pejabat</option>
                                            <option value="S">Petugas/Staf</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>User Aplikasi (Approve) *</label>
                                        <select name="useridkode_mspejabat" id="useridkode_mspejabat" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input  type="checkbox" name="aktif_mspejabat" id="aktif_mspejabat" value="Aktif User">   Aktif User
                                    </div>
                                </div>
                            </div>
                            <br/>

                            <div class="panel-footer">
                                <button class="btn btn-primary" id="btn_mstpjb_simpan"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Harap Tunggu"><i class="fa fa-edit fa-fw"></i> Simpan </button>
                                <button class="btn btn-primary" id="btn_mspjb_batal"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Harap Tunggu"><i class="fa fa-edit fa-fw"></i> Batal</button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End From Tambah -->

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script type="text/javascript">
    var table_mst_pejabat, v_proses;

    $(document).ready(function(){
        //Setting tampilan table 
        table_mst_pejabat=$('#table-mst-jabatan').DataTable ({
            "language": {
              "emptyTable": "Tidak ada data",
              "zeroRecords": "Pencarian Tidak Ada",
              "search": "Cari data: ",
              "paginate": {
                  "previous": "Kembali",
                  "next": "Selanjutnya"
               },
            },
            "ajax": {
                "url": "<?php echo base_url(); ?>index.php/web/w_master_master/data_master_pejabat",
                "type": "POST",
            },
            "paging"   : true,
            "pageLength": 10,
            "lengthChange": false,
            "searching" : true,
            "ordering"  : false,
            "info"      : false,
            "autoWidth" : false,
            "columnDefs": [
                  { className: "dt-right", "targets": [3,5] }
                ]
        });

        $('#btn_mstpjb_simpan').click(function(event) {
            //alert('tombol simpan');
            //event.preventDefault();
            var vproses     = v_proses;
            var vkdunitnip  = $('#kdunit_mspejabat').val()+" "+$('#nip_mspejabat').val();
            proses_simpan_mst_pejabat(vproses,vkdunitnip);
        });

        $('#btn_mspjb_batal').click(function(event) {
            event.preventDefault();
            tableshow_mstpjb();
        });

        combo_useridkode();
    });

    function tableshow_mstpjb(){
        $('#form-master-pejabat').hide();
        $('#page-wrapper').show(); 
    }

    //tampilkan data di form Proses Tambah dan Edit Data
    function  show_master_jabatan(vproses,kode) {
        if (kode == '') {var mykode=''; } else { 
            var mykode=kode.id; 
                if (mykode == '') { mykode = kode;}
        }
        
        $('#page-wrapper').hide();
        $('#form-master-pejabat').show();
        $('html, body').animate({
            scrollTop: $("#form-master-pejabat").offset().top
        }, 1500);
        $('#btn_mstpjb_simpan').removeAttr('disabled');
        $('#btn_mstpjb_simpan').button('reset');
        
        
        v_proses =  vproses;
        if (v_proses == 1) {
            var labelinfo = 'Tambah Master Pejabat';
            $('#labelproses').html('<label>' + labelinfo + ' </label>');
           
            $('#nip_mspejabat').val('');
            $('#nip_mspejabat').removeAttr('readonly');
            $('#kdunit_mspejabat').val(''); 
            $('#kdjabatan_mspejabat').val('');
            $('#kdjabatan_atn_mspejabat').val('');
            $('#nama_mspejabat').val('');
            $('#alamat_mspejabat').val('');
            $('#validasi_mspejabat').val('');
            $('#aktif_mspejabat').val('');
            $('#useridkode_mspejabat').val('0');            
        } else if (v_proses == 2) {
            var labelinfo = 'Edit Master Pejabat';
            $('#labelproses').html('<label>' + labelinfo + ' </label>');

            //$('#kdunitedit').attr("disable","disable");
            $('#nip_mspejabat').attr("readonly","readonly");
            $.ajax ({
                url: "<?php echo base_url(); ?>index.php/web/w_master_master/show_data_master_jabatan_id",
                type: "POST",
                data: {"nip":mykode},
                dataType: "JSON",
                beforeSend: function() {
                    $('#btn_mstpjb_simpan').attr('disabled', 'disabled');
                    $('#btn_mstpjb_simpan').button('loading');
                },
                success: function(data) {
                    $('#btn_mstpjb_simpan').removeAttr('disabled');
                    $('#btn_mstpjb_simpan').button('reset');

                    $('#nip_mspejabat').val(data.nip);
                    $('#kdunit_mspejabat').val(data.kdunit); 
                    $('#kdjabatan_mspejabat').val(data.kode+data.kdsubbidang);
                    $('#kdjabatan_atn_mspejabat').val(data.kdatasan);
                    $('#nama_mspejabat').val(data.nama);
                    $('#alamat_mspejabat').val(data.alamat);
                    $('#validasi_mspejabat').val(data.validasi);
                    $('#ket_jabatan').val(data.ket);
                    $('#useridkode_mspejabat').val(data.useridkode);
                    if ( data.aktif == 1) {
                       document.getElementById("aktif_mspejabat").checked = true;
                    } else {
                       document.getElementById("aktif_mspejabat").checked = false; 
                    }
                    
                }
            });
        }

        //alert("ccccc : "+vproses+" "+mykode);
    }
   
    function combo_useridkode(){
        var mykdunit = $('#kdunit_mspejabat').val();
        $.ajax({
            url     : "<?php echo base_url(); ?>index.php/web/w_master_master/combo_useridkode",
            type    : "POST",
            dataType: "JSON",
            data    : {"mykdunit":mykdunit},
            success: function(data){
                $("#useridkode_mspejabat").html(data.data + data.data1);
            }
        });
    }

    //panggil controler proses edit dengan mengirim kdproses
    function proses_simpan_mst_pejabat(vprosesme,vkodeme) {            
        var vjabatan_mspejabat  = $('#kdjabatan_mspejabat option:selected').text();
        //var vket_jbtn           = $('#ket_jabatan').val();

        if (vprosesme == 0) { vmy_kodeme =  vkodeme.id; } else { vmy_kodeme =  vkodeme; }

        //alert('hello :'+vprosesme+"--"+vmy_kodeme+"--"+vjabatan_mspejabat+"--"+vket_jbtn+"--");
        $('#btn_mstpjb_simpan').removeAttr('disabled');
        $('#btn_mstpjb_simpan').button('reset');

        if (vprosesme == 0) { // proses delete
            tanya = confirm("Anda Yakin Akan Menghapus Data Master Pejabat ?");
            if (tanya == true) {
                var explode = vmy_kodeme.split(' ');
                vmy_kodeme  =  explode[0]+' '+ explode[1];
                var ket     =  explode[2];
                $.ajax ({
                        url: "<?php echo base_url(); ?>index.php/web/w_master_master/simpan_data_master_pejabat",
                        type        : "POST",
                        data        : {"v_proses":vprosesme,"v_kdunitnip":vmy_kodeme,"ket_jbt":ket}, 
                        dataType    : "JSON",
                        success: function(msg) {
                            if (msg.status=='1') {
                               alert(msg.pesan);
                            } else if (msg.status=='2') { 
                               table_mst_pejabat.ajax.reload(null,false);
                               alert(msg.pesan);
                            }
                        }
                });
            }
        } else { // proses insert dan update
            var vket_jbtn           = $('#ket_jabatan').val();
            $('#form-master-pejabat').ajaxForm ({
                    url: "<?php echo base_url(); ?>index.php/web/w_master_master/simpan_data_master_pejabat",
                    type        : "POST",
                    //data        : mydatatb,
                    data        : { "v_proses":vprosesme,"v_kdunitnip":vmy_kodeme, "v_jabatan":vjabatan_mspejabat}, 
                    dataType    : "JSON",
                    beforeSubmit: function() {
                        $('#btn_mstpjb_simpan').attr('disabled', 'disabled');
                        $('#btn_mstpjb_simpan').button('loading');
                    },
                    success: function(msg) {
                        //console.log(msg.status);
                        $('#btn_mstpjb_simpan').removeAttr('disabled');
                        $('#btn_mstpjb_simpan').button('reset');

                        if (msg.status=='1') {
                           alert(msg.pesan);
                        } else if (msg.status=='2') { 
                           table_mst_pejabat.ajax.reload(null,false);
                           alert(msg.pesan);
                        }
                    }
            });
        }
       
    }  
</script>

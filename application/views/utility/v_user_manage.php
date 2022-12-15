<?php 
    $user_kdunit    = $this->session->userdata('user_kdunit');
    $user_id        = $this->session->userdata('user_id'); 
    $user_group     = $this->session->userdata('user_group');
    $user_password  = $this->session->userdata('user_password');
    $user_name      = $this->session->userdata('user_name');
    $user_expire    = $this->session->userdata('user_expire');
    $userid         = $user_id;
 
?>

<div class="right_col" role="main">
    <div class="row">
        <div class="col-lg-2">
        </div> 

        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Reset/Rubah Password
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <center>
                                <div style="background-color:#ffe597;">
                                    <?php
                                        $msg = $this->session->flashdata('msg');
                                        if (! empty($msg)) {
                                            echo $msg;
                                        }
                                    ?>
                                </div>
                            </center> 
                            <form name="FormUsers" enctype="multipart/form-data">
                                <!-- <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3"> Kantor Pusat </div>
                                                        <div class="col-md-8">
                                                            <?php if ($user_group == "ADMIN") { ?>
                                                                <select name="kdktrpusat_user" id="kdktrpusat_user" class="form-control"> </select>
                                                            <?php } else { ?>
                                                                <select disabled="disabled" name="kdktrpusat_user" id="kdktrpusat_user" class="form-control"> </select>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">     
                                                    <div class="row">
                                                        <div class="col-md-3"> Kantor Cabang </div>
                                                        <div class="col-xs-8">
                                                            <?php if ($user_group == "ADMIN") { ?>
                                                                <select name="kdunit_user" id="kdunit_user" class="form-control"> 
                                                                </select>
                                                            <?php } else { ?>
                                                                <select disabled="disabled" name="kdunit_user" id="kdunit_user" class="form-control"> 
                                                                </select>
                                                            <?php } ?>    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                    
                                        </div>
                                    </div>    
                                </div> -->

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3"> User Id </div>
                                                        <div class="col-md-6">
                                                            <?php if ($user_group == "ADMIN") { ?>
                                                                <input type="text" class="form-control" name="userid" id="userid" placeholder="Masukan User Id" />
                                                            <?php } else { ?>
                                                                <input disabled="disabled" type="text" class="form-control" name="userid" id="userid" placeholder="Masukan User Id" />
                                                                <input type="hidden" class="form-control" name="userid_2" id="userid_2" placeholder="Masukan User Id" />
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <?php if ($user_group == "ADMIN") { ?>
                                                               <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"> <span class="fa fa-search"></span></button>
                                                            <?php } else { ?>
                                                               <button disabled="disabled" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"> <span class="fa fa-search"></span></button>
                                                            <?php } ?> 
                                                        </div>
                                                        <!-- menu clear -->
                                                        <div class="col-md-1">
                                                            <?php if ($user_group == "ADMIN") { ?>
                                                               <button type="button" class="btn btn-info myclass"> <span class="fa fa-plus-circle" onclick="bersihkan_inputan()"></span></button>
                                                            <?php } else { ?>
                                                               <button disabled="disabled" type="button" class="btn btn-info" onclick="bersihkan_inputan()"> <span class="fa fa-plus-circle"></span></button>
                                                            <?php } ?> 
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-3"> Nama User </div>
                                                        <div class="col-md-8">
                                                              <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Nama User Penguna" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php 
                                                  if ($user_group == "ADMIN") { ?>
                                                        <div class="form-group">    
                                                            <div class="row">
                                                                <div class="col-md-3"> Group Otoritas Menu </div>
                                                                <div class="col-xs-8">
                                                                    <select name="groups_user" id="groups_user" class="form-control"> 
                                                                        "<option value='<?php echo $user_group; ?>'><?php echo $user_group; ?></option>"
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php } else { ?>
                                                        <div class="form-group">    
                                                            <div class="row">
                                                                <div class="col-md-3"> Group Otoritas Menu </div>
                                                                <div class="col-xs-8">
                                                                    <select disabled="disabled" name="groups_user" id="groups_user" class="form-control"> 
                                                                        "<option value='<?php echo $user_group; ?>'><?php echo $user_group; ?></option>"
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php } 
                                                    if ($user_group == "ADMIN") { ?>
                                                    <div class="form-group">    
                                                        <div class="row">
                                                            <div class="col-md-3"> Password Lama </div>
                                                            <div class="col-xs-5">
                                                                 <input disabled="disabled" type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Masukan Password Lama" value= "lama" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                        <div class="form-group">    
                                                            <div class="row">
                                                                <div class="col-md-3"> Password Lama </div>
                                                                <div class="col-xs-5">
                                                                     <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Masukan Password Lama" value= "lama" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                 <?php } ?>
                                                <div class="form-group">    
                                                    <div class="row">
                                                        <div class="col-md-3"> Password Baru </div>
                                                        <div class="col-xs-6">
                                                             <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukan Password Baru"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">    
                                                    <div class="row">
                                                        <div class="col-md-3"> Password Baru (ulang) </div>
                                                        <div class="col-xs-6">
                                                             <input type="password" class="form-control" name="password_baru_cnf" id="password_baru_cnf" placeholder="Masukan Password Baru (ulang)"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                                  
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3"> Aktif User</div>
                                                <div class="col-md-8">
                                                    <?php if ($user_group == "ADMIN") { ?>
                                                        <input type="checkbox" id="expire_user" name="expire_user"/>
                                                    <?php } else {?>
                                                        <input disabled="disabled" type="checkbox" id="expire_user" name="expire_user"/>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3"> User Image (JPG)</div>
                                                <div class="col-xs-8">
                                                  <input type="file" class="form-control" name="fileberkas" id="fileberkas">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-3"> Kode User (Angka Max 5 )</div>
                                                <div class="col-md-8">
                                                    <?php if ($user_group == "ADMIN") { ?>
                                                        <input class="numbersOnly" type="text" id="n_useridkode" name="n_useridkode" maxlength="5" style="text-align: right" />
                                                    <?php } else {?>
                                                        <input  disabled="disabled" class="numbersOnly" type="text" id="n_useridkode" name="n_useridkode" maxlength="5" style="text-align: right" />
                                                    <?php } ?>
                                        
                                                </div>
                                            </div>
                                        </div> -->
                                        
                                        <br>                                          
                                        <div class="panel-footer">
                                        <center>
                                            <?php if ($user_group == "ADMIN") { ?>
                                                <button style="display:none" type="submit" name ="btn_create_user" id = "btn_create_user" class="btn btn-primary" onclick="create_passsword_proses()"><span class="glyphicon glyphicon-user"></span> Create New User</button>
                                                <button style="display:none" type="submit" name ="btn_batal_user" id = "btn_batal_user" class="btn btn-primary" onclick="reset_from_entry()"><span class="glyphicon glyphicon-user"></span> Batal </button>
                                            <?php } ?>

                                            <button type="submit" name ="btn_reset_psw" id ="btn_reset_psw" class="btn btn-primary" 
                                                   onclick="reset_passsword_proses()"><span class="glyphicon glyphicon-edit"></span> 
                                                   Reset Password
                                            </button>
                                            
                                        </center>  
                                        </div>
                                    </div>    
                                </div>

                            </form>
                        </div>                               
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />

</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cari User Yang akan di Rubah/Reset Password</h4>
            </div>
            <div class="modal-body">
                <table id="lookup" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>USER ID</th>
                            <th>NAMA</th>
                            <th>KD UNIT</th>
                            <th>GROUPS</th>
                            <th>AKTIF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Data mentah yang ditampilkan ke tabel    
                        $query  = " SELECT * FROM zsys_users   ";
                        $result2 = $this->db->query($query); 
                        foreach ($result2->result() as $data_row) {  
                            //print_r($data_row->user_id);      
                            ?>
                            <tr class="pilih" data-user_id  ="<?php echo $data_row->user_id ?>"
                                              data-nama     ="<?php echo $data_row->nama ?>"
                                              data-kdunit   ="<?php echo $data_row->kdunit ?>"
                                              data-groups   ="<?php echo $data_row->groups ?>"
                                              data-expire   ="<?php echo $data_row->expire ?>">
                                <td><?php echo $data_row->user_id; ?></td>
                                <td><?php echo $data_row->nama; ?></td>
                                <td><?php echo $data_row->kdunit; ?></td>
                                <td><?php echo $data_row->groups; ?></td>
                                <td><?php if ( $data_row->expire == 0) {echo 'AKTIF';} else {echo 'NONAKTIF';} ?></td> 

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<script type="text/javascript">
   
    $(document).on('click', '.myclass', function (e) {
        //alert('hello');
        $('#userid').val('');
        $('#nama_user').val('');
        $('#password_baru').val('');
        $('#password_baru_cnf').val('');
        $('#btn_create_user').show();
        $('#btn_batal_user').show();
        $('#btn_reset_psw').hide();
        $('#userid').focus();
    });

    $(document).on('click', '.pilih', function (e) {
        document.getElementById("userid").value         = $(this).attr('data-user_id');
        document.getElementById("nama_user").value      = $(this).attr('data-nama');
        $('#groups_user option[value='+$(this).attr('data-groups')+']').attr('selected', 'selected');
        var v_kdunit        = $(this).attr('data-kdunit');
        var v_kdktrpusat    = v_kdunit.substr(0,2);
        combo_mst_cabang(v_kdktrpusat,v_kdunit);
        $('#password_lama').val('lama');
        $('#password_baru').val('');
        $('#password_baru_cnf').val('');
        $('#myModal').modal('hide'); 
        show_data_user(document.getElementById("userid").value);              
    });

    $(document).ready(function(){
        var user_id       = '<?php echo $userid; ?> ';
        var user_kdunit   = $('#kdunit_user').val();
        var v_kdktrpusat  = $('#kdktrpusat_user').val();
       
        $('#userid').val(user_id);
        //combo_mst_perusahaan();

        //alert(user_kdunit);
        if ( user_kdunit == null ) {
            $('#kdunit_user').on('focusin',function(){
                var v_kdktrpusat = $('#kdktrpusat_user').val();
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/web/w_master_master/combo_data_kdunit_idktrpst",
                    type: "POST",
                    data:{"v_kdktrpusat":v_kdktrpusat},
                    dataType: "JSON",
                    success: function(data){
                        $("#kdunit_user").html(data.data + data.data1);
                    }
                });
            });
        } ;

        show_data_user(user_id);
        
        $('#groups_user').on('focusin',function(){
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Manage_user/combo_groups_user",
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    $("#groups_user").html(data.data + data.data1);
                }
            });
        }); 

        $('#btn_create_user').hide();
        $('#btn_reset_psw').show();
    });

    function show_data_user(vuser){
        var myuser_group       = '<?php echo $user_group; ?> ';   
        $('#userid_2').val(vuser);     
        //alert(vuser);
        $.ajax({
            url     : "<?php echo base_url(); ?>index.php/manage_user/show_data_user",
            type    : "POST",
            data    : {"v_user":vuser},
            dataType: "JSON",
            success: function(data){
                $('#nama_user').val(data.nama);
                $('#n_useridkode').val(data.useridkode);
                
                combo_user_groups(data.groups);

                if (data.expire == 0 ) { document.getElementById("expire_user").checked = true;
                    } else {document.getElementById("expire_user").checked = false; }
                if ( data.kdunit != null ) {
                    var v_kdunit        = data.kdunit;
                    var v_kdktrpusat    = v_kdunit.substr(0,2);
                    //combo_mst_cabang(v_kdktrpusat,v_kdunit);
                } 
            }
        });
    }

    /*function combo_mst_perusahaan() {
        $.ajax({
            url     : "<?php echo base_url(); ?>index.php/web/w_master_master/combo_data_kdktrpusat",
            type    : "POST",
            dataType: "JSON",
            success : function(data){
                $("#kdktrpusat_user").html(data.data1);
            }
        });
    }*/

    function combo_mst_cabang(v_kdktrpusat,v_kdunit) {
        $.ajax({
            url     : "<?php echo base_url(); ?>index.php/web/w_master_master/combo_data_kdunit_idktrpst",
            type    : "POST",
            data    :{"v_kdktrpusat":v_kdktrpusat},
            dataType: "JSON",
            success : function(data){
                $("#kdunit_user").html(data.data + data.data1);
                $('#kdunit_user option[value='+v_kdunit+']').attr('selected', 'selected');    
            }
        });
    }

    function combo_user_groups(vusergroups) {
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Manage_user/combo_groups_user",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $("#groups_user").html(data.data + data.data1);
                $('#groups_user option[value='+vusergroups+']').attr('selected', 'selected'); 
            }
        });
    }

    function reset_passsword_proses(){
        var user             = $('#userid').val();
        var password_l       = $('#password_lama').val();
        var password_b       = $('#password_baru').val();
        var password_bc      = $('#password_baru_cnf').val();
        var kdunit_user      = $('#kdunit_user').val();
        var groups_user      = $('#groups_user').val();
        var v_groups_user    = '<?php echo $user_group; ?>';

        /*var mydata;
          mydata = new FormData($('#FormUsers')[0]);*/
         /* mydata.append('n_proses', myproses_foto);
          mydata.append('n_idevent', $("#idevent").val());
          mydata.append('n_tglevent', $("#tglevent").val());*/

        //alert('helloo : '+myproses); 
        $('form[name="FormUsers"]').ajaxForm({
            url: "<?php echo base_url(); ?>index.php/Manage_user/update_user_password",
            type: "POST",
            /*data: JSON.stringify(mydata), 
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,*/
            contentType: "application/json",
            dataType: "JSON",
            beforeSubmit: function() {
                $('#btn_reset_psw').attr('disabled', 'disabled');
                $('#btn_reset_psw').button('loading');
            },
            success: function(msg) {
                $('#btn_reset_psw').removeAttr('disabled');
                $('#btn_reset_psw').button('reset');
                if (msg.status=='1') {
                    alert(msg.pesan);
                } else if (msg.status=='2') {
                   alert(msg.pesan);
                  /* setTimeout(function(){*/
                        location.reload();
                  /* },10000);*/
                }
            },
            error: function (request, error) {
                //console.log(arguments);
                alert(" Error : (Coba Klik Ulang Tombol ) --> " + error);
                $('#btn_reset_psw').removeAttr('disabled');
                $('#btn_reset_psw').button('reset');
            }
        });
    }

    function reset_from_entry () {
        $("FormUsers").reset();
    }

    function create_passsword_proses() {
        //alert('tambah data');
        var user             = $('#userid').val();
        var password_l       = $('#password_lama').val();
        var password_b       = $('#password_baru').val();
        var password_bc      = $('#password_baru_cnf').val();
        var kdunit_user      = $('#kdunit_user').val();
        var groups_user      = $('#groups_user').val();
        var v_groups_user    = '<?php echo $user_group; ?>';

        $('form[name="FormUsers"]').ajaxForm({
            url     : "<?php echo base_url(); ?>index.php/Manage_user/create_new_user",
            type    : "POST",
            data    : {"v_user":user, "password_l":password_l,"password_b":password_b, "password_bc":password_bc, "v_groups_user":v_groups_user},
            dataType: "JSON",
            beforeSubmit: function() {
                $('#btn_create_user').attr('disabled', 'disabled');
                $('#btn_create_user').button('Create New User');
            },
            success: function(msg) {
                $('#btn_create_user').removeAttr('disabled');
                $('#btn_create_user').button('reset');
                if (msg.status=='1') {
                    alert(msg.pesan);
                    $('#btn_reset_psw').show();
                } else if (msg.status=='2') {
                    alert(msg.pesan);
                    $('#btn_create_user').hide();
                    $('#btn_batal_user').hide();
                    $('#btn_reset_psw').show();
                }
            }
        });
    }

</script>


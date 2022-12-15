<?php 
    $user_kdunit    = $this->session->userdata('user_kdunit');
    $user_id        = $this->session->userdata('user_id'); 
    $user_group     = $this->session->userdata('user_group');
?>

<div id="wrapper">

    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Group User Aplikasi</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Group User Aplikasi
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
                                        <form role="form" name="FormUsers">

                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-4"> 
                                                                      <input type="checkbox"  id="group_baru" />   Group Otoritas Menu [v = Baru]
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <select name="groups_user" id="groups_user" class="form-control"> 
                                                                            "<option value='<?php echo $user_group; ?>'><?php echo $user_group; ?></option>"
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <input type='text' class='form-control' id='newgroup'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                                                                      
                                                    </div>
                                                </div>    
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        List Menu Aplikasi
                                                    </div>
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <div class="dataTable_wrapper">
                                                                        <div class="table-responsive">
                                                                           <div class="row col-md-12">
                                                                           <table class="table table-striped" id="tablelist">
                                                                               <thead id='thead'>
                                                                                    <tr>
                                                                                        <th  style="text-align:center;" >AKSI</th>
                                                                                        <th>MENU ID</th>
                                                                                        <th>URAIAN MENU</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tbody"></tbody>
                                                                            </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>                            
                                                            </div>
                                                        </div>    
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            List Group user
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <div class="dataTable_wrapper">
                                                                        <div class="table-responsive">
                                                                           <div class="row col-md-12">
                                                                           <table class="table table-striped" id="tablelistgroup">
                                                                                <thead id='thead'>
                                                                                    <tr>
                                                                                        <th  style="text-align:center;" >AKSI</th>
                                                                                        <th>MENU ID</th>
                                                                                        <th>URAIAN MENU</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="tbody"></tbody>
                                                                            </table>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>                            
                                                            </div>
                                                        </div>     
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
        </div>
    </div>
</div>


<script type="text/javascript">
    var table_lm;
    var table_lg;

    $(document).ready(function(){
        var vgroups = $('#groups_user').val();
        
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/web/w_manage_user/combo_groups_user",
            type: "POST",
            dataType: "JSON",
            success: function(data){
                $("#groups_user").html(data.data + data.data1);
            }
        });

        show_data_listmenu(vgroups)
        show_data_lismenugroups(vgroups);

        $('#groups_user').on('change',function(){
            var vgroups = this.value;
            show_data_listmenu(vgroups);
            show_data_lismenugroups(vgroups);    
        });

         $('#newgroup').attr('disabled', 'disabled');
         $('#group_baru').click(function(event) {
            if (document.getElementById ("group_baru").checked) {
              //alert("hello");
              $('#groups_user').attr('disabled', 'disabled');
              $('#newgroup').removeAttr('disabled');
            } else {
              $('#groups_user').removeAttr('disabled');  
              $('#newgroup').attr('disabled', 'disabled');
            }
        });
        
    });     

    function show_data_listmenu(vgroups){
        var mybody1_lm = '';
        $.ajax({
            type    : "post",
            url     : "<?php echo base_url(); ?>index.php/web/w_manage_user/show_data_list_menu",
            data    : {"v_groups":vgroups}, 
            dataType: "JSON",
            success: function(data) {   
                    myhead_lm =    
                        " <table class='table table-striped' id='tablelist'>     "+
                        " <thead id='thead'>                                     "+
                        "     <tr>                                               "+
                        "        <th  style='text-align:center;' >AKSI</th>      "+
                        "        <th>MENU ID</th>                                "+
                        "        <th>URAIAN MENU</th>                            "+ 
                        "     </tr>                                              "+
                        " </thead>                                               "+
                        " </table>                                               ";
                    
                
                $.each(data, function(index, element) {
                    for(var i=0;i<element.length;i++){     
                        var vnoitem_lm   = element[i][0];
                        var vitem_lm     = element[i][1];
                    
                        $proc = 'mytambahgroup("'+vnoitem_lm+'","'+vgroups+'")';                        
                        mytombol_lm = 
                            "<a href='javascript:void(0)' class='btn btn-xs btn-primary' title='Edit' onclick='"+$proc+"'><i class='fa fa-arrow-right'></i> </a>";
                        if (vnoitem_lm == '') {mytombol_lm='';}
                        mybody_lm =   
                              " <tr>                                                   "+
                              "   <td align='left'>"  + vnoitem_lm                +"</td> "+
                              "   <td>"               + vitem_lm                  +"</td> "+
                              "   <td align='center'>"+ mytombol_lm               +"</td> "+
                              "</tr>                                                  "; 
                        mybody1_lm =  mybody1_lm + mybody_lm; 
                    }
                });
                
                $('#tablelist').html(myhead_lm+mybody1_lm);
            }
        });
    }

    function show_data_lismenugroups(vgroups){
        var mybody1 = '';
        $.ajax({
            type    : "post",
            url     : "<?php echo base_url(); ?>index.php/web/w_manage_user/show_data_list_menu_groups",
            data    : {"v_groups":vgroups}, 
            dataType: "JSON",
            success: function(data) {   
                    myhead =    
                        " <table class='table table-striped'  id='tablelistgroup'>"+
                        " <thead id='thead'>                                     "+
                        "     <tr>                                               "+
                        "        <th  style='text-align:center;' >AKSI</th>      "+
                        "        <th>MENU ID</th>                                "+
                        "        <th>URAIAN MENU</th>                            "+ 
                        "     </tr>                                              "+
                        " </thead>                                               "+
                        " </table>                                               ";
                    
                
                    $.each(data, function(index, element) {
                        if (element.length > 0) {
                            for(var i=0;i<element.length;i++){     
                                var vnoitem   = element[i][0];
                                var vitem     = element[i][1];
                            
                                $proc = 'myhapusgroup("'+vnoitem+'","'+vgroups+'")';                         
                                mytombol = 
                                    "<a href='javascript:void(0)' class='btn btn-xs btn-primary' title='Edit' onclick='"+$proc+"'><i class='fa fa-arrow-left'></i> </a>";
                                if (vnoitem == '') {mytombol='';}
                                mybody =   
                                      " <tr>                                                   "+
                                      "   <td align='center'>"+ mytombol               +"</td> "+
                                      "   <td align='left'>"  + vnoitem                +"</td> "+
                                      "   <td>"               + vitem                  +"</td> "+
                                      "</tr>                                                   "; 
                                mybody1 =  mybody1 + mybody; 
                            }
                        }
                    });
                
                $('#tablelistgroup').html(myhead+mybody1);
            }
        });
    }

    function mytambahgroup(vnoitem,vgroups){
        var v_noitem = vnoitem; 
        var v_groups = vgroups;
        //alert('tambah '+Vnoitem+' gr '+vgroups);
        $.ajax({
            url     : "<?php echo base_url() ?>index.php/web/w_manage_user/insert_user_groups",
            data    : {"vnoitem":v_noitem, "vgroups":v_groups},
            type    : 'POST',
            dataType: 'JSON',
            success : function(msg) {
                if (msg.status=='1') {
                    $.MessageBox(msg.pesan);
                } else if (msg.status=='2') {
                    $.MessageBox(msg.pesan);
                    show_data_lismenugroups(v_groups);
                    show_data_listmenu(v_groups);
                }
            }
        });
    }

    function myhapusgroup(vnoitem,vgroups){
        var v_noitem = vnoitem; 
        var v_groups = vgroups;
        //alert('Hapus '+Vnoitem+' gr '+vgroups);
        $.ajax({
            url     : "<?php echo base_url() ?>index.php/web/w_manage_user/hapus_user_groups",
            data    : {"vnoitem":v_noitem, "vgroups":v_groups},
            type    : 'POST',
            dataType: 'JSON',
            success : function(msg) {
                if (msg.status=='1') {
                    $.MessageBox(msg.pesan);
                } else if (msg.status=='2') {
                    $.MessageBox(msg.pesan);
                    show_data_listmenu(v_groups);
                    show_data_lismenugroups(v_groups);
                }
            }
        });
    }

</script>


<!-- ====================================================================================================================== -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div id="view_event_detail" class="col-sm-9 mail_view">
                  </div>

                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <div>
                      <div class="x_title">
                        <br/>
                        <h2>Top Anggota Group</h2>
                        <div class="clearfix"></div>
                      </div>
                      <ul class="list-unstyled top_profiles scroll-view">
                          <?php
                          $q_user   = $this->db->query(
                                        " select * from zsys_users 
                                          where DATE_FORMAT(tgllogin,'%Y-%m-%d') <= DATE_FORMAT(SYSDATE(),'%Y-%m-%d')
                                          order by tgllogin DESC limit 5 "
                                      );
                          foreach ($q_user->result() as $info_topuser) {
                            # code...
                            ?>
                            <li class="media event">
                              <div class="profile_pic">
                                <img class="img-circle profile_img" src="<?php echo base_url('arsip/images/users/'.$info_topuser->foto_path); ?>">
                              </div>
                              <div class="media-body">
                                <br/>
                                <a class="title" href="#"><?php echo $info_topuser->user_id ?></a>
                                <p><small><?php echo $info_topuser->email ?> </small> </p>
                                <p><small><?php echo $info_topuser->tgllogin ?> </small></p>
                              </div>
                            </li>
                          <?php
                          }
                          ?>
                      </ul>
                    </div>
                  </div>
              </div>
       
              
          </div>
          <br />
        
        </div>
        <!-- /page content -->

    <script type="text/javascript">
    var table, html_foto_ut;
    $(document).ready(function(){
        show_event_last ();        
    });

    function show_data_event_detail(idevent,tglevent){
        $.ajax({
            url     :"<?php echo base_url(); ?>index.php/event/event_list_detail_data_show",
            type    :"POST",
            data    :{"idevent":idevent,"tglevent":tglevent},
            dataType:"JSON",
            success : function(data){
                //mystile     = 'helloo 2 : '+data.pesan;
                $('#view_event_detail').html(data.code_html);
            }
        });
    }

    function show_data_event_detail_foto_utama(pathfoto){
      //alert('hello men --> '+pathfoto);
      $('#fotoutama').html(
        '                <img src="'+pathfoto+'"  alt="..."/>'
      );
    }

    function show_event_last (){
        $.ajax({
            url     :"<?php echo base_url(); ?>index.php/event/show_event_last_data",
            type    :"POST",
            dataType:"JSON",
            success : function(data){
                //alert('helloo : '+data.idevent+'----'+data.tglevent);
                show_data_event_detail(data.idevent,data.tglevent);
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
  </script>
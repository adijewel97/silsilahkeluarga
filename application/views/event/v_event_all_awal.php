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

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Event Keluarga <small>(Happy Family)</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <!-- <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li> -->
                        </ul>
                      </li>
                      <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      
                      <div class="col-sm-3 mail_list_column">
                       <!--  <button id="compose" class="btn btn-sm btn-success btn-block" type="button">COMPOSE</button> -->
                       
                        <?php
                          $sqlme = 
                            " select *                                            ".
                            " from trs_event                                      ".
                            " order by tglevent desc                              ";

                          $html   = '';
                          $query  = $this->db->query($sqlme);
                          $result = $query->result(); //or $query->result_array() to get an array
                          //if( $query->num_rows() > 0) {
                              foreach( $result as $row )
                              {
                                $html .='<a href="#">';
                                $html .='<div class="mail_list">';
                                $html .='  <div class="left">';
                                $html .='    <i class="fa fa-circle"></i> <i class="fa fa-edit"></i>';
                                $html .='  </div>';
                                $html .='  <div class="right">';
                                $html .='    <h3>'.$row->judulevent.' <small> ('.
                                         $row->lokasi.') '.$row->tglkejadian.'</small></h3>';
                                $html .='<img src="'.base_url('arsip/images/event/'.$row->tglkejadian.' '.$row->idevent.'/'.
                                         $row->fotoutama).'" alt="..." style="width: 98px; height: 74px">';
                                $html .='    <p>'.$row->uraian.'</p>';
                                $html .='  </div>';
                                $html .='</div>';
                                $html .='</a>';                              
                                //echo $html;
                              /*  echo "<pre>";
                                print_r($row);
                                echo "</pre>";*/
                                /*echo base_url('arsip/images/event/'.$row->tglkejadian.' '.$row->idevent.'/'.
                                         $row->fotoutama);*/
                              }
                         /*  } else {
                              $html .='<a href="#">';
                              $html .='<div class="mail_list">';
                              $html .='  <div class="left">';
                              $html .='    <i class="fa fa-circle"></i> <i class="fa fa-edit"></i>';
                              $html .='  </div>';
                              $html .='  <div class="right">';
                              $html .='    <h3>No Event <small> .. </small></h3>';
                              $html .='    <p>Belum Ada Event Keluarga Saat ini ...</p>';
                              $html .='  </div>';
                              $html .='</div>';
                              $html .='</a>';
                              //echo $html;
                          }*/
                        ?>                          
                      </div>
                      <!-- /MAIL LIST -->

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-9 mail_view">
                        <div class="inbox-body">
                          <div class="mail_heading row">
                            <!-- <div class="col-md-8">
                              <div class="btn-group">
                                <button class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> Reply</button>
                                <button class="btn btn-sm btn-default" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Forward"><i class="fa fa-share"></i></button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                              </div>
                            </div>
                            <div class="col-md-4 text-right">
                              <p class="date"> 8:02 PM 12 FEB 2014</p>
                            </div> -->
                            <div class="col-md-12">
                              <h4> Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris sed congue orci. Donec ultrices faucibus rutrum.</h4>
                            </div>
                          </div>
                          <div class="sender-info">
                            <div class="row">
                              <div class="col-md-12">
                                <strong>Jon Doe</strong>
                                <span>(jon.doe@gmail.com)</span> to
                                <strong>me</strong>
                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="view-mail">
                              <div class="x_content">
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                  <div class="product-image">
                                    <img src="<?php echo base_url('arsip/images/event/2017-06-01 1/mancing Keluarga.jpg'); ?>" alt="..." />
                                  </div>
                                  <div class="product_gallery">
                                    <a>
                                      <img src="<?php echo base_url('arsip/images/event/2017-06-01 1/mancing2.jpg'); ?>"  alt="..." style="width: 98px; height: 74px"/>
                                    </a>
                                    <a>
                                      <img src="<?php echo base_url('arsip/images/event/2017-06-01 1/mancing3.jpg'); ?>"  alt="..."  style="width: 98px; height: 74px"/>
                                    </a>
                                    <a>
                                      <img src="<?php echo base_url('arsip/images/event/2017-06-01 1/mancing4.jpg'); ?>"  alt="..." style="width: 98px; height: 74px"/>
                                    </a>
                                    <a>
                                      <img src="<?php echo base_url('arsip/images/event/2017-06-01 1/mancing5.jpg'); ?>"  alt="..." style="width: 98px; height: 74px"/>
                                    </a>
                                  </div>
                                </div>
                                 <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                                  <h3 class="prod_title">Ulasan Event Keluarga</h3>
                                  <!-- <br/> -->

                                  <h4><i class="fa fa-bug"> </i> Mancing Keluarga di Patimban Subang</h4>

                                  <p><p>Patimban – Proyek pelabuhan Patimban kini menjadi lokasi favorit para pehobi mancing di Pantura Subang. 
                                     Lokasi ini juga cocok sambil bawa keluarga dan botram, disarankan membawa kendaraan roda 4 sebagi 
                                     pelindung dari terik Matahari.</p>
                                  <br />
                                  </p>

                                   <div class="">
                                    <h4><i class="fa fa-bug"> </i> Lokasi Event </h4>
                                     <p> 06 Mei 2017</p>
                                  </div>
                                  <br />

                                  <div class="">
                                    <h4><i class="fa fa-bug"> </i> Tanggal Event </h4>
                                     <p> 06 Mei 2017</p>
                                  <br />
                                  </div>

                                  <div class="">
                                    <h2><i class="fa fa-bug"> </i> Peserta  <!-- <small>Please select one</small> --></h2>
                                     <p> Udin,Ujang, keluarga mang Yeye</p>
                                     <p> </p>
                                  </div>
                                  <br />
                              </div>                              
                          </div>

                          <!-- end of user messages -->
                          <ul class="messages">
                            <li>
                              <img src="<?php echo base_url('arsip/images/users/'.$userid.'.jpg') ?>" class="avatar" alt="Avatar">
                              <div class="message_date">
                                <h5 class="date text-info">24</h5>
                                <p class="month">May</p>
                              </div>
                              <div class="message_wrapper">
                                <h4 class="heading">Desmond Davison</h4>
                                 <span>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</span>
                                <br />
                               </div>
                            </li>
                            <li>
                              <img src="<?php echo base_url('arsip/images/users/'.$userid.'.jpg') ?>" class="avatar" alt="Avatar">
                              <div class="message_date">
                                <h5 class="date text-info">24</h5>
                                <p class="month">May</p>
                              </div>
                              <div class="message_wrapper">
                                <h4 class="heading">Desmond Davison</h4>
                                 <span>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</span>
                                <br />
                               </div>
                            </li>
                            <li>
                              <img src="<?php echo base_url('arsip/images/users/'.$userid.'.jpg') ?>" class="avatar" alt="Avatar">
                              <div class="message_date">
                                <h5 class="date text-info">24</h5>
                                <p class="month">May</p>
                              </div>
                              <div class="message_wrapper">
                                <h4 class="heading">Desmond Davison</h4>
                                 <span>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</span>
                                <br />
                               </div>
                            </li>
                          </ul>
                          <!-- end of user messages -->
                          
                          <!-- <div class="btn-group">
                            <div class="input-group">
                              <input class="form-control" type="text">
                              <span class="input-group-btn">
                                <button type="button" class="btn btn-primary">Send</button>
                              </span>
                            </div>
                          </div> -->

                          <div class="col-md-10">
                              <textarea rows = "4" class="resizable_textarea form-control" placeholder="Send Command"></textarea>
                          </div>
                          <div class="col-md-2">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-primary">Send</button>
                            </span>
                          </div>

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

  <script type="text/javascript">
    $(document).jQuery(document).ready(function($) {
      ShowList();
    });

    function ShowList(){
        var v_notrans   =  '<?php echo $v_notrans; ?>';
        var v_tgltrans  =  '<?php echo $v_tgltrans; ?>';
        var v_kdunit    =  '<?php echo $v_kdunit; ?>';

        $.ajax({
            url     :"<?php echo base_url(); ?>index.php/event/event_list",
            type    :"POST",
            //data    :{"v_notrans":v_notrans,"v_tgltrans":v_tgltrans,"v_kdunit":v_kdunit},
            dataType:"JSON",
            success : function(data){
                $('#namapemohon').val(data.nama);
                $('#alamatpemohon').val(data.alamattinggal);
            }
        });
    }

  </script>
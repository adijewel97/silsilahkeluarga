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
  ?> 
<!-- ====================================================================================================================== -->

    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-child"></i> <span>Silsilah Keluarga</span></a>
            </div>

            <div class="clearfix"></div>
<!-- ====================================================================================================================== -->            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url('arsip/images/users/'.$user_path) ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo  $user_name; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
<!-- ====================================================================================================================== -->
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!-- <h3>General</h3> -->
                <ul class="nav side-menu">
                  <?php
                    $sql = 
                      " select a.* ,c.groups,c.expire,c.kdunit              ".
                      " from zsys_listmenu a, zsys_otoritas b,zsys_users c  ".
                      " where a.noitem = b.noitem                           ".
                      " and b.groups   = c.groups                           ".
                      " and c.user_id  = '".$userid."'                      ";

                    $query = $this->db->query($sql);
                    if( $query->num_rows() > 0) {
                        $html = '';
                        $result = $query->result(); //or $query->result_array() to get an array
                        foreach( $result as $row )
                        {
                            $level1 = strlen($row->noitem);
                            if ($level1 == 3) {
                               $perent = 1;
                               $idinduk = substr($row->noitem,0,3);
                            } else {
                              $perent = 0;
                            }
                            
                            if ($perent == 1){
                              $html .= '<li>';
                                //$html .= ' <a href="#"><i class="'.$row->iconlink.'"></i>  '.$row->item.' <span class="fa arrow"></span></a>';
                                $html .= '<li><a><i class="'.$row->iconlink.'"></i> '.$row->item.' <span class="fa fa-chevron-down"></span></a>';
                                $html .= ' <ul class="nav child_menu">';
                                    $sqlanak = 
                                        $sql.
                                        " and  mid(a.noitem,1,3) = '".$idinduk."'".
                                        " and LENGTH(a.noitem) > 3";
                                    
                                    $queryanak = $this->db->query($sqlanak);
                                    $resultanak = $queryanak->result();
                                    foreach ( $resultanak as $rowanak ) {
                                      $link   = base_url().'index.php/'.$rowanak->link;
                                      if ( empty($rowanak->link)) {$link = "#";}

                                      $html .= '<li>';
                                      $html .= '  <a href="'.$link.'">'.$rowanak->item.'</a>';
                                      $html .= '</li>';
                                    }
                                $html .= ' </ul>';
                              $html .= '</li>';
                            }                             
                          } 
                            echo $html;
                    }  else {
                        $this->load->view('access\v_login');
                    }
                  ?>                  
                </ul>

                <!-- <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>
                      <li><a href="index2.html">Dashboard2</a></li>
                      <li><a href="index3.html">Dashboard3</a></li>
                    </ul>
                  </li>                  
                </ul> -->
              </div>
            </div>
            <!-- /sidebar menu -->
<!-- ====================================================================================================================== -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <?php
                $sqldw = 
                    " select a.* ,c.groups,c.expire,c.kdunit              ".
                  " from zsys_listmenu a, zsys_otoritas b,zsys_users c  ".
                  " where a.noitem = b.noitem                           ".
                  " and b.groups   = c.groups                           ".
                  " and c.user_id  = '".$userid."'                      ".
                  " and  menu like '%tilit%' ".
                  " and LENGTH(a.noitem) > 3";
                  
                
                $queryanak = $this->db->query($sqldw);
                $resultdw  = $queryanak->result();
                $htmldw    = '';
                foreach ( $resultdw as $rowanakdw ) {
                  $link   = base_url().'index.php/'.$rowanakdw->link;
                  if ( empty($rowanakdw->link)) {$link = "#";}
                  $htmldw .= '<a data-toggle="tooltip" data-placement="top" title="'.$rowanakdw->item.'" href="'.$link.'">';
                  $htmldw .= '  <span class="glyphicon '.$rowanakdw->iconlink.'" aria-hidden="true"></span>';
                  $htmldw .= '</a>';
                }
                echo $htmldw;
              ?>
             <!--  <a data-toggle="tooltip" data-placement="top" title="Settings">
               <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
             </a>
             <a data-toggle="tooltip" data-placement="top" title="FullScreen">
               <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
             </a>
             <a data-toggle="tooltip" data-placement="top" title="Lock">
               <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
             </a>
             <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('index.php/login'); ?>">
               <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
             </a> -->
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url('arsip/images/users/'.$user_path) ?>" alt=""><?php echo  $user_name; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <?php
                      $sqldw = 
                          " select a.* ,c.groups,c.expire,c.kdunit              ".
                        " from zsys_listmenu a, zsys_otoritas b,zsys_users c  ".
                        " where a.noitem = b.noitem                           ".
                        " and b.groups   = c.groups                           ".
                        " and c.user_id  = '".$userid."'                      ".
                        " and  menu like '%tilit%' ".
                        " and LENGTH(a.noitem) > 3";
                        
                      
                      $queryanak = $this->db->query($sqldw);
                      $resultdw  = $queryanak->result();
                      $htmldw    = '';
                      foreach ( $resultdw as $rowanakdw ) {
                        $link   = base_url().'index.php/'.$rowanakdw->link;
                        if ( empty($rowanakdw->link)) {$link = "#";}
                        $htmldw .= '<li>';
                        $htmldw .= '  <a href="'.$link.'"> <i class="'.$rowanakdw->iconlink.'"></i> '.$rowanakdw->item.'</a>';
                        $htmldw .= '</li>';
                      }
                      echo $htmldw;
                    ?>

                    <!-- <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li> -->
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                 <!--  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                   <i class="fa fa-envelope-o"></i>
                   <span class="badge bg-green">6</span>
                 </a> -->
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo base_url('arsip/images/img.jpg') ?>" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo base_url('arsip/images/img.jpg') ?>" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo base_url('arsip/images/img.jpg') ?>" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="<?php echo base_url('arsip/images/img.jpg') ?>" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->



        
        

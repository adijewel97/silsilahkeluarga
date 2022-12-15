<style type="text/css">
  .panel-title-me {
      color: inherit;
      font-size: 16px;
      margin-bottom: 0;
      margin-top: 0;
  }
</style>

<!DOCTYPE html>
<style type="text/css">
  .bck_login{ 
    background: #C4D8F5;
    width: 90px;
    height: 90px;
  }
</style>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon/"  href="<?php echo base_url('arsip/images/Feather.png'); ?>">

    <title>Silsilah Keluarga </title>

    <!-- Bootstrap -->   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap-min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/nprogress/nprogress.css'); ?>"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/0myjs/css/animate.min.css'); ?>"> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/build/css/custom.min.css'); ?>">

    <script type="text/javascript" src="<?php echo base_url('assets/0myjs/js/jQuery Core 2.2.3.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/0myjs/js/jquery.form.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/0myjs/js/jquery.dataTables.min.js'); ?>"></script>
    
  </head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div id = "login_form" class="animate form">
          <section class="login_content">
            <form name="frmLogin" method="post"  data-ajax="false" 
                  action="<?php echo base_url(); ?>index.php/login/getlogin_web">
              
              <div class="separator">
              </div>

              <h2><i class="fa fa-child"></i> Login - Silsilah Keluarga </h2>
              </br>
             
              <fieldset>
                  <div class="form-group" style="text-align: right;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" name="user_reg" id="user_reg"> Registrasi Kode 
                      </label>
                    </div>
                  </div>
                  <div class="form-group has-feedback">
                   <input class="form-control" placeholder="User Aplikasi" name="username" type="text">
                   <span class="glyphicon glyphicon-user form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                   <input class="form-control" placeholder="Password" name="password" type="password">
                   <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                  </div>
                  <div class="form-group has-feedback">
                   <input class="form-control" placeholder="Registrasi Kode" id="serial" name="serial" type="text" style="display:none"> 
                  </div>
              </fieldset>
             

              <div>
                <!-- <a class="btn btn-default submit" >Log in</a> -->
                <table>
                  <tr><td>     
                       <!--  <div style="background-color:#E6E6FA; fontWeight:bold; color:crimson;font-size:12px;"> -->
                        <div class="myinfo">
                          <?php 
                              $info = $this->session->flashdata('info');
                              if (!empty($info)) {
                                  if (substr($info, 0,2) == '01' || substr($info, 0,2) == '02') { 
                                    echo "<script type='text/javascript'> 
                                                  alert('". $info ."');
                                                  document.getElementById('serial').style.display = 'block';
                                          </script>"; 
                                    $info = ""; 
                                  } else {
                                    echo "<script type='text/javascript'> alert('". $info ."'); </script>"; 
                                    $info = ""; 
                                  }
                                  
                              } 
                          ?>
                        </div>
                    </td>
                  </tr>
                </table>
                
                <div class="row">
                   <div class="col-md-4"></div>
                   <div class="col-md-4" style="padding-left: 2px; padding-right: 2px;">
                     <button type="submit" class="btn btn-primary btn-block btn-sm">Login</button>    
                   </div>
                   <div class="col-md-4"></div>
                </div>                
                <!-- <a href="#reset_pass" class="reset_pass">Lost your password?</a> -->
                <a class="reset_pass" onclick="javascript:registrasi_user_from('2')"> Lost your password? </a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a  class="to_register" onclick="javascript:registrasi_user_from('1')">Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> <br /> 
 
                <div>
                  <p>©2017 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
<!-- ================================================================================================ -->
<!-- Registrasi online -->
        <div id="register" class="animate form" style="display:none">
          <!-- <section class="login_content">
            <p class=MsoNormal align=center style='text-align:center'><b style='mso-bidi-font-weight:
            normal'><span style='color:#002060'>Aplikasi Silsilah/Keturunan Keluarga<o:p></o:p></span></b></p>
    
            <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
            text-align:center'><span style='font-size:8.0pt;mso-bidi-font-size:11.0pt;
            line-height:115%'><o:p>&nbsp;</o:p></span></p>
    
            <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
            text-align:center'><b style='mso-bidi-font-weight:normal'><span
            style='font-size:8.0pt;mso-bidi-font-size:11.0pt;line-height:115%'>Ver.<span
            style='mso-spacerun:yes'>  </span>1.00.01<o:p></o:p></span></b></p>
    
            <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
            text-align:center'><b style='mso-bidi-font-weight:normal'><span
            style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:115%'><o:p>&nbsp;</o:p></span></b></p>
    
            <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
            text-align:center'><span style='font-size:7.0pt;mso-bidi-font-size:11.0pt;
            line-height:115%'><o:p>&nbsp;</o:p></span></p>
    
            <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
            text-align:center'><span style='font-size:8.0pt;mso-bidi-font-size:11.0pt;
            line-height:115%'>Create By <a href="mailto:adijewel97@yahoo.com">adijewel97@yahoo.com</a><o:p></o:p></span></p>
    
            <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
            text-align:center'><span style='font-size:7.0pt;mso-bidi-font-size:11.0pt;
            line-height:115%;mso-bidi-font-family:Calibri;mso-bidi-theme-font:minor-latin'>©</span><span
            style='font-size:7.0pt;mso-bidi-font-size:11.0pt;line-height:115%'>2017<o:p></o:p></span></p>
          </section> -->
          <section class="login_content">
              <form  id="frmRegistrasi" method="post" data-ajax="false" >
                <h1 id="labelform">Create Account</h1>
                <div>
                  <input id="username" name="username" type="text" class="form-control" placeholder="Username" required="" />
                </div>
                <div>
                  <input id="email" name="email" type="text" class="form-control" placeholder="Email" required="" />
                </div>
                <div>
                  <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama Lengkap" required="" />
                </div>
                <div>
                  <input id="password" name="password" type="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                  <input id="password_confrim" name="password_confrim" type="password" class="form-control" placeholder="Password Confrim" required="" />
                </div>
                <div>
                  <input id="vserial" name="vserial" type="hidden" class="form-control" placeholder="Serial" required="" />
                </div>
                <div>
                  <a id="btn_user">Submit</a>
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                  <p class="change_link">Already a member ?
                    <a class="to_register" href="<?php echo base_url().'index.php/Login/index' ?>"> Log in </a>
                  </p>

                  <div class="clearfix"></div>
                  <br/>

                  <div>
                    <div class="clearfix"></div>
                    <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> 

                    <div>
                      <p>©2017 All Rights Reserved.</p>
                    </div>
                  </div>
                </div>
              </form>
          </section>
        </div>

      </div>
    </div>
  </body>

  <script type="text/javascript">

   $(document).ready(function(){        
      document.getElementById("user_reg").onclick = function() {
            // access properties using this keyword
            if ( this.checked ) {
                document.getElementById('serial').style.display = 'block'
            } else {
                document.getElementById('serial').style.display = 'none'
            }
        };
    });   


    // $(window).load(function(){
    //   $('body').backDetect(function(){
    //     alert("Look forward to the future, not the past!");
    //   });
    // });

    function registrasi_user_from(vproses){
      //base_url(); ?>index.php/Silsilah/data_show_table_keluarga"
      if ( vproses == 1 ) {
        var serial = myrandom();
        $('#labelform').html('<h1>Create Account</h1>');
        $('#btn_user').reset;
        $('#btn_user').html(
          '<a class="btn btn-default" onclick="registrasi_user(1)">Create User</a>'
          );
        document.getElementById('register').style.display       = 'block';
        document.getElementById('login_form').style.display     = 'none' ;
        document.getElementById('vserial').value                = serial;
        $('#username').val('');
        $('#email').val('');
        $('#username').val('');
        $('#nama').val('');
        $('#password').val('');
        $('#password_confrim').val('');
      } else {
        //alert('hello '+vproses);
        var serial = myrandom();
        $('#btn_user').reset;
        $('#btn_user').html(
          '<a class="btn btn-default" onclick="registrasi_user(2)">Reset Password</a>'
          );
        $('#labelform').html('Reset Password');
        document.getElementById('register').style.display       = 'block';
        document.getElementById('login_form').style.display     = 'none' ;
        document.getElementById('vserial').value                = serial;
      }
    }

    function myrandom(){
      var keynum = '<?php echo rand(); ?>';
      n = keynum.length
      if ( n >= 5) {
         var my_keynum  = keynum.substr(0,4);
      } else {
         var my_keynum1 = '0000'  + keynum;
         var my_keynum  = my_keynum1.substr(-4);
      }
      //alert(keynum+'--'+my_keynum);
      return my_keynum;
    }

    function registrasi_user(vproses) {
        //alert(vproses);
        var myerror = "Sukses : Validasi Registrasi Input.";
        var mydata;

        var username            = $('#username').val();
        var password            = $('#password').val();
        var password_confrim    = $('#password_confrim').val();

        var x                   = $('#email').val();
        var atpos               = x.indexOf("@");
        var dotpos              = x.lastIndexOf(".");
                
        if (username == '') {
           myerror = 'Error : Nama User Belum Diisi !';   
           $('#username').focus();
        } else if ((email == '') || (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)) {
           myerror = 'Error : Alamat Email User Belum Diisi/Salah !';   
           $('#email').focus();
        } else if (password == '') {
           myerror = 'Error : Password User Belum Diisi !';   
           $('#password').focus();
        } else if (password_confrim == '') {
           myerror = 'Error : Password Confrim User Belum Diisi !';   
           $('#password_confrim').focus();
        }           

        if ( myerror.toUpperCase().substr(0,5) != 'ERROR') {
            //if ( vproses == '1' ) {
              mydata = new FormData($('#frmRegistrasi')[0]);
              mydata.append('n_proses', vproses);

              $.ajax ({
                  url         : "<?php echo base_url(); ?>index.php/Login/send_email_registrasi",
                  type        : "POST",
                  data        : mydata,
                  contentType : false,
                  cache       : false,
                  processData : false,
                  dataType    : "JSON",
                  success     : function(msg) {
                      if (msg.status=='1') {
                         alert(msg.pesan);
                      } else if (msg.status=='2') {                  
                          alert(msg.pesan);
                      }
                  }/*,
                  error     : function (xhr, ajaxOptions, thrownError) {
                      alert('error : '+xhr.status+ ' --> '+ thrownError);
                  }*/
              }); 
            /*} else  if ( vproses == '2' )  {
              alert(' helloooo '+vproses)
            }*/ 
        } else {
          alert(myerror);
        }
    }

  </script>
            

<!DOCTYPE html>
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
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/dist/css/bootstrap.min.css'); ?>"> 
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>"> 
     
    <!-- Custom Theme Style -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/nprogress/nprogress.css'); ?>"> 
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/iCheck/skins/flat/green.css'); ?>"> 
  
    <!-- bootstrap-progressbar -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css'); ?>"> 
    <!-- JQVMap -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/jqvmap/dist/jqvmap.min.css'); ?>"> 
    <!-- bootstrap-daterangepicker -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.css'); ?>"> 

    <!-- Custom Theme Style -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/build/css/custom.min.css'); ?>">

    <!-- My mine -->
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/0myjs/css/dataTables.bootstrap.css'); ?>">

    <!-- Tambahan grapik silsilah-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/0myjs/css/silsilah/Treant.css'); ?> ">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/0myjs/css/silsilah/no-parent.css'); ?> ">
    <script src="<?php echo base_url('assets/0myjs/js/silsilah/raphael.js'); ?>"></script>
    
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/0myjs/css/silsilah/custom-color-plus-scrollbar.css'); ?>"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/0myjs/css/silsilah/simple-scrollbar.css'); ?>">

  <body class="nav-md">
  <!-- My mine -->
    <script type="text/javascript" src="<?php echo base_url('assets/0myjs/js/jQuery Core 2.2.3.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/0myjs/js/jquery.form.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/0myjs/js/jquery.dataTables.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/0myjs/js/dataTables.bootstrap.min.js'); ?>"></script>
  <!-- bootstrap-daterangepicker -->
    <script type="text/javascript" src="<?php echo base_url('assets/moment/min/moment.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>

    <!-- <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script> -->
    
  <?php     
    if (empty($login)) { 
        $this->load->view('desain/v_menu'); 
        date_default_timezone_set('Asia/Jakarta');
        //echo date('d-m-Y H:i:s');
    }
  ?>

  


	


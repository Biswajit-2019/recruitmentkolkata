<!doctype html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<title>Sameer:ADMIN</title>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!--[if lte IE 9]><link rel="stylesheet" href="css/style-ie9.css" /><![endif]-->
<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
<link href="<?php echo base_url();echo admin_public_dir;?>jquery/css/start/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<script src="<?php echo base_url();echo admin_public_dir;?>jquery/js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url();echo admin_public_dir;?>jquery/js/jquery-ui-1.10.3.custom.js"></script>
<script src="<?php echo base_url();?>public/ckeditor/ckeditor.js"></script>

<script type="text/javascript" src="<?php echo base_url(); echo admin_JS_URL;?>jquery.validate.js"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="<?php echo base_url();echo admin_public_dir;?>style.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'dd-mm-yy',
    });
  } );
  </script>
</head>

<body>
<div class="container" style="width: 100%;">
<header>
  <div class="wrapper">
    <div class="logo"><a href="<?php echo base_url();?>admin" title="Sameer Kolkata"><img src="<?php echo base_url();echo admin_IMAGE_URL;?>logo.png" width="120" height="66" alt="Sameer Kolkata"/></a></div>
    <div class="hd_rt">
      <?php //echo  $pageTitle; ?>
    </div>
    <div class="height30"></div>
    <nav>
      <select name="select" id="select" ONCHANGE="location = this.options[this.selectedIndex].value;">
        <option value="<?php echo base_url();?>admin">Home</option>
        <option value="<?php echo base_url();?>admin/logout">Logout</option>
      </select>
      <?php $link=substr($_SERVER['SCRIPT_NAME'],strripos($_SERVER['SCRIPT_NAME'],'/')+1,strlen($_SERVER['SCRIPT_NAME'])-strripos($_SERVER['SCRIPT_NAME'],'/')); ?>
      <ul>
        <li  <?php if($link=='home.php'){ ?> class="selected" <?php } ?>><span><a href="<?php echo base_url();?>admin" class="home-icon">Home</a></span></li>
        <li  <?php if($link=='logout.php'){ ?> class="selected" <?php } ?>><span><a href="<?php echo base_url();?>admin/logout" class="logout-icon">Logout</a></span></li>
      </ul>
    </nav>
  </div>
</header>
<section class="body">
<div class="wrapper">
<div class="content-section">

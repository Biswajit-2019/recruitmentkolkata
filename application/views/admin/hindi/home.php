<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name="viewport">

<meta content="yes" name="apple-mobile-web-app-capable">

<title>ADMIN :: </title>

<link rel="stylesheet" href="<?php echo base_url(); echo admin_CSS_URL;?>style.css" type="text/css" />

<link href="<?php echo base_url(); echo admin_public_dir;?>style.css" rel="stylesheet" type="text/css">

<script src="<?php //echo SITE_ADMIN_URL;?>jquery/js/respond-1.1.0.min.js"></script>

</head>

<body>



<div id="container">

   <div class="bodybg">

        <header>

        <div class="wrapper" style="padding-top:50px;">

        

            </div>

        </header>

        <article>



<div class="wrapper">

<div class="login-logo"><img src="<?php echo base_url(); echo admin_IMAGE_URL;?>res-logo.png"  alt="" title=""/></div>

<div class="login-box">

<p><?php if($this->session->flashdata('error')) { echo $this->session->flashdata('error');} ?></p>

<div class="login-bg">

<div class="login-form-bg">

<div class="form-login">

<?php echo form_open('admin/hindi/home/index');?>

<input type="hidden" name="mode" value="login"  />



<input type="text" name="username" class="name-input" <?php //if(isset($_COOKIE['email_address'])) { ?> value="<?php //echo $_COOKIE['email_address'] ?>" <?php //} ?> autocomplete="off" />



<input type="password" name="pass" class="password-input" <?php //if(isset($_COOKIE['password'])) { ?> value="<?php //echo $_COOKIE['password'] ?>" <?php //} ?> autocomplete="off" />

<!-- <div class="remember"><input name="remember_chck" type="checkbox" value="" <?php //if($_COOKIE['rememberme']=="yes"){ ?>  <?php //} ?>><label> Remember me</label></div>

<div class="forget-password"><a href="forget.php">Forgot your password?</a></div> -->

<div class="height3"></div>

<input type="submit" name="sub" value="Submit" class="submit-bt"/>



</form>

</div>



</div>

</div>





</div>

</div>





        </article>

        

    </div>

    

    <footer>

        <div class="footerbg"><div class="wrapper">&copy; Sitename</div></div>

        </footer>

</div>

</body>

</html>




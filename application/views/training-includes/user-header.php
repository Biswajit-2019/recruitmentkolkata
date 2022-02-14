<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title><?php echo $metaTitle;?></title>
    
    <!--Fonts-->
    <link href="<?php echo base_url(); echo IMAGE_URL;?>favicon.ico" rel="icon" type="image/x-icon">
    <link href="<?php echo base_url(); echo public_dir;?>site/fonts/fonts.css" rel="stylesheet" type="text/css">
    
    <link href="<?php echo base_url(); echo CSS_URL;?>mobilemenu-styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); echo CSS_URL;?>stylesheet.css" rel="stylesheet" type="text/css" media="all">
   
<script src="<?php echo base_url(); echo JS_URL;?>jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>jquery-migrate-1.2.1.min.js"></script>

<script src="<?php echo base_url(); echo public_dir;?>bxslider/jquery.bxslider.min.js"></script>
<link href="<?php echo base_url(); echo public_dir;?>bxslider/jquery.bxslider.css" rel="stylesheet" />

<link type="text/css" rel="Stylesheet" media="screen,print" href="<?php echo base_url(); echo public_dir;?>fontincrease/CSS/CSS.css" />
<script src="<?php echo base_url(); echo JS_URL;?>jquery.marquee.min.js"></script>
    <script src="<?php echo base_url(); echo JS_URL;?>jquery.pause.min.js"></script>
    <script src="<?php echo base_url(); echo JS_URL;?>jquery.easing.1.3.min.js"></script>

    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
 
    
    <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); echo CSS_URL;?>all-ie-only.css" />
    <![endif]-->

    <script type="text/javascript">
        $(window).load(function() {
            /*var navigation = responsiveNav("#nav", {
            customToggle: "#nav-toggle"
          });*/
            //$('#slider').nivoSlider();
           // autoScroller('vmarquee',2);
        });

        $(document).ready(function(){
            
        $('.bxslider').bxSlider({

            auto: true
            
        });
       
      $('.top-scroll').marquee(
      {
        allowCss3Support: false,
        css3easing: 'linear',
        duplicated: true,
        duration: 7000,
        gap:10,
        pauseOnCycle: false,
        pauseOnHover: true,
        direction: 'up'

      }
        );   


        
            
          

        });
    </script>

    
<meta name="description" content="<?php echo $metaDescription;?>">
<meta name="keywords" content="<?php echo $metaKeywords;?>">

</head>

<body onload="control_fontsize();" >
<div class="wrapper" id="ele4">
    <header class="min-header">   <!--Header start-->
        
        <div class="container" >
        
            <div class="mid-header">
            
                <div class="top-header">
                    <div class="container">
                        <ul class="access-option">
                            <li><a href="<?php echo base_url();?>accessibility-options">Accessibility option</a></li>
                            <li><a href="<?php echo base_url();?>site-map">Site Map</a></li>
                        </ul>
                    </div>
                </div>
            
                <div class="logo">
                    <a href="<?php echo base_url();?>"><img src="<?php echo base_url(); echo IMAGE_URL;?>logo.png" alt=""></a>
                    
                    <div class="mobile-nav2">
                        <button id="nav-toggle">Menu</button>
                        <nav class="mobile-nav" id="nav">
                            <ul>
                                <li><a href="<?=base_url();?>">Home</a></li>
                                 <li><a href="<?=base_url();?>/training/login">Sign in</a></li>
                            <ul>
                        </nav>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="right-top">
                       
                        <div class="right-text">Society for Applied Microwave <br>Electronics Engineering and Research</div>
                        
                        <div class="hindi hindi-ver"><a href="<?php echo base_url();?>hindi">हिंदी</a></div>
                    </div>
                    <div class="rd-text"><?php 
                    $tagline = $this->Common_model->getValue('tagline', 'tagline_text', 1);
                    if(!empty($tagline)){ echo $tagline; } ?></div>
                    <div class="queries-sec">
                        For any queries, pl contact : <a href="mailto:hrd@mmw.sameer.gov.in">hrd@mmw.sameer.gov.in</a>
                    </div>
                </div>
                
                <div class="top-navbar">   <!--navbar start-->
                    <div class="container">
                        <nav>
                            <ul>
                                <li><a href="<?php echo base_url();?>">Home</a></li>
                            </ul>
                            <div class="right-menu">
                                <ul>
                                   <!--  <li><a href="#">Register</a></li> -->
                                    <li><a href="<?=base_url();?>/training/login">Sign in</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>    <!--navbar end-->
            </div>
        </div>
    </header>   <!--Header end-->
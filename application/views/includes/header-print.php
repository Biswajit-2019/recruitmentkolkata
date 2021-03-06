<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title><?php echo $metaTitle;?></title>
    
    <!--Fonts-->
    <link href="<?php echo base_url(); echo IMAGE_URL;?>/favicon.ico" rel="icon" type="image/x-icon">
    <link href="<?php echo base_url(); echo public_dir;?>site/fonts/fonts.css" rel="stylesheet" type="text/css">
    
    <link href="<?php echo base_url(); echo CSS_URL;?>mobilemenu-styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); echo CSS_URL;?>stylesheet.css" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo base_url(); echo CSS_URL;?>print.css" rel="stylesheet" type="text/css" media="print"> 
<script src="<?php echo base_url(); echo JS_URL;?>/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>responsive-nav.js"></script>

<script src="<?php echo base_url(); echo public_dir;?>bxslider/jquery.bxslider.min.js"></script>
<link href="<?php echo base_url(); echo public_dir;?>bxslider/jquery.bxslider.css" rel="stylesheet" />
<script src="<?php echo base_url(); echo JS_URL;?>jquery.simplemarquee.js"></script>
<link type="text/css" rel="Stylesheet" media="screen,print" href="<?php echo base_url(); echo public_dir;?>fontincrease/CSS/CSS.css" />
<script src="<?php echo base_url(); echo JS_URL;?>jquery.marquee.min.js"></script>
    <script src="<?php echo base_url(); echo JS_URL;?>jquery.pause.min.js"></script>
    <script src="<?php echo base_url(); echo JS_URL;?>jquery.easing.1.3.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); echo JS_URL;?>jquery.timers.js"></script>
<script type="text/javascript" src="<?php echo base_url(); echo JS_URL;?>jquery.autoScroller.js"></script>-->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE]>
    
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
            var navigation = responsiveNav("#nav", {
            customToggle: "#nav-toggle"
          });
        $('.bxslider').bxSlider({

            auto: true
            
        });
       
      $('.top-scroll').marquee(
      {
        allowCss3Support: true,
        css3easing: 'linear',
        duplicated: true,
        duration: 5000,
        gap:10,
        pauseOnCycle: false,
        pauseOnHover: true,
        direction: 'up'

      }
        );   


        
            /*$('.top-scroll').simplemarquee({
                direction: 'top',
                 speed: 50,
                cycles: 100,
                space: 50,
                delayBetweenCycles: 1
              
            });*/
          

        });
    </script>

    
<meta name="description" content="<?php echo $metaDescription;?>">
<meta name="keywords" content="<?php echo $metaKeywords;?>">

</head>

<body onload="control_fontsize();window.print();window.close();" >
<div class="wrapper">
    <header class="min-header">   <!--Header start-->
        
        <div class="container">
        
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
                    
                    <div class="mobile-nav">
                        <button id="nav-toggle">Menu</button>
                        <nav class="mobile-nav" id="nav">
                            <ul>
                                <?php 
                        if(!empty($cms)){
                        foreach($cms as $cmsValue){ ?>
                        <li><a href="<?php if($cmsValue->content!=''){echo base_url(); echo $cmsValue->slug;} else { echo "#"; }?>"><?php echo $cmsValue->page_title;?></a>
                        <?php $param=array('parent_id'=>$cmsValue->id);
                        $data=$this->Common_model->getData('cms_pages',$param);
                        if(!empty($data))
                        { ?>
                        <ul>
                    <?php foreach ($data as $subValue){  ?>
                            <li><a href="<?php echo base_url(); echo $subValue->slug;?>"><?php echo $subValue->page_title;?></a> </li>
                       <?php  }?>
                       </ul>
                       <?php  } ?>

                        <?php } } ?></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="right-top">
                        <!--<h1>Sameer Kolkata Centre</h1>-->
                        <div class="right-text">Society for Applied Microwave <br>Electronics Engineering and Research</div>
                        <!--<div class="hindi"><a href="#">fganh lUldj.k</a></div>-->
                        <div class="hindi hindi-ver"><a href="<?php echo base_url();?>hindi">fganh</a></div>
                    </div>
                    <div class="rd-text">Dept. of Electronics & Information Technology, Ministry of Communications & Information Technology, Govt. of India</div>
                </div>
                
                <div class="top-navbar">   <!--navbar start-->
                    <div class="container">
                        <nav>
                            <ul>
                                <li><a href="<?php echo base_url();?>">Home</a></li>
                        <?php 
                        if(!empty($cms)){
                        foreach($cms as $cmsValue){ ?>
                        <li><a href="<?php echo base_url(); echo $cmsValue->slug;?>"><?php echo $cmsValue->page_title;?></a>
                        <?php $param=array('parent_id'=>$cmsValue->id);
                        $data=$this->Common_model->getData('cms_pages',$param);
                        if(!empty($data))
                        { ?>
                        <ul>
                    <?php foreach ($data as $subValue){  ?>
                            <li><a href="<?php echo base_url(); echo $subValue->slug;?>"><?php echo $subValue->page_title;?></a> 
                           <?php  
                               $paramsubsub=array('parent_id'=>$subValue->id);
                               $datasubsub=$this->Common_model->getData('cms_pages',$paramsubsub);
                               if(!empty($datasubsub))
                               {?>
                                <ul>
                                <?php foreach($datasubsub as $datasubsubval){?>
                                 <li><a href="<?php echo base_url(); echo $datasubsubval->slug;?>"><?php echo $datasubsubval->page_title;?></a></li>
                              <?php   } ?>
                                </ul>
                             <?php   }  ?>
                           
                            </li>
                       <?php  }?>
                       </ul>
                       <?php  } ?>

                        <?php } } ?></li>
                            </ul>
                            <div class="search-box">
                                <?php echo form_open('search');?>
                                    <label><input type="text" value="" placeholder="Search" name="txtsearch"></label>
                                    <label><input type="submit" value="Search" name="searchbtn"></label>
                                </form>
                            </div>
                        </nav>
                    </div>
                </div>    <!--navbar end-->
            </div>
        </div>
        
        
        <div class="banner-bg">
            <div class="container">
                <div class="banner">
                    <div class="banner-text">
                      <?php   $bannerText=$this->Common_model->getSingle('cms_pages',array('id'=>43),$order_by_fld='',$order_by='',$limit='',$offset='');
                                echo $bannerText->content;
                      ?>
                    </div>
                </div>
            </div>
        </div>
        
    </header>   <!--Header end-->
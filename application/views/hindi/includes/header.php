<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

	 <title><?php echo $metaTitle;?></title>
    <link href="<?php echo base_url(); echo IMAGE_URL;?>favicon.ico" rel="icon" type="image/x-icon">
    <!--Fonts-->
    <link href="<?php echo base_url(); echo public_dir;?>site/fonts/fonts.css" rel="stylesheet" type="text/css">
    
    <link href="<?php echo base_url(); echo CSS_URL;?>mobilemenu-styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); echo CSS_URL;?>stylesheet.css" rel="stylesheet" type="text/css" media="screen">
    <script src="<?php echo base_url(); echo JS_URL;?>/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>responsive-nav.js"></script>

<script src="<?php echo base_url(); echo public_dir;?>bxslider/jquery.bxslider.min.js"></script>
<link href="<?php echo base_url(); echo public_dir;?>bxslider/jquery.bxslider.css" rel="stylesheet" />
<script src="<?php echo base_url(); echo JS_URL;?>jquery.marquee.min.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>jquery.pause.min.js"></script>
<script src="<?php echo base_url(); echo JS_URL;?>jquery.easing.1.3.min.js"></script>




    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
   	<script type="text/javascript">
		$(window).load(function() {
			
		 // $('#slider').nivoSlider();
		 //autoScroller('vmarquee',2);
		});
		
		$(document).ready(function(){
        
             $('.top-scroll').marquee(
              {
                allowCss3Support: false,
                css3easing: 'linear',
                duplicated: true,
                duration: 8000,
                gap:10,
                pauseOnCycle: false,
                pauseOnHover: true,
                direction: 'up'

              }
            );  
            $('.bxslider').bxSlider({

            auto: true
            
        });
		var navigation = responsiveNav("#nav", {
			customToggle: "#nav-toggle"
		  });
        });
    </script>
  <meta name="description" content="<?php echo $metaDescription;?>">
<meta name="keywords" content="<?php echo $metaKeywords;?>">  
</head>

<body onload="control_fontsize();">
<div class="wrapper" id="ele4">
	<header class="min-header">   <!--Header start-->
        
        <div class="container">
        
        	<div class="mid-header">
            
            	<div class="top-header">
                    <div class="container">
                        <ul class="access-option">
                            <li><a href="<?php echo base_url();?>hindi/accessibility-options">एक्सेसिबिलिटी विकल्प </a></li>
                            <li><a href="<?php echo base_url();?>hindi/site-map">साइटमैप</a></li>
                        </ul>
                    </div>
                </div>
            
            	<div class="logo">
                	<a href="<?php echo base_url();?>hindi"><img src="<?php echo base_url(); echo IMAGE_URL;?>logo.png" alt=""></a>
					
                  
                    <div class="mobile-nav2">
                        <button id="nav-toggle">Menu</button>
                        <nav class="mobile-nav" id="nav">
                            <ul>
                            
							 <?php 
                        if(!empty($cms)){
                        foreach($cms as $cmsValue){ ?>
                        <li><a href="<?php echo base_url();?>hindi/<?php echo $cmsValue->slug;?>"><?php echo $cmsValue->page_title;?></a>
                        <?php $param=array('parent_id'=>$cmsValue->id);
                        $data=$this->Common_model->getData('hindi_cms_pages',$param);
                        if(!empty($data))
                        { ?>
                        <ul>
                    <?php foreach ($data as $subValue){  ?>
                            <li><a href="<?php echo base_url();?>hindi/<?php echo $subValue->slug;?>"><?php echo $subValue->page_title;?></a> </li>
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
                        <div class="right-text">प्रा योगिक सूक्ष्म तरंग <br>इलेक्ट्रॉनिक इंजीनियरी तथा अनुसंधान संस्था</div>
                        <!--<div class="hindi"><a href="#">fganh lUldj.k</a></div>-->
                        <div class="hindi-ver"><a href="<?php echo base_url();?>">English</a></div>
					</div>
                    <div class="rd-text"> <?php 
                    $tagline = $this->Common_model->getValue('tagline', 'tagline_text', 2);
                    if(!empty($tagline)){ echo $tagline; } ?></div>
                </div>
                
                <div class="top-navbar">   <!--navbar start-->
                    <div class="container">
                        <nav>
                            <ul>
                                <li><a href="<?php echo base_url();?>hindi">मुख पृष्ठ </a></li>
                             <?php  if(!empty($cms)){
                        foreach($cms as $cmsValue){
                        $param=array('parent_id'=>$cmsValue->id);
                        $data=$this->Common_model->getData('hindi_cms_pages',$param);?>
                        <li <?php if(!empty($data)){echo "class='parent-menu'";}?>><a href="<?php if(!empty($data)){echo "javascript:void(0);";} else { echo base_url();?>hindi/<?php echo $cmsValue->slug;}?>"><?php echo $cmsValue->page_title;?></a>
                       <?php  if(!empty($data))
                        { ?>
                        <ul>
                    <?php foreach ($data as $subValue){  ?>
                               <?php  
                               $paramsubsub=array('parent_id'=>$subValue->id);
                               $datasubsub=$this->Common_model->getData('hindi_cms_pages',$paramsubsub);?>
                                 <li <?php if(!empty($datasubsub)){echo "class='sub-menu'";}?>><a href="<?php if(!empty($datasubsub)){echo "javascript:void(0);";} else {echo base_url();?>hindi/<?php echo $subValue->slug;}?>"><?php echo $subValue->page_title;?></a>
                               <?php if(!empty($datasubsub))
                               {?>
                                <ul>
                                <?php foreach($datasubsub as $datasubsubval){?>
                                 <li><a href="<?php echo base_url();?>hindi/<?php echo $datasubsubval->slug;?>"><?php echo $datasubsubval->page_title;?></a></li>
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
                            	<?php echo form_open('hindi/search');?>
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
                    	<h2>प्रा योगिक सूक्ष्म तरंग</h2>
                        <h3>इलेक्ट्रॉनिक इंजीनियरी तथा अनुसंधान संस्था</h3>
                        <p>ससूचना प्रौद्योगिकी विभाग, संचार और सूचना प्रौद्योगिकी मंत्रालय,भारत सरकार ;    </p>
                    </div>
                </div>
            </div>
        </div>
        
    </header> 
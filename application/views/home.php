 <section class="min-section">
    	<div class="container">
        	<div class="section-bg">
            	
        	<?php $this->load->view('includes/left');?>

                <div class="right-section">
                	<h1>Welcome to SAMEER- Centre for Microwave & Millimeter Wave, Kolkata <span class="print"><a href="javascript:void(0);"  title="Print" class="print-btn">Print</a></span></h1>
                    <div class="content-text">
                        <div  class="slider">
                        <ul class="bxslider">
                        <?php 
                        if(!empty($banner)){
                        foreach($banner as $bannerValue){?>
                        <li><img src="<?php echo $bannerValue->images;?>" data-thumb="<?php echo $bannerValue->images;?>" alt="<?php echo $bannerValue->title;?>"></li>
                        <?php } } ?>
                        </ul>
                        </div>
                        <?php echo $content;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
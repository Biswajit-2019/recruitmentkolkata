 <section class="min-section">
    	<div class="container">
        	<div class="section-bg">
			
			
			<?php $this->load->view('hindi/includes/left');?>
			
			
			
		<div class="right-section">
                	<h1>सूचना प्रौद्योगिकी विभाग, संचार और सूचना प्रौद्योगिकी मंत्रालय,भारत सरकार ; <span class="print"><a href="javascript:void(0);"  title="Print" class="print-btn">Print</a></span> </h1>
                    <div class="content-text">
                        <div  class="slider">
                        <ul class="bxslider">
						
						<?php foreach($banner as $bannerValue)
						{
						?>
						
						<li><img src="<?php  echo $bannerValue->images;?>" data-thumb="<?php echo $bannerValue->images;?>" alt="<?php echo $bannerValue->title;?>"></li>
						<?php } ?>
                        </ul>
						</div>
                       
						 <?php echo $content;?>
					  <!-- <p>SAMEER (Society for Applied Microwave Electronics Engineering and Research) is a R & D Laboratory under the Department of Information Technology, Ministry of Communications & Information Technology, Government of India. </p>
                        <p>SAMEER Kolkata Centre has been pursuing its objective of doing advanced research and development in the areas of RF, Microwave & Millimeter Wave Technology, EMI/EMC and relating these to user requirements by undertaking R & D projects and providing consultancy services. Through the medium of these projects & services, the Centre has increased its interaction with Industries and Public Sector Units and contributed to their growth. </p>-->
                    </div>
                </div>
            </div>
        </div>
    </section>	
			
			
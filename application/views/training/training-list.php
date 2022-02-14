 <section class="min-section">
    	<div class="container">
        	<div class="section-bg">
            	
        	<?php $this->load->view('includes/left');  ?>

                <div class="right-section">
                	<h1><?php echo $metaTitle;?><span class="print"><a href="javascript:void(0);"  title="Print" class="print-btn">Print</a></span></h1>

                    <div class="content-text">
                        <?php if(!empty($recruitment)){
                            foreach($recruitment as $value){
                         ?>
                        <div class="recruitment-box">						   
                            <?=$value->important_content;?>
                        </div>
                        <?php } }else{ ?>
                            <div class="recruitment-box">
                                <p style="text-align:center">No Training Available.</p>
                            </div>
                         <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
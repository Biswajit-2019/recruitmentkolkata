 <section class="min-section">
    	<div class="container">
        	<div class="section-bg">
            	
        	<?php $this->load->view('includes/left');

            //print_r($main);
            ?>

                <div class="right-section variable_font">
                	<h1><?php echo $main->page_title;?> <span class="print"><a href="javascript:void(0);"  title="Print" class="print-btn">Print</a></span></h1>
                    <div class="content-text">
                       
                       <?php echo $main->content;?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
 <section class="min-section">
    	<div class="container">
        	<div class="section-bg">
            	
        	<?php $this->load->view('includes/left');

            //print_r($main);
            ?>

                <div class="right-section variable_font">
                <?php if(!empty($main)){?>
                	<h1><?php echo $main->page_title;?></h1>
                    <div class="content-text">
                       
                       <?php echo $main->content;?>
                        <?php } else {?>
                        <h1>No Data Found</h1>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </section>
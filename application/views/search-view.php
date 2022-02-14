 <section class="min-section">
    	<div class="container">
        	<div class="section-bg">
            	
        	<?php $this->load->view('includes/left');  ?>

                <div class="right-section">
                	<h1><?php echo $metaTitle;?><span class="print"><a href="javascript:void(0);"  title="Print" class="print-btn">Print</a></span></h1>

                    <div class="content-text">
                        <div class="search-result">
						<?php 
						if(!empty($searchResult)){
                      foreach($searchResult as $searchVal){?>
                            <div class="resultBody">
                                
                                <div class="title"><a href="<?php echo base_url(); echo $searchVal->slug;?>"><?php echo $searchVal->page_title;?></a></div>
                                
                                <p><?php echo strip_tags(substr($searchVal->content,0,200)).'.....';?></p>
                               
                            </div>
					  <?php }}
					  else{?>
							No Search Result Found
							<?php }	?> 
                           
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
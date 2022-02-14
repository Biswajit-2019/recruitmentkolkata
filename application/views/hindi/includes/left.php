<aside class="left-section">
                	<div class="left-menu">
                    	<ul>
						
						<?php
						$website=$this->Common_model->getData('hindi_websites',array('status'=>'Y'));
						//echo ($website);
					if($website!=null)
                        {
							foreach($website as $websiteval)
							{
						?>
						<li class="<?php echo $websiteval->class;?>"> <a  target="_blank" href="<?php echo $websiteval->link;?>"><span><?php echo $websiteval->web_title;?></span> <span class="icon-te"><img src="<?php echo $websiteval->icon;?>" alt=""></span></a></li>
						
						<?php
							}
						}
						?>
                        	
						
						
						</ul>
                    </div>
                    <div class="download-btn">
                    	<a href="http://mmw.sameer.gov.in/roundcube"><img src="<?php echo base_url(); echo IMAGE_URL;?>download.png" alt=""></a>
                    </div>
                    <div class="feature-bg variable_font">
					
					<?php $feature=$this->Common_model->getSingle('hindi_cms_pages',array('id'=>15),$order_by_fld='',$order_by='',$limit='',$offset='');
					
					if(!empty($feature)){
                        ?>
					
					
					 <h2><span><?php echo $feature->page_title;?></span></h2>
					
					
                    	<!--<h2><span>What's New</span></h2>-->
                         <div class="feature-scroll top-scroll" >
                        
						
						<?php echo $feature->content;?>
						
                           <!-- <p>Microwave and millimeterwave measurements:</p>
                            <ul>
                            	<li>Vector Network Analyzer</li>
                                <li>Scalar Network Analyzer</li>
                                <li>Spectrum Analyzer</li>
                                <li>Power Meter</li>
                                <li>Phase Noise & Noise figure</li>
                                <li>Signal Generator</li>
                                <li>Antenna Measurement Instrumentation</li>
                            </ul>
                            <p>Mechanical CAD </p>
                            <ul>
                            	<li>Auto CAD</li>
                                <li>Inventer</li>
                                <li>ProE</li>
                            </ul>-->
                        
                    </div>
					 <?php }?>
					</div>
                </aside>
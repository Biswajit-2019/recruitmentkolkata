<aside class="left-section">
                    <div class="left-menu">
                        <ul>

                        <?php   $website=$this->Common_model->getData('websites',array('status'=>'Y'));
                                if(!empty($website))
                                { foreach($website as $websiteVal){?>
                            <li class="<?php echo $websiteVal->class;?>"><a  target="_blank" href="<?php echo $websiteVal->link;?>"><span><?php echo $websiteVal->web_title;?> </span> <span class="icon-te"><img src="<?php echo $websiteVal->icon;?>" alt=""></span></a></li>
                          <?php  } } ?>
                            
                            
                        </ul>
                    </div>
                    <div class="download-btn">
                        <a href="#"><img src="<?php echo base_url(); echo IMAGE_URL;?>download.png" alt=""></a>
                    </div>
                    <div class="feature-bg variable_font">
                        <?php $feature=$this->Common_model->getSingle('cms_pages',array('id'=>5),$order_by_fld='',$order_by='',$limit='',$offset='');
                        if(!empty($feature)){
                        ?>
                        <h2><span><?php echo $feature->page_title;?></span></h2>
                        <div class="feature-scroll top-scroll" >
                        
                            <?php echo $feature->content;?>
                           
                        </div>
                        <?php }?>
                    </div>
                </aside>
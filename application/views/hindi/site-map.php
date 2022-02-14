 <section class="min-section">
    	<div class="container">
        	<div class="section-bg">
            	
        	<?php $this->load->view('hindi/includes/left');

            //print_r($main);
            ?>

                <div class="right-section variable_font">
                	<h1><?php echo $metaTitle;?> <span class="print"><a href="javascript:void(0);"  title="Print" class="print-btn">Print</a></span></h1>
                    <div class="content-text">
                       
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
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
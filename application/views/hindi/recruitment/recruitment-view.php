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
                            <div class="recruitment-header">
                                <div class="advno">Advt. No. :- <?=$value->advt_no;?></div>
                                <div class="publish-right">
                                    <?php if($value->result_status==1){ ?>
                                   <?php if (is_file(FCPATH.'/'.$value->result)) { ?>
                                    <a href="<?=base_url().$value->result;?>" target="_blank" class="publish-btn">Publish Result</a>
                                    <?php } ?>
                                <?php } ?>
                                <?php if($value->job_status=='Y'){?>
                                <div class="newbtn">NEW</div>
                                <?php } ?>
                                </div>
                            </div>
                            <!-- <p>Vacancy for <?=$value->vacancy;?></p> -->
                            <p><?=$value->vacancy_description;?></p>
                            <?php $download = (is_file(FCPATH.'/'.$value->vacancy_details))?base_url().$value->vacancy_details:''; ?>
                            <h4>डाउनलोड करें:  <a href="<?php echo $download;?>" target="_blank"><u>रिक्ति विवरण</u></a></h4>
                            <!-- <h4>ऑनलाइन आवेदन करें:  <a href="<?=base_url('login');?>"><u>http://kolkata.sameer.gov.in /recruitment</u></a></h4> -->
                            <?php $guideline=(is_file(FCPATH.'/'.$value->guideline))?base_url().$value->guideline:''; ?>
                            <?php if($value->guideline_status==1){ ?>
                                <br>
                            <h4><a href="<?php echo $guideline;?>" target="_blank">Guidelines for Online Examination</a></h4>
                        <?php } ?>
                            <!-- <p><strong><em>Important:</em></strong></p> -->
                            <?=$value->important_content;?>
                        </div>
                        <?php } }else{ ?>
                            <div class="recruitment-box">
                                <p style="text-align:center">No. Recruitment Available.</p>
                            </div>
                         <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </section>
<style type="text/css">
.disabled{background-color: #dddddd !important;}
</style>
 <section class="status-section">
    	<div class="container">
        	<div class="status-box">
                <div class="status-cont">
                    <div class="status-title"><h2>Check Application Status</h2></div>
                    <?php if(!empty($application)){
                        foreach($application as $value){
                            $single_personal_data = $this->Common_model->get_single('training_apply_mst', array('application_no'=>$value->application_no));
                            $applying_id = $single_personal_data->applying;
                             $applying_name = $this->Common_model->get_single('apply_mst', array('id'=>$applying_id))->name;

                     ?> 
                         <div class="status-container">
                        <table class="table">
                            <tr>
                                <td><strong>Application ID/Ref. no-</strong></td>
                                <td><strong>#<?=$value->application_no?></strong></td>
                            </tr>
                            <tr>
                                <td>Candidate Name :</td>
                                <td><?=($single_personal_data)?$single_personal_data->candidateName:''?></td>
                            </tr>
                            <tr>
                                <td>Email ID:</td>
                                <td><?=$single_personal_data->email?></td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td><?=date("d-m-Y", strtotime($value->updated_at))?></td>
                            </tr>
                            <tr>
                                <td>Applied for the Post :</td>
                                <td><?=$applying_name?></td>
                            </tr>
                        </table>
                        <h3>Present Status for Approval</h3>
                        <ul class="probar">
                            <li class="<?=($value->application_status==0)?'':'disabled'?>">Under<br>Process</li>
                            <li class="<?=($value->application_status==1)?'':'disabled'?>"> Not <br>Selected </li>

                           <!--  <li class="<?=($value->application_status==2)?'':'disabled'?>"> Selected for Written Test <?=($value->application_status==2)?'<span class="date">Date: '.date("d-m-Y", strtotime($value->written_date)).'</span>':''?></li> -->
                            
                            <li class="<?=($value->application_status==3)?'':'disabled'?>">Selected for training<?=($value->application_status==3)?'<span class="date">Date: '.date("d-m-Y", strtotime($value->interview_date)).'</span>':''?></li>                           
                        </ul>
                        <div class="note-sec">
                            <p><span>Note:</span> For more information,</p>
                            <p>please contact with <a href="mailto:hrd@mmw.sameer.gov.in">hrd@mmw.sameer.gov.in</a> or <a href="tel:033-2357-4894">033-2357-4894</a></p>
                        </div>
                    </div>
                    <?php } }else{ ?> 
                        <div class="status-container">
                            <table class="table">
                                <tr>No Data Available.</tr>
                            </table>
                        </div>

                    <?php } ?>
                   
                     <?php if(!empty($application)){ ?>
                    <!-- <div class="status-footer">You are selected for training,  official Email /postal letter will be sent soon</div> -->
                    <div class="status-footer">If you are selected for training, official Email /postal letter will be sent soon</div>
                <?php } ?>
                </div>
            </div>
        </div>
    </section>